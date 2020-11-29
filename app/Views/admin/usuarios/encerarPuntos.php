<div class="container">
<?php
if (isset($_SESSION['notificacion'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show " role="alert"><?php echo $_SESSION['notificacion']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
    <div class="row justify-content-md-center">
    <form action="<?= base_url('admin/usuarios/encerarPuntos'); ?>" method="post">
    <br>
        <input type="hidden" name="oldPts" value="<?= $usuario['usupuntos']; ?>">
        <div class="form-group row">
            <label for="Pts">Puntos *</label>
            <input type="text" class="form-control form-control-sm" name="Pts" value="<?= $usuario['usupuntos']; ?>">
        </div>

        <div class="form-group row">
            <label for="Razon">Razón *</label>
            <textarea class="form-control" name="Razon" rows="4"></textarea>
        </div>
        
        <input type="hidden" name="Id" value=<?= $usuario['usuid'] ?>>

        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-dark" value="Encerar">
        </div>
    </form>
    </div>
    <br>
</div>