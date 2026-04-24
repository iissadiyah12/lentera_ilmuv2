<?php

namespace App\Controllers;

use App\Models\DendaModel;

class Denda extends BaseController
{
    protected $denda;
    protected $db;

    public function __construct()
    {
        $this->denda = new DendaModel();
        $this->db = \Config\Database::connect();
    }

    // ======================
    // LIST DENDA
    // ======================
    public function index()
    {
        $builder = $this->db->table('denda d');
        $builder->select('d.*, u.nama');
        $builder->join('peminjaman p', 'p.id_peminjaman = d.id_peminjaman');
        $builder->join('users u', 'u.id_user = p.id_anggota');

        $data['denda'] = $builder->get()->getResultArray();

        return view('denda/index', $data);
    }

    // ======================
    // BAYAR DENDA
    // ======================
    public function bayar($id)
    {
        $metode = $this->request->getPost('metode');

        $this->denda->update($id, [
            'status_bayar' => 'lunas',
            'metode_bayar' => $metode,
            'tanggal_bayar' => date('Y-m-d')
        ]);

        return redirect()->to('/denda')->with('success', 'Denda berhasil dibayar');
    }
}