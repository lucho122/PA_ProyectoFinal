<?php
namespace App\Models;

use CodeIgniter\Model;

class MensajesModel extends Model
{
    protected $table      = 'mensajeadministracion';
    protected $primaryKey = 'maid';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['admid', 'usuid', 'macontenido', 'maemision'];

    protected $useTimestamps = false;


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getMensajes($id) {
        return $this->asArray()->select("macontenido, maemision", false)
                               ->where('mensajeadministracion.usuid', $id)
                               ->orderBy('maid', 'desc')
                               ->get()
                               ->getResult();
    }
}

?>