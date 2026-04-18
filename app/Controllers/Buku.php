<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->db = \Config\Database::connect();
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
        // VALIDASI
        $rules = [
            'judul' => 'required',
            'cover' => 'max_size[cover,2048]|ext_in[cover,jpg,jpeg,png,pdf]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal');
        }

        $data = $this->request->getPost();

        // HANDLE UPLOAD COVER
        $file = $this->request->getFile('cover');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/buku/', $namaFile);
            $data['cover'] = $namaFile;
        }

        $this->buku->insert($data);
        $id_buku = $this->buku->getInsertID();

        $this->db->table('buku_rak')->insert([
            'id_buku' => $id_buku,
            'id_rak' => $data['id_rak']
        ]);

        return redirect()->to('/buku');
    }

    public function detail($id)
    {
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
        $builder->where('buku.id_buku', $id);

        $data['buku'] = $builder->get()->getRowArray();

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

public function save()
{
    $kategori_id = $this->getOrInsert('kategori','nama_kategori',$this->request->getPost('kategori_nama'));
    $penulis_id  = $this->getOrInsert('penulis','nama_penulis',$this->request->getPost('penulis_nama'));
    $penerbit_id = $this->getOrInsert('penerbit','nama_penerbit',$this->request->getPost('penerbit_nama'));
    $rak_id      = $this->getOrInsert('rak','nama_rak',$this->request->getPost('rak_nama'));

    $this->buku->save([
        'isbn' => $this->request->getPost('isbn'),
        'judul' => $this->request->getPost('judul'),
        'id_kategori' => $kategori_id,
        'id_penulis' => $penulis_id,
        'id_penerbit' => $penerbit_id,
        'id_rak' => $rak_id,
        'tahun_terbit' => $this->request->getPost('tahun_terbit'),
        'jumlah' => $this->request->getPost('jumlah'),
        'tersedia' => $this->request->getPost('jumlah'),
        'deskripsi' => $this->request->getPost('deskripsi')
    ]);

    return redirect()->to('/buku')->with('success','Data berhasil ditambahkan');
}

    public function update($id)
{
    $kategori_id = $this->getOrInsert('kategori','nama_kategori',$this->request->getPost('kategori_nama'));
    $penulis_id  = $this->getOrInsert('penulis','nama_penulis',$this->request->getPost('penulis_nama'));
    $penerbit_id = $this->getOrInsert('penerbit','nama_penerbit',$this->request->getPost('penerbit_nama'));
    $rak_id      = $this->getOrInsert('rak','nama_rak',$this->request->getPost('rak_nama'));

    $data = [
        'id_buku' => $id,
        'judul' => $this->request->getPost('judul'),
        'isbn' => $this->request->getPost('isbn'),
        'id_kategori' => $kategori_id,
        'id_penulis' => $penulis_id,
        'id_penerbit' => $penerbit_id,
        'id_rak' => $rak_id,
        'tahun_terbit' => $this->request->getPost('tahun_terbit'),
        'jumlah' => $this->request->getPost('jumlah'),
        'tersedia' => $this->request->getPost('tersedia'),
        'deskripsi' => $this->request->getPost('deskripsi'),
    ];

    // upload cover (opsional)
    $file = $this->request->getFile('cover');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/buku', $namaFile);
        $data['cover'] = $namaFile;
    }

    $this->buku->save($data);

    return redirect()->to('/buku')->with('success','Data berhasil diupdate');
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