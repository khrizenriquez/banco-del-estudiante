<?php
// path => action
return [
    // Authentication routes
    'login' => 'AuthController@showLoginForm',
    'register' => 'AuthController@showRegisterForm',
    'forgot-password' => 'AuthController@showForgotPasswordForm',
    'logout' => 'AuthController@logout',
    'server-info' => 'AuthController@showServerInfo',

    // Admin routes - Pages
    'admin/dashboard' => 'AdminController@dashboard',
    'admin/monitor' => 'AdminController@dashboard',
    'admin/usuarios' => 'AdminController@createUser',
    'admin/usuarios/{id}' => 'AdminController@editUser',

    // Admin routes - Services
    'admin/create-user' => 'AdminController@createTeller',
    'admin/update-user' => 'AdminController@updateUser',
    'admin/usuarios/{id}/toggle-status' => 'AdminController@toggleUserStatus',

    // Teller routes
    'teller/dashboard' => 'TellerController@dashboard',
    'teller/usuarios' => 'TellerController@createAccount',
    'teller/usuarios/{id}' => 'TellerController@editUser',
    'teller/depositos' => 'TellerController@deposit',
    'teller/retiros' => 'TellerController@withdraw',

    // User routes
    'user/transferencia-a-terceros' => 'UserController@viewTransfer',
    'user/dashboard' => 'UserController@dashboard',
    'user/agregar-cuentas-de-terceros' => 'UserController@addThirdPartyAccount',
    'user/estado-de-cuenta' => 'UserController@viewAccountStatement',
];
