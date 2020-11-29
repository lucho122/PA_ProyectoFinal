<?php 
namespace App\Controllers;
use App\Models\UsuarioModel;
use Config\Constantes\Constantes;

class AuthController extends BaseController
{
	public function index()
	{
        if (parent::isLogged())
            return redirect()->back();
            
		return view('login');
    }

    public function register() {
        if (parent::isLogged())
            return redirect()->back();

        $usuario = (isset($this->session->usuario)) ? $this->session->usuario : ['nick' => 'invitado', 'pts' => -1];
        echo view ('templates/head', ['titulo' => 'Registro']);
        echo view('templates/navbar', ['usuario' => $usuario]);
		echo view ('register');
		echo view ('templates/footer');
    }

    public function registrar() {
        $usuarioModel = new UsuarioModel();
        $request = $this->request->getPost();
        $request['PNombre'] = trim($request['PNombre']);
        $request['SNombre'] = trim($request['SNombre']);
        $request['PApellido'] = trim($request['PApellido']);
        $request['SApellido'] = trim($request['SApellido']);
        $request['Nick'] = trim($request['Nick']);
        $request['Email'] = trim($request['Email']);

        $this->validation->setRuleGroup('registro_usuario');

        $validacion = $this->validation->run($request);
        if ($validacion) {
            $foto = $this->request->getFile('Foto');
            $data = [
                'rolid' => Constantes::ROL_REGISTRADO,
                'usupnombre' => $request['PNombre'],
                'ususnombre' => $request['SNombre'],
                'usupapellido' => $request['PApellido'],
                'ususapellido' => $request['SApellido'],
                'usufechanacimiento' => $request['FechaNacimiento'],
                'usunick' =>  $request['Nick'],
                'usupassword' => sha1($request['Clave']),
                'ususexo' => ($request['Sexo'] == 'm') ? true : false,
                'usuemail' => $request['Email'],
                'usufoto' => $request['Nick'] . '.' . $foto->getExtension(),
                'usupuntos' => Constantes::PUNTAJE_MINIMO
            ];
            $usuarioModel->insert($data);

            if ($usuarioModel->affectedRows() == 1) {
                if ($foto->isValid() && !$foto->hasMoved()) {
                    $foto->move('./usuarios', $data['usufoto']);
                }
            }
            $usuario = $usuarioModel->where('usunick', $data['nick'])->first();

            $this->session->set('usuario', ['nick' => $data['usunick'], 'rol' => $data['rolid'],
                                            'id' => $data['usuid'], 'pts' => $data['usupuntos']]);
            return $this->response->redirect(base_url('/'));
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
        $usuario = $usuarioModel->findUser($data['nick']);
        if ($usuario['usupassword'] === $data['password']) {
            $this->session->set('usuario', ['nick' => $usuario['usunick'], 'rol' => $usuario['rolid'], 
                                            'id' => $usuario['usuid'], 'pts' => $usuario['usupuntos']]);
            return $this->response->redirect(base_url('/'));
        }
        else
            return view('login', ['error' => 'Usuario o contrasenia incorrecta']);
    }
    
    public function logout() {
        $session = session();
        $session->destroy();
        return $this->response->redirect(base_url('/'));
    }

}