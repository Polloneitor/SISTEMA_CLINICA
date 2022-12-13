<?php

namespace App\Controllers;

use App\Models\FormModel;
use CodeIgniter\Controller;

class SendMail extends BaseController
{
    public function index()
    {
        $session = session();
        $usuario['nom_cuenta'] = $session->get('nom_cuenta');
        $usuario['S_Per_tipo']   = $session->get('Per_tipo');
        return
            view('template\header') .
            view('template\navbar', $usuario) .
            view('template/form_view') .
            view('template\footer') .
            view('template\background');
    }
    function sendMail()
    {
        $to = $this->request->getVar('mailTo');
        $subject = $this->request->getVar('subject');
        $message = $this->request->getVar('message');

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('diego.aguilar@alumnos.upla.cl', 'Confirm Registration');

        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
            echo 'Email successfully sent';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
}
