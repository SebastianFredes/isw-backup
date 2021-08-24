<?php
include('../sesion/validar_sesion.php');        

if (isset($_POST['id_p']) && !empty($_POST['id_p'])){

        $id=$_POST['id_p'];

        include('../clases/conexion.php');

        $consulta=("SELECT DISTINCT id_componentes, nombre_componente, tipo_modelo, tipo_descripcion FROM perfil pe
                    INNER JOIN componentes com ON pe.id_perfil = com.perfil_idperfil
                    INNER JOIN tipo_componente tip_com ON com.id_tipo_componente = tip_com.id_tipo_componente
                    WHERE pe.id_perfil = $id ORDER BY nombre_componente");

        $resultado= mysqli_query($conexion,$consulta);
        $datos=array();
        while($fila=mysqli_fetch_array($resultado)){
                $datos[]=array(
                'tipo'=>$fila["nombre_componente"],
                'modelo'=>$fila["tipo_modelo"],
                'desc'=>$fila["tipo_descripcion"],
                );
        }
        // echo $datos;
        $enviar=json_encode($datos);
        print $enviar;
        mysqli_close($conexion);  
        // return $resultado;  
} 
?>