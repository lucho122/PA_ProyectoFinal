<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CategoriaModel;

class CategoriaController extends BaseController 
{
    public function index() {
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        echo view('templates/head', ['titulo' => 'Categorias | Admin']);
        echo view('admin/categorias/index', ['categorias' => $categorias]);
        echo view('templates/footer');
    }

    public function agregar() {
        echo view('templates/head', ['titulo' => 'Agregar Categoria']);
        echo view('admin/categorias/agregar');
        echo view('templates/footer');
    }

    public function guardar() {
        $categoriaModel = new CategoriaModel();
        $data = ['catnombre' => trim($this->request->getVar('Nombre'))];

        # Devuelve 2 si se ejecuto el ISNERT de manera correcta.
        $insertar = $categoriaModel->insert($data);

        $this->session->set('notificacion', ['label' => 'alert-success', 'mensaje' => 'Categoría agregada con éxito']);
        $this->session->markAsFlashdata('notificacion');
        return $this->response->redirect(base_url('/admin/categorias'));
    }

    public function editar($id = null) {
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($id);

        echo view('templates/head', ['titulo' => 'Editar Categoria']);
        echo view('admin/categorias/editar', ['categoria' => $categoria]);
        echo view('templates/footer');
    }

    public function actualizar() {
        $categoriaModel = new CategoriaModel();
        $id = trim($this->request->getVar('Id'));
        $data = [ 'catnombre' => $this->request->getVar('Nombre')];

        $categoriaModel->update($id, $data);

        $this->session->set('notificacion', ['label' => 'alert-info', 'mensaje' => 'Categoría actualizada con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/categorias'));
    }

    public function eliminar() {
        $categoriaModel = new CategoriaModel();
    }
}
?>