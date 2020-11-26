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
        
        # $respuestaModel = new RespuestaModel();
        # $respuestas = $respuestaModel->where('preid', $id)->orderBy('resfecha', 'desc')->findAll();
        echo view('templates/head', ['titulo' => $pregunta['pretitulo']]);
        echo view('templates/navbar');
        echo view('pregunta/index', ['pregunta' => $pregunta]);
        echo view('templates/footer');
    }

    public function preguntar() {
        if (!parent::isLogged())
            return $this->response->redirect(base_url('register'));
        
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        echo view('templates/head', ['titulo' => 'Haz una Pregunta']);
        echo view('templates/navbar');
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
        return $this->response->redirect(base_url('pregunta/'.$id));
    }
}

?>