
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
    <br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="PNombre">Primer Nombre *</label>
                <input type="text" class="form-control form-control-sm" name="PNombre" id="PNombre" value="<?= old('PNombre'); ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="SNombre">Segundo Nombre</label>
                <input type="text" class="form-control form-control-sm" name="SNombre" value="<?= old('SNombre'); ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="PApellido">Primer Apellido *</label>
                <input type="text" class="form-control form-control-sm" name="PApellido" id="PApellido" value="<?= old('PApellido'); ?>">
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
            
            <input type="text" class="form-control form-control-sm" name="Nick" id="Nick" value="<?= old('Nick'); ?>">
            <input type="button" value="Generar Nick" onclick="genNick()">
            <script>
                function genNick(){
                
                nombre = document.getElementById("PNombre").value;
                var GenNombre = nombre.substring(0,1);
                Genapellido  =document.getElementById("PApellido").value;
                var NumeroAleatorio = Math.floor(Math.random()*999)+100;
                document.getElementById("Nick").value = GenNombre+Genapellido+''+NumeroAleatorio;
                };
            </script>
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
        </div>
        <div class="form-group">
            <label for="Email">Correo electrónico *</label>
            <input type="text" class="form-control form-control-sm" name="Email" value="<?= old('Email'); ?>">
        </div>
        <div class="form-group">
            <label for="Foto">Foto *</label>
            <input type="file" name="Foto">
        </div>
        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-dark" value="Registrarse">
        </div>
    </form>
            
    </div>
    <br>
</div>