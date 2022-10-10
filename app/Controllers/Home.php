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
        echo view('template\navbar',$usuario);
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
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
       }
        $db = \Config\Database::connect();
        $MiObjeto = new T_Personal($db);
        $personal =  $MiObjeto->findAll();
        //print_r($personal);

        $data['listaPersonal'] = $personal;
        echo view('template\navbar',$usuario);
        echo view('USUARIO\viewstaff',$data,$usuario);
    }

    public function VerPacientes()
    {   
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');
        $usuario['S_Per_tipo']   = $session->get('Per_tipo');
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
       }
        $db = \Config\Database::connect();
        $MiObjeto = new T_Paciente($db);
        $pacientes =  $MiObjeto->findAll();
        //print_r($pacientes);
        $data['listaPacientes'] = $pacientes;
        echo view('template\navbar',$usuario);
        echo view('USUARIO\viewpacientes',$data,$usuario);
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
        echo view('USUARIO\index',$data);
    }
    public function p_delete($id=0){

        $personal = new T_Personal();
  
        ## Check record
        if($personal->find($id)){
  
           ## Delete record
           $personal->delete($id);
  
           session()->setFlashdata('message', 'Deleted Successfully!');
           session()->setFlashdata('alert-class', 'alert-success');
        }else{
           session()->setFlashdata('message', 'Record not found!');
           session()->setFlashdata('alert-class', 'alert-danger');
        }
  
        return redirect()->route('/');
    }

        public function per_delete($id=0){

        $personal = new T_Personal();
  
        ## Check record
        if($personal->find($id)){
  
           ## Delete record
           $personal->delete($id);
  
           session()->setFlashdata('message', 'Deleted Successfully!');
           session()->setFlashdata('alert-class', 'alert-success');
        }else{
           session()->setFlashdata('message', 'Record not found!');
           session()->setFlashdata('alert-class', 'alert-danger');
        }
  
        return redirect()->route('/');
  
     }
     public function pac_delete($id=0){

        $paciente = new T_Paciente();
  
        ## Check record
        if($paciente->find($id)){
  
           ## Delete record
           $paciente->delete($id);
  
           session()->setFlashdata('message', 'Deleted Successfully!');
           session()->setFlashdata('alert-class', 'alert-success');
        }else{
           session()->setFlashdata('message', 'Record not found!');
           session()->setFlashdata('alert-class', 'alert-danger');
        }
  
        return redirect()->route('/');
    }
}