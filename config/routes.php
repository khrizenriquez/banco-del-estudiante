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
    'admin/dashboard' => 'AdminController@showDashboard',
    'admin/monitor' => 'AdminController@showMonitor',
    'admin/usuarios' => 'AdminController@showCreateUser',
    'admin/usuarios/{id}' => 'AdminController@showEditUser',

    // Admin routes - Services
    'admin/create-user' => 'AdminController@createTeller',
    'admin/update-user' => 'AdminController@updateUser',
    'admin/usuarios/{id}/toggle-status' => 'AdminController@toggleUserStatus',

    // Teller routes - Pages
    'teller/dashboard' => 'TellerController@showDashboard',
    'teller/usuarios' => 'TellerController@showCreateAccount',
    'teller/usuarios/{id}' => 'TellerController@showEditUser',
    'teller/depositos' => 'TellerController@showDeposit',
    'teller/retiros' => 'TellerController@showWithdraw',

    // Teller routes - Services
    'teller/create-user' => 'TellerController@storeAccount',
    'teller/update-user' => 'TellerController@updateUser',

    // User routes
    'user/transferencia-a-terceros' => 'UserController@viewTransfer',
    'user/dashboard' => 'UserController@dashboard',
    'user/agregar-cuentas-de-terceros' => 'UserController@addThirdPartyAccount',
    'user/estado-de-cuenta' => 'UserController@viewAccountStatement',
];
