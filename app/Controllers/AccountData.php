<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\T_Cuenta;
use App\Models\T_Operacion;
use App\Models\T_Personal;
use CodeIgniter\Files\File;

class AccountData extends BaseController
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
        $account = new T_Cuenta();
        $result = $account->find($usuario['cod_cuenta']);
        if ($result == NULL) {
            $file['file'] = NULL;
        } else {
            $file['file'] = $result['file'];
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
        $data = array_merge($data, $file);
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
            if($pass == '' || $pass == NULL){
                $data['errors'] = ['Los campos no pueden estar vacios'];
                    return view('template\header') .
                        view('template\navbar', $usuario) .
                        view('template\errors', $data) .
                        view('template\changepass', $usuario) .
                        view('template\footer') .
                        view('template\background');
            }
            if ($authenticatePassword) {
                if($OldPass == '' || $OldPass == NULL || $NewPass == '' || $NewPass == NULL ){
                    $data['errors'] = ['Los campos no pueden estar vacios'];
                    return view('template\header') .
                        view('template\navbar', $usuario) .
                        view('template\errors', $data) .
                        view('template\changepass', $usuario) .
                        view('template\footer') .
                        view('template\background');
                }
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
                            $email->setFrom('diego.aguilar@alumnos.upla.cl', 'Sistema Clinica');
                
                            $email->setSubject('Usuario '.$usuario['nom_cuenta'].'. Se ha modificado su contraseña exitosamente.');
                            $email->setMessage("<!DOCTYPE html>".
                            "<html lang='es'>".
                            "<head>".
                            "<meta charset='utf-8'>".
                            "</head>".
                            "<body style='background-color: black '>".
                            "<table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>".
                            "<tr>".
                            "<td style='padding: 0'>".
                            "</td>".
                            "</tr>".
                            "<tr>".
                            "<td style='background-image: url(https://t4.ftcdn.net/jpg/03/56/12/91/360_F_356129114_WIk3aWBzvIBlMH9lMcsGVsW5KgXrWoTs.jpg);background-repeat: no-repeat;background-size: 100% 100%;'>".
                            "<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>".
                            "<h2 style='color: #ff7701; margin: 0 0 7px;text-align:center;text-shadow: 1px 1px 2px black;'>Sistema Clinico</h2>".
                            "<p style='margin: 2px; font-size: 15px'>".
                            "<br><h2 style='color:rgba(5, 84, 255, 0.938);;text-shadow: 1px 1px 2px black;text-align:justify'>Datos de su cuenta han sido aplicadas.</h2>".
                            "<div style='width: 100%;margin:20px 0; display: inline-block;text-align: justify'>".
                            "<br><h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Su contraseña ha sido recientemente cambiada. ¡Siga protegiendo ante ladrones!</h2>".
                            "</div>".
                            "<div style='width: 100%; text-align: center'>".
                            "<br><h2 style='color:rgba(44, 74, 139, 0.938);text-align:justify;text-shadow: 1px 1px 2px black;'>Atte. Directiva.</h2>" .
                            "</div>".
                            "</div>".
                            "</td>".
                            "</tr>".
                            "</table>".
                            "</body>".
                            "</html>");
                            if ($email->send()) {
                                return redirect()->to('/details');
                            } else {
                                $data = $email->printDebugger(['headers']);
                                print_r($data);
                                sleep(10);
                                return redirect()->to('/infoPer');
                            }
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
                $data['errors'] = ['Contraseña Original Errónea.'];
                        return view('template\header') .
                            view('template\navbar', $usuario) .
                            view('template\errors', $data) .
                            view('template\changepass', $usuario) .
                            view('template\footer') .
                            view('template\background');
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
        if ($select == NULL || $select == '') {
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
            $builder = new T_Personal($db);
            $builder->set('Per_email', $emailVar)->where('Per_cod', $usuario['Per_cod']);
            $builder->update();
            $email = \Config\Services::email();
            $email->setTo($emailVar);
            $email->setFrom('diego.aguilar@alumnos.upla.cl', 'Sistema Clinica');

            $email->setSubject('Se ha vinculado su correo a la clinica');
            $email->setMessage("<!DOCTYPE html>".
            "<html lang='es'>".
            "<head>".
            "<meta charset='utf-8'>".
            "</head>".
            "<body style='background-color: black '>".
            "<table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>".
            "<tr>".
            "<td style='padding: 0'>".
            "</td>".
            "</tr>".
            "<tr>".
            "<td style='background-image: url(https://www.certus.edu.pe/blog/wp-content/uploads/2020/08/que-es-como-hacer-networking-certus.jpg);background-repeat: no-repeat;background-size: 100% 100%;'>".
            "<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>".
            "<h2 style='color: #ff7701; margin: 0 0 7px;text-align:center;text-shadow: 1px 1px 2px black;'>Sistema Clinico</h2>".
            "<p style='margin: 2px; font-size: 15px'>".
            "<br><h2 style='color:rgba(5, 84, 255, 0.938);;text-shadow: 1px 1px 2px black;text-align:justify'>Cambios han sido aplicados correctamente</h2>".
            "<div style='width: 100%;margin:20px 0; display: inline-block;text-align: justify'>".
            "<br><h2 style='color:rgba(5, 84, 255, 0.938);text-shadow: 1px 1px 2px black;'>Su correo ha sido vinculado y enlazado con nuestros sistemas.</h2>".
            "</div>".
            "<div style='width: 100%; text-align: center'>".
            "</div>".
            "</div>".
            "</td>".
            "</tr>".
            "</table>".
            "</body>".
            "</html>");
            if ($email->send()) {
                return redirect()->to('/index');
            } else {
                $data = $email->printDebugger(['headers']);
                print_r($data);
                sleep(10);
                return redirect()->to('/infoPer');
            }
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
        $data = ['errors' => []];
        return view('template\header') .
            view('template\navbar', $usuario) .
            view('template\uploadImage', $data) .
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


        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => 'uploaded[userfile]'
                    . '|is_image[userfile]'
                    . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
            ],
        ];
        if (!$this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('template\uploadImage', $data);
        }

        $img = $this->request->getFile('userfile');
        if (!$img->hasMoved()) {
            $path = "C:/xampp/htdocs/SISTEMA_CLINICA/public/images/usersImgs/";
            $newName = $img->getRandomName();
            $filepath = '/public/images/usersImgs/'.$newName;
            $img->move($path, $newName);

            $db = \Config\Database::connect();
            $builder = new T_Cuenta($db);
            $builder->set('file', $filepath)->where('Per_cod', $usuario['Per_cod']);
            $builder->update();
            return redirect()->to('/details');
        }
        $data = ['errors' => ['The file has already been moved.']];

        return view('template\uploadImage', $data);
    }
}
