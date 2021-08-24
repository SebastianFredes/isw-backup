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
                                    <h2>Equipos listos</h2>
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
                                    if($_GET["error"]=='errorfaltante'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Error al asignar equipo como instalacion de software
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                        <?php
                                    if($_GET["error"]=='errorenvio'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Error inesperado, consulte con el administrador del sistema
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                    <?php                             
                                    if($_GET["error"]=='bdequipo_noexiste'){
                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            ID de equipo no existe o no se encuentra en esta etapa 
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                            }
                        }if (isset($_GET['mensaje'])){
                            if (!empty($_GET["mensaje"])) {
                                if($_GET["mensaje"]=='reintegrado'){
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Equipo devuelto con éxito
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <section id="refresh_table">
                        <table class="table table-responsive-sm table-hover" id="tabla_equipos_listos">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>id</th>
                                    <th>ID institucional</th>
                                    <th>ID contrato</th>
                                    <th>Nombre contrato</th>
                                    <th>Perfil</th>
                                    <th>Estado equipo</th>
                                    <th>ID perfil</th>
                                    <th>Fecha Creación</th>
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

    <!--MODAL EQUIPO PARA REINTEGRAR FALTANTE -->
    <div class="modal fade" id="modal_listos" tabindex="-1" role="dialog" aria-labelledby="modal2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal2">¿Desea devolver este equipo?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../consultas/listos_devolver.php" onsubmit="return validar_reintegrar();" id="form_listos" method="post">
                        <div id="msj_error_falt"></div>
                                <div>
                                    <label for="id_listo" class="col-form-label">Equipo:</label>
                                    <input type="text" name="id_listo" id="id_listo" readonly>
                                </div>
                                <div>
                                    <label for="nombre_con_l" class="col-form-label">Contrato:</label>
                                    <input type="text" name="nombre_con_l" id="nombre_con_l" readonly>        
                                </div>
                                <div>
                                    <label for="nombre_per_l" class="col-form-label">Perfil:</label>
                                    <input type="text" name="nombre_per_l" id="nombre_per_l" readonly>
                                </div>
                                <div class="pb-4 pt-3">
                                    <span>Este equipo volvera a la etapa de <b style="font-weight: bold">Instalacion de software</b></span>
                                    <input type="text" name="id_eq" id="id_eq" readonly style="display: none;">
                                </div>
                                
                            <div class="modal-footer" style="border-top: none">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success" name="reintegrar"
                                    id="reintegrar">Reintegrar</button>
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
                                <label class="col-form-label">Componentes/Periféricos:</label>
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

<!--MODAL EQUIPO HISTORIAL DE ESTADOS -->
<div class="modal fade bd-example" id="modal_historial" tabindex="-1" role="dialog" aria-labelledby="modal4"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal4">Historial de estados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group col" id="det_historial">
                        <div>
                            <label for="num_eq" class="col-form-label">Equipo:</label>
                            <input type="text" name="num_eq" id="num_eq" readonly>        
                        </div>
                        <div>
                            <label for="nombre_con" class="col-form-label">Contrato:</label>
                            <input type="text" name="nom_con" id="nom_con" readonly>        
                        </div>
                        <div>
                            <label for="nombre_per" class="col-form-label">Perfil:</label>
                            <input type="text" name="nom_per" id="nom_per" readonly>
                        </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <table class="table table table-hover" id="tabla_historial">
                                <thead class="thead text-center">
                                    <tr id="t_p_tr">
                                        <th>ID institucional</th>
                                        <th>Nombre estado</th>
                                        <th>Fecha asignación</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center" id="t_p_tb">
                                
                                </tbody>                     
                            </table>
                        </div>
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

    <script type="text/javascript" src="../js/tabla_listos.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>

</body>

</html>