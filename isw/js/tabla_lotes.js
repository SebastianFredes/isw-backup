$(document).ready(function(){

    t_lotes =$('#tabla_lotes').DataTable({
        "responsive": true,
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": "../tablas/tabla_lotes.php",
            "method": 'POST', //usamos el metodo POST
            //"data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc": ""
        },
        "columns": [

            { "data": "id_per" },
            { "data": "id_con" },
            { "data": "id_det" },
            { "data": "det_id_det" },
            { "data": "id_en" },
            { "data": "nom_con" },
            { "data": "nom_per"},
            { "data": "cant"},
            { "data": "fecha"},
            { "data": "nom"},
            { "data": "ape"},
            {
                "defaultContent":
                    " <div class='row justify-content-center'>" +
                    "<div class=' col align-items-center'>" +
                    "<div class='btn-group'>" +
                    "<button type='button' class='btn btn-success btnCrear' data-toggle='modal'data-target='#modal_crear_lote' data-whatever='@mdo'>Crear</button>" +
                    //"<button type='button' class='btn btn-outline-danger btnRechazo' data-toggle='modal'data-target='#modal_devolucion' data-whatever='@mdo'>Devolución</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }
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
                "targets": [2],
                "visible": false,
                "searchable": false,
            },
            {
                "targets": [3],
                "visible": false,
                "searchable": false,
            }, 
            {
                "targets": [4],
                "visible": false,
                "searchable": false,
            },
            {
                "targets": [6], //Comma separated values
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnPerfil' data-toggle='modal'data-target='#modal_perfil' data-whatever='@mdo'>"+data+"</button>";
                }         

            },
            {
                "targets": [8], //Comma separated values
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                    let fecha_actual = new Date();
                    fecha_actual.setHours(0,0,0,0);
                    let fecha_data = data;
                    let fecha_tabla = fecha_data.split('-')[2]+"-"+fecha_data.split('-')[1]+"-"+fecha_data.split('-')[0];
                    fecha_tabla = new Date(fecha_tabla);
                    fecha_tabla.setMinutes(fecha_tabla.getMinutes() + fecha_tabla.getTimezoneOffset());
                    
                    if(fecha_actual < fecha_tabla){
                        return "<span style='background-color: #28A745' class='span_m'>"+data+"</span>";
                    }if(fecha_actual > fecha_tabla){
                        return "<span style='background-color: #CD5C5C' class='span_p'>"+data+"</span>";
                    }else{
                        return "<span style='background-color: #DAA520' class='span_h'>"+data+"</span>";
                    }
                    
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

    let dtTable = $('#tabla_lotes').DataTable();

    $(document).on('click', '.btnCrear', function () {
        const contrato=dtTable.row($(this).closest('tr')).data().nom_con;
        const perfil=dtTable.row($(this).closest('tr')).data().nom_per;
        const cantidad=dtTable.row($(this).closest('tr')).data().cant;
        const id_perfil=dtTable.row($(this).closest('tr')).data().id_per;
        const id_contrato=dtTable.row($(this).closest('tr')).data().id_con;
        const id_detalle=dtTable.row($(this).closest('tr')).data().id_det;
        const detalle_id_detalle=dtTable.row($(this).closest('tr')).data().det_id_det;
        const id_entrega=dtTable.row($(this).closest('tr')).data().id_en;
        $("#contrato").val(contrato);
        $("#perfil").val(perfil);
        $("#cantidad").val(cantidad);
        $("#id_perfil").val(id_perfil);
        $("#id_contrato").val(id_contrato);
        $("#id_detalle").val(id_detalle);
        $("#detalle_id_detalle").val(detalle_id_detalle);
        $("#id_entrega").val(id_entrega);
    });

    $(document).on('click', '.btnPerfil', function () {
        const id_p=dtTable.row($(this).closest('tr')).data().id_per;
        const ncon=dtTable.row($(this).closest('tr')).data().nom_con;
        const nper=dtTable.row($(this).closest('tr')).data().nom_per;
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

});