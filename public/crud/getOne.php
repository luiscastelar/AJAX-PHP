<?php
require_once "auxiliares/funciones.php";
// CRUD: Insertar coche
//------------------------------------------------------------------------------
// Obtenemos los datos como JSON (enviados con application/json)
$entityBody = file_get_contents("php://input");
$json = json_decode($entityBody);

header("Content-Type: application/json; charset=utf-8");
if ($json->action == 'get'){
    $ID = $json->id;

    $conexion = include "./auxiliares/crearConexion.php";
    if ($conexion == null) {
        $resp = devolverError(1, "No se pudo conectar a la base de datos.");
    } else {
        try {

            $stmt = $conexion->prepare("SELECT * FROM coches WHERE id = ?");
            $stmt->execute(array($ID));
            $coche = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($coche) {
                // convertimos de array a objeto
                $resp = (object)$coche;
            } else {
                // No obtuvimos ninguno
                $resp = devolverError(5, "Ese coche no existe");
            }
        } catch (PDOException $pdoException) {
            $resp = devolverExcepcion($pdoException->getMessage());
        }
    }
} else {
    $resp = devolverError(3, "Peticion no válida ($json->action)");
}

// Devolvemos el objeto JSON
echo json_encode($resp);

?>
