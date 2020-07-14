<?php

class Usuarios extends MainController
{
	
	function __construct()
	{
		// para probar ponemos sesionStart aca
		sessionAdmin();
		// ModeloUsuarios es donde estan todas las consultas cpn la base de datos
		 $this->ModeloUsuarios = $this->model('ModeloUsuarios');
	}

	public function verUsuario($id, $estado){

		$usuario = $this->ModeloUsuarios->obtenerUsuario1($id, $estado);	
		
		
		$parameters = [

			'error' => FALSE,
			'mensaje' => 'No se admite editar usuario',		
			'menu' => 'usuarios',
			'usuario' => $usuario
		];
		$this->view('usuarios/ver_usuario', $parameters);
	}
	public function actualizarUsuario($id, $fecharegistro = null){

		
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$errores['nombre'] = validaNombre(((isset($_POST['nombre'])) ? $_POST['nombre'] : null), 'nombre');	
			$errores['apellido'] = validaNombre(((isset($_POST['apellido'])) ? $_POST['apellido'] : null), 'apellido');
			$errores['fechaNacimiento'] = validafecha(((isset($_POST['fechaNacimiento'])) ? $_POST['fechaNacimiento'] : null), 'fechaNacimiento');
			$errores['dui'] = validaDui(((isset($_POST['dui'])) ? $_POST['dui'] : null), 'dui');
			$errores['telefono'] = validatelefono(((isset($_POST['telefono'])) ? $_POST['telefono'] : null), 'telefono');
			$errores['direccion'] = validaStr(((isset($_POST['direccion'])) ? $_POST['direccion'] : null), 'direccion');
			$errores['usuario'] = validaStr(((isset($_POST['usuario'])) ? $_POST['usuario'] : null), 'usuario');
			$errores['pass'] = validaPassword($_POST['password1'], $_POST['password2'], 'pass');
			$errores['sexousuario'] = $_POST['genero'];
			$errores['idtipousuario'] = $_POST['tipoUsario'];

			if($errores['nombre']['rnombre'] != '' || $errores['apellido']['rapellido'] != '' || $errores['fechaNacimiento']['rfechaNacimiento'] != '' || $errores['dui']['rdui'] != '' || $errores['telefono']['rtelefono'] != '' || $errores['direccion']['rdireccion'] != '' || $errores['usuario']['rusuario'] != '' || $errores['pass']['rpass']){
				$parameters = [

					'error' => TRUE,
					'mensaje' => 'Revise los campos de entrada',
					'errores' => $errores,
					'menu' => 'usuarios',
					'usuario' => [$id, $fecharegistro],

				];
				
				$this->view('usuarios/actualizar_usuario', $parameters);
			}else{

					if ( !$this->ModeloUsuarios->obtenerUsuario($id, '1')) {

						$errores['pass']['pass'] = '';
						$parameters = [

							'error' => TRUE,
							'mensaje' => 'Este registro ya no existe',
							'errores' => $errores,
							'menu' => 'usuarios',
	
						];
						
						$this->view('usuarios/actualizar_usuario', $parameters);
					
					}

					if ($this->ModeloUsuarios->actualizarUsuario($id, $errores, $fecharegistro, $_SESSION['user']->username)) {

						$errores['pass']['pass'] = '';

						$parameters = [

							'error' => FALSE,
							'mensaje' => 'Se actualizo el registro',
							'menu' => 'usuarios',
							'errores' => $errores,
							'menu' => 'usuarios',
	
						];
						$this->view('usuarios/actualizar_usuario', $parameters);

					}else{
						echo 'No se puedo actualizar el registro el registro';
						die();
					}
			}
		}else{
		
		$user = $this->ModeloUsuarios->obtenerUsuario($id, '1');
		
		$errores['nombre'] = validaNombre( $user->nombreusuario, 'nombre');	
		$errores['apellido'] = validaNombre($user->apellidousuario, 'apellido');
		$errores['fechaNacimiento'] = validafecha($user->fechanacimientousuario, 'fechaNacimiento');
		$errores['dui'] = validaDui($user->duiusuario, 'dui');
		$errores['telefono'] = validatelefono($user->telefonousuario, 'telefono');
		$errores['direccion'] = validaStr($user->direccionusuario, 'direccion');
		$errores['usuario'] = validaStr($user->username, 'usuario');
		$errores['pass'] = validaPassword( '', '', 'pass');
		$errores['sexousuario'] = $user->sexousuario;
		$errores['idtipousuario'] = $user->idtipousuario;
		$errores['pass']['rpass'] = '';

		$parameters = [

			'error' => 2,
			'mensaje' => 'Edite los campos de entrada',
			'errores' => $errores,
			'menu' => 'usuarios',
			'usuario' => [$user->idusuario, $user->fecharegistro],
		];
		
		
		$this->view('usuarios/actualizar_usuario', $parameters);
		}
	}

	public function nuevoUsuario(){

		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {


			$data = $this->ModeloUsuarios->set_datos($_POST);
			
				$errores['nombre'] = validaNombre($data->nombreusuario, 'nombre');
				$errores['apellido'] = validaNombre($data->apellidousuario, 'apellido');
				$errores['fechaNacimiento'] = validafecha($data->fechanacimientousuario, 'fechaNacimiento');
				$errores['dui'] = validaDui($data->duiusuario, 'dui');
				$errores['telefono'] = validatelefono($data->telefonousuario, 'telefono');
				$errores['direccion'] = validaStr($data->direccionusuario, 'direccion');
				$errores['usuario'] = validaStr($data->username, 'usuario');
				$errores['pass'] = validaPassword($data->password, $_POST['password2'], 'pass');
				$errores['sexousuario'] = $data->sexousuario;
				$errores['idtipousuario'] = $data->idtipousuario;
				
				$data->nombreusuario = $errores['nombre']['nombre'];	
				$data->apellidousuario = $errores['apellido']['apellido'];
				$data->password = $errores['pass']['pass'];
				$data->duiusuario = $errores['dui']['dui'];
				$data->username = $errores['usuario']['usuario'];

				
				if($errores['nombre']['rnombre'] != '' || $errores['apellido']['rapellido'] != '' || $errores['fechaNacimiento']['rfechaNacimiento'] != '' || $errores['dui']['rdui'] != '' || $errores['telefono']['rtelefono'] != '' || $errores['direccion']['rdireccion'] != '' || $errores['usuario']['rusuario'] != '' || $errores['pass']['rpass']){
					
					$parameters = [

						'error' => TRUE,
						'mensaje' => 'Revise los campos de entrada',
						'errores' => $errores,
						'menu' => 'usuarios',
						'data' => $data

					];
				
					$this->view('usuarios/nuevo_usuario', $parameters);
				}else{
					
					$dui = $this->ModeloUsuarios->busquedaDui($data->duiusuario);
					$username = $this->ModeloUsuarios->busquedausuario($data->username);

					if ($dui > 0 || $username > 0) {
						if ($username > 0) {
							$errores['usuario']['rusuario'] = 'Este usuario ya se existe';
							$errores['usuario']['mensaje'] = 'error';
							$errores['pass']['pass'] = '';
						}

						if ($dui > 0) {
							$errores['dui']['rdui'] = 'Este DUI ya se registro';
							$errores['dui']['mensaje'] = 'error';
							$errores['pass']['pass'] = '';
						}
						
						$parameters = [

							'error' => TRUE,
							'mensaje' => 'Hay errores en el envio de informacion',
							'errores' => $errores,
							'menu' => 'usuarios',
							'data' => $data
	
						];
						
						$this->view('usuarios/nuevo_usuario', $parameters);
					
					}

					if ($this->ModeloUsuarios->nuevousuario($data, $_SESSION['user']->username)) {

						$parameters = [

							'error' => FALSE,
							'mensaje' => 'Se guardo el registro',
							'menu' => 'usuarios',
							'errores' => [],
						];
						$this->view('usuarios/nuevo_usuario', $parameters);

					}else{
						echo 'No se puedo guardar el registro';
						die();
					}

				}
					
		}

		$parameters = [
			'error' => FALSE,
			'mensaje' => 'Complete los campos para realizar el registro.',
			'menu' => 'usuarios',
			'title' => 'Nuevo Usuario',
			'menu' => 'usuarios',
			'errores' => [],
		];
		$this->view('usuarios/nuevo_usuario', $parameters);

	}
	public function usuarios(){
		
		if (isset($_GET['eliminar'])) {
			
			echo $_GET['Eliminar'];
		}
		// ruta de este controllador para manejar la busqueda
		$rutaContrBusqueda = ROUTE_URL.'/usuarios';
		$busqueda = null;
		//variable que optiene el id del registro a eliminar
		$idEliminar = null;
		$usuario = null;
		$realizado = false;
							
		//Para eliminar un registro
		if(isset($_GET['eliminar']) and $_GET['eliminar'] != 0){
			$idEliminar = $_GET['eliminar'];
			$usuario = $this->ModeloUsuarios->obtenerUsuario($idEliminar);
			if (!$usuario) {
				header("location:".ROUTE_URL."usuarios/index");
			}
		}elseif (isset($_GET['id']) and $_GET['id'] != 0) {
			
			$this->ModeloUsuarios->desactivar($_GET['id']);
			$realizado = true;
		}

		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['busqueda']) and $_POST['busqueda'] != '')  {
			
		
			$busqueda = sanitize(strtolower($_POST['busqueda']));

		}
		elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['busqueda']) and $_GET['busqueda'] != '') {

			$busqueda = sanitize(strtolower($_GET['busqueda']));

		}

		$cantElementPorPag = 10;

		$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	
		$inicio = ($pagina > 1) ? $pagina * $cantElementPorPag - $cantElementPorPag : 0;

		if ($busqueda != null) {
			
		// // Verificando si existe algun espacio dentro de la busqueda
			if (strpos($busqueda, ' ') == true) {
				
				$busquedaNombre = explode(' ', $busqueda);
				
		// 		// agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		// 		// convirtiendo el arreglo a str
				$busquedaNombre = implode($busquedaNombre);
				
				$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusquedaNombre($busquedaNombre);

				$usuarios = $this->ModeloUsuarios->obtnerUsuariosBusquedaNombre($busquedaNombre, $inicio, $cantElementPorPag);
		
			}
			else {
				
				$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusqueda($busqueda);

				$usuarios = $this->ModeloUsuarios->obtnerUsuariosBusqueda($busqueda, $inicio, $cantElementPorPag);

		}
		}
		else{

			//obteniendo rango de registro por pagina son los registros
			$usuarios = $this->ModeloUsuarios->optenerUsuriosPost($inicio, $cantElementPorPag);
			
			//obteniendo el total de registros de la tabla
			$totalArticulos = $this->ModeloUsuarios->TotalPaginacion();
		}

		// obtener formato de edad de 1990-04-19 a 30
		$usuarios = formatoEdad($usuarios);

		// Numero de paginas
		$numeroPaginas = ceil($totalArticulos / $cantElementPorPag);

		//rango final para el id
		$finNumId =  ($pagina + 1) * $cantElementPorPag - $cantElementPorPag;

		//capturando los rangos del id
		$numIds = range($inicio, $finNumId);

		// si no encuentra ningun usuario se va a la pagina principal
			
		if (isset($_GET['id']) and $_GET['id'] != 0) {
			
			if (count($usuarios) == 0) {
			
				$parameters = [
					//numero de paginas para la paginacion
					'numeroPaginas' => $numeroPaginas,
					'numIds' => $numIds,
					'menu' => 'usuarios',
					'title' => 'UCSF',
					'usuario' => $usuario,
					'usuarios' => $usuarios,
					'pagina' => $pagina,
					'busqueda' => $busqueda,
					'rutaContrBusqueda' => $rutaContrBusqueda,
					'totalArticulos' => $totalArticulos,
					'idEliminar' => $idEliminar,
					'realizado' => $realizado
				];
		
				$this->view('usuarios/index', $parameters);
			}
		}
		
	
		$parameters = [
			//numero de paginas para la paginacion
			'numeroPaginas' => $numeroPaginas,
			'numIds' => $numIds,
			'menu' => 'usuarios',
			'title' => 'UCSF',
			'usuario' => $usuario,
			'usuarios' => $usuarios,
			'pagina' => $pagina,
			'busqueda' => $busqueda,
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'totalArticulos' => $totalArticulos,
			'idEliminar' => $idEliminar,
			'realizado' => $realizado
		];

		$this->view('usuarios/index', $parameters);

	
}

	public function usuariosDesactivados($pagina = 1, $id = 0, $idE = 0, $busqueda = null, $pos_pagina = 5){
		
		$rutaContrBusqueda = ROUTE_URL.'/usuarios/usuariosDesactivados';
		$usuario = null;
		$usuarios = null;

		if ($id > 0 && $this->ModeloUsuarios->obtenerUsuario($id)) {
			
			$usuario = $this->ModeloUsuarios->obtenerUsuario($id);	

		}
		if ($idE == 1 && $this->ModeloUsuarios->obtenerUsuario($id)) {
			
			$this->ModeloUsuarios->activar($id);
			$usuario = null;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}

		$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros($busqueda, '2');

		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde'], $busqueda, '2');
			$usuarios = formatoEdad($usuarios);
		}

			$parameters = [

				'respuesta' => $respuesta,
				'usuarios' => $usuarios,
				'usuario' => $usuario,
				'menu' => 'usuarios',
				'rutaContrBusqueda' => $rutaContrBusqueda,
				'busqueda' => $busqueda,

			];


		$this->view('usuarios/usuariosDesactivados', $parameters);
	}

	public function index($pagina = 1, $id = 0, $idE = 0, $busqueda = null, $pos_pagina = 5){


		$rutaContrBusqueda = ROUTE_URL.'/usuarios/index'; 
		$usuario = null;
		$usuarios = null;

		// die();
		if ($id > 0 && $this->ModeloUsuarios->obtenerUsuario($id, '1')) {
			
			$usuario = $this->ModeloUsuarios->obtenerUsuario($id, '1');	

		}
		if ($idE == 1 && $this->ModeloUsuarios->obtenerUsuario($id, '1')) {
			
			$this->ModeloUsuarios->desactivar($id);
			$usuario = null;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}

		$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros($busqueda, '1');

		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde'], $busqueda, '1');
			$usuarios = formatoEdad($usuarios);
		}

			$parameters = [

				'respuesta' => $respuesta,
				'usuarios' => $usuarios,
				'usuario' => $usuario,
				'menu' => 'usuarios',
				'rutaContrBusqueda' => $rutaContrBusqueda,
				'busqueda' => $busqueda,

			];


		$this->view('usuarios/usuarios', $parameters);
		// $rutaContrBusqueda = ROUTE_URL.'/usuarios/index'; 

		// echo "estoy aca"; 
		// // $busqueda = null;

		// if ( $_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['busqueda'] != '' ) { 

		// 	$busqueda = sanitize(strtolower($_POST['busqueda']));	
			
		// }elseif($busqueda != null){

		// 	$busqueda = sanitize(strtolower($busqueda));
			
		// }else{

		// 	//obteniendo el numero total de registros
		// 	$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros();

		// }

		// if ($busqueda != null) {

		// 	$cuantosRegistros = $this->ModeloUsuarios->numeroRegistrosBusqueda($busqueda);
		// 	$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

			
		// 	if ($cuantosRegistros == 0) {
		// 		$error = [];
		// 		$error['error'] = TRUE;
		// 		$parameters = [
		// 			'rutaContrBusqueda' => $rutaContrBusqueda,
		// 			'respuesta' => $respuesta,
		// 			'busqueda' => $busqueda,	
		// 		];

		// 		$this->view('usuarios/usuarios', $parameters);
		// 	}

			
		// }
		// // echo 'Pagina: '.$pagina;
		// // echo ' cuantos Registros: '. $cuantosRegistros;
		// // echo ' Pos Pagina: '. $pos_pagina;
		// //devuelve 
		// /* 
		// 	-"total_paginas"
		// 	-"pagina_actual"
        // 	-"pagina_siguiente"
        // 	-"pagina_anterior"
        // 	-"desde" ====> que seria el limite de registro o hasta donde trae los registros
		// */

		// $respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		
		
		// if ($cuantosRegistros > 0 and $busqueda != null) {
			
		// 	$usuarios = $this->ModeloUsuarios->usuariosPorLimiteBusqueda($pos_pagina, $respuesta['desde'], $busqueda);
					
		// }else{
			
		// 	//traemos los registros para esta pagina
		// 	$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde']);

		// }
		
		
		// //eliminando un campo de la respuesta
		// // unset($respuesta['desde']);
		// $parameters = [
		// 	'respuesta' => $respuesta,
		// 	'usuarios' => $usuarios,
		// 	'menu' => 'usuarios',
		// 	'rutaContrBusqueda' => $rutaContrBusqueda,
		// 	'busqueda' => $busqueda,
		// ];

		
		// $this->view('usuarios/usuarios', $parameters);
	}
	
	public function desactivandoUsuario($pagina = 1, $id = null, $idE = null , $busqueda = '', $pos_pagina = 5){
		$rutaContrBusqueda = ROUTE_URL.'/usuarios';
		$busqueda = str_replace('_', ' ',$busqueda);
		
		// echo 'Desactivando Usuarios: '. $busqueda;
		// die();
		if ($id != null) {
			
			$idEliminar = $id;
			
			$usuario = $this->ModeloUsuarios->obtenerUsuario($idEliminar);
			
			// print_r($usuario);
			// die();
			if (!$usuario) {

				
				$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros();
				$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde']);
				$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);
				$parameters = [

					'respuesta' => $respuesta,
					'usuarios' => $usuarios,
					'menu' => 'usuarios',

				];
				$this->view('usuarios/usuarios', $parameters);
			}
			
		}

		if ($idE != 'borrar') {
			
			$usuario = null;
			$idEliminar = null;
			$this->ModeloUsuarios->desactivar($id);
			
		}
		// $busqueda = null;
		
		
		// echo 'sin nada';
		//obteniendo el numero total de registros
		
		
		
		if ($busqueda != '' ) {
			
			// echo $busqueda;
			// echo $busqueda;
			// die();
			
			$cuantosRegistros = $this->ModeloUsuarios->numeroRegistrosBusqueda($busqueda);
			
			
			// if ($cuantosRegistros == 0) {
				// 	header('location:usuarios/usuarios');
				// }
				// echo $cuantosRegistros;
				// echo 'Cuantos Registros: ' . $cuantosRegistros;
				// die();
			
		}else{
			
			$cuantosRegistros = $this->ModeloUsuarios->numeroRegistros();
		}
		// echo 'Pagina: '.$pagina;
		// echo ' cuantos Registros: '. $cuantosRegistros;
		// echo ' Pos Pagina: '. $pos_pagina;
		//devuelve 
		/* 
			-"total_paginas"
			-"pagina_actual"
        	-"pagina_siguiente"
        	-"pagina_anterior"
        	-"desde" ====> que seria el limite de registro o hasta donde trae los registros
		*/

		$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		// print_r($respuesta);
		// die();
		if ($cuantosRegistros == 0) {
			
			$usuarios = null;

		}elseif ($cuantosRegistros > 0 and $busqueda != '') {
			// echo 'busqueda limite';
			$usuarios = $this->ModeloUsuarios->usuariosPorLimiteBusqueda($pos_pagina, $respuesta['desde'], $busqueda);
			
			// print_r($usuarios);
			// die();
		}else{
			
			// echo 'Solo limite';
			//traemos los registros para esta pagina
			$usuarios = $this->ModeloUsuarios->usuariosPorLimite($pos_pagina, $respuesta['desde']);

		}
		
		
		//eliminando un campo de la respuesta
		// unset($respuesta['desde']);
		$parameters = [
			'respuesta' => $respuesta,
			'usuarios' => $usuarios,
			'menu' => 'usuarios',
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'busqueda' => $busqueda,
			'usuario' => $usuario,
			'idEliminar' => $idEliminar,
		];

		
		$this->view('usuarios/usuarios', $parameters);
	}


}


?>