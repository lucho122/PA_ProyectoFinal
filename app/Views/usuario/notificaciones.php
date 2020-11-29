<div class="container">
<br>
<?php if($mensajes): ?>
    <?php foreach($mensajes as $mensaje): ?>
    <div class="jumbotron text-center hoverable p-4">
        <div class="row">
            <div class="col-md-7 text-md-left ml-3 mt-3">
                 <h6 class="h6 pb-1 text-danger"><i class="fas fa-exclamation-triangle"></i> <?= $mensaje->maemision; ?></h6>
                    <h4 class="h4 mb-4"><?= $mensaje->macontenido; ?></h4>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
<div class="text-center">No tiene notificaciones actualmente</div>
<?php endif; ?>