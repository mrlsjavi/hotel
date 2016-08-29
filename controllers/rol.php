<?php

class Rol extends Controller{

	function __construct(){
		parent::__construct(); //llamar el construct del padre que es controller(libs/controller)


		//Auth::handleLogin();

		
		//ya tenogo incluido el jquery y aqui mando a llamar su javascript independiente de cada vista 
		$this->view->js = array('rol/js/default.js');

		
	}

	function index(){
		$this->view->title = 'Rol';
		$this->view->render('header');
		//echo Hash::create('md5', 'test', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test', HASH_PASSWORD_KEY);
		//vista carpeta/archivo
		$this->view->render('rol/index');
		$this->view->render('footer');
	}

	function nuevo(){
		$this->view->js = array('rol/js/nuevo.js');//para que use su propio js

		$this->view->title = 'Rol';
		$this->view->render('header');
		//echo Hash::create('md5', 'test', HASH_PASSWORD_KEY);
		//echo Hash::create('sha256', 'test', HASH_PASSWORD_KEY);
		//vista carpeta/archivo
		$this->view->render('rol/nuevo');
		$this->view->render('footer');

	}

	function guardar(){
		$this->model->guardar();
	}
    


	
}