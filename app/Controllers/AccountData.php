<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class AccountData extends Controller
{
    public function index()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');
        $usuario['S_Per_tipo']   = $session->get('Per_tipo');
        echo view('template\navbar',$usuario);
        echo view('USUARIO\index');
    }
}