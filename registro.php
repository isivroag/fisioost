<!-- CODIGO PHP-->
<?php
$pagina = "registro";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";


include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();
$tokenid = md5($_SESSION['s_usuario']);
$usuario = $_SESSION['s_nombre'];


if (isset($_GET['folio'])) {
} else {
}

$message = "";




$consultacon = "SELECT * FROM concepto WHERE estado_concepto=1 ORDER BY id_concepto";
$resultadocon = $conexion->prepare($consultacon);
$resultadocon->execute();
$datacon = $resultadocon->fetchAll(PDO::FETCH_ASSOC);



$consultadet = "SELECT * FROM paciente ORDER BY id_px";
$resultadodet = $conexion->prepare($consultadet);
$resultadodet->execute();
$datadet = $resultadodet->fetchAll(PDO::FETCH_ASSOC);




?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="css/estilo.css">
<style>
    .punto {
        height: 20px !important;
        width: 20px !important;

        border-radius: 50% !important;
        display: inline-block !important;
        text-align: center;
        font-size: 15px;
    }

    #div_carga {
        position: absolute;
        /*top: 50%;
    left: 50%;
    */

        width: 100%;
        height: 100%;
        background-color: rgba(60, 60, 60, 0.5);
        display: none;

        justify-content: center;
        align-items: center;
        z-index: 3;
    }

    #cargador {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -25px;
        margin-left: -25px;
    }

    #textoc {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: 120px;
        margin-left: 20px;


    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">


        <!-- Default box -->
        <div class="card">


            <div id="div_carga">

                <img id="cargador" src="img/loader.gif" />
                <span class=" " id="textoc"><strong>Cargando...</strong></span>

            </div>

            <div class="card-header bg-gradient-green text-light">
                <h1 class="card-title mx-auto">Registro de Ingreso</h1>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">


                        <!--<button id="btnNuevo" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>-->
                        <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-success" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                        <!--<button id="btnNuevo" type="button" class="btn bg-gradient-primary btn-ms" data-toggle="modal"><i class="fas fa-envelope-square"></i> Enviar</button>-->
                    </div>
                </div>

                <br>


                <!-- Formulario Datos de Cliente -->
                <form id="formDatos" action="" method="POST">


                    <div class="content">

                        <div class="card card-widget" style="margin-bottom:0px;">

                            <div class="card-header bg-gradient-green " style="margin:0px;padding:8px">
                                <div class="card-tools" style="margin:0px;padding:0px;">

                                    <button id="btnGuardarHead" name="btnGuardarHead" type="button" class="btn bg-success btn-sm">
                                        <i class="far fa-save"></i>
                                    </button>
                                </div>

                                <h1 class="card-title "> Datos del Registro</h1>
                            </div>

                            <div class="card-body" style="margin:0px;padding:1px;">

                                <div class="row justify-content-sm-center">

                                    <div class="col-lg-5">
                                        <div class="input-group input-group-sm">

                                            <input type="hidden" class="form-control" name="registro" id="registro" value="<?php echo $requisicion; ?>">
                                            <input type="hidden" class="form-control" name="tokenid" id="tokenid" value="<?php echo $tokenid; ?>">

                                            <input type="hidden" class="form-control" name="idpx" id="idpx">


                                            <label for="paciente" class="col-form-label">Paciente:</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="paciente" id="paciente" disabled>
                                                <span class="input-group-append">
                                                    <button id="bpaciente" type="button" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                                                </span>
                                            </div>

                                        </div>
                                    </div>




                                    <div class="col-lg-2">
                                        <div class="form-group input-group-sm">
                                            <label for="fecha" class="col-form-label">Fecha:</label>
                                            <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>">
                                        </div>
                                    </div>


                                    <div class="col-lg-1">
                                        <div class="form-group input-group-sm">
                                            <label for="folior" class="col-form-label">Folio:</label>
                                            <input type="hidden" class="form-control" name="folio" id="folio" value="<?php echo $folio; ?>">
                                            <input type="text" class="form-control" name="folior" id="folior" value="<?php echo  "TMP-" . $folio; ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class=" row justify-content-sm-center">
                                    <div class="col-lg-6">
                                        <div class="input-group input-group-sm">

                                            <input type="hidden" class="form-control" name="idconcepto" id="idconcepto">


                                            <label for="concepto" class="col-form-label">Concepto:</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="concepto" id="concepto" disabled>
                                                <span class="input-group-append">
                                                    <button id="bconcepto" type="button" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group input-group-sm">
                                            <label for="precio" class="col-form-label">Precio:</label>
                                            <input type="text" class="form-control" name="precio" id="precio">
                                        </div>
                                    </div>
                                </div>
                                <!-- modificacion Agregar notas a presupuesto-->


                            </div>
                            <!--fin modificacion agregar vendedor a presupuesto -->

                        </div>
                        <!-- Formulario Agrear Item -->


                    </div>

                    <div class="content">
                        <div class="card card-widget ">

                            <div class="card-header bg-gradient-green" style="margin:0px;padding:8px;">

                                <h1 class="card-title" style="text-align:center;">Datos de Pago</h1>

                            </div>

                            <div class="card-body " style="margin:0px;padding:8px;">
                                <div class="row justify-content-sm-center">

                                    <div class="col-lg-2">
                                            <input type="hidden" class="form-control" name="id_umedida" id="id_umedida">
                                        <label for="total" class="col-form-label">Subtotal:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control " name="total" id="total" disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <input type="hidden" class="form-control" name="id_umedida" id="id_umedida">
                                        <label for="total" class="col-form-label">Descuento:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control " name="total" id="total" disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <input type="hidden" class="form-control" name="id_umedida" id="id_umedida">
                                        <label for="total" class="col-form-label">Total:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control " name="total" id="total" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-sm-center">
                                    <div class="col-lg-2">
                                        <input type="hidden" class="form-control" name="id_umedida" id="id_umedida">
                                        <label for="total" class="col-form-label">Monto a Pagar:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control " name="total" id="total" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="hidden" class="form-control" name="id_umedida" id="id_umedida">
                                        <label for="total" class="col-form-label">Pago:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control " name="total" id="total" disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <input type="hidden" class="form-control" name="id_umedida" id="id_umedida">
                                        <label for="total" class="col-form-label">Metodo:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control " name="total" id="total" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="hidden" class="form-control" name="id_umedida" id="id_umedida">
                                        <label for="total" class="col-form-label">Saldo:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control " name="total" id="total" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>


                <!-- /.card-body -->

                <!-- /.card-footer-->
            </div>
        </div>



        <!-- /.card -->

    </section>






    <section>
        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalConcepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-green">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR MATERIAL</h5>

                        </div>
                        <br>
                        <div class="table-hover table-responsive w-auto" style="padding:15px">
                            <table name="tablaCon" id="tablaCon" class="table table-sm text-nowrap table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th>Id</th>
                                        <th>Material</th>
                                        <th>Existencias</th>
                                        <th>U. Medida</th>
                                        <th>Seleccionar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($datacon as $datc) {
                                    ?>
                                        <tr>
                                            <td><?php echo $datc['id_prod'] ?></td>
                                            <td><?php echo $datc['nom_prod'] ?></td>
                                            <td><?php echo $datc['cant_prod'] ?></td>
                                            <td><?php echo $datc['umedida'] ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>


    </section>


</div>

<script>
    //window.addEventListener('beforeunload', function(event)  {

    // event.preventDefault();


    //event.returnValue ="";
    //});
</script>

<?php include_once 'templates/footer.php'; ?>
<script src="fjs/requisicion.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>