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
            echo view('template\background2');
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
            echo view('template\background2');
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
            $email->setMessage(
                "<!DOCTYPE html>" .
                    "<html lang='es'>" .
                    "<head>" .
                    "<meta charset='utf-8'>" .
                    "</head>" .
                    "<body style='background-color: white '>" .
                    "<table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>" .
                    "<tr>" .
                    "<td style='background-image: url(https://media.gettyimages.com/id/941762276/es/foto/m%C3%A9dicos-en-cl%C3%ADnica.jpg?s=612x612&w=gi&k=20&c=DjFQTj_f26yucvPJSx6fEzNXvpm6PK4xyWDiHBYD6nE=);background-repeat: no-repeat;background-size: 100% 100%;'>" .
                    "<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif;text-shadow: 1px 1px 2px black;'>" .
                    "<h2 style='color: #e67e22; margin: 0 0 7px;text-align:center'>Bienvenido al Sistema Clinico, ".$data['Per_nom']."</h2>" .
                    "<p style='margin: 2px; font-size: 15px'>" .
                    "<br><h2 style='color:rgba(44, 74, 139, 0.938);text-align:justify;text-shadow: 1px 1px 2px black;'>Pronto será incorporado de nuestro equipo.</h2>" .
                    "<div style='width: 100%;margin:20px 0; display: inline-block;text-align: justify;text-shadow: 1px 1px 2px black;'>" .
                    "<br><h2 style='color:rgba(44, 74, 139, 0.938)'>Se ha registrado datos personales 
                    para su nuevo empleo, se le hará saber cuando
                    estará habilitado en el sistema en este correo.</h2>" .
                    "</div>" .
                    "<div style='width: 100%; text-align: center'>" .
                    "<br><h2 style='color:rgba(44, 74, 139, 0.938);text-align:justify;text-shadow: 1px 1px 2px black;'>Atte. Directiva.</h2>" .
                    "</div>" .
                    "</div>" .
                    "</td>" .
                    "</tr>" .
                    "</table>" .
                    "</body>" .
                    "</html>"
            );
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
