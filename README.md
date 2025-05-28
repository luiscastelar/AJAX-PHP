# AJAX-PHP
Ramas:
+ main: un ajax-php rápido de envío y recepción con json.
+ crud: [en desarrollo] una aproximación a un CRUD y aproximación de rutas
+ node: [en desarrollo] una aproximación ajax-node con express.

## Previo
1. Crear la imagen con Dockerfile (no hacer nada)
2. Crear el contenedor con la imagen creada (docker compose up -d)

_Si queremos actualizar la imagen, deberemos hacer `docker compose build` y despues `docker compose up -d` para actualizar el contenedor._  

## Ejecución
1. Archivo de entrada: http://localhost:8000 (accede a index.php)
2. El botón es gestionado por "peticiones.js" que hace una petición POST con AJAX al servicio http://localhost:8000/servicio.php 
3. El servicio responde y es procesado por "peticiones.js" y se muestra en la página

## Pruebas rápidas
Mediante `curl`:
```bash
# Explícito:
curl --data '{"nombre": "Luis", "apellido": "Ferreira"}' --header 'Content-type: application/json'  http://localhost:8000/servicio.php

# O resumido:
curl -X POST -H "Content-Type: application/json" -d '{"nombre":"Luis","apellido":"Ferreira"}' http://localhost:8000/servicio.php
```

Por su puesto, también en:
+ `POSTMAN`
+ VSC (extension `REST Client`)
+ IntelliJ IDEA (extension [`Restful Api Tool`](https://plugins.jetbrains.com/plugin/22446-restful-api-tool/versions/stable))
