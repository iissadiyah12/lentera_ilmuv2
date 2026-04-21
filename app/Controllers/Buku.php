<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\BukuRakModel;

$rakBukuModel = new BukuRakModel();

class Buku extends BaseController

{
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->db = \Config\Database::connect();
    }
    private function getOrInsert($table, $field, $value)
    {
        $db = \Config\Database::connect();

        $data = $db->table($table)
                ->where($field, $value)
                ->get()
                ->getRowArray();

        if ($data) {
            return $data['id_'.$table];
        } else {
            $db->table($table)->insert([$field => $value]);
            return $db->insertID();
        }
    }
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->db->table('buku');
        $builder->select('
            buku.*,
            kategori.nama_kategori,
            penulis.nama_penulis,
            penerbit.nama_penerbit,
            rak.nama_rak,
            rak.lokasi
        ');
        $builder->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
        $builder->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left');
        $builder->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left');
        $builder->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left');
        $builder->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left');

        if ($keyword) {
            $builder->like('buku.judul', $keyword);
        }

        $data['buku'] = $builder->get()->getResultArray();

        return view('buku/index', $data);
    }

    public function create()
    {
        $data['kategori'] = $this->db->table('kategori')->get()->getResultArray();
        $data['penulis'] = $this->db->table('penulis')->get()->getResultArray();
        $data['penerbit'] = $this->db->table('penerbit')->get()->getResultArray();
        $data['rak'] = $this->db->table('rak')->get()->getResultArray();

        return view('buku/create', $data);
    }

 public function store()
{
    $data = $this->request->getPost();

    // ================= UPLOAD COVER =================
    $file = $this->request->getFile('cover');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/buku/', $namaFile);
        $data['cover'] = $namaFile;
    }

    // ================= UPLOAD PDF =================
    $filePdf = $this->request->getFile('file_pdf');

    if ($filePdf && $filePdf->isValid() && !$filePdf->hasMoved()) {
        $namaPdf = $filePdf->getRandomName();
        $filePdf->move('uploads/buku/baca/', $namaPdf);

        // simpan ke database
        $data['file_pdf'] = $namaPdf;
    }

    // ================= SIMPAN KE DATABASE =================
    $this->buku->insert($data);

    return redirect()->to('/buku')->with('success', 'Data berhasil disimpan');
}
public function baca($id)
{
    $buku = $this->db->table('buku')
        ->where('id_buku', $id)
        ->get()
        ->getRowArray();

    if (!$buku) {
        echo "Buku tidak ditemukan";
        die;
    }

    if (empty($buku['file_pdf'])) {
        echo "File PDF tidak ada";
        die;
    }

    $path = FCPATH . 'uploads/buku/baca/' . $buku['file_pdf'];

    if (!file_exists($path)) {
        echo "File tidak ditemukan di folder";
        die;
    }

    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'inline; filename="'.$buku['file_pdf'].'"')
        ->setBody(file_get_contents($path));
}

    public function detail($id)
{
    $data['buku'] = $this->db->table('buku')
        ->select('
            buku.*, 
            kategori.nama_kategori, 
            penulis.nama_penulis, 
            penerbit.nama_penerbit, 
            rak.nama_rak,
            rak.lokasi
        ')
        ->join('kategori', 'kategori.id_kategori=buku.id_kategori', 'left')
        ->join('penulis', 'penulis.id_penulis=buku.id_penulis', 'left')
        ->join('penerbit', 'penerbit.id_penerbit=buku.id_penerbit', 'left')
        ->join('rak', 'rak.id_rak=buku.id_rak', 'left')
        ->where('buku.id_buku', $id)
        ->get()
        ->getRowArray();

    return view('buku/detail', $data);
}

    public function edit($id)
    {
        $data['buku'] = $this->buku->find($id);
        $data['kategori'] = $this->db->table('kategori')->get()->getResultArray();
        $data['penulis'] = $this->db->table('penulis')->get()->getResultArray();
        $data['penerbit'] = $this->db->table('penerbit')->get()->getResultArray();
        $data['rak'] = $this->db->table('rak')->get()->getResultArray();

        return view('buku/edit', $data);
    }


public function update($id)
{
    $rakBukuModel = new BukuRakModel();

    $data = $this->request->getPost();
    $id_rak = $this->request->getPost('id_rak');

    // upload cover
    $file = $this->request->getFile('cover');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/buku', $namaFile);
        $data['cover'] = $namaFile;
    }

    // update buku
    $this->buku->update($id, $data);

    // hapus relasi lama
    $rakBukuModel->where('id_buku', $id)->delete();

    // insert relasi baru
    if (!empty($id_rak)) {
        $rakBukuModel->insert([
            'id_buku' => $id,
            'id_rak'  => $id_rak
        ]);
    }

    $rakNama = $this->request->getPost('rak_nama');

// cari rak berdasarkan nama
$rak = $this->db->table('rak')
    ->where('nama_rak', $rakNama)
    ->get()
    ->getRowArray();

// jika belum ada → insert
if (!$rak && $rakNama) {
    $this->db->table('rak')->insert([
        'nama_rak' => $rakNama,
        'lokasi' => '-' // default
    ]);

    $id_rak = $this->db->insertID();
} else {
    $id_rak = $rak['id_rak'] ?? null;
}

// masukkan ke data buku
$data['id_rak'] = $id_rak;

$penulisNama = $this->request->getPost('penulis_nama');

// cari penulis
$penulis = $this->db->table('penulis')
    ->where('nama_penulis', $penulisNama)
    ->get()
    ->getRowArray();

// kalau belum ada → insert
if (!$penulis && $penulisNama) {
    $this->db->table('penulis')->insert([
        'nama_penulis' => $penulisNama
    ]);

    $id_penulis = $this->db->insertID();
} else {
    $id_penulis = $penulis['id_penulis'] ?? null;
}

// masukkan ke buku
$data['id_penulis'] = $id_penulis;
    return redirect()->to('/buku');
}
    public function delete($id)
    {
        $buku = $this->buku->find($id);

        if ($buku['cover'] && file_exists('uploads/buku/' . $buku['cover'])) {
            unlink('uploads/buku/' . $buku['cover']);
        }

        $this->buku->delete($id);

        return redirect()->to('/buku');
    }

    public function print()
    {
        $data['buku'] = $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->get()->getResultArray();

        return view('buku/print', $data);
    }

    public function wa($id)
    {
        $buku = $this->detailData($id);

        $pesan = "DATA BUKU\n\n";
        foreach ($buku as $key => $value) {
            $pesan .= strtoupper($key) . ": " . $value . "\n";
        }

        return redirect()->to("https://wa.me/6285175017991?text=" . urlencode($pesan));
    }

    private function detailData($id)
    {
        return $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->where('buku.id_buku', $id)
            ->get()->getRowArray();
    }
}