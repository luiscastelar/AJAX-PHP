/**
   This example shows:

    Creating an Express application
    Adding application-level middleware
    Defining routes with different response types
    Using route parameters
    Starting the HTTP server

    Fuente: https://deepwiki.com/expressjs/express

    Creando una API REST https://medium.com/secuoyas/consejos-para-dise%C3%B1ar-una-api-rest-4e92b9acfda5
*/

const express = require('express')
const app = express()
const PORT = 3000

// Application-level middleware
/*app.use((req, res, next) => {
  console.log(`${req.method} ${req.url}`);
  next();
});
*/
// Route definitions
app.get('/', (req, res) => {
  res.send('Hello World');
});

app.get('/api/data', (req, res) => {
  res.json({ message: 'This is JSON data' });
});

console.log('Iniciando app...')
const users = [];
class usuario {
    static nextId = 0;
    constructor(nombre, edad){
        this.id = this.constructor.nextId++;
        this.nombre = nombre ??= 'desconocido' ;
        this.edad = edad;
    }
    getId(){ return id; }
}
console.log('Cargando datos de prueba...');
users.push( new usuario ('Luis') );
users.push( new usuario () );
users.push( new usuario ('Juan', 23) );
console.log('Datos de prueba:', users );

// Get
const getOne = (res,id) => {
    let respuesta = `Solicitado el usuario: ${id}<br />`;
    users.filter( e => e.id == id )
        .forEach( e => respuesta += `El usuario (${e.id}) ${e.nombre} tiene ${e.edad ??= 'desconocida' }<br />` );
    respuesta += `<a href="http://localhost:3000/users/?id=${Number(id)+1}">Siguiente</a><br />`;
    // También con ${++id}. El operador pre-decremento realiza la conversión implícita a número
    res.send( respuesta );
};

// Get All /users or One /users/id=xxx
app.get('/users', (req, res) => {
    const id =  req.query.id;
    if (id === undefined){
        let respuesta = 'Get ALL USERS<br />';
        users.forEach( u => respuesta += `${u.nombre} (${u.id}) - ${u.edad} años<br />` );
        res.send( respuesta );
    } else {        
        getOne(res,id);
    }

});
// Get One /users/id
app.get('/users/:id', (req, res) => {
    const id = req.params.id;
    getOne(res,id);
});

// Post One
// Investigar app.route('/users')
//                 .get(f)
//                 .post(f)
//                 .put(f)
//app.use(require('body-parser').urlencoded({ extended: false })); //=> url-encoded
app.use(express.json());
app.post('/users', function(req, res) {
    console.log( req.body );
    const nombre = req.body.nombre || '';
    const edad = req.body.edad || '';

    const personaRecibida = new usuario( nombre, edad );
    users.push( personaRecibida );

    res.send( `El usuario ${nombre} se creó con éxito y se le asignó el id: ${personaRecibida.id}` );
                
    //res.send({ 'resultado': 'ok' });
});

// Start the server
app.listen(PORT, () => {
  console.log(`Example app listening on port ${PORT}`)
})
