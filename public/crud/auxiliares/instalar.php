<?php
// Instalación de la base de datos
//------------------------------------------------------------------------------
// Uso: en bash -> curl http://localhost:8000/instalar.php
//------------------------------------------------------------------------------
$conexion = include "crearConexion.php";
if ($conexion == null) {
    echo "Error al conectar a la base de datos.";
    exit();
} else {
    echo "Conexión a la base de datos establecida.";
    try {
        // Cargamos los datos de la migración
        $sql = file_get_contents("migracion.sql");
        $conexion->exec($sql);
        echo "Las tablas y datos se han creado con éxito.";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}
