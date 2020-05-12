<?php

    class ModeloUsuarios{
        
        private $db;

        public function __construct(){

            $this->db = new Sql;
        }

        // obteniendo todos los registros
        public function obtenerUsuarios(){

            $this->db->query("SELECT * FROM usuarios");

            return $this->db->registers();
        }
        
        public function optenerUsuario($id){
            $this->db->query(
                "SELECT nombreusuario, 
                        apellidousuario, 
                        direccionusuario, 
                        telefonousuario, 
                        username , 
                        estadousuario 
                        FROM usuarios 
                        WHERE duiusuario  = :id"
            );
            $this->db->bind(':id', $id);
            return $this->db->register();
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
        public function obtenerUsuario($id){
            $this->db->query("SELECT * FROM usuarios WHERE idusuario = :id");
            $this->db->bind(':id', $id);
            return $this->db->register();
        }
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
        

        public function desactivar($id){
            $this->db->query("UPDATE usuarios
                            SET estadousuario  = 2
                            WHERE idusuario = :id");
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function activar($id){
            $this->db->query("UPDATE usuarios
                            SET estadousuario  = 1
                            WHERE idusuario = :id");
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        }
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

        public function obtenerBusqueda($busqueda){

            // $this->db->query(
            //     "SELECT * FROM 
            //     usuarios 
            //     WHERE 
            //     (LOWER(nombreusuario) LIKE LOWER('%$buscar%')) OR (LOWER(apellidousuario)  LIKE LOWER('%$buscar%'))");
            // return $this->db->registers();

            // $this->db->query(
            //     "SELECT concat(`nombreusuario`, ' ', `apellidousuario`) as nombres FROM `usuarios` WHERE LOWER(nombres) LIKE LOWER('%$buscar%')");
            $this->db->query(
                'SELECT * FROM usuarios
                WHERE(
                    idusuario
                    )
                ');
            return $this->db->registers();
        }
    }
?>