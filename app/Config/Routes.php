<?php

use App\Controllers\Api\V1\CompaniesController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api/v1', ['namespace' => ''], static function($routes){

    $routes->resource('companies', ['controller' => CompaniesController::class, 'except' => 'new,edit' ]);

});

