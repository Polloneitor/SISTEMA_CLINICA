<?php

namespace App\Controllers;

use App\Models\T_Paciente;
use App\Models\T_TipoPer;
use App\Models\T_Personal;
use App\Models\T_Operacion;
use CodeIgniter\Controller;

class FormaControlador extends BaseController
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
        $S_Per_cod = $session->get('Per_tipo');
        switch ($S_Per_cod) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                return redirect()->to('/unlogged');
                break;
        }
        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('USUARIO\IngresoPaciente');
        echo view('template\footer');
        echo view('template\background');
    }

    public function insertarPaciente()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $S_Per_cod = $session->get('Per_tipo');
        $usuario['Per_cod']  = $session->get('Per_cod');
        switch ($S_Per_cod) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                return redirect()->to('/unlogged');
                break;
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

            echo view('template\header');
            echo view('template\navbar', $usuario);
            echo view('template\errors', ['errors' => $builder->errors()]);
            echo view('USUARIO\IngresoPaciente');
            echo view('template\footer');
            echo view('template\background');
        } else {
            $db = \Config\Database::connect();
            $op = new T_Operacion($db);
            $dataTemp = [
                'Per_tipo' => $usuario['S_Per_tipo'],
                'Per_cod'  => $usuario['Per_cod'],
                'Op_detalle'  => 'Se ingresó un paciente nuevo.'
             ];
            $op->insert($dataTemp);
            $session->setFlashdata("success", "Data saved successfully");

            return redirect()->to('/index');
        }
    }

    public function InPer()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $verify = $session->get('isLoggedIn');
        $verify_cod = $session->get('Per_tipo');
        if (($verify == null || $verify == false) || $verify_cod != 2) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $model = new T_TipoPer($db);
        $personal = $model->findAll();

        $listado['listaPersonal'] = $personal;
        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('USUARIO\IngresoPersonal', $listado);
        echo view('template\footer');
        echo view('template\background');
    }

    public function insertarPersonal()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $usuario['Per_cod']  = $session->get('Per_cod');
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false || $usuario['S_Per_tipo'] != 2) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $builder = new T_Personal($db);
        $model = new T_TipoPer($db);
        $personal = $model->findAll();

        $listado['listaPersonal'] = $personal;
        $listado['errors'] = $builder->errors();
        $data = [
            'Per_nom'   => $this->request->getVar('Per_nom'),
            'Per_edad'  => $this->request->getVar('Per_edad'),
            'Per_gen'   => $this->request->getVar('Per_gen'),
            'Per_tipo'  => $this->request->getVar('Per_tipo'),
            'Per_espec' => $this->request->getVar('Per_espec'),
            'Per_email' => $this->request->getVar('Per_email')
        ];
        if ($builder->insert($data) === false) {

            echo view('template\header');
            echo view('template\navbar', $usuario);
            echo view('template\errors', ['errors' => $builder->errors()]);
            echo view('USUARIO\IngresoPersonal', $listado);
            echo view('template\footer');
            echo view('template\background');
        } else {

            $db = \Config\Database::connect();
            $op = new T_Operacion($db);
            $dataTemp = [
                'Per_tipo' => $usuario['S_Per_tipo'],
                'Per_cod'  => $usuario['Per_cod'],
                'Op_detalle'  => 'Se ingresó un personal nuevo.'
             ];
            $op->insert($dataTemp);
            $session->setFlashdata("success", "Data saved successfully");
            $email = \Config\Services::email();
            $email->setTo($data['Per_email']);
            $email->setFrom('diego.aguilar@alumnos.upla.cl', 'Sistema Clinica');

            $email->setSubject('Bienvenido al Sistema Clinico.');
            $email->setMessage('Se ha registrado datos personales 
                                para su nuevo empleo, se le hará saber cuando
                                estará habilitado en el sistema en este correo.');
            if ($email->send()) {
                return redirect()->to('/infoPer');
            } else {
                $data = $email->printDebugger(['headers']);
                print_r($data);
                sleep(10);
                return redirect()->to('/index');
            }
            return redirect()->to('/infoPer');
        }
    }
    public function QRinfo($Per_cod = NULL)
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false || $usuario['S_Per_tipo'] != 2) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $MiObjeto = new T_Personal($db);
        $data =  $MiObjeto->find($Per_cod);

        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('template\newpersonal', $data);
        echo view('template\footer');
        echo view('template\background');
    }

    public function info()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false || $usuario['S_Per_tipo'] != 2) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $MiObjeto = new T_Personal($db);
        $personal =  $MiObjeto->last_record();
        $array = json_decode(json_encode($personal), true);
        $data = $array;

        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('template\QrTest', $data);
        echo view('template\footer');
        echo view('template\background');
    }
}
