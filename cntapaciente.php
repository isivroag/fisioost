<?php
$pagina = "paciente";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

$consulta = "SELECT * FROM paciente WHERE estado_px=1 ORDER BY id_px";
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
        <h1 class="card-title mx-auto">Pacientes</h1>
      </div>

      <div class="card-body">

        <div class="row">
          <div class="col-lg-12">
            <button id="btnNuevo" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>
          </div>
        </div>
        <br>
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table name="tablaV" id="tablaV" class="table table-sm table-striped table-bordered table-condensed text-nowrap w-auto mx-auto" style="width:100%">
                  <thead class="text-center bg-gradient-green">
                    <tr>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>GENERO</th>
                      <th>FECHA NAC</th>
                      <th>CURP</th>
                      <th>RFC</th>
                      <th>DIR</th>
                      <th>TEL</th>
                      <th>CORREO</th>
                      <th>WHATSAPP</th>
                      <th>CONTACTO</th>
                      <th>RELACION</th>
                      <th>TELEFONO</th>
                      <th>ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data as $dat) {
                    ?>
                      <tr>
                        <td><?php echo $dat['id_px'] ?></td>
                        <td><?php echo $dat['nom'] ?></td>
                        <td><?php echo $dat['genero'] ?></td>
                        <td><?php echo $dat['fecha_nac'] ?></td>
                        <td><?php echo $dat['curp'] ?></td>
                        <td><?php echo $dat['rfc'] ?></td>
                        <td><?php echo $dat['direccion'] ?></td>
                        <td><?php echo $dat['telefono'] ?></td>
                        <td><?php echo $dat['correo'] ?></td>
                        <td><?php echo $dat['whatsapp'] ?></td>
                        <td><?php echo $dat['contacto'] ?></td>
                        <td><?php echo $dat['relacion'] ?></td>
                        <td><?php echo $dat['tel_contacto'] ?></td>
                        

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


  <section>
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-gradient-green">
            <h5 class="modal-title" id="exampleModalLabel">NUEVO PACIENTE</h5>

          </div>
          <div class="card card-widget" style="margin: 10px;">
            <form id="formDatos" action="" method="POST">
              <div class="modal-body row">


                <div class="col-sm-12">
                  <div class="form-group input-group-sm">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" placeholder="Nombre">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="genero" class="col-form-label">Genero:</label>
                    <input type="text" class="form-control" name="genero" id="genero" autocomplete="off" placeholder="Genero">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="curp" class="col-form-label">CURP:</label>
                    <input type="text" class="form-control" name="curp" id="curp" autocomplete="off" placeholder="CURP">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="rfc" class="col-form-label">RFC:</label>
                    <input type="text" class="form-control" name="rfc" id="rfc" autocomplete="off" placeholder="RFC">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="fechanac" class="col-form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fechanac" id="fechanac" autocomplete="off" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group input-group-sm">
                    <label for="dir" class="col-form-label">Dirección:</label>
                    <textarea rows="2" type="text" class="form-control" name="dir" id="dir" autocomplete="off" placeholder="Dirección"></textarea>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="correo" class="col-form-label">Correo Eléctronico:</label>
                    <input type="text" class="form-control" name="correo" id="correo" autocomplete="off" placeholder="Correo Eléctronico">
                  </div>
                </div>

                

                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="tel" class="col-form-label">Tel:</label>
                    <input type="text" class="form-control" name="tel" id="tel" autocomplete="off" placeholder="Teléfono">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="cel" class="col-form-label">Whasapp:</label>
                    <input type="text" class="form-control" name="cel" id="cel" autocomplete="off" placeholder="Whatsapp">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="contacto" class="col-form-label">Contacto de Emergencia:</label>
                    <input type="text" class="form-control" name="contacto" id="contacto" autocomplete="off" placeholder="Contacto de Emergencia">
                  </div>
                </div>

                

                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="relacion" class="col-form-label">Relación:</label>
                    <input type="text" class="form-control" name="relacion" id="relacion" autocomplete="off" placeholder="Tipo de Relación">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="telcontacto" class="col-form-label">Telefono Contacto:</label>
                    <input type="text" class="form-control" name="telcontacto" id="telcontacto" autocomplete="off" placeholder="Teléfono de Contactos">
                  </div>
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
  <!-- /.content -->
</div>


<?php include_once 'templates/footer.php'; ?>
<script src="fjs/cntapaciente.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>