<?php

class Login extends MainController
{
	
	

	public function index(){
		// $this->model("IndexModel");

		$parameters = ['title' => 'Bienvenidos a mi sitio web'];

		$this->view("login/index", $parameters);
	}
}

?>