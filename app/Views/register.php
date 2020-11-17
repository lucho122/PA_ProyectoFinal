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
    <form action="<?= base_url('register'); ?>" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="PNombre">Primer Nombre *</label>
                <input type="text" class="form-control form-control-sm" name="PNombre" value="<?= old('PNombre'); ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="SNombre">Segundo Nombre</label>
                <input type="text" class="form-control form-control-sm" name="SNombre" value="<?= old('SNombre'); ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="PApellido">Primer Apellido *</label>
                <input type="text" class="form-control form-control-sm" name="PApellido" value="<?= old('PApellido'); ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="SApellido">Segundo Apellido</label>
                <input type="text" class="form-control form-control-sm" name="SApellido" value="<?= old('SApellido'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="FechaNacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control form-control-sm" name="FechaNacimiento" value="<?= old('FechaNacimiento'); ?>">
        </div>
        <div class="form-group">
            <label for="Nick">Nick *</label>
            <input type="text" class="form-control form-control-sm" name="Nick" value="<?= old('Nick'); ?>">
        </div>
        <div class="form-group">
            <label for="Clave">Contraseña *</label>
            <input type="password" class="form-control form-control-sm" name="Clave">
        </div>
        <div class="form-group">
            <label for="ClaveConfirmar">Confirmar contraseña *</label>
            <input type="password" class="form-control form-control-sm" name="ClaveConfirmar">
        </div>
        <div class="form-group">
            <label for="Sexo">Sexo *</label>
            <div class="radio">
                <input type="radio" name="Sexo" value="m" checked> Masculino
            </div>
            <div class="radio">
                <input type="radio" name="Sexo" value="f"> Femenino
            </div>
        <div class="form-group">
            <label for="Email">Correo electrónico *</label>
            <input type="text" class="form-control form-control-sm" name="Email" value="<?= old('Email'); ?>">
        </div>
        <div class="form-group">
            <label for="Foto">Foto *</label>
            <input type="file" name="Foto">
        </div>
        <input type="submit" class="btn btn-primary" value="Registrarse">
    </form>
    </div>
</div>