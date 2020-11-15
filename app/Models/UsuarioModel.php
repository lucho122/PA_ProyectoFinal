<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'usuid';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['rolid', 'usupnombre', 'usupapellido', 'ususnombre', 
                                'ususapellido', 'usufechanacimiento', 'usunick', 'usupassword', 'ususexo',
                                'usuemail', 'usufoto', 'usupuntos'];

    protected $useTimestamps = false;


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    
}

?>