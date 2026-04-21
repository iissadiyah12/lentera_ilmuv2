<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;
    protected $db;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->db = \Config\Database::connect();
    }

    // ======================
    // INDEX (ADMIN/PETUGAS)
    // ======================
    public function index()
{
    $builder = $this->db->table('peminjaman');
    $builder->select('peminjaman.*, users.nama, buku.judul');

    // ✅ FIX DI SINI
    $builder->join('users', 'users.id_user = peminjaman.id_anggota', 'left');

    $builder->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman', 'left');
    $builder->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left');
    $data['peminjaman'] = $builder->get()->getResultArray();

    return view('peminjaman/index', $data);
}

    // ======================
    // CREATE (USER)
    // ======================
    public function create()
{
    $data['buku'] = $this->db->table('buku')->get()->getResultArray();

    // 🔥 TAMBAHKAN INI
    $data['users'] = $this->db->table('users')->get()->getResultArray();

    return view('peminjaman/create', $data);
}

    // ======================
// STORE
// ======================
public function store()
{
    $id_user = session()->get('id_user');
    $id_buku = $this->request->getPost('buku');

    $metode = $this->request->getPost('metode');
    $alamat = $this->request->getPost('alamat');

    // ================= VALIDASI =================

   if ($this->db->transStatus() === false) {
    dd($this->db->error()); // 🔥 lihat error asli
} 

    if (empty($id_buku)) {
        return redirect()->back()->with('error', 'Pilih minimal 1 buku');
    }

    // MAX 2 BUKU
    if (count($id_buku) > 2) {
        return redirect()->back()->with('error', 'Maksimal pinjam 2 buku');
    }

    if (!$metode) {
        return redirect()->back()->with('error', 'Pilih metode');
    }

    if ($metode == 'antar' && empty($alamat)) {
        return redirect()->back()->with('error', 'Alamat wajib diisi');
    }

    $tanggal_pinjam = date('Y-m-d');
    $tanggal_kembali = date('Y-m-d', strtotime('+6 days'));

   $this->db->transStart();
{
$id_peminjaman = $this->peminjaman->insert([
    'id_anggota' => $id_user,
    'id_petugas' => 1,
    'tanggal_pinjam' => $tanggal_pinjam,
    'tanggal_kembali' => $tanggal_kembali,
    'status' => 'dipinjam'
]);

if (!$id_peminjaman) {
    dd('ERROR PEMINJAMAN', $this->peminjaman->errors());
}

foreach ($id_buku as $buku) {

    $dataBuku = $this->db->table('buku')
        ->where('id_buku', $buku)
        ->get()->getRowArray();

    if (!$dataBuku) {
        dd('BUKU TIDAK DITEMUKAN');
    }

    $this->db->table('detail_peminjaman')->insert([
        'id_peminjaman' => $id_peminjaman,
        'id_buku' => $buku,
        'jumlah' => 1,
        'dikembalikan' => 0
    ]);

    if ($this->db->affectedRows() == 0) {
        dd('GAGAL INSERT DETAIL');
    }
}

        $this->db->table('buku')
            ->where('id_buku', $buku)
            ->update([
                'jumlah' => $dataBuku['jumlah'] - 1
            ]);
    }

    // ================= SIMPAN PENGIRIMAN =================
    if ($metode == 'antar') {
        $this->db->table('pengiriman')->insert([
            'id_peminjaman' => $id_peminjaman,
            'alamat' => $alamat,
            'ongkir' => 10000,
            'status' => 'menunggu',
            'tanggal_kirim' => date('Y-m-d'),
            'id_petugas' => 1
        ]);
    }

    $this->db->transComplete();

    if ($this->db->transStatus() === false) {
        return redirect()->back()->with('error', 'Gagal menyimpan');
    }

    return redirect()->to('/peminjaman')->with('success', 'Berhasil meminjam');
}
public function edit($id)
{
    $data['peminjaman'] = $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->get()
        ->getRowArray();

    // ambil user (anggota)
    $data['users'] = $this->db->table('users')->get()->getResultArray();

    // ambil semua buku
    $data['buku'] = $this->db->table('buku')->get()->getResultArray();

    // ambil detail buku yang dipinjam
    $data['detail'] = $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $id)
        ->get()
        ->getResultArray();

    return view('peminjaman/edit', $data);
}
public function update($id)
{
    $id_user = $this->request->getPost('id_anggota');
    $bukuDipilih = $this->request->getPost('buku');

    $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
    $tanggal_kembali = $this->request->getPost('tanggal_kembali');
    $status = $this->request->getPost('status');

    // ================= VALIDASI =================
    if (!$tanggal_pinjam || !$tanggal_kembali) {
        return redirect()->back()->with('error', 'Tanggal wajib diisi');
    }

    // ================= TRANSAKSI =================
    $this->db->transStart();

    // ================= KEMBALIKAN STOK LAMA =================
    $detailLama = $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $id)
        ->get()->getResultArray();

    foreach ($detailLama as $d) {
        $this->db->table('buku')
            ->where('id_buku', $d['id_buku'])
            ->set('jumlah', 'jumlah + '.$d['jumlah'], false)
            ->update();
    }

    // hapus detail lama
    $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $id)
        ->delete();

    // ================= UPDATE PEMINJAMAN =================
    $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->update([
            'id_anggota' => $id_user,
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'status' => $status
        ]);

    // ================= INSERT DETAIL BARU =================
    if (!empty($bukuDipilih)) {
        foreach ($bukuDipilih as $id_buku => $qty) {

            if ($qty <= 0) continue;

            $buku = $this->db->table('buku')
                ->where('id_buku', $id_buku)
                ->get()->getRowArray();

            if (!$buku || $buku['jumlah'] < $qty) {
                continue;
            }

            // simpan detail baru
            $this->db->table('detail_peminjaman')->insert([
                'id_peminjaman' => $id,
                'id_buku' => $id_buku,
                'jumlah' => $qty
            ]);

            // kurangi stok
            $this->db->table('buku')
                ->where('id_buku', $id_buku)
                ->update([
                    'jumlah' => $buku['jumlah'] - $qty
                ]);
        }
    }

    $this->db->transComplete();

    if ($this->db->transStatus() === false) {
        return redirect()->back()->with('error', 'Gagal update');
    }

    return redirect()->to('/peminjaman')->with('success', 'Data berhasil diupdate');
}

 public function detail($id)
{
    $data['peminjaman'] = $this->db->table('peminjaman p')
        ->select('
            p.*,
            u1.nama as nama_anggota,
            u2.nama as nama_petugas,
            b.judul
        ')
        ->join('users u1', 'u1.id_user = p.id_anggota', 'left')
        ->join('users u2', 'u2.id_user = p.id_petugas', 'left')
        ->join('detail_peminjaman dp', 'dp.id_peminjaman = p.id_peminjaman', 'left')
        ->join('buku b', 'b.id_buku = dp.id_buku', 'left')
        ->where('p.id_peminjaman', $id)
        ->get()
        ->getRowArray();

    return view('peminjaman/detail', $data);
}

public function perpanjang($id, $hari)
{
    // ambil data peminjaman
    $peminjaman = $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->get()
        ->getRowArray();

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // hanya boleh kalau masih dipinjam
    if ($peminjaman['status'] != 'dipinjam') {
        return redirect()->back()->with('error', 'Tidak bisa diperpanjang');
    }

    // hitung tanggal kembali baru
    $tanggal_kembali_lama = $peminjaman['tanggal_kembali'];

    $tanggal_baru = date('Y-m-d', strtotime($tanggal_kembali_lama . " +$hari days"));

    // update database
    $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->update([
            'tanggal_kembali' => $tanggal_baru
        ]);

    return redirect()->to('/peminjaman')->with('success', 'Berhasil diperpanjang');
}

    public function kembalikan($id_detail)
{
    $detail = $this->db->table('detail_peminjaman')
        ->where('id_detail', $id_detail)
        ->get()->getRowArray();

    // tambah jumlah dikembalikan
    $this->db->table('detail_peminjaman')
        ->where('id_detail', $id_detail)
        ->update([
            'dikembalikan' => $detail['dikembalikan'] + 1
        ]);

    // kembalikan stok buku
    $this->db->table('buku')
        ->where('id_buku', $detail['id_buku'])
        ->set('jumlah', 'jumlah+1', false)
        ->update();

    // cek apakah semua buku sudah kembali
    $cek = $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $detail['id_peminjaman'])
        ->get()->getResultArray();

    $selesai = true;
    foreach ($cek as $c) {
        if ($c['jumlah'] > $c['dikembalikan']) {
            $selesai = false;
        }
    }

    // update status peminjaman
    if ($selesai) {

        $peminjaman = $this->db->table('peminjaman')
            ->where('id_peminjaman', $detail['id_peminjaman'])
            ->get()->getRowArray();

        $today = date('Y-m-d');

        $status = ($today > $peminjaman['tanggal_kembali']) ? 'terlambat' : 'dikembalikan';

        $this->db->table('peminjaman')
            ->where('id_peminjaman', $detail['id_peminjaman'])
            ->update(['status' => $status]);

        // jika terlambat → masuk ke pengembalian + denda
        if ($status == 'terlambat') {

            $terlambat_hari = (strtotime($today) - strtotime($peminjaman['tanggal_kembali'])) / 86400;

            $total_buku = count($cek);

            $denda = $total_buku * 20000 * $terlambat_hari;

            $this->db->table('pengembalian')->insert([
                'id_peminjaman' => $detail['id_peminjaman'],
                'tanggal_dikembalikan' => $today,
                'denda' => $denda
            ]);
        }
    }

    return redirect()->back();
}
    // ======================
    // UPDATE STATUS OTOMATIS
    // ======================
    public function cekTerlambat()
    {
        $today = date('Y-m-d');

        $data = $this->peminjaman
            ->where('tanggal_kembali <', $today)
            ->where('status', 'dipinjam')
            ->findAll();

        foreach ($data as $d) {

            $this->peminjaman->update($d['id_peminjaman'], [
                'status' => 'terlambat'
            ]);

            // hitung denda
            $jumlahBuku = $this->db->table('detail_peminjaman')
                ->where('id_peminjaman', $d['id_peminjaman'])
                ->countAllResults();

            $denda = $jumlahBuku * 20000;

            $this->db->table('pengembalian')->insert([
                'id_peminjaman' => $d['id_peminjaman'],
                'denda' => $denda
            ]);
        }
    }

    // ======================
    // DELETE
    // ======================
    public function delete($id)
    {
        $this->peminjaman->delete($id);
        return redirect()->to('/peminjaman');
    }
}