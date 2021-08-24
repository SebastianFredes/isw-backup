<?php
include('../sesion/validar_sesion.php');        

if (isset($_POST['id_c']) && !empty($_POST['id_c']) && is_numeric($_POST['id_c'])){

        $id=$_POST['id_c'];

        include('../clases/conexion.php');

        $consulta=("SELECT nombrecontrato ,SUM(cantidad_total_perfil) AS total, SUM(cantidad_recepcionados) AS recep, SUM(cantidad_listos) AS listos 
                    FROM detalle, contrato
                    WHERE detalle.id_contrato = contrato.id_contrato
                    AND contrato.id_contrato = $id");

        $resultado= mysqli_query($conexion,$consulta);
        $datos=array();
        while($fila=mysqli_fetch_array($resultado)){
                $datos[]=array(
                'con'=>$fila["nombrecontrato"],
                'total'=>$fila["total"],
                'recep'=>$fila["recep"],
                'listos'=>$fila["listos"],
                );
        }
        // echo $datos;
        $enviar=json_encode($datos);
        print $enviar;
        mysqli_close($conexion);  
        // return $resultado;  
} 
?>