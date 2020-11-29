 <form action="<?= base_url('pregunta/respuesta/edit') ?>" method="post" class="form-horizontal"> 
    <br>
    <input type="hidden" name="Pregunta" value="<?= $respuesta['preid']; ?>">
    <input type="hidden" name="Id" value="<?= $respuesta['resid']; ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">Tu respuesta</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="Respuesta" rows="4"><?= $respuesta['rescontenido']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 text-center">                    
            <button class="btn btn-dark  btn-circle" type="submit">Actualizar</button>
        </div>
    </div>       
</form>
<br>
<div class="col-md-12 text-center">
          <a href="http://localhost:8080/pregunta/<?= $respuesta['preid']; ?>"><button type="button" class="btn btn-dark">Regresar</button></a>
        </div>
<br>
