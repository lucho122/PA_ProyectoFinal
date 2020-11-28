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
<a class="btn btn-dark" href="<?= base_url('admin/categorias/agregar'); ?>">Agregar Categoría</a>
<div class="row mt-5">
       <table class="table table table-striped table-sm" id='contenido'>
         <thead class="thead-dark">
            <tr>
               <th>Nombre</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php if($categorias): ?>
            <?php foreach($categorias as $categoria): ?>
            <tr>
               <td><?php echo $categoria['catnombre'] ?></td>
               <td align="center">
                    <a class="btn-sm btn btn-primary btn-group" href="<?= base_url('admin/categorias/editar/').'/'.$categoria['catid']; ?>"><i class="fas fa-edit"></i></a>
                    <a class="btn-sm btn btn-danger btn-group" href="<?= base_url('admin/confirmacion/categoria/').'/'.$categoria['catid']; ?>"><i class="fas fa-trash-alt"></i></a>
               </td>
            </tr>
           <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>
</div>