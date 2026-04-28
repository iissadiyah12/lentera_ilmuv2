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

    public function index()
{
    $keyword = $this->request->getGet('keyword');

    $builder = $this->db->table('pengembalian p');

    $builder->select('
        p.*,
        pm.status as status_peminjaman,
        pm.tanggal_pinjam,
        pm.tanggal_kembali,
        COALESCE(u.nama, "-") as nama_anggota,
        GROUP_CONCAT(b.judul SEPARATOR ", ") as judul
    ');

    $builder->join('peminjaman pm', 'pm.id_peminjaman = p.id_peminjaman');
    $builder->join('users u', 'u.id_user = pm.id_anggota', 'left');
    $builder->join('detail_peminjaman dp', 'dp.id_peminjaman = pm.id_peminjaman', 'left');
    $builder->join('buku b', 'b.id_buku = dp.id_buku', 'left');

    // SEARCH TAMBAHAN
    if ($keyword) {
        $builder->groupStart()
            ->like('pm.id_peminjaman', $keyword)
            ->orLike('u.nama', $keyword)
            ->orLike('p.status', $keyword)
            ->orLike('b.judul', $keyword)
        ->groupEnd();
    }

    $data['pengembalian'] = $builder
        ->groupBy('p.id_pengembalian')
        ->orderBy('p.id_pengembalian', 'DESC')
        ->get()
        ->getResultArray();

    return view('pengembalian/index', $data);
}

    public function acc($id_peminjaman)
    {
        $peminjaman = $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if ($peminjaman['status'] == 'dikembalikan') {
            return redirect()->back()->with('error', 'Sudah dikembalikan');
        }

        $today = date('Y-m-d');
        $batas = $peminjaman['tanggal_kembali'];

        $terlambat = 0;
        if ($today > $batas) {
            $terlambat = floor((strtotime($today) - strtotime($batas)) / 86400);
        }

        $denda = $terlambat * 5000;

        $cek = $this->db->table('pengembalian')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        if ($cek) {
            $this->db->table('pengembalian')
                ->where('id_peminjaman', $id_peminjaman)
                ->update([
                    'tanggal_dikembalikan' => $today,
                    'status' => 'disetujui',
                    'denda' => $denda
                ]);
        } else {
            $this->db->table('pengembalian')->insert([
                'id_peminjaman' => $id_peminjaman,
                'tanggal_dikembalikan' => $today,
                'status' => 'disetujui',
                'denda' => $denda
            ]);
        }

        $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->update([
                'status' => 'dikembalikan'
            ]);

        // kembalikan stok
        $detail = $this->db->table('detail_peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getResultArray();

        foreach ($detail as $d) {
            $this->db->table('buku')
                ->where('id_buku', $d['id_buku'])
                ->set('jumlah', 'jumlah + '.$d['jumlah'], false)
                ->update();
        }

        return redirect()->back()->with('success', 'Berhasil dikembalikan');
    }

    public function delete($id)
    {
        $this->pengembalian->delete($id);
        return redirect()->to('/pengembalian');
    }
}