<?php

    class ModeloUsuarios{
        
        private $db;

        public $idusuario; 
        public $nombreusuario; 
        public $apellidousuario;
        public $direccionusuario;
        public $telefonousuario;
        public $duiusuario;
        public $sexousuario;
        public $fechanacimientousuario;
        public $estadousuario;
        public $username;
        public $password;
        public $idtipousuario;
        public $fecharegistro;
        public $fechamodusuario;
        public $usermod;

        public function __construct(){

            $this->db = new Sql;
        }
        
        public function set_datos($data_cruda){
            
            foreach ($data_cruda as $nombre_campo => $valor_campo) {
                
                if (property_exists('ModeloUsuarios', $nombre_campo)) {
                    
                    $this->$nombre_campo = $valor_campo;
                }
            }

            return $this;
        }

        //BuscarDUI
        public function busquedaDui($dui){

         
            $this->db->query("SELECT idusuario FROM usuarios WHERE duiusuario = :duiusuario");
            $this->db->bind(':duiusuario', $dui);

            return $this->db->rowCount();

        }

         //BuscarDUI
         public function busquedausuario($username){

         
            $this->db->query("SELECT username FROM usuarios WHERE username = :username");
            $this->db->bind(':username', $username);

            return $this->db->rowCount();
       

        }

        public function actualizarUsuario($id, $user, $fecharegistro, $usuario){

            
            $this->db->query(
                "UPDATE usuarios 
                SET nombreusuario = :nombreusuario, 
                    apellidousuario = :apellidousuario, 
                    direccionusuario = :direccionusuario, 
                    telefonousuario = :telefonousuario,
                    duiusuario = :duiusuario, 
                    sexousuario = :sexousuario, 
                    fechanacimientousuario = :fechanacimientousuario, 
                    estadousuario = 1,
                    username = :username, 
                    password = :password, 
                    idtipousuario = :idtipousuario, 
                    fecharegistro = :fecharegistro,
                    fechamodusuario = now(),
                    usermod = :usermod 
                    WHERE idusuario = :id");
              $this->db->bind(':nombreusuario', $user['nombre']['nombre'] );
              $this->db->bind(':apellidousuario', $user['apellido']['apellido']);
              $this->db->bind(':direccionusuario', $user['direccion']['direccion'] );
              $this->db->bind(':telefonousuario', $user['telefono']['telefono'] );
              $this->db->bind(':duiusuario', $user['dui']['dui']);
              $this->db->bind(':sexousuario', $user['sexousuario']);
              $this->db->bind(':fechanacimientousuario', $user['fechaNacimiento']['fechaNacimiento']);
              $this->db->bind(':username', $user['usuario']['usuario']);
              $this->db->bind(':fecharegistro', $fecharegistro);
              $this->db->bind(':password', $user['pass']['pass']);
              $this->db->bind(':idtipousuario', $user['idtipousuario']);
              $this->db->bind(':usermod', $usuario);
              $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }

        //agregar usuarios
        public function nuevousuario($user, $usuario){
            
            $this->db->query(
                'INSERT INTO usuarios(
                nombreusuario, apellidousuario, direccionusuario, telefonousuario,
                duiusuario, sexousuario, fechanacimientousuario, 
                estadousuario, username, password, 
                idtipousuario, fecharegistro, fechamodusuario, usermod) 
                VALUES(:nombreusuario, :apellidousuario, :direccionusuario, :telefonousuario,
                :duiusuario, :sexousuario, :fechanacimientousuario, 
                1, :username, :password, 
                :idtipousuario, now(), now(), :usermod)');
            

                $this->db->bind(':nombreusuario', $user->nombreusuario);
                $this->db->bind(':apellidousuario', $user->apellidousuario);
                $this->db->bind(':direccionusuario', $user->direccionusuario);
                $this->db->bind(':telefonousuario', $user->telefonousuario);
                $this->db->bind(':duiusuario', $user->duiusuario);
                $this->db->bind(':sexousuario', $user->sexousuario);
                $this->db->bind(':fechanacimientousuario', $user->fechanacimientousuario);
                $this->db->bind(':username', $user->username);
                $this->db->bind(':password', $user->password);
                $this->db->bind(':idtipousuario', $user->idtipousuario);
                $this->db->bind(':usermod', $usuario);

                if ($this->db->execute()) {

                    return TRUE;
                } else {
                    return FALSE;
                }
                
        }
        //obtener el numero de registros
        public function numeroRegistros($busqueda = null, $estado = '2' ){

            if ($busqueda != null && strpos($busqueda, ' ')) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);

                $this->db->query(
                    "SELECT * FROM usuarios
                    WHERE( LOWER(CONCAT(nombreusuario,apellidousuario)) LIKE '$busqueda' OR
                    LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                    )
                    AND estadousuario = $estado");
                return $this->db->rowCount();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {

                $this->db->query(
                    "SELECT * FROM usuarios
                     WHERE(
                        idusuario LIKE '%$busqueda%' OR 
                        LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                        LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                        LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                        telefonousuario LIKE '%$busqueda%' OR 
                        duiusuario LIKE '%$busqueda%'
                    )
                    AND estadousuario = $estado
                    
                ");
                return $this->db->rowCount();

            }else{

                $this->db->query("SELECT * FROM usuarios WHERE estadousuario = $estado");
                return $this->db->rowCount();

            }

            


        }

        
        public function usuariosPorLimite($pos_pagina, $desde, $busqueda = null, $estado = '2'){

            if ($busqueda != null && strpos($busqueda, ' ')) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);

                $this->db->query(
                    "SELECT * FROM usuarios
                    WHERE( LOWER(CONCAT(nombreusuario,apellidousuario)) LIKE '$busqueda' OR
                    LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                    )
                    AND estadousuario = $estado
                    LIMIT $desde, $pos_pagina
                    -- ORDER BY nombreusuario DESC
                    ");
                return $this->db->registers();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
            
                $this->db->query(
                    "SELECT SQL_CALC_FOUND_ROWS * FROM usuarios
                    WHERE(
                        idusuario LIKE '%$busqueda%' OR 
                        LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                        LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                        LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                        telefonousuario LIKE '%$busqueda%' OR 
                        duiusuario LIKE '%$busqueda%' 
                    )
                    AND estadousuario = $estado
                    LIMIT $desde, $pos_pagina
                -- ORDER BY nombreusuario DESC
                    ");
 
                    return $this->db->registers();
            }else{

                $this->db->query("SELECT * FROM usuarios WHERE estadousuario = $estado LIMIT $desde, $pos_pagina ");
                
                return $this->db->registers();
                
            }

        }
        
        public function  usuariosPorLimiteBusqueda($pos_pagina, $desde, $busqueda){

            if (strpos($busqueda, ' ') == true) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);

                $this->db->query(
                    "SELECT * FROM usuarios
                    WHERE( LOWER(CONCAT(nombreusuario,apellidousuario)) LIKE '$busqueda' OR
                    LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                    )
                    AND estadousuario = 1
                    LIMIT $desde, $pos_pagina
                    -- ORDER BY nombreusuario DESC
                    ");
                return $this->db->registers();
                
            }
            
            $this->db->query(
                "SELECT SQL_CALC_FOUND_ROWS * FROM usuarios
                WHERE(
                    idusuario LIKE '%$busqueda%' OR 
                    LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                    LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                    LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                    telefonousuario LIKE '%$busqueda%' OR 
                    duiusuario LIKE '%$busqueda%' 
                )
                AND estadousuario = 1
                LIMIT $desde, $pos_pagina
                -- ORDER BY nombreusuario DESC
                ");
 
            return $this->db->registers();
        }
        
        public function numeroRegistrosBusqueda($busqueda){

            if (strpos($busqueda, ' ') == true) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);

                $this->db->query(
                    "SELECT * FROM usuarios
                    WHERE( LOWER(CONCAT(nombreusuario,apellidousuario)) LIKE '$busqueda' OR
                    LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                    )
                    AND estadousuario = 1");
                return $this->db->rowCount();
                
            }

            $this->db->query(
                "SELECT * FROM usuarios
                 WHERE(
                    idusuario LIKE '%$busqueda%' OR 
                    LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                    LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                    LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                    telefonousuario LIKE '%$busqueda%' OR 
                    duiusuario LIKE '%$busqueda%'
                )
                AND estadousuario = 1
                
            ");
            return $this->db->rowCount();
        }

        // obteniendo todos los registros
        public function obtenerUsuarios(){

            $this->db->query("SELECT * FROM usuarios");

            return $this->db->registers();
        }
        
        public function optenerUsuriosPost($inicio, $numeroPaginas){
            
            $this->db->query("SELECT SQL_CALC_FOUND_ROWS * FROM usuarios WHERE estadousuario = 1 LIMIT $inicio , $numeroPaginas");
            return $this->db->registers();

        }

        public function TotalPaginacion(){
            $this->db->query("SELECT * FROM usuarios WHERE estadousuario = 1");
            return $this->db->rowCount();
        }

        public function TotalPaginacionUsuariosBusquedaNombre($busqueda){
     
            $this->db->query(
                "SELECT * FROM usuarios 
                WHERE (LOWER(CONCAT(nombreusuario,' ',apellidousuario)) LIKE '$busqueda' OR
                LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                )
                AND estadousuario = 1     
            ");
            return $this->db->rowCount();

        }
        
        public function obtnerUsuariosBusquedaNombre($busqueda, $inicio, $numeroPaginas){
            $this->db->query(
                "SELECT * FROM usuarios
                WHERE( LOWER(CONCAT(nombreusuario,apellidousuario)) LIKE '$busqueda' OR
                LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                )
                AND estadousuario = 1
                LIMIT $inicio, $numeroPaginas
                -- ORDER BY nombreusuario DESC
                ");
            return $this->db->registers();
        }


        public function TotalPaginacionUsuariosBusquedaNombreDes($busqueda){
            
            $this->db->query(
                "SELECT * FROM usuarios 
                WHERE (LOWER(CONCAT(nombreusuario,' ',apellidousuario)) LIKE '$busqueda' OR
                LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                )
                AND estadousuario = 2     
            ");
            return $this->db->rowCount();

        }
        
        public function obtnerUsuariosBusquedaNombreDes($busqueda, $inicio, $numeroPaginas){
            $this->db->query(
                "SELECT * FROM usuarios
                WHERE( LOWER(CONCAT(nombreusuario,apellidousuario)) LIKE '$busqueda' OR
                LOWER(CONCAT(apellidousuario,' ',nombreusuario)) LIKE '$busqueda'
                )
                AND estadousuario = 2
                LIMIT $inicio, $numeroPaginas
                -- ORDER BY nombreusuario DESC
                ");
            return $this->db->registers();
        }



        public function obtnerUsuariosBusqueda($busqueda, $inicio, $numeroPaginas){

            $this->db->query(
                "SELECT SQL_CALC_FOUND_ROWS * FROM usuarios
                WHERE(
                    idusuario LIKE '%$busqueda%' OR 
                    LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                    LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                    LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                    telefonousuario LIKE '%$busqueda%' OR 
                    duiusuario LIKE '%$busqueda%' 
                )
                AND estadousuario = 1
                LIMIT $inicio, $numeroPaginas
                -- ORDER BY nombreusuario DESC
                ");

              
            return $this->db->registers();
        }
        
        /* --------------------------------------------------------------------------------------------------------------------------------- */
        public function obtenerUsuario1($id, $estado = '2'){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();
            $this->db->query(
                "SELECT idusuario,
                nombreusuario,
                apellidousuario,
                direccionusuario,
                telefonousuario,
                duiusuario,
                sexousuario,
                fechanacimientousuario,
                estadousuario,
                username,
                idtipousuario,
                DATE_FORMAT(fechamodusuario, 'ultima modificación %W %d de %M del %Y a las %H:%i') as fechamod,
                DATE_FORMAT(fecharegistro, 'Fecha en que se registro %W %d de %M del %Y') as fecharegistro,
                usermod 
            FROM usuarios 
            WHERE idusuario = :id and estadousuario = $estado");
            $this->db->bind(':id', $id);
            return $this->db->register();
        }
        public function obtenerUsuario($id, $estado = '2'){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();
            $this->db->query(
                "SELECT idusuario,
                nombreusuario,
                apellidousuario,
                direccionusuario,
                telefonousuario,
                duiusuario,
                sexousuario,
                fechanacimientousuario,
                estadousuario,
                username,
                idtipousuario,
                DATE_FORMAT(fechamodusuario, 'ultima modificación %W %d de %M del %Y a las %H:%i') as fechamod,
                fecharegistro
            FROM usuarios 
            WHERE idusuario = :id and estadousuario = $estado");
            $this->db->bind(':id', $id);
            return $this->db->register();
        }
        /* --------------------------------------------------------------------------------------------------------------------------------- */

        public function TotalPaginacionUsuariosBusqueda($busqueda){
            $this->db->query(
                "SELECT * FROM usuarios
                 WHERE(
                    idusuario LIKE '%$busqueda%' OR 
                    LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                    LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                    LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                    telefonousuario LIKE '%$busqueda%' OR 
                    duiusuario LIKE '%$busqueda%'
                )
                AND estadousuario = 1
                
            ");
            return $this->db->rowCount();
        }
        
        /*--------------------------------------------------------------------------------------------------------------------------------------*/
        public function desactivar($id){
            $this->db->query("UPDATE usuarios
                            SET estadousuario  = 2
                            WHERE idusuario = :id
                            AND estadousuario = 1");
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        }
        /*--------------------------------------------------------------------------------------------------------------------------------------*/
        /*--------------------------------------------------------------------------------------------------------------------------------------*/
        public function activar($id){
            $this->db->query("UPDATE usuarios
                            SET estadousuario  = 1
                            WHERE idusuario = :id
                            AND estadousuario = 2");
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        }
        /*--------------------------------------------------------------------------------------------------------------------------------------*/
        public function obtenerUsuariosFiltroDes($fechanacimiento, $fecharegistro, $tipousario, $sexo, $inicio, $numeroPaginas){

            $sexo = ($sexo) != ''? 'sexousuario  = '.$sexo:'';
            $tipousario = ($tipousario) != ''? ' AND idtipousuario = '.$tipousario:'';
            $fechanacimiento = ($fechanacimiento ) != ''? ' AND fechanacimientousuario = '.implode(explode('-',$fechanacimiento)): '';
            $fecharegistro = ($fecharegistro) != ''? ' AND fecharegistro = '.implode(explode('-',$fecharegistro)):'';
            $consulta = $sexo.$tipousario.$fechanacimiento.$fecharegistro;

            $this->db->query(
                "SELECT * FROM usuarios
                WHERE($consulta)
                AND estadousuario = 2
                LIMIT $inicio, $numeroPaginas
                -- ORDER BY nombreusuario DESC
                ");
            return $this->db->registers();

        }
        public function obtenerUsuariosFiltro($fechanacimiento, $fecharegistro, $tipousario, $sexo, $inicio, $numeroPaginas){
            $sexo = ($sexo) != ''? 'sexousuario  = '.$sexo:'';
            $tipousario = ($tipousario) != ''? ' AND idtipousuario = '.$tipousario:'';
            $fechanacimiento = ($fechanacimiento ) != ''? ' AND fechanacimientousuario = '.implode(explode('-',$fechanacimiento)): '';
            $fecharegistro = ($fecharegistro) != ''? ' AND fecharegistro = '.implode(explode('-',$fecharegistro)):'';
            $consulta = $sexo.$tipousario.$fechanacimiento.$fecharegistro;

            $this->db->query(
                "SELECT * FROM usuarios
                WHERE($consulta)
                AND estadousuario = 1
                LIMIT $inicio, $numeroPaginas
                -- ORDER BY nombreusuario DESC
                ");
            return $this->db->registers();
        }
        public function totalPaginacionFiltroDes($fechanacimiento, $fecharegistro, $tipousario, $sexo){
            $sexo = ($sexo) != ''? 'sexousuario  = '.$sexo:'';
            $tipousario = ($tipousario) != ''? ' AND idtipousuario = '.$tipousario:'';
            $fechanacimiento = ($fechanacimiento ) != ''? ' AND fechanacimientousuario = '.implode(explode('-',$fechanacimiento)): '';
            $fecharegistro = ($fecharegistro) != ''? ' AND fecharegistro = '.implode(explode('-',$fecharegistro)):'';
            $consulta = $sexo.$tipousario.$fechanacimiento.$fecharegistro;
            $this->db->query(
                "SELECT * FROM usuarios
                WHERE($consulta)
                AND estadousuario = 2
                -- ORDER BY nombreusuario DESC
                ");
            return $this->db->rowCount();
        }
        public function totalPaginacionFiltro($fechanacimiento, $fecharegistro, $tipousario, $sexo){

            $sexo = ($sexo) != ''? 'sexousuario  = '.$sexo:'';
            $tipousario = ($tipousario) != ''? ' AND idtipousuario = '.$tipousario:'';
            $fechanacimiento = ($fechanacimiento ) != ''? ' AND fechanacimientousuario = '.implode(explode('-',$fechanacimiento)): '';
            $fecharegistro = ($fecharegistro) != ''? ' AND fecharegistro = '.implode(explode('-',$fecharegistro)):'';
            $consulta = $sexo.$tipousario.$fechanacimiento.$fecharegistro;
            $this->db->query(
                "SELECT * FROM usuarios
                WHERE($consulta)
                AND estadousuario = 1
                -- ORDER BY nombreusuario DESC
                ");
            return $this->db->rowCount();

        }
        public function TotalPaginacionUsuariosBusquedaDes($busqueda){
            $this->db->query(
                "SELECT * FROM usuarios
                 WHERE(
                    idusuario LIKE '%$busqueda%' OR 
                    LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                    LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                    LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                    telefonousuario LIKE '%$busqueda%' OR 
                    duiusuario LIKE '%$busqueda%'
                )
                AND estadousuario = 2
                
            ");
            return $this->db->rowCount();
        }

        public function obtnerPaginacionUsuariosBusquedaDes($busqueda, $inicio, $numeroPaginas){
            $this->db->query(
                "SELECT SQL_CALC_FOUND_ROWS * FROM usuarios
                WHERE(
                    idusuario LIKE '%$busqueda%' OR 
                    LOWER(nombreusuario) LIKE '%$busqueda%' OR 
                    LOWER(apellidousuario) LIKE '%$busqueda%' OR 
                    LOWER(direccionusuario) LIKE '%$busqueda%' OR 
                    telefonousuario LIKE '%$busqueda%' OR 
                    duiusuario LIKE '%$busqueda%' 
                )
                AND estadousuario = 2
                LIMIT $inicio, $numeroPaginas
                -- ORDER BY nombreusuario DESC
                ");

              
            return $this->db->registers();
        }

        public function optenerUsuriosPostDes($inicio, $numeroPaginas){
            $this->db->query("SELECT SQL_CALC_FOUND_ROWS * FROM usuarios WHERE estadousuario = 2 LIMIT $inicio , $numeroPaginas");
            return $this->db->registers();
        }

        public function TotalPaginacionDes(){
            $this->db->query("SELECT * FROM usuarios WHERE estadousuario = 2");
            return $this->db->rowCount();
        }

    }
?>