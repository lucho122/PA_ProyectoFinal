<?php namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use App\Models\PreguntaModel;

class Home extends BaseController
{
	public function index()
	{
		$categoriaModel = new CategoriaModel();
		$preguntaModel = new PreguntaModel();

		$categorias = $categoriaModel->getCategoriaPreguntas();
		$preguntas = $preguntaModel->getPreguntasRandom();

		$usuario = (isset($this->session->usuario)) ? $this->session->usuario : ['nick' => 'invitado', 'pts' => -1];
		echo view('templates/head', ['titulo' => 'Sistema de Preguntas y Respuestas']);
        echo view('templates/navbar', ['usuario' => $usuario]);
        echo view('index', ['categorias' => $categorias	, 'preguntas' => $preguntas]);
        echo view('templates/footer');
	}

}
