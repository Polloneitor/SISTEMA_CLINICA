<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ExitProfile extends BaseController
{
    public function index()
    {

        $session = session();
        $session->destroy();
        return redirect()->to('/index');
    }
}
