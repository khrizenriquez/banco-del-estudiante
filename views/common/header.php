<?php
$local_base_path = '/desarrolloweb/banco-del-estudiante';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($page_title) ? $page_title : 'Banco del estudiante'; ?></title>

    <link rel="icon" type="image/x-icon" href="<?= $local_base_path; ?>/assets/images/favicon.ico">

    <link rel="stylesheet" href="<?= $local_base_path; ?>/assets/css/vendor/bulma.min.css">
    <link rel="stylesheet" href="<?= $local_base_path; ?>/assets/css/styles.css">
    <link rel="stylesheet" href="<?= $local_base_path; ?>/assets/css/auth.css">
</head>
