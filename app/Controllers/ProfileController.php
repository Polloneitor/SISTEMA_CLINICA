<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class ProfileController extends Controller
{
    public function index()
    {
        $session = session();
        echo "Hello : ".$session->get('nom_cuenta');
        return redirect()->to('/index');
    }
}