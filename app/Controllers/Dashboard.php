<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        
        // CHART: buku paling sering dipinjam
        $query = $this->db->table('peminjaman')
            ->select('buku.judul, COUNT(peminjaman.id_buku) as total')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->groupBy('peminjaman.id_buku')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data = [
            'total_users' => $this->db->table('users')->countAllResults(),
            'total_buku' => $this->db->table('buku')->countAllResults(),
            'total_peminjaman' => $this->db->table('peminjaman')->countAllResults(),
            'total_pengembalian' => $this->db->table('pengembalian')->countAllResults(),

            'buku_label' => array_column($query, 'judul'),
            'buku_total' => array_column($query, 'total'),
        ];

            return view('dashboard/index', $data);    }

    public function realtime()
    {
        return $this->response->setJSON([
            'total_users' => $this->db->table('users')->countAllResults(),
            'total_buku' => $this->db->table('buku')->countAllResults(),
            'total_peminjaman' => $this->db->table('peminjaman')->countAllResults(),
            'total_pengembalian' => $this->db->table('pengembalian')->countAllResults(),
        ]);
    }
}