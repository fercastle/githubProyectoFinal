</main>

</div>
</div>
<!-- Formulario Usuario -->
<!-- contenedor del popup-usuario -->
<div class="box" id="nuevo-usuario">

    <h3>Registro de Usuario</h3>
    <form action="" id="form-usuario" class="form">
        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-3">
            <div class="inputBox">
                <label for="nombre">Nombre</label>
                <input type="text" id="input" name="nombre">
            </div>

            <div class="inputBox">
                <label for="Apellido">Apellido</label>
                <input type="text" id="input" name='apellido'>
            </div>

            <div class="inputBox">
                <label for="fechanacimiento">Fecha de Nacimiento</label>
                <input type="date" id="input" name='fechanacimiento'>
            </div>
        </div>

        <!-- Clase inputBox solo contiene una sola linea -->
        <div class="inputBox-1">
            <div class="inputBox">
                <label for="direccion">Dirección</label>
                <input id="input" type="text" name="direccion">
            </div>
        </div>

        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-3">
            <div class="inputBox">
                <label for="dui">DUI</label>
                <input id="input" type="text" name="dui">
            </div>

            <div class="inputBox">
                <label for="telefono">Telefono</label>
                <input id="input" type="text" name="telefono">
            </div>

            <div class="inputBox">
                <!-- crear CheckBox -->
                <label for="estadousuario">Estado Usuario</label>
                <select name="estadousuario" id="input">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                </select>
            </div>
        </div>

        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-3">
            <div class="inputBox">
                <label for="usuario">Usuario</label>
                <input id="input" type="text" name="usuario">
            </div>

            <div class="inputBox">
                <label for="password">Contraseña</label>
                <input id="input" type="password" name="password">
            </div>

            <div class="inputBox">
                <label for="password2">Repita Contraseña</label>
                <input id="input" type="password" name="password2">
            </div>
        </div>

        <!-- Clase donde se guarda el radio y el checkbox -->
        <div class="inputBox-2">
            <!-- crear CheckBox -->
            <div class="inputBox">
                <div class="check">
                    <label for="tipousario">Tipo de Usuario</label>
                    <select name="tipousario" id="input">
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                    </select>
                </div>
            </div>

            <!-- Crear radio-->
            <div class="radio">
                <label for="genero" id="genero">Sexo</label>

                <input type="radio" id="Masculino" name='sexo' checked>
                <label for="Masculino" name='sexo'>Mujer</label>

                <input type="radio" id="Femenino" name='sexo'>
                <label for="Femenino" name='sexo'>Hombre</label>
            </div>
        </div>

        <!--Clase boton para los estilos   -->
        <div class="inputBox-2">
            <div class="boton">
                <!-- Boton de guardar -->
                <input type="submit" name="submit" value="Guardar">
            </div>
            <div class="boton" id="cerrar">
                <a id="cerrar" href="javascript:cerrar()">Cerrar</a>
            </div>
        </div>
    </form>
</div>
<!-- editar-usuario -->
<div class="box" id="editar-usuario">

    <h3>Editar Usuario</h3>
    <form action="" id="form-usuario" class="form">
        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-3">
            <div class="inputBox">
                <label for="nombre">Nombre</label>
                <input type="text" id="input" name="nombre" value="<?php echo $parameters['usuario']->nombreusuario?>">
            </div>

            <div class="inputBox">
                <label for="Apellido">Apellido</label>
                <input type="text" id="input" name='apellido'
                    value="<?php echo $parameters['usuario']->apellidousuario?>">
            </div>

            <div class="inputBox">
                <label for="fechanacimiento">Fecha de Nacimiento</label>
                <input type="date" id="input" name='fechanacimiento'
                    value="<?php echo $parameters['usuario']->fechanacimientousuario?>">
            </div>
        </div>

        <!-- Clase inputBox solo contiene una sola linea -->
        <div class="inputBox-1">
            <div class="inputBox">
                <label for="direccion">Dirección</label>
                <input id="input" type="text" name="direccion"
                    value="<?php echo $parameters['usuario']->direccionusuario ?>">
            </div>
        </div>

        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-3">
            <div class="inputBox">
                <label for="dui">DUI</label>
                <input id="input" type="text" name="dui" value="<?php echo $parameters['usuario']->duiusuario?>">
            </div>

            <div class="inputBox">
                <label for="telefono">Telefono</label>
                <input id="input" type="text" name="telefono"
                    value="<?php echo $parameters['usuario']->telefonousuario ?>">
            </div>

            <div class="inputBox">
                <!-- crear CheckBox -->
                <label for="estadousuario">Estado Usuario</label>
                <select name="estadousuario" id="estado">
                    <option value="1" <?php echo $var = ($parameters['usuario']->estadousuario == 1)? 'selected' : ''?>>
                        Activo</option>
                    <option value="2" <?php echo $var = ($parameters['usuario']->estadousuario == 2)? 'selected' : ''?>>
                        Inactivo</option>
                </select>
            </div>
        </div>

        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-3">
            <div class="inputBox">
                <label for="usuario">Usuario</label>
                <input id="input" type="text" name="usuario" value="<?php echo $parameters['usuario']->username?>">
            </div>

            <div class="inputBox">
                <label for="password">Contraseña</label>
                <input id="input" type="password" name="password">
            </div>

            <div class="inputBox">
                <label for="password2">Repita Contraseña</label>
                <input id="input" type="password" name="password2">
            </div>
        </div>

        <!-- Clase donde se guarda el radio y el checkbox -->
        <div class="inputBox-2">
            <!-- crear CheckBox -->
            <div class="inputBox">
                <div class="check">
                    <label for="tipousario">Tipo de Usuario</label>
                    <select name="tipousario" id="input">
                        <option value="1"
                            <?php echo $var = ($parameters['usuario']->idtipousuario == 1)? 'selected' : ''?>>
                            Administrador</option>
                        <option value="2"
                            <?php echo $var = ($parameters['usuario']->idtipousuario == 2)? 'selected' : ''?>>Usuario
                        </option>
                    </select>
                </div>
            </div>

            <!-- Crear radio-->
            <div class="radio">
                <label for="genero" id="genero">Sexo</label>

                <input type="radio" id="Masculino" name='1'
                    <?php echo $var = ($parameters['usuario']->sexousuario  == 1)? 'checked' : ''?>>
                <label for="Masculino" name='sexo'>Hombre</label>

                <input type="radio" id="Femenino" name='2'
                    <?php echo $var = ($parameters['usuario']->sexousuario  == 2)? 'checked' : ''?>>
                <label for="Femenino" name='sexo'>Mujer</label>
            </div>
        </div>

        <!--Clase boton para los estilos   -->
        <div class="inputBox-2">
            <div class="boton">
                <!-- Boton de guardar -->
                <input type="submit" name="submit" value="Guardar">
            </div>
            <div class="boton" id="cerrar">
                <a id="cerrar" href="javascript:cerrar()">Cerrar</a>
            </div>
        </div>
    </form>
