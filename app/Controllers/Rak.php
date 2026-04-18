<?php

namespace App\Controllers;
use App\Models\RakModel;

class Rak extends BaseController
{
    protected $rak;

    public function __construct()
    {
        $this->rak = new RakModel();
    }

    public function index()
    {
        return view('rak/index',[
            'rak'=>$this->rak->findAll()
        ]);
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

    public function edit($id)
    {
        return view('rak/edit',[
            'rak'=>$this->rak->find($id)
        ]);
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

    public function delete($id)
    {
        $this->rak->delete($id);
        return redirect()->to('/rak')->with('success','Data dihapus');
    }
}