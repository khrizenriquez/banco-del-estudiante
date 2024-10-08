<?php
// path => action
return [
    // Authentication routes
    'login' => 'AuthController@showLoginForm',
    'register' => 'AuthController@showRegisterForm',
    'forgot-password' => 'AuthController@showForgotPasswordForm',
    'logout' => 'AuthController@logout',
    'server-info' => 'AuthController@showServerInfo',
    'register-customer' => 'AuthController@register',
    //'login-user' => 'AuthController@login',

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
    'teller/deposito' => 'TellerController@handleDeposit',
    'teller/retiro' => 'TellerController@handleWithdraw',

    // Customer routes - Pages
    'user/transferencia-a-terceros' => 'CustomerController@viewTransfer',
    'user/dashboard' => 'CustomerController@showManageAccounts',
    'user/agregar-cuentas-de-terceros' => 'CustomerController@showAddThirdPartyForm',
    'user/estado-de-cuenta' => 'CustomerController@viewAccountStatement',

    // User routes - Services
    'user/agregar-terceros' => 'CustomerController@addThirdPartyAccount',
    'user/transferir-terceros' => 'CustomerController@handleTransfer',
];
