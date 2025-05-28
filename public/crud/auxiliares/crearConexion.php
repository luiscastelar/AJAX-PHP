<?php
// Crea la conxión
try {
    $config = include "config.php";
    // Creación de la conexión
    $conexion = new PDO(
        "mysql:host=" .
            $config["db"]["host"] .
            ";dbname=" .
            $config["db"]["name"],
        $config["db"]["user"],
        $config["db"]["pass"],
        $config["db"]["options"]
    );

    return $conexion;
} catch (PDOException $error) {
    //echo $error->getMessage();
    return null;
}