
<?php require_once('../app/views/inc/header.php'); ?>

    <!-- Lo que aparece en la pagina principal va aqui -->
    <h1>Unidad Comunitaria de Salud Familiar (cambio)</h1>
    
    <table>
	    <thead>
			<tr>
				<!-- colspan="Numero de columnas que tendra la tabla" -->
      			<th colspan="5">Lista de Manipuladores</th>
   	 		</tr>
			<tr>
				<!-- Se debe ajustar el ancho de las tablas -->
				<th width="10">Manipulador</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Edad</th>
				<th>Opciones-Editar-Eliminar</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-label="id Estudiante">1</td>
				<td data-label="nombre Estudiante">juan</td>
				<td data-label="Apellido Estudiante">buriticá</td>
				<td data-label="edad Estudiante">21</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
			<tr>
				<td data-label="id Estudiante">2</td>
				<td data-label="nombre Estudiante">jose</td>
				<td data-label="Apellido Estudiante">castaño</td>
				<td data-label="edad Estudiante">18</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>	    	
			<tr>
				<td data-label="id Estudiante">3</td>
				<td data-label="nombre Estudiante">fernado</td>
				<td data-label="Apellido Estudiante">lopez</td>
				<td data-label="edad Estudiante">16</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
			<tr>
				<td data-label="id Estudiante">1</td>
				<td data-label="nombre Estudiante">juan</td>
				<td data-label="Apellido Estudiante">buriticá</td>
				<td data-label="edad Estudiante">21</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
			<tr>
				<td data-label="id Estudiante">2</td>
				<td data-label="nombre Estudiante">jose</td>
				<td data-label="Apellido Estudiante">castaño</td>
				<td data-label="edad Estudiante">18</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>	    	
			<tr>
	    		<td data-label="id Estudiante">3</td>
	    		<td data-label="nombre Estudiante">fernado</td>
				<td data-label="Apellido Estudiante">lopez</td>
				<td data-label="edad Estudiante">16</td>
				<td data-label="Opciones">
					<a href="#"><i class="fas fa-edit edit"></i></a>
        			<a href="#"><i class="fas fa-trash-alt delete"></i></a>
				</td>
			</tr>
	    </tbody>
	</table>
	<!-- Paginacion -->
	<section class="paginacion">

		<ul>
			<li class="disabled">&laquo;</li>
			<li class="Active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<a class="fin" href="#">&raquo;</a>
		</ul>

</section>


<?php require_once('../app/views/inc/footer.php'); ?>

