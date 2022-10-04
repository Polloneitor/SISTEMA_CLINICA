<?php

namespace App\Models;

use CodeIgniter\Model;

class T_Paciente extends Model
{
    protected $table      = 'paciente';
    protected $primaryKey = 'Pac_rut';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Pac_nom','Pac_edad','Pac_gen'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
                'Pac_nom'   =>  'required|max_length[30]',
                'Pac_edad'  =>  'required|numeric',
                'Pac_gen'   =>  'required|exact_length[1]'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
