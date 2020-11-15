<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
</head>
<body>
    <form action="<?php site_url('/register'); ?>" method="post">
        Primer nombre&nbsp;*&nbsp;<input type="text" name="PNombre"><br>
        Segundo nombre&nbsp;<input type="text" name="SNombre"><br>
        Primer apellido&nbsp;*&nbsp;<input type="text" name="PApellido"><br>
        Segundo apellido&nbsp;<input type="text" name="SApellido"><br>
        Fecha de Nacimiento&nbsp;*&nbsp;<input type="date" name="FechaNacimiento"><br>
        Nickname&nbsp;*&nbsp;<input type="text" name="Nick"><br>
        Contraseña&nbsp;*&nbsp;<input type="password" name="Clave"><br>
        Sexo<br>
        <input type="radio" name="Sexo" value="m" checked> Masculino&nbsp;&nbsp;
        <input type="radio" name="Sexo" value="f"> Femenino<br>
        Correo electrónico&nbsp;*&nbsp;<input type="text" name="Email"><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>