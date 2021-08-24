function validar_asignar(){

    let id_equipo, id_interna, observacion;

    id_equipo = document.getElementById("id_bd").value;
    id_interna = document.getElementById("idinterna").value;
    observacion = document.getElementById("observacion").value;

    val = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü0-9\-_.,\s]*$/

/*  fecha_min = new Date(2020, 00, 01, 00, 00, 00);
    fecha_actual = new Date();
    fecha_recep = new Date(document.getElementById("fecha_r").value);
    fecha_recep.setMinutes(fecha_recep.getMinutes() + fecha_recep.getTimezoneOffset()); //Código para compensar la diferencia provocada por la zona horaria
*/

    if(id_equipo === ""){
        document.getElementById("msj_error").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Nro de equipo vacio</div>"
        return false;
    }else if(isNaN(id_equipo)){
        document.getElementById("msj_error").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Nro de equipo invalido</div>"
        return false;
    }else if(id_interna === ""){
        document.getElementById("msj_error").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Campo ID institucional obligatorio</div>"
        return false;
    }else if(!val.test(id_interna)){
        document.getElementById("msj_error").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Simbolos no permitidos</div>"
        return false;
    }else if(!val.test(observacion)){
        document.getElementById("msj_error").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Simbolos no permitidos</div>"
        return false;
    }else if (observacion.length > 200){
        document.getElementById("msj_error").innerHTML="<div class='alert alert-warning mt-3' role='alert'>Observación excede el limite de caracteres (200)</div>"
        return false;
    }

}

function validar_faltante(){

    let id_equipo;

    id_equipo = document.getElementById("id_bd2").value;

    if(id_equipo === ""){
        document.getElementById("msj_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Nro de equipo vacio</div>"
        return false;
    }else if(isNaN(id_equipo)){
        document.getElementById("msj_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Nro de equipo invalido</div>"
        return false;
    }

}

function validar_reintegrar(){

    let id_equipo;

    id_equipo = document.getElementById("id_falt").value;

    if(id_equipo === ""){
        document.getElementById("msj_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Nro de equipo vacio</div>"
        return false;
    }else if(isNaN(id_equipo)){
        document.getElementById("msj_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Nro de equipo invalido</div>"
        return false;
    }

}


function validar_vigencia(){
    let id_con;

    id_con = document.getElementById("kcon").value;

    if(id_con === ""){
        document.getElementById("val_detalle").innerHTML="<div class='alert alert-danger mt-3' role='alert'>ID de contrato vacio</div>"
        return false;
    }else if(isNaN(id_con)){
        document.getElementById("val_detalle").innerHTML="<div class='alert alert-danger mt-3' role='alert'>ID de contrato invalido</div>"
        return false;
    }

    
}

function busqueda(){
    let palabra;

    palabra = document.getElementById("id_nomC").value;
    val = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü0-9\-_.,\s]*$/
    sessionStorage.setItem("buscar", palabra);
    if(palabra === ""){
        alert("Debe ingresar una ID institucional de un equipo o el nombre de un contrato");
        sessionStorage.setItem("buscar", "null");
        return false;
    }else if(!val.test(palabra)){
        alert("Simbolos ingresados no permitidos");
        sessionStorage.setItem("buscar", "null");
        return false;
    }else if(palabra !=""){
        palabra = document.getElementById("id_nomC").value;
        sessionStorage.setItem("buscar", palabra);
        return true;
    }
    
}