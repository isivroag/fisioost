$(document).ready(function () {
    var id, opcion;
    opcion = 4;

    tablaVis = $("#tablaV").DataTable({



        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><button class='btn btn-sm btn-primary  btnEditar'><i class='fas fa-edit'></i></button>\
            <button class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div>"
        }, { className: "hide_column", targets: [2] },
        { className: "hide_column", targets: [3] },
        { className: "hide_column", targets: [4] },
        { className: "hide_column", targets: [5] },
        { className: "hide_column", targets: [6] },
        { className: "hide_column", targets: [10] },
        { className: "hide_column", targets: [11] },
        { className: "hide_column", targets: [12] },],

        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });

    $("#btnNuevo").click(function () {

        //window.location.href = "prospecto.php";
        $("#formDatos").trigger("reset");

        $(".modal-title").text("Nuevo Paciente");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());

        //window.location.href = "actprospecto.php?id=" + id;
        nombre = fila.find('td:eq(1)').text();
        genero = fila.find('td:eq(2)').text();
        fechanac = fila.find('td:eq(3)').text();
        curp = fila.find('td:eq(4)').text();
        rfc = fila.find('td:eq(5)').text();
        dir = fila.find('td:eq(6)').text();
        tel = fila.find('td:eq(7)').text();
        correo = fila.find('td:eq(8)').text();
        cel = fila.find('td:eq(9)').text();
        contacto = fila.find('td:eq(10)').text();
        relacion = fila.find('td:eq(11)').text();
        telcontacto = fila.find('td:eq(12)').text();

        $("#nombre").val(nombre);
        $("#genero").val(genero);
        $("#curp").val(curp);
        $("#rfc").val(rfc);
        $("#fechanac").val(fechanac);
        $("#dir").val(dir);
        $("#correo").val(correo);
        $("#tel").val(tel);
        $("#cel").val(cel);
        $("#contacto").val(contacto);
        $("#relacion").val(relacion);
        $("#telcontacto").val(telcontacto);
        opcion = 2; //editar


        $(".modal-title").text("Editar Paciente");
        $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);

        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar

        //agregar codigo de sweatalert2
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");



        if (respuesta) {
            $.ajax({

                url: "bd/crudpx.php",
                type: "POST",
                dataType: "json",
                data: { id: id, opcion: opcion },

                success: function (data) {
                    console.log(fila);

                    tablaVis.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });



    $("#formDatos").submit(function (e) {
        e.preventDefault();
       
        nombre =  $("#nombre").val();;
        genero = $("#genero").val();
        fechanac =  $("#fechanac").val();
        curp = $("#curp").val();
        rfc =   $("#rfc").val();
        direccion =     $("#dir").val();
        telefono = $("#tel").val();
        correo =  $("#correo").val();
        whatsapp = $("#cel").val();
        contacto =  $("#contacto").val();
        relacion =  $("#relacion").val();
        tel_contacto =   $("#telcontacto").val();

      

        if (nombre.length == 0 || cel.length == 0 || fechanac.length == 0 ) {
            Swal.fire({
                title: 'Datos Faltantes',
                text: "Debe ingresar todos los datos del Prospecto",
                icon: 'warning',
            })
            return false;
        } else {
            $.ajax({
                url: "bd/crudpx.php",
                type: "POST",
                dataType: "json",
                data: { nombre: nombre, genero: genero, 
                    fechanac: fechanac, curp: curp,
                     rfc: rfc, direccion: direccion, telefono: telefono,
                      correo: correo, whatsapp: whatsapp, contacto: contacto,
                      relacion: relacion,tel_contacto: tel_contacto, id: id, opcion: opcion },
                success: function (data) {
                    console.log(data);
                    console.log(fila);

                    //tablaPersonas.ajax.reload(null, false);
                    id = data[0].id_px;
                    nombre = data[0].nom;
                    genero = data[0].genero;
                    fechanac =  data[0].fecha_nac;
                    curp = data[0].curp;
                    rfc =   data[0].rfc;
                    dir =     data[0].direccion;
                    tel = data[0].telefono;
                    correo =  data[0].correo;
                    cel = data[0].whatsapp;
                    contacto =data[0].contacto;
                    relacion =  data[0].relacion;
                    telcontacto =   data[0].tel_contacto;
                    if (opcion == 1) {
                        tablaVis.row.add([id, nombre,genero,fechanac,curp,rfc,dir,tel,correo,cel,contacto,relacion,tel_contacto,]).draw();
                    } else {
                        tablaVis.row(fila).data([id, nombre,genero,fechanac,curp,rfc,dir,tel,correo,cel,contacto,relacion,tel_contacto,]).draw();
                    }
                }
            });
            $("#modalCRUD").modal("hide");
        }
    });

});