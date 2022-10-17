<?php

namespace App\Controllers;

use App\Models\T_Paciente;      //Variable: $MiObjeto = new T_Paciente($db);
use App\Models\T_Personal;      //Variable: $MiObjeto = new T_Personal($db);
use App\Models\T_Turno;         //Variable: $MiObjeto = new T_Turno($db);
use App\Models\T_TurnTipo;      //Variable: $MiObjeto = new T_TurnTipo($db);

class Home extends BaseController
{


   public function index()
   {

      $session = session();
      $usuario['nom_cuenta'] = $session->get('nom_cuenta');
      $usuario['S_Per_tipo']   = $session->get('Per_tipo');
      echo view('template\navbar', $usuario);
      echo view('USUARIO\index');
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
      $db = \Config\Database::connect();
      $MiObjeto = new T_Personal($db);
      $personal =  $MiObjeto->findAll();
      //print_r($personal);

      $data['listaPersonal'] = $personal;
      echo view('template\navbar', $usuario);
      echo view('USUARIO\viewstaff', $data, $usuario);
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
      echo view('template\navbar', $usuario);
      echo view('USUARIO\viewpacientes', $data, $usuario);
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
      echo view('template\navbar');
      echo view('USUARIO\index', $data);
   }
   public function per_delete($Per_cod = 0)
   {

      $personal = new T_Personal();

      ## Check record
      if ($personal->find($Per_cod)) {

         ## Delete record
         $personal->delete($Per_cod);

         session()->setFlashdata('message', 'Deleted Successfully!');
         session()->setFlashdata('alert-class', 'alert-success');
      } else {
         session()->setFlashdata('message', 'Record not found!');
         session()->setFlashdata('alert-class', 'alert-danger');
      }

      return redirect()->to('Home/VerPersonal');
   }

   public function pac_delete($Pac_rut = 0)
   {

      $paciente = new T_Paciente();

      ## Check record
      if ($paciente->find($Pac_rut)) {

         ## Delete record
         $paciente->delete($Pac_rut);

         session()->setFlashdata('message', 'Deleted Successfully!');
         session()->setFlashdata('alert-class', 'alert-success');
      } else {
         session()->setFlashdata('message', 'Record not found!');
         session()->setFlashdata('alert-class', 'alert-danger');
      }

      return redirect()->to('Home/VerPacientes');
   }
   public function per_mod($Per_cod = 0)
   {

      $personal = new T_Personal();

      ## Check record
      if ($personal->find($Per_cod)) {

         ## Delete record
         $personal->update($Per_cod);

         session()->setFlashdata('message', 'Updated Successfully!');
         session()->setFlashdata('alert-class', 'alert-success');
      } else {
         session()->setFlashdata('message', 'Record not found!');
         session()->setFlashdata('alert-class', 'alert-danger');
      }

      return redirect()->to('Home/VerPersonal');
   }

   public function pac_mod($Pac_rut = 0)
   {

      $paciente = new T_Paciente();

      ## Check record
      if ($paciente->find($Pac_rut)) {

         ## Delete record
         $paciente->update($Pac_rut);

         session()->setFlashdata('message', 'Updated Successfully!');
         session()->setFlashdata('alert-class', 'alert-success');
      } else {
         session()->setFlashdata('message', 'Record not found!');
         session()->setFlashdata('alert-class', 'alert-danger');
      }

      return redirect()->to('Home/VerPacientes');
   }
}
