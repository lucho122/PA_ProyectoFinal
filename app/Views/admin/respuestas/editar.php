<form action="<?= base_url('admin/respuestas/actualizar') ?>" method="post" class="form-horizontal"> 
<br>
        <input type="hidden" name="Id" value="<?= $respuesta['resid']; ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Respuesta</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="Respuesta" rows="4"><?= $respuesta['rescontenido']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">                    
                    <button class="btn btn-dark  btn-circle" type="submit">Actualizar</button>
                </div>
            </div>         
</form>