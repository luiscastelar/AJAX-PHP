<?php
require_once "funciones.php";
// Enviamos las cabeceras de respuesta
header("Content-Type: application/json; charset=utf-8");
$conexion = include "crearConexion.php";
if ($conexion == null) {
    $resp = devolverError(1, "No se pudo conectar a la base de datos.");
} else {
    try {
        // Creamos el objeto respuesta
        $resp = new stdClass();

        // Petición
        $stmt = $conexion->query("SHOW tables;");
        if ($stmt->rowCount() == 0) {
            $resp = devolverError(1, "Hay conexión, pero el usuario no tiene bases de datos. Hay que crearlas.");
        } else {
            // Hay más de una base de datos.
            $tablas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $existeTabla = false;
            foreach ($tablas as $tabla) {
                if ($tabla['Tables_in_nombreDeLaBD'] == "coches") {
                    $existeTabla = true;
                    break;
                }
            }
            if ($existeTabla) {
                $resp = devolver("ok", 0, "Existe la bbdd y la tabla");
            } else {
                $resp = devolverError(2, "La tabla no existe");
                $resp->tablas = $tablas;
            }
        }
    } catch (PDOException $pdoException) {
        $resp = devolverExcepcion($pdoException->getMessage());
    }
}
// Devolvemos el objeto JSON con la respuesta o el error
echo json_encode($resp);

?>
