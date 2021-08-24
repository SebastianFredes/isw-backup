<?php
include('../sesion/validar_sesion.php');
if(isset($_POST['id_4']) && !empty($_POST['id_4']) && is_numeric($_POST['id_4'])){
    $id = $_POST['id_4'];

    include "../clases/conexion.php";

    $sql = "UPDATE equipo
            SET Estado_id_estado_revision = 3
            WHERE id_equipo = $id";
    
    if(mysqli_query($conexion, $sql)){
        $slq2 = "DELETE 
                FROM estado_equipo
                WHERE id_estado_revision = 4
                AND id_equipo = $id";

        if(mysqli_query($conexion,$slq2)){
            mysqli_close($conexion);
            header('location:../vistas/revision_sw.php?mensaje=devolver');return;
        }
        else{
            mysqli_close($conexion);
            header('location:../vistas/revision_sw.php?error=devolver');return; 
        }
    }
    else{
        mysqli_close($conexion);
       header('location:../vistas/revision_sw.php?error=devolver');return; 
    }
}
else{
    header('location:../vistas/revision_sw.php?error=devolver');return; 
}


?>