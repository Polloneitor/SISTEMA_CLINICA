<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\T_Cuenta;
  
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
    public function pass_view()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
        }
        echo view('template\navbar',$usuario);
        echo view('template\changepass',$usuario);
    }

    public function changepass()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $verify = $session->get('nom_cuenta');
        if($verify == null){
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $userModel = new T_Cuenta();
        $user = $userModel->find($usuario['cod_cuenta']);
        if($user){
            $OldPass = $this->request->getVar('OldPass');
            $NewPass = $this->request->getVar('NewPass');
            $Confirmed = $this->request->getVar('ConfirmNewPass');
            $authenticatePassword = password_verify($user['pas_cuenta'], $OldPass);
            if($authenticatePassword){
                if($NewPass == $Confirmed){
                    $userModel->$user->update('pas_cuenta',$Confirmed);
                }
            }
        }
        echo view('template\navbar',$usuario);
        echo view('template\changepass',$usuario);
    }
    public function unlogged()
    {
        echo view ('template\non-login');
    }

}