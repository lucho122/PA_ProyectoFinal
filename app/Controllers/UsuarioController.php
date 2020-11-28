<?php
namespace App\Controllers;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController 
{

    public function index() {

        if (!parent::isAdmin())
            return redirect()->back();

        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->getUsers();
        
        echo view('templates/head', ['titulo' => 'Usuarios | Admin']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('admin/usuarios/index', ['usuarios' => $usuarios]);
        echo view('templates/footer');
    }

    public function editar($id = null) {
        if (!parent::isAdmin())
            return redirect()->back();

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        echo view('templates/head', ['titulo' => 'Editar Usuario']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('admin/usuarios/editar', ['usuario' => $usuario]);
        echo view('templates/footer');
    }

    public function actualizar() {
        if (!parent::isAdmin())
            return redirect()->back();

        $request = $this->request->getPost();
        $usuarioModel = new UsuarioModel();
        $id = trim($request['Id']);
        $data = [
            'usupnombre' => $request['PNombre'],
            'ususnombre' => $request['SNombre'],
            'usupapellido' => $request['PApellido'],
            'ususapellido' => $request['SApellido'],
            'usufechanacimiento' => $request['FechaNacimiento'],
            'ususexo' => ($request['Sexo'] == 'm') ? true : false
        ];

        $usuarioModel->update($id, $data);

        $this->session->set('notificacion', ['label' => 'alert-info', 'mensaje' => 'Usuario actualizado con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/usuarios'));
    }

    public function eliminar() {
        if (!parent::isAdmin())
            return redirect()->back();
        $usuarioModel = new UsuarioModel();
        $id = trim($this->request->getVar('Id'));
        $usuarioModel->delete($id);

        $this->session->set('notificacion', ['label' => 'alert-danger', 'mensaje' => 'Usuario eliminado con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/usuarios'));
    }
}
?>