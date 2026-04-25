<?php

namespace App\Models;

use CodeIgniter\Model;

class DendaModel extends Model
{
    protected $table = 'denda';
    protected $primaryKey = 'id_denda';
    protected $allowedFields = [
        'id_pengembalian',
        'total_denda',
        'hari_terlambat',
        'status_bayar',
        'metode_bayar',
        'tanggal_bayar'
    ];

    // JOIN ke pengembalian + peminjaman + buku
    public function getDenda($keyword = null)
    {
        $builder = $this->db->table('denda d')
            ->select('d.*, p.id_peminjaman, pg.tanggal_dikembalikan')
            ->join('pengembalian pg', 'pg.id_pengembalian = d.id_pengembalian')
            ->join('peminjaman p', 'p.id_peminjaman = pg.id_peminjaman');

        if ($keyword) {
            $builder->where('d.id_pengembalian', $keyword);
        }

        return $builder->get()->getResultArray();
    }
}