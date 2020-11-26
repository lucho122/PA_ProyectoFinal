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

    
}

?>