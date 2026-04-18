<?php

namespace App\Controllers;
use App\Models\penerbitModel;

class Penerbit extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenerbitModel();
    }

    public function index()
    {
        return view('penerbit/index',[
            'data'=>$this->model->findAll()
        ]);
    }

    public function create()
    {
        return view('penerbit/create');
    }

    public function save()
    {
        $this->model->save($this->request->getPost());
        return redirect()->to('/penerbit');
    }

    public function edit($id)
    {
        return view('penerbit/edit',[
            'row'=>$this->model->find($id)
        ]);
    }

    public function update($id)
    {
        $this->model->save([
            'id_penerbit'=>$id,
            'nama_penerbit'=>$this->request->getPost('nama_penerbit'),
            'alamat'=>$this->request->getPost('alamat')
        ]);
        return redirect()->to('/penerbit');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penerbit');
    }
}