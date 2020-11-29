<div class="container">
    <div class="justify-content-md-center">
        <div class="card text-center">
            <div class="card-header text-left">
                <img class="img-thumbnail rounded-circle float-left mr-3" width="65" src="<?= base_url('usuarios/'.$pregunta->usufoto); ?>" alt="preguntador"> 
                <div class="align-middle"><h3><?php echo $pregunta->usunick; ?></h3></div>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $pregunta->pretitulo; ?></h5>
                <p class="card-text"><?php echo $pregunta->predescripcion; ?></p>
            </div>
            <div class="card-footer text-muted">
             Preguntado el: <?php echo $pregunta->prefechainicio; ?>
            </div>
        </div>
    </div>
    <br>
    <?php if($respuestas): ?>
        <ul class="media-list">
            <?php foreach($respuestas as $respuesta): ?>
             <li class="media">
                  <img class="img-thumbnail rounded-circle" width="50" src="<?= base_url('usuarios/'.$respuesta->usufoto); ?>" alt="profile">  
                <div class="media-body">
                   <div class="well well-lg">
                        <h4 class="media-heading reviews"><?= $respuesta->usunick; ?> </h4>
                        <?php if($elegirDestacada): ?>
                            <form action="#" method="post">
                                <input type="hidden" name="Id" value="<?= $respuesta->usuid; ?>">
                                <input type="submit" value="Elegir destacada">
                            </form>
                        <?php endif; ?>
                         <?php if($puedeEditarRespuesta && $respuesta->usunick == $usuario['nick']): ?>
                            <a href="<?= base_url('pregunta/respuesta/edit'.'/'.$respuesta->resid) ?>">Editar respuesta</a>
                        <?php endif; ?>
                        <h6><?= $respuesta->resfecha ?></h6>
                        <h6><?php if($respuesta->resdestacada == 't')  { ?> <h5><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h5> <?php } ?></h6>
                        <p class="media-comment">
                            <?= $respuesta->rescontenido ?>
                        </p>
                    </div>
                </li>
           <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if($puedeResponder) { ?>
        <form action="<?= base_url('pregunta/responder') ?>" method="post" class="form-horizontal"> 
        <input type="hidden" name="Pregunta" value="<?= $pregunta->preid; ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Responde a esta pregunta</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="Respuesta" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">                    
                    <button class="btn btn-dark  btn-circle" type="submit">Responder</button>
                </div>
            </div>         
        </form>
    <?php } ?>
</div>
<br>
<div class="col-md-12 text-center">
          <a href="http://localhost:8080/index.php"><button type="button" class="btn btn-dark">Regresar</button></a>
        </div> 