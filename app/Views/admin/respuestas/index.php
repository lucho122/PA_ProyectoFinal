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
               <th><h6>Respuesta</h6></th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php if($respuestas): ?>
            <?php foreach($respuestas as $respuesta): ?>
            <tr>
               <td class="align-middle"><?= $respuesta->autor; ?></td>
               <td class="align-middle"><?= $respuesta->respuesta; ?></td> 
               <td align="center">
                    <a class="btn-sm btn-info btn-group" href="<?= base_url('pregunta').'/'.$respuesta->preid; ?>"><i class="far fa-eye"></i></a>
                    <a class="btn-sm btn-primary btn-group" href="<?= base_url('admin/respuestas/editar/').'/'.$respuesta->resid; ?>"><i class="fas fa-edit"></i></a>
                    <a class="btn-sm btn-danger btn-group" href="<?= base_url('admin/confirmacion/respuesta/').'/'.$respuesta->resid; ?>"><i class="fas fa-trash-alt"></i></a>
               </td>
            </tr>
           <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>
</div>