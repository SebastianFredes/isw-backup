/* Carga la id del equipo en el modal y la id sugerida */
function asignar_cargar_id_modal(id){
  let d=id;
  $("#id_bd").val(d);

  $.ajax({
    
    url:"../consultas/asignar_sugerencia_id.php",
    type:"POST",
    data: {id_bd: d},
    dataType: "json",

    success: function(data){
    let sugerencia, perfil, con, con_n, mes, año, equipo;

    perfil = data[0].perfil.substr(0,1); //Letra inicial del perfil (P)
    perfil = perfil.toUpperCase(); ///Tansforma los caracteres a mayúsculas
    perfil = perfil + data[0].perfil[data[0].perfil.length -1]; //+ número de perfil (n)

    con = data[0].nombreC.split('_')[0];
    con_n = data[0].nombreC.split('_')[1];
    con = data[0].nombreC.substr(0,3); //Tres primeras letras de contrato (Con)
    con = con.toUpperCase(); //Tansforma los caracteres a mayúsculas
    con = con + con_n //+ número de contrato (n)

    mes = data[0].fecha.split('-')[1]; //Se obtiene el mes de la fecha en formato dd-mm-yyyy
    año = data[0].fecha.split('-')[2]; //Se obtiene el año la fecha en formato dd-mm-yyyy
    año = año.substr(2,3); //Se obtienen los últimos números del año
    año = mes + año //Se junta el mes y el año (mmyy)
    equipo = data[0].nequipo;
    
    sugerencia = perfil+"-"+con+"-"+año+"-"+equipo; // Se unen las cadenas con un separador entre ellas
    
    document.getElementById("idinterna").value = sugerencia; // Se carga la cadena final en el input

    } 
  });

}

function limpiar() {
  limpiar_msj(); 
  limpiar_id_obv(); 
}

function limpiar_id_obv(){  //Limpia los input de id institucional y observacion
  document.getElementById("idinterna").value = "";
  document.getElementById("observacion").value = "";
}

function limpiar_msj(){ //Limpia el mensaje de error de js
  document.getElementById("msj_error").innerHTML="";
}

/*
function validar_check() {  //Valida si el check esta activo o no para almacenar la fecha en el Session Storage
  if (document.getElementById("check_fijar").checked) {
    var fecha= (document.getElementById("fecha_r").value); //Captura la fecha en el input
    sessionStorage.setItem("fecha_fija", fecha);  //Guardando los datos en el sessionStorage
  }else{
    sessionStorage.setItem("fecha_fija", "Null");  //Guardando los datos en el sessionStorage
  }
}
 Funcion para cargar la fecha desde el Session Storage
function cargar_fecha_sS(){
  if(sessionStorage.getItem("fecha_fija") == "Null" || sessionStorage.getItem("fecha_fija") == ""){
    document.getElementById("check_fijar").checked = false; //Se desmarca el check
    document.getElementById("fecha_r").value = "";  //Se borra el contenido del campo fecha
  }else{
    document.getElementById("check_fijar").checked = true; //Activar el Check 
    var fecha_r = sessionStorage.getItem("fecha_fija"); //Obtener datos almacenados 
    document.getElementById("fecha_r").value = fecha_r; //Mostrar datos almacenados
  }
}
*/