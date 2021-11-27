
<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$tipomov = (isset($_POST['tipomov'])) ? $_POST['tipomov'] : '';
$saldo = (isset($_POST['saldo'])) ? $_POST['saldo'] : '';
$montomov = (isset($_POST['montomov'])) ? $_POST['montomov'] : '';
$saldofin = (isset($_POST['saldofin'])) ? $_POST['saldofin'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';

$fechavp = date('Y-m-d');


$res = 0;
$consulta = "SELECT * from cuentaing where id_cuentaing='$id'";
$resultado = $conexion->prepare($consulta);
if ($resultado->execute()) {
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $rowdata) {
        $saldo = $rowdata['saldo_cuentaing'];
    }
    $res += 1;
}
switch ($tipomov) {
    case "Ingreso":
    case "Ajuste Positivo":
        $saldofin = $saldo + $montomov;
        break;

    case "Egreso":
    case "Ajuste Negativo":
        $saldofin = $saldo - $montomov;
        break;
    case "Saldo Inicial":
        $saldofin = $montomov;
        break;
}
//guardar el movimiento
$consulta = "INSERT INTO mov_cuenta(id_cuenta,fecha_movb,tipo_movb,monto,saldoini,saldofin,descripcion) values('$id','$fechavp','$tipomov','$montomov','$saldo','$saldofin','$descripcion')";
$resultado = $conexion->prepare($consulta);
if ($resultado->execute()) {
    $res += 1;
}

$consulta = "UPDATE cuentaing SET saldo_cuentaing='$saldofin' WHERE id_cuentaing='$id'";
$resultado = $conexion->prepare($consulta);
if ($resultado->execute()) {
    $res += 1;
}


print json_encode($res, JSON_UNESCAPED_UNICODE);
$conexion = NULL;

?>