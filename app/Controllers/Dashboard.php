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
        $role   = session()->get('role');
        $idUser = session()->get('id_user') ?? session()->get('id');

        // default semua
        $total_users        = $this->db->table('users')->countAllResults();
        $total_buku         = $this->db->table('buku')->countAllResults();
        $total_peminjaman   = $this->db->table('peminjaman')->countAllResults();
        $total_pengembalian = $this->db->table('pengembalian')->countAllResults();
        $total_kategori     = $this->db->table('kategori')->countAllResults();
        $total_rak          = $this->db->table('rak')->countAllResults();

        $denda_belum = $this->db->table('pengembalian')
            ->where('denda >', 0)
            ->countAllResults();

        // KHUSUS ANGGOTA
        if ($role == 'anggota') {

            $total_peminjaman = $this->db->table('peminjaman')
                ->where('id_anggota', $idUser)
                ->countAllResults();

            $total_pengembalian = $this->db->table('pengembalian pg')
                ->join('peminjaman p', 'p.id_peminjaman = pg.id_peminjaman')
                ->where('p.id_anggota', $idUser)
                ->countAllResults();

            $total_buku = $this->db->table('buku')->countAllResults();
        }

        return $this->response->setJSON([
            'total_users'        => $total_users,
            'total_buku'         => $total_buku,
            'total_peminjaman'   => $total_peminjaman,
            'total_pengembalian' => $total_pengembalian,
            'denda_belum'        => $denda_belum,
            'total_kategori'     => $total_kategori,
            'total_rak'          => $total_rak,
        ]);
    }
}