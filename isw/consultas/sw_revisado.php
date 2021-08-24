<?php
    include('../sesion/validar_sesion.php');
    if(isset($_POST['id'])){
        if(!empty($_POST['id'])){

            date_default_timezone_set('America/Santiago');
            $id_equipo=$_POST['id'];
            $fecha_historial = date('Y-m-d H:i:s');
            $estado=6;
            include "../clases/conexion.php";

            $contar = "SELECT count(id_equipo) as contador FROM equipo eq, estado_revision es
                    WHERE eq.Estado_id_estado_revision = es.id_estado_revision
                    AND eq.id_equipo = $id_equipo
                    AND es.nombre_estado = 'revision sw'";
            
            $consulta = mysqli_query($conexion,$contar);
            $respuesta = mysqli_fetch_assoc($consulta);
            if($respuesta['contador'] != 1 ){
                mysqli_close($conexion);
                header('location:../vistas/revision_sw.php?error=noexiste');return;
            }else{
                $sql="UPDATE detalle det 
                  INNER JOIN contrato con ON det.id_contrato = con.id_contrato
                  INNER JOIN equipo eq ON con.id_contrato = eq.contrato_idcontrato
                  SET eq.Estado_id_estado_revision = $estado,
                  det.cantidad_listos = det.cantidad_listos + 1
                  WHERE det.id_contrato = con.id_contrato
                  AND det.id_perfil = eq.perfil_idperfil
                  AND eq.id_equipo = $id_equipo";
                 
                 if(mysqli_query($conexion, $sql)){
                    $existe ="SELECT count(id_equipo) as contador FROM estado_equipo
                              WHERE id_equipo = $id_equipo
                              AND id_estado_revision = $estado";
                              $consulta = mysqli_query($conexion,$existe);
                              $res = mysqli_fetch_assoc($consulta);
    
                        if($res['contador']>=1){
                        $historial="UPDATE estado_equipo SET
                                    fecha_estado = '$fecha_historial' 
                                    WHERE id_equipo= $id_equipo
                                    AND id_estado_revision = $estado";
                                    mysqli_query($conexion,$historial);
    
                        }else{
                        $historial="INSERT INTO estado_equipo(id_estado_revision, id_equipo, fecha_estado) 
                                    VALUES ($estado,$id_equipo,'$fecha_historial')";
                                    mysqli_query($conexion,$historial);
                        }
    
                    mysqli_close($conexion);
                    header('location:../vistas/revision_sw.php?mensaje=ingresado');
    
                }else{
    
                    mysqli_close($conexion);
                    header('location:../vistas/revision_sw.php?error=errorenvio');return;
                }
            }
        }
        else{
            header('location:../vistas/revision_sw.php?error=vacio');return;
        }
    }
    else{
        header('location:../vistas/revision_sw.php?error=idnodefinida');return;
    }   


?>