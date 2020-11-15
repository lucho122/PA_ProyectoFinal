<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<?php 
if (isset($error))
    echo $error;
?>
<body>
    <form action="<?php site_url('/login'); ?>" method="post">
        <input type="text" name="nick">
        <input type="password" name="password">
        <input type="submit" value="Iniciar Sesion">
    </form>
</body>
</html>