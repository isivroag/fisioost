<?php  
 //filter.php  

 include_once 'conexion.php';
 $objeto = new conn();
 $conexion = $objeto->connect();
 
 // Recepción de los datos enviados mediante POST desde el JS   
 

 $banco = (isset($_POST['banco'])) ? $_POST['banco'] : '';

 
 
 $consulta = "SELECT * FROM cuentaing WHERE id_cuentaing='$banco'";
 $resultado = $conexion->prepare($consulta);
 $resultado->execute();
 $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
 $saldo=0;
 foreach($data as $rowdata){
    $saldo=$rowdata['saldo_cuentaing'];

 }
 
 
 print json_encode($saldo, JSON_UNESCAPED_UNICODE);
 $conexion = NULL;  
 ?>