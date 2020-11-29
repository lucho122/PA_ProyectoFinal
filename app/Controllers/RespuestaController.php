<?php
namespace App\Controllers;
use App\Models\RespuestaModel;
use App\Models\PreguntaModel;
use App\Models\UsuarioModel;
use CodeIgniter\I18n\Time;

class RespuestaController extends BaseController 
{
    public function index($id = null) {
    }

    public function responder() {
        $request = $this->request->getPost();
        $request['Respuesta'] = trim($request['Respuesta']);

        $usuarioModel = new UsuarioModel();
        $respuestaModel = new RespuestaModel();

        $usuario = $usuarioModel->where('usunick', $this->session->usuario['nick'])->findAll();

        $fCreacion = new Time('now');

        $data = [
            'preid' => $request['Pregunta'],
            'usuid' => $usuario[0]['usuid'],
            'rescontenido' => $request['Respuesta'],
            'resdestacada' => false,
            'resfecha' => $fCreacion->toDateString()
        ];

        $respuestaModel->insert($data);
        $id = $request['Pregunta'];
        $this->actualizarPuntaje();
        return $this->response->redirect(base_url('pregunta/'.$id));
    }

    private function actualizarPuntaje() {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->findUser($this->session->usuario['nick']);
        
        $this->session->set('usuario', ['nick' => $usuario['usunick'], 'rol' => $usuario['rolid'],
        'id' => $usuario['usuid'], 'pts' => $usuario['usupuntos']]);
    }

    public function adminIndex() {
        if (!parent::isAdmin())
            return redirect()->back();

        $respuestaModel = new RespuestaModel();

        $respuestas = $respuestaModel->getRespuestas();

        echo view('templates/head', ['titulo' => 'Respuestas | Admin']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);    
        echo view('admin/respuestas/index', ['respuestas' => $respuestas]);
        echo view('templates/footer');
    }

    public function adminEditar($id = null) {
        if (!parent::isAdmin())
            return redirect()->back();

        $respuestaModel = new RespuestaModel();
        $respuesta = $respuestaModel->find($id);

        echo view('templates/head', ['titulo' => 'Editar Respuesta']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);  
        echo view('admin/respuestas/editar', ['respuesta' => $respuesta]);
        echo view('templates/footer');
    }

    public function adminActualizar() {
        if (!parent::isAdmin())
            return redirect()->back();

        $request = $this->request->getPost();
        $respuestaModel = new RespuestaModel();
        
        $id = trim($request['Id']);
        $data = ['rescontenido' => $request['Respuesta']];

        $respuestaModel->update($id, $data);

        $this->session->set('notificacion', ['label' => 'alert-info', 'mensaje' => 'Respuesta actualizada con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/respuestas'));
    }

    public function eliminar() {
        if (!parent::isAdmin())
            return redirect()->back();

        $respuestaModel = new RespuestaModel();
        $id = trim($this->request->getVar('Id'));
        $respuestaModel->delete($id);

        $this->session->set('notificacion', ['label' => 'alert-danger', 'mensaje' => 'Respuesta eliminada con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/respuestas'));
    }

    public function editar($id = null) {
        if (!parent::isLogged())
            return redirect()->back();
        $preguntaModel = new PreguntaModel();
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->findUser($this->session->usuario['nick']);
        $respuestaModel = new RespuestaModel();
        $respuesta = $respuestaModel->find($id);
        $pregunta = $preguntaModel->getPregunta($respuesta['preid']);

        $isCerrada = (new Time('now') > $pregunta->prefechacierre) ? true : false;

        if($isCerrada || $usuario['usuid'] != $respuesta['usuid'])
            return redirect()->back();

        echo view('templates/head', ['titulo' => 'Editar Respuesta']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);  
        echo view('pregunta/editarRespuesta', ['respuesta' => $respuesta]);
        echo view('templates/footer');
        
    }

    public function actualizar() {
        if (!parent::isLogged())
            return redirect()->back();
    
        $request = $this->request->getPost();
        $respuestaModel = new RespuestaModel();
        
        $pregunta = trim($request['Pregunta']);
        $fCreacion = new Time('now');
        $id = $request['Id'];
        $data = [
                'rescontenido' => $request['Respuesta'],
                'resfecha' => $fCreacion->toDateString(),
                 ];

        $respuestaModel->update($id, $data);

        return $this->response->redirect(base_url('pregunta/'.$pregunta));
    }
}

?>