<?php

use App\Controllers\Api\V1\CompaniesController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes teste
 */
$routes->get('/', 'Home::index');

$routes->group('', ['namespace' => ''], static function($routes){

    
    $routes->resource('companies', ['controller' => CompaniesController::class, 'except' => 'new,edit' ]);


    /**
     * @var RouteCollection $routes
     */
    $routes->options('companies', static function(){ });

    
    $routes->options('companies/(:any)', static function(){ });


});

