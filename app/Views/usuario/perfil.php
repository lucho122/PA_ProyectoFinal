<div class="container">
<?php
if (isset($_SESSION['notificacion'])) { ?>
    <div class="alert <?php echo $_SESSION['notificacion']['label']; ?> alert-dismissible fade show " role="alert"><?php echo $_SESSION['notificacion']['mensaje']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

    <div class="row justify-content-md-center">
    <form action="<?= base_url('usuario/actualizarPerfil'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="Nick" value="<?= $usuario['usunick']; ?>">

    <br>
        <div class="col-md-12 text-center">
            <img class="img-thumbnail rounded-circle" width="100" src="<?= base_url('usuarios/'.$usuario['usufoto']."?t=10");  ?>" alt="foto">
        </div>
        <br>
        <div class="form-group">
            <label for="Email">Correo electrónico *</label>
            <input required type="text" class="form-control form-control-sm" name="Email" value="<?= $usuario['usuemail']; ?>">
        </div>
        <div class="form-group">
            <label for="Foto">Foto *</label>
            <input type="file" name="Foto" required>
        </div>
        <div class="form-group">
            <a class="btn btn-danger" href="<?= base_url('usuario/cambiarclave'); ?>">Cambiar clave</a>
        </div>
        <br>
        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-dark" value="Actualizar">
        </div>
    </form>
    </div>
    <br>
</div>
<br>
<div class="col-md-12 text-center">
          <a href="http://localhost:8080/index.php"><button type="button" class="btn btn-dark">Regresar</button></a>
        </div>