<?php

namespace App\Controllers;

use App\Models\T_Paciente;
use App\Models\T_TipoPer;
use App\Models\T_Personal;
use CodeIgniter\Controller;

class FormaControlador extends Controller
{

    public function __construct()
    {
        helper('form');
        #$this->session = \Config\Service::session();
        #$this->db = \Config\Database::connect();
    }

    public function InPac()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
       }
        echo view('template/navbar', $usuario);
        echo view('USUARIO/IngresoPaciente');
    }

    public function insertarPaciente()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $builder = new T_Paciente($db);
        $data = [
            'Pac_rut' => $this->request->getVar('Pac_rut'),
            'Pac_nom' => $this->request->getVar('Pac_nom'),
            'Pac_edad' => $this->request->getVar('Pac_edad'),
            'Pac_gen' => $this->request->getVar('Pac_gen')
        ];
        if ($builder->insert($data) === false) {

            echo view('template\navbar',$usuario);
            echo view('template\errors',['errors' => $builder->errors()]);
            echo view('USUARIO\IngresoPaciente');
        } else {

            $session->setFlashdata("success", "Data saved successfully");

            return redirect()->to('/index');
        }
    }

    public function InPer()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $verify = $session->get('nom_cuenta');
        $verify_cod = $session->get('Per_tipo');
        if($verify == null || $verify_cod != 2){
            // do something when exist
            return redirect()->to('/unlogged');
       }
        $db = \Config\Database::connect();
        $model = new T_TipoPer($db);
        $personal = $model->findAll();

        $listado['listaPersonal'] = $personal;
        echo view('template/navbar', $usuario);
        echo view('USUARIO/IngresoPersonal', $listado);
    }

    public function insertarPersonal()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
       }
        $db = \Config\Database::connect();
        $table = new T_Personal($db);
        $personal = $table->findAll();
        $autoincrement = sizeof($personal);
        $builder = new T_Personal();
        $model = new T_TipoPer($db);
        $personal = $model->findAll();

        $listado['listaPersonal'] = $personal;
        $listado['errors'] = $builder->errors();
        $data = [
            'Per_cod'   => $autoincrement + 1,
            'Per_nom'   => $this->request->getVar('Per_nom'),
            'Per_edad'  => $this->request->getVar('Per_edad'),
            'Per_gen'   => $this->request->getVar('Per_gen'),
            'Per_tipo'  => $this->request->getVar('Per_tipo'),
            'Per_espec' => $this->request->getVar('Per_espec')
        ];
        if ($builder->insert($data) === false) {

            echo view('template\navbar',$usuario);
            echo view('template\errors',['errors' => $builder->errors()]);
            echo view('USUARIO\IngresoPersonal',$listado);
        } else {

            $session->setFlashdata("success", "Data saved successfully");

            return redirect()->to('/index');
        }
    }
}
