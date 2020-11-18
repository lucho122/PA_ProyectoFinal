<!DOCTYPE html>
<html lang="es">
<head>
<style>
<?php include 'estilos.css'; ?>
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<?php 
if (isset($error))
    echo $error;
?>
<body>
<div class="header">
  <h1>Login</h1>
  <p>Ingrese sus datos para iniciar sesión</p>
</div>
    <form action="<?php site_url('/login'); ?>" method="post">
    <div class="form-control ">
        <input type="text" name="nick" placeholder="Usuario" required autofocus><br/><br/>
        <input type="password" name="password" placeholder="Contraseña" required autofocus><br/><br/>
    </div>
    <input type="submit" value="Iniciar Sesion">
    </form>
</body>
</html>
