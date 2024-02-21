<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/google', 'Home::google');

$routes->get('/googlecallback', 'Home::googlecallback');
$routes->get('/msg', 'Home::msg');
