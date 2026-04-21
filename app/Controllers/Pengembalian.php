<?php

namespace App\Controllers;

use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    protected $pengembalian;
    protected $db;

    public function __construct()
    {
        $this->pengembalian = new PengembalianModel();
        $this->db = \Config\Database::connect();
    }

    // ================= INDEX + SEARCH =================
    public function index()
{
    $keyword = $this->request->getGet('keyword');

    $builder = $this->db->table('pengembalian p')
        ->select('
            p.*,
            pm.id_peminjaman,
            u.nama
        ')
        ->join('peminjaman pm', 'pm.id_peminjaman = p.id_peminjaman')
        ->join('users u', 'u.id_user = pm.id_anggota', 'left');

    if ($keyword) {
        $builder->like('p.id_peminjaman', $keyword);
    }

    $data['pengembalian'] = $builder->get()->getResultArray();

    return view('pengembalian/index', $data);
}

    // ================= FORM CREATE =================
    public function create()
    {
        return view('pengembalian/create');
    }

    // ================= PROSES PENGEMBALIAN =================
    public function store()
    {
        $id_peminjaman = $this->request->getPost('id_peminjaman');

        // ambil data peminjaman
        $peminjaman = $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()->getRowArray();

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'ID tidak valid');
        }

        // cek status
        if ($peminjaman['status'] == 'kembali') {
            return redirect()->back()->with('error', 'Sudah dikembalikan');
        }

        $today = date('Y-m-d');
        $batas = $peminjaman['tanggal_kembali'];

        // hitung keterlambatan
        $terlambat = 0;
        if ($today > $batas) {
            $terlambat = (strtotime($today) - strtotime($batas)) / (60 * 60 * 24);
        }

        $denda = $terlambat * 5000;

        // ================= UPDATE STOK =================
        $detail = $this->db->table('detail_peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()->getResultArray();

        foreach ($detail as $d) {
            $this->db->table('buku')
                ->set('tersedia', 'tersedia + '.$d['jumlah'], false)
                ->where('id_buku', $d['id_buku'])
                ->update();
        }

        // ================= SIMPAN PENGEMBALIAN =================
        $this->pengembalian->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_dikembalikan' => $today,
            'denda' => $denda
        ]);

        // ================= UPDATE STATUS =================
        $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->update(['status' => 'kembali']);

        return redirect()->to('/pengembalian')->with('success', 'Pengembalian berhasil');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->pengembalian->delete($id);
        return redirect()->to('/pengembalian');
    }
}