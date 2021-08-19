$(document).ready(function() {


    $.ajaxSetup({
        cache: false,
    });

    jQuery.ajaxSetup({
        beforeSend: function() {
            $("#div_carga").show();
        },
        complete: function() {
            $("#div_carga").hide();
        },
        success: function() {},
    });

    $.ajax({
        url: 'bd/dbeventosp.php',
        type: 'POST',
        async: false,

        success: function(data) {
            obj = JSON.stringify(data);
        },
        error: function(xhr, err) {
            alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
            alert("responseText: " + xhr.responseText);
        }
    });

    $("#datetimepicker1").datetimepicker({
        locale: "es",
    });

    $("#datetimepicker1x").datetimepicker({
        locale: "es",
    });

    var opcion;
    var calendar;
    var date = new Date();
    calendario();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();

    function calendario() {
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById("calendar");

        calendar = new Calendar(calendarEl, {
            plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
            header: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },

            themeSystem: "bootstrap",
            locale: "es",
            cache: false,
            lazyFetching: true,
            //Random default events

            events: JSON.parse(obj),
            /*events: function(start, end, timezone, callback) {
                jQuery.ajax({
                    url: 'bd/dbeventosv.php',
                    type: 'POST',
                    dataType: 'json',

                    success: function(doc) {
                        var events = [];
                        if (!!doc.result) {
                            $.map(doc.result, function(r) {
                                events.push({
                                    id: r.id,
                                    title: r.title,
                                    start: r.date_start,
                                    end: r.date_end
                                });
                            });
                        }

                    }
                });
            },*/

            eventClick: function(calEvent) {
                var id = calEvent.event.id;
                opcion = 2;

                $.ajax({
                    url: "bd/citasp.php",
                    type: "POST",
                    dataType: "json",
                    data: { id: id, opcion: 3 },
                    success: function(data) {
                        $("#folio").val(data[0].id);
                        $("#id_pros").val(data[0].id_pros);
                        $("#nom_pros").val(data[0].title);
                        $("#concepto").val(data[0].descripcion);
                        $("#fecha").val(data[0].start);
                        $("#obs").val(data[0].obs);

                        $("#modalCRUD").modal("show");
                    },
                });
            },

            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
        });

        calendar.render();

    }



    tablaC = $("#tablaC").DataTable({



        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelCliente'><i class='fas fa-hand-pointer'></i></button></div></div>"
        }],

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

    tablaC = $("#tablaCx").DataTable({



        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelClientex'><i class='fas fa-hand-pointer'></i></button></div></div>"
        }],

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



    $(document).on("click", "#bcliente", function() {

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");

        $("#modalProspecto").modal("show");

    });
    $(document).on("click", "#bclientex", function() {

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");

        $("#modalProspectox").modal("show");

    });


    $(document).on("click", "#btnNuevo", function() {

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        opcion = 1;
        $("#modalCRUD").modal("show");

    });

    $(document).on("click", "#btnNuevox", function() {

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        opcion = 1;
        $("#modalpx").modal("show");

    });

    $(document).on("click", ".btnSelCliente", function() {
        fila = $(this).closest("tr");

        IdCliente = fila.find('td:eq(0)').text();
        NomCliente = fila.find('td:eq(1)').text();


        $("#id_pros").val(IdCliente);
        $("#nom_pros").val(NomCliente);
        $("#modalProspecto").modal("hide");

    });


    $(document).on("click", ".btnSelClientex", function() {
        fila = $(this).closest("tr");

        IdClientex = fila.find('td:eq(0)').text();
        NomClientex = fila.find('td:eq(1)').text();


        $("#id_prosx").val(IdClientex);
        $("#nom_prosx").val(NomClientex);
        $("#modalProspectox").modal("hide");

    });


    $(document).on("click", "#btnGuardar", function() {

        var id_pros = $.trim($("#id_pros").val());
        var nombre = $.trim($("#nom_pros").val());
        var concepto = $.trim($("#concepto").val());
        var fecha = $.trim($("#fecha").val());
        var obs = $.trim($("#obs").val());
        var id = $.trim($("#folio").val());
        var tipop = $.trim($("#tipop").val());
        var responsable = $.trim($("#responsable").val());
        console.log(tipop);


        $.ajax({
            url: "bd/citasp.php",
            type: "POST",
            dataType: "json",
            async:"false",
            data: { nombre: nombre, id_pros: id_pros, fecha: fecha, obs: obs,tipop: tipop, concepto: concepto, id: id, opcion: opcion, responsable: responsable },
            success: function(data) {
                if (data==1){
                    console.log(data);
                    Swal.fire({
                        title: "Operación Exitosa",
                        text: "Cita Guardada",
                        icon: "success",
                        timer:1000,
                    });
                    window.setTimeout(function() {
                        location.reload();
                    }, 1500);
                   
                }else{
                    Swal.fire({
                        title: 'No es posible Agendar la Cita',
                        icon: 'warning',
                    })
                }
               

            }
        });
        $("#modalCRUD").modal("hide");
    });

    $(document).on("click", "#btnGuardarx", function() {

        var id_pros = $.trim($("#id_prosx").val());
        var nombre = $.trim($("#nom_prosx").val());
        var concepto = $.trim($("#conceptox").val());
        var fecha = $.trim($("#fechax").val());
        var obs = $.trim($("#obsx").val());
        var id = $.trim($("#foliox").val());
        var tipop = $.trim($("#tipopx").val());
        var responsable = $.trim($("#responsablex").val());



        $.ajax({
            url: "bd/citasp.php",
            type: "POST",
            dataType: "json",
            data: { nombre: nombre, id_pros: id_pros, fecha: fecha, obs: obs,tipop: tipop, concepto: concepto, id: id, opcion: opcion,responsable: responsable },
            success: function(data) {
                if (data==1){
                    console.log(data);
                    Swal.fire({
                        title: "Operación Exitosa",
                        text: "Cita Guardada",
                        icon: "success",
                        timer:1000,
                    });
                    window.setTimeout(function() {
                        location.reload();
                    }, 1500);
                   
                }else{
                    Swal.fire({
                        title: 'No es posible Agendar la Cita',
                        icon: 'warning',
                    })
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });




});