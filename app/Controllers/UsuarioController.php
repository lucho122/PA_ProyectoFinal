<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\MensajesModel;
use CodeIgniter\I18n\Time;

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

    public function editarPerfil() {
        if (!parent::isLogged())
            return redirect()->back();
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->findUser($this->session->usuario['nick']);

        echo view('templates/head', ['titulo' => 'Editar Perfil']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('usuario/perfil', ['usuario' => $usuario]);
        echo view('templates/footer');
        
    }

    public function actualizarPerfil() {
        $request = $this->request->getPost();
        $usuarioModel = new UsuarioModel();
        $nick = trim($request['Nick']);
        $oldUsuario = $usuarioModel->findUser($nick);
        $oldFoto = $oldUsuario['usufoto'];

        $foto = $this->request->getFile('Foto');
        $data = [
            'usuemail' => $request['Email'],
            'usufoto' => $oldUsuario['usunick'] . '.' . $foto->getExtension(),
        ];

        $usuarioModel->update($oldUsuario['usuid'], $data);

        if ($usuarioModel->affectedRows() == 1) {
            if ($foto->isValid() && !$foto->hasMoved()) {
                unlink("usuarios".'/'.$oldFoto);
                $foto->move('./usuarios', $data['usufoto']);
            }
        }

        $this->session->set('notificacion', ['label' => 'alert-info', 'mensaje' => 'Datos actualizados con éxito']);
        $this->session->markAsFlashdata('notificacion');
        return $this->response->redirect(base_url('/usuario/perfil'));
    }

    public function cambiarClave() {
        if (!parent::isLogged())
            return redirect()->back();
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->findUser($this->session->usuario['nick']);

        echo view('templates/head', ['titulo' => 'Cambiar clave']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('usuario/cambiarclave', ['usuario' => $usuario]);
        echo view('templates/footer');
    }

    public function actualizarClave() {
        if (!parent::isLogged())
            return redirect()->back();
        $oldClave = sha1(trim($this->request->getVar('Clave')));
        $newClave = sha1(trim($this->request->getVar('NuevaClave')));
        $confirmNewClave = sha1(trim($this->request->getVar('NuevaClaveConfirmar')));

        $usuarioModel = new UsuarioModel();
        $usuarioOld = $usuarioModel->findUser($this->session->usuario['nick']);

        $puedeActualizar = false;
        if ($oldClave === $usuarioOld['usupassword'] && $newClave === $confirmNewClave) 
            $puedeActualizar = true;
        
        if (!$puedeActualizar) {
            $this->session->set('notificacion', 'Error, verifique las claves ingresadas');
            $this->session->markAsFlashdata('notificacion');
            return $this->response->redirect(base_url('/usuario/cambiarclave'));
        }

        $data = ['usupassword' => $newClave];

        $usuarioModel->update($usuarioOld['usuid'], $data);
        $this->session->set('notificacion', 'Clave cambiada satisfactoriamente');
        $this->session->markAsFlashdata('notificacion');
        return $this->response->redirect(base_url('/usuario/cambiarclave'));
    }

    public function listarPreguntas() {
        if (!parent::isLogged())
            return redirect()->back();

        $usuarioModel = new UsuarioModel();
        $preguntas = $usuarioModel->getPreguntas($this->session->usuario['nick']);
        echo view('templates/head', ['titulo' => 'Mis Preguntas']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('usuario/preguntas', ['preguntas' => $preguntas]);
        echo view('templates/footer');

    }

    public function listarRespuestas() {
        if (!parent::isLogged())
            return redirect()->back();

        $usuarioModel = new UsuarioModel();
        $respuestas = $usuarioModel->getRespuestas($this->session->usuario['nick']);

        echo view('templates/head', ['titulo' => 'Mis Respuestas']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('usuario/respuestas', ['respuestas' => $respuestas]);
        echo view('templates/footer');
    }

    public function elegirDestacadas() {
        if (!parent::isLogged())
            return redirect()->back();
        
        $usuarioModel = new UsuarioModel();
        $preguntas = $usuarioModel->getPreguntasElegirDestacada($this->session->usuario['nick']);

        echo view('templates/head', ['titulo' => 'Mis Respuestas']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('usuario/destacada', ['preguntas' => $preguntas]);
        echo view('templates/footer');
    }

    public function encerarPuntos($id = null) {
        if (!parent::isAdmin())
            return redirect()->back();

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);
        
        echo view('templates/head', ['titulo' => 'Encerar Puntos']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('admin/usuarios/encerarPuntos', ['usuario' => $usuario]);
        echo view('templates/footer');
    }

    public function encerar() {
        if (!parent::isAdmin())
            return redirect()->back();

        $request = $this->request->getPost();

        if($request['Pts'] < 0) {
            $this->session->set('notificacion', 'Los puntos ingresados deben ser mayor o igual a 0');
            $this->session->markAsFlashdata('notificacion');
            return $this->response->redirect(base_url('admin/usuarios/encerarPuntos/'.'/'.$request['Id']));
        }

        $usuarioModel = new UsuarioModel();
        $mensajesModel = new MensajesModel();

        $admin = $usuarioModel->findUser($this->session->usuario['nick']);
        $emision = new Time('now');
        $data = ['usupuntos' => $request['Pts']];
        $mensaje = ['admid' => $admin['usuid'],
                    'usuid' => $request['Id'],
                    'macontenido' => 'Puntaje encerado. Antes: ' . $request['oldPts'] . ', Ahora: ' . $request['Pts']
                                     .  '<br /> Motivo: ' . $request['Razon'],
                    'maemision' => $emision->toDateString()];

        $usuarioModel->update($request['Id'], $data);
        $mensajesModel->insert($mensaje);

        $this->session->set('notificacion', ['label' => 'alert-success', 'mensaje' => 'Puntos encerados con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/usuarios'));
    }

    public function listarNotificaciones() {
        if (!parent::isLogged())
            return redirect()->back();

        $usuarioModel = new UsuarioModel();
        $mensajesModel = new MensajesModel();

        $usuario = $usuarioModel->findUser($this->session->usuario['nick']);
        $mensajes = $mensajesModel->getMensajes($usuario['usuid']);

        echo view('templates/head', ['titulo' => 'Notificaciones']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);
        echo view('usuario/notificaciones', ['mensajes' => $mensajes]);
        echo view('templates/footer');
    }
}
?>