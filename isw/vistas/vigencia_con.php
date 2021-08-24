<!-- head -->
<?php include('../sesion/validar_sesion.php') ?>
<?php include('../partes/head.php')?>


<script type="text/javascript" src="../js/desactivador_s.js"></script>
<link rel="stylesheet" href="../assets/css/normalize.css">
<link rel="stylesheet" href="../assets/css/asignar_id.css">
</head>
<!-- fin del head -->

<body>
    <div class="d-flex" id="content-wrapper">
        <!-- sideBar -->
        <?php include('../partes/sidebar.php') ?>
        <!-- fin sideBar -->
        <div class="w-100">

            <!-- Navbar -->
            <?php include('../partes/nav.php') ?>
            <!-- Fin Navbar -->

            <!-- Page Content -->
            <div id="content" class="bg-light w-100">

                <section class="bg-light py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <h1 class="font-weight-bold mb-0">Recepción de equipos en nuevo contrato</h1>
                            </div>

                            <section class="bg-light py-3">
                                <div class="container">
                                    <h2>Validar contratos confirmados</h2>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>


                <div class="container">
                    <div>
                        <?php
                        if (isset($_GET['error'])){
                            if(!empty($_GET['error'])){
                                ?>
                                    <?php
                                    if($_GET["error"]=='errorvigencia'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Fallo el envío de datos
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                        <?php
                                    if($_GET["error"]=='tt_diff'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Cantidad de equipos totales y en entrega no cuadran
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                        <?php
                                    if($_GET["error"]=='faltan'){
                                    ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            Aún quedan equipos en recepción / revisión
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                    <?php
                                    if($_GET["error"]=='err'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Error inesperado, consulte con el administrador del sistema 
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                    ?>
                        <?php
                            }
                        }if (isset($_GET['mensaje'])){
                            if (!empty($_GET["mensaje"])) {
                                if($_GET["mensaje"]=='vigente'){
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Acción realizada con éxito!
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <section id="refresh_table">
                        <table class="table table-responsive-sm table-hover" id="tabla_contratos">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>id_c</th>
                                    <th>id_p</th>
                                    <th>Contrato</th>
                                    <th>Perfil</th>
                                    <th>C. Total</th>
                                    <th>C. Recepcionados</th>
                                    <th>C. Listos</th>
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


    <!--MODAL DE DETALLE-->
    <div class="modal fade bd-example" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="modal3"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Total de equipos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group col" id="det_con">
                        
                <form action="../consultas/vigencia_con.php" onsubmit="return validar_vigencia();" id="form_vigencia" method="post">
                        <div class="row">                        
                            <label for="nombre_con_d" class="col-form-label">Contrato:</label>
                            <input type="text" name="nombre_con_d" id="nombre_con_d" readonly>
                            <input type="text" name="kcon" id="kcon" readonly required>        
                        </div>
                        <div id="val_detalle"></div>
                        </div>
                        
                            <div class="container d-flex justify-content-center mt-4">
                                <div class="row">
                                    <div class="d-flex flex-column">
                                        <label class="d-flex justify-content-center font-weight-bold">Totales</label>
                                        <button type="button" class="btn btn-primary btn-lg shadow-none" id="total"></button>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <label class="d-flex justify-content-center font-weight-bold">Recepcionados</label>
                                        <button type="button" class="btn btn-primary btn-lg shadow-none" id="recep"></button>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <label class="d-flex justify-content-center font-weight-bold">Listos</label>
                                        <button type="button" class="btn btn-primary btn-lg shadow-none" id="listos"></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer" style="border-top: none">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" name="vigente" id="vigente">Entrar en vigencia</button>
                        </div>
                </from>
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
        integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../js/tabla_vigencia_con.js"></script>
</body>

</html>