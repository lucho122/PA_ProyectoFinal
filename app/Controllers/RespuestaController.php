<?php
namespace App\Controllers;
use App\Models\RespuestaModel;
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
        $respuestModel = new RespuestaModel();

        $usuario = $usuarioModel->where('usunick', $this->session->usuario['nick'])->findAll();

        $fCreacion = new Time('now');

        $data = [
            'preid' => $request['Pregunta'],
            'usuid' => $usuario[0]['usuid'],
            'rescontenido' => $request['Respuesta'],
            'resdestacada' => false,
            'resfecha' => $fCreacion->toDateString()
        ];

        $respuestModel->insert($data);
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

    public function editar($id = null) {
        if (!parent::isAdmin())
            return redirect()->back();
    }

    public function actualizar() {
        if (!parent::isAdmin())
            return redirect()->back();
    }

    public function eliminar() {
        if (!parent::isAdmin())
            return redirect()->back();
    }
}

?>