<?php
require_once "auxiliares/funciones.php";
// CRUD: Insertar coche
//------------------------------------------------------------------------------
header("Content-Type: application/json; charset=utf-8");

// Conectamos con la bbdd
$conexion = include "./auxiliares/crearConexion.php";
if ($conexion == null) {
    $resp = devolverError(1, "No se pudo conectar a la base de datos.");
} else {
    try {
        $listaDeCoches = [];

        $stmt = $conexion->query("SELECT * FROM coches");

        // get all publishers
        $coches = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($coches as $coche) {
            $cocheNuevo = new stdClass();
            $cocheNuevo->id = $coche["id"];
            $cocheNuevo->matricula = $coche["matricula"];
            $cocheNuevo->revisado = $coche["revisado"];
            $cocheNuevo->kilometros = $coche["kilometros"];
            $cocheNuevo->precio = $coche["precio"];
            $listaDeCoches[] = $cocheNuevo;
            $resp = $listaDeCoches;
        }
    } catch (PDOException $pdoException) {
        $resp = devolverExcepcion($pdoException->getMessage());
    }
}


// Enviamos las cabeceras y el objeto JSON

echo json_encode($resp);

?>
