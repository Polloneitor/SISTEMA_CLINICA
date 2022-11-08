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
        $query = $builder->select("COUNT(Per_cod) as Personal, Per_tipo");
        $query = $builder->where("GROUP BY Per_tipo")->get();
        $personal = $query->getResult();
        $lista = [];
        foreach ($personal as $row) {
            $lista[] = array(
                'personal'   => $row->Per_tipo,
            );
        }

        $data['listado'] = ($lista);
        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('USUARIO\chart', $data);
        echo view('template\footer');
        echo view('template\background');
    }
}
