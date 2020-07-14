<?php require_once('../app/views/inc/header.php'); ?>

<div class="" style="display: block; width: 20%">
    <form action="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados" id="form-filtrar" class="form"  method="get">
        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-1">
            <div class="inputBox">
                <label for="fechanacimiento">Fecha de Nacimiento</label>
                <input type="date" id="input" name='fechanacimiento'>
            </div>
        </div>
        <div class="inputBox-1">
            <div class="inputBox">
                <label for="fecharegistro">Fecha de Registro</label>
                <input type="date" id="input" name='fecharegistro'>
            </div>
        
        </div>
        <!-- Clase donde se guarda el radio y el checkbox -->
        <div class="inputBox-1">
            <!-- crear CheckBox -->
            <div class="inputBox">
                <div class="check">
                    <label for="tipousario">Tipo Usuario</label>
                    <br>
                    <select name="tipousario" id="input">
                        <option value="1">Administrador</option>
                        <option value="2">Estandar</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="inputBox-1">
            <!-- Crear radio-->
            <div class="inputBox">
                <div class="check">
                    <label for="sexo">Sexo</label>
                    <br>
                    <select name="sexo" id="input">
                        <option value="1">Hombre</option>
                        <option value="2">Mujer</option>
                    </select>
                </div>
            </div>
        </div>

        <!--Clase boton para los estilos   -->
        <div class="inputBox-1">
            <div class="boton">
                <!-- Boton de guardar -->
                <input type="submit" name="submit" value="Filtrar">
            </div>
        </div>
    </form>
</div>

<table>
    <thead>
        <tr>
            <!-- colspan="Numero de columnas que tendra la tabla" -->
            <th colspan="8">
                <div class="title">
                    <p>Lista de usuarios desactivados. Se encontraron <?php echo $parameters['totalArticulos']." Registros"?></p>
                    <p>
                        <?php if (((isset($parameters['busqueda']) and $parameters['busqueda'] != '') and count($parameters['usuarios']) != 0) || (isset($parameters['tipousario']) && $parameters['tipousario'] != '')):?>
                            <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados" class="btn-editar"><i class="fas fa-redo"></i>Recargar</a>
                        <?php endif?>
                        <a href="<?php echo ROUTE_URL?>/usuarios/usuarios" class="btn-editar"><i class="fas fa-user-check"></i> Activos</a>
                        
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
        <?php if( !isset($parameters['usuarios']) or !$parameters['usuarios']):?>
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
                    <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados/<?php echo $parameters['usuarios'][$i]->idusuario?>?pagina=<?php echo $parameters['pagina']?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>" class="btn-ver"><i class="fas fa-eye"></i></a>
                    <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados/?activar=<?php echo $parameters['usuarios'][$i]->idusuario?>&pagina=<?php echo $parameters['pagina']?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>" class="btn-editar"><i class="fas fa-user-check"></i></a>
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
        <?php if ($parameters['pagina'] == 1 and count($parameters['usuarios'])  !=0):?>
            <li class="disabled">&laquo;</li>
        <?php elseif ($parameters['pagina'] > 1 and count($parameters['usuarios']) != 0):?>
            <a class="inicio" href="?pagina=<?php echo $parameters['pagina'] - 1?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?><?php echo $var=(isset($parameters['fechanacimiento']))?'&fechanacimiento='.$parameters['fechanacimiento']:''?><?php echo $var=(isset($parameters['fecharegistro']))?'&fecharegistro='.$parameters['fecharegistro']:''?><?php echo $var=(isset($parameters['tipousario']))?'&tipousario='.$parameters['tipousario']:''?><?php echo $var=(isset($parameters['sexo']))?'&sexo='.$parameters['sexo']:''?>">&laquo;</a>
        <?php endif;?> 
        
        <!-- Estableciendo numero de paginas -->
          

        <?php for ($i=1; $i <= $parameters['numeroPaginas']; $i++):?>
            
            <?php if ($parameters['pagina'] == $i):?>

                <li class="Active"><a href="usuariosDesactivados?pagina=<?php echo $i?>"><?php echo $i?></a></li>
    
            
            <?php else:?>
                
                <li><a href="usuariosDesactivados?pagina=<?php echo $i?><?php echo $var=(isset($parameters['busqueda']))?'&busqueda='.$parameters['busqueda']:''?><?php echo $var=(isset($parameters['fechanacimiento']))?'&fechanacimiento='.$parameters['fechanacimiento']:''?><?php echo $var=(isset($parameters['fecharegistro']))?'&fecharegistro='.$parameters['fecharegistro']:''?><?php echo $var=(isset($parameters['tipousario']))?'&tipousario='.$parameters['tipousario']:''?><?php echo $var=(isset($parameters['sexo']))?'&sexo='.$parameters['sexo']:''?>"><?php echo $i?></a></li>


            <?php endif?>
                    
    <?php endfor;?>
        <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
        <?php if ($parameters['pagina'] == $parameters['numeroPaginas'] and count($parameters['usuarios']) != 0):?>
            <li class="disabled">&raquo;</li>
        <?php elseif($parameters['pagina'] < $parameters['numeroPaginas'] and count($parameters['usuarios']) != 0): ?>
            <a class="fin" href="?pagina=<?php echo $parameters['pagina'] + 1?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?><?php echo $var=(isset($parameters['fechanacimiento']))?'&fechanacimiento='.$parameters['fechanacimiento']:''?><?php echo $var=(isset($parameters['fecharegistro']))?'&fecharegistro='.$parameters['fecharegistro']:''?><?php echo $var=(isset($parameters['tipousario']))?'&tipousario='.$parameters['tipousario']:''?><?php echo $var=(isset($parameters['sexo']))?'&sexo='.$parameters['sexo']:''?>">&raquo;</a>  
                                                                            
        <?php endif?>                                                       
    </ul>
</section>

<?php require_once('../app/views/inc/footer.php');?>