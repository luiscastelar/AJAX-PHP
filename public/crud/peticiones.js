//-------------------------------------------------
// 1. Arranque:
//-------------------------------------------------
// Comprueba que existe la conexion a la bbdd existeDB.php
const RESULTADO = document.querySelector("#resultado");

document.querySelector("#btnExiste").addEventListener("click", () => {
  const url = "http://localhost:8000/crud/auxiliares/existeDB.php";
  fetch(url)
    .then((response) => response.json())
    .then((json) => {
        // Uso de switch para poder personalizar más adelante
        switch (json.codigo){
            case 0:
                RESULTADO.textContent = "Todo listo para ejecutar el crud";
                break;
            default:
                RESULTADO.textContent = `Error ${json.codigo}: ${json.mensaje}`;
        }
        console.log( json );
    })
    .catch((err) => console.error(`Error: ${err}`));
});


//-------------------------------------------------
// 2. Listar:
//-------------------------------------------------
document.querySelector("#btnListar").addEventListener("click", () => {
  fetch("http://localhost:8000/crud/getAll.php")
      .then( response => response.json() )
      .then( json => {
          console.log( json );
          RESULTADO.innerHTML = "Listado de coches:";
          // Cada elemento...
          json.forEach(coche => {
              insertarLinea(RESULTADO, coche);
          })
      })
      .catch( err => console.error(`Error: ${err}`));
});


//-------------------------------------------------
// 3. Obtener el coche ...
//-------------------------------------------------
const COCHE_ID = document.querySelector('#cocheId');
document.querySelector('#btnGetUno').addEventListener('click', () =>{
    //const COCHE_ID.value
    const url = `http://localhost:8000/crud/getOne.php`;
    const parametros = {
        action: "get",
        id: COCHE_ID.value,
    };
    // 'Content-Type': 'application/x-www-form-urlencoded', // si se pasan datos como parámetros
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(parametros),
    })
        .then((response) => response.text())
        .then((data) => {
            RESULTADO.textContent = data;
        });
    //RESULTADO.innerHTML = `OK. Has pedido el coche ${ COCHE_ID.value }`;

});


//-------------------------------------------------
// 4. Crear un coche nuevo
//-------------------------------------------------
document.querySelector("#btnNuevo").addEventListener("click", () => {
    insertarLinea( RESULTADO,{} );
    const BTN = document.createElement('button');

});

document.querySelector("#btnNuevoEnviar").addEventListener("click", () => {
  const url = "http://localhost:8000/servicio.php";
  //const parametros = 'nombre=Luis&apellido=Mejia';
  const parametros = {
    nombre: "Luis",
    apellido: "Mejia",
  };
  // 'Content-Type': 'application/x-www-form-urlencoded', // si se pasan datos como parámetros
  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(parametros),
  })
    .then((response) => response.text())
    .then((data) => {
      RESULTADO.textContent = data;
    });
});


//-------------------------------------------------
// Funciones
//-------------------------------------------------
function insertarLinea(DONDE, coche){
    console.log(coche);
    const li = document.createElement("li");
    const id = coche.id ?? 'N';
    const matricula = coche.matricula ??'';
    const revisado = (coche.revisado==1)? 'checked' : '';
    const kilometros = coche.kilometros ?? '';
    const precio = coche.precio ?? '';
    let linea = `${id} - <input type="hidden" value="${id}" />`;
    linea += `<input type="text" id="matricula_${id}" value="${matricula}"/>`;
    linea += `<input type="checkbox" id="revisado_${id}" ${revisado}/>`;
    linea += `<input type="text" id="kilometros_${id}" value="${kilometros}"/> kms`;
    linea += `<input type="text" id="precio_${id}" value="${precio}"/>`;
    if (coche.id != null){
        linea += `<button id='mod_${id}'>#</button>`;
        linea += `<button id='del_${id}'>X</button>`;
    } else {
        linea += `<button id='add_${id}'>+</button>`;
    }
    li.innerHTML = linea;
    DONDE.appendChild( li );

    if (coche.id != null){
        //linea += `<button id='mod_${id}'>#</button>`;
        //linea += `<button id='del_${id}'>X</button>`;
    } else {
        //linea += `<button id='add_nuevo'>+</button>`;
        document.querySelector('#add_N').addEventListener('click', () => {
            let matricula = document.querySelector('#matricula_N').value;
            let revisado = document.querySelector('#revisado_N').checked;
            let kilometros = document.querySelector('#kilometros_N').value;
            let precio = document.querySelector('#precio_N').value;
            const coche = {};
            coche.matricula = matricula;
            coche.revisado = revisado;
            coche.kilometros = kilometros;
            coche.precio = precio;

            console.log(`Insertar el coche con matricula: ${matricula}`, revisado, kilometros, precio);
            console.log(coche);


        })
    }
}