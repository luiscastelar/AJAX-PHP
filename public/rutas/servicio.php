<?php
$request = $_SERVER['REQUEST_URI'];
$DIR_BASE = '/rutas/servicio.php';

switch ($request) {
    case (preg_match('/.*\/model\/getOne.*/', $request) ? true : false):
        require __DIR__ . '/model/getOne.php';
        echo "acertado";
        exit(1);
        break;

    case $DIR_BASE . '/model/getOne':
        require __DIR__ . '/model/getOne.php';
        break;

    case '/views/department':
        require $DIR_BASE . '/model/dep.php';
        break;

    default:
        echo "Valor por defecto<br />";
        echo __DIR__ . "<br />";
            var_dump($request);
        break;
}



echo "Pagina base";
