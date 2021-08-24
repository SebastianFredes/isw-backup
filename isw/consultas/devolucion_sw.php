<?php
    include('../sesion/validar_sesion.php');
    if ((isset($_POST['id'])) && (isset($_POST['id_perfil'])) ){    //Comprobar que id_bd este definida 
        if((!empty($_POST['id'])) && (!empty($_POST['id_perfil'])) ){   //Comprobar que id_bd que no estan vacias 
            if($_POST['rechazo']==""){
                header('location:../vistas/revision_sw.php?error=vacio');return;
            }
            $comparar= '/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü0-9-_.,\s]*$/'; 
            if(!preg_match_all($comparar,$_POST['rechazo'])){
                header('location:../vistas/revision_sw.php?error=simbolos');return;
            }else if(strlen($_POST['rechazo']) > 200){
                header('location:../vistas/revision_sw.php?error=rechazo');return;
            }


            date_default_timezone_set('America/Santiago');
            $id_equipo=$_POST['id'];
            $id_perfil=$_POST['id_perfil'];
            $rechazo=$_POST['rechazo'];
            $estado=5;

            $rechazo=trim($rechazo);  //elimina espacios vacios del inicio y final
            if(!is_numeric($id_equipo)){
                header('location:../vistas/revision_sw.php?error=errorenvio');return;
            }

            $fecha_historial = date('Y-m-d H:i:s');

            include "../clases/conexion.php";
            //Verifica si existe equipo con esa id
            $contar = "SELECT count(id_equipo) as contador FROM equipo eq, estado_revision es
                    WHERE eq.Estado_id_estado_revision = es.id_estado_revision
                    AND eq.id_equipo = $id_equipo
                    AND es.nombre_estado = 'revision sw'";
            
            $consulta = mysqli_query($conexion,$contar);
            $respuesta = mysqli_fetch_assoc($consulta);
            if($respuesta['contador'] != 1 ){
                mysqli_close($conexion);
                header('location:../vistas/revision_sw.php?error=noexiste');return;
            }

            $cambiar_estado="UPDATE detalle det 
                            INNER JOIN contrato con ON det.id_contrato = con.id_contrato 
                            INNER JOIN equipo eq ON con.id_contrato = eq.contrato_idcontrato 
                            SET eq.Estado_id_estado_revision = $estado, 
                            eq.rechazo = '$rechazo', 
                            det.cantidad_recepcionados = det.cantidad_recepcionados - 1 
                            WHERE eq.id_equipo = $id_equipo
                            AND det.id_contrato = con.id_contrato 
                            AND det.id_perfil = eq.perfil_idperfil";
            
            if(mysqli_query($conexion, $cambiar_estado)){

                $existe ="SELECT count(id_equipo) as contador FROM estado_equipo
                          WHERE id_equipo = $id_equipo
                          AND id_estado_revision = $estado";
                $consulta = mysqli_query($conexion,$existe);
                $res = mysqli_fetch_assoc($consulta);

                if($res['contador']>=1){
                $historial="UPDATE estado_equipo 
                            SET fecha_estado = '$fecha_historial' 
                            WHERE id_equipo= $id_equipo
                            AND id_estado_revision = $estado";
                            mysqli_query($conexion,$historial);

                }else{
                $historial="INSERT INTO estado_equipo(id_estado_revision, id_equipo, fecha_estado) 
                            VALUES ($estado,$id_equipo,'$fecha_historial')";
                            mysqli_query($conexion,$historial);
                }

                mysqli_close($conexion);  
                header('location:../vistas/revision_sw.php?mensaje=devolucion');return;
            }else{
                mysqli_close($conexion);
                header('location:../vistas/revision_sw.php?error=errorenvio');return;
            }
        }
        else{
            header('location:../vistas/revision_sw.php?error=idvacia');return;
        }   
    }
    else {
        header('location:../vistas/revision_sw.php?error=idnodefinida');return;
    }
?>