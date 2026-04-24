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

    public function dikembalikan($id)
{
    $this->db->table('pengembalian')
        ->where('id_pengembalian', $id)
        ->update([
            'status' => 'menunggu'
        ]);

    return redirect()->back()->with('success', 'Menunggu konfirmasi anggota');
}

public function selesai($id)
{
    $pengembalian = $this->db->table('pengembalian')
        ->where('id_pengembalian', $id)
        ->get()->getRowArray();

    if (!$pengembalian) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    $peminjaman = $this->db->table('peminjaman')
        ->where('id_peminjaman', $pengembalian['id_peminjaman'])
        ->get()->getRowArray();

    $today = date('Y-m-d');

    // ================= HITUNG TELAT =================
    $hari_telat = 0;
    if ($today > $peminjaman['tanggal_kembali']) {
        $hari_telat = floor((strtotime($today) - strtotime($peminjaman['tanggal_kembali'])) / 86400);
    }

    // ================= JUMLAH BUKU =================
    $jumlah_buku = $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $peminjaman['id_peminjaman'])
        ->countAllResults();

    // ================= HITUNG DENDA =================
    $total_denda = $hari_telat * 5000 * $jumlah_buku;

    // ================= UPDATE STATUS =================
    $this->db->table('pengembalian')
        ->where('id_pengembalian', $id)
        ->update([
            'status' => 'disetujui',
            'tanggal_dikembalikan' => $today,
            'denda' => $total_denda
        ]);

    // update peminjaman
    $this->db->table('peminjaman')
        ->where('id_peminjaman', $peminjaman['id_peminjaman'])
        ->update([
            'status' => 'dikembalikan'
        ]);

    // ================= TAMBAH STOK =================
    $detail = $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $peminjaman['id_peminjaman'])
        ->get()->getResultArray();

    foreach ($detail as $d) {
        $this->db->table('buku')
            ->where('id_buku', $d['id_buku'])
            ->set('jumlah', 'jumlah + '.$d['jumlah'], false)
            ->update();
    }

    // ================= SIMPAN KE DENDA =================
    if ($total_denda > 0) {

        $this->db->table('denda')->insert([
            'id_pengembalian' => $id,
            'total_denda' => $total_denda,
            'hari_terlambat' => $hari_telat,
            'jumlah_buku' => $jumlah_buku,
            'status_bayar' => 'belum'
        ]);

        return redirect()->back()->with('error', 'Terlambat! Denda Rp '.number_format($total_denda));
    }

    return redirect()->back()->with('success', 'Pengembalian selesai');
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