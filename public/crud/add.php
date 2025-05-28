<?php
require_once "funciones.php";
// CRUD: Insertar coche
//------------------------------------------------------------------------------
// Obtenemos los datos como JSON (enviados con application/json)
$entityBody = file_get_contents("php://input");
$json = json_decode($entityBody);

header("Content-Type: application/json; charset=utf-8");
try {
    // Creamos un coche
    $cocheNuevo = new stdClass();
    $cocheNuevo->matricula = $json->matricula ?? null;
    $cocheNuevo->revisado = $json->revisado ?? null;
    $cocheNuevo->kilometros = $json->kilometros ?? null;
    $cocheNuevo->precio = $json->precio ?? null;

    // Conectamos con la bbdd
    $conexion = include "crearConexion.php";

    // Insertamos el coche
    $filasAfectadas = $conexion->exec(
        "INSERT INTO coches (matricula, revisado, kilometros, precio) VALUES ('$cocheNuevo->matricula', '$cocheNuevo->revisado', '$cocheNuevo->kilometros', '$cocheNuevo->precio')"
    );

    // Si se insertó correctamente
    if ($filasAfectadas > 0) {
        $id = $conexion->lastInsertId();
        $resp = new stdClass();
        $resp->respuesta = "ok";
        $resp->id = $id;
        //echo $resp;
    } else {
        $resp = devolverError(3, "No se pudo insertar el coche.");
    }
} catch (PDOException $pdoException) {
    $resp = devolverExcepcion($pdoException->getMessage());
}

// Enviamos las cabeceras y el objeto JSON
echo json_encode($resp);

?>
