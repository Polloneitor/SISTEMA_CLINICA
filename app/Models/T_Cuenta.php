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

    protected $allowedFields = ['nom_cuenta,pas_cuenta,Per_cod,firstlogin_cuenta'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'nom_cuenta'   =>  'required|min_length[15]|string',
        'pas_cuenta'  =>  'required|min_length[15]|string',
        'Per_cod'   => 'required|matches[personal.Per_cod]'
    ];
    protected $validationMessages = [
        'nom_cuenta' => [
            'required' => 'Se requiere un nombre de cuenta',
            'min_length' => 'El nombre de cuenta tiene que tener mínimo 15 carácteres',
            'string' => 'Tiene que contener carácteres alfabéticos'
        ],
        'pas_cuenta' => [
            'required' => 'Se requiere una contraseña',
            'min_length' => 'La contraseña de la cuenta tiene que tener mínimo 15 carácteres',
            'string' => 'Tiene que contener carácteres alfabéticos'
        ]
    ];
    protected $skipValidation     = false;

    public function personal()
    {
        $users = $this->select('*')
            ->join('personal', 'personal.Per_cod = cuenta.Per_cod')
            ->findAll();

        return $users;
    }
    public function updatePass(int $cod, string $pass)
    {
        $this->builder->set('pas_cuenta', $pass)
            ->where('cod_cuenta', $cod)
            ->update();
        $this->builder->set('firstlogin_cuenta', 1)
            ->where('cod_cuenta', $cod)
            ->update();
    }

    public function last_record()
    {
        $query = $this->db->query("SELECT * FROM cuenta ORDER BY cod_cuenta DESC LIMIT 1");
        $result = $query->getFirstRow();
        return $result;
    }
}
