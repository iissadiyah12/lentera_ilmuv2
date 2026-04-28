<?php

namespace App\Controllers;

use Config\Database;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index(): string
    {
        $role   = session()->get('role');
        $idUser = session()->get('id_user') ?? session()->get('id');

        $data['total_users']        = $this->db->table('users')->countAllResults();
        $data['total_buku']         = $this->db->table('buku')->countAllResults();
        $data['total_peminjaman']   = $this->db->table('peminjaman')->countAllResults();
        $data['total_pengembalian'] = $this->db->table('pengembalian')->countAllResults();
        $data['total_kategori']     = $this->db->table('kategori')->countAllResults();
        $data['total_rak']          = $this->db->table('rak')->countAllResults();

        if ($role == 'anggota') {
            $data['total_peminjaman'] = $this->db->table('peminjaman')
                ->where('id_anggota', $idUser)
                ->countAllResults();

            $data['total_pengembalian'] = $this->db->table('pengembalian pg')
                ->join('peminjaman p', 'p.id_peminjaman = pg.id_peminjaman')
                ->where('p.id_anggota', $idUser)
                ->countAllResults();
        }

        return view('layouts/dashboard', $data);
    }

    public function realtime()
    {
        $role   = session()->get('role');
        $idUser = session()->get('id_user') ?? session()->get('id');

        $total_users        = $this->db->table('users')->countAllResults();
        $total_buku         = $this->db->table('buku')->countAllResults();
        $total_peminjaman   = $this->db->table('peminjaman')->countAllResults();
        $total_pengembalian = $this->db->table('pengembalian')->countAllResults();
        $total_kategori     = $this->db->table('kategori')->countAllResults();
        $total_rak          = $this->db->table('rak')->countAllResults();

        if ($role == 'anggota') {

            $total_peminjaman = $this->db->table('peminjaman')
                ->where('id_anggota', $idUser)
                ->countAllResults();

            $total_pengembalian = $this->db->table('pengembalian pg')
                ->join('peminjaman p', 'p.id_peminjaman = pg.id_peminjaman')
                ->where('p.id_anggota', $idUser)
                ->countAllResults();
        }

        return $this->response->setJSON([
            'total_users'        => $total_users,
            'total_buku'         => $total_buku,
            'total_peminjaman'   => $total_peminjaman,
            'total_pengembalian' => $total_pengembalian,
            'total_kategori'     => $total_kategori,
            'total_rak'          => $total_rak
        ]);
    }
}