<?php
                           include('../sesion/validar_sesion.php');
                           $sede=$_SESSION['sesionUsuario']['sede'];
                           require("../clases/conexion.php");                           
                           //                  CONSULTA                    //
                           $consulta=("SELECT DISTINCT perfil.id_perfil, contrato.id_contrato, id_detalle, Detalle_id_detalle,entrega_identrega, nombrecontrato, perfil_nombre, cantidad_perfil_llegada,DATE_FORMAT (fecha_entrega,'%d-%m-%Y') AS fecha_entrega, recepcionista_nombre, recepcionista_apellido  
                           FROM detalle, detalle_entrega, entrega, contrato, perfil,usuario,sede_reparticion,sede,reparticion
                           WHERE detalle.id_detalle = detalle_entrega.Detalle_id_detalle
                           AND detalle_entrega.entrega_identrega = entrega.idEntrega
                           AND contrato.id_contrato = detalle.id_contrato
                           AND detalle.id_perfil = perfil.id_perfil
                           AND entrega.usuario_id_usuario = usuario.id_usuario
                           AND usuario.Sede_has_Reparticion_Reparticion_Id_reparticion  = sede_reparticion.sede_id_sede
                           AND sede_reparticion.sede_id_sede = sede.id_sede
                           AND sede_reparticion.sede_id_sede = reparticion.id_reparticion
                           AND sede.nombre_sede = '$sede'
                           AND detalle_entrega.lote_id_lote IS NULL
                           ORDER BY fecha_entrega ASC;");
                           
                           $resultado=mysqli_query($conexion, $consulta);
                           $datos=array();
                               while ($fila=mysqli_fetch_array($resultado)){  
                                    $datos[]=array(
                                        'id_per'=>$fila["id_perfil"],
                                        'id_con'=>$fila["id_contrato"],
                                        'id_det'=>$fila["id_detalle"],
                                        'det_id_det'=>$fila["Detalle_id_detalle"],
                                        'id_en'=>$fila["entrega_identrega"],
                                        'nom_con'=>$fila["nombrecontrato"],
                                        'nom_per'=>$fila["perfil_nombre"],
                                        'cant'=>$fila["cantidad_perfil_llegada"],
                                        'fecha'=>$fila["fecha_entrega"],
                                        'nom'=>$fila["recepcionista_nombre"],
                                        'ape'=>$fila["recepcionista_apellido"],
                                    );
                               }
                             $enviar=json_encode($datos);
                             print $enviar;
                             mysqli_close($conexion);  

?>