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
        return view('kategori/index',[
            'kategori'=>$this->model->findAll()
        ]);
    }

    public function create()
    {
        return view('kategori/create');
    }

    public function save()
    {
        $this->model->save($this->request->getPost());
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