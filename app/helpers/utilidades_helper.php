
<?php
    function capitalizar_todo($data_cruda){

        return capitalizar_arreglo($data_cruda, array(), TRUE);
    }

    function capitalizar_arreglo($data_cruda, $campos_capitlizar = array(), $todos = FALSE){

        $data_lista = $data_cruda;

        foreach ($data_cruda as $nombre_campo => $valor_campo) {
            
            //Verifica si existe en el arreglo
            if ( in_array($nombre_campo, array_values($campos_capitlizar)) OR $todos) {
                $data_lista[$nombre_campo] = strtoupper($valor_campo);
            }

        }

        return $data_lista;
    }

    
    function validaText($text){

        return trim(filter_var($text, FILTER_SANITIZE_STRING));
    }

    function validaId($numero, $campo){
        
        $error = FALSE;
        $valor[$campo] = $numero;
        
        if ($numero == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = ucwords($campo). ' es requerido';
            
        }elseif (!is_numeric($numero)) {
            
                $error = TRUE;
                $mensajeError['r'.$campo] = ucwords($campo) .' No es valido';
    

        }
        
        
        if(!$error){
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = (int)validaText($numero);
            http_response_code(200);
        }
        else {
            
            http_response_code(404);            
            

        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }
    
    function validaNumero($numero, $campo, $min = 18, $max = 75){
        
        $error = FALSE;
        $valor[$campo] = $numero;
        
        if ($numero == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = 'Este campo es requerido';
            
        }elseif (is_numeric($numero)) {
            
            
            if($numero < $min){
    
                $error = TRUE;
                $mensajeError['r'.$campo] = 'Se necesita mínimo '.(string)$min;
    
            }else if($numero > $max){
    
                $error = TRUE;
                $mensajeError['r'.$campo] = 'No debe exceder los '.(string)$max;
    
            }
        }else{
            $error = TRUE;
            $mensajeError['r'.$campo] = 'Este campo debe ser un numero';
        }
        
        
        if(!$error){
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = (int)validaText($numero);
            http_response_code(200);
        }
        else {
            
            http_response_code(404);            
            

        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }

    function validaCorreo($correo, $campo){
        
        $error = FALSE;
        
        $valor[$campo] = $correo;
        
        if ($correo == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = 'El '. $campo. ' es requerido';
            
        }else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){

            $error = TRUE;
            $mensajeError['r'.$campo] = 'Formato de '. $campo .' no es correcto';

        }
        
        if(!$error){
         
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = validaText($correo);
            http_response_code(200);
        }else{
            http_response_code(404);
            
        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }

    function validaNombre($text, $campo, $min = 3, $max = 50){
        
        $error = FALSE;
        $text = preg_replace('([^A-Za-z ])', '', $text);
    
        $valor[$campo] = $text;
        if ($text == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'. $campo] = 'Este campo es requerido';
            
        }else if(strlen($text) < $min){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'Se necesita mínimo '.(string)$min.' caracteres';

        }else if(strlen($text) > $max){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'No debe exceder los '.(string)$max.' caracteres';

        }else if(is_numeric($text)){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'No se admiten números en este campo';
        }
        

        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText($text);
            $mensaje = 'success';
        }else {
            $mensaje = 'error';
            
        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'mensaje' => $mensaje];

    }

    function validaStr($text, $campo, $min = 3, $max = 50){
        
        $error = FALSE;
    
        $valor[$campo] = $text;
        if ($text == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'. $campo] = 'Este campo es requerido';
            
        }else if(strlen($text) < $min){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'Se necesita mínimo '.(string)$min.' caracteres';

        }else if(strlen($text) > $max){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'No debe exceder los '.(string)$max.' caracteres';

        }else if(is_numeric($text)){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'No se admiten números en este campo';
        }
        

        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText(ucwords(strtolower($text)));
            $mensaje = 'success';
        }else {
            
            $mensaje = 'error';
            

        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'mensaje' => $mensaje];

    }

    function validafecha($fecha, $campo){

        $error = FALSE;
        $valor[$campo] = $fecha;

        if($fecha == '' || NULL){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'Este campo es requerido';
        }

        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText($fecha);
            $mensaje = 'success';
        }else {
            
            $mensaje = 'error';
            
        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'mensaje' => $mensaje];
       
    }
    
    function validatelefono($telefono, $campo){

        $error = FALSE;
        $valor[$campo] = $telefono;

        if($telefono == '' || NULL){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'Este campo es requerido';
        }else if (!preg_match('/^([0-9]{4}\-[0-9]{4})$/', $telefono)){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'El formato de debe ser 7777-7777';

        } 
        
        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText($telefono);
            $mensaje = 'success';
        }else {
            
            $mensaje = 'error';
            
        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'mensaje' => $mensaje];
       
    }

    function validaDui($dui, $campo){

        $error = FALSE;
        $valor[$campo] = $dui;

        if($dui == '' || NULL){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'Este campo es requerido';
        }else if (!preg_match('/^([0-9]{8}\-[0-9]{1})$/', validaText($dui))){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'El formato debe ser 12345678-0';
            
        } 
        
        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText($dui);
            $mensaje = 'success';
        }else {
            
            $mensaje = 'error';
            
        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'mensaje' => $mensaje];
       
    }

    function validaPassword($pass = null, $pass2 = null, $campo){

        $error = FALSE;
        $valor[$campo] = $pass;

        
        if ($pass == '' || $pass == null) {
            $error = TRUE;
            $mensajeError['r'. $campo] = 'Este campo es requerido';
        }

        elseif ($pass2 == '' || $pass2 == null) {
            $error = TRUE;
            $mensajeError['r'. $campo] = 'Repita contraseña';
        }

        elseif ($pass != $pass2) {
            $error = TRUE;
            $mensajeError['r'. $campo] = 'Las Contraseñas no coinciden';
        }

        
        if(!$error){

            $mensajeError['r'. $campo] = null;
            $valor[$campo] = hash('sha512', $pass);
            $mensaje = 'success';
        }else {
            
            $mensaje = 'error';
            
        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'mensaje' => $mensaje];

    }
?>