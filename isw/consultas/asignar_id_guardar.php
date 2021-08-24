<?php
include('../sesion/validar_sesion.php');
include('funciones.php');

if (isset($_POST['id_bd']) && isset($_POST['idinterna'])){ //Comprobar que id_bd y idinterna esta definida 
    if(!empty($_POST['id_bd']) && !empty($_POST['idinterna'])){ //Comprobar que id_bd y idinterna no esten vacias 
        
            $id_bd=$_POST['id_bd'];
            $idinterna=$_POST['idinterna'];   
            $observacion=$_POST['observacion'];
            $estado = 3;
            
            $comparar= '/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü0-9\-_.,\s]*$/';
            if(!preg_match_all($comparar,$idinterna) || !preg_match_all($comparar,$observacion)){
                header('location:../vistas/asignar_id.php?error=simbolerror');return;
            }

            date_default_timezone_set('America/Santiago');
            //$fecha_re = date('Y-m-d', strtotime($_POST['fecha_r']));

            $idinterna=trim($idinterna); //elimina espacios de inicio y final
            $observacion=trim($observacion);
            //$idinterna = strtolower($idinterna); //pasa las letras a minusculas
            //$idinterna = strtoupper($idinterna): //pasa las letras a mayusculas
            
                if(!is_numeric($id_bd)){
                    header('location:../vistas/asignar_id.php?error=errorid');return;
                }

                $fecha_ini_rev = date('Y-m-d');
                $fecha_historial = date('Y-m-d H:i:s');  //Se captura fecha actual + hora
                /*Comprobacion de que la fecha se encuentra dentro del rango min y max  **CAMBIAR FECHA ACTUAL POR FECHA DE INICIO DE REV Y FECHA MIN ES FECHA DE RECEPCION**
                $fecha_minima = date('Y-m-d', strtotime("2020-01-01")); //Fecha minima permitida
                if($fecha_minima > $fecha_re){
                    header('location:../vistas/asignar_id.php?error=errorfecha_min');return;
                }else if($fecha_re > $fecha_actual){
                    header('location:../vistas/asignar_id.php?error=errorfecha_max');return;
                }
                */

                $idinterna_php = generar_id($id_bd); //Llama a la funcion para generar id institucional y comparar

                if($idinterna_php != $idinterna){
                    header('location:../vistas/asignar_id.php?error=erroridinterna');return;
                }
                
                if(empty($observacion)){
                    $observacion = "NULL"; //Si observacion esta vacia se le asigna un valor nulo
                }else if(strlen($observacion) > 200){
                    header('location:../vistas/asignar_id.php?error=obslength_err');return;
                }else{
                    $observacion = "'$observacion'"; //Si observacion tiene contenido, guarda la cadena que contiene
                }

                
                include "../clases/conexion.php";
                /*  Verifica si existe un equipo con esa id auto-incremental y que su estado sea nuevo*/ 
                $count_idbdequipo = "SELECT count(id_equipo) as contador FROM equipo eq, estado_revision es
                                     WHERE eq.Estado_id_estado_revision = es.id_estado_revision
                                     AND eq.id_equipo = $id_bd
                                     AND es.nombre_estado = 'nuevo'";
                $consulta = mysqli_query($conexion,$count_idbdequipo);
                $res = mysqli_fetch_assoc($consulta);

                    if($res['contador'] != 1 ){
                        mysqli_close($conexion);
                        header('location:../vistas/asignar_id.php?error=bdequipo_noexiste');return;
                    }

                /*  Verifica si existe un equipo con esa id institucional*/ 
                $count_idinterna = "SELECT count(id_interno) as contador FROM equipo
                                    WHERE id_interno='$idinterna'";
                $consulta= mysqli_query($conexion, $count_idinterna);
                $res = mysqli_fetch_assoc($consulta);

                    if($res['contador']>=1){
                        mysqli_close($conexion);
                        header('location:../vistas/asignar_id.php?error=idyaexiste');return;
                    }else{
                        $asignarid="UPDATE equipo eq 
                                    SET eq.id_interno = '$idinterna',
                                    eq.observacion = $observacion,
                                    eq.Estado_id_estado_revision = $estado,
                                    eq.fecha_inicio_revision = '$fecha_ini_rev'
                                    WHERE eq.id_equipo = $id_bd";

                        if(mysqli_query($conexion, $asignarid)){

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
                            header('location:../vistas/asignar_id.php?mensaje=ingresada');return;
                        }else{
                            mysqli_close($conexion);
                            header('location:../vistas/asignar_id.php?error=errorenvio');return;
                        }
                    }
    }else{
        header('location:../vistas/asignar_id.php?error=idvacia');return;
    }                                                         
} else {
    header('location:../vistas/asignar_id.php?error=idnodefinida');return;
}

?>