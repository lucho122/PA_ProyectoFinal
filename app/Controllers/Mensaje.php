<?php namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\PreguntaModel;
use App\Models\MensajesModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Controller;

class Mensaje extends Controller
{
	public function notificar()
	{
        $preguntaModel = new PreguntaModel();
        $mensajesModel = new MensajesModel();

        $usuarios = $preguntaModel->getPreguntasCerradasSD();
        $emision = new Time('now');
        foreach ($usuarios as $usuario) {
            $data = ['admid' => 1, 'usuid' => $usuario->usuid,
                     'macontenido' => 'Tiene respuestas destacadas por elegir, revisarlas por favor',
                     'maemision' => $emision->toDateString()];

            $mensajesModel->insert($data);
        }

        echo 'Puntos restados y Usuarios notificados';
    }
    
    public function restarpuntos() {
        $preguntaModel = new PreguntaModel();
        $mensajesModel = new MensajesModel();
        $usuarioModel = New UsuarioModel();

        $usuarios = $preguntaModel->getPreguntasPenalizar();

        $emision = new Time('now');
        foreach ($usuarios as $usuario) {
            $data = ['admid' => 1, 'usuid' => $usuario->usuid,
                     'macontenido' => 'Ha sido penalizado, por no elegir la respuesta destacada de ' . $usuario->pretitulo,
                     'maemision' => $emision->toDateString()];
            $data2 = ['prepenalizada' => true];

            $usuPenalizado = $usuarioModel->find($usuario->usuid);
            $data3 = ['usupuntos' => $usuPenalizado['usupuntos'] - 3];

            $mensajesModel->insert($data);
            $preguntaModel->update($usuario->preid, $data2);
            $usuarioModel->update($usuPenalizado['usuid'], $data3);
        }
        $this->notificar();
    }
}
