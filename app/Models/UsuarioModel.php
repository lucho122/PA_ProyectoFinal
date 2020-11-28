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
}

?>