<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   


$folio = (isset($_POST['folio'])) ? $_POST['folio'] : '';
$motivo = (isset($_POST['motivo'])) ? $_POST['motivo'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';

switch ($tipo) {
    case 1:

        $consulta = "UPDATE registro SET estado_reg=0,fecha_can='$fecha',motivo_can='$motivo',usuario_can='$usuario' WHERE folio_reg='$folio'";
        $resultado = $conexion->prepare($consulta);
        if ($resultado->execute()) {



            $res = 1;
        } else {
            $res = 0;
        }

        break;
    case 2:

        $consulta = "UPDATE pago SET estado_pago=0,fecha_can='$fecha',motivo_can='$motivo',usuario_can='$usuario' WHERE folio_pago='$folio'";
        $resultado = $conexion->prepare($consulta);
        if ($resultado->execute()) {



            
            $consulta = "SELECT * FROM pago WHERE folio_pago='$folio'";
            $resultado = $conexion->prepare($consulta);
            if ($resultado->execute()) {
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                $monto = 0;
                $folioreg = 0;
                foreach ($data as $dat) {

                    $monto = $dat['monto'];
                    $folioreg = $dat['folio_reg'];
                }



                $consulta = "UPDATE registro SET saldo_reg=saldo_reg+'$monto' WHERE folio_reg='$folioreg'";

                $resultado = $conexion->prepare($consulta);

                if ($resultado->execute()) {
                    $res = 1;
                }
            }
        } else {
            $res = 0;
        }

        break;
}





print json_encode($res, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
