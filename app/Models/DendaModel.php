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
        'jumlah_buku',
        'status_bayar',
        'metode_bayar',
        'tanggal_bayar'
    ];
}