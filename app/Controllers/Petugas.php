<?php

namespace App\Controllers;

use App\Models\PetugasModel;

class Petugas extends BaseController
{
    protected $petugas;

    public function __construct()
    {
        $this->petugas = new PetugasModel();
    }

    // =========================
    // INDEX + SEARCH
    // =========================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['petugas'] = $this->petugas
                ->like('jabatan', $keyword)
                ->findAll();
        } else {
            $data['petugas'] = $this->petugas->findAll();
        }

        return view('petugas/index', $data);
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        return view('petugas/create');
    }

    // =========================
    // STORE
    // =========================
    public function store()
    {
        $this->petugas->save([
            'jabatan' => $this->request->getPost('jabatan'),
        ]);

        return redirect()->to('/petugas')->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $data['petugas'] = $this->petugas->find($id);
        return view('petugas/edit', $data);
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $this->petugas->update($id, [
            'jabatan' => $this->request->getPost('jabatan'),
        ]);

        return redirect()->to('/petugas')->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id)
    {
        $this->petugas->delete($id);
        return redirect()->to('/petugas')->with('success', 'Data berhasil dihapus');
    }
}