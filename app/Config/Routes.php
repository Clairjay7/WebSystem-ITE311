<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->get('/home', 'Home::index');
// Auth routes
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');

$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/seed-defaults', 'Auth::seedDefaults');

// Instructor routes
$routes->get('/instructor/my-classes', 'Instructor::myClasses');
$routes->get('/instructor/submissions', 'Instructor::submissions');
$routes->get('/instructor/attendance', 'Instructor::attendance');

// Admin routes
$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/reports', 'Admin::reports');
$routes->get('/admin/settings', 'Admin::settings');
