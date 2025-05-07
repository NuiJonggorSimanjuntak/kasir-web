<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'ket_beli', 'total_beli', 'is_read', 'status'];

    public function getTransaksi()
    {
        $query = $this->table('transaksi')->select('id, user_id, ket_beli, total_beli, is_read, status');

        return $query;
    }
}