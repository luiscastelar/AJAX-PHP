<?php
// Obtenemos los datos como JSON (enviados con application/json)
$entityBody = file_get_contents('php://input');
$json = json_decode($entityBody);
//echo $json->nombre;
//echo $json->apellido;

// Formamos el objeto JSON de respuesta
$data = new stdClass();
$data->respuesta = "echo";
$data->nombre = $json->nombre;
$data->apellido = $json->apellido;

/* Opcional: cambiamos el codigo de respuesta `http_response_code(200);`
 * Según el código, nos permitirá continuar mandando información o no.
 * Por ejemplo, si el código es 200 o 404, nos permitirá continuar mandando información, pero si es 
 * un 204 (sin contenido), no. */

// Enviamos las cabeceras y el objeto JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);



// Obtenemos los datos como argumentos (si fueron enviados con application/x-www-form-urlencoded)
// Con POST:
//$nombre = $_POST['nombre'];
//$apellido = $_POST['apellido']; 

// Con GET:
// $_GET['nombre']; => para peticiones GET

// Para respuestas html (sustuir el encabezado application/json por text/html):
//header('Content-Type: text/html; charset=utf-8');
//echo "<div>Hola $nombre $apellido</div>";  
?>