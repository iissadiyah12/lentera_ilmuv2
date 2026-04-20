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
        $builder->join('users', 'users.id_user = peminjaman.id_user', 'left');
        $builder->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman');
        $builder->join('buku', 'buku.id_buku = detail_peminjaman.id_buku');

        $data['peminjaman'] = $builder->get()->getResultArray();

        return view('peminjaman/index', $data);
    }

    // ======================
    // CREATE (USER)
    // ======================
    public function create()
    {
        $data['buku'] = $this->db->table('buku')->get()->getResultArray();
        return view('peminjaman/create', $data);
    }

    // ======================
    // STORE
    // ======================
    public function store()
{
    $id_user = $this->request->getPost('id_user');
    $bukuDipilih = $this->request->getPost('buku');

    $tanggal_pinjam = date('Y-m-d');
    $tanggal_kembali = date('Y-m-d', strtotime('+6 days'));

    $this->peminjaman->insert([
        'id_user' => $id_user,
        'tanggal_pinjam' => $tanggal_pinjam,
        'tanggal_kembali' => $tanggal_kembali,
        'status' => 'dipinjam'
    ]);

    $id_peminjaman = $this->db->insertID();

    foreach ($bukuDipilih as $id_buku => $qty) {

        // ❗ skip kalau 0
        if ($qty <= 0) continue;

        $buku = $this->db->table('buku')
            ->where('id_buku', $id_buku)
            ->get()->getRowArray();

        if (!$buku || $buku['jumlah'] < $qty) {
            continue;
        }

        // simpan detail
        $this->db->table('detail_peminjaman')->insert([
            'id_peminjaman' => $id_peminjaman,
            'id_buku' => $id_buku,
            'jumlah' => $qty
        ]);

        // update stok
        $this->db->table('buku')
            ->where('id_buku', $id_buku)
            ->update([
                'jumlah' => $buku['jumlah'] - $qty
            ]);
    }

    return redirect()->to('/peminjaman');
}

  public function detail($id)
{
    $data['p'] = $this->peminjaman->find($id);

    $data['detail'] = $this->db->table('detail_peminjaman dp')
        ->select('dp.jumlah, buku.judul, buku.cover')
        ->join('buku', 'buku.id_buku = dp.id_buku')
        ->where('dp.id_peminjaman', $id)
        ->get()
        ->getResultArray();

    $data['total_buku'] = array_sum(array_column($data['detail'], 'jumlah'));

    return view('peminjaman/detail', $data);
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