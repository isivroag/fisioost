$(document).ready(function() {
    var id, opcion;
    opcion = 4;

    tablaVis = $("#tablaV").DataTable({



        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><button class='btn btn-sm btn-success  btnAceptar'><i class='fas fa-check-circle'></i></button>\
            <button class='btn btn-sm bg-purple  btnCalendario'><i class='fas fa-edit'></i></button>\
            <button class='btn btn-sm btn-danger btnCancelar'><i class='fas fa-ban'></i></button></div>"
        },{ className: "hide_column", "targets": [1] },
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
         console.log(data[2])

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



});