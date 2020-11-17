<div class="container">
    <div class="row justify-content-md-center">
        <form action="<?= base_url('/admin/categorias/actualizar'); ?>" method="post">
        <input type="hidden" name="Id" value="<?php echo $categoria['catid']; ?>">

            <div class="form-group">
                <label for="Nombre">Nombre *</label>
                <input type="text" class="form-control form-control-sm" name="Nombre" value="<?php echo $categoria['catnombre']; ?>">
            </div>

            <input type="submit" class="btn btn-primary" value="Actualizar">
        </form>
    </div>
</div>