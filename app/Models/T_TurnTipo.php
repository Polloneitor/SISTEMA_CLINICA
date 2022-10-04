<?php

namespace App\Models;

use CodeIgniter\Model;

class T_TurnTipo extends Model
{
    protected $table      = 'tipo_turno';
    protected $primaryKey = 'turn_tipo_cod';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['turn_tipo_nom'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
