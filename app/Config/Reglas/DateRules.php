<?php
namespace Config\Reglas;

class DateRules
{
    public function edad_minima(string $str = null): bool
    {
        $format = 'Y-m-d';
        $edad = \DateTime::createFromFormat($format, $str)->diff(new \DateTime())->y;
        return ($edad >= 12) ? true : false;
    }

    public function fecha_nacimiento(string $str = null): bool
    {
        $format = 'Y-m-d';
        $edad = \DateTime::createFromFormat($format, $str)->diff(new \DateTime())->invert;
        return ($edad === 0) ? true : false;
    }
}
?>