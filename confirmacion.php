<?php
$pagina = "confirmar";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();
$hoy = date('Y-m-d');
$consulta = "SELECT id,id_pros,tipo_p,title,descripcion,date(start) as fecha,time(start) as hora,nombre,color,estado,confirmar FROM vcitap2 WHERE date(start)='$hoy' ORDER BY start";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$message = "";



?>



<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header bg-gradient-green text-light">
                <h1 class="card-title mx-auto">Contacto</h1>
            </div>

            <div class="card-body">

                <div class="card">
                    <div class="card-header bg-gradient-green">
                       Fecha
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-2">
                                <div class="form-group input-group-sm">
                                    <label for="fechad" class="col-form-label">Fecha de Consulta:</label>
                                    <input type="date" class="form-control" name="fechad" id="fechad" value="<?php echo $hoy?>">
                                </div>
                            </div>

                           

                            <div class="col-lg-1 align-self-end text-center">
                                <div class="form-group input-group-sm">
                                    <button id="btnBuscar" name="btnBuscar" type="button" class="btn bg-gradient-success btn-ms"><i class="fas fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- 
                <div class="row">
                    <div class="col-lg-12">
                        <button id="btnNuevo" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>
                    </div>
                </div>
                -->
                <br>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table name="tablaV" id="tablaV" class="table table-sm  table-hover table-bordered table-condensed text-nowrap w-auto mx-auto" style="width:100%">
                                    <thead class="text-center bg-gradient-green">
                                        <tr>
                                            <th>Folio</th>
                                            <th>ID</th>
                                            <th>Tipo</th>
                                            <th>Nombre</th>
                                            <th>Motivo de Consulta</th>
                                            <th>Hora</th>
                                            <th>Responsable</th>
                                            <th>Color</th>
                                            <th>Estado</th>
                                            <th>Confirmación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $dat) {

                                        ?>
                                            <tr>
                                                <td><?php echo $dat['id'] ?></td>
                                                <td><?php echo $dat['id_pros'] ?></td>
                                                <td><?php echo $dat['tipo_p'] ?></td>
                                                <td><?php echo $dat['title'] ?></td>
                                                <td><?php echo $dat['descripcion'] ?></td>
                                                <td><?php echo $dat['hora'] ?></td>
                                                <td><?php echo $dat['nombre'] ?></td>
                                                <td><?php echo $dat['color'] ?></td>
                                                <td><?php echo $dat['estado'] ?></td>
                                                <td><?php echo $dat['confirmar'] ?></td>
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
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>



    <!-- /.content -->
</div>


<?php include_once 'templates/footer.php'; ?>
<script src="fjs/confirmacion.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>