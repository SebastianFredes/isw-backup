<?php
  include('../sesion/validar_sesion.php');
  if(isset($_POST['cantidad']) && !empty($_POST['cantidad']) && isset($_POST['id_perfil']) && !empty($_POST['id_perfil']) && isset($_POST['id_contrato']) && !empty($_POST['id_contrato']) && isset($_POST['id_detalle']) && !empty($_POST['id_detalle']) && isset($_POST['detalle_id_detalle']) && !empty($_POST['detalle_id_detalle']) && isset($_POST['id_entrega']) && !empty($_POST['id_entrega'])){
        if(!is_numeric($_POST['cantidad']) && !is_numeric($_POST['id_perfil']) &&  !is_numeric($_POST['id_detalle']) && !is_numeric($_POST['id_contrato']) && !is_numeric($_POST['detalle_id_detalle']) && !is_numeric($_POST['id_entrega'])){
          header('location:../vistas/crear_lote.php?error=error');return;
        }

        $cantidad = $_POST['cantidad'];
        $id_perfil = $_POST['id_perfil'];
        $id_contrato = $_POST['id_contrato'];
        $id_detalle= $_POST['id_detalle'];
        $detalle_id_detalle= $_POST['detalle_id_detalle'];
        $id_entrega= $_POST['id_entrega'];
        date_default_timezone_set('America/Santiago');
        $fecha_recepcion = date('Y-m-d');
        $fecha_historial = date('Y-m-d H:i:s');

        include "../clases/conexion.php";

        $sql ="SELECT cantidad_perfil_llegada
                      FROM detalle_entrega de
                      WHERE  de.detalle_id_detalle = $detalle_id_detalle
                      AND de.entrega_identrega = $id_entrega";
                      
        $consulta = mysqli_query($conexion,$sql);
        $cantidad_bd = mysqli_fetch_assoc($consulta);

        if($cantidad != $cantidad_bd['cantidad_perfil_llegada']){
          header('location:../vistas/crear_lote.php?error=distinto');return;
        }

        $sql2 ="SELECT cantidad_recepcionados
                              FROM detalle
                              WHERE id_detalle = $id_detalle";
        
        $consulta = mysqli_query($conexion,$sql2);
        $cantidad_recepcion = mysqli_fetch_assoc($consulta);

        $sql3 = "SELECT cantidad_total_perfil
                            FROM detalle
                            WHERE id_detalle = $id_detalle";

        $consulta = mysqli_query($conexion,$sql3);
        $cantidad_total = mysqli_fetch_assoc($consulta);

        if(($cantidad_bd['cantidad_perfil_llegada'] + $cantidad_recepcion['cantidad_recepcionados']) <= $cantidad_total['cantidad_total_perfil']){
          for($i=1; $i<=$cantidad_bd['cantidad_perfil_llegada']; $i++){
              $sql4="INSERT INTO equipo (fecha_recepcion,  contrato_idcontrato, perfil_idperfil, Estado_id_estado_revision) 
              VALUES ('$fecha_recepcion',$id_contrato,$id_perfil,1)";
              if($consulta=mysqli_query($conexion,$sql4)){

                  $sql5="SELECT MAX(id_equipo) AS id 
                         FROM equipo";
                  $consulta2=mysqli_query($conexion,$sql5);
                  $id_equipo = mysqli_fetch_assoc($consulta2);
                  $id_equipo2 = $id_equipo['id'];
                  $existe ="SELECT count(id_equipo) as contador FROM estado_equipo
                            WHERE id_equipo = $id_equipo2
                            AND id_estado_revision = 1";
                  $consulta = mysqli_query($conexion,$existe);
                  $res = mysqli_fetch_assoc($consulta);

                  if($res['contador']>=1){
                      $historial="UPDATE estado_equipo 
                                  SET fecha_estado = '$fecha_historial' 
                                  WHERE id_equipo= $id_equipo";
                      mysqli_query($conexion,$historial);

                  }else{
                        $historial="INSERT INTO estado_equipo(id_estado_revision, id_equipo, fecha_estado) 
                        VALUES (1,$id_equipo2,'$fecha_historial')";
                        mysqli_query($conexion,$historial);
                  }
                  $update_cantidad="UPDATE detalle
                                    SET cantidad_recepcionados = cantidad_recepcionados +1
                                    WHERE id_detalle = $id_detalle";
                  mysqli_query($conexion,$update_cantidad);        
              }
              else{
                header('location:../vistas/crear_lote.php?error=error_equipo');return;
                mysqli_close($conexion);
              }

          }

          $sqllote="INSERT INTO lote(id_lote) 
                    VALUES (null)";         
          mysqli_query($conexion,$sqllote);

          $sql6="SELECT MAX(id_lote) AS id 
                FROM lote";
          $respuesta= mysqli_query($conexion,$sql6);
          $id_lote= mysqli_fetch_assoc($respuesta);
          $id_lote2 = $id_lote['id'];
          
          $sql7="UPDATE detalle_entrega
                 SET lote_id_lote = $id_lote2
                 WHERE detalle_id_detalle = $detalle_id_detalle
                 AND entrega_identrega = $id_entrega";
          mysqli_query($conexion,$sql7);
          mysqli_close($conexion);  
          header('location:../vistas/crear_lote.php?mensaje=mensajeenvio');return;
        }
        else{
          header('location:../vistas/crear_lote.php?error=distinto');return;
          mysqli_close($conexion);
        }


  }
  else{
    header('location:../vistas/crear_lote.php?error=fallo');return;
  }

?>