<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'IslanderController::index');

// Admin (requires 'admin' or suitable permission)
$routes->group('admin/users', ['filter' => 'permission:users.manage'], static function($routes) {
	$routes->get('/', 'Admin\UserController::index');
	$routes->get('create', 'Admin\UserController::create');
	$routes->post('store', 'Admin\UserController::store');
	$routes->get('edit/(:num)', 'Admin\UserController::edit/$1');
	$routes->post('update/(:num)', 'Admin\UserController::update/$1');
	$routes->post('delete/(:num)', 'Admin\UserController::delete/$1');
	$routes->post('regen-token/(:num)', 'Admin\UserController::regenerateToken/$1');
	$routes->post('upload/(:num)', 'Admin\UserController::upload/$1'); // avatar/logo
});

// Public card (no auth)
$routes->get('logout', '\Myth\Auth\Controllers\AuthController::logout');
$routes->get('card/(:segment)', 'CardController::show/$1');      // HTML landing
$routes->get('card/(:segment)/vcard.vcf', 'CardController::vcard/$1'); // download .vcf
$routes->get('card/(:segment)/qr.png', 'CardController::qr/$1'); // PNG QR image
$routes->get('card/(:segment)/json', 'CardController::json/$1'); // optional API

$routes->get('islanders', 'IslanderController::index');
$routes->get('islanders/create', 'IslanderController::create');
$routes->post('islanders/store', 'IslanderController::store');
$routes->get('islanders/edit/(:num)', 'IslanderController::edit/$1');
$routes->post('islanders/update/(:num)', 'IslanderController::update/$1');
$routes->get('islanders/delete/(:num)', 'IslanderController::delete/$1');
$routes->get('islanders/view/(:num)', 'IslanderController::view/$1');

$routes->get('islanders/columns', 'IslanderController::showTableColumns');