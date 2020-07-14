<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>

    <p><?php echo $parameters['mensaje']?></p>
    <div class="caja">
        <div class="titulo">
            <h3>Nuevo usuario</h3>
            <i class="fa fa-user-plus" aria-hidden="true"></i>
        </div>
        <form action="<?php echo ROUTE_URL?>/usuarios/nuevoUsuario" method= "post" id="form-usuario" class="form">
            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  --> 
            <div class="inputBox-3">
                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['nombre']['mensaje']?>">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombreusuario" value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->nombreusuario?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['nombre']['rnombre']?></small>
                </div>

                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['apellido']['mensaje']?>">
                    <label for="Apellido">Apellido</label>
                    <input type="text" id="apellido" name='apellidousuario' value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->apellidousuario?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['apellido']['rapellido']?></small>
                </div>

                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['fechaNacimiento']['mensaje']?>">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name='fechanacimientousuario' value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->fechanacimientousuario?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['fechaNacimiento']['rfechaNacimiento']?></small>
                </div>
            </div>
    
            <!-- Clase que contiene tres div para ponerlos en una sola linea los tres  -->
            <div class="inputBox-3"> 
                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['dui']['mensaje']?>">
                    <label for="dui">DUI</label> 
                    <input id="dui" type="text" name="duiusuario" value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->duiusuario?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['dui']['rdui']?></small>
                </div>

                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['telefono']['mensaje']?>">
                    <label for="telefono">Telefono</label> 
                    <input id="telefono" type="text" name="telefonousuario" value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->telefonousuario?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['telefono']['rtelefono']?></small>
                </div>

                <div class="inputBox">
                    <!-- crear CheckBox -->
                    <label for="genero">Genero</label> 
                    <select id="genero" name="sexousuario"> 
                        <option value="1" <?php if($parameters['errores'] != []){echo $var = ($parameters['data']->sexousuario == 1)? 'selected': '';}?>>Hombre</option> 
                        <option value="2" <?php if($parameters['errores'] != []){echo $var = ($parameters['data']->sexousuario == 2)? 'selected': '';}?>>Mujer</option> 
                    </select>
                </div>
            </div>

             <!-- Clase inputBox solo contiene una sola linea -->
             <div class="inputBox-2">
                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['direccion']['mensaje']?>">
                    <label for="direccion">Dirección</label> 
                    <input id="direccion" type="text" name="direccionusuario" value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->direccionusuario?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['direccion']['rdireccion']?></small>
                </div>  

                <div class="inputBox">
                    <!-- crear CheckBox -->
                    <label for="tipoUsario">Tipo de Usuario</label> 
                    <select id="tipoUsuario" name="idtipousuario"> 
                        <option value="1" <?php if($parameters['errores'] != []){echo $var = ($parameters['data']->idtipousuario == 1)? 'selected': '';}?>>Administrador</option> 
                        <option value="2" <?php if($parameters['errores'] != []){echo $var = ($parameters['data']->idtipousuario == 2)? 'selected': '';}?>>Usuario</option> 
                    </select> 
                </div>  
            </div> 

            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
            <div class="inputBox-3">

                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['usuario']['mensaje']?>">
                    <label for="usuario">Usuario</label> 
                    <input id="usuario" type="text" name="username" value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->username?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['usuario']['rusuario']?></small>
                </div>
                
                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['pass']['mensaje']?>">
                    <label for="password">Contraseña</label> 
                    <input id="password1" type="password" name="password" value="<?php echo $var = ($parameters['errores'] == [])?'':$parameters['data']->password?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['pass']['rpass']?></small>
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
    
