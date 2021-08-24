<!-- HEAD ---->
<?php include('../partes/head.php') ?>
<?php include('../sesion/validar_sesion.php') ?>
<!-- FIN HEAD ---->


<!-- FUNCIONES! -->
<script type="text/javascript" src="../js/funciones_j.js"></script>
<script type="text/javascript" src="../js/validaciones_j.js"></script>
<link rel="stylesheet" href="../assets/css/normalize.css">
<link rel="stylesheet" href="../assets/css/style_j.css">

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
                                    <h2>Equipos pendientes de instalación de Software</h2>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>

                <div class="container">

                    <div>
                        <!-- VALIDACIONES!! -->
                        <?php
                             if (isset($_GET['error'])){
                                if(!empty($_GET['error'])){
                                    if($_GET["error"]=='errorenvio'){
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong></strong> Error al enviar devolución
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            </div>
                                        <?php
                                    }
                                    if($_GET["error"] == 'vacio'){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong></strong> Debe ingresar un motivo de devolución
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        <?php   

                                    }
                                    if($_GET["error"] == 'idvacia'){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong></strong> Error inesperado, consulte con el administrador del sistema
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        <?php   

                                    }
                                    if($_GET["error"] == 'idnodefinida'){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong></strong> Error inesperado, consulte con el administrador del sistema
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        <?php   

                                    }
                                    if($_GET["error"] == 'rechazo'){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong></strong> Motivo de devolución no puede superar 200 caracteres
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        <?php   

                                    }
                                    if($_GET["error"] == 'simbolos'){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong></strong> No se debe ingresar simbologia!
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        </div>
                                        <?php   

                                    }
                                    if($_GET["error"] == 'noexiste'){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong></strong> Equipo no existe!
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
                                if($_GET["mensaje"]=='ingresado'){
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Equipo revisado!
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                        <?php
                                }
                                if($_GET["mensaje"]=='devolucion'){
                                    ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                Equipo enviado a devolucion!
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            </div>
                                    <?php
                                    }
                            }
                        }
                        ?>
                    </div>

                    <section id="refresh_table">
                        <table class="table table-responsive-sm table-hover" id="tabla_equipos_sw">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>id</th>
                                    <th>ID institucional</th>
                                    <th>Contrato</th>
                                    <th>Perfil</th>
                                    <th>Estado</th>
                                    <th>id perfil</th>
                                    <th>Inicio revisión</th>
                                    <th>Observación</th>
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

    <!-- MODAL EQUIPO CON SOFTWARE LISTO -->

    <div class="modal fade" id="modal_revision_sw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Revision de Software</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../consultas/sw_revisado.php" id="form_revisado" method="post">
                        <div id=mensaje_error></div>
                            <span id="span_2">¿Esta seguro de marcar como listo este equipo?</span>
                            <div class="form-group">
                                <label for="id_interna" class="col-form-label">ID institucional equipo:</label>
                                <input type="text" name="id_interna" id="id_interna_2" readonly>
                            </div>
                            <div style="display: none;">
                                <input type="text" name="id" id="id_2" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="limpiar();">Cerrar</button>
                                <button type="submit" class="btn btn-success" name="guardar2"
                                    id="guardar2">Equipo listo!</button>
                            </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--MODAL EQUIPO DEVOLUCION -->
    <div class="modal fade" id="modal_devolucion_sw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Devolución de equipo en Revision de Software</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../consultas/devolucion_sw.php" id="form_devolucion" method="post" onsubmit="return validar_rechazo();">
                        <div id="mensaje_error2"></div>
                            <div class="form-group">
                                <label for="id_interna" class="col-form-label">ID institucional equipo:</label>
                                <input type="text" name="id_interna" id="id_interna" readonly>
                            </div>
                            <div class="form-group">
                                <label for="perfil" class="col-form-label">Perfil:</label>
                                <input type="text" name="perfil" id="perfil" readonly>
                            </div>
                            <div class="form-group">
                                <label for="fecha_llegada" class="col-form-label">Fecha_llegada:</label>
                                <input type="text" name="fecha_llegada" id="fecha_llegada" readonly>
                            </div>
                            <div class="form-group">
                                <label for="contrato" class="col-form-label">Contrato del equipo:</label>
                                <input type="text" name="contrato" id="contrato" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rechazo" class="col-form-label">Motivo Devolución (MAXIMO 200 CARACTERES)</label>
                                <textarea cols="30" rows="10" class="form-control" name="rechazo" id="rechazo" maxlength="200"></textarea>
                            </div>
                            <div style="display: none;">
                                <input type="text" name="id" id="id" readonly>
                                <input type="text" name="id_perfil" id="id_perfil" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="limpiar();">Cerrar</button>
                                <button type="submit" class="btn btn-success" name="guardar"
                                    id="guardar">Devolución</button>
                            </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL EQUIPO DEVOLVER -->
    <div class="modal fade" id="modal_devolver_sw" tabindex="-1" role="dialog" aria-labelledby="modal2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal2">Retroceder una etapa en la revisión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../consultas/devolver_sw.php" id="form_devolver_sw" method="post">
                    <div id="msj_error2"></div>
                        <div class="form-group" id="id_equipo2">
                            <label for="id_bd2" class="col-form-label">Equipo:</label>
                            <input type="text" name="id_interna_4" id="id_interna_4" readonly>
                            <input type="text" name="id_4" id="id_4" style="display: none;" readonly>
                        </div>
                        <div class="form-group">
                        <span>Este equipo volvera a la etapa de <b style="font-weight: bold">Revisión de Hardware ¿Estás seguro?</b> </span>
                        </div>
                        <div class="modal-footer" style="border-top: none">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" name="guardar3"
                                id="guardar3">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL EQUIPO PERFIL -->
<div class="modal fade bd-example-modal-lg" id="modal_perfil" tabindex="-1" role="dialog" aria-labelledby="modal5"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal5">Detalle perfil</h5>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    
    <!-- Otros Scripts -->
    <script type="text/javascript" src="../js/tabla_rev_sw.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>

</body>

</html>