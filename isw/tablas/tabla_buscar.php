<?php
        
include('../sesion/validar_sesion.php');

if (isset($_POST['busq']) && !empty($_POST['busq'])){
    
    $buscar = $_POST['busq'];
//    $comparar= '/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü0-9\-_.,\s]*$/';
//    if(!preg_match_all($comparar,$buscar)){
//        header('location:../vistas/busqueda.php?error=simbolerror');return;
//    }

        require('../clases/conexion.php');
            $consulta=("SELECT DISTINCT id_equipo, equipo.perfil_idperfil, id_interno, nombrecontrato, perfil_nombre, nombre_estado,
                        DATE_FORMAT (fecha_recepcion,'%d-%m-%Y') AS fecha_rece, DATE_FORMAT (fecha_inicio_revision,'%d-%m-%Y') AS fecha_revi, nombre_sede
                        FROM contrato
                        INNER JOIN detalle ON contrato.id_contrato = detalle.id_contrato
                        INNER JOIN perfil ON detalle.id_perfil = perfil.id_perfil
                        INNER JOIN equipo ON perfil.id_perfil = equipo.perfil_idperfil
                        INNER JOIN estado_revision ON equipo.Estado_id_estado_revision = estado_revision.id_estado_revision
                        INNER JOIN detalle_entrega ON detalle.id_detalle = detalle_entrega.Detalle_id_detalle
                        INNER JOIN entrega ON detalle_entrega.entrega_identrega = entrega.idEntrega
                        INNER JOIN usuario ON entrega.usuario_id_usuario = usuario.id_usuario
                        INNER JOIN sede ON usuario.Sede_has_Reparticion_Sede_Id_sede = sede.id_sede
                        WHERE contrato.nombrecontrato LIKE '$buscar%'
                        OR equipo.id_interno LIKE '$buscar%'");

        $resultado= mysqli_query($conexion,$consulta);
        $datos=array();
        while($fila=mysqli_fetch_array($resultado)){
                $datos[]=array(
                'id_eq'=>$fila["id_equipo"],
                'id_pe'=>$fila["perfil_idperfil"],
                'id_in'=>$fila["id_interno"],
                'nombre_c'=>$fila["nombrecontrato"],
                'nombre_p'=>$fila["perfil_nombre"],
                'estado'=>$fila["nombre_estado"],
                'f_rece'=>$fila["fecha_rece"],
                'f_rev'=>$fila["fecha_revi"],
                'nombre_s'=>$fila["nombre_sede"],
                );
        }
        // echo $datos;
        $enviar=json_encode($datos);
        print $enviar;
        mysqli_close($conexion);
        // return $resultado;
//}else{

//header('location:../vistas/busqueda.php?error=vacio');return;

}   
?>