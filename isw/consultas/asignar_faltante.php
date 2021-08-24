<?php
include('../sesion/validar_sesion.php');

if (isset($_POST['id_bd2']) && is_numeric($_POST['id_bd2']) && !empty($_POST['id_bd2'])){   
    // Comprobar que id_bd2 esta definida && si es un numero && no esta vacia 
    
    include "../clases/conexion.php";
    $id_bd=$_POST['id_bd2'];
    $estado=2;

    date_default_timezone_set('America/Santiago');
    $fecha_historial = date('Y-m-d H:i:s');

    /*  Verifica si existe un equipo con esa id auto-incremental y que su estado sea nuevo */ 
    $count_idbdequipo = "SELECT count(id_equipo) as contador FROM equipo eq, estado_revision es
                         WHERE eq.Estado_id_estado_revision = es.id_estado_revision
                         AND eq.id_equipo = $id_bd
                         AND es.nombre_estado = 'nuevo'";

    $consulta = mysqli_query($conexion,$count_idbdequipo);
    $res = mysqli_fetch_assoc($consulta);

        if($res['contador'] != 1 ){
        mysqli_close($conexion);
        header('location:../vistas/asignar_id.php?error=bdequipo_noexiste');return;
        }else{

            $sql="UPDATE detalle det 
                  INNER JOIN contrato con ON det.id_contrato = con.id_contrato
                  INNER JOIN equipo eq ON con.id_contrato = eq.contrato_idcontrato
                  SET eq.Estado_id_estado_revision = $estado,
                  det.cantidad_recepcionados = det.cantidad_recepcionados - 1
                  WHERE det.id_contrato = con.id_contrato
                  AND det.id_perfil = eq.perfil_idperfil
                  AND eq.id_equipo = $id_bd";

            if(mysqli_query($conexion, $sql)){
                
                $existe ="SELECT count(id_equipo) as contador FROM estado_equipo
                          WHERE id_equipo = $id_bd
                          AND id_estado_revision = $estado";
                $consulta = mysqli_query($conexion,$existe);
                $res = mysqli_fetch_assoc($consulta);

                    if($res['contador']>=1){
                        $historial="UPDATE estado_equipo SET
                                    fecha_estado = '$fecha_historial' 
                                    WHERE id_equipo= $id_bd
                                    AND id_estado_revision = $estado";
                                    mysqli_query($conexion,$historial);

                    }else{
                        $historial="INSERT INTO estado_equipo(id_estado_revision, id_equipo, fecha_estado) 
                                    VALUES ($estado,$id_bd,'$fecha_historial')";
                                    mysqli_query($conexion,$historial);
                    }
                
                mysqli_close($conexion);
                header('location:../vistas/asignar_id.php?mensaje=ingresado_F');

            }else{

                mysqli_close($conexion);
                header('location:../vistas/asignar_id.php?error=errorenvio');return;

            }
        } 


}else{
    
    header('location:../vistas/asignar_id.php?error=errorfaltante');return;

}

?>