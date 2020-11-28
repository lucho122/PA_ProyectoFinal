<div class="container">
<?php
if (isset($_SESSION['notificacion'])) { ?>
    <div class="alert <?php echo $_SESSION['notificacion']['label']; ?> alert-dismissible fade show " role="alert"><?php echo $_SESSION['notificacion']['mensaje']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<br>
<div class="row">
       <table class="table table-striped table-sm" id='contenido'>
         <thead class="thead-dark">
            <tr>
               <th><h6>Autor</h6></th>
               <th><h6>Categoria</h6></th>
               <th><h6>Pregunta</h6></th>
               <th><h6>Descripcion</h6></th>
               <th><h6>Creada el</h6></th>
               <th><h6>Cierra el</h6></th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php if($preguntas): ?>
            <?php foreach($preguntas as $pregunta): ?>
            <tr>
               <td class="align-middle"><?= $pregunta->autor; ?></td>
               <td class="align-middle"><?= $pregunta->categoria; ?></td>
               <td class="align-middle"><?= $pregunta->pretitulo; ?></td>
               <td class="align-middle"><?= $pregunta->predescripcion; ?></td>
               <td class="align-middle"><?= $pregunta->fcreacion; ?></td>    
               <td><?= $pregunta->fcierre; ?></td>
               <td align="center">
                    <a class="btn-sm btn-info btn-group" href="<?= base_url('pregunta').'/'.$pregunta->preid; ?>"><i class="far fa-eye"></i></a>
                    <a class="btn-sm btn-primary btn-group" href="<?= base_url('admin/preguntas/editar/').'/'.$pregunta->preid; ?>"><i class="fas fa-edit"></i></a>
                    <a class="btn-sm btn-danger btn-group" href="<?= base_url('admin/confirmacion/pregunta/').'/'.$pregunta->preid; ?>"><i class="fas fa-trash-alt"></i></a>
               </td>
            </tr>
           <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>
</div>