<?php
namespace App\Models;

use CodeIgniter\Model;

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
    
}

?>