<?php
// path => action
return [
    // Authentication routes
    'login' => 'AuthController@showLoginForm',
    'register' => 'AuthController@showRegisterForm',
    'forgot-password' => 'AuthController@showForgotPasswordForm',
    'logout' => 'AuthController@logout',

    // Admin routes
    'admin/dashboard' => 'AdminController@dashboard',
    'admin/monitor' => 'AdminController@monitorTransfers',
    'admin/dashboard/create' => 'AdminController@createDashboard',

    // Teller routes
    'teller/dashboard' => 'TellerController@dashboard',
    'teller/crear-usuarios' => 'TellerController@dashboard',
    'teller/depositos' => 'TellerController@dashboard',
    'teller/retiros' => 'TellerController@dashboard',

    // User routes
    'user/transferencia-a-terceros' => 'UserController@dashboard',
    'user/dashboard' => 'UserController@dashboard',
    'user/agregar-cuentas-de-terceros' => 'UserController@dashboard',
    'user/estado-de-cuenta' => 'UserController@dashboard',
];
