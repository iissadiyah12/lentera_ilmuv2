<?php

namespace App\Controllers;
use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenerbitModel();
    }

   public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['penerbit'] = $this->model
            ->like('nama_penerbit', $keyword)
            ->orLike('alamat', $keyword)
            ->findAll();
    } else {
        $data['penerbit'] = $this->model->findAll();
    }

    return view('penerbit/index', $data);
}

    public function create()
    {
        return view('penerbit/create');
    }

    public function store()
{
    $this->model->save([
        'nama_penerbit' => $this->request->getPost('nama_penerbit'),
        'alamat' => $this->request->getPost('alamat') // tambahin ini juga
    ]);

    return redirect()->to('/penerbit');
}

   public function edit($id)
{
    $db = \Config\Database::connect();

    $data['penerbit'] = $db->table('penerbit')
        ->where('id_penerbit', $id)
        ->get()
        ->getRowArray();

    return view('penerbit/edit', $data);
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