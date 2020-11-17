<?php
namespace Config\Reglas;
use Config\Constantes\Constantes;

class DateRules
{

    public function edad(string $str = null): bool
    {
        $format = 'Y-m-d';
        $edad = \DateTime::createFromFormat($format, $str)->diff(new \DateTime())->y;
        return ($edad <= Constantes::EDAD_MAXIMA) ? (($edad >= Constantes::EDAD_MINIMA) ? true : false) : false;
    }

    public function fecha_nacimiento(string $str = null): bool
    {
        $format = 'Y-m-d';
        $edad = \DateTime::createFromFormat($format, $str)->diff(new \DateTime())->invert;
        return ($edad === 0) ? true : false;
    }
}
?>