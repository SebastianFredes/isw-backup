<?php
        require('../clases/conexion.php');
        include('../sesion/validar_sesion.php');

        $sede = $_SESSION['sesionUsuario']['sede'];

        $consulta=("SELECT distinct detalle.id_contrato,detalle.id_perfil ,nombrecontrato, perfil_nombre, cantidad_total_perfil, cantidad_recepcionados, cantidad_listos
                    FROM detalle, contrato, perfil, estado_contrato, estado_cto, detalle_entrega, entrega, usuario, sede
                    WHERE contrato.id_contrato = detalle.id_contrato
                    AND detalle.id_perfil = perfil.id_perfil
                    AND contrato.id_contrato = estado_contrato.id_contrato
                    AND estado_contrato.id_estado_cto = estado_cto.id_estado_cto
                    AND detalle.id_detalle = detalle_entrega.Detalle_id_detalle
                    AND detalle_entrega.entrega_identrega = entrega.idEntrega
                    AND entrega.usuario_id_usuario = usuario.id_usuario
                    AND usuario.Sede_has_Reparticion_Sede_Id_sede = sede.id_sede
                    AND estado_cto.estado_descripcion = 'confirmado'");
        $resultado= mysqli_query($conexion,$consulta);
        $datos=array();
        while($fila=mysqli_fetch_array($resultado)){
                $datos[]=array(
                'id_c'=>$fila["id_contrato"],
                'id_p'=>$fila["id_perfil"],
                'nombre_c'=>$fila["nombrecontrato"],
                'nombre_p'=>$fila["perfil_nombre"],
                'total'=>$fila["cantidad_total_perfil"],
                'recep'=>$fila["cantidad_recepcionados"],
                'listos'=>$fila["cantidad_listos"],
                );
        }
        // echo $datos;
        $enviar=json_encode($datos);
        print $enviar;
        mysqli_close($conexion);  
        // return $resultado;   
?>