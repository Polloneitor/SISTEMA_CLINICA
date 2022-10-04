<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class ExitProfile extends Controller
{
    public function index()
    {   

        $session = session();
        $session->destroy();
        return redirect()->to('/index');
    }
}