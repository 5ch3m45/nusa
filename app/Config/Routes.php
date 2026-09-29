<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/missions', 'MissionController::index');
$routes->get('/achievements', 'AchievementController::index');
$routes->get('/profile', 'ProfileController::index');

$routes->group('htmx', function ($routes) {
    $routes->get('home', 'Htmx\HomeController::index');
    $routes->get('missions', 'Htmx\MissionController::index');
    $routes->get('missions/semester/(:num)', 'Htmx\MissionController::semester/$1');
    $routes->get('achievements', 'Htmx\AchievementController::index');
    $routes->get('profile', 'Htmx\ProfileController::index');
});