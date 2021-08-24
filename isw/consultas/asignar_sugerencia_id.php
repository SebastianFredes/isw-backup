<?php
include('../sesion/validar_sesion.php');
if (isset($_POST['id_bd']) && is_numeric($_POST['id_bd']) && !empty($_POST['id_bd'])){   
    // Comprobar que id_bd esta definida && si es un numero && no esta vacia 
    
    include "../clases/conexion.php";
    $id_bd=$_POST['id_bd'];
    $consulta= ("SELECT perfil_nombre, nombrecontrato, DATE_FORMAT (fecha_termino,'%d-%m-%Y') AS fecha_te, id_equipo
                FROM equipo eq, contrato con, perfil p, ficha_juridica fi
                WHERE p.id_perfil = eq.perfil_idperfil
                AND eq.contrato_idcontrato = con.id_contrato
                AND con.id_ficha_juridica = fi.id_ficha_juridica
                AND eq.id_equipo = $id_bd");

    $resultado= mysqli_query($conexion,$consulta);
    $datos=array();
    while($fila=mysqli_fetch_array($resultado)){
            $datos[]=array(
            'perfil'=>$fila["perfil_nombre"],
            'nombreC'=>$fila["nombrecontrato"],
            'fecha'=>$fila["fecha_te"],
            'nequipo'=>$fila["id_equipo"],
            );
    }
    $enviar=json_encode($datos);
    print $enviar;
    mysqli_close($conexion);  
    // return $resultado;
}
?>