<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <meta lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $parameters['title']?></title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/menu.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/tabla.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/paginacion.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/formulario.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/jquery.dataTables.min.css">

</head>

<body>
    <div class="container" id="blur">
        <div class="contenedor" id="contenedor">

            <!-- Trabajando con el encabezado del archivo menu -->
            <header class="header">
                <div class="contenedor-logo">
                    <button id="boton-menu" class="boton-menu"><i class="fas fa-bars"></i></i></button>
                    <a href="#" class="logominsal"><img src="img/logominsal.png" alt="UCSF"></a>
                </div>


                <?php if ($parameters['menu'] == 'usuarios' and $parameters['title'] == 'Usuarios-activos'):?>

                    <div class="barra-busqueda">
                        <form action="<?php echo ROUTE_URL?>/usuarios/usuarios" method="post" accept-charset="utf-8">
                            <input type="text" placeholder="Buscar" name="busqueda"
                                value="<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>">
                            <button type="submit" name="buscar" value="Consultar"><i class="fas fa-search"></i>
                        </form>
                    </div>

              <?php endif?>

                <?php if ($parameters['menu'] == 'usuarios' and $parameters['title'] == 'Usuarios-inactivos'):?>

                    <div class="barra-busqueda">
                        <form action="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados" method="post"
                            accept-charset="utf-8">
                            <input type="text" placeholder="Buscar" name="busqueda"
                                value="<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>">
                            <button type="submit" name="buscar" value="Consultar"><i class="fas fa-search"></i>
                        </form>
                    </div>
                <?php endif?>



                <div class="botones-header">
                    <button><i class="fas fa-bell"></i></button>
                    <a href="#" class="icono"><i class="fas fa-clinic-medical"></i><span>UCSF</span></a>
                </div>

            </header>

            <nav class="menu-lateral">
                <a href="<?php echo ROUTE_URL?>/index"
                    class="<?php echo $var = ($parameters['menu'] == 'Inicio')? 'active': ''?>"><i
                        class="fas fa-home"></i>Inicio</a>
                <a href="#"><i class="fas fa-hand-paper"></i>Manipúlador</a>
                <a href="#"><i class="fas fa-warehouse"></i>Establecimiento</a>
                <a href="#"><i class="fas fa-user-secret"></i>Inspección</a>
                <a href="#"><i class="fas fa-clipboard-check"></i>Reporte</a>
                <a href="<?php echo ROUTE_URL?>/usuarios"
                    class="<?php echo $var=($parameters['menu'] == 'usuarios')? 'active': ''?>"><i
                        class="fas fa-users-cog"></i>Usuario</a>

            </nav>

            <main class="main">