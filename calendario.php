<?php
$pagina="calendario";
include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

$consulta = "SELECT * FROM vcitap order by folio_citap";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consultac = "SELECT * FROM prospecto order by id_pros";
$resultadoc = $conexion->prepare($consultac);
$resultadoc->execute();
$datac = $resultadoc->fetchAll(PDO::FETCH_ASSOC);


$consultacx = "SELECT * FROM paciente order by id_px";
$resultadocx = $conexion->prepare($consultacx);
$resultadocx->execute();
$datacx = $resultadocx->fetchAll(PDO::FETCH_ASSOC);

$message = "";



?>
<!-- fullCalendar -->
<link rel="stylesheet" href="plugins/fullcalendar/main.css">
<link rel="stylesheet" href="plugins/fullcalendar-daygrid/main.min.css">
<link rel="stylesheet" href="plugins/fullcalendar-timegrid/main.min.css">
<link rel="stylesheet" href="plugins/fullcalendar-bootstrap/main.css">
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
<!--Datetimepicker Bootstrap -->

<!--
<link rel="stylesheet" href="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
-->
<!--tempusdominus-bootstrap-4 -->
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css">

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
  <section class="card">
    <div class="card-header bg-gradient-green text-light">
      <h2 class="card-title mx-auto">Calendario de Citas</h2>
    </div>
    <div class="card-body">

      <div class="row">
        <div class="col-lg-12">
          
          <button id="btnNuevo" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>
          <button id="btnNuevox" type="button" class="btn bg-gradient-info btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Paciente</span></button>
        </div>
      </div>
      <br>
      <div class="row">

        <!-- /.col -->
        <div class="col-md-8 mx-auto">
          <div class="card card-primary">

            <div class="card-body p-0">

            <div id="div_carga">

                <img id="cargador" src="img/loader.gif" />
                <span class=" " id="textoc"><strong>Cargando...</strong></span>

              </div>
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>