</div>


<!-- Eliminar usuario -->
<div class="box" id="eliminar-usuario">

    <h3>Eliminar Usuario</h3>
    <form action="<?php echo ROUTE_URL?>/usuarios/desactivar/<?php echo $parameters['usuario']->idusuario?>" id="form-usuario" class="form">
        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-1">
            <h4 style="color:white">Esta seguro de eliminar a <?php echo $parameters['usuario']->nombreusuario .' '.$parameters['usuario']->apellidousuario?> permanentemente</h4>
        </div>
        <!--Clase boton para los estilos   -->
        <div class="inputBox-2">

            <div class="boton">
                <!-- Boton de guardar -->
                <input type="submit" name="submit" value="Aceptar">
            </div>

            <div class="boton" id="cerrar">
                <a id="cerrar" href="javascript:cerrar()">Cerrar</a>
            </div>

        </div>
    </form>
</div>

<!-- Activar usuario -->
<div class="box" id="activar-usuario">

    <h3>Acivar usuario Usuario</h3>
    <form action="<?php echo ROUTE_URL?>/usuarios/activar/<?php echo $parameters['usuario']->idusuario?>" id="form-usuario" class="form">
        <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
        <div class="inputBox-1">
            <h4 style="color:white">Desea activar a <?php echo $parameters['usuario']->nombreusuario .' '.$parameters['usuario']->apellidousuario?> !</h4>
        </div>
        <!--Clase boton para los estilos   -->
        <div class="inputBox-2">

            <div class="boton">
                <!-- Boton de guardar -->
                <input type="submit" name="submit" value="Aceptar">
            </div>

            <div class="boton" id="cerrar">
                <a id="cerrar" href="javascript:cerrar()">Cerrar</a>
            </div>

        </div>
    </form>
</div>



<!-- llamar archivo js -->
<script src="https://kit.fontawesome.com/2190891eb4.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?php echo ROUTE_URL?>/js/menu.js"></script>
<script src="<?php echo ROUTE_URL?>/js/jquery.dataTables.min.js"></script>

<?php if(isset($parameters['usuario']) and isset($parameters['idEdit'])):?>
<script>
document.getElementById('editar-usuario').style.display = "block";
display = document.querySelector("#blur");
display.classList.toggle('active');
</script>
<?php endif?>
<?php if(isset($parameters['usuario']) and isset($parameters['idEliminar'])):?>
<script>
document.getElementById('eliminar-usuario').style.display = "block";
display = document.querySelector("#blur");
display.classList.toggle('active');
</script>
<?php endif?>

<?php if(isset($parameters['usuario']) and isset($parameters['idActivar'])):?>
<script>
document.getElementById('activar-usuario').style.display = "block";
display = document.querySelector("#blur");
display.classList.toggle('active');
</script>

<?php endif?>

<script>
$(document).ready(function() {

    $('#mitabla').DataTable({
        // indicando el orden en que aparecen los registros
        // seleccionamos la columna 1 y le decimos que lo muestre
        // de manera ascendente
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }

    });
});
</script>

</body>

</html>