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

    // ======================
    // STORE (PINJAM)
    // ======================
    public function store()
    {
        $id_anggota = session()->get('id_user');

        // 🔥 AMBIL PETUGAS OTOMATIS
        $petugas = $this->db->table('petugas')->get()->getRowArray();
        $id_petugas = $petugas ? $petugas['id_petugas'] : null;

        if (!$id_petugas) {
            return redirect()->back()->with('error', 'Petugas tidak ditemukan');
        }

        $buku = $this->request->getPost('buku');

        if (!$buku) {
            return redirect()->back()->with('error', 'Pilih minimal 1 buku');
        }

        // ================= INSERT PEMINJAMAN =================
        $this->db->table('peminjaman')->insert([
        'id_anggota' => session()->get('id_user'),
            'id_petugas' => $id_petugas,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+6 days')),
            'status' => 'menunggu'
        ]);

        $id_peminjaman = $this->db->insertID();

        // ================= AUTO INSERT PENGEMBALIAN =================
        $this->db->table('pengembalian')->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_dikembalikan' => null,
            'status' => 'belum',
            'denda' => 0
        ]);

        // ================= DETAIL BUKU =================
        foreach ($buku as $id_buku) {

            // ❗ CEK DUPLIKAT
            $cek = $this->db->table('detail_peminjaman')
                ->where('id_peminjaman', $id_peminjaman)
                ->where('id_buku', $id_buku)
                ->get()
                ->getRowArray();

            if (!$cek) {
                $this->db->table('detail_peminjaman')->insert([
                    'id_peminjaman' => $id_peminjaman,
                    'id_buku' => $id_buku,
                    'jumlah' => 1
                ]);
            }

            // kurangi stok
            $this->db->table('buku')
                ->where('id_buku', $id_buku)
                ->set('jumlah', 'jumlah - 1', false)
                ->update();
        }

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil');
    }

    // ======================
    // SETUJUI
    // ======================
    public function setujui($id)
    {
        $this->db->table('peminjaman')
            ->where('id_peminjaman', $id)
            ->update([
                'status' => 'dipinjam'
            ]);

        return redirect()->back()->with('success', 'Peminjaman disetujui');
    }

    // ======================
    // PERPANJANG
    // ======================
    public function requestPerpanjang($id_peminjaman)
    {
        $peminjaman = $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if ($peminjaman['jumlah_perpanjang'] >= 2) {
            return redirect()->back()->with('error', 'Maksimal 2x perpanjang');
        }

        if ($peminjaman['status_perpanjang'] == 'menunggu') {
            return redirect()->back()->with('error', 'Masih diproses');
        }

        $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->update([
                'status_perpanjang' => 'menunggu'
            ]);

        return redirect()->back()->with('success', 'Permintaan dikirim');
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

        $tanggal_baru = date('Y-m-d', strtotime($p['tanggal_kembali'] . ' +7 days'));

        $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->update([
                'tanggal_kembali' => $tanggal_baru,
                'jumlah_perpanjang' => $p['jumlah_perpanjang'] + 1,
                'status_perpanjang' => 'disetujui'
            ]);

        return redirect()->back()->with('success', 'Disetujui');
    }

    // ======================
    // DETAIL
    // ======================
    public function detail($id)
    {
        $data['peminjaman'] = $this->db->table('peminjaman p')
            ->select('p.*, u.nama as nama_anggota')
            ->join('users u', 'u.id_user = p.id_anggota', 'left')
            ->where('p.id_peminjaman', $id)
            ->get()
            ->getRowArray();

        if (!$data['peminjaman']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

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