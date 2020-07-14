<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/formularios.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/login.css">
</head>
<body style="margin: 0% auto">
<div class="caja" style="position: absolute; top: 10%;
    left: 20%;
    width: 40%;
    padding: 40px; box-shadow: 0 15px 25px rgba(0, 0, 0, .5);">
        <div class="titulo">
            <i class="fas fa-user-lock"></i>
            <h3 style="display: inline-block; margin-left: 10%">Login</h3>
        </div>
        
        <form style="padding: 10px; " action="<?php echo ROUTE_URL?>/login/index" method= "post" id="form-usuario" class="form">
    
            <div class="inputBox-1">

                <div class="inputBox <?php echo $parameters['valor1']?>" style="width: 80%">
                    <label for="usuario">Usuario</label> 
                    <input id="usuario" type="text" name="usuario" style="width: 100%" value="<?php echo $parameters['usuario']?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['usuario']?></small>
                </div>

            </div>
            <div class="inputBox-1">
        
                <div class="inputBox <?php echo $parameters['valor2']?>" style="width: 80%"">
                    <label for="password">Contraseña</label> 
                    <input id="pass" type="password" name="pass" style="width: 100%"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small><?php echo $parameters['errores']['pass']?></small>
                </div>

            </div>
    
            <!--Clase boton para los estilos   --> 
            <div class="boton" style= "padding: 5px auto;"> 
                <!-- Boton de guardar --> 
                <input id="submit" type="submit" name="submit" value="Guardar" style="margin-left: 10px;"> 
            </div>
         
        </form>
    </div> 
    <!-- <div class="box">
        <h2>INICIO DE SESION</h2>

      
        <form action="" id="login">

            <div class="inputBox">
                <input type="text" name="" required="">
                <label for="">Usuario</label>
            </div>

            <div class="inputBox">
                <input type="password" name="" required="">
                <label for="">Password</label>
            </div>

            <input type="submit" name="" value="Ingresar">

        </form>
        


    </div> -->
</body>
</html>