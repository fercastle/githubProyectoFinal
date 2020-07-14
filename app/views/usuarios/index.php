<?php require_once('../app/views/inc/header.php'); ?>
<!-- <form action="<?php echo ROUTE_URL?>/usuarios/busqueda" method = "POST">
<h1>Index</h1>
<div class="barra-busqueda">
    <input type="text" placeholder="Buscar" name="busqueda" required>
    <input type="submit" name="buscar"><i class="fas fa-search"></i>
</div>

</form> -->

    <div class="contenedor-tabla">
    <table class="display" id="mitabla">
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
				<th>Opciones</th>
				
			</tr>
		</thead>
		<tbody>
            
            <?php for ($i=0; $i < count($parameters['usuarios']); $i++):?>
               
                    <tr>
                        <td data-label="#"><?php echo $i + 1 ?></td>
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
	    </tbody>
    </table>
    
    </div>
<?php require_once('../app/views/inc/footer.php'); ?>
