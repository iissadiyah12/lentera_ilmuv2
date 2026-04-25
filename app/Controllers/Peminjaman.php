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
    // INDEX
    // ======================
    public function index()
    {
        $data['peminjaman'] = $this->db->table('peminjaman p')
            ->select('
        p.*,
        u1.nama as nama_anggota,
        u2.nama as nama_petugas,
        GROUP_CONCAT(b.judul SEPARATOR ", ") as judul_buku
    ')
            ->join('users u1', 'u1.id_user = p.id_anggota', 'left')
            ->join('petugas pt', 'pt.id_petugas = p.id_petugas', 'left')
            ->join('users u2', 'u2.id_user = pt.id_user', 'left')
            ->join('detail_peminjaman dp', 'dp.id_peminjaman = p.id_peminjaman', 'left')
            ->join('buku b', 'b.id_buku = dp.id_buku', 'left')
            ->groupBy('p.id_peminjaman')
            ->orderBy('p.id_peminjaman', 'DESC')
            ->get()
            ->getResultArray();

        return view('peminjaman/index', $data);
    }

    // ======================
    // CREATE
    // ======================
    public function create()
    {
        $data['buku'] = $this->db->table('buku')->get()->getResultArray();

        return view('peminjaman/create', $data);
    }

    public function store()
    {
        $id_anggota = session()->get('id'); // pastikan ini benar
        $id_buku = $this->request->getPost('buku');

        // ================= VALIDASI =================
        if (!$id_anggota) {
            return redirect()->back()->with('error', 'Session user tidak ditemukan');
        }

        if (empty($id_buku)) {
            return redirect()->back()->with('error', 'Pilih minimal 1 buku');
        }

        if (count($id_buku) > 2) {
            return redirect()->back()->with('error', 'Maksimal 2 buku');
        }

        // ================= PETUGAS OTOMATIS =================
        $petugas = $this->db->table('petugas')
            ->where('jabatan', 'sirkulasi')
            ->get()
            ->getRowArray();

        $id_petugas = $petugas ? $petugas['id_petugas'] : 1;

        $this->db->transBegin();

        // ================= INSERT PEMINJAMAN =================
        $this->db->table('peminjaman')->insert([
            'id_anggota' => $id_anggota,
            'id_petugas' => $id_petugas,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+6 days')),
            'status' => 'menunggu'
        ]);
        
        
        // ================= AMBIL ID ======================
        $id_peminjaman = $this->db->insertID();

        // ================= INSERT PENGEMBALIAN ===========
        $this->db->table('pengembalian')->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_dikembalikan' => date('Y-m-d'),
            'status' => 'belum',
            'denda' => 0
        ]);

        
        // ================= DETAIL + STOK =================
        foreach ($id_buku as $id_b) {

            $buku = $this->db->table('buku')
                ->where('id_buku', $id_b)
                ->get()
                ->getRowArray();

            if (!$buku) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Buku tidak ditemukan');
            }

            //  CEK STOK DULU 
            if ($buku['jumlah'] <= 0) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Stok buku habis');
            }
            

            // insert detail
            $this->db->table('detail_peminjaman')->insert([
                'id_peminjaman' => $id_peminjaman,
                'id_buku' => $id_b,
                'jumlah' => 1
            ]);

            // update stok
            $this->db->table('buku')
                ->where('id_buku', $id_b)
                ->set('jumlah', 'jumlah-1', false)
                ->update();
               
           
        }

        $this->db->transCommit();

        return redirect()->to('/peminjaman')->with('success', 'Berhasil meminjam');
    }
    public function setujui($id)
{
    $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->update([
            'status' => 'dipinjam'
        ]);

    return redirect()->back()->with('success', 'Peminjaman disetujui');
}
    public function requestPerpanjang($id_peminjaman)
{
    $peminjaman = $this->db->table('peminjaman')
        ->where('id_peminjaman', $id_peminjaman)
        ->get()
        ->getRowArray();

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // 🔥 CEK MAX 2 KALI
    if ($peminjaman['jumlah_perpanjang'] >= 2) {
        return redirect()->back()->with('error', '❌ Maksimal perpanjang hanya 2 kali');
    }

    // ❗ CEK jika masih menunggu
    if ($peminjaman['status_perpanjang'] == 'menunggu') {
        return redirect()->back()->with('error', '⏳ Permintaan perpanjangan masih diproses');
    }

    $this->db->table('peminjaman')
        ->where('id_peminjaman', $id_peminjaman)
        ->update([
            'status_perpanjang' => 'menunggu'
        ]);

    return redirect()->back()->with('success', 'Permintaan perpanjangan dikirim');
}

public function approvePerpanjang($id_peminjaman)
{
    $p = $this->db->table('peminjaman')
        ->where('id_peminjaman', $id_peminjaman)
        ->get()
        ->getRowArray();

    if (!$p) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // tambah jumlah perpanjang
    $jumlah = $p['jumlah_perpanjang'] + 1;

    // hitung tanggal baru (tambah 7 hari)
    $tanggal_baru = date('Y-m-d', strtotime($p['tanggal_kembali'] . ' +7 days'));

    $this->db->table('peminjaman')
        ->where('id_peminjaman', $id_peminjaman)
        ->update([
            'tanggal_kembali' => $tanggal_baru,
            'jumlah_perpanjang' => $jumlah,
            'status_perpanjang' => 'disetujui'
        ]);

    return redirect()->back()->with('success', 'Perpanjangan disetujui');
}
public function detail($id)
{
    $data['peminjaman'] = $this->db->table('peminjaman p')
        ->select('p.*, u.nama as nama_anggota')
        ->join('users u', 'u.id_user = id_user', 'left')
        ->where('p.id_peminjaman', $id)
        ->get()
        ->getRowArray();

    if (!$data['peminjaman']) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
    }

    return view('peminjaman/detail', $data);
}
public function acc($id_peminjaman)
{
    // ambil data peminjaman
    $peminjaman = $this->db->table('peminjaman')
        ->where('id_peminjaman', $id_peminjaman)
        ->get()
        ->getRowArray();

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // update status jadi dipinjam
    $this->db->table('peminjaman')
        ->where('id_peminjaman', $id_peminjaman)
        ->update([
            'status' => 'dipinjam'
        ]);

    return redirect()->to('/peminjaman')
        ->with('success', 'Peminjaman disetujui');
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
