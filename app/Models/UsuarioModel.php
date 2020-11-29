<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'usuid';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['usuid','rolid', 'usupnombre', 'usupapellido', 'ususnombre', 
                                'ususapellido', 'usufechanacimiento', 'usunick', 'usupassword', 'ususexo',
                                'usuemail', 'usufoto', 'usupuntos'];

    protected $useTimestamps = false;


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function findUser($nick)
    {    
        return $this->asArray()->where('usunick', $nick)->first();
    }

    public function getUsers()
    {
        return $this->asArray()->select("usuid, usunick, rolnombre AS rol, 
                                        CONCAT(usupnombre,' ', ususnombre) AS nombres, 
                                        CONCAT(usupapellido,' ', ususapellido) AS apellidos, 
                                        ususexo, usufechanacimiento, usuemail, usufoto, usupuntos", false)
                                ->join('rol', 'usuario.rolid = rol.rolid')
                                ->get()
                                ->getResult();
    }

    public function getPreguntas($nick) {
        return $this->asArray()->select("usunick, catnombre, preid, pretitulo, 
                                        TO_CHAR(prefechainicio :: DATE, 'dd/mm/yyyy') AS prefechainicio, predescripcion", false)
                                ->join('pregunta', 'usuario.usuid = pregunta.usuid')
                                ->join('categoria', 'pregunta.catid = categoria.catid')
                                ->where('usunick', $nick)
                                ->orderBy('prefechainicio', 'desc')
                                ->get()
                                ->getResult();
    }

    public function getRespuestas($nick) {
        return $this->asArray()->select("usunick, catnombre, respuesta.preid, pretitulo, 
                                         TO_CHAR(resfecha :: DATE, 'dd/mm/yyyy') AS resfecha, rescontenido", false)
                                ->join('respuesta', 'usuario.usuid = respuesta.usuid')
                                ->join('pregunta', 'respuesta.preid = pregunta.preid')
                                ->join('categoria', 'pregunta.catid = categoria.catid')
                                ->where('usunick', $nick)
                                ->orderBy('resfecha', 'desc')
                                ->get()
                                ->getResult();
    }

    public function getPreguntasElegirDestacada($nick) {
        return $this->asArray()->select("usunick, catnombre, pregunta.preid, pretitulo, TO_CHAR(prefechacierre :: DATE, 'dd/mm/yyyy') AS prefechacierre, 
                                        predescripcion, COUNT(CASE WHEN respuesta.resdestacada THEN 1 END) AS hayDestacada", false)
                                ->join('pregunta', 'usuario.usuid = pregunta.usuid')
                                ->join('categoria', 'pregunta.catid = categoria.catid')
                                ->join('respuesta', 'respuesta.preid = pregunta.preid')
                                ->groupBy('pregunta.preid, usunick, catnombre')
                                ->having('usunick', $nick)
                                ->having('(current_date - prefechacierre) >', 0)
                                ->having(' COUNT(CASE WHEN respuesta.resdestacada THEN 1 END)', 0)
                                ->orderBy('prefechacierre', 'desc')
                                ->get()
                                ->getResult();
    }
}

?>