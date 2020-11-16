<?php namespace App\Controllers;
use App\Models\UsuarioModel;

class Home extends BaseController
{
	public function index()
	{
		$usuario = (isset($this->session->usuario)) ? $this->session->usuario : ['nick' => 'invitado','rol' => -1];
		return view('welcome_message', ['usuario' => $usuario]);
	}

}
