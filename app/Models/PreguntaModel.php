<?php
namespace App\Models;

use CodeIgniter\Model;

class PreguntaModel extends Model
{
    protected $table      = 'pregunta';
    protected $primaryKey = 'preid';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['catid', 'usuid', 'pretitulo', 'predescripcion', 'prefechainicio', 'prefechacierre'];

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

    public function getAllPreguntas() {
         return $this->asArray()->select('pregunta.preid, usunick AS autor, catnombre AS categoria, pretitulo, 
                                         predescripcion, 
                                         prefechainicio AS fcreacion, prefechacierre AS fcierre', false)
                                ->join('usuario', 'pregunta.usuid = usuario.usuid')
                                ->join('categoria', 'pregunta.catid = categoria.catid')
                                ->get()
                                ->getResult();
    }
    
}

?>