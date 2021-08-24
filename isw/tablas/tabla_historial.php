<?php
include('../sesion/validar_sesion.php');        

if (isset($_POST['id_eq']) && !empty($_POST['id_eq']) && is_numeric($_POST['id_eq'])){

        $id=$_POST['id_eq'];

        include('../clases/conexion.php');

        $consulta=("SELECT id_interno, nombre_estado, fecha_estado, DATE_FORMAT (fecha_estado,'%d-%m-%Y %T') AS fecha
                    FROM equipo eq, estado_equipo es_eq, estado_revision es_rev
                    WHERE eq.id_equipo = es_eq.id_equipo
                    AND es_eq.id_estado_revision = es_rev.id_estado_revision
                    AND eq.id_equipo = $id 
                    ORDER BY (fecha_estado) DESC");

        $resultado= mysqli_query($conexion,$consulta);
        $datos=array();
        while($fila=mysqli_fetch_array($resultado)){
                $datos[]=array(
                'id_in'=>$fila["id_interno"],
                'nom_es'=>$fila["nombre_estado"],
                'fecha'=>$fila["fecha"],
                );
        }
        // echo $datos;
        $enviar=json_encode($datos);
        print $enviar;
        mysqli_close($conexion);  
        // return $resultado;  
} 
?>