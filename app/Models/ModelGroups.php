<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGroups extends Model
{
    protected $table            = 'auth_groups';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'description'];

    public function getGroups()
    {
        $query = $this->table('users')->select('id, name, description');

        return $query;
    }
}