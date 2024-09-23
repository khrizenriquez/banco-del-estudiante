<?php
$environment = getenv('APP_ENV') ?: 'production';
$route_prefix = '/desarrolloweb/banco-del-estudiante';

if ($environment === 'production') {
    $route_prefix = '';
}
