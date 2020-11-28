<?php
namespace App\Models;

use CodeIgniter\Model;

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
}

?>