<?php  
 //filter.php  

 include_once 'conexion.php';
 $objeto = new conn();
 $conexion = $objeto->connect();
 
 // Recepción de los datos enviados mediante POST desde el JS   
 
 
 $id = (isset($_POST['id'])) ? $_POST['id'] : '';
 $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
 
 $data=0;
 switch($opcion)
 {
    case 1: //buscar tipo de cita y actualizar
        $consulta = "SELECT * from citap where folio_citap='$id'";			
        $resultado = $conexion->prepare($consulta);
        if ($resultado->execute()){
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            
            $consulta = "UPDATE citap set estado=1 where folio_citap='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

        } 

        
        break;
    
    
 }

 
 
 print json_encode($data, JSON_UNESCAPED_UNICODE);
 $conexion = NULL;  
 ?>