<div class="container">
    <div class="row justify-content-md-center">
        <form action="<?= base_url('/admin/preguntas/actualizar'); ?>" method="post">
        <input type="hidden" name="Id" value="<?php echo $pregunta['preid']; ?>">
        <br>
            <div class="form-group row">
                <label for="Categoria">Seleccione la Categoria *</label>
                <select class="form-control form-control-sm" name="Categoria" required>
                <?php foreach($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['catid'] ?>" <?= $categoria['catid'] == $pregunta['catid'] ? 'selected' : '' ?> ><?php echo $categoria['catnombre'] ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="Titulo">Titulo *</label>
                <input type="text" class="form-control form-control-sm" name="Titulo" value="<?php echo $pregunta['pretitulo']; ?>">
            </div>

            <div class="form-group row">
                <label for="Descripcion">Descripción</label>
                <textarea class="form-control" name="Descripcion" rows="4"><?php echo $pregunta['predescripcion']; ?></textarea>
            </div>

            <div class="form-group row">
                <label for="Creacion">Fecha de creación</label>
                <input type="text" readonly class="form-control-plaintext" name="Creacion" value="<?= $pregunta['prefechainicio']; ?>">
            </div>

            <div class="form-group row">
             <label for="Cierre">Fecha de cierre</label>
             <input type="date" class="form-control form-control-sm" name="Cierre" value="<?= $pregunta['prefechacierre']; ?>">
            </div>

            <input type="submit" class="btn btn-dark" value="Actualizar">
        </form>
    </div>
</div>