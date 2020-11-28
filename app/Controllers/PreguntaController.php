<?php
namespace App\Controllers;
use App\Models\PreguntaModel;
use App\Models\RespuestaModel;
use App\Models\CategoriaModel;
use App\Models\UsuarioModel;
use CodeIgniter\I18n\Time;

class PreguntaController extends BaseController 
{
    public function index($id = null) {
        $preguntaModel = new PreguntaModel();

        $pregunta = $preguntaModel->find($id);
        $respuestaModel = new RespuestaModel();
        $respuestas = $respuestaModel->where('preid', $id)->orderBy('resfecha', 'desc')->findAll();
        echo view('templates/head', ['titulo' => $pregunta['pretitulo']]);
        echo view('templates/navbar', ['usuario' => $this->session->usuario, 'respuestas' => $respuestas]);    
        echo view('pregunta/index', ['pregunta' => $pregunta]);
        echo view('templates/footer');
    }

    public function preguntar() {
        if (!parent::isLogged())
            return $this->response->redirect(base_url('register'));
        
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        echo view('templates/head', ['titulo' => 'Haz una Pregunta']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);    
        echo view('pregunta/preguntar', ['categorias' => $categorias]);
        echo view('templates/footer');
    }

    public function crear() {
        $request = $this->request->getPost();

        $request['Titulo'] = trim($request['Titulo']);
        $request['Descripcion'] = trim($request['Descripcion']);

        $usuarioModel = new UsuarioModel();
        $preguntaModel = new PreguntaModel();

        $usuario = $usuarioModel->where('usunick', $this->session->usuario['nick'])->findAll();
        $inicio = new Time('now');
        $fin = new Time('+5 day');

        $data = [
            'catid' => $request['Categoria'],
            'usuid' => $usuario[0]['usuid'],
            'pretitulo' => $request['Titulo'],
            'predescripcion' => $request['Descripcion'],
            'prefechainicio' => $inicio->toDateString(),
            'prefechacierre' => $fin->toDateString()
        ];

        $preguntaModel->insert($data);
        $id = $preguntaModel->insertID();
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
        $preguntaModel = new PreguntaModel();

        $preguntas = $preguntaModel->getAllPreguntas();

        echo view('templates/head', ['titulo' => 'Preguntas | Admin']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);    
        echo view('admin/preguntas/index', ['preguntas' => $preguntas]);
        echo view('templates/footer');
    }

    public function editar($id = null) {
        if (!parent::isAdmin())
            return redirect()->back();

        $preguntaModel = new PreguntaModel();
        $pregunta = $preguntaModel->find($id);
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        echo view('templates/head', ['titulo' => 'Editar Pregunta']);
        echo view('templates/navbar', ['usuario' => $this->session->usuario]);  
        echo view('admin/preguntas/editar', ['pregunta' => $pregunta, 'categorias' => $categorias]);
        echo view('templates/footer');
    }

    public function actualizar() {
        if (!parent::isAdmin())
            return redirect()->back();
        $request = $this->request->getPost();
        $preguntaModel = new PreguntaModel();
        
        $id = trim($request['Id']);
        $data = [
            'catid' => $request['Categoria'],
            'pretitulo' => $request['Titulo'],
            'predescripcion' => $request['Descripcion'],
            'prefechacierre' => $request['Cierre']
                 ];

        $preguntaModel->update($id, $data);

        $this->session->set('notificacion', ['label' => 'alert-info', 'mensaje' => 'Pregunta actualizada con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/preguntas'));
    }

    public function eliminar() {
        if (!parent::isAdmin())
            return redirect()->back();
        $preguntaModel = new PreguntaModel();
        $id = trim($this->request->getVar('Id'));
        $preguntaModel->delete($id);

        $this->session->set('notificacion', ['label' => 'alert-danger', 'mensaje' => 'Pregunta eliminada con éxito']);
        $this->session->markAsFlashdata('notificacion');

        return $this->response->redirect(base_url('/admin/preguntas'));
    }
}

?>