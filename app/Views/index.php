<?php if($categorias): ?>
<ul class="list-group">
    <?php foreach($categorias as $categoria): ?>
        <a href="#" class="list-group-item justify-content-between align-items-center list-group-item-action">
            <?= $categoria->catnombre; ?>
            <span class="badge badge-dark badge-pill"><?= $categoria->preguntas; ?></span>
        </a>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<br>
<div class="container">
<?php if($preguntas): ?>
    <?php foreach($preguntas as $pregunta): ?>
    <div class="jumbotron text-center hoverable p-4">
        <div class="row">
            <div class="col-md-7 text-md-left ml-3 mt-3">
                 <h6 class="h6 pb-1 text-info"><i class="fas fa-question-circle"></i> <?= $pregunta->catnombre; ?></h6>

                <p class="font-weight-normal"><a><strong><?= $pregunta->usunick; ?></strong></a>, <?= $pregunta->prefechainicio; ?></p>
                <h4 class="h4 mb-4"><?= $pregunta->pretitulo; ?></h4>

                <p class="font-weight-normal"><?= $pregunta->predescripcion; ?></p>

                <a class="btn btn-dark" href="<?= base_url('pregunta').'/'.$pregunta->preid; ?>"><i class="far fa-eye"></i> Ver pregunta</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>