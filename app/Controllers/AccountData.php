<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\T_Cuenta;
use App\Models\T_Operacion;
use App\Models\T_Personal;

class AccountData extends Controller
{
    public function index()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  =   $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $usuario['Per_cod']     =   $session->get('Per_cod');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $usuario['file']  =   $session->get('file');
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $userModel = new T_Personal();
        $user = $userModel->find($usuario['Per_cod']);
        $operacion = new T_Operacion();
        $consulta = $operacion
            ->where('Per_cod', $usuario['Per_cod'])
            ->where('Per_tipo', $usuario['S_Per_tipo'])
            ->countAllResults();
        $array['Op_queue'] = $consulta;
        $temp = array_merge($user, $array);
        $data = array_merge($usuario, $temp);

        echo view('template\header');
        echo view('template\navbar', $usuario);
        echo view('template\cuenta', $data);
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
    public function changeEmail()
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
        if($user['Per_email'] == NULL){
            return view('template\header') .
            view('template\navbar', $usuario) .
            view('template\email', $user) .
            view('template\footer') .
            view('template\background');}
        else{
            return view('template\header') .
            view('template\navbar', $usuario) .
            view('template\editemail', $user) .
            view('template\footer') .
            view('template\background');
        }
    }
    public function unlogged()
    {
        echo view('template\non-login');
    }

    public function upload()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  =   $session->get('Per_tipo');     // Si Usuario tiene privilegio
        $usuario['Per_cod']     =   $session->get('Per_cod');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $usuario['file']  =   $session->get('file');
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        if ($usuario['Per_cod'] != NULL) {
            helper(['form', 'url']);

            $database = \Config\Database::connect();
            $builder = $database->table('cuenta');
            $validateImage = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'mime_in[file, image/png, image/jpg,image/jpeg, image/gif]',
                    'max_size[file, 4096]',
                ],
            ]);

            $response = [
                'success' => false,
                'data' => '',
                'msg' => "Imagen no pudo haber sido subida"
            ];
            if ($validateImage) {
                $imageFile = $this->request->getFile('file');
                $imageFile->move(WRITEPATH . 'uploads');
                $data = [
                    'Per_cod' => $usuario['Per_cod'],
                    'img_name' => $imageFile->getClientName(),
                    'file'  => $imageFile->getClientMimeType()
                ];
                $save = $builder->insert($data);
                $response = [
                    'success' => true,
                    'data' => $save,
                    'msg' => "Imagen ha sido subida."
                ];
            }
            return $this->response->setJSON($response);
        }
    }
}
