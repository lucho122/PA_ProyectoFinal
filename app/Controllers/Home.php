<?php namespace App\Controllers;
use App\Models\UsuarioModel;

class Home extends BaseController
{
	public function index()
	{
		$sesion = session();

		$usuario = (isset($sesion->usuario)) ? $sesion->usuario : ['nick' => 'invitado','rol' => -1];
		return view('welcome_message', ['usuario' => $usuario]);
	}

	//--------------------------------------------------------------------

}
