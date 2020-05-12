<?php

class Usuarios extends MainController
{
	
	function __construct()
	{
		// para probar ponemos sesionStart aca
		session_start();
		// ModeloUsuarios es donde estan todas las consultas cpn la base de datos
		 $this->ModeloUsuarios = $this->model('ModeloUsuarios');
	}

	public function nuevoUsuario(){

		$parameters = [
			'menu' => 'usuarios',
			'title' => 'Nuevo Usuario',
		];
		$this->view('usuarios/nuevo_usuario', $parameters);

	}
	public function index(){
	
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

	public function usuariosDesactivados(){
		
		$rutaContrBusqueda = ROUTE_URL.'/usuarios/usuariosDesactivados';
		$busqueda = null;
		$usuario = null;
		$idActivar = null;
		// // numero de registros a mostrar por pagina
		$cantElementPorPag = 11;
		$realizado = false;
		//Para activar un registro
		if(isset($_GET['activar']) and $_GET['activar'] != 0){
			$idActivar = $_GET['activar'];
						
			$usuario = $this->ModeloUsuarios->obtenerUsuario($idActivar);

			if (!$usuario) {
				header("location:".ROUTE_URL."/usuarios/usuariosDesactivados");
			}
			//recarga a la pagina inicial si se activo el ultimo registro de la paginacion
			

		}elseif (isset($_GET['id']) and $_GET['id'] != 0) {
			
			$this->ModeloUsuarios->activar($_GET['id']);
			$realizado = true;
		
		}
			
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['busqueda']) and $_POST['busqueda'] != '')  {
			
		
			$busqueda = sanitize(strtolower($_POST['busqueda']));

		}
		elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['busqueda']) and $_GET['busqueda'] != '') {

			$busqueda = sanitize(strtolower($_GET['busqueda']));

		}

		$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

		// // guardando ultimo registro de cada pagina
		$inicio = ($pagina > 1) ? ($pagina * $cantElementPorPag - $cantElementPorPag) : 0;

		if ($busqueda != null) {
			
			// // Verificando si existe algun espacio dentro de la busqueda
			//tipo de busqueda nombre y apellido, apellido y nombre
				if (strpos($busqueda, ' ') == true) {
				
					$busquedaNombre = explode(' ', $busqueda);
					
			// 		// agregando los %% a cada elemento del arreglo
					for($i = 0; $i < count($busquedaNombre); $i++){
						$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
					}
			// 		// convirtiendo el arreglo a str
					$busquedaNombre = implode($busquedaNombre);
					
					
					$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusquedaNombreDes($busquedaNombre);
	
					$usuarios = $this->ModeloUsuarios->obtnerUsuariosBusquedaNombreDes($busquedaNombre, $inicio, $cantElementPorPag);
			
				}
				//tipo de busqueda nombre o apellido
				else {
					
					$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusquedaDes($busqueda);
	
					$usuarios = $this->ModeloUsuarios->obtnerPaginacionUsuariosBusquedaDes($busqueda, $inicio, $cantElementPorPag);
	
				}
		}
		//todos los registros sin busqueda
		else{
				
				//obteniendo el total de registros de la tablacantElementPorPag
			$totalArticulos = $this->ModeloUsuarios->TotalPaginacionDes();
			
				//obteniendo rango de registro por pagina son los registros
			$usuarios = $this->ModeloUsuarios->optenerUsuriosPostDes($inicio, $cantElementPorPag);
				
		}
	
		$numeroPaginas = ceil($totalArticulos / $cantElementPorPag);

		// obtener formato de edad de 1990-04-19 a 30
			$usuarios = formatoEdad($usuarios);

		// // obtener numeracion de registros
		$numeroFinalRegistro = ($pagina + 1) * $cantElementPorPag - $cantElementPorPag;
		$numeroRegistro = range($inicio, $numeroFinalRegistro);

		// si no encuentra ningun usuario se va a la pagina principal
		if (isset($_GET['id']) and $_GET['id'] != 0) {
			
			if (count($usuarios) == 0) {
				$parameters = [
					"title" => "Usuarios-inactivos",
					"menu" => "usuarios",
					"usuarios" => $usuarios,
					"numeroPaginas" => $numeroPaginas,
					"pagina" => $pagina,
					"numeroRegistro" => $numeroRegistro,
					"busqueda" => $busqueda,
					"rutaContrBusqueda" => $rutaContrBusqueda,
					"usuario" => $usuario,
					"idActivar"=> $idActivar,
					"totalArticulos" => $totalArticulos,
					'realizado' => $realizado
					
				];
				$this->view("usuarios/usuariosDesactivados", $parameters);
			}
		}
		
		$parameters = [
			"title" => "Usuarios-inactivos",
			"menu" => "usuarios",
			"usuarios" => $usuarios,
			"numeroPaginas" => $numeroPaginas,
			"pagina" => $pagina,
			"numeroRegistro" => $numeroRegistro,
			"busqueda" => $busqueda,
			"rutaContrBusqueda" => $rutaContrBusqueda,
			"usuario" => $usuario,
			"idActivar"=> $idActivar,
			"totalArticulos" => $totalArticulos,
			'realizado' => $realizado
			
		];
		
		$this->view("usuarios/usuariosDesactivados", $parameters);
	}
}

?>