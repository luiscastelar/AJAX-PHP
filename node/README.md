# Node.js

## Crear server.js:
```js
const express = require('express');
const app = express();

// Application-level middleware
app.use((req, res, next) => {
  console.log(`${req.method} ${req.url}`);
  next();
});

// Route definitions
app.get('/', (req, res) => {
  res.send('Hello World');
});

app.get('/api/data', (req, res) => {
  res.json({ message: 'This is JSON data' });
});

app.get('/users/:id', (req, res) => {
  res.send(`User ID: ${req.params.id}`);
});

// Start the server
app.listen(3000, () => {
  console.log('Server running on port 3000');
});
```
This example shows:

    Creating an Express application
    Adding application-level middleware
    Defining routes with different response types
    Using route parameters
    Starting the HTTP server


## Crear proyecto `npm init`
## Instalar dependencias
Instalar dependencias `npm install express`. 

Si nuestra aplicación no se llamara `server.js` (nombre por defecto) deberemos añadir el script `package.json` el atributo start: `"start": "node app.js"` (donde app.js es el nombre de la aplicación desarrollada).

## Crear Dockerfile
```Dockerfile
# Utiliza una imagen base de Node.js mínima
FROM node:alpine

# Establece el directorio de trabajo en el directorio raíz de la imagen
WORKDIR /usr/src/app

# Copia el package.json y el archivo lock (si lo tienes)
COPY package*.json ./

# Instala las dependencias
RUN npm install

# Copia el resto de los archivos de la aplicación
COPY . .

# Exponer el puerto 3000
EXPOSE 3000

# Comando para iniciar la aplicación
CMD [ "npm", "start" ]
#ENTRYPOINT [ "node", "server.js" ]
```

Con CMD nos permite sobreescribir el arranque y utilizar el contenedor para correr el script de test si lo hubiera.

## Crear compose.yml:
```yml
services:
  cors:
    build:
      dockerfile: Dockerfile
      context: .
    ports:
      - "3000:3000"
    entrypoint: ["node", "server.js", "argumento1", "argumento2"]
```

## TIPs
Para un proyecto ocasional no merece la pena instalar node. Podemos correrlo en un contenedor con: `alias node='docker run --rm -it -u $(id -u):$(id -g) -v $(pwd):/app -w /app  node:latest'`

Pudiendo correr luego "dentro" `node npm init` y `node npm install` express para generar package.json e instalar el módulo express con.
