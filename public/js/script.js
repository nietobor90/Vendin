//DeclaraciÃ³n de variables
var window;

////////////////////////////////////COOKIES///////////////////////////////////////
//Función para cookies
function controlcookies() {
// si variable no existe se crea (al clicar en Aceptar)
localStorage.controlcookie = (localStorage.controlcookie || 0);
 
localStorage.controlcookie++; // incrementamos cuenta de la cookie
cookie1.style.display='none'; // Esconde la política de cookies
}


//ENVIAR FORMULARIO PARA ORDENAR PRODUCTOS
function enviarOrden() {
    document.formOrden.submit();
}

function pregunta(){ 
    if (confirm('¿Estas seguro de enviar este formulario?')){ 
       document.tuformulario.submit() 
    } 
} 

//////////////////////////////FUNCIÓN PRINCIPAL/////////////////////////////////////////////////

//CARGAR FUNCIÓN PRINCIPAL
window.onload = principal;

function principal() {
}
//funciones para hacer pantalla entre dos imagenes
function cambiar () {
  document.getElementById('frente').style.display="block"; 
 }
 
 function volver () {
   document.getElementById('frente').style.display="none"; 
 }


