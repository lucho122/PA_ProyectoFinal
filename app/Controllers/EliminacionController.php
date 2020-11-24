<?php
namespace App\Controllers;

class EliminacionController extends BaseController 
{
    public function index($modulo = null, $id = null) {
        if (!parent::isAdmin())
            return redirect()->back();

        $ruta;
        
        switch ($modulo) {
            case 'categoria':
                $ruta = 'admin/categorias/eliminar';
                break;
            case 'pregunta':
                # code...
                break;
            case 'respuesta':
                # code...
                break;
            case 'usuario':
                # code...
                break;
            default:
                # code...
                break;
        }

        $data = [
                    'ruta' => base_url($ruta),
                    'id' => trim($id)
                ];
        echo view('templates/head', ['titulo' => 'Confirmar Eliminacion']);
        echo view('admin/confirm', $data);
        echo view('templates/footer');
    }
}
?>