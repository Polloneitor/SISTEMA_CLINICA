<?php

namespace App\Models;

use CodeIgniter\Model;

class T_Cuenta extends Model
{
    protected $table      = 'cuenta';
    protected $primaryKey = 'cod_cuenta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nom_cuenta,pas_cuenta,per_cod'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
                'nom_cuenta'   =>  'required|min_length[15]|string',
                'pas_cuenta'  =>  'required|min_length[15]|string'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function personal()
    {
        $users = $this->select('*')
                ->join('personal', 'personal.Per_cod = cuenta.Per_cod')
                ->findAll();

        return $users;
    }
}

