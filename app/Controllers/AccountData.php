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
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('template\cuenta', $usuario);
        echo view('template\footer');
        echo view('template\background');
    }
    public function pass_view()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $userModel = new T_Cuenta();
        $user = $userModel->find($usuario['cod_cuenta']);
        $usuario['firstlogin_cuenta'] = $user['firstlogin_cuenta'];
        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('template\changepass', $usuario);
        echo view('template\footer');
        echo view('template\background');
    }

    public function changepass()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');

        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $userModel = new T_Cuenta();
        $user = $userModel->find($usuario['cod_cuenta']);
        $usuario['firstlogin_cuenta'] = $user['firstlogin_cuenta'];
        if ($user) {
            $OldPass = $this->request->getVar('OldPass');
            $NewPass = $this->request->getVar('NewPass');
            $Confirmed = $this->request->getVar('ConfirmNewPass');
            $pass = $user['pas_cuenta'];
            $authenticatePassword = password_verify($OldPass, $pass);
            if ($authenticatePassword) {
                if ($OldPass == $NewPass || $OldPass == $Confirmed) {
                    $data['errors'] = ['La primera contraseña y la nueva contraseña no puede ser la misma.'];
                    return view('template\header') .
                        view('template\navbar', $usuario) .
                        view('template\errors', $data) .
                        view('template\changepass', $usuario) .
                        view('template\footer') .
                        view('template\background');
                } else {
                    if ($NewPass == $Confirmed) {
                        $changePass = password_hash($Confirmed, PASSWORD_DEFAULT);
                        $userModel->updatePass($user['cod_cuenta'], $changePass);
                        return redirect()->to('/details');
                    } else {
                        $data['errors'] = ['La nueva contraseña y confirmación de ella no son las mismas'];
                        return view('template\header') .
                            view('template\navbar', $usuario) .
                            view('template\errors', $data) .
                            view('template\changepass', $usuario) .
                            view('template\footer') .
                            view('template\background');
                    }
                }
            } else {
                return redirect()->to('/changepass');
            }
        }
    }
    public function unlogged()
    {
        echo view('template\non-login');
    }
}
