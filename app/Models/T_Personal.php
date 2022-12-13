<?php

namespace App\Models;

use CodeIgniter\Model;

class T_Personal extends Model
{
    protected $table      = 'personal';
    protected $primaryKey = 'Per_cod';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Per_nom', 'Per_edad', 'Per_gen', 'Per_tipo', 'Per_espec', 'Per_email'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'Per_nom'   =>  'required|max_length[30]|string',
        'Per_edad'  =>  'required|numeric|greater_than[17]',
        'Per_gen'   =>  'required|exact_length[1]',
        'Per_tipo'  =>  'required',
        'Per_email'  =>  'required'
    ];
    protected $validationMessages = [
        'Per_nom' => [
            'required' => 'Este campo requiere de un nombre',
            'max_length' => 'Este campo solo tiene una capacidad de 30 cáracteres',
            'string' => 'Este campo solo admite letras, no número o carácteres especiales'
        ],
        'Per_edad'  => [
            'required' => 'Este campo requiere de un valor númerico a completar',
            'greater_than'  => 'Solo se admiten personas cuyas edades son desde los 18 años.',
            'numeric' => 'Este campo debe consistir de números.'
        ],
        'Per_gen' => [
            'required' => 'Este campo requiere de un género a especificar.',
            'exact_length'  => 'Usar una sola letra para este campo'
        ],
        'Per_tipo' => [
            'required' => 'Se requiere saber el tipo de ocupación que empleará el personal'
        ],
        'Per_email' => [
            'required' => 'Se requiere un correo eléctronico.'
        ]
    ];
    protected $skipValidation     = false;

    function updatedata($data, $id)
    {
        $this->db->table('personal')->set($data)->where('Per_cod', $id)->update();
    }

    public function tipoPersonal()
    {
        $users = $this->select('*')
            ->join('tipo_personal', 'tipo_personal.Per_tipo = personal.Per_tipo')
            ->findAll();

        return $users;
    }
    public function last_record()
    {
        $query = $this->db->query("SELECT * FROM personal ORDER BY Per_cod DESC LIMIT 1");
        $result = $query->getFirstRow();
        return $result;
    }
    public function find_email($id)
    {
        $query = $this->db->query("SELECT Per_email FROM personal WHERE Per_cod = $id");
        $result = $query->getFirstRow();
        $return = json_decode(json_encode($result), true);
        return $return;
    }
}
