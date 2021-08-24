function validar_rechazo(){

    let texto;
    texto = document.getElementById("rechazo").value;
    var length = texto.length;
    comparar= /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü0-9-_.,\s]*$/;

    let id_equipo;
    id_equipo = document.getElementById("id").value;
    texto = document.getElementById("rechazo").value;


    if(length > 200 ){
        document.getElementById("mensaje_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>El maximo de caracteres es 200</div>"
        return false;
    }
    if(!comparar.test(texto)){
        document.getElementById("mensaje_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Error! simbologia no permitida</div>"
        return false;
    }
    if(texto == ""){
        document.getElementById("mensaje_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Motivo de rechazo no puede estar vacio</div>"
        return false;
    }
    if(id_equipo == ""){
        document.getElementById("mensaje_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Id equipo vacia!</div>"
        return false;
    }
    if(isNaN(id_equipo)){
        document.getElementById("mensaje_error2").innerHTML="<div class='alert alert-danger mt-3' role='alert'>Id equipo no es un numero!</div>"
        return false;
    }
}