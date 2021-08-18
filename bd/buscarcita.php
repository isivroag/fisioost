<?php  
 //filter.php  

 include_once 'conexion.php';
 $objeto = new conn();
 $conexion = $objeto->connect();
 
 // Recepción de los datos enviados mediante POST desde el JS   
 
 
 $id = (isset($_POST['id'])) ? $_POST['id'] : '';
 $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
 date_default_timezone_set('America/Mexico_City');
 $ahora=date("Y-m-d H:i:s");
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
        case 2:
            $consulta = "SELECT * from citap where folio_citap='$id'";			
            $resultado = $conexion->prepare($consulta);
            if ($resultado->execute()){
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                
                $consulta = "UPDATE citap set estado=2 where folio_citap='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
    
            } 
        break;
        case 3:
            $consulta = "SELECT * from citap where folio_citap='$id'";			
            $resultado = $conexion->prepare($consulta);
            if ($resultado->execute()){
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                
                $consulta = "UPDATE citap set estado=3 where folio_citap='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
    
            } 
        break;
        case 4:
            $consulta = "SELECT * from citap where folio_citap='$id'";			
            $resultado = $conexion->prepare($consulta);
            if ($resultado->execute()){
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                
                $consulta = "UPDATE citap set estado=4 where folio_citap='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
    
            } 
        break;
    
    
 }

 
 
 print json_encode($data, JSON_UNESCAPED_UNICODE);
 $conexion = NULL;  
 ?>