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
        $builder = $this->db->table('peminjaman p');

        $builder->select('
            p.*,
            u1.nama as nama_anggota,
            u2.nama as nama_petugas
        ');

        $builder->join('users u1', 'u1.id_user = p.id_anggota', 'left');
        $builder->join('users u2', 'u2.id_user = p.id_petugas', 'left');

        $data['peminjaman'] = $builder->get()->getResultArray();

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

    // ======================
    // STORE (FIX FINAL)
    // ======================
    public function store()
{
    // 🔥 pakai session yang benar
    $id_anggota = session()->get('id_anggota'); // pastikan ini benar di login kamu
    $id_buku = $this->request->getPost('buku');
    $metode = $this->request->getPost('metode');
    $alamat = $this->request->getPost('alamat');

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

    $this->db->transBegin();

    // ================= PEMINJAMAN (TANPA METODE) =================
    $this->db->table('peminjaman')->insert([
        'id_anggota' => $id_anggota,
        'id_petugas' => 1,
        'tanggal_pinjam' => date('Y-m-d'),
        'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
        'status' => 'dipinjam'
    ]);

    $id_peminjaman = $this->db->insertID();

    if (!$id_peminjaman) {
        $this->db->transRollback();
        return redirect()->back()->with('error', 'Gagal membuat peminjaman');
    }

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

        if ($buku['jumlah'] <= 0) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Stok habis');
        }

        // detail
        $this->db->table('detail_peminjaman')->insert([
            'id_peminjaman' => $id_peminjaman,
            'id_buku' => $id_b,
            'jumlah' => 1,
            'dikembalikan' => 0
        ]);

        // stok
        $this->db->table('buku')
            ->where('id_buku', $id_b)
            ->set('jumlah', 'jumlah-1', false)
            ->update();
    }

    $this->db->transCommit();

    return redirect()->to('/peminjaman')->with('success', 'Berhasil meminjam');
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