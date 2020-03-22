</main>

</div>
</div>
<!-- Formulario Usuario -->
<!-- contenedor del popup-usuario -->
<div id="popup">
	<div class="box"> 
        <h3>Registro de Usuario</h3> 
        <!-- Formulario de usuario --> 
        <form action="" id="form"> 

            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  --> 
            <div class="box-inputBox-3"> 

                <div class="inputBox"> 
                    <label for="">Nombre</label> 
                    <input id="input" type="text" name=""> 
                </div> 
 
                <div class="inputBox"> 
                    <label for="">Apellido</label> 
                    <input id="input" type="text" name=""> 
                </div> 
 
                <div class="inputBox"> 
                    <label for="">Fecha Nacimiento</label> 
                    <input id="input" type="date"> 
                </div> 
            </div> 

            <!-- Clase inputBox solo contiene una sola linea -->
            <div class="inputBox"> 
                <label for="">Dirección</label> 
                <input id="input" type="text" name=""> 
            </div> 
 
            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
            <div class="box-inputBox-3"> 

                <div class="inputBox"> 
                    <label for="">DUI</label> 
                    <input id="input" type="text" name=""> 
                </div> 
 
                <div class="inputBox"> 
                    <label for="">Telefono</label> 
                    <input id="input" type="text" name=""> 
                </div> 
 
                <div class="inputBox"> 
                       <!-- crear CheckBox -->
                    <label for="">Estado Usuario</label> 
                    <select name="" id="input"> 
                        <option value="1">Activo</option> 
                        <option value="2">Inactivo</option> 
                    </select> 
                </div> 
            </div> 

            <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  -->
            <div class="box-inputBox-3"> 
 
                <div class="inputBox"> 
                    <label for="">Usuario</label> 
                    <input id="input" type="text" name=""> 
                </div> 
 
                <div class="inputBox"> 
                    <label for="">Contraseña</label> 
                    <input id="input" type="password" name=""> 
                </div> 
 
                <div class="inputBox"> 
                    <label for="">Repita Contraseña</label> 
                    <input id="input" type="password" name=""> 
                </div> 
            </div> 
 
            <!-- Clase donde se guarda el radio y el checkbox --> 
            <div class="box-inputBox-2"> 
                <!-- crear CheckBox -->
                <div class="check">
                    <label for="">Tipo de Usuario</label> 
                    <select name="" id="input"> 
                        <option value="1">Administrador</option> 
                        <option value="2">Usuario</option> 
                    </select> 
                </div>

                <!-- Crear clase radio-->
                <div class="radio"> 
                    <label for="" name="genero" id="genero">Genero</label>   

                    <input type="radio" name="sexo" id="Masculino" checked>
                    <label for="Masculino">Masculino</label>
            
                    <input type="radio" name="sexo" id="Femenino">
                    <label for="Femenino">Femenino</label>
                </div>
            </div> 

			<!--Clase boton para los estilos   --> 
			<div class="box-inputBox-2"> 
				<div class="boton"> 
                	<!-- Boton de guardar --> 
                	<input type="submit" name="" value="Guardar"> 
				</div> 
				<div class="boton"> 
                	<!-- Boton de guardar --> 
                	<input onclick="toggle() "type="submit" name="" value="Cerrar"> 
            	</div> 
			</div>
            
        </form> 
    </div> 
</div>
<!-- llamar archivo js -->
<script src="https://kit.fontawesome.com/2190891eb4.js" crossorigin="anonymous"></script>
<script src="<?php echo ROUTE_URL?>/js/menu.js"></script>

</body>
</html>