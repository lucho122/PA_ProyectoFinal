<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= base_url('/'); ?>">Prime Q&A</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPagina" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarPagina">
            <div class="navbar-nav">
                <a href="<?= base_url('/'); ?>" class="nav-item nav-link">Inicio</a>
                <?php if (isset($usuario) && $usuario['pts'] >= 20) { ?>
                  <a href="<?= base_url('pregunta/preguntar'); ?>" class="nav-item nav-link">Haz una Pregunta</a>
                <?php } ?>
            </div>
            <div class="navbar-nav ml-auto">
                <?php if(!isset($usuario) || $usuario['nick'] == 'invitado') { ?>
                  <a href="<?= base_url('register'); ?>" class="nav-item nav-link">Registro</a>
                  <a href="<?= base_url('login'); ?>" class="nav-item nav-link">Iniciar Sesión</a>
                <?php } else { ?>
                  <?php if($usuario['rol'] == 2) { ?> 
                  <span class="navbar-text"><i class="fas fa-medal"></i> <?= $usuario['pts']; ?> </span>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nbUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-user-cog"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="nbUsuario">
                    <a class="dropdown-item" href="<?= base_url('usuario/notificaciones') ?>">Notificaciones</a>
                      <a class="dropdown-item" href="<?= base_url('usuario/perfil') ?>">Editar Perfil</a>
                      <a class="dropdown-item" href="<?= base_url('usuario/preguntas') ?>">Mis preguntas</a>
                      <a class="dropdown-item" href="<?= base_url('usuario/respuestas') ?>">Mis respuestas</a>
                      <a class="dropdown-item" href="<?= base_url('usuario/preguntas/destacada') ?>">Elegir respuesta destacada</a>
                    </div>
                  </li>
                <?php } else { ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nbAdministrar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-tools"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="nbAdministrar">
                      <a class="dropdown-item" href="<?= base_url('admin/categorias') ?>">Categorias</a>
                      <a class="dropdown-item" href="<?= base_url('admin/preguntas') ?>">Preguntas</a>
                      <a class="dropdown-item" href="<?= base_url('admin/respuestas') ?>">Respuestas</a>
                      <a class="dropdown-item" href="<?= base_url('admin/usuarios') ?>">Usuarios</a>
                    </div>
                  </li>
                <?php } ?>  
                  <span class="navbar-text"><?= $usuario['nick']; ?>&nbsp;&nbsp;</span>
                 <a href="<?= base_url('logout'); ?>" class="nav-item nav-link">&nbsp;Salir <i class="fas fa-sign-out-alt"></i></a>
                <?php } ?>
            </div>
        </div>
  </div>
</nav>