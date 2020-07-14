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

	//index con paginacion hecha por " mi "
	// public function index(){


	// 	$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;


	// 	//Definicendo el numero de paginas a mostrar

	// 	// $postPorPagina = 3;

	// 	$_SESION['postPorPagina'] = isset($_GET['postPorPagina']) ? (int)$_GET['postPorPagina'] : 3;

	// 	// if ($_SESION['postPorPagina'] != 3 and $pagina == 1) {
		
	// 	// 	$_SESION['postPorPaginaFinal'] = $_SESION['postPorPagina'];
	// 	// }
	// 	// if (!isset($_GET['postPorPagina']) and $pagina != 3) {

	// 	// 	$_SESION['postPorPagina'] = $_SESION['postPorPaginaFinal'];
	// 	// }
		
	// 	// print_r($_SESION['postPorPagina']);
	// 	// print_r($_SESION['postPorPaginaFinal']);
		
	// 	$postPorPagina = $_SESION['postPorPagina'];
	// 	$inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0;


	// 	// $usuarios = $this->ModeloUsuarios->obtenerUsuarios();

	// 	$usuarios = $this->ModeloUsuarios->optenerUsuriosPost($inicio, $postPorPagina);

		
		
		
	// 	if (!$usuarios) {
	// 		header('location:'.ROUTE_URL.'/usuarios/index');
	// 	}
		
	// 	$totalArticulos = $this->ModeloUsuarios->TotalPaginacion();
		
	// 	// echo $totalArticulos;
	// 	$numeroPaginas = ceil($totalArticulos / $postPorPagina);
		
	// 	//tamano de las filas totales
	

	// 	$final = ($pagina + 1) * $postPorPagina - $postPorPagina;
		
	// 	$numeroId = range($inicio, $final);

	// 	for ($i=0; $i < count($usuarios); $i++){

	// 		$edad = calcularEdad($usuarios[$i]->fechanacimientousuario);

	// 		$usuarios[$i]->fechanacimientousuario = $edad;

	// 	}

	// 	$parameters = [
	// 		'title' => 'Bienvenidos a mi sitio web',
	// 		'menu' => 'usuarios',
	// 		'pagina' => $pagina,
	// 		'numPag' => $numeroPaginas,
	// 		'usuarios' => $usuarios,
	// 		'numeroId' => $numeroId,
	// 		'postPorPagina' => $postPorPagina
	// 	];
		
	// 	$this->view("usuarios/index", $parameters);
	// }

	// public function editar($id = 1){
	
	// 	$usuario = $this->ModeloUsuarios->optenerUsuario($id);

	// 	if ( !$usuario ) {

	// 		header("location:".ROUTE_URL."/usuarios");
	// 	}
		

	// }

	public function index(){

		// para la busqueda verificansdo si se envio por el metodo POS o GET
		$idEdit = null;
		$idEliminar = null;
		$busqueda = null;
		$usuario = null;
		$fechanacimiento = null;
		$fecharegistro = null;
		$tipousario = null;
		$sexo = null;
	
		// Guardando la busqueda
		if (isset($_GET['busqueda'])) {
			$busqueda = strtolower($_GET['busqueda']);
		}elseif(isset($_POST['busqueda'])){
			$busqueda = strtolower($_POST['busqueda']);
		}
		
		//Para editar
		if (isset($_GET['editar']) and $_GET['editar'] != 0) {

			$idEdit = $_GET['editar'];

			$usuario = $this->ModeloUsuarios->obtenerUsuario($idEdit);

			if (!$usuario) {
				header("location:".ROUTE_URL."usuarios/index");
			}
		}
		//Para eliminar un registro
		elseif(isset($_GET['eliminar']) and $_GET['eliminar'] != 0){
			$idEliminar = $_GET['eliminar'];
			$usuario = $this->ModeloUsuarios->obtenerUsuario($idEliminar);
			if (!$usuario) {
				header("location:".ROUTE_URL."usuarios/index");
			}
		}

		$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

		// numero de registros a mostrar por pagina
		$postPorPagina = 10;

		// guardando ultimo registro de cada pagina
		$inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0;

		//Buscando los registros 
		if (($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') and ($busqueda != null or $busqueda != '')) {
			
			$busqueda = sanitize($busqueda);
			$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusqueda($busqueda);
			$usuarios = $this->ModeloUsuarios->obtnerUsuariosBusqueda($busqueda, $inicio, $postPorPagina);
		
		}
		//filtros de busqueda 
		elseif($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['submit']) || isset($_GET['tipousario']) && $_GET['tipousario'] != ''){
			if ($_GET['sexo'] != '') {
				
				$fechanacimiento = sanitize($_GET['fechanacimiento']);
				$fecharegistro = sanitize($_GET['fecharegistro']);
				$tipousario = sanitize($_GET['tipousario']);
				$sexo = sanitize($_GET['sexo']);	
			}
										 
			$usuarios = $this->ModeloUsuarios->obtenerUsuariosFiltro($fechanacimiento, $fecharegistro, $tipousario, $sexo, $inicio, $postPorPagina);
			$totalArticulos = $this->ModeloUsuarios->totalPaginacionFiltro($fechanacimiento, $fecharegistro, $tipousario, $sexo);
		
		}
		// obteniendo todos los registros 
		else{

			// Registros devueltos para esta pagina 
			$usuarios = $this->ModeloUsuarios->optenerUsuriosPost($inicio, $postPorPagina);

			//obteniendo el total de paginas
			$totalArticulos = $this->ModeloUsuarios->TotalPaginacion();
			
		}
		
		$numeroPaginas = ceil($totalArticulos / $postPorPagina);

		if (!$usuarios) {
			
			$busqueda = 'No hay conincidencias';
		}

		// transformando las fechas a formato de edad 
		for ($i=0; $i < count($usuarios) ; $i++) { 
			
			$edad = calcularEdad($usuarios[$i]->fechanacimientousuario);

			$usuarios[$i]->fechanacimientousuario = $edad;	
		}

		// obtener numeracion de registros
		$numeroFinalRegistro = ($pagina + 1) * $postPorPagina - $postPorPagina;
		$numeroRegistro = range($inicio, $numeroFinalRegistro);
		
		$parameters = [
			"title" => "Usuarios-activos",
			"menu" => "usuarios",
			"usuarios" => $usuarios,
			"numeroPaginas" => $numeroPaginas,
			"pagina" => $pagina,
			"numeroRegistro" => $numeroRegistro,
			"busqueda" => $busqueda,
			"usuario" => $usuario,
			"idEdit" => $idEdit,
			"idEliminar"=> $idEliminar,
			"totalArticulos" => $totalArticulos,
			"fechanacimiento" => $fechanacimiento,
			"fecharegistro" => $fecharegistro,
			"tipousario" => $tipousario,
			"sexo" => $sexo

		];
	
		$this->view("usuarios/usuarios", $parameters);

	}

	public function desactivar($id){
		
		if ($id != 0) { 
		
			$usuario = $this->ModeloUsuarios->desactivar($id);
			if(!$usuario){
				header("location:".ROUTE_URL."/usuarios/usuarios");
			}else{
				header("location:".ROUTE_URL."/usuarios/usuarios");
			}
		}
		
	}

	public function activar($id){
		
		if ($id != 0) { 
		
			$usuario = $this->ModeloUsuarios->activar($id);
			if(!$usuario){
				header("location:".ROUTE_URL."/usuarios/usuariosDesactivados");
			}else{
				header("location:".ROUTE_URL."/usuarios/usuariosDesactivados");
			}
		}
		
	}

	public function editar($id){

		$usuario = $this->ModeloUsuarios->obtenerUsuario($id);

		if (!$usuario) {
			header("location:".ROUTE_URL."usuarios/index");
		}

		$parameters = [
			'menu' => 'usuarios',
			'usuario' => $usuario
		];

		$this->view('usuarios/usuarios', $parameters);
	}

	// public function index(){

	// 	$usuarios = $this->ModeloUsuarios->obtenerUsuarios();

	// 	if (!$usuarios) {
	// 		header('location:'.ROUTE_URL.'/index/index');
	// 	}

	// 	for($i = 0; $i < count($usuarios); $i++){

	// 		$edad = calcularEdad($usuarios[$i]->fechanacimientousuario);

	// 		$usuarios[$i]->fechanacimientousuario = $edad;
	// 	}

	// 	$parameters = [
	// 		'title' => 'Listado de Usuarios',
	// 		'menu' => 'usuarios',
	// 		'usuarios' => $usuarios,
	// 	];

	// 	$this->view("usuarios/index", $parameters);
		

	// }

	public function busqueda(){


		$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

		$postPorPagina = 3;

		$inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0;

		$busqueda = strtolower($_REQUEST['busqueda']);

		if (empty($busqueda)) {
			header("location:".ROUTE_URL."/usuarios");
		}
		
		$usuarios = $this->ModeloUsuarios->obtnerPaginacionUsuariosBusqueda($busqueda, $inicio, $postPorPagina);
		

		if (!$usuarios) {
			$parameters = [
				'title' => 'Bienvenidos a mi sitio web',
				'menu' => 'usuarios',
				'usuarios' => $usuarios,
				'busqueda' => $busqueda
			];
			$this->view("usuarios/busqueda", $parameters);
			// header('location:'.ROUTE_URL.'/usuarios/busqueda');
		}

		$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusqueda($busqueda);

		$numeroPaginas = ceil($totalArticulos / $postPorPagina);

		$final = ($pagina + 1) * $postPorPagina - $postPorPagina;
		
		$numeroId = range($inicio, $final);

	
		$usuarios1 = array();
		for ($i=0; $i < count($usuarios); $i++){

			$edad = calcularEdad($usuarios[$i]->fechanacimientousuario);
			$usuarios[$i]->fechanacimientousuario = $edad;
			
			if(is_numeric($busqueda) && strlen($busqueda) <= 2){
				
				$busqueda = (int)$busqueda;

				echo var_dump($busqueda);
				echo var_dump($edad);
				die();
				if ($edad == $busqueda) {
					$usuarios1 = array_push($usuarios[$i]);
					print_r($usuarios1);
					die();
				}
			}
		}

		
	
		
		$parameters = [
			'title' => 'Bienvenidos a mi sitio web',
			'menu' => 'usuarios',
			'pagina' => $pagina,
			'numPag' => $numeroPaginas,
			'usuarios' => $usuarios,
			'numeroId' => $numeroId,
			'postPorPagina' => $postPorPagina,
			'busqueda' => $busqueda
		];

		$this->view("usuarios/busqueda", $parameters);
	}


	public function usuariosDesactivados(){
		
		$idActivar = null;
		$busqueda = null;
		$usuario = null;
		$fechanacimiento = null;
		$fecharegistro = null;
		$tipousario = null;
		$sexo = null;

		//si se esta haciendo una busqueda
		if (isset($_GET['busqueda'])) {
			$busqueda = strtolower($_GET['busqueda']);
		}elseif(isset($_POST['busqueda'])){
			$busqueda = strtolower($_POST['busqueda']);
		}

		//si se esta reactivando
		if(isset($_GET['activar']) and $_GET['activar'] != 0){
			$idActivar = $_GET['activar'];
			$usuario = $this->ModeloUsuarios->obtenerUsuario($idActivar);
			if (!$usuario) {
				header("location:".ROUTE_URL."usuarios/usuariosDesactivados");
			}
		}
		
		$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

		// numero de registros a mostrar por pagina
		$postPorPagina = 10;

		// guardando ultimo registro de cada pagina
		$inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0;

		//lo que se busca 
		if (($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') and ($busqueda != null or $busqueda != '')) {

			$busqueda = sanitize($busqueda);
	
			$totalArticulos = $this->ModeloUsuarios->TotalPaginacionUsuariosBusquedaDes($busqueda);
			$usuarios = $this->ModeloUsuarios->obtnerPaginacionUsuariosBusquedaDes($busqueda, $inicio, $postPorPagina);
		
		}//filtros de busqueda 
		elseif($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['submit']) || isset($_GET['tipousario']) && $_GET['tipousario'] != ''){
			if ($_GET['sexo'] != '') {
				
				$fechanacimiento = sanitize($_GET['fechanacimiento']);
				$fecharegistro = sanitize($_GET['fecharegistro']);
				$tipousario = sanitize($_GET['tipousario']);
				$sexo = sanitize($_GET['sexo']);	
			}
										 
			$usuarios = $this->ModeloUsuarios->obtenerUsuariosFiltroDes($fechanacimiento, $fecharegistro, $tipousario, $sexo, $inicio, $postPorPagina);
			$totalArticulos = $this->ModeloUsuarios->totalPaginacionFiltroDes($fechanacimiento, $fecharegistro, $tipousario, $sexo);
		
		}
		
		else{

			$usuarios = $this->ModeloUsuarios->optenerUsuriosPostDes($inicio, $postPorPagina);

			$totalArticulos = $this->ModeloUsuarios->TotalPaginacionDes();
			
		}
		
		$numeroPaginas = ceil($totalArticulos / $postPorPagina);

		if (!$usuarios) {
			
			$busqueda = 'No hay conincidencias';
		}

		for ($i=0; $i < count($usuarios) ; $i++) { 
			
			$edad = calcularEdad($usuarios[$i]->fechanacimientousuario);

			$usuarios[$i]->fechanacimientousuario = $edad;	
		}

		// obtener numeracion de registros
		$numeroFinalRegistro = ($pagina + 1) * $postPorPagina - $postPorPagina;
		$numeroRegistro = range($inicio, $numeroFinalRegistro);
		
		$parameters = [
			"title" => "Usuarios-inactivos",
			"menu" => "usuarios",
			"usuarios" => $usuarios,
			"numeroPaginas" => $numeroPaginas,
			"pagina" => $pagina,
			"numeroRegistro" => $numeroRegistro,
			"busqueda" => $busqueda,
			"usuario" => $usuario,
			"idActivar"=> $idActivar,
			"totalArticulos" => $totalArticulos,
			"fechanacimiento" => $fechanacimiento,
			"fecharegistro" => $fecharegistro,
			"tipousario" => $tipousario,
			"sexo" => $sexo
		];

		$this->view("usuarios/usuariosDesactivados", $parameters);
	}
}

?>