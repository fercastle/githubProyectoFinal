<?php

class index extends MainController
{
	
	// function __construct()
	// {
	// 	//echo "index ";
	// }

	public function index(){
		// $this->model("IndexModel");

		$parameters = ['title' => 'Bienvenidos a mi sitio web'];

		$this->view("index/index", $parameters);
	}
}

?>