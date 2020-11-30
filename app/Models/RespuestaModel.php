<?php
namespace App\Models;

use CodeIgniter\Model;
use Config\Constantes\Constantes;

class RespuestaModel extends Model
{
    protected $table      = 'respuesta';
    protected $primaryKey = 'resid';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['preid', 'usuid', 'rescontenido', 'resdestacada', 'resfecha'];

    protected $useTimestamps = false;


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public function getRespuestasPregunta($id = null)
    {
        return $this->asObject()->select("resid, respuesta.preid, respuesta.usuid, usufoto, usunick, rescontenido, resdestacada, TO_CHAR(resfecha :: DATE, 'dd/mm/yyyy') AS resfecha", false)
                                ->join('usuario', 'respuesta.usuid = usuario.usuid')
                                ->where('preid', $id)
                                ->orderBy('resdestacada DESC, resfecha DESC')
                                ->paginate(Constantes::PAG_MAX);
    }

    public function getRespuestas() {
        return $this->asArray()->select('resid, respuesta.preid, usunick AS autor, rescontenido AS respuesta')
                               ->join('pregunta', 'respuesta.preid = pregunta.preid')
                               ->join('usuario', 'respuesta.usuid = usuario.usuid')
                               ->get()
                               ->getResult();
    }
}

?>