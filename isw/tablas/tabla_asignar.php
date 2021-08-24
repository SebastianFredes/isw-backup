<?php
        require('../clases/conexion.php');
        include('../sesion/validar_sesion.php');

        $sede = $_SESSION['sesionUsuario']['sede'];

        $consulta=("SELECT DISTINCT id_equipo, nombrecontrato, perfil_nombre, nombre_estado, pe.id_perfil, DATE_FORMAT (fecha_recepcion,'%d-%m-%Y') AS fecha_re
                    FROM equipo eq, perfil pe, contrato con, estado_revision es, detalle det, detalle_entrega dete, entrega ent,usuario usr, sede_reparticion sedr, sede se
                    WHERE eq.Estado_id_estado_revision = es.id_estado_revision
                    AND eq.perfil_idperfil = pe.id_perfil
                    AND pe.id_perfil = det.id_perfil
                    AND con.id_contrato = det.id_contrato
                    AND det.id_detalle = dete.Detalle_id_detalle
                    AND dete.entrega_identrega = ent.idEntrega
                    AND ent.usuario_id_usuario = usr.id_usuario
                    AND usr.Sede_has_Reparticion_Reparticion_Id_reparticion = sedr.sede_id_sede
                    AND sedr.sede_id_sede = se.id_sede
                    AND se.nombre_sede = '$sede'
                    AND es.nombre_estado = 'nuevo'
                    ORDER BY con.id_contrato ASC, eq.id_equipo ASC");
        $resultado= mysqli_query($conexion,$consulta);
        $datos=array();
        while($fila=mysqli_fetch_array($resultado)){
                $datos[]=array(
                'id'=>$fila["id_equipo"],
                'nombre_c'=>$fila["nombrecontrato"],
                'nombre_p'=>$fila["perfil_nombre"],
                'estado'=>$fila["nombre_estado"],
                'id_p'=>$fila["id_perfil"],
                'fecha_re'=>$fila["fecha_re"],
                );
        }
        // echo $datos;
        $enviar=json_encode($datos);
        print $enviar;
        mysqli_close($conexion);  
        // return $resultado;   
?>