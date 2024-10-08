<?php
require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($page_title) ? $page_title : 'Banco del estudiante'; ?></title>

    <link rel="icon" type="image/x-icon" href="<?= BASE_PATH; ?>/assets/images/favicon.ico">

    <link rel="stylesheet" href="<?= BASE_PATH; ?>/assets/css/vendor/bulma/bulma.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH; ?>/assets/css/general.css">
    <link rel="stylesheet" href="<?= BASE_PATH; ?>/assets/css/auth.css">
</head>
