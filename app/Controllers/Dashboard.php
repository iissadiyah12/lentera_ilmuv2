<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;

class Dashboard extends BaseController
{
    protected $users;
    protected $buku;
    protected $peminjaman;
    protected $pengembalian;
    protected $db;

    public function index()
    {
        $usersModel = new UsersModel();
        $bukuModel = new BukuModel();
        $pinjamModel = new PeminjamanModel();
        $kembaliModel = new PengembalianModel();

        $data = [
            'total_users' => $usersModel->countAll(),
            'total_buku' => $bukuModel->countAll(),
            'total_peminjaman' => $pinjamModel->countAll(),
            'total_pengembalian' => $kembaliModel->countAll(),

            // sementara jika belum ada logic khusus
            'denda_belum' => 0,
            'total_kategori' => 0,
            'total_rak' => 0,
        ];

        return view('dashboard', $data);
    }

    // REALTIME AJAX
    public function realtime()
    {
        return $this->response->setJSON([
            'total_users' => $this->db->table('users')->countAllResults(),
            'total_buku' => $this->db->table('buku')->countAllResults(),
            'total_peminjaman' => $this->db->table('peminjaman')->countAllResults(),
            'total_pengembalian' => $this->db->table('pengembalian')->countAllResults(),
            'denda_belum' => $this->db->table('denda')
                ->where('status_bayar', 'belum')
                ->countAllResults(),
            'total_kategori' => $this->db->table('kategori')->countAllResults(),
            'total_rak' => $this->db->table('rak')->countAllResults(),
        ]);
    }
}