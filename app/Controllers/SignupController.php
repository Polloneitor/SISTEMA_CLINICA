<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\T_Cuenta;
use App\Models\T_Personal;
  
class SignupController extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('USUARIO/signup', $data);
    }
  
    public function store()
    {
        $db = \Config\Database::connect();
        $MiObjeto = new T_Personal($db);
        $personal =  $MiObjeto->findAll();
        helper(['form']);
        $compare = $this->request->getVar('Per_cod');
        $rules = [
            'nom_cuenta'        => 'required|is_unique[cuenta.nom_cuenta]|min_length[2]|max_length[50]',
            'Per_cod'           => 'required|numeric|is_unique[cuenta.Per_cod]
                                    |is_unique[cuenta.Per_cod]|matches[personal.Per_cod]',
            'password'          => 'required|min_length[4]|max_length[50]',
            'confirmpassword'   => 'matches[password]'
        ];
        foreach ($personal as $cod) {
            if($compare == $cod['Per_cod']){
                $rules['Per_cod'] = 'required|numeric|is_unique[cuenta.Per_cod]
                                    |is_unique[cuenta.Per_cod]';
                break;
            };
          }
        if($this->validate($rules)){
            $autoincrement = 1;
            $db = \Config\Database::connect();
            $table = new T_Cuenta($db);
            $cuentas = $table->findAll();
            if(empty($cuentas)){
                $autoincrement=0;
            }else{
                $tamanio = sizeof($cuentas);
                $autoincrement = $tamanio;
            }
            $data = [
                'cod_cuenta'     => 1+$autoincrement,
                'nom_cuenta'     => $this->request->getVar('nom_cuenta'),
                'pas_cuenta'     => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'Per_cod'        => $this->request->getVar('Per_cod')
            ];
            $builder = $db->table('cuenta');
            $builder->insert($data);
            return redirect()->to('/signin');
        }else{
            $data['validation'] = $this->validator;
            echo view('USUARIO\signup', $data);
        }
          
    }
  
}