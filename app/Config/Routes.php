<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Home::index');                                       //Puede que se tenga que comentar esta linea
$routes->get('/index', 'Home::index');  
$routes->add('/VerStaff', 'Home::VerStaff');
$routes->add('/IngresarStaff', 'FormaControlador::InPer');
$routes->add('/inStaff', 'FormaControlador::insertarPersonal');
$routes->get('/infoPer', 'FormaControlador::info');
$routes->get('/infoPer/QR/(:num)', 'FormaControlador::QRinfo/$1');
$routes->add('/VerPacientes', 'Home::VerPacientes');
$routes->add('/IngresarPaciente', 'FormaControlador::InPac');
$routes->add('/inPaciente', 'FormaControlador::insertarPaciente');
$routes->add('/imagen', 'public\images');
$routes->get('/contact-form', 'Forma::index');
$routes->match(['get', 'post'], 'FormaControlador/store', 'FormaControlador::store');
//$routes->get('/', 'SignupController::index');
$routes->get('/signup', 'SignupController::index');
$routes->match(['get', 'post'], 'SignupController/store', 'SignupController::store');
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'SigninController::loginAuth');
$routes->get('/signin', 'SigninController::index');
$routes->get('/profile', 'ProfileController::index',['filter' => 'authGuard']);
$routes->get('/unlogged', 'AccountData::unlogged');
$routes->get('/details', 'AccountData::index');
$routes->get('/firstlog', 'AccountData::pass_view');
$routes->get('/changepass', 'AccountData::pass_view');
$routes->get('VerPacientes/eliminar/(:num)','Home::pac_delete/$1');
$routes->get('VerPacientes/eliminar/question/(:num)','Home::PacDelQuestion/$1');
$routes->get('VerPacientes/editar/(:num)','Home::pac_mod/$1');
$routes->add('VerPacientes/editar/post','Home::pac_post');
$routes->get('VerPacientes/editar/question/(:num)','Home::PacModQuestion/$1');
$routes->get('VerPacientes/editar/proceso/(:num)','Home::pac_modify/$1');
$routes->get('VerStaff/eliminar/(:num)','Home::per_delete/$1');
$routes->get('VerStaff/eliminar/question/(:num)','Home::PerDelQuestion/$1');
$routes->get('VerStaff/editar/(:num)','Home::per_mod/$1');
$routes->get('VerStaff/editar/question/(:num)','Home::PerModQuestion/$1');
$routes->add('VerStaff/editar/post','Home::per_post');
$routes->get('VerStaff/editar/proceso/(:num)','Home::per_modify/$1');
$routes->setDefaultController('DiagramaGraph');
$routes->match(['get','post'],'/DiagramaGraph/initChart','DiagramaGraph::initChart');
$routes->get('/emailsend', 'SendMail::index');
$routes->match(['get', 'post'], 'SendMail/sendMail', 'SendMail::sendMail');
/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
