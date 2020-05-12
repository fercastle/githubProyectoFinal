<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>

    <div class="caja">
        <div class="titulo">
            <h3>Usuario</h3>
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </div>
        <form action="" id="form-usuario" class="form">
            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  --> 
            <div class="inputBox-3">
                <div class="inputBox">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>

                <div class="inputBox">
                    <label for="Apellido">Apellido</label>
                    <input type="text" id="apellido" name='apellido'> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>

                <div class="inputBox">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name='fechaNacimiento'>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
            </div>
    
            <!-- Clase que contiene tres div para ponerlos en una sola linea los tres  -->
            <div class="inputBox-3"> 
                <div class="inputBox">
                    <label for="dui">DUI</label> 
                    <input id="dui" type="text" name="dui"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>

                <div class="inputBox">
                    <label for="telefono">Telefono</label> 
                    <input id="telefono" type="text" name="telefono"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>

                <div class="inputBox">
                    <!-- crear CheckBox -->
                    <label for="genero">Genero</label> 
                    <select name="" id="genero" name="genero"> 
                        <option value="1">Hombre</option> 
                        <option value="2">Mujer</option> 
                    </select> 
                </div>
            </div>

             <!-- Clase inputBox solo contiene una sola linea -->
             <div class="inputBox-2">
                <div class="inputBox">
                    <label for="direccion">Dirección</label> 
                    <input id="direccion" type="text" name="direccion"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>  

                <div class="inputBox">
                    <!-- crear CheckBox -->
                    <label for="tipoUsario">Tipo de Usuario</label> 
                    <select name="" id="tipoUsuario" name="tipoUsario"> 
                        <option value="1">Administrador</option> 
                        <option value="2">Usuario</option> 
                    </select> 
                </div>  
            </div> 

            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
            <div class="inputBox-3">

                <div class="inputBox">
                    <label for="usuario">Usuario</label> 
                    <input id="usuario" type="text" name="usuario"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
            
                <div class="inputBox">
                    <label for="password">Contraseña</label> 
                    <input id="password1" type="password" name="password1"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>

                <div class="inputBox">
                    <label for="password2">Repita Contraseña</label> 
                    <input id="password2" type="password" name="password2"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                </div> 
            </div>
    
            <!--Clase boton para los estilos   --> 
            <div class="boton"> 
                <!-- Boton de guardar --> 
                <input id="submit" type="submit" name="submit" value="Guardar"> 
            </div>

            <!-- clase errores para ubicar los errores de js -->
            <ul class="errores" id="errores"></ul>
        </form>
    </div> 
       
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>
    
