<?php
include('../sesion/validar_sesion.php');
function generar_id($id){
    include "../clases/conexion.php";
    $sql=mysqli_query($conexion,"SELECT perfil_nombre, nombrecontrato, DATE_FORMAT (fecha_termino,'%d-%m-%Y') AS fecha_te, id_equipo
                             FROM equipo eq, contrato con, perfil p, ficha_juridica fi
                             WHERE p.id_perfil = eq.perfil_idperfil
                             AND eq.contrato_idcontrato = con.id_contrato
                             AND con.id_ficha_juridica = fi.id_ficha_juridica
                             AND eq.id_equipo = $id");

    $data = mysqli_fetch_assoc($sql);
    mysqli_close($conexion);

    $perfil = $data['perfil_nombre'];
    $perfil = substr($data['perfil_nombre'],0,1);
    $perfil = strtoupper($perfil);
    $perfil = $perfil . substr($data['perfil_nombre'], -1);

    $con = explode("_", $data['nombrecontrato']);
    $con[0] = substr($data['nombrecontrato'], 0,3);
    $con[0] = strtoupper($con[0]);
    $con[0] = $con[0] . $con[1];

    $fecha = explode("-", $data['fecha_te']);
    $fecha[2] = substr($data['fecha_te'], 8,9);
    $fecha[1] = $fecha[1] . $fecha[2];

    $equipo = $data['id_equipo'];

    $sugerencia = $perfil."-".$con[0]."-".$fecha[1]."-".$equipo;
    return $sugerencia;
}
