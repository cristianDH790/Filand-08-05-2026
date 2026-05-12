<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Front::inicio');
$routes->get('inicio', 'Front::inicio');
$routes->get('nosotros', 'Front::nosotros');
$routes->get('curso-online/matriculate', 'Front::matricula');
$routes->get('curso-online/(:any)', 'Front::curso/$1');


// $routes->get('curso-de-sueco-online', 'Front::cursoSueco');
// $routes->get('curso-de-noruego-online', 'Front::cursoNoruego');
// $routes->get('curso-de-fines-online', 'Front::cursoFines');
// $routes->get('curso-de-danes-online', 'Front::cursoDanes');



$routes->get('paises-nordicos/finlandia/', 'Front::paisesNordicosFinlandia');
$routes->get('paises-nordicos/suecia/', 'Front::paisesNordicosSuecia');
$routes->get('paises-nordicos/noruega/', 'Front::paisesNordicosNoruega');
$routes->get('paises-nordicos/dinamarca/', 'Front::paisesNordicosDinamarca');
$routes->get('paises-nordicos/islandia/', 'Front::paisesNordicosIslandia');

$routes->get('galeria', 'Front::galeria');
$routes->get('contacto', 'Front::contacto');
$routes->get('captcha', 'Front::creaCaptcha');
// $routes->get('email', 'Front::email');

$routes->group('', ['filter' => 'cors'], static function (RouteCollection $routes): void {
    $routes->group('api', function ($routes) {

        //rutas publicas

        $routes->post('FormularioController/mailContacto', 'FormularioController::mailContacto');
        $routes->post('FormularioController/mailMatricula', 'FormularioController::mailMatricula');
        /** RUTAS PARA EL USO DE LOS CONTROLADORES DE FRONT **/

        // $routes->post('NoticiaController/noticias', 'Api\Publico\NoticiaPublicoController::listar');

        //ruta de logueo administrador
        $routes->post('login', 'Api\\Auth\\AuthController::login');
        $routes->get('pass', 'Api\\Auth\\AuthController::pass');
        $routes->post('usuario/recuperarclave', 'Api\\Auth\\AuthController::recuperarClave');



        //sliders 
        $routes->post('sliders/listar', 'Api\\SliderController::listar', ['filter' => 'jwtfilter']);
        $routes->get('sliders/obtenerPorId/(:num)', 'Api\\SliderController::obtenerPorId/$1', ['filter' => 'jwtfilter']);
        $routes->post('sliders/guardar', 'Api\SliderController::guardar', ['filter' => 'jwtfilter']);
        $routes->put('sliders/actualizar/(:num)', 'Api\\SliderController::actualizar/$1', ['filter' => 'jwtfilter']);
        $routes->delete('sliders/eliminar/(:num)', 'Api\\SliderController::eliminar/$1', ['filter' => 'jwtfilter']);
        $routes->post('sliders/reporte', 'Api\\SliderController::reporte', ['filter' => 'jwtfilter']);
        $routes->post('sliders/upload', 'Api\\SliderController::uploadImagen1', ['filter' => 'jwtfilter']);
        $routes->post('sliders/upload2', 'Api\\SliderController::uploadImagen2', ['filter' => 'jwtfilter']);
        $routes->post('sliders/eliminar-imagen', 'Api\\SliderController::eliminarImagen', ['filter' => 'jwtfilter']);
        $routes->get('sliders/max-orden', 'Api\SliderController::obtenerMaxOrden', ['filter' => 'jwtfilter']);
        $routes->put('sliders/orden', 'Api\\SliderController::actualizarOrden', ['filter' => 'jwtfilter']);

        //cursos
        $routes->post('cursos/listar', 'Api\\CursoController::listar', ['filter' => 'jwtfilter']);
        $routes->get('cursos/obtenerPorId/(:num)', 'Api\\CursoController::obtenerPorId/$1', ['filter' => 'jwtfilter']);
        $routes->post('cursos/guardar', 'Api\CursoController::guardar', ['filter' => 'jwtfilter']);
        $routes->put('cursos/actualizar/(:num)', 'Api\\CursoController::actualizar/$1', ['filter' => 'jwtfilter']);
        $routes->delete('cursos/eliminar/(:num)', 'Api\\CursoController::eliminar/$1', ['filter' => 'jwtfilter']);
        $routes->post('cursos/upload', 'Api\\CursoController::uploadImagen', ['filter' => 'jwtfilter']);
        $routes->post('cursos/upload2', 'Api\\CursoController::uploadBanner', ['filter' => 'jwtfilter']);
        $routes->post('cursos/upload3', 'Api\\CursoController::uploadBanner2', ['filter' => 'jwtfilter']);
        $routes->post('cursos/eliminar-imagen', 'Api\\CursoController::eliminarImagen', ['filter' => 'jwtfilter']);

        // /// DASHBOARD
        $routes->post('dashboard', 'Api\Base\DashboardController::dashboardStats', ['filter' => 'jwtfilter']);

        //usuarios
        $routes->post('usuarios/listar', 'Api\\UsuarioController::listar', ['filter' => 'jwtfilter']);
        $routes->get('usuarios/obtenerPorId/(:num)', 'Api\\UsuarioController::obtenerPorId/$1', ['filter' => 'jwtfilter']);
        $routes->post('usuarios/guardar', 'Api\UsuarioController::guardar', ['filter' => 'jwtfilter']);
        $routes->put('usuarios/actualizar/(:num)', 'Api\\UsuarioController::actualizar/$1', ['filter' => 'jwtfilter']);
        $routes->delete('usuarios/eliminar/(:num)', 'Api\\UsuarioController::eliminar/$1', ['filter' => 'jwtfilter']);



        //parametro
        $routes->post('parametros/listar', 'Api\\Base\\ParametroController::listar', ['filter' => 'jwtfilter']);


        //estado
        $routes->post('estados/listar', 'Api\\Base\\EstadoController::listar', ['filter' => 'jwtfilter']);

        //tipo
        $routes->post('tipos/listar', 'Api\\Base\\TipoController::listar', ['filter' => 'jwtfilter']);


        //clase
        $routes->post('clases/listar', 'Api\\Base\\ClaseController::listar', ['filter' => 'jwtfilter']);


        //filemanager
        $routes->get('carpetas', 'Api\Base\FileManagerController::getCarpetasTodas', ['filter' => 'jwtfilter']);
        $routes->post('archivos', 'Api\Base\FileManagerController::getArchivos', ['filter' => 'jwtfilter']);


        $routes->post('nuevo-directorio', 'Api\Base\FileManagerController::nuevoDirectorio', ['filter' => 'jwtfilter']);
        $routes->post('archivoUpload', 'Api\Base\FileManagerController::archivoSubirImagen', ['filter' => 'jwtfilter']);
        $routes->post('eliminarArchivoCarpeta', 'Api\Base\FileManagerController::eliminarArchivoCarpeta', ['filter' => 'jwtfilter']);
        $routes->post('descargarArchivo', 'Api\Base\FileManagerController::descargarArchivo', ['filter' => 'jwtfilter']);
        $routes->post('renombrar-archivo', 'Api\Base\FileManagerController::renombrarArchivo', ['filter' => 'jwtfilter']);
        $routes->post('copiar-archivo', 'Api\Base\FileManagerController::copiarArchivo', ['filter' => 'jwtfilter']);
    });
    $routes->options('api/(:any)', function () {
        return service('response')
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization,X-Authorization')
            ->setStatusCode(200);
    });
});
