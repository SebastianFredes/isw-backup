<?php
include('../sesion/validar_sesion.php');
if(isset($_POST['id_eq']) && !empty($_POST['id_eq']) && is_numeric($_POST['id_eq'])){
    $id = $_POST['id_eq'];

    include "../clases/conexion.php";

    $sql = "UPDATE detalle det 
            INNER JOIN contrato con ON det.id_contrato = con.id_contrato 
            INNER JOIN equipo eq ON con.id_contrato = eq.contrato_idcontrato 
            SET eq.Estado_id_estado_revision = 4,  
            det.cantidad_listos = det.cantidad_listos - 1 
            WHERE eq.id_equipo = $id
            AND det.id_contrato = con.id_contrato 
            AND det.id_perfil = eq.perfil_idperfil";
    
    if(mysqli_query($conexion, $sql)){
        $slq2 = "DELETE 
                FROM estado_equipo
                WHERE id_estado_revision = 6
                AND id_equipo = $id";

        if(mysqli_query($conexion,$slq2)){
            mysqli_close($conexion);
            header('location:../vistas/listos.php?mensaje=reintegrado');return;
        }
        else{
            mysqli_close($conexion);
            header('location:../vistas/listos.php?error=errorenvio');return; 
        }
    }
    else{
        mysqli_close($conexion);
       header('location:../vistas/listos.php?error=errorfaltante');return; 
    }
}
else{
    header('location:../vistas/listos.php?error=bdequipo_noexiste');return; 
}


?>