<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   
$nom = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$fecha_nac = (isset($_POST['fechanac'])) ? $_POST['fechanac'] : '';
$genero = (isset($_POST['genero'])) ? $_POST['genero'] : '';
$rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
$curp = (isset($_POST['curp'])) ? $_POST['curp'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$whatsapp = (isset($_POST['whatsapp'])) ? $_POST['whatsapp'] : '';
$contacto = (isset($_POST['contacto'])) ? $_POST['contacto'] : '';
$relacion = (isset($_POST['relacion'])) ? $_POST['relacion'] : '';
$tel_contacto = (isset($_POST['tel_contacto'])) ? $_POST['tel_contacto'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$id_pros = (isset($_POST['id_pros'])) ? $_POST['id_pros'] : '';
$id_cita = (isset($_POST['id_cita'])) ? $_POST['id_cita'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO paciente (nom,genero,fecha_nac,curp,rfc,direccion,telefono,correo,whatsapp,contacto,relacion,tel_contacto) VALUES('$nom','$genero','$fecha_nac','$curp','$rfc','$direccion','$telefono','$correo','$whatsapp','$contacto','$relacion','$tel_contacto') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM paciente ORDER BY id_px DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE paciente SET nom='$nom',genero='$genero',fecha_nac='$fecha_nac',curp='$curp',rfc='$rfc',direccion='$direccion',telefono='$telefono',correo='$correo',whatsapp='$whatsapp',contacto='$contacto',relacion='$relacion',tel_contacto='$tel_contacto' WHERE id_px='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM paciente WHERE id_px='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "UPDATE paciente SET estado_px=0 WHERE id_px='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=1;                          
        break;   
    case 4:
        $consulta = "INSERT INTO paciente (nom,genero,fecha_nac,curp,rfc,direccion,telefono,correo,whatsapp,contacto,relacion,tel_contacto) VALUES('$nom','$genero','$fecha_nac','$curp','$rfc','$direccion','$telefono','$correo','$whatsapp','$contacto','$relacion','$tel_contacto') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id_px FROM paciente ORDER BY id_px DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $idpx=0;
        foreach($data as $row){
            $idpx= $row['id_px'];

        }
        $consulta = "UPDATE citap SET id_px='$idpx',tipo_p='1' WHERE folio_citap='$id_cita'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "UPDATE prospecto SET id_px='$idpx' WHERE id_pros='$id_pros'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=1;

        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
