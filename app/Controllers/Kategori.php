<?php

namespace App\Controllers;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new KategoriModel();
    }

    public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['kategori'] = $this->model
            ->like('nama_kategori', $keyword)
            ->findAll();
    } else {
        $data['kategori'] = $this->model->findAll();
    }

    return view('kategori/index', $data);
}

    public function create()
    {
        return view('kategori/create');
    }

   public function store()
{
    $this->model->save([
        'nama_kategori' => $this->request->getPost('nama_kategori')
    ]);

    return redirect()->to('/kategori');
}

    public function edit($id)
    {
        return view('kategori/edit',[
            'row'=>$this->model->find($id)
        ]);
    }

    public function update($id)
    {
        $this->model->save([
            'id_kategori'=>$id,
            'nama_kategori'=>$this->request->getPost('nama_kategori')
        ]);
        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/kategori');
    }
}