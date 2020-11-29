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
       <table class="table table-striped" id='contenido'>
         <thead class="thead-dark">
            <tr>
               <th></th>
               <th><h6>Nick</h6></th>
               <th><h6>Rol</h6></th>
               <th><h6>Nombres</h6></th>
               <th><h6>Apellidos</h6></th>
               <th><h6>Sexo</h6></th>
               <th><h6>Fecha de Nacimiento</h6></th>
               <th><h6>Email</h6></th>
               <th><h6>Pts</h6></th>
               <th></th>
            </tr>
         </thead>
         <tbody>
            <?php if($usuarios): ?>
            <?php foreach($usuarios as $usuario): ?>
            <tr>
               <td><img src="<?= base_url('usuarios/'.$usuario->usufoto); ?>" alt="<?= $usuario->usunick; ?>" class="img-thumbnail rounded-circle" width="100"></td>
               <td class="align-middle"><?= $usuario->usunick; ?></td>
               <td class="align-middle"><?= $usuario->rol; ?></td>
               <td class="align-middle"><?= trim($usuario->nombres); ?></td>
               <td class="align-middle"><?= trim($usuario->apellidos); ?></td>
               <td class="align-middle" align="center"><?php echo $usuario->ususexo == 't' ? 'M' : 'F'; ?></td>
               <td class="align-middle"><?=  $usuario->usufechanacimiento; ?></td>
               <td class="align-middle"><?= $usuario->usuemail; ?></td>
               <td class="align-middle"><?= $usuario->usupuntos; ?></td>
               <td class="align-middle" align="center">
                  <a class="btn-sm btn-warning btn-group" href="<?= base_url('admin/usuarios/encerarPuntos/').'/'.$usuario->usuid; ?>"><i class="fas fa-medal"></i></a>
                  <a class="btn-sm btn-primary btn-group" href="<?= base_url('admin/usuarios/editar/').'/'.$usuario->usuid; ?>"><i class="fas fa-edit"></i></a>
                  <a class="btn-sm btn-danger btn-group" href="<?= base_url('admin/confirmacion/usuario/').'/'.$usuario->usuid; ?>"><i class="fas fa-trash-alt"></i></a>
               </td>
            </tr>
           <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>
</div>