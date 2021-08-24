<!-- head -->
<?php include('../sesion/validar_sesion.php') ?>
<?php include('../partes/head.php')?>

<script type="text/javascript" src="../js/funciones_s.js"></script>

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
                                    <h2>Asignar ID institucional</h2>
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
                                    if($_GET["error"]=='errorid'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            ID equipo no es un número
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                        <?php
                                    if($_GET["error"]=='erroridinterna'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Conflicto con la ID institucional generada
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                        <?php
                                    if($_GET["error"]=='simbolerror'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            ¡Error! Simbolos ingresados no permitos
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
                                    if($_GET["error"]=='idyaexiste'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            ID institucional ingresada ya existe 
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
                                    if(($_GET["error"]=='idvacia') || ($_GET["error"]=='idnodefinida')){
                                    ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            Debe ingresar una ID institucional antes de guardar
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(($_GET["error"]=='obslength_err')){
                                    ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            Observación excede el limite de caracteres (200)
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if($_GET["error"]=='errorfaltante'){
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Error al asignar equipo como faltante
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                            }
                        }if (isset($_GET['mensaje'])){
                            if (!empty($_GET["mensaje"])) {
                                if($_GET["mensaje"]=='ingresada'){
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ID institucional asignada con éxito
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                        <?php
                                }if($_GET["mensaje"]=='ingresado_F'){
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Equipo asignado como faltante con éxito
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <section id="refresh_table">
                        <table class="table table-responsive-sm table-hover" id="tabla_equipos_nuevos">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>ID equipo</th>
                                    <th>Nombre contrato</th>
                                    <th>Perfil</th>
                                    <th>Estado equipo</th>
                                    <th>ID perfil</th>
                                    <th>Fecha recepción</th>
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


    <!--MODAL DE ASIGNAR ID -->
    <div class="modal fade" id="modal_asignar_id" tabindex="-1" role="dialog" aria-labelledby="modal1" data-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal1">Asignar ID interna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../consultas/asignar_id_guardar.php" onsubmit="return validar_asignar();" id="form_asignar" method="post">
                    <div id="msj_error"></div>
                        <div class="form-group" id="id_equipo">
                            <label for="id_bd" class="col-form-label">Equipo:</label>
                            <input type="text" name="id_bd" id="id_bd" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="idinterna" class="col-form-label">ID institucional:</label>
                            <input type="text" class="form-control" name="idinterna" id="idinterna" readonly required>  
                            <label for="idinterna" class="col-form-label"><small><b>Formato:</b> Perfil-Contrato-Fecha termino ficha juridica-equipo</small></label>
                        </div>
                        <div class="form-group">
                            <label for="observacion" class="col-form-label">Observación <small><b>(opcional)</b></small>:</label>
                            <textarea rows="4" class="form-control" name="observacion" id="observacion" maxlength="200"></textarea>  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="limpiar();">Cerrar</button>
                            <button type="submit" class="btn btn-success" name="guardar" id="guardar">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL EQUIPO FALTANTE -->
    <div class="modal fade" id="modal_faltante" tabindex="-1" role="dialog" aria-labelledby="modal2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal2">Asignar equipo como faltante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../consultas/asignar_faltante.php" onsubmit="return validar_faltante();" id="form_faltante" method="post">
                    <div id="msj_error2"></div>
                        <div class="form-group" id="id_equipo2">
                            <label for="id_bd2" class="col-form-label">Equipo:</label>
                            <input type="text" name="id_bd2" id="id_bd2" readonly required>
                        </div>
                        <div class="form-group">
                        <span>A este equipo se le asignará el estado <b style="font-weight: bold">faltante ¿Estás seguro?</b> </span>
                        </div>
                        <div class="modal-footer" style="border-top: none">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" name="guardar2"
                                id="guardar2">Aceptar</button>
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

<!--MODAL EQUIPO HISTORIAL DE ESTADOS -->
<div class="modal fade bd-example" id="modal_historial" tabindex="-1" role="dialog" aria-labelledby="modal4"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal3">Historial de estados</h5>
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

    <script type="text/javascript" src="../js/tabla_asig_id.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>

</body>

</html>