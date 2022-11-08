<?php

namespace App\Controllers;

use App\Models\T_Paciente;      //Variable: $MiObjeto = new T_Paciente($db);
use App\Models\T_Personal;      //Variable: $MiObjeto = new T_Personal($db);
use App\Models\T_TipoPer;
use App\Models\T_Turno;         //Variable: $MiObjeto = new T_Turno($db);
use App\Models\T_TurnTipo;      //Variable: $MiObjeto = new T_TurnTipo($db);

class Home extends BaseController
{


   public function index()
   {

      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']   = $session->get('Per_tipo');
      echo view('template\header');
      echo view('template\navbar', $usuario);
      echo view('USUARIO\index');
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
      $MiObjeto = new T_Personal($db);
      $personal =  $MiObjeto->findAll();
      //print_r($personal);

      $data['listaPersonal'] = $personal;
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
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false) {
         // do something when exist
         return redirect()->to('/unlogged');
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
   //  Turno no es tomado en la base de datos, revisar tabla turno XXX
   //  PD: Se está ocupando tipo turno  XXX
   //  Está ya solucionado!
   public function ControlarTurno()
   {
      $db = \Config\Database::connect();
      $MiObjeto = new T_Turno($db);
      $turnos =  $MiObjeto->findAll();
      //print_r($turnos);

      $data['listaTurnos'] = $turnos;
      echo view('template\header');
      echo view('template\navbar');
      echo view('USUARIO\index', $data);
      echo view('template\footer');
      echo view('template\background');
   }
   public function per_delete($Per_cod = NULL)
   {
      $session = session();
      $cod = $session->get('Per_cod');
      $personal = new T_Personal();

      ## Check record
      if ($personal->find($Per_cod)) {
         if ($Per_cod == $cod) {
            return redirect()->to('/index');
         } else {
            ## Delete record
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

   public function pac_delete($Pac_rut = NULL)
   {

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
         if ($S_Per_cod == $Per_cod || $Per_cod == 100) {
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
         return redirect()->to('/VerStaff');
      } else {
         $db = \Config\Database::connect();
         $model = new T_TipoPer($db);
         $listaPersonal = $model->findAll();
         $data = [
            'Per_rut'   => $this->request->getVar('Per_cod'),
            'Per_nom'   => $this->request->getVar('Per_nom'),
            'Per_edad'  => $this->request->getVar('Per_edad'),
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
            view('template\background');
      }
   }

   public function pac_mod($Pac_rut = 0)
   {
      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');   // Si Usuario está conectado
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');     // Si Usuario tiene privilegio
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false) {
         // do something when exist
         return redirect()->to('/unlogged');
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
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false) {
         // do something when exist
         return redirect()->to('/unlogged');
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
            view('template\background');
      }
   }
   public function verify()
   {
      $session = session();
      $usuario['nom_cuenta']  = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']  = $session->get('Per_tipo');
      $verify = $session->get('isLoggedIn');
      if ($verify == null || $verify == false) {
         // do something when exist
         return redirect()->to('/unlogged');
      }
   }
}
