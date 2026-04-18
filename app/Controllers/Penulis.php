<?php

namespace App\Controllers;
use App\Models\PenulisModel;

class Penulis extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenulisModel();
    }

    public function index()
    {
        return view('penulis/index',[
            'data'=>$this->model->findAll()
        ]);
    }

    public function create()
    {
        return view('penulis/create');
    }

    public function save()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/penulis');
    }

    public function edit($id)
    {
        return view('penulis/edit',[
            'row'=>$this->model->find($id)
        ]);
    }

    public function update($id)
    {
        $this->model->save([
            'id_penulis'=>$id,
            'nama_penulis'=>$this->request->getPost('nama_penulis')
        ]);
        return redirect()->to('/penulis');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penulis');
    }
}