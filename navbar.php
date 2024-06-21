<?php
if (isset($title)) {
    date_default_timezone_set('America/Argentina/La_Rioja');
    setlocale(LC_TIME, 'Spanish');
    /* Connect To Database*/
    require_once("config/db.php"); // Contiene las variables de configuracion para conectar a la base de datos
    require_once("config/conexion.php"); // Contiene funcion que conecta a la base de datos
    ?>
    <?php
    $query_empresa = mysqli_query($con, "select * from perfil where id_perfil=1");
    $row = mysqli_fetch_array($query_empresa);

    $query_horario = mysqli_query($con, "select * from horarios where id_horario=1");
    $hora = mysqli_fetch_array($query_horario);
    $apertura = $hora['apertura'];
    $cierre = $hora['cierre'];
    $dia_inicio = $hora['dia_inicio'];
    $dia_cierre = $hora['dia_cierre'];
    $hora_actual = date("H:i:s");
    $today = date("w");
    ?>
    <style>
        .navbar-header .nav-link {
            display: flex;
            align-items: center;
        }
        .navbar-header .nav-link img {
            margin-right: 10px;
        }
        .navbar-header .nav-link marquee {
            flex-grow: 1;
        }
    </style>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="nav-link">
                    <img src="<?php echo $row['logo_url']; ?>" style="width: 50px; border-radius: 50%;">
                    <marquee><a class="navbar-brand" href="index.php"><?php echo $row['nombre_empresa']; ?></a></marquee>
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--PERMISO A LOS USUARIOS QUE NO SON ADMINISTRADORES-->
                    <?php if ($_SESSION['user_name'] != 'admin' && $_SESSION['user_name'] != 'mesa'): ?>
                        <?php if (($dia_cierre >= $today && $cierre >= $hora_actual) || ($dia_cierre > $today && $dia_inicio <= $today)): ?>
                            <li class="<?php echo $active_Jugadores; ?>"><a href="jugadores.php"><i class='glyphicon glyphicon-user'></i> Jugadores <span class="sr-only">(current)</span></a></li>
                            <li class="<?php echo $active_fichajes; ?>"><a href="fichajes.php"><i class='glyphicon glyphicon-file'></i> Fichajes </a></li>
                            <li class="<?php echo $active_planilla; ?>"><a href="planilla.php"><i class='glyphicon glyphicon-upload'></i> Carga de Planilla</a></li>
                            <li class="<?php echo $active_miplanilla; ?>"><a href="listarplanilla.php"><i class='glyphicon glyphicon-file'></i> Mis Planillas</a></li>
                        <?php else: ?>
                            <li><a href="  "><h4>"Ya es hora de cierre, hasta la proxima"</h4></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!--PERMISO A LOS USUARIOS QUE SON ADMINISTRADORES-->
                    <?php if ($_SESSION['user_name'] == 'mesa'): ?>
                        <li class="<?php echo $active_miplanilla; ?>"><a href="ver_planillas.php"><i class='glyphicon glyphicon-eye-open'></i> Ver las Planillas</a></li>
                        <li class="<?php echo $active_carnet; ?>"><a href="carnet.php"><i class='glyphicon glyphicon-eye-open'></i> Ver Carnet</a></li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user_name'] == 'admin'): ?>
                        <li class="<?php echo $active_usuarios; ?>"><a href="usuarios.php"><i class='glyphicon glyphicon-user'></i> Equipos</a></li><hr>
                        <li class="<?php echo $active_cargajugador; ?>"><a href="jugador.php"><i class='glyphicon glyphicon-globe'></i> Jugadores</a></li><hr>
                        <li class="nav-item dropdown <?php echo $active_administracion; ?>">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administracion <i class="glyphicon glyphicon-arrow-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo $active_cargafichajes; ?>"><a href="fichas.php"><i class='glyphicon glyphicon-file'></i> Fichajes</a></li><hr>
                                <li class="<?php echo $active_miplanilla; ?>"><a href="ver_planillas.php"><i class='glyphicon glyphicon-eye-open'></i> Planillas</a></li><hr>
                                <li class="<?php echo $active_pases; ?>"><a href="nueva_pases.php"><i class='glyphicon glyphicon-send'></i> Pases</a></li>
                            </ul>
                        </li><hr>
                        <li class="<?php echo $active_consultas; ?>"><a href="consulta_planillas.php"><i class='glyphicon glyphicon-list-alt'></i> Reporte </a></li><hr>
                        <li class="nav-item dropdown <?php echo $active_perfil; ?>">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Configuracion <i class="glyphicon glyphicon-arrow-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="<?php echo $active_perfil; ?>"><a class="dropdown-item" href="perfil.php">Configurar perfil</a></li><hr>
                                <li class="<?php echo $active_horario; ?>"><a class="dropdown-item" href="horario.php">Horario</a></li><hr>
                            </ul>
                        </li><hr>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($_SESSION['user_name'] == 'admin'): ?>
                        <li class="<?php echo $active_gastos; ?>"><a href="registro_gastos.php"><i class='glyphicon glyphicon-usd'></i> Gastos</a></li><hr>
                    <?php endif; ?>
                    <li><a href="https://api.whatsapp.com/send?phone=3804777794" target='_blank'><i class='glyphicon glyphicon-wrench'></i> Soporte</a></li><hr>
                    <?php if ($_SESSION['user_name'] != 'admin'): ?>
                        <li class="<?php echo $active_usuarios; ?>"><a href="configuracion.php"><i class='glyphicon glyphicon-cog'></i> Configuracion</a></li><hr>
                    <?php endif; ?>
                    <li><a href="#"><i class='glyphicon glyphicon-user'></i> <?php echo $_SESSION['user_name']; ?></a></li><hr>
                    <li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <?php
}
?>
<script type="text/javascript">
    setInterval(function() { load_data(); }, 3000);
    var load_data = function () {
        $('.navbar-nav').load();
    }
</script>
