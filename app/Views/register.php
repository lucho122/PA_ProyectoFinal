<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
</head>
<body>
<?php
if (isset($_SESSION['errores'])) {
    foreach ($_SESSION['errores'] as $error) {
        echo $error . "<br>";
    }
}
?>
    <form action="<?php site_url('/register'); ?>" method="post" enctype="multipart/form-data">
        Primer nombre&nbsp;*&nbsp;<input type="text" name="PNombre" value="<?= old('PNombre'); ?>"><br><br>
        Segundo nombre&nbsp;<input type="text" name="SNombre" value="<?= old('SNombre'); ?>"><br><br>
        Primer apellido&nbsp;*&nbsp;<input type="text" name="PApellido"  value="<?= old('PApellido'); ?>"><br><br>
        Segundo apellido&nbsp;<input type="text" name="SApellido" value="<?= old('SApellido'); ?>"><br><br>
        Fecha de Nacimiento&nbsp;*&nbsp;<input type="date" name="FechaNacimiento" value="<?= old('FechaNacimiento'); ?>"><br><br>
        Nick&nbsp;*&nbsp;<input type="text" name="Nick" value="<?= old('Nick'); ?>"><br><br>
        Contraseña&nbsp;*&nbsp;<input type="password" name="Clave"><br><br>
        Confirmar Contraseña&nbsp;*&nbsp;<input type="password" name="ClaveConfirmar"><br><br>
        Sexo *<br>
        <input type="radio" name="Sexo" value="m" checked> Masculino&nbsp;&nbsp;
        <input type="radio" name="Sexo" value="f"> Femenino<br><br>
        Correo electrónico&nbsp;*&nbsp;<input type="text" name="Email" value="<?= old('Email'); ?>"><br><br>
        Foto&nbsp;*&nbsp;<input type="file" name="Foto"><br><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>