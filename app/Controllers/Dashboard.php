<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Dashboard extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index()
    {
        return view('dashboard/index');
    }

    public function realtime()
    {
        $data = [
            'total_users' => $this->db->table('users')->countAllResults(),
            'total_buku' => $this->db->table('buku')->countAllResults(),
            'total_peminjaman' => $this->db->table('peminjaman')->countAllResults(),
            'total_pengembalian' => $this->db->table('pengembalian')->countAllResults(),
            'denda_belum' => $this->db->table('denda')
                                ->where('status_bayar', 'belum')
                                ->countAllResults(),
            'total_kategori' => $this->db->table('kategori')->countAllResults(),
            'total_rak' => $this->db->table('rak')->countAllResults(),
        ];

        return $this->response->setJSON($data);
    }
}