<div class="container">
<?php
if (isset($_SESSION['notificacion'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show " role="alert"><?php echo $_SESSION['notificacion']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
    <div class="row justify-content-md-center">
    <form action="<?= base_url('usuario/cambiarclave'); ?>" method="post" enctype="multipart/form-data">
    <br>
        
        <div class="form-group">
            <label for="Clave">Contraseña actual *</label>
            <input type="password" class="form-control form-control-sm" name="Clave">
        </div>
        <div class="form-group">
            <label for="NuevaClave">Nueva contraseña *</label>
            <input type="password" class="form-control form-control-sm" name="NuevaClave">
        </div>
        <div class="form-group">
            <label for="NuevaClaveConfirmar">Confirmar nueva contraseña *</label>
            <input type="password" class="form-control form-control-sm" name="NuevaClaveConfirmar">
        </div>
        
        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-danger" value="Cambiar clave">
        </div>
    </form>
    </div>
    <br>
</div>