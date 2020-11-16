<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{


	public function index()
	{
		return view('login');
    }

    public function register() {
        return view ('register');
    }

    public function registrar() {
        $usuarioModel = new UsuarioModel();
        $this->validation->setRuleGroup('registro_usuario');
        $validacion = $this->validation->withRequest($this->request)->run();
        if ($validacion) {
            $request = $this->request; 
            $foto = $request->getFile('Foto');
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
                'usufoto' => $request->getVar('Nick').'.'. $foto->getExtension(),
                'usupuntos' => 20
            ];
            if ($foto->isValid() && !$foto->hasMoved()) {
                $foto->move('./usuarios', $data['usufoto']);
            }
            # Devuelve 2 si se ejecuto el ISNERT de manera correcta.
            $insertar = $usuarioModel->insert($data);
            $this->session->set('usuario', ['nick' => $data['usunick'], 'rol' => $data['rolid']]);
            return $this->response->redirect(site_url('/'));
        }
        $errores = $this->validation->getErrors();
        return redirect()->back()->withInput()->with('errores', $errores);
    }
    
    public function login() {
        $usuarioModel = new UsuarioModel();
        $data = [
            'nick' => $this->request->getVar('nick'),
            'password'  => sha1(trim($this->request->getVar('password'))),
        ];
        $usuario = $usuarioModel->where('usunick', $data['nick'])->first();
        if ($usuario['usupassword'] === $data['password']) {
            $this->session->set('usuario', ['nick' => $usuario['usunick'], 'rol' => $usuario['rolid']]);
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