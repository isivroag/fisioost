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
                
                $consulta = "UPDATE citap set estado=4,confirmar=3 where folio_citap='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "SELECT id,id_pros,tipo_p,title,descripcion,date(start) as fecha,time(start) as hora,nombre,color,estado,confirmar FROM vcitap2 WHERE id='$id' ORDER BY start";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
            } 
        break;
        case 6:
            $consulta = "SELECT * from citap where folio_citap='$id'";			
            $resultado = $conexion->prepare($consulta);
            if ($resultado->execute()){
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                
                $consulta = "UPDATE citap set confirmar=1,estado=0 where folio_citap='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "SELECT id,id_pros,tipo_p,title,descripcion,date(start) as fecha,time(start) as hora,nombre,color,estado,confirmar FROM vcitap2 WHERE id='$id' ORDER BY start";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
            } 
        break;
        case 7:
            $consulta = "SELECT * from citap where folio_citap='$id'";			
            $resultado = $conexion->prepare($consulta);
            if ($resultado->execute()){
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                
                $consulta = "UPDATE citap set confirmar=2,estado=0 where folio_citap='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

                $consulta = "SELECT id,id_pros,tipo_p,title,descripcion,date(start) as fecha,time(start) as hora,nombre,color,estado,confirmar FROM vcitap2 WHERE id='$id' ORDER BY start";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
            } 
        break;
    
 }

 
 
 print json_encode($data, JSON_UNESCAPED_UNICODE);
 $conexion = NULL;  
 ?>