<?php

namespace App\Controllers;

use App\Models\T_Cuenta;
use App\Models\T_Operacion;
use App\Models\T_Paciente;      //Variable: $MiObjeto = new T_Paciente($db);
use App\Models\T_Personal;      //Variable: $MiObjeto = new T_Personal($db);
use App\Models\T_TipoPer;


class Home extends BaseController
{


   public function index()
   {

      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']   = $session->get('Per_tipo');
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('USUARIO\index', $usuario);
      echo view('template\footer');
      echo view('template\background');
   }

   //variable db es database para conectarla con las demás tabals
   //MiObjeto simplemente es la variable donde tendremos unas de las mencionadas tablas
   //

   public function VerStaff()
   {
      $session = session();
      $usuario['nom_cuenta']  = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');
      $usuario['S_Per_cod']  = $session->get('Per_cod');
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $in = $session->getFlashdata('in');
      switch ($in) {
         case 1:
            session()->setFlashdata('message', 'Personal Eliminado.');
            session()->setFlashdata('alert-class', 'alert-success');
            break;
         case 2:
            session()->setFlashdata('message', 'Personal no encontrado, llamar técnico si es un error informativo.');
            session()->setFlashdata('alert-class', 'alert-danger');
      }
      $db = \Config\Database::connect();
      $builder = $db->table('personal');
      $listado = $builder->select()
         ->where('Per_cod !=', 100)
         ->where('Per_cod !=', $usuario['S_Per_cod'])
         ->get()->getResultArray();
      //print_r($listado);

      $data['listaPersonal'] = $listado;
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('USUARIO\viewstaff', $data, $usuario);
      echo view('template\footer');
      echo view('template\background');
   }

