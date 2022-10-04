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
        echo view('USUARIO/signin');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $userModel = new T_Cuenta();
        $personal = new T_Personal();
        $nombre = $this->request->getVar('nom_cuenta');
        $password = $this->request->getVar('pas_cuenta');
        
        $data = $userModel->where('nom_cuenta', $nombre)->first();
        $query = $personal->where('Per_cod',$data['Per_cod'])->first();
        if($data){
            $pass = $data['pas_cuenta'];
            $per_cod = $query['Per_tipo'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'cod_cuenta' => $data['cod_cuenta'],
                    'nom_cuenta' => $data['nom_cuenta'],
                    'Per_cod'    => $data['Per_cod'],
                    'Per_tipo'   => $per_cod,
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/profile');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/signin');
            }
        }else{
            $session->setFlashdata('msg', 'Name does not exist.');
            return redirect()->to('/signin');
        }
    }
}