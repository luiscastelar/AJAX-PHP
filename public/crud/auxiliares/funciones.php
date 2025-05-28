<?php
function devolver($respuesta, $codigo, $mensaje){
    $resp = new stdClass();
    $resp->respuesta = $respuesta;
    $resp->codigo = $codigo;
    $resp->mensaje = $mensaje;
    return $resp;
}

function devolverError($codigo, $mensaje){
    return devolver("error", $codigo, $mensaje);
}

function devolverExcepcion($mensaje){
    return devolver("exception", 1, $mensaje);
}