   public function VerPacientes()
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']   = $session->get('Per_tipo');
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
      $db = \Config\Database::connect();
      $MiObjeto = new T_Paciente($db);
      $pacientes =  $MiObjeto->findAll();
      //print_r($pacientes);
      $data['listaPacientes'] = $pacientes;
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('USUARIO\viewpacientes', $data, $usuario);
      echo view('template\footer');
      echo view('template\background');
   }

   public function PerDelQuestion($Per_cod = NULL)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $S_Per_cod  = $session->get('Per_cod');
      $prior = [1, 2];
      if ($usuario['S_Per_tipo']!=2) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $data['target'] = $Per_cod;
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('template\PerQuestionDelete', $data);
      echo view('template\footer');
      echo view('template\background');
   }
   public function per_delete($Per_cod = NULL)
   {

      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $S_Per_cod  = $session->get('Per_cod');
      $prior = [1, 2];
      if ($usuario['S_Per_tipo']!=2) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $session = session();
      $cod = $session->get('Per_cod');
      $personal = new T_Personal();

      ## Check record
      if ($personal->find($Per_cod)) {
         if ($Per_cod == $cod || $Per_cod <= 100) {
            return redirect()->to('/index');
         } else {
            ## Delete record
            $cuenta = new T_Cuenta();
            $resultado = $cuenta->buscarCuenta($Per_cod);
            if ($resultado != NULL) {
               $cuenta->borrarCuenta($Per_cod);
            }
            $personal->delete($Per_cod);

            session()->setFlashdata('message', 'Deleted Successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
         }
      } else {
         session()->setFlashdata('message', 'Record not found!');
         session()->setFlashdata('alert-class', 'alert-danger');
      }
      return redirect()->to('/VerStaff');
   }
   public function PacDelQuestion($Pac_rut = NULL)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $S_Per_cod  = $session->get('Per_cod');
      $prior = [1, 2];
      if ($usuario['S_Per_tipo']!=2) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $data['target'] = $Pac_rut;
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('template\PacQuestionDelete', $data);
      echo view('template\footer');
      echo view('template\background');
   }
   public function pac_delete($Pac_rut = NULL)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $S_Per_cod = $session->get('Per_tipo');
      switch ($S_Per_cod) {
         case 1:
            return redirect()->to('/unlogged');
         case 2:
            break;
         case 3:
            return redirect()->to('/unlogged');
            break;
      }
      $paciente = new T_Paciente();

      ## Check record
      if ($paciente->find($Pac_rut)) {

         ## Delete record
         $paciente->delete($Pac_rut);
         $in = 1;
      } else {
         $in = 2;
      }

      return redirect()->to('/VerPacientes');
   }
   public function perModQuestion($Per_cod = NULL)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      if ($usuario['S_Per_tipo']!=2) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $data['target'] = $Per_cod;
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('template\PerQuestionModify', $data);
      echo view('template\footer');
      echo view('template\background');
   }
   public function per_mod($Per_cod = NULL)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $S_Per_cod  = $session->get('Per_cod');
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false || $usuario['S_Per_tipo'] != 2) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $personal = new T_Personal();
      if ($personal->find($Per_cod)) {
         if ($Per_cod == 100) {
            return redirect()->to('/VerStaff');
         } else {
            $db = \Config\Database::connect();
            $model = new T_TipoPer($db);
            $listaPersonal = $model->findAll();
            $data['data'] = $personal->find($Per_cod);
            $data['listaPersonal'] = $listaPersonal;

            echo view('template\header');
            echo view('template\navbar', $usuario);
            echo view('template\editper', $data);
            echo view('template\footer');
            echo view('template\background');
         }
      }
   }

   public function per_post()
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
      $lista = [];
      $db = \Config\Database::connect();
      $personal = new T_Personal($db);
      $id = $this->request->getVar('Per_cod');
      $data = [
         'Per_nom' => $this->request->getVar('Per_nom'),
         'Per_edad' => $this->request->getVar('Per_edad'),
         'Per_gen' => $this->request->getVar('Per_gen'),
         'Per_tipo'  => $this->request->getVar('Per_tipo'),
         'Per_espec' => $this->request->getVar('Per_espec')
      ];
      $genero = ["M", "F", "O"];
      if ($data['Per_nom'] == NULL) {
         array_push($lista, "No hay nombre establecido.");
      }
      if ($data['Per_edad'] == NULL || $data['Per_edad'] < 0) {
         array_push($lista, "No hay edad establecido.");
      }
      if (in_array($data['Per_gen'], $genero)) {
      } else {
         array_push($lista, "No hay género establecido.");
      }

      if ($lista == NULL) {
         $personal->updatedata($data, $id);
         $db = \Config\Database::connect();
         $op = new T_Operacion($db);
         $dataTemp = [
            'Per_tipo' => $usuario['S_Per_tipo'],
            'Per_cod'  => $usuario['Per_cod'],
            'Op_detalle'  => 'Se ingresó un paciente nuevo.'
         ];
         $op->insert($dataTemp);
         $select = $personal->find($id);
         if ($select['Per_email'] != NULL || $select['Per_email'] != '') {

            switch ($data['Per_tipo']) {
               case 1:
                  $definicion = 'Salud';
                  break;
               case 2:
                  $definicion = 'Técnico';
                  break;
               case 3:
                  $definicion = 'Limpieza';
                  break;
            }
            $email = \Config\Services::email();
            $email->setTo($select['Per_email']);
            $email->setFrom('diego.aguilar@alumnos.upla.cl', 'Sistema Clinica');

            $email->setSubject('Personal' . $data['Per_nom'] . '. Cambios de sus datos se han aplicado en el Sistema Clinico.');
            if ($data['Per_espec'] != NULL) {
               $email->setMessage("<!DOCTYPE html>" .
                  "<html lang='es'>" .
                  "<head>" .
                  "<meta charset='utf-8'>" .
                  "</head>" .
                  "<body style='background-color: black '>" .
                  "<table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>" .
                  "<tr>" .
                  "<td style='padding: 0'>" .
                  "</td>" .
                  "</tr>" .
                  "<tr>" .
                  "<td style='background-image: url(https://www.shutterstock.com/image-photo/social-networking-concept-260nw-360705110.jpg);background-repeat: no-repeat;background-size: 100% 100%;'>" .
                  "<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>" .
                  "<h2 style='color: #ff7701; margin: 0 0 7px;text-align:center;text-shadow: 1px 1px 2px black;'>Sistema Clinico</h2>" .
                  "<p style='margin: 2px; font-size: 15px'>" .
                  "<br><h2 style='color:rgba(5, 84, 255, 0.938);;text-shadow: 1px 1px 2px black;text-align:justify'>Se han actualizado los datos de su cuenta.</h2>" .
                  "<div style='width: 100%;margin:20px 0; display: inline-block;text-align: justify'>" .
                  "<br>
               <div style='margin:auto;border-style:outset;border-width:5px;background-color: white;'>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Datos:</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Nombre: " . $data['Per_nom'] . "</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Género: " . $data['Per_gen'] . "</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Edad: " . $data['Per_edad'] . "</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Tipo: " . $definicion . "</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Especialidad: " . $data['Per_espec'] . "</h2>" .
                  "</div>" .
                  "</div>" .
                  "<div style='width: 100%; text-align: center'>" .
                  "</div>" .
                  "</div>" .
                  "</td>" .
                  "</tr>" .
                  "</table>" .
                  "</body>" .
                  "</html>");
            } else {
               $email->setMessage("<!DOCTYPE html>" .
                  "<html lang='es'>" .
                  "<head>" .
                  "<meta charset='utf-8'>" .
                  "</head>" .
                  "<body style='background-color: black '>" .
                  "<table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>" .
                  "<tr>" .
                  "<td style='padding: 0'>" .
                  "</td>" .
                  "</tr>" .
                  "<tr>" .
                  "<td style='background-image: url(https://www.shutterstock.com/image-photo/social-networking-concept-260nw-360705110.jpg);background-repeat: no-repeat;background-size: 100% 100%;'>" .
                  "<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>" .
                  "<h2 style='color: #ff7701; margin: 0 0 7px;text-align:center;text-shadow: 1px 1px 2px black;'>Sistema Clinico</h2>" .
                  "<p style='margin: 2px; font-size: 15px'>" .
                  "<br><h2 style='color:rgba(5, 84, 255, 0.938);;text-shadow: 1px 1px 2px black;text-align:justify'>Se han actualizado los datos de su cuenta.</h2>" .
                  "<div style='width: 100%;margin:20px 0; display: inline-block;text-align: justify'>" .
                  "<br>
               <div style='margin:auto;border-style:outset;border-width:5px;background-color: white;'>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Datos:</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Nombre: " . $data['Per_nom'] . "</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Género: " . $data['Per_gen'] . "</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Edad: " . $data['Per_edad'] . "</h2>" .
                  "<h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Tipo: " . $definicion . "</h2>" .               "</div>" .
                  "</div>" .
                  "<div style='width: 100%; text-align: center'>" .
                  "</div>" .
                  "</div>" .
                  "</td>" .
                  "</tr>" .
                  "</table>" .
                  "</body>" .
                  "</html>");
            }
            if ($email->send()) {
               return redirect()->to('/VerStaff');
            } else {
               $data = $email->printDebugger(['headers']);
               print_r($data);
               sleep(10);
               return redirect()->to('/index');
            }
         }

         return redirect()->to('/VerStaff');
      } else {
         $db = \Config\Database::connect();
         $model = new T_TipoPer($db);
         $listaPersonal = $model->findAll();
         $data = [
            'Per_cod'   => $this->request->getVar('Per_cod'),
            'Per_nom'   => $this->request->getVar('Per_nom'),
            'Per_edad'  => $this->request->getVar('Per_edad'),
            'Per_tipo'  => $this->request->getVar('Per_tipo'),
            'Per_espec'  => $this->request->getVar('Per_espec'),
            'Per_gen'   => $this->request->getVar('Per_gen')
         ];
         $errors['errors'] = $lista;
         $data['data'] = $data;
         $data['listaPersonal'] = $listaPersonal;
         return view('template\header') .
            view('template\navbar', $usuario) .
            view('template\errors', $errors) .
            view('template\editper', $data) .
            view('template\footer') .
            view('template\background2');
      }
   }
   public function PacModQuestion($Pac_rut = NULL)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      if ($usuario['S_Per_tipo']!=2) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $data['target'] = $Pac_rut;
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('template\PacQuestionModify', $data);
      echo view('template\footer');
      echo view('template\background');
   }
   public function pac_mod($Pac_rut = 0)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $S_Per_cod = $session->get('Per_tipo');
      switch ($S_Per_cod) {
         case 1:
            return redirect()->to('/unlogged');
         case 2:
            break;
         case 3:
            return redirect()->to('/unlogged');
            break;
      }
      $paciente = new T_Paciente();
      if ($paciente->find($Pac_rut)) {
         $data['data'] = $paciente->find($Pac_rut);

         echo view('template\header');
         echo view('template\navbar', $usuario);
         echo view('template\editpac', $data);
         echo view('template\footer');
         echo view('template\background');
      } else {
         session()->setFlashdata('message', 'No se encuentra el paciente.');
         session()->setFlashdata('alert-class', 'alert-danger');
      }
   }
   public function pac_post()
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $usuario['Per_cod']  = $session->get('Per_cod');
      $S_Per_cod = $session->get('Per_tipo');
      switch ($S_Per_cod) {
         case 1:
            return redirect()->to('/unlogged');
         case 2:
            break;
         case 3:
            return redirect()->to('/unlogged');
            break;
      }
      $lista = [];
      $db = \Config\Database::connect();
      $paciente = new T_Paciente($db);
      $id = $this->request->getVar('Pac_rut');
      $data = [
         'Pac_nom' => $this->request->getVar('Pac_nom'),
         'Pac_edad' => $this->request->getVar('Pac_edad'),
         'Pac_gen' => $this->request->getVar('Pac_gen')
      ];
      $genero = ["M", "F", "O"];
      if ($data['Pac_nom'] == NULL) {
         array_push($lista, "No hay nombre establecido.");
      }
      if ($data['Pac_edad'] == NULL || $data['Pac_edad'] < 0) {
         array_push($lista, "No hay edad establecido.");
      }
      if (in_array($data['Pac_gen'], $genero)) {
      } else {
         array_push($lista, "No hay género establecido.");
      }

      if ($lista == NULL) {
         $paciente->updatedata($data, $id);
         $db = \Config\Database::connect();
         $op = new T_Operacion($db);
         $dataTemp = [
            'Per_tipo' => $usuario['S_Per_tipo'],
            'Per_cod'  => $usuario['Per_cod'],
            'Op_detalle'  => 'Se ingresó un paciente nuevo.'
         ];
         $op->insert($dataTemp);
         return redirect()->to('/VerPacientes');
      } else {
         $data = [
            'Pac_rut'   => $this->request->getVar('Pac_rut'),
            'Pac_nom'   => $this->request->getVar('Pac_nom'),
            'Pac_edad'  => $this->request->getVar('Pac_edad'),
            'Pac_gen'   => $this->request->getVar('Pac_gen')
         ];
         $errors['errors'] = $lista;
         $data['data'] = $data;
         return view('template\header') .
            view('template\navbar', $usuario) .
            view('template\errors', $errors) .
            view('template\editpac', $data) .
            view('template\footer') .
            view('template\background2');
      }
   }

   public function operation()
   {
      $session = session();
      $usuario['nom_cuenta']  = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      if ($usuario['S_Per_tipo'] == 1) {
         $db = \Config\Database::connect();
         $MiObjeto = new T_Paciente($db);
         $pacientes =  $MiObjeto->findAll();
         $data['listaPacientes'] = $pacientes;
      } else {
         $data['listaPacientes'] = 'NULL';
      }
      return view('template\header') .
         view('template\navbar', $usuario) .
         view('USUARIO\commitOp', $data) .
         view('template\footer') .
         view('template\background');
   }

   public function operationSend()
   {
      $session = session();
      $usuario['nom_cuenta']  = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');
      $usuario['Per_cod']  = $session->get('Per_cod');
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
      $db = \Config\Database::connect();
      $op = new T_Operacion($db);
      $input = [
         'Op_detalle'   => $this->request->getVar('Op_detalle')
      ];
      if ($usuario['S_Per_tipo'] == 1) {
         $db = \Config\Database::connect();
         $MiObjeto = new T_Paciente($db);
         $pacientes =  $MiObjeto->findAll();
         $data['listaPacientes'] = $pacientes;
         if ($this->request->getVar('Pac_nom') != NULL) {
            $pac = $this->request->getVar('Pac_nom');
            $dataTemp = [
               'Per_tipo' => $usuario['S_Per_tipo'],
               'Per_cod'  => $usuario['Per_cod'],
               'Op_detalle'  => 'Se atendió a paciente: ' . $pac
            ];
            if ($input['Op_detalle'] != NULL) {
               $dataTemp['Op_detalle'] = 'Se atendió a paciente: ' . $pac . ' DETALLE: ' . $input['Op_detalle'];
            };
            //print_r($dataTemp);
            $op->insert($dataTemp);
            return redirect()->to('/index');
         } else {
            $errors['errors'] = ['Se necesita seleccionar un paciente.'];
            return view('template\header') .
               view('template\navbar', $usuario) .
               view('template\errors', $errors) .
               view('USUARIO\commitOp', $data) .
               view('template\footer') .
               view('template\background2');
         }
      } else {
         $data['listaPacientes'] = 'NULL';
      }
      if ($usuario['S_Per_tipo'] == 2 || $usuario['S_Per_tipo'] == 3) {
         if ($input['Op_detalle'] == NULL || $input['Op_detalle'] == '') {
            $errors['errors'] = ['Se necesita especificar.'];
            return view('template\header') .
               view('template\navbar', $usuario) .
               view('template\errors', $errors) .
               view('USUARIO\commitOp', $data) .
               view('template\footer') .
               view('template\background2');
         } else {
            if ($usuario['S_Per_tipo'] == 2 || $usuario['S_Per_tipo'] == 3) {
               $dataTemp = [
                  'Per_tipo' => $usuario['S_Per_tipo'],
                  'Per_cod'  => $usuario['Per_cod'],
                  'Op_detalle'  => $input['Op_detalle'],
               ];
               //print_r($dataTemp);
               $op->insert($dataTemp);
               return redirect()->to('/index');
            }
         }
      } else {
         return redirect()->to('/index');
      }
   }

   public function test()
   {
      return view('USUARIO\index');
   }
}
