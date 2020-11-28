<div class="container">
<?php
if (isset($_SESSION['errores'])) { ?>
    <?php foreach ($_SESSION['errores'] as $error) { ?>
        <div class="alert alert-danger alert-dismissible fade show " role="alert"><?php  echo $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
<?php } ?>
    <div class="row justify-content-md-center">
    <form action="<?= base_url('admin/usuarios/actualizar'); ?>" method="post">
    <br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="PNombre">Primer Nombre *</label>
                <input type="text" class="form-control form-control-sm" name="PNombre" value="<?= $usuario['usupnombre']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="SNombre">Segundo Nombre</label>
                <input type="text" class="form-control form-control-sm" name="SNombre" value="<?= $usuario['ususnombre']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="PApellido">Primer Apellido *</label>
                <input type="text" class="form-control form-control-sm" name="PApellido" value="<?= $usuario['usupapellido']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="SApellido">Segundo Apellido</label>
                <input type="text" class="form-control form-control-sm" name="SApellido" value="<?= $usuario['ususapellido']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="FechaNacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control form-control-sm" name="FechaNacimiento" value="<?= $usuario['usufechanacimiento']; ?>">
        </div>
        <div class="form-group">
            <label for="Nick">Nick *</label>
            <input type="text" readonly class="form-control-plaintext" name="Nick" value="<?= $usuario['usunick']; ?>">
        </div>
        <div class="form-group">
            <label for="Sexo">Sexo *</label>
            <div class="radio">
                <input type="radio" name="Sexo" value="m" <?= $usuario['ususexo'] == 't' ? 'checked' : '' ?>> Masculino
            </div>
            <div class="radio">
                <input type="radio" name="Sexo" value="f" <?= $usuario['ususexo'] == 'f' ? 'checked' : '' ?>> Femenino
            </div>
        </div>

        <input type="hidden" name="Id" value=<?= $usuario['usuid'] ?>>

        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-dark" value="Actualizar">
        </div>
    </form>
    </div>
    <br>
</div>