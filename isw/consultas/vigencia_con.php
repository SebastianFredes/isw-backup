<?php
include('../sesion/validar_sesion.php');

if (isset($_POST['kcon']) && is_numeric($_POST['kcon']) && !empty($_POST['kcon'])){   
    
    include "../clases/conexion.php";
    $id_con=$_POST['kcon'];
    $estado_con=5;
    $estado_eq=7;

    date_default_timezone_set('America/Santiago');
    $fecha = date('Y-m-d');

    /*  Suma de cantidades totales de detalle entrega y detalle */ 
    $sql = "SELECT SUM(cantidad_perfil_llegada) AS det_ent from detalle_entrega, detalle
            WHERE detalle.id_detalle = detalle_entrega.Detalle_id_detalle
            AND detalle.id_contrato = $id_con";

    $consulta = mysqli_query($conexion,$sql);
    $det_entrega = mysqli_fetch_assoc($consulta);

    $sql = "SELECT nombrecontrato , SUM(cantidad_total_perfil) AS total, SUM(cantidad_recepcionados) AS recep, SUM(cantidad_listos) AS listos 
            FROM detalle, contrato
            WHERE detalle.id_contrato = contrato.id_contrato
            AND contrato.id_contrato = $id_con";

    $consulta = mysqli_query($conexion,$sql);
    $det_totales = mysqli_fetch_assoc($consulta);

        if($det_entrega['det_ent'] != $det_totales['total']){
            mysqli_close($conexion);
            header('location:../vistas/vigencia_con.php?error=tt_diff');return;
        }else{

            if($det_totales['total'] == $det_totales['recep'] && $det_totales['recep'] == $det_totales['listos']){

                $sql = "UPDATE equipo 
                        INNER JOIN contrato ON equipo.contrato_idcontrato = contrato.id_contrato
                        INNER JOIN estado_contrato ON contrato.id_contrato = estado_contrato.id_contrato
                        INNER JOIN detalle ON contrato.id_contrato = detalle.id_contrato
                        SET equipo.Estado_id_estado_revision = $estado_eq,
                        estado_contrato.id_estado_cto = $estado_con,
                        estado_contrato.fecha_estado_contrato = '$fecha',
                        detalle.fecha_inicio_contrato = '$fecha'
                        WHERE equipo.contrato_idcontrato = contrato.id_contrato
                        AND contrato.id_contrato = estado_contrato.id_contrato
                        AND contrato.id_contrato = detalle.id_contrato
                        AND equipo.contrato_idcontrato = $id_con";
    
                if(mysqli_query($conexion,$sql)){
                    mysqli_close($conexion); 
                    header('location:../vistas/vigencia_con.php?mensaje=vigente');return;
                }else{
                    mysqli_close($conexion); 
                    header('location:../vistas/vigencia_con.php?error=err');return;
                }

            }else{

                mysqli_close($conexion);
                header('location:../vistas/vigencia_con.php?error=faltan');return;

            }
        } 
}else{
    
    header('location:../vistas/vigencia_con.php?error=errorvigencia');return;

}

?>