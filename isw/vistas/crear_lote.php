<!-- HEADH ---->
<?php include('../partes/head.php') ?>
<?php include('../sesion/validar_sesion.php') ?>
<!-- FIN HEAD ---->


<!-- FUNCIONES! -->
<link rel="stylesheet" href="../assets/css/normalize.css">
<link rel="stylesheet" href="../assets/css/lotes.css">

</head>
<body>  
    <div class="d-flex" id="content-wrapper">
        <!-- sideBar -->
        <?php include('../partes/sidebar.php') ?>
        <!-- fin sideBar -->
        <div class="w-100">
            <!-- Navbar -->
            <?php include('../partes/nav.php') ?>
            <!-- Fin Navbar -->
            <div>
                <section class="bg-light py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <h1 class="font-weight-bold mb-0">Recepción de equipos en nuevo contrato</h1>
                            </div>

                            <section class="bg-light py-3">
                                <div class="container">
                                    <h2>Crear lotes de equipos</h2>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
                <div class="container" >
                <?php
                             if (isset($_GET['error'])){
                                if(!empty($_GET['error'])){
                                    if($_GET["error"]=='fallo'){
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong></strong> Error al crear lote de equipos
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            </div>
                                        <?php
                                    }
                                    if($_GET["error"]=='error'){
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong></strong> Error envio datos!
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            </div>
                                        <?php
                                    }
                                    if($_GET["error"]=='distinto'){
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong></strong> Cantidad distinta!
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            </div>
                                        <?php
                                    }
                                    if($_GET["error"]=='error_equipo'){
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong></strong> Error al crear equipo
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            </div>
                                        <?php
                                    }
                                }
                            }
                             
                            ?> 
                        <?php
                            if (isset($_GET['mensaje'])){
                            if (!empty($_GET["mensaje"])) {
                                if($_GET["mensaje"]=='mensajeenvio'){
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Lote de equipos creados
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                        <?php
                                }
                            }
                        }
                        ?>
                <section id="refresh_table">
                        <table class="table table-responsive-sm table-hover" id="tabla_lotes">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>id p</th>
                                    <th>id c</th>
                                    <th>id d</th>
                                    <th>id d_d</th>
                                    <th>id d_en</th>
                                    <th>Nombre Contrato</th>
                                    <th>Perfil</th>
                                    <th>Cantidad pendiente</th>
                                    <th>Fecha Entrega</th>
                                    <th>Nombre recepcionista</th>
                                    <th>Apellido</th>
                                    <th>Seleccione</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_crear_lote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Crear lote de equipos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../consultas/crear_lote.php" id="form_lote" method="post" onsubmit="return validar_lote();">
                        <div id=mensaje_error></div>
                            <span id="span_des">Se crearan equipos relacionados a este contrato y perfil</span>
                            <div class="form-group" id="">
                                <label for="contrato" class="col-form-label">Contrato:</label>
                                <input type="text" name="contrato" id="contrato" readonly>
                            </div>
                            <div class="form-group" id="">
                                <label for="perfil" class="col-form-label">Perfil:</label>
                                <input type="text" name="perfil" id="perfil" readonly>
                            </div>
                            <div class="form-group" id="">
                                <label for="cantidad" class="col-form-label">Cantidad:</label>
                                <input type="text" name="cantidad" id="cantidad" readonly>
                            </div>
                            <div style="display: none;">
                                <input type="text" name="id_perfil" id="id_perfil" readonly>
                                <input type="text" name="id_contrato" id="id_contrato" readonly>
                                <input type="text" name="id_detalle" id="id_detalle" readonly>
                                <input type="text" name="detalle_id_detalle" id="detalle_id_detalle" readonly>
                                <input type="text" name="id_entrega" id="id_entrega" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success" name="guardar4"
                                    id="guardar4">Crear</button>
                            </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>


<!--MODAL EQUIPO PERFIL -->
<div class="modal fade bd-example-modal-lg" id="modal_perfil" tabindex="-1" role="dialog" aria-labelledby="modal3"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal3">Detalle perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group col" id="det_perfil">
                        <div>
                            <label for="nombre_con" class="col-form-label">Contrato:</label>
                            <input type="text" name="nombre_con" id="nombre_con" readonly>        
                        </div>
                        <div>
                            <label for="nombre_per" class="col-form-label">Perfil:</label>
                            <input type="text" name="nombre_per" id="nombre_per" readonly>
                        </div>
                        </div>

                            <table class="table table-sm table-hover" id="tabla_perfil">
                                <thead class="thead text-center">
                                    <tr id="t_p_tr">
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Gabinete</th>
                                        <th>CPU</th>
                                        <th>GPU</th>
                                        <th>PSU</th>
                                        <th>SO</th>
                                        <th>Creado</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center" id="t_p_tb">
                                
                                </tbody>                     
                            </table>
                            <div>
                                <label class="col-form-label">Otros componentes/Periféricos:</label>
                            </div>
                            <table class="table table-borderless" id="tabla_comp">
                                <thead class="thead">
                                    <tr id="t_p_tr" style="display: none">
                                        <th>Componente</th>
                                        <th>Modelo</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>

                                <tbody  id="t_p_tb">
                                
                                </tbody>                     
                            </table>


                        <div class="modal-footer" style="border-top: none">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                   </div>
                </div>
        </div>
</div>


 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"
        integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="../js/tabla_lotes.js"></script>
    <script type="text/javascript" src="../js/validar_i.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js">
    </script>

</body>

</html>