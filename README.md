# AJAX-PHP

## Previo
1. Crear la imagen con Dockerfile (no hacer nada)
2. Crear el contenedor con la imagen creada (docker compose up -d)

_Si queremos actualizar la imagen, deberemos hacer docker compose build y despues docker compose up -d para actualizar el contenedor._

## Ejecución
1. Archivo de entrada: http://localhost:8000 (accede a index.php)
2. El botón es gestionado por "peticiones.js" que hace una petición POST con AJAX al servicio http://localhost:8000/servicio.php 
3. El servicio responde y es procesado por "peticiones.js" y se muestra en la página