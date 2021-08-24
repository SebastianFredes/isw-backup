$(document).ready(function(){

    t_vigencia_con =$('#tabla_contratos').DataTable({
        "responsive": true,
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": "../tablas/tabla_vigencia.php",
            "method": 'POST', 
            //"data":{opcion:opcion},
            "dataSrc": ""
        },
        "columns": [

            { "data": "id_c" },
            { "data": "id_p" },
            { "data": "nombre_c"},
            { "data": "nombre_p"},
            { "data": "total"},
            { "data": "recep"},
            { "data": "listos"},
            {
                "defaultContent":
                    " <div class='row justify-content-center'>" +
                    "<div class=' col align-items-center'>" +
                    "<div class='btn-group'>" +
                    "<button type='button' class='btn btn-success btnValidar' data-toggle='modal'data-target='#modal_detalle' data-whatever='@mdo'>Validar</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }
        ], "columnDefs": [
            {
                "targets": [3], 
                "visible": true,
                "searchable": true,
                "data": null,
                "render": function (data) {
                return "<button type='button' class='btn btn-outline-secondary btnPerfil' data-toggle='modal'data-target='#modal_perfil' data-whatever='@mdo'>"+data+"</button>";
                }         

            },
            {
                "targets": [0], 
                "visible": false,
                "searchable": false, 
            },
            {
                "targets": [1], 
                "visible": false,
                "searchable": false,
                "data": null,
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

    let dtTable = $('#tabla_contratos').DataTable();

    $(document).on('click', '.btnPerfil', function () {
        const id_p=dtTable.row($(this).closest('tr')).data().id_p;
        const ncon=dtTable.row($(this).closest('tr')).data().nombre_c;
        const npe=dtTable.row($(this).closest('tr')).data().nombre_p;
        $("#nombre_con").val(ncon);
        $("#nombre_per").val(npe);

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

    
    $(document).on('click', '.btnValidar', function () {
        const id_c=dtTable.row($(this).closest('tr')).data().id_c;
        const ncon=dtTable.row($(this).closest('tr')).data().nombre_c;
        $("#nombre_con_d").val(ncon);
        $("#kcon").val(id_c);
        $.ajax({
    
            url:"../tablas/tabla_detalle_con.php",
            type:"POST",
            data: {id_c: id_c},
            dataType: "json",
        
            success: function(data){
            let totales, recep, listos;
                
            totales = data[0].total;
            recep = data[0].recep;
            listos = data[0].listos;
    
            document.getElementById("total").innerHTML= totales;
            document.getElementById("recep").innerHTML= recep;
            document.getElementById("listos").innerHTML= listos;
            
                if(totales == recep && recep == listos){
                    document.getElementById("val_detalle").innerHTML="<div class='alert alert-success mt-3' role='alert'>Es posible hacer vigente este contrato!</div>";
                    document.getElementById("vigente").disabled = false;
                }else{
                    document.getElementById("val_detalle").innerHTML="<div class='alert alert-warning mt-3' role='alert'>Aún quedan equipos en recepción / revisión</div>";
                    document.getElementById("vigente").disabled = true;
                }
            } 

        });
          
    });
});