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
        $usuario['Per_cod']  = $session->get('Per_cod');
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
                        $db = \Config\Database::connect();
                        $personal = new T_Personal($db);
                        $select = $personal->find_email($usuario['Per_cod']);
                        if ($select != NULL || $select != '') {
                            $email = \Config\Services::email();
                            $email->setTo($select);
                            $email->setFrom('diego.aguilar@alumnos.upla.cl', 'Confirm Registration');

                            $email->setSubject('Se ha cambiado su contraseña');
                            $email->setMessage('Test');
                        }
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
        $usuario['Per_cod'] = $session->get('Per_cod');
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $db = \Config\Database::connect();
        $userModel = new T_Cuenta($db);
        $user = $userModel->find($usuario['cod_cuenta']);
        $personal = new T_Personal($db);
        $select = $personal->find($usuario['Per_cod']);
        $data = array_merge($user, $select);
        if ($select != NULL || $select != '') {
            return view('template\header') .
                view('template\navbar', $usuario) .
                view('template\email', $data) .
                view('template\footer') .
                view('template\background');
        } else {
            return view('template\header') .
                view('template\navbar', $usuario) .
                view('template\editemail', $data) .
                view('template\footer') .
                view('template\background');
        }
    }

    public function changeEmailPost()
    {
        $session = session();
        $usuario['nom_cuenta']  =   $session->get('nom_cuenta');   // Si Usuario está conectado
        $usuario['S_Per_tipo']  = $session->get('Per_tipo');
        $usuario['cod_cuenta']  =   $session->get('cod_cuenta');
        $usuario['Per_cod'] = $session->get('Per_cod');
        $verify = $session->get('isLoggedIn');
        if ($verify == null || $verify == false) {
            // do something when exist
            return redirect()->to('/unlogged');
        }
        $emailVar = $this->request->getVar('Per_email');
        if ($emailVar == NULL || $emailVar == '') {
            $db = \Config\Database::connect();
            $userModel = new T_Cuenta($db);
            $user = $userModel->find($usuario['cod_cuenta']);
            $personal = new T_Personal($db);
            $select = $personal->find($usuario['Per_cod']);
            $data = array_merge($user, $select);
            $errors['errors'] = 'Se debe rellenar campo';
            if ($select != NULL || $select != '') {
                return view('template\header') .
                    view('template\navbar', $usuario) .
                    view('template\errors', $errors) .
                    view('template\email', $data) .
                    view('template\footer') .
                    view('template\background');
            } else {
                return view('template\header') .
                    view('template\navbar', $usuario) .
                    view('template\errors', $errors) .
                    view('template\editemail', $data) .
                    view('template\footer') .
                    view('template\background');
            }
        } else {
            $db = \Config\Database::connect();
            $personal = new T_Personal($db);
            $select = $personal->find_email($usuario['Per_cod']);
            $select->update($usuario['Per_cod'],$emailVar);
            $email = \Config\Services::email();
            $email->setTo($emailVar);
            $email->setFrom('diego.aguilar@alumnos.upla.cl', 'Confirm Registration');

            $email->setSubject('Se ha vinculado su correo a la clinica');
            $email->setMessage('Test');
        }
    }

    public function preupload()
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
        return view('template\header') .
            view('template\navbar', $usuario) .
            view('template\uploadImage') .
            view('template\footer') .
            view('template\background');
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
        if ($usuario['cod_cuenta'] != NULL) {
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
                    'img_name' => $imageFile->getClientName(),
                    'file'  => $imageFile->getClientMimeType()
                ];
                $save = $builder->update($usuario['cod_cuenta'], $data);
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
