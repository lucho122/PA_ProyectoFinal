<div class="container">
<?php
if (isset($_SESSION['notificacion'])) { ?>
    <div class="alert <?php echo $_SESSION['notificacion']['label']; ?> alert-dismissible fade show " role="alert"><?php echo $_SESSION['notificacion']['mensaje']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<a href="<?= base_url('admin/categorias/agregar'); ?>">Agregar Categoría</a>
<div class="row mt-5">
       <table class="table table-bordered" id='contenido'>
         <thead>
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
                   <a href="<?= base_url('admin/categorias/editar/').'/'.$categoria['catid']; ?>"><i class="fas fa-edit"></i></a>
                   <a href=""><i class="fas fa-trash-alt"></i></a>
               </td>
            </tr>
           <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>
</div>