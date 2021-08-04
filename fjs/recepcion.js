$(document).ready(function () {
    var id, opcion;
    opcion = 4;

    tablaVis = $("#tablaV").DataTable({



        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><button class='btn btn-sm btn-success  btnAceptar'><i class='fas fa-check-circle'></i></button>\
            <button class='btn btn-sm bg-purple  btnCalendario'><i class='fas fa-edit'></i></button>\
            <button class='btn btn-sm btn-danger btnCancelar'><i class='fas fa-ban'></i></button></div>"
        }, { className: "hide_column", "targets": [1] },
        { className: "hide_column", "targets": [7] },
        { className: "text-center", "targets": [8] },
        { className: "text-center", "targets": [2] }

        ],

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
        },
        rowCallback: function (row, data) {

           

            //estado de la cita
            if (data[8] == 1) {
                icono = '<i class="fas fa-flushed text-info fa-2x text-center"></i>';
                $($(row).find('td')[8]).html(icono)
                //$($(row).find('td')[3]).css('background-color', '#77BCF5');
            }
            else if (data[8] == 2){
                icono = '<i class="fas fa-smile text-success fa-2x text-center"></i>';
                $($(row).find('td')[8]).html(icono)
                //$($(row).find('td')[3]).css('background-color', '#A6EBC5');
            }else{
                icono = '<i class="fas fa-sad-cry text-warning fa-2x text-center"></i>';
                $($(row).find('td')[8]).html(icono)
            }

            $($(row).find('td')[6]).css('background-color', data[7]);
            if (data[2] == 1) {
                icono = '<i class="fas fa-user-injured text-success fa-2x text-center"></i>';
                //$($(row).find("td")[6]).css("background-color", "warning");
                //$($(row).find('td')[2]).addClass('bg-gradient-secondary')
                $($(row).find('td')['2']).html(icono)
            } else if (data[2] == 0) {
                icono = '<i class="fas fa-user-injured text-secondary fa-2x text-center"></i>';
                //$($(row).find("td")[2]).css("background-color", "blue");
                //$($(row).find('td')[2]).addClass('bg-gradient-green')
                $($(row).find('td')['2']).html(icono)
            }
        },


    });


    //BOTON ACEPTAR PACIENTE LLEGO
    $(document).on("click", ".btnAceptar", function () {
        fila = $(this);

        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 1;



        $.ajax({

            url: "bd/buscarcita.php",
            type: "POST",
            dataType: "json",
            async: "false",
            data: { id: id, opcion: opcion },

            success: function (data) {
                console.log(data);

                if (data == 0) {
                    Swal.fire({
                        title: 'Cita No Encontrada',
                        icon: 'error',
                    })
                }
                else {
                    tipo = data[0].tipo_p;
                    id_pros = data[0].id_pros;
                    id_px = data[0].id_px;
                    if (tipo == 1) {
                        Swal.fire({
                            title: 'El Paciente ya se encuentra registrado',
                            icon: 'success',
                        })
                    }
                    else {
                        Swal.fire({
                            title: 'Paciente Nuevo',
                            text: 'Es necesario tomar los datos generales',
                            icon: 'info',
                            timer: 2000,
                        }),
                            $.ajax({
                                url: "bd/buscarprospecto.php",
                                type: "POST",
                                dataType: "json",
                                async: "false",
                                data: { id_pros: id_pros },
                                success: function (prospecto) {
                                    if (prospecto == 0) {
                                        Swal.fire({
                                            title: 'Contacto No Encontrado',
                                            icon: 'error',
                                        })
                                    }
                                    else {
                                        nom_prospecto = prospecto[0].nombre;
                                        tel_prospecto = prospecto[0].tel;
                                        cel_prospecto = prospecto[0].cel;


                                        $("#formDatos").trigger("reset");

                                        $("#nombre").val(nom_prospecto);

                                        $("#id_cita").val(id);
                                        $("#id_pros").val(id_pros);
                                        $("#tel").val(tel_prospecto);
                                        $("#cel").val(cel_prospecto);



                                        $(".modal-title").text("Nuevo Paciente");
                                        $("#modalCRUD").modal("show");

                                    }


                                }

                            })


                    }


                }
            }
        });

    });

    $("#formDatos").submit(function (e) {
        e.preventDefault();
        opcion=4;
        id_pros =  $("#id_pros").val();;
        id_cita =  $("#id_cita").val();;
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
                      relacion: relacion,tel_contacto: tel_contacto, id: id, opcion: opcion, id_pros: id_pros, id_cita: id_cita },
                success: function (data) {
                    Swal.fire({
                        title: "Operación Exitosa",
                        text: "Paciente Registrado",
                        icon: "success",
                        timer:1000,
                    });
                    window.setTimeout(function() {
                        window.location.href = "recepcion.php";
                    }, 1500);
                  
                  
                }
            });
            $("#modalCRUD").modal("hide");
        }
    });

});