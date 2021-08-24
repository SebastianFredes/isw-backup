$(document).ready(function(){

    t_equipo_nuevos =$('#tabla_equipos_nuevos').DataTable({
        "responsive": true,
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": "../tablas/tabla_asignar.php",
            "method": 'POST', 
            //"data":{opcion:opcion}, 
            "dataSrc": ""
        },
        "columns": [

            { "data": "id" },
            { "data": "nombre_c" },
            { "data": "nombre_p"},
            { "data": "estado"},
            { "data": "id_p"},
            { "data": "fecha_re"},
            {
                "defaultContent":
                    " <div class='row justify-content-center'>" +
                    "<div class=' col align-items-center'>" +
                    "<div class='btn-group'>" +
                    "<button type='button' class='btn btn-success btnAsignar' data-toggle='modal'data-target='#modal_asignar_id' data-whatever='@mdo'>Asignar ID</button>" +
                    "<button type='button' class='btn btn-outline-danger btnFaltante' data-toggle='modal'data-target='#modal_faltante' data-whatever='@mdo'>Faltante</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }
        ], "columnDefs": [
            {
                "targets": [2], 
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnPerfil' data-toggle='modal'data-target='#modal_perfil' data-whatever='@mdo'>"+data+"</button>";
                }         

            },
            {
            "targets": [4], 
            "visible": false,
            "searchable": false, 
            },
            {
                "targets": [3], 
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnHistorial' data-toggle='modal'data-target='#modal_historial' data-whatever='@mdo'>"+data+"</button>";
                }    
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

    let dtTable = $('#tabla_equipos_nuevos').DataTable();

    $(document).on('click', '.btnAsignar', function () {
        const id=dtTable.row($(this).closest('tr')).data().id;
        asignar_cargar_id_modal(id);     
    });

    $(document).on('click', '.btnFaltante', function () {
        const id=dtTable.row($(this).closest('tr')).data().id;
        $("#id_bd2").val(id);
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
                        "targets": [0], 
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