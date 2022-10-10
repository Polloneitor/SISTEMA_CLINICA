<?php

namespace App\Models;

use CodeIgniter\Model;

class T_Personal extends Model
{
    protected $table      = 'personal';
    protected $primaryKey = 'Per_cod';

    protected $useAutoIncrement = True;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Per_nom', 'Per_edad', 'Per_gen','Per_tipo','Per_espec'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
                'Per_nom'   =>  'required|max_length[30]|string',
                'Per_edad'  =>  'required|numeric',
                'Per_gen'   =>  'required|exact_length[1]',
                'Per_tipo'  =>  'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function tipoPersonal()
    {
        $users = $this->select('*')
                ->join('tipo_personal', 'tipo_personal.Per_tipo = personal.Per_tipo')
                ->findAll();

        return $users;
    }
}

