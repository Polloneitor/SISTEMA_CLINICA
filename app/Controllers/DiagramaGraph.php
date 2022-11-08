<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class DiagramaGraph extends Controller
{
    public function index() {
        return view('chart');
    }
    
    public function initChart() {
        
        $db = \Config\Database::connect();
        $builder = $db->table('personal');
        $query = $builder->select("COUNT(Per_cod) as Personal, Per_tipo");
        $query = $builder->where("GROUP BY Per_tipo")->get();
        $personal = $query->getResult();
        $lista = [];
        foreach($personal as $row) {
            $lista[] = array(
                'personal'   => $row->Per_tipo,
            );
        }
        
        $data['listado'] = ($lista);    
        return view('chart', $data);                
    }
 
}