$(document).ready(function(){
    let busq = sessionStorage.getItem("buscar");

    t_buscar =$('#tabla_busqueda').DataTable({
        "responsive": true,
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": "../tablas/tabla_buscar.php",
            "method": 'POST', //usamos el metodo POST
            "data":{busq:busq}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_eq" },
            { "data": "id_pe" },
            { "data": "id_in" },
            { "data": "nombre_c" },
            { "data": "nombre_p"},
            { "data": "estado"},
            { "data": "f_rece"},
            { "data": "f_rev"},
            { "data": "nombre_s"},
        ], "columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false,    
            },
            {
                "targets": [1],
                "visible": false,
                "searchable": false,    
            },
            {
                "targets": [4],
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnPerfil' data-toggle='modal'data-target='#modal_perfil' data-whatever='@mdo'>"+data+"</button>";
                }         

            },
            {
                "targets": [5],
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

    let dtTable = $('#tabla_busqueda').DataTable();


    $(document).on('click', '.btnPerfil', function () {
        const id_pe=dtTable.row($(this).closest('tr')).data().id_pe;
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
                    "data":{id_p:id_pe},
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
                    "data":{id_p:id_pe},
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
        const id_eq=dtTable.row($(this).closest('tr')).data().id_eq;
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