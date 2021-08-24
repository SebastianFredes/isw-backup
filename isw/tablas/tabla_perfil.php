<?php
include('../sesion/validar_sesion.php');        

if (isset($_POST['id_p']) && !empty($_POST['id_p']) && is_numeric($_POST['id_p'])){

        $id=$_POST['id_p'];

        include('../clases/conexion.php');

        $consulta=("SELECT marca, nombre_modelo, gabinete, CPU, GPU, fuente, SO, DATE_FORMAT (fecha_perfil,'%d-%m-%Y') AS fecha_pe, varios  
                    FROM perfil
                    WHERE id_perfil = $id");
        $resultado= mysqli_query($conexion,$consulta);
        $datos=array();
        while($fila=mysqli_fetch_array($resultado)){
                $datos[]=array(
                'marca'=>$fila["marca"],
                'nom_mod'=>$fila["nombre_modelo"],
                'gab'=>$fila["gabinete"],
                'cpu'=>$fila["CPU"],
                'gpu'=>$fila["GPU"],
                'psu'=>$fila["fuente"],
                'so'=>$fila["SO"],
                'f_per'=>$fila["fecha_pe"],
                );
        }
        
        // echo $datos;
        $enviar=json_encode($datos);
        print $enviar;
        mysqli_close($conexion);  
        // return $resultado;  
} 
?>