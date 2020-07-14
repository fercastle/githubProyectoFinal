<?php require_once('../app/views/inc/header.php'); ?>
<form action="<?php echo ROUTE_URL?>/usuarios/busqueda">
<h1>Busqueda</h1>
<div class="barra-busqueda">
    <input type="text" placeholder="Buscar" name="busqueda" required>
    <input type="submit" name="buscar"><i class="fas fa-search"></i>
</div>
<!-- <div class="check">
<label for="">Paginacion</label>
<select name="area" onChange="location = form.area.options[form.area.selectedIndex].value;">
<option value="<?php echo ROUTE_URL?>/usuarios/index?postPorPagina=3">3</option>
<option value="<?php echo ROUTE_URL?>/usuarios/index?postPorPagina=6">6</option>
<option value="<?php echo ROUTE_URL?>/usuarios/index?postPorPagina=9">9</option>

</select>
</div> -->
</form>
    <table>
	    <thead>
			<tr>
				<!-- colspan="Numero de columnas que tendra la tabla" -->
      			<th colspan="8">
                        <div class="title">
                          <p>Lista de Usuarios</p><a href="#" class="btn-nuevo"><i class="far fa-plus-square"></i> nuevo</a>
                        </div>
                </th>
   	 		</tr>
			<tr>
				<!-- Se debe ajustar el ancho de las tablas -->
				<th width="5">#</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Edad</th>
                <th>Telefono</th>
                <th>Tipo Usuario</th>
                <th>Estado</th>
				<th>Opciones-Editar-Eliminar</th>
				
			</tr>
		</thead>
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
            <?php else:?>
            
            <?php for ($i=0; $i < count($parameters['usuarios']); $i++):?>
                
                    <tr>
                        <td data-label="#"><?php echo $parameters['numeroId'][$i] + 1 ?></td>
                        <td data-label="Nombre"><?php echo $parameters['usuarios'][$i]->nombreusuario?></td>
                        <td data-label="Apellido"><?php echo $parameters['usuarios'][$i]->apellidousuario?></td>
                        <td data-label="Edad"><?php echo $parameters['usuarios'][$i]->fechanacimientousuario?></td>
                        <td data-label="Telefono"><?php echo $parameters['usuarios'][$i]->telefonousuario?></td>
                        <td data-label="Tipo Usuario"><?php echo $var = ($parameters['usuarios'][$i]->idtipousuario == '1')? 'Administrador' : 'Estandar'?></td>
                        <td data-label="Estado"><?php echo $var = ($parameters['usuarios'][$i]->estadousuario  == '1')? 'Activado' : 'Desactivado'?></td>
                        <td data-label="Opciones-Editar-Eliminar">
                            <div class="lista-botones">
                                <button id="editar-usuario" onclick="editarUsuario(<?php echo $parameters['usuarios'][$i]->duiusuario ?>)" class="btn-editar"><i class="fas fa-edit"></i></button>
                                <a href="#" class="btn-desactivar"><i class="far fa-frown-open"></i> Anular</a>
                            </div>
                        </td>
                    </tr>
                <?php endfor?>
            <?php endif?>
	    </tbody>
	</table>

    <?php if( !$parameters['usuarios'] == ""): ?>
    <section class="paginacion">
        <ul>
           <!-- // bloqueando el boton inicial de retroceso si se esta en la pag 1 -->
                <?php if ($parameters['pagina'] == 1):?>
                   <li class="disabled">&laquo;</li>
               <?php else: ?>
                   <a class="inicio" href="busqueda?pagina=<?php echo $parameters['pagina'] - 1?>&busqueda=<?php echo $parameters['busqueda']?>">&laquo;</a>
               <?php endif;?> 
           <!-- Estableciendo la paginacion -->
                <?php

                for ($i=1; $i <= $parameters['numPag']; $i++) { 


                    if ($parameters['pagina'] == $i) {
                        echo "<li class='Active'><a href='busqueda?pagina=$i'>$i</a></li>";
                    }else{
                        echo '<li><a href="busqueda?pagina='.$i.'&busqueda='.$parameters['busqueda'].'">'.$i.'</a></li>';
                    }
                }
                    
            ?> 
        <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
            <?php if ($parameters['pagina'] == $parameters['numPag']):?>
                <li class="disabled">&raquo;</li>
            <?php else: ?>
                <a class="fin" href="?pagina=<?php echo $parameters['pagina'] + 1?>&busqueda=<?php echo $parameters['busqueda']?>">&raquo;</a>
            <?php endif?> 
        </ul>
    </section>
    <?php endif?>

<?php require_once('../app/views/inc/footer.php'); ?>
