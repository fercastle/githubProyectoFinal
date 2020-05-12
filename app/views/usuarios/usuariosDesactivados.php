<?php require_once('../app/views/inc/header.php'); ?>

<?php if ( $parameters['realizado'] == true) {
   $var = isset($parameters['realizado'])?$parameters['realizado']: $_GET['realizado'];

   echo $var;
 
}?>
<table>
    <thead>
        <tr>
            <!-- colspan="Numero de columnas que tendra la tabla" -->
            <th colspan="8">
                <div class="title">
                    <p>Lista de usuarios desactivados. Se encontraron
                        <?php echo $parameters['totalArticulos']." Registros"?></p>
                    <p>
                        <?php if (((isset($parameters['busqueda']) and $parameters['busqueda'] != '') || count($parameters['usuarios']) == 0)):?>
                        <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados" class="btn-editar"><i
                                class="fas fa-redo"></i>Recargar</a>
                        <?php endif?>
                        <a href="<?php echo ROUTE_URL?>/usuarios/usuarios" class="btn-editar"><i
                                class="fas fa-user-check"></i> Activos</a>

                    </p>
                </div>
            </th>
        </tr>
        <tr>
            <!-- Se debe ajustar el ancho de las tablas con el numero de columnas-->
            <th width="5">#</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>DUI</th>
            <th>Edad</th>
            <th>Tipo Usuario</th>
            <th>Estado</th>
            <th>Opciones</th>

        </tr>
    </thead>
    <!-- si no se encuentra ningun registro -->
    <tbody>
        <?php if( !isset($parameters['usuarios']) or !$parameters['usuarios'] or count($parameters['usuarios']) == 0):?>
        <tr>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                No hay registros...
            </td>
        </tr>
        <!-- si se encuentran registros -->
        <?php else:?>
        <?php for ($i=0; $i < count($parameters['usuarios']); $i++):?>
        <tr>
            <td data-label="#">
                <?php echo $parameters['numeroRegistro'][$i] + 1?>
            </td>
            <td data-label="Nombre">
                <?php echo $parameters['usuarios'][$i]->nombreusuario.' '.$parameters['usuarios'][$i]->apellidousuario?>
            </td>
            <td data-label="Telefono">
                <?php echo $parameters['usuarios'][$i]->telefonousuario?>
            </td>
            <td data-label="DUI">
                <?php echo $parameters['usuarios'][$i]->duiusuario?>
            </td>
            <td data-label="Edad">
                <?php echo $parameters['usuarios'][$i]->fechanacimientousuario?>
            </td>
            <td data-label="Tipo Usuario">
                <?php echo $var = ($parameters['usuarios'][$i]->idtipousuario == 1)? 'Administrador': 'Estandar'?>
            </td>
            <td data-label="Estado">
                <?php echo $var = ($parameters['usuarios'][$i]->estadousuario == 1)? 'Activado': 'Desactivado'?>
            </td>
            <td data-label="Opciones">
                <!-- <a href="javascript:editarUsu()" class="btn-nuevo"><i class="far fa-edit"></i></a> -->
                <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados/<?php echo $parameters['usuarios'][$i]->idusuario?>?pagina=<?php echo $parameters['pagina']?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>"
                    class="btn-ver"><i class="fas fa-eye"></i></a>
                <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados/?<?php echo $var=(isset($parameters['usuarios']))?'activar='.$parameters['usuarios'][$i]->idusuario:''?><?php echo $var=(isset($parameters['pagina']))?'&pagina='.$parameters['pagina']:''?><?php echo $var=(isset($parameters['totalArticulos']))?'&totalArticulos='.$parameters['totalArticulos']:''?><?php echo $var=(isset($parameters['busqueda']))?'&busqueda='.$parameters['busqueda']:''?>"
                    class="btn-editar"><i class="fas fa-user-check"></i></a>
            </td>
        </tr>
        <?php endfor;?>
        <?php endif; ?>
    </tbody>
</table>

