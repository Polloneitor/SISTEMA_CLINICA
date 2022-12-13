<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        echo "Hello : " . $session->get('nom_cuenta');
        return redirect()->to('/index');
    }
}
