<div class="container">
    <div class="row d-flex justify-content-lg-center">
    <form action="<?= base_url('pregunta/preguntar'); ?>" method="post">
        <br>
        <div class="form-group row">
            <label for="Categoria">Seleccione la Categoria *</label>
            <select class="form-control form-control-sm" name="Categoria" required>
            <?php foreach($categorias as $categoria): ?>
                <option value="<?php echo $categoria['catid'] ?>"><?php echo $categoria['catnombre'] ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group row">
            <label for="Titulo">Título *</label>
            <input type="text" class="form-control form-control-sm" name="Titulo" required>
        </div>
        <div class="form-group row">
            <label for="Descripcion">Descripción</label>
            <textarea class="form-control" name="Descripcion" rows="4"></textarea>
        </div>
        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-dark justify-content-md-center" value="Preguntar">
        </div>
    </form>

    </div>
</div>
<br>
        <div class="col-md-12 text-center">
          <a href="http://localhost:8080/index.php"><button type="button" class="btn btn-dark">Regresar</button></a>
        </div>