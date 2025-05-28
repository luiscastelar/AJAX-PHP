//-------------------------------------------------
// Las variables y constantes
//-------------------------------------------------

//-------------------------------------------------
// Definición de clases
//-------------------------------------------------

//-------------------------------------------------
// Las zonas
//-------------------------------------------------
const PETICION = document.querySelector("#peticion");
const RESULTADO = document.querySelector("#resultado");

//-------------------------------------------------
// Los métodos
//-------------------------------------------------

//-------------------------------------------------
// Las acciones
//-------------------------------------------------
PETICION.addEventListener("click", () => {
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
