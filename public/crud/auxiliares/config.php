<?php
// Configuración de la base de datos
// Debe tener los mismos datos que el archivo .env
// Mejor usar el usuario sin privilegios habiendo creado la base de datos previamente con root o con el propio contenedor
// host: apunta al nombre del contenedor de la base de datos o una IP
return [
    "db" => [
        "host" => "db-skills",
        "user" => "root", // 'nombreDeUsuario',
        "pass" => "passDeRoot", //'contraseñaDeUsuario',
        "name" => "nombreDeLaBD",
        "options" => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
];

?>
