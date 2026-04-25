<?php

namespace App\Controllers;

use App\Models\DendaModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;

class Denda extends BaseController
{
    protected $dendaModel;
    protected $peminjamanModel;
    protected $pengembalianModel;

    public function __construct()
    {
        $this->dendaModel = new DendaModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->pengembalianModel = new PengembalianModel();
    }

    // ================= LIST + SEARCH =================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $data = [
            'denda' => $this->dendaModel->getDenda($keyword)
        ];

        return view('denda/index', $data);
    }

    // ================= HITUNG & SIMPAN OTOMATIS =================
    public function generate($id_pengembalian)
    {
        $pengembalian = $this->pengembalianModel
            ->select('pengembalian.*, peminjaman.tanggal_kembali')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
            ->where('id_pengembalian', $id_pengembalian)
            ->first();

        $tgl_kembali = $pengembalian['tanggal_kembali'];
        $tgl_dikembalikan = $pengembalian['tanggal_dikembalikan'];

        $selisih = (strtotime($tgl_dikembalikan) - strtotime($tgl_kembali)) / 86400;

        $hari_terlambat = ($selisih > 0) ? $selisih : 0;
        $total_denda = $hari_terlambat * 3000;

        $this->dendaModel->insert([
            'id_pengembalian' => $id_pengembalian,
            'hari_terlambat' => $hari_terlambat,
            'total_denda' => $total_denda,
            'status_bayar' => 'belum'
        ]);

        return redirect()->to('/denda')->with('success', 'Denda berhasil dibuat');
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $this->dendaModel->update($id, [
            'status_bayar' => $this->request->getPost('status_bayar'),
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'tanggal_bayar' => date('Y-m-d')
        ]);

        return redirect()->to('/denda');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->dendaModel->delete($id);
        return redirect()->to('/denda');
    }
}