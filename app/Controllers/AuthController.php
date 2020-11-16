<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class AuthController extends Controller
{
	public function index()
	{
		return view('login');
    }

    public function register() {
        return view ('register');
    }

    public function registrar() {
        $request = $this->request;
        $usuarioModel = new UsuarioModel();

        $data = [
            'rolid' => 2,
            'usupnombre' => trim($request->getVar('PNombre')),
            'ususnombre' => trim($request->getVar('SNombre')),
            'usupapellido' => trim($request->getVar('PApellido')),
            'ususapellido' => trim($request->getVar('SApellido')),
            'usufechanacimiento' => $request->getVar('FechaNacimiento'),
            'usunick' => trim($request->getVar('Nick')),
            'usupassword' => sha1(trim($request->getVar('Clave'))),
            'ususexo' => ($request->getVar('Sexo') === 'm') ? true : false,
            'usuemail' => trim($request->getVar('Email')),
            'usufoto' => 'loquesea.jpg',
            'usupuntos' => 20
        ];

        # Devuelve 2 si se ejecuto el ISNERT de manera correcta.
        $insertar = $usuarioModel->insert($data);

        $sesion = session();
        $sesion->set('usuario', ['nick' => $data['usunick'], 'rol' => $data['rolid']]);
        return $this->response->redirect(site_url('/'));
    }
    
    public function login() {
        $usuarioModel = new UsuarioModel();
        $data = [
            'nick' => $this->request->getVar('nick'),
            'password'  => sha1(trim($this->request->getVar('password'))),
        ];
        $usuario = $usuarioModel->where('usunick', $data['nick'])->first();
        if ($usuario['usupassword'] === $data['password']) {
            $sesion = session();
            $sesion->set('usuario', ['nick' => $usuario['usunick'], 'rol' => $usuario['rolid']]);
            return $this->response->redirect(site_url('/'));
        }
        else
            return view('login', ['error' => 'Usuario o contrasenia incorrecta']);
    }
    
    public function logout() {
        $session = session();
        $session->destroy();
        return $this->response->redirect(site_url('/'));
    }

}