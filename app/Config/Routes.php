<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('login', 'AuthController::attemptToLogin');
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Home::index');
    $routes->get('employee', 'Employee::index');
    $routes->get('employee/create-employee', 'Employee::createEmployee');
    $routes->post('employee/save-employee-data', 'Employee::saveEmployeeData');
    $routes->get('employee/get-employee-list', 'Employee::getEmployeeListDt');
    $routes->post('employee/delete-employee/(:num)', 'Employee::deleteEmployee/$1');
    $routes->get('employee/edit-employee/(:num)', 'Employee::editEmployee/$1');
    $routes->post('employee/update-employee-data', 'Employee::updateEmployeeData');
    $routes->post('logout', 'AuthController::logout');
});
