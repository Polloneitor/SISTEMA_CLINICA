<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\T_Cuenta;
use App\Models\T_Personal;

class SignupController extends Controller
{
    public function index()

    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $verify = $session->get('isLoggedIn');
        $prio = $session->get('Per_tipo');
        if ($verify == null || $verify == false || $prio != 2) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        helper(['form']);
        $data = [];
        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('USUARIO\signup', $data);
        echo view('template\footer');
    }

    public function store()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $verify = $session->get('isLoggedIn');
        $prio = $session->get('Per_tipo');
        if ($verify == null || $verify == false || $prio != 2) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $MiObjeto = new T_Personal($db);
        $personal =  $MiObjeto->findAll();
        helper(['form']);
        $compare = $this->request->getVar('Per_cod');
        $rules = [
            'nom_cuenta'        => 'required|is_unique[cuenta.nom_cuenta]|min_length[2]|max_length[50]',
            'Per_cod'           => 'required|numeric|is_unique[cuenta.Per_cod]
                                    |matches[personal.Per_cod]'
        ];
        foreach ($personal as $cod) {
            if ($compare == $cod['Per_cod']) {
                $rules['Per_cod'] = 'required|numeric|is_unique[cuenta.Per_cod]';
                break;
            };
        }
        if ($this->validate($rules)) {
            $autoincrement = NULL;
            $db = \Config\Database::connect();
            $table = new T_Cuenta($db);
            $cuentas = $table->findAll();
            if (empty($cuentas)) {
                $autoincrement = 0;
            } else {
                $cuenta =  $table->last_record();
                $array = json_decode(json_encode($cuenta), true);
                $tamanio = $array['cod_cuenta'];
                $autoincrement = $tamanio;
            }
            $data = [
                'cod_cuenta'     => 1 + $autoincrement,
                'nom_cuenta'     => $this->request->getVar('nom_cuenta'),
                'pas_cuenta'     => password_hash('Test', PASSWORD_DEFAULT),
                'Per_cod'        => $this->request->getVar('Per_cod'),
                'firstlogin_cuenta' => 0
            ];
            $builder = $db->table('cuenta');
            $builder->insert($data);
            return redirect()->to('/signin');
        } else {
            $data['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
            $data['S_Per_tipo']  = $session->get('Per_tipo');
            $data['validation'] = $this->validator;
            echo view('template\header');
            echo view('template\navbar', $data);
            echo view('USUARIO\signup', $data);
            echo view('template\footer');
        }
    }
}
