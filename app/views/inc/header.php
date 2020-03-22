<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $parameters['title']?></title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/menu.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/tabla.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/paginacion.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/formulario.css">


</head>
<body>
    <div class="container" id="blur">
    <div class="contenedor active" id="contenedor">

        <!-- Trabajando con el encabezado del archivo menu -->
        <header class="header">
            <div class="contenedor-logo">
                <button id="boton-menu" class="boton-menu"><i class="fas fa-bars"></i></i></button>
                <a href="#" class="logominsal"><img src="img/logominsal.png" alt="UCSF"></a>
            </div>

            <div class="barra-busqueda">
                <input type="text" placeholder="Buscar">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>

            <div class="botones-header">
                <button><i class="fas fa-bell"></i></button>
                <a href="#" class="icono"><i class="fas fa-clinic-medical"></i><span>UCSF</span></a>
            </div> 
        </header>

        <nav class="menu-lateral">
            <a href="#" class="active"><i class="fas fa-home"></i>Inicio</a>
            <a href="#"><i class="fas fa-hand-paper"></i>Manipulador</a>
            <a href="#"><i class="fas fa-warehouse"></i>Establecimiento</a>
            <a href="#"><i class="fas fa-user-secret"></i>Inspección</a>
            <a href="#"><i class="fas fa-clipboard-check"></i>Reporte</a>
        </nav>

        <main class="main">
