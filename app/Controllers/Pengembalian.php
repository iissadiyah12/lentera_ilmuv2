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

    $builder = $this->db->table('pengembalian p');

    $builder->select('
        p.*,
        pm.tanggal_pinjam,
        pm.tanggal_kembali,
        u.nama as nama_anggota,
        b.judul
    ');

    $builder->join('peminjaman pm', 'pm.id_peminjaman = p.id_peminjaman');
    $builder->join('users u', 'u.id_user = pm.id_anggota', 'left');

    // 🔥 TAMBAHAN PENTING
    $builder->join('detail_peminjaman dp', 'dp.id_peminjaman = pm.id_peminjaman', 'left');
    $builder->join('buku b', 'b.id_buku = dp.id_buku', 'left');

    // ================= SEARCH =================
    if ($keyword) {
        $builder->groupStart()
            ->like('pm.id_peminjaman', $keyword)
            ->orLike('u.nama', $keyword)
            ->orLike('b.judul', $keyword)
            ->groupEnd();
    }
     $builder = $this->db->table('pengembalian p');

    $builder->select('
        p.*,
        u1.nama as id_peminjaman,  
        u2.nama as nama_petugas
    ');

    $builder->join('peminjaman pm', 'pm.id_peminjaman = p.id_peminjaman');
    $builder->join('users u1', 'u1.id_user = pm.id_anggota', 'left');

    // 🔥 ambil petugas dari pengembalian atau peminjaman
    $builder->join('users u2', 'u2.id_user = pm.id_petugas', 'left');

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
    $peminjaman = $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->get()->getRowArray();

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    $today = date('Y-m-d');

    // ================= HITUNG TERLAMBAT =================
    $terlambat = 0;
    if ($today > $peminjaman['tanggal_kembali']) {
        $terlambat = floor((strtotime($today) - strtotime($peminjaman['tanggal_kembali'])) / 86400);
    }

    // ================= AMBIL JUMLAH BUKU =================
    $detail = $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $id)
        ->get()->getResultArray();

    $jumlahBuku = count($detail);

    // ================= HITUNG DENDA =================
    $denda = $terlambat * 5000 * $jumlahBuku;

    // ================= INSERT KE PENGEMBALIAN =================
    $this->db->table('pengembalian')->insert([
        'id_peminjaman' => $id,
        'tanggal_dikembalikan' => $today,
        'status' => 'disetujui',
        'denda' => $denda
    ]);

    $id_pengembalian = $this->db->insertID();

    // ================= UPDATE STATUS PEMINJAMAN =================
    $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->update([
            'status' => 'dikembalikan'
        ]);

    // ================= KEMBALIKAN STOK =================
    foreach ($detail as $d) {
        $this->db->table('buku')
            ->where('id_buku', $d['id_buku'])
            ->set('jumlah', 'jumlah + '.$d['jumlah'], false)
            ->update();
    }

    // ================= MASUK KE TABEL DENDA =================
    if ($denda > 0) {
        $this->db->table('denda')->insert([
            'id_pengembalian' => $id_pengembalian,
            'total_denda' => $denda,
            'hari_terlambat' => $terlambat,
            'status_bayar' => 'belum'
        ]);

        return redirect()->back()->with('error', 'Terlambat! Denda Rp '.number_format($denda));
    }

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
}
   public function acc($id)
{
    // ambil data pengembalian
    $p = $this->db->table('pengembalian')
        ->where('id_pengembalian', $id)
        ->get()
        ->getRowArray();

    // update status pengembalian
    $this->db->table('pengembalian')
        ->where('id_pengembalian', $id)
        ->update([
            'status' => 'disetujui'
        ]);

    // update peminjaman (pakai id_peminjaman dari pengembalian)
    $this->db->table('peminjaman')
        ->where('id_peminjaman', $p['id_peminjaman'])
        ->update([
            'status' => 'dikembalikan'
        ]);

    return redirect()->back();
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
    
    public function bayarDenda($id_pengembalian)
{
    $metode = $this->request->getPost('metode');

    $this->db->table('denda')
        ->where('id_pengembalian', $id_pengembalian)
        ->update([
            'status_bayar' => 'lunas',
            'metode_bayar' => $metode,
            'tanggal_bayar' => date('Y-m-d')
        ]);

    return redirect()->back()->with('success', 'Pembayaran berhasil');
}
    // ================= DELETE =================
    public function delete($id)
    {
        $model = new PengembalianModel();
        $model->delete($id);

        return redirect()->to('/pengembalian');
    }
}