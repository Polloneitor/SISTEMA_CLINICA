<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class AccountData extends Controller
{
    public function index()
    {   
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  =   $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $usuario['Per_cod']     =   $session->get('Per_cod');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
        }
        echo view('template\navbar',$usuario);
        echo view('template\cuenta',$usuario);
    }

    public function unlogged()
    {
        echo view ('template\non-login');
    }

}