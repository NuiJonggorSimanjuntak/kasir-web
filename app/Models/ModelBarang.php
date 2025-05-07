<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_barang_edit', 'harga_jual_edit', 'harga_beli_edit', 'gambar', 'stok'];

    public function getBarang()
    {
        $query = $this->table('barang')->select('id, nama_barang_edit, harga_jual_edit, harga_beli_edit, gambar, stok');

        return $query;
    }
}