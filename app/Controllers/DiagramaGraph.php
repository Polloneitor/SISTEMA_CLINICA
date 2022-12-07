<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DiagramaGraph extends Controller
{
    public function index()
    {
        return view('chart');
    }

    public function initChart()
    {

        $session = session();
        $usuario['nom_cuenta']  = $session->get('nom_cuenta');
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $builder = $db->table('personal');
        $builder->selectCount("Per_cod");
        $builder->where("Per_cod >", 100);
        $builder->join("tipo_personal", "personal.Per_tipo = tipo_personal.tipo_cod");
        $builder->groupBy("Per_tipo");
        $query = $builder->get()->getResultArray();
        for ($x = 0; $x <= 2; $x++) {
            switch ($x) {
                case 0:
                    $data['SALUD'] = $query[$x];
                    //print_r($data['SALUD']);
                    break;
                case 1:
                    $data['TECNICO'] = $query[$x];
                    //print_r($data['TECNICO']);
                    break;
                case 2:
                    $data['LIMPIEZA'] = $query[$x];
                    //print_r($data['LIMPIEZA']);
                    break;
            }
        }
        $Salud = $db->table('operacion');
        $Salud->selectCount("Op_queue");
        $Salud->where("Per_tipo =", 1);
        $SumSalud = $Salud->get()->getResultArray();

        $data['SumSalud'] =  $SumSalud;

        $Tecnico = $db->table('operacion');
        $Tecnico->selectCount("Op_queue");
        $Tecnico->where("Per_tipo =", 2);
        $SumTecnico = $Tecnico->get()->getResultArray();
        
        $data['SumTecnico'] =  $SumTecnico;
        $Limpieza = $db->table('operacion');
        $Limpieza->selectCount("Op_queue");
        $Limpieza->where("Per_tipo =", 3);
        $SumLimpieza = $Limpieza->get()->getResultArray();

        $data['SumLimpieza'] =  $SumLimpieza;

        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('USUARIO\chart',$data);
        echo view('template\footer');
        echo view('template\background');
    }
}
