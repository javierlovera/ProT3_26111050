<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// =======================================================
// Rutas para USUARIOS
// =======================================================

// Ruta para acceder al método index de Usuario_controller
// Por ejemplo: http://localhost/ProT3_26111050/public/usuarios
$routes->get('usuarios', 'Usuario_controller::index');

// Si tu formulario de usuario envía datos a un método 'guardarUsuario' en Usuario_controller
// Y el formulario usa method="post"
$routes->post('usuarios/guardar', 'Usuario_controller::guardarUsuario');

// Si tuvieras un formulario para crear un usuario, y quisieras una ruta para mostrarlo
$routes->get('usuarios/crear', 'Usuario_controller::create'); // Asumiendo un método 'create' en tu controller

// Si tienes un método para editar un usuario por ID
$routes->get('usuarios/editar/(:num)', 'Usuario_controller::edit/$1');
$routes->post('usuarios/actualizar/(:num)', 'Usuario_controller::update/$1');

// Si tienes un método para eliminar un usuario por ID (es mejor POST para eliminaciones)
$routes->get('usuarios/eliminar/(:num)', 'Usuario_controller::delete/$1');


// =======================================================
// Rutas para PERFILES (Si creas el PerfilController)
// =======================================================

// Ruta para acceder al método index de PerfilController
// Por ejemplo: http://localhost/ProT3_26111050/public/perfiles
$routes->get('perfiles', 'PerfilController::index');

// Ruta para mostrar el formulario de creación de perfil
$routes->get('perfiles/crear', 'PerfilController::create');

// Ruta para guardar un nuevo perfil
$routes->post('perfiles/guardar', 'PerfilController::store');

// Rutas para editar y eliminar perfiles (si los implementas)
$routes->get('perfiles/editar/(:num)', 'PerfilController::edit/$1');
$routes->post('perfiles/actualizar/(:num)', 'PerfilController::update/$1');
$routes->get('perfiles/eliminar/(:num)', 'PerfilController::delete/$1'); // Consi
// Rutas para el Registro de Usuarios
$routes->get('registro', 'Usuario_controller::create');      // Muestra el formulario de registro
$routes->post('usuarios/guardar', 'Usuario_controller::store'); // Procesa el formulario de registro

// Rutas para el Login
$routes->get('login', 'Login_controller::index');         // Muestra el formulario de login
$routes->post('login/authenticate', 'Login_controller::authenticate'); // Procesa las credenciales de login
$routes->get('logout', 'Login_controller::logout');       // Cierra la sesión

// Ruta de ejemplo para el dashboard (página a la que se redirige después de un login exitoso)
$routes->get('dashboard', function() {
    // Aquí puedes comprobar si el usuario está logueado y mostrar contenido diferente
    $session = \Config\Services::session();
    if ($session->get('isLoggedIn')) {
        return "<h1>Bienvenido al Dashboard, " . esc($session->get('nombre')) . "!</h1><p><a href='" . base_url('logout') . "'>Cerrar Sesión</a></p>";
    } else {
        return redirect()->to(base_url('login'));
    }
});
