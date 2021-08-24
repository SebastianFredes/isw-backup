$(document).ready(function(){

    t_equipo_faltantes =$('#tabla_equipos_listos').DataTable({
        "responsive": true,
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": "../tablas/tabla_listos.php",
            "method": 'POST', //usamos el metodo POST
            //"data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc": ""
        },
        "columns": [

            { "data": "id" },
            { "data": "id_in" },
            { "data": "id_con" },
            { "data": "nombre_c" },
            { "data": "nombre_p"},
            { "data": "estado"},
            { "data": "id_p"},
            { "data": "fecha_cre"},
            {
                "defaultContent":
                    " <div class='row justify-content-center'>" +
                    "<div class=' col align-items-center'>" +
                    "<div class='btn-group'>" +
                    "<button type='button' class='btn btn-warning btnDevolver' data-toggle='modal'data-target='#modal_listos' data-whatever='@mdo'>Devolver</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }
        ], "columnDefs": [
            {
                "targets": [4], //Comma separated values
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnPerfil' data-toggle='modal'data-target='#modal_perfil' data-whatever='@mdo'>"+data+"</button>";
                }         

            },
            {
            "targets": [6], //Comma separated values
            "visible": false,
            "searchable": false, 
            },
            {
                "targets": [0], //Comma separated values
                "visible": false,
                "searchable": false, 
            },
            {
                "targets": [2], //Comma separated values
                "visible": false,
                "searchable": false, 
            },
            {
                "targets": [5], //Comma separated values
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnHistorial' data-toggle='modal'data-target='#modal_historial' data-whatever='@mdo'>"+data+"</button>";
                }    
            }        
        ],
        "oLanguage": {
            "sProcessing":     "Procesando...",
            "sLengthMenu": 'Mostrar <select>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">All</option>'+
                '</select> registros',    
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Filtrar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Por favor espere - cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
    }
    });

    let dtTable = $('#tabla_equipos_listos').DataTable();

    $(document).on('click', '.btnDevolver', function () {
        const id=dtTable.row($(this).closest('tr')).data().id;
        const id_in=dtTable.row($(this).closest('tr')).data().id_in;
        const ncon=dtTable.row($(this).closest('tr')).data().nombre_c;
        const nper=dtTable.row($(this).closest('tr')).data().nombre_p;
        $("#id_eq").val(id);
        $("#id_listo").val(id_in);
        $("#nombre_con_l").val(ncon);
        $("#nombre_per_l").val(nper);
    });

    $(document).on('click', '.btnPerfil', function () {
        const id_p=dtTable.row($(this).closest('tr')).data().id_p;
        const ncon=dtTable.row($(this).closest('tr')).data().nombre_c;
        const nper=dtTable.row($(this).closest('tr')).data().nombre_p;
        $("#nombre_con").val(ncon);
        $("#nombre_per").val(nper);

            $('#tabla_perfil').DataTable({
                "paging": false,
                "searching": false,
                "info": false,
                "destroy": true,
                "ajax": {
                    "url": "../tablas/tabla_perfil.php",
                    "method": 'POST',
                    "data":{id_p:id_p},
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "marca" },
                    { "data": "nom_mod" },
                    { "data": "gab"},
                    { "data": "cpu"},
                    { "data": "gpu"},
                    { "data": "psu"},
                    { "data": "so"},
                    { "data": "f_per"},
                ],
            });
            $('#tabla_comp').DataTable({
                "paging": false,
                "searching": false,
                "info": false,
                "destroy": true,
                "ajax": {
                    "url": "../tablas/tabla_perfil_comp.php",
                    "method": 'POST',
                    "data":{id_p:id_p},
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "tipo" },
                    { "data": "modelo" },
                    { "data": "desc"},
                ],"columnDefs": [
                    {
                        "targets": [0], //Comma separated values
                        "data": null,
                        "render": function (data) {
                        return " <label style='font-weight: bold'>"+data+":</label>";
                        }         
        
                    },      
                ],
            });
    });
    $(document).on('click', '.btnHistorial', function () {
        const id_eq=dtTable.row($(this).closest('tr')).data().id;
        const ncon=dtTable.row($(this).closest('tr')).data().nombre_c;
        const nper=dtTable.row($(this).closest('tr')).data().nombre_p;
        $("#num_eq").val(id_eq);
        $("#nom_con").val(ncon);
        $("#nom_per").val(nper);
    
            $('#tabla_historial').DataTable({
                "paging": false,
                "searching": false,
                "info": false,
                "destroy": true,
                "ajax": {
                    "url": "../tablas/tabla_historial.php",
                    "method": 'POST',
                    "data":{id_eq:id_eq},
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "id_in" },
                    { "data": "nom_es" },
                    { "data": "fecha"},
                ],
            });
    });

});