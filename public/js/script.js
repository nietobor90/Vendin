//DeclaraciÃ³n de variables
var window, expr, nombre, ape, mail, pwd, dato, letras, pwd2;

//function validar_nombre() {
//    "use strict";
//    var sw;
//    nombre = window.document.getElementById("nombre").value;
//    if (tiene_numeros(nombre) || nombre.length <= 2) {
//            window.document.getElementById("nombre").style.border = "2px solid #B00000 ";/*color rojo oscuro*/
//            sw = false;
//    } else {
//        window.document.getElementById("nombre").style.border = "solid 2px #B8B8B8"; /*color barras verticales*/
//        sw = true;
//    }
//    return sw;
//}
//var numeros="0123456789";
//
////Saber si el string contiene caracteres numéricos 
//function tiene_numeros(texto){
//   for(i=0; i<texto.length; i++){
//      if (numeros.indexOf(texto.charAt(i),0)!=-1){
//         return 1;
//      }
//   }
//   return 0;
//}
//
//function validar_ape() {
//    "use strict";
//    var sw;
//    ape = window.document.getElementById("ape").value;
//    if (tiene_numeros(ape) || ape.length <= 2) {
//            window.document.getElementById("ape").style.border = "2px solid #B00000 ";/*color rojo oscuro*/
//            sw = false;
//    } else {
//        window.document.getElementById("ape").style.border = "solid 2px #B8B8B8"; /*color barras verticales*/
//        sw = true;
//    }
//    return sw;
//}
//
//function validar_mail() {
//    "use strict";
//    var sw;
//    mail = window.document.getElementById("mail").value;
//    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//
//    if (!expr.test(mail)) {
//        window.document.getElementById("mail").style.border = "2px solid #B00000 ";/*color rojo oscuro*/
//        sw = false;
//    } else {
//        window.document.getElementById("mail").style.border = "solid 2px #B8B8B8"; /*color barras verticales*/
//        sw = true;
//    }
//    return sw;
//}
//
//function validar_pwd() {
//    "use strict";
//    var sw;
//    pwd = window.document.getElementById("pwd").value;
//    if (pwd.length <= 2) {
//        window.document.getElementById("pwd").style.border = "2px solid #B00000 ";/*color rojo oscuro*/
//        sw = false;
//    } else {
//        window.document.getElementById("pwd").style.border = "solid 2px #B8B8B8"; /*color barras verticales*/
//        sw = true;
//    }
//    return sw;
//}
//function validar_pwd2() {
//    "use strict";
//    var sw;
//    pwd2 = window.document.getElementById("pwd2").value;
//    if (pwd2.length <= 2 || window.document.getElementById("pwd").value != window.document.getElementById("pwd2").value) {
//        window.document.getElementById("pwd2").style.border = "2px solid #B00000 ";/*color rojo oscuro*/
//        sw = false;
//    } else {
//        window.document.getElementById("pwd2").style.border = "solid 2px #B8B8B8"; /*color barras verticales*/
//        sw = true;
//    }
//    return sw;
//}
//function comprobarPwd(){
//    if(window.document.getElementById("pwd").value === window.document.getElementById("pwd2").value){
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function comprobar() {
//    "use strict";
//    if ( validar_nombre() && validar_ape() && validar_mail() && validar_pwd() && validar_pwd2() && comprobarPwd() && window.document.getElementById('condiciones').checked) {
//        return true;
//    }
//    return false;
//}

////////////////////////////////////COOKIES///////////////////////////////////////
//Función para cookies
function controlcookies() {
// si variable no existe se crea (al clicar en Aceptar)
localStorage.controlcookie = (localStorage.controlcookie || 0);
 
localStorage.controlcookie++; // incrementamos cuenta de la cookie
cookie1.style.display='none'; // Esconde la política de cookies
}

//////////////////////////////////////////BUSQUEDA DE PRODUCTOS////////////////////////////////////////////
/////////////////////////////////////////NO ACTUALIZADA////////////////////////////////////////////////////
//FUNCIÓN que Implementa la funcionalidad de la caja de búsqueda de productos
function cargaXMLDoc(){
	var xmlhttp, img;
	var n = document.getElementById("buscar").value;
	var resultado = document.getElementById("resultado");
    var loading = document.getElementById("imagen");

    //carga de gif de carga
    if (loading.children.length === 0) {
        img = document.createElement("img");
        img.setAttribute("src", "img/gif-load.gif");
        loading.appendChild(img);    
    }

	if(window.XMLHttpRequest){
		//PARA IE7, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();  
	} else {
		//PARA IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
			document.getElementById("resultado").innerHTML = xmlhttp.responseText;
			loading.innerHTML = "";
		}
	}
	
	if(n === ""){
		resultado.innerHTML = "";
		resultado.removeAttribute("style");
        loading.innerHTML = "";
		xmlhttp.abort();
	} else {
		//hostin:
		//http://aperitivosmb.esy.es/cgi-bin/conexion.php
		xmlhttp.open("POST", "http://aperitivosmb.esy.es/cgi-bin/conexion.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("cadena="+n);
	}

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

function principal() {
    "use strict";
    //BARRA DE BUSQUEDA
    window.document.getElementById("buscar").onkeyup = cargaXMLDoc;
    //COOKIES
//    window.document.getElementById("acepCookie").onclick = controlcookies;
    
    //FORMULARIO
//    window.document.getElementById("nombre").addEventListener("keyup", function () {validar_nombre(); });
//    window.document.getElementById("nombre").addEventListener("focus", function () {validar_nombre(); });
//    window.document.getElementById("nombre").addEventListener("blur", function () {validar_nombre(); });
//
//    window.document.getElementById("ape").addEventListener("keyup", function () {validar_ape(); });
//    window.document.getElementById("ape").addEventListener("focus", function () {validar_ape(); });
//    window.document.getElementById("ape").addEventListener("blur", function () {validar_ape(); });
//
//    window.document.getElementById("mail").addEventListener("keyup", function () {validar_mail(); });
//    window.document.getElementById("mail").addEventListener("focus", function () {validar_mail(); });
//    window.document.getElementById("mail").addEventListener("blur", function () {validar_mail(); });
//
//    window.document.getElementById("pwd").addEventListener("keyup", function () {validar_pwd(); });
//    window.document.getElementById("pwd").addEventListener("focus", function () {validar_pwd(); });
//    window.document.getElementById("pwd").addEventListener("blur", function () {validar_pwd(); });
//    
//    window.document.getElementById("pwd2").addEventListener("keyup", function () {validar_pwd2(); });
//    window.document.getElementById("pwd2").addEventListener("focus", function () {validar_pwd2(); });
//    window.document.getElementById("pwd2").addEventListener("blur", function () {validar_pwd2(); });
//
//    window.document.getElementById("enviar").onclick = comprobar;
    
    
}

//CARGAR FUNCIÓN PRINCIPAL
window.onload = principal;



