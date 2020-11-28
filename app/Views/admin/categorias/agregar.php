<div class="container">
    <div class="row justify-content-md-center">
        <form action="<?= base_url('/admin/categorias/agregar'); ?>" method="post">
        <br>
            <div class="form-group">
                <label for="Nombre">Nombre *</label>
                <input type="text" class="form-control form-control-sm" name="Nombre" value="<?= old('Nombre'); ?>">
            </div>
            <input type="submit" class="btn btn-dark" value="Agregar">
        </form>
    </div>
</div>