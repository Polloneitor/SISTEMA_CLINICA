<?php

namespace App\Models;

use CodeIgniter\Model;

class T_Operacion extends Model
{
    protected $table      = 'operacion';
    protected $primaryKey = 'Op_queue';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Per_tipo','Per_cod','Op_detalle'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
    ];
    protected $validationMessages = [
    ];
    protected $skipValidation     = false;
}
