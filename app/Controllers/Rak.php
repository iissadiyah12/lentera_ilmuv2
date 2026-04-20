<?php

namespace App\Controllers;
use App\Models\RakModel;

class Rak extends BaseController
{
    protected $rak;

    public function __construct()
    {
        $this->rak= new RakModel();
    }

    public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['rak'] = $this->rak
            ->like('nama_rak', $keyword)
            ->orLike('lokasi', $keyword)
            ->findAll();
    } else {
        $data['rak'] = $this->rak->findAll();
    }

    return view('rak/index', $data);
}
    public function create()
    {
        return view('rak/create');
    }

    public function save()
    {
        $this->rak->save($this->request->getPost());
        return redirect()->to('/rak')->with('success','Data rak ditambahkan');
    }

   public function store()
{
    $this->rak->save([
        'nama_rak' => $this->request->getPost('nama_rak'),
        'lokasi' => $this->request->getPost('lokasi'),
    ]);

    return redirect()->to('/rak');
}
        public function edit($id)
        {
            $data['rak'] = $this->rak->find($id);
            return view('rak/edit', $data);
        }

        public function delete($id)
        {
            $this->rak->delete($id);
            return redirect()->to('/rak');
        }
    public function update($id)
    {
        $this->rak->save([
            'id_rak'=>$id,
            'nama_rak'=>$this->request->getPost('nama_rak'),
            'lokasi'=>$this->request->getPost('lokasi')
        ]);
        return redirect()->to('/rak')->with('success','Data diupdate');
    }

}