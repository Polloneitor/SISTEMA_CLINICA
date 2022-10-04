<?php

namespace App\Models;

use CodeIgniter\Model;

class T_Turno extends Model
{
    protected $table      = 'turno';
    protected $primaryKey = 'turn_cod';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Turn_hora_entrada','Turn_hora_salida','Turn_fecha','Turn_tipo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
