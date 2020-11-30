<div class="container">
<br>
<?php if($respuestas): ?>
    <?= $pager->links() ?>
    <?php foreach($respuestas as $respuesta): ?>
    <div class="jumbotron text-center hoverable p-4">
        <div class="row">
            <div class="col-md-7 text-md-left ml-3 mt-3">
                 <h6 class="h6 pb-1 text-info"><i class="fas fa-question-circle"></i> <?= $respuesta->catnombre; ?></h6>

                <p class="font-weight-normal"><a><strong><?= $respuesta->usunick; ?></strong></a>, <?= $respuesta->resfecha; ?></p>
                <h4 class="h4 mb-4"><?= $respuesta->pretitulo; ?></h4>

                <p class="font-weight-normal">Tu respuesta: <?= $respuesta->rescontenido; ?></p>

                <a class="btn btn-dark" href="<?= base_url('pregunta').'/'.$respuesta->preid; ?>"><i class="far fa-eye"></i> Ver pregunta</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
<div class="text-center">No tiene respuestas actualmente</div>
<?php endif; ?>
<br>
<div class="col-md-12 text-center">
          <a href="http://localhost:8080/index.php"><button type="button" class="btn btn-dark">Regresar</button></a>
        </div>