<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

# Rutas Login / Registro (Todos los Usuarios)
$routes->get('login', 'AuthController'); # Invitados, Usuarios, Admins
$routes->post('login', 'AuthController::login'); # Invitados, Usuarios, Admins
$routes->get('logout', 'AuthController::logout'); # Usuarios, Admins
$routes->get('register', 'AuthController::register'); # Invitados, Usuarios, Admins
$routes->post('register', 'AuthController::registrar'); # Invitados, Usuarios, Admins
# Fin Login/Registro

# Rutas Administrador
## Categorias
$routes->get('admin/categorias', 'CategoriaController::index');
$routes->get('admin/categorias/agregar', 'CategoriaController::agregar');
$routes->get('admin/categorias/editar/(:num)', 'CategoriaController::editar/$1');
$routes->post('admin/categorias/agregar', 'CategoriaController::guardar');
$routes->post('admin/categorias/actualizar', 'CategoriaController::actualizar');
$routes->post('admin/categorias/eliminar', 'CategoriaController::eliminar');
## FinCategorias
## Usuarios
$routes->get('admin/usuarios', 'UsuarioController::index');
$routes->get('admin/usuarios/editar/(:num)', 'UsuarioController::editar/$1');
$routes->post('admin/usuarios/actualizar', 'UsuarioController::actualizar');
$routes->post('admin/usuarios/eliminar', 'UsuarioController::eliminar');
## Fin Usuarios
## Preguntas
$routes->get('admin/preguntas', 'PreguntaController::adminIndex');
$routes->get('admin/preguntas/editar/(:num)', 'PreguntaController::editar/$1');
$routes->post('admin/preguntas/actualizar', 'PreguntaController::actualizar');
$routes->post('admin/preguntas/eliminar', 'PreguntaController::eliminar');
## Fin Preguntas

## Ruta confirmación eliminiaciones
$routes->get('admin/confirmacion/(:alpha)/(:num)', 'EliminacionController::index/$1/$2');
## FinConfirmacionEliminaciones
# Fin Administrador

# Rutas Preguntas/Respuestas
$routes->get('pregunta/preguntar', 'PreguntaController::preguntar');
$routes->post('pregunta/preguntar', 'PreguntaController::crear');
$routes->get('pregunta/(:num)', 'PreguntaController::index/$1');
$routes->post('pregunta/responder', 'RespuestaController::responder');
# Fin Rutas Preguntas/Respuestas

# Rutas Preguntas por categoria
$routes->get('categoria/(:num)', 'CategoriaController::listarPreguntas/$1');
# Fin Preguntas por categoria

# Rutas Administrar Usuario
$routes->get('usuario/perfil', 'UsuarioController::editarPerfil');
$routes->post('usuario/actualizarPerfil', 'UsuarioController::actualizarPerfil');
$routes->get('usuario/cambiarclave', 'UsuarioController::cambiarClave');
$routes->post('usuario/cambiarclave', 'UsuarioController::actualizarClave');
$routes->get('usuario/preguntas', 'UsuarioController::listarPreguntas');
$routes->get('usuario/respuestas', 'UsuarioController::listarRespuestas');
$routes->get('usuario/preguntas/destacada', 'UsuarioController::elegirDestacadas');
# Fin Administrar Usuario
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
