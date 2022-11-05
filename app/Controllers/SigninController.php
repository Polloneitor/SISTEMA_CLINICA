<?php

namespace App\Controllers;

use App\Models\T_Cuenta;
use App\Models\T_Personal;
use CodeIgniter\Controller;

class SigninController extends Controller
{
    public function index()
    {

        helper(['form']);
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');
        $usuario['S_Per_tipo']   = $session->get('Per_tipo');
        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('USUARIO\signin');
        echo view('template\footer');
        echo view('template\background');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new T_Cuenta();
        $personal = new T_Personal();
        $nombre = $this->request->getVar('nom_cuenta');
        $password = $this->request->getVar('pas_cuenta');

        $data = $userModel->where('nom_cuenta', $nombre)->first();
        if ($data) {
            $pass = $data['pas_cuenta'];
            $query = $personal->where('Per_cod', $data['Per_cod'])->first();
            $per_cod = $query['Per_tipo'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'cod_cuenta' => $data['cod_cuenta'],
                    'nom_cuenta' => $data['nom_cuenta'],
                    'Per_cod'    => $data['Per_cod'],
                    'Per_tipo'   => $per_cod,
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                if ($data['firstlogin_cuenta'] == 0) {
                    return redirect()->to('/firstlog');
                }
                return redirect()->to('/profile');
            } else {
                $session->setFlashdata('msg', 'Contraseña Incorrecta.');
                return redirect()->to('/signin');
            }
        } else {
            $session->setFlashdata('msg', 'Nombre de Usuario incorrecta.');
            return redirect()->to('/signin');
        }
    }
}