<!-- CITAS DE PROSPECTOS-->

  <section>
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-gradient-green">
            <h5 class="modal-title" id="exampleModalLabel">Agendar Cita Contacto</h5>

          </div>
          <form id="formDatos" action="" method="POST">
            <div class="modal-body row">


            <div class="col-sm-12">
              <div class="form-group">
              <input type="hidden" class="form-control" name="tipop" id="tipop" value="0">
              <input type="hidden" class="form-control" name="folio" id="folio">
                <input type="hidden" class="form-control" name="id_pros" id="id_pros">
                <label for="nombre" class="col-form-label">Contacto:</label>

                <div class="input-group">

                  <input type="text" class="form-control" name="nom_pros" id="nom_pros" autocomplete="off" placeholder="Contacto">
                  <span class="input-group-append">
                    <button id="bcliente" type="button" class="btn btn-primary "><i class="fas fa-search"></i></button>
                  </span>
                </div>
              </div>
            </div>

     

              <div class="col-sm-8">
                <div class="form-group">
                  <label for="concepto" class="col-form-label">Concepto Cita</label>
                  <input type="text" class="form-control" name="concepto" id="concepto" autocomplete="off" placeholder="Concepto de Cita">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="fecha" class="col-form-label">Fecha Y Hora:</label>

                  <div class="input-group date" id="datetimepicker1" data-date-format="YYYY-MM-DD HH:mm:00" data-target-input="nearest">
                    <input type="text" id="fecha" name="fecha" class="form-control datetimepicker-input " data-target="#datetimepicker1" autocomplete="off" placeholder="Fecha y Hora">
                    <div class="input-group-append " data-target="#datetimepicker1" data-toggle="datetimepicker">
                      <div class="input-group-text btn-primary"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  <!--
                  <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd HH:ii:00" data-link-field="dtp_input1">
                        <input class="form-control" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input1" value="" /><br/>
                    -->
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label for="obs" class="col-form-label">Observaciones:</label>
                  <textarea class="form-control" name="obs" id="obs" rows="3" autocomplete="off" placeholder="Observaciones"></textarea>
                </div>
              </div>




            </div>


            <?php
            if ($message != "") {
            ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="badge "><?php echo ($message); ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>

              </div>

            <?php
            }
            ?>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
              <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-success" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">

      <!-- Default box -->
      <div class="modal fade" id="modalProspecto" tabindex="-7" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl " role="document">
          <div class="modal-content w-auto">
            <div class="modal-header bg-gradient-green">
              <h5 class="modal-title" id="exampleModalLabel">BUSCAR CONTACTO</h5>

            </div>
            <br>
            <div class="table-hover table-responsive w-auto" style="padding:15px">
              <table name="tablaC" id="tablaC" class="table  table-sm table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-center">
                  <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($datac as $datc) {
                  ?>
                    <tr>
                      <td><?php echo $datc['id_pros'] ?></td>
                      <td><?php echo $datc['nombre'] ?></td>
                      <td><?php echo $datc['tel'] ?></td>
                      <td><?php echo $datc['cel'] ?></td>

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
        <!-- /.card-body -->

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </div>
  </section>


  <!-- CITA DE PACIENTES -->

  <section>
    <div class="modal fade" id="modalpx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-gradient-info">
            <h5 class="modal-title" id="exampleModalLabel">Agendar Cita Pacientes</h5>

          </div>
          <form id="formDatospx" action="" method="POST">
            <div class="modal-body row">


            <div class="col-sm-12">
              <div class="form-group">
              <input type="hidden" class="form-control" name="tipopx" id="tipopx" value="1">
              <input type="hidden" class="form-control" name="foliox" id="foliox">
                <input type="hidden" class="form-control" name="id_prosx" id="id_prosx">
                <label for="nombrex" class="col-form-label">Paciente:</label>

                <div class="input-group">

                  <input type="text" class="form-control" name="nom_prosx" id="nom_prosx" autocomplete="off" placeholder="Paciente">
                  <span class="input-group-append">
                    <button id="bclientex" type="button" class="btn btn-primary "><i class="fas fa-search"></i></button>
                  </span>
                </div>
              </div>
            </div>

     

              <div class="col-sm-8">
                <div class="form-group">
                  <label for="conceptox" class="col-form-label">Concepto Cita</label>
                  <input type="text" class="form-control" name="conceptox" id="conceptox" autocomplete="off" placeholder="Concepto de Cita">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="fechax" class="col-form-label">Fecha Y Hora:</label>

                  <div class="input-group date" id="datetimepicker1x" data-date-format="YYYY-MM-DD HH:mm:00" data-target-input="nearest">
                    <input type="text" id="fechax" name="fechax" class="form-control datetimepicker-input " data-target="#datetimepicker1x" autocomplete="off" placeholder="Fecha y Hora">
                    <div class="input-group-append " data-target="#datetimepicker1x" data-toggle="datetimepicker">
                      <div class="input-group-text btn-primary"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  <!--
                  <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd HH:ii:00" data-link-field="dtp_input1">
                        <input class="form-control" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input1" value="" /><br/>
                    -->
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label for="obsx" class="col-form-label">Observaciones:</label>
                  <textarea class="form-control" name="obsx" id="obsx" rows="3" autocomplete="off" placeholder="Observaciones"></textarea>
                </div>
              </div>




            </div>


            <?php
            if ($message != "") {
            ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="badge "><?php echo ($message); ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>

              </div>

            <?php
            }
            ?>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
              <button type="submit" id="btnGuardarx" name="btnGuardarx" class="btn btn-success" value="btnGuardarx"><i class="far fa-save"></i> Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">

      <!-- Default box -->
      <div class="modal fade" id="modalProspectox" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl " role="document">
          <div class="modal-content w-auto">
            <div class="modal-header bg-gradient-info">
              <h5 class="modal-title" id="exampleModalLabel">BUSCAR PACIENTE</h5>

            </div>
            <br>
            <div class="table-hover table-responsive w-auto" style="padding:15px">
              <table name="tablaCx" id="tablaCx" class="table  table-sm table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-center bg-gradient-info">
                  <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($datacx as $datcx) {
                  ?>
                    <tr>
                      <td><?php echo $datcx['id_px'] ?></td>
                      <td><?php echo $datcx['nom'] ?></td>
                      <td><?php echo $datcx['telefono'] ?></td>
                      <td><?php echo $datcx['whatsapp'] ?></td>

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
        <!-- /.card-body -->

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </div>
  </section>
</div>



<?php include_once 'templates/footer.php'; ?>
<script src="fjs/citap.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- jQuery UI -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/fullcalendar/main.min.js"></script>
<script src='plugins/fullcalendar/locales-all.js'></script>
<script src='plugins/fullcalendar/locales/es.js'></script>
<script src="plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="plugins/fullcalendar-interaction/main.min.js"></script>
<script src="plugins/fullcalendar-bootstrap/main.js"></script>


<!--Datetimepicker Bootstrap -->
<!--
<script src="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script src="plugins/bootstrap-datetimepicker/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
-->
<!--tempusdominus-bootstrap-4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/locale/es.js"></script>