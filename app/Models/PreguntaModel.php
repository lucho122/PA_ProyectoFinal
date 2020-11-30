<?php
namespace App\Models;

use CodeIgniter\Model;

class PreguntaModel extends Model
{
    protected $table      = 'pregunta';
    protected $primaryKey = 'preid';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['prepenalizada', 'catid', 'usuid', 'pretitulo', 'predescripcion', 'prefechainicio', 'prefechacierre'];

    protected $useTimestamps = false;


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPreguntasRandom() {
        return $this->asArray()->select("preid, pregunta.catid, catnombre, pregunta.usuid, usuario.usunick, 
                                         pretitulo, predescripcion, TO_CHAR(prefechainicio :: DATE, 'dd/mm/yyyy') AS prefechainicio", false)
                                ->join('categoria', 'pregunta.catid = categoria.catid')
                                ->join('usuario', 'pregunta.usuid = usuario.usuid')
                                ->orderBy('RANDOM()')
                                ->limit(20)
                                ->get()
                                ->getResult();
    }

    public function getPregunta($id = null) {
        return $this->asArray()->select("preid, catnombre, usufoto, pregunta.usuid, usunick, pretitulo, predescripcion,TO_CHAR(prefechainicio :: DATE, 'dd/mm/yyyy') AS prefechainicio, prefechacierre", false)
                               ->join('usuario', 'pregunta.usuid = usuario.usuid')
                               ->join('categoria', 'pregunta.catid = categoria.catid')
                               ->where('pregunta.preid', $id)
                               ->get()
                               ->getFirstRow();
   }

    public function getAllPreguntas() {
         return $this->asArray()->select('pregunta.preid, usunick AS autor, catnombre AS categoria, pretitulo, 
                                         predescripcion, 
                                         prefechainicio AS fcreacion, prefechacierre AS fcierre', false)
                                ->join('usuario', 'pregunta.usuid = usuario.usuid')
                                ->join('categoria', 'pregunta.catid = categoria.catid')
                                ->get()
                                ->getResult();
    }
    
    public function getPreguntasCerradasSD() {
        return $this->asArray()->select('usuid', false)
                               ->where('(current_date - prefechacierre) >', 0)
                               ->where('pregunta.prepenalizada', false)
                               ->orderBy('prefechacierre', 'desc')
                               ->get()
                               ->getResult();
    }

    public function getPreguntasPenalizar() {
        return $this->asArray()->select('preid, usuid, pretitulo', false)
                               ->where('(current_date - prefechacierre) >=', 10)
                               ->where('pregunta.prepenalizada', false)
                               ->orderBy('prefechacierre', 'desc')
                               ->get()
                               ->getResult();
    }
}

?>