<?php
namespace App\Models;

use CodeIgniter\Model;
use Config\Constantes\Constantes;

class CategoriaModel extends Model
{
    protected $table      = 'categoria';
    protected $primaryKey = 'catid';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['catnombre'];

    protected $useTimestamps = false;


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getCategoriaPreguntas() {
        return $this->asArray()->select("categoria.catid, catnombre, count(pregunta.preid) AS preguntas", false)
                                ->join('pregunta', 'categoria.catid = pregunta.catid', 'left')
                                ->groupBy('categoria.catid')
                                ->orderBy('preguntas', 'desc')
                                ->get()
                                ->getResult();
    }

    public function getPreguntas($id = null) {
        return $this->asObject()->select("preid, categoria.catid, catnombre, pregunta.usuid, usuario.usunick, 
                                         pretitulo, predescripcion, TO_CHAR(prefechainicio :: DATE, 'dd/mm/yyyy') AS prefechainicio", false)
                                ->join('pregunta', 'pregunta.catid = categoria.catid')
                                ->join('usuario', 'pregunta.usuid = usuario.usuid')
                                ->where('categoria.catid', $id)
                                ->paginate(Constantes::PAG_MAX);
   }
}

?>