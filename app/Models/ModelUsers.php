<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUsers extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['email', 'username', 'nama_lengkap', 'password_hash', 'jenis_Kelamin', 'no_hp', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir', 'active', 'session_token'];

    public function getUsers()
    {
        $query = $this->table('users')->select('id, email, username');

        return $query;
    }
}