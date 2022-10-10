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
                'Pac_rut'   =>  'required|exact_length[9]|is_unique',
                'Pac_nom'   =>  'required|max_length[30]|string',
                'Pac_edad'  =>  'required|numeric',
                'Pac_gen'   =>  'required|exact_length[1]'
    ];
    protected $validationMessages = [
        'Pac_rut' => [
            'required'  => 'Este campo requiere el número RUT de la cédula de identificación',
            'is_unique' => 'Este campo requiere ser único por paciente',
            'exact_lnegth' => 'Este campo requiere de un RUT válido'
        ],
        'Pac_nom' => [
            'required'      => 'Este campo requiere de un nombre para identificar en la base de datos',
            'max_length'    => 'Este campo debe ser máximo 30 cáracteres',
            'string'        =>  'Este campo debe constar de letras, no números o cáracteres especiales'
        ],
        'Pac_edad' =>[
            'required'  => 'Este campo requiere de una edad obligatoria',
            'numeric'   => 'Este campo debe consistir de solo números'
        ],
        'Pac_gen'   =>[
            'required'      =>'Se necesita especificar un género',
            'exact_length'  =>'Usar una sola letra para este campo'
        ]
    ];
    protected $skipValidation     = false;
}
