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
        $id_user = session()->get('id');
        $role = session()->get('role');

        $builder = $this->db->table('peminjaman p')
            ->select('
                p.*,
                u1.nama as nama_anggota,
                pt.jabatan as nama_petugas,
                pg.id_pengembalian,
                pg.status as status_pengembalian,
                GROUP_CONCAT(b.judul SEPARATOR ", ") as judul_buku
            ')
            ->join('users u1', 'u1.id_user = p.id_anggota', 'left')
            ->join('petugas pt', 'pt.id_petugas = p.id_petugas', 'left')
            ->join('pengembalian pg', 'pg.id_peminjaman = p.id_peminjaman', 'left')
            ->join('detail_peminjaman dp', 'dp.id_peminjaman = p.id_peminjaman', 'left')
            ->join('buku b', 'b.id_buku = dp.id_buku', 'left');

        $builder->groupBy('p.id_peminjaman');
        
        // filter anggota
        if ($role != 'admin' && $role != 'petugas') {
            $builder->where('p.id_anggota', $id_user);
        }

        $data['peminjaman'] = $builder
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

    // ======================
    // STORE
    // ======================
    public function store()
    {
        $id_anggota = session()->get('id_anggota');

        // hitung total buku yang masih dipinjam (belum dikembalikan)
        $totalDipinjam = $this->db->table('detail_peminjaman dp')
            ->join('peminjaman p', 'p.id_peminjaman = dp.id_peminjaman')
            ->where('p.id_anggota', $id_anggota)
            ->where('p.status !=', 'dikembalikan')
            ->selectSum('dp.jumlah')
            ->get()
            ->getRow()
            ->jumlah ?? 0;

        // buku yang mau dipinjam sekarang
        $bukuDipilih = $this->request->getPost('buku');
        $jumlahBaru = count($bukuDipilih);

        // ================= VALIDASI =================
        if ($totalDipinjam >= 2) {
            return redirect()->back()->with('error', 
                '❌ Anda masih memiliki buku yang belum dikembalikan (max 2 buku)');
        }

        if (($totalDipinjam + $jumlahBaru) > 2) {
            return redirect()->back()->with('error', 
                '❌ Maksimal total peminjaman hanya 2 buku');
        }
        $id_anggota = session()->get('id');
        $id_buku = $this->request->getPost('buku');

        if (!$id_anggota) {
            return redirect()->back()->with('error', 'Session user tidak ditemukan');
        }

        if (empty($id_buku)) {
            return redirect()->back()->with('error', 'Pilih minimal 1 buku');
        }

        if (count($id_buku) > 2) {
            return redirect()->back()->with('error', 'Maksimal 2 buku');
        }

        // ambil petugas otomatis
        $petugas = $this->db->table('petugas')->get()->getRowArray();
        $id_petugas = $petugas ? $petugas['id_petugas'] : 1;

        $this->db->transBegin();

        $this->db->table('peminjaman')->insert([
            'id_anggota' => $id_anggota,
            'id_petugas' => $id_petugas,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
            'status' => 'dipinjam'
        ]);

        $id_peminjaman = $this->db->insertID();
        // ================= AUTO INSERT KE PENGEMBALIAN =================
        $this->db->table('pengembalian')->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_dikembalikan' => date('Y-m-d'), // atau NULL kalau mau
            'status' => 'belum',
            'denda' => 0
        ]);

        foreach ($id_buku as $id_b) {

            $buku = $this->db->table('buku')
                ->where('id_buku', $id_b)
                ->get()->getRowArray();

            if (!$buku || $buku['jumlah'] <= 0) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Stok buku tidak tersedia');
            }

            $this->db->table('detail_peminjaman')->insert([
                'id_peminjaman' => $id_peminjaman,
                'id_buku' => $id_b,
                'jumlah' => 1
            ]);

            // kurangi stok
            $this->db->table('buku')
                ->where('id_buku', $id_b)
                ->set('jumlah', 'jumlah-1', false)
                ->update();
        }

        $this->db->transCommit();

        return redirect()->to('/peminjaman')->with('success', 'Berhasil meminjam');
    }

    // ======================
    // ANGGOTA SELESAI
    // ======================
    public function selesai($id_pengembalian)
    {
        $pengembalian = $this->db->table('pengembalian')
            ->where('id_pengembalian', $id_pengembalian)
            ->get()->getRowArray();

        if (!$pengembalian) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $peminjaman = $this->db->table('peminjaman')
            ->where('id_peminjaman', $pengembalian['id_peminjaman'])
            ->get()->getRowArray();

        $today = date('Y-m-d');

        // hitung keterlambatan
        $terlambat = 0;
        if ($today > $peminjaman['tanggal_kembali']) {
            $terlambat = floor((strtotime($today) - strtotime($peminjaman['tanggal_kembali'])) / 86400);
        }

        // ambil buku
        $detail = $this->db->table('detail_peminjaman')
            ->where('id_peminjaman', $peminjaman['id_peminjaman'])
            ->get()->getResultArray();

        $jumlahBuku = count($detail);

        $denda = $terlambat * 5000 * $jumlahBuku;

        // update pengembalian
        $this->db->table('pengembalian')
            ->where('id_pengembalian', $id_pengembalian)
            ->update([
                'status' => 'disetujui',
                'denda' => $denda
            ]);

        // update peminjaman
        $this->db->table('peminjaman')
            ->where('id_peminjaman', $peminjaman['id_peminjaman'])
            ->update([
                'status' => 'dikembalikan'
            ]);

        // kembalikan stok
        foreach ($detail as $d) {
            $this->db->table('buku')
                ->where('id_buku', $d['id_buku'])
                ->set('jumlah', 'jumlah + '.$d['jumlah'], false)
                ->update();
        }

        // simpan denda
        if ($denda > 0) {
            $this->db->table('denda')->insert([
                'id_pengembalian' => $id_pengembalian,
                'total_denda' => $denda,
                'hari_terlambat' => $terlambat,
                'jumlah_buku' => $jumlahBuku,
                'status_bayar' => 'belum'
            ]);

            return redirect()->back()->with('error', 'Terlambat! Denda Rp '.number_format($denda));
        }

        return redirect()->back()->with('success', 'Pengembalian selesai');
    }

    // ======================
    // DETAIL
    // ======================
    public function detail($id)
{
    // ================= DATA UTAMA =================
    $data['peminjaman'] = $this->db->table('peminjaman p')
        ->select('
            p.*,
            u.nama as nama_anggota,
            pt.jabatan as nama_petugas
        ')
        ->join('users u', 'u.id_user = p.id_anggota', 'left')
        ->join('petugas pt', 'pt.id_petugas = p.id_petugas', 'left')
        ->where('p.id_peminjaman', $id)
        ->get()
        ->getRowArray();

    // ❗ CEK kalau data tidak ada
    if (!$data['peminjaman']) {
        return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
    }

    // ================= DETAIL BUKU =================
    $data['detail'] = $this->db->table('detail_peminjaman dp')
        ->select('
            b.judul,
            dp.jumlah
        ')
        ->join('buku b', 'b.id_buku = dp.id_buku', 'left')
        ->where('dp.id_peminjaman', $id)
        ->get()
        ->getResultArray();

    return view('peminjaman/detail', $data);
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