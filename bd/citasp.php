<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$id_pros = (isset($_POST['id_pros'])) ? $_POST['id_pros'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';
$concepto = (isset($_POST['concepto'])) ? $_POST['concepto'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$tipop = (isset($_POST['tipop'])) ? $_POST['tipop'] : '';
$responsable = (isset($_POST['responsable'])) ? $_POST['responsable'] : '';

$concepto = ucfirst(strtolower($concepto));
$obs = ucfirst(strtolower($obs));


switch ($opcion) {
        case 1: //alta
                if ($tipop==0){
                        $consulta = "INSERT INTO citap (id_pros,id_px,fecha,concepto,obs,tipo_p,id_per) VALUES('$id_pros','0', '$fecha', '$concepto','$obs','$tipop','$responsable') ";
                }else{
                        $consulta = "INSERT INTO citap (id_pros,id_px,fecha,concepto,obs,tipo_p,id_per) VALUES('0','$id_pros', '$fecha', '$concepto','$obs','$tipop','$responsable') ";
                }
              
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                break;
        case 2:
                $consulta = "UPDATE citap SET id_pros='$id_pros',fecha='$fecha',concepto='$concepto',obs='$obs' WHERE folio_citap='$id' ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                break;


        case 3:
                $consulta = "SELECT * FROM vcitap WHERE id='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
