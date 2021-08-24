$(document).ready(function(){

    t_equipos_sw =$('#tabla_equipos_sw').DataTable({
        "responsive": true,
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": "../tablas/tabla_rev_sw.php",
            "method": 'POST', //usamos el metodo POST
            //"data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc": ""
        },
        "columns": [

            { "data": "id" },
            { "data": "id_interno"},
            { "data": "nombre_contrato" },
            { "data": "nombre_perfil"},
            { "data": "estado"},
            { "data": "id_perfil"},
            { "data": "fecha_in"},
            { "data": "observacion"},
            {
                "defaultContent":
                    " <div class='row justify-content-center'>" +
                    "<div class=' col align-items-center'>" +
                    "<div class='btn-group'>" +
                    "<button type='button' class='btn btn-success btnRevisado' data-toggle='modal' data-target='#modal_revision_sw' data-whatever='@mdo'>Instalado</button>" +
                    "<button type='button' class='btn btn-outline-danger btnDevolucion' data-toggle='modal' data-target='#modal_devolucion_sw' data-whatever='@mdo'>Rechazar</button>" +
                    "<button type='button' class='btn btn-outline-warning btnDevolver' data-toggle='modal'data-target='#modal_devolver_sw' data-whatever='@mdo'>&#8896;</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }
        ], "columnDefs": [
            {
                "targets": [3], //Comma separated values
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnPerfil' data-toggle='modal'data-target='#modal_perfil' data-whatever='@mdo'>"+data+"</button>";
                }         

            },
            {
                "targets": [4], //Comma separated values
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnHistorial' data-toggle='modal'data-target='#modal_historial' data-whatever='@mdo'>"+data+"</button>";
                }    
            },
            {
                "targets": [0], //Comma separated values
                "visible": false,
                "searchable": false, 
            },
            {
                "targets": [5], //Comma separated values
                "visible": false,
                "searchable": false, 
            },       
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

    let dtTable = $('#tabla_equipos_sw').DataTable();

    $(document).on('click', '.btnDevolucion', function () {
        const id_interna=dtTable.row($(this).closest('tr')).data().id_interno;
        const id_perfil=dtTable.row($(this).closest('tr')).data().id_perfil;
        const id=dtTable.row($(this).closest('tr')).data().id;
        const nombre_contrato=dtTable.row($(this).closest('tr')).data().nombre_contrato;
        const nombre_perfil=dtTable.row($(this).closest('tr')).data().nombre_perfil;
        const fecha_llegada=dtTable.row($(this).closest('tr')).data().fecha_in;

        $("#id_interna").val(id_interna);
        $("#contrato").val(nombre_contrato);
        $("#perfil").val(nombre_perfil);
        $("#fecha_llegada").val(fecha_llegada);
        $("#id").val(id);
        $("#id_perfil").val(id_perfil);
    });

    $(document).on('click', '.btnRevisado', function () {
        const id_interna=dtTable.row($(this).closest('tr')).data().id_interno;
        const id=dtTable.row($(this).closest('tr')).data().id;

        $("#id_interna_2").val(id_interna);
        $("#id_2").val(id);
    });

    $(document).on('click', '.btnDevolver', function () {
        const id_interna=dtTable.row($(this).closest('tr')).data().id_interno;
        const id=dtTable.row($(this).closest('tr')).data().id;
        $("#id_interna_4").val(id_interna);
        $("#id_4").val(id);
    });

    $(document).on('click', '.btnPerfil', function () {
        const id_p=dtTable.row($(this).closest('tr')).data().id_perfil;
        const ncon=dtTable.row($(this).closest('tr')).data().nombre_contrato;
        const nper=dtTable.row($(this).closest('tr')).data().nombre_perfil;
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
        const ncon=dtTable.row($(this).closest('tr')).data().nombre_contrato;
        const nper=dtTable.row($(this).closest('tr')).data().nombre_perfil;
        const id_in=dtTable.row($(this).closest('tr')).data().id_interno;
        $("#num_eq").val(id_in);
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