<!-- creando paginacion -->
<section class="paginacion">
    <ul>
        <!-- // bloqueando el boton retroceso -->
        <?php if ($parameters['pagina'] == 1 and count($parameters['usuarios']) != 0):?>
        <li class="disabled">&laquo;</li>
        <?php elseif ($parameters['pagina'] > 1):?>
        <a class="inicio"
            href="?pagina=<?php echo $parameters['pagina'] - 1?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?><?php echo $var=(isset($parameters['fechanacimiento']))?'&fechanacimiento='.$parameters['fechanacimiento']:''?><?php echo $var=(isset($parameters['fecharegistro']))?'&fecharegistro='.$parameters['fecharegistro']:''?><?php echo $var=(isset($parameters['tipousario']))?'&tipousario='.$parameters['tipousario']:''?><?php echo $var=(isset($parameters['sexo']))?'&sexo='.$parameters['sexo']:''?>">&laquo;</a>
        <?php endif;?>

        <!-- Estableciendo numero de paginas -->


        <?php for ($i=1; $i <= $parameters['numeroPaginas']; $i++):?>

        <?php if ($parameters['pagina'] == $i):?>

        <li class="Active"><a href="usuariosDesactivados?pagina=<?php echo $i?>"><?php echo $i?></a></li>


        <?php else:?>

        <li><a
                href="usuariosDesactivados?pagina=<?php echo $i?><?php echo $var=(isset($parameters['busqueda']))?'&busqueda='.$parameters['busqueda']:''?><?php echo $var=(isset($parameters['fechanacimiento']))?'&fechanacimiento='.$parameters['fechanacimiento']:''?><?php echo $var=(isset($parameters['fecharegistro']))?'&fecharegistro='.$parameters['fecharegistro']:''?><?php echo $var=(isset($parameters['tipousario']))?'&tipousario='.$parameters['tipousario']:''?><?php echo $var=(isset($parameters['sexo']))?'&sexo='.$parameters['sexo']:''?>"><?php echo $i?></a>
        </li>


        <?php endif?>

        <?php endfor;?>
        <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
        <?php if ($parameters['pagina'] == $parameters['numeroPaginas'] || (count($parameters['usuarios']) == 0 and $parameters['pagina'] != 1)):?>
        <li class="disabled">&raquo;</li>
        <?php elseif($parameters['pagina'] < $parameters['numeroPaginas'] || (count($parameters['usuarios']) != 0 and $parameters['pagina'] != 1)): ?>
        <a class="fin"
            href="?pagina=<?php echo $parameters['pagina'] + 1?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?><?php echo $var=(isset($parameters['fechanacimiento']))?'&fechanacimiento='.$parameters['fechanacimiento']:''?><?php echo $var=(isset($parameters['fecharegistro']))?'&fecharegistro='.$parameters['fecharegistro']:''?><?php echo $var=(isset($parameters['tipousario']))?'&tipousario='.$parameters['tipousario']:''?><?php echo $var=(isset($parameters['sexo']))?'&sexo='.$parameters['sexo']:''?>">&raquo;</a>

        <?php endif?>
    </ul>
</section>
</main>

</div>
</div>

<!-- Activar usuario -->
<?php if(isset($parameters['usuario']) and isset($parameters['idActivar'])):?>
<div class="box" id="activar-usuario">

    <div class="encabezado">

        <h3 style='color:#3cd300; font-size: 20px;'><i class="fas fa-user-check"></i></h3>
    </div>

    <div class="cuerpo">
        <h4>¿Desea Activar al usuario?</h4>
        <h3 style="color:white">
            <?php echo $parameters['usuario']->nombreusuario .' '.$parameters['usuario']->apellidousuario?></h3>

    </div>

    <div class="pie">

        <div class="aceptar">

            <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados/?<?php echo $var=(isset($parameters['idActivar']))?'id='.$parameters['idActivar']:''?><?php echo $var=(isset($parameters['totalArticulos']))?'&totalArticulos='.$parameters['totalArticulos']:''?><?php echo $var=(isset($parameters['pagina']))?'&pagina='.$parameters['pagina']:''?><?php echo $var=(isset($parameters['busqueda']))?'&busqueda='.$parameters['busqueda']:''?>"
                class="btn-editar"><i class="fas fa-check"></i></a>


        </div>

        <div class="aceptar">

            <a href="javascript:cerrar()" class="btn-desactivar"><i class="fas fa-times"></i></a>

        </div>

    </div>
</div>
<?php endif?>

<!-- llamar archivo js -->
<script src="https://kit.fontawesome.com/2190891eb4.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?php echo ROUTE_URL?>/js/menu.js"></script>

<!-- Direcciones de javascrit incluye las validaciones de form-usuario -->
<script src="<?php echo ROUTE_URL?>/js/validaciones.js"></script>

<?php if(isset($parameters['usuario']) and isset($parameters['idActivar'])):?>
<script>
document.getElementById('activar-usuario').style.display = "block";
display = document.querySelector("#blur");
display.classList.toggle('active');
</script>

<?php endif?>


</body>

</html>