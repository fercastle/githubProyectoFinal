<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>

<p><?php echo  $parameters['mensaje']?></p>
    <div class="caja">
        <div class="titulo">
            <h3>Editar usuario</h3>
            <i class="fas fa-user-edit"></i>
        </div>
        <form action="<?php echo ROUTE_URL?>/usuarios/actualizarUsuario/<?php echo $parameters['usuario'][0].'/'.$parameters['usuario'][1]?>" method= "post" id="form-usuario" class="form">
           <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  --> 
           <div class="inputBox-3">
           <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['nombre']['mensaje']?>">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $var = (isset($parameters['errores']['nombre']['nombre']))?$parameters['errores']['nombre']['nombre']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['nombre']['rnombre']?></small>
                </div>

                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['apellido']['mensaje']?>">
                    <label for="Apellido">Apellido</label>
                    <input type="text" id="apellido" name='apellido' value="<?php echo $var = (isset($parameters['errores']['apellido']['apellido']))?$parameters['errores']['apellido']['apellido']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['apellido']['rapellido']?></small>
                </div>

                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['fechaNacimiento']['mensaje']?>">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name='fechaNacimiento' value="<?php echo $var = (isset($parameters['errores']['fechaNacimiento']['fechaNacimiento']))?$parameters['errores']['fechaNacimiento']['fechaNacimiento']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['fechaNacimiento']['rfechaNacimiento']?></small>
                </div>
            </div>
    
            <!-- Clase que contiene tres div para ponerlos en una sola linea los tres  -->
            <div class="inputBox-3"> 
            <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['dui']['mensaje']?>">
                    <label for="dui">DUI</label> 
                    <input id="dui" type="text" name="dui" value="<?php echo $var = (isset($parameters['errores']['dui']['dui']))?$parameters['errores']['dui']['dui']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['dui']['rdui']?></small>
                </div>

                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['telefono']['mensaje']?>">
                    <label for="telefono">Telefono</label> 
                    <input id="telefono" type="text" name="telefono" value="<?php echo $var = (isset($parameters['errores']['telefono']['telefono']))?$parameters['errores']['telefono']['telefono']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['telefono']['rtelefono']?></small>
                </div>

                <div class="inputBox">
                    <!-- crear CheckBox -->
                    <label for="genero">Genero</label> 
                    <select id="genero" name="genero"> 
                        <option value="1" <?php if(isset($parameters['errores'])){echo $var = ($parameters['errores']['sexousuario'] == 1)? 'selected': '';}?>>Hombre</option> 
                        <option value="2" <?php if(isset($parameters['errores'])){echo $var = ($parameters['errores']['sexousuario'] == 2)? 'selected': '';}?>>Mujer</option> 
                    </select>
                </div>
            </div>

             <!-- Clase inputBox solo contiene una sola linea -->
             <div class="inputBox-2">
             <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['direccion']['mensaje']?>">
                    <label for="direccion">Dirección</label> 
                    <input id="direccion" type="text" name="direccion" value="<?php echo $var = (isset($parameters['errores']['direccion']['direccion']))?$parameters['errores']['direccion']['direccion']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['direccion']['rdireccion']?></small>
                </div>  

                <div class="inputBox">
                    <!-- crear CheckBox -->
                    <label for="tipoUsario">Tipo de Usuario</label> 
                    <select id="tipoUsuario" name="tipoUsario"> 
                        <option value="1" <?php if(isset($parameters['errores'])){echo $var = ($parameters['errores']['idtipousuario'] == 1)? 'selected': '';}?>>Administrador</option> 
                        <option value="2" <?php if(isset($parameters['errores'])){echo $var = ($parameters['errores']['idtipousuario'] == 2)? 'selected': '';}?>>Usuario</option> 
                    </select> 
                </div>  
            </div> 

            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
            <div class="inputBox-3">

            <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['usuario']['mensaje']?>">
                    <label for="usuario">Usuario</label> 
                    <input id="usuario" type="text" name="usuario" value="<?php echo $var = (isset($parameters['errores']['usuario']['usuario']))?$parameters['errores']['usuario']['usuario']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['usuario']['rusuario']?></small>
                </div>
                
                <div class="inputBox <?php echo $var = ($parameters['errores'] == [])?'':$parameters['errores']['pass']['mensaje']?>">
                    <label for="password">Contraseña</label> 
                    <input id="password1" type="password" name="password1" value="<?php echo $var = (isset($parameters['errores']['pass']['pass']))?$parameters['errores']['pass']['pass']:''?>"> 
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
                <input id="submit" type="submit" name="submit" value="Actualizar"> 
            </div>
            
            <!-- clase errores para ubicar los errores de js -->
            <ul class="errores" id="errores"></ul>
        </form>
    </div> 
       
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>