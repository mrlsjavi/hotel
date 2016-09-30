<?php

class Auth{

	public static function handleLogin(){

		@session_start();
		$logged = $_SESSION['loggedIn'];

		if($logged == false){
			Session::destroy();
			header('location: '.URL.'login');
			exit;
		}

	}

	//agregar control menu
	public static function menu(){
		
		$menu = '';
		$general = new general_orm;
		$result = $general::query("select p.id, p.nombre, p.alias 
										from pagina as p join permiso_rol as pr on pr.pagina = p.id 
										where pr.rol = ".Session::get('id_rol')." and pr.estado = 1 and p.estado = 1 
										order by p.orden");		
		$menu = '<ul class="nav"><li><a href="'.URL.'index" style="color:white; font-size: 1.5em; border-bottom: 3px solid white; ">Inicio</a></li>';
		if($result){
			
			foreach($result as $r){
				
				$menu =$menu.'<li><a href="'.URL.$r['nombre'].'" style="color:white; font-size: 1.5em; border-bottom: 3px solid white; ">'.$r['alias'].'</a></li>';
				$menu=$menu.' ';
				
					//$r['id']
					
				
			}
			
			
			//echo '<a href="#" style="color:white; font-size: 1.5em; border-bottom: 3px solid white; ">'.Session::get('id_rol').'</a>';
		}

		else {
			header('location: '.URL.'index');
		}
		$menu = $menu.'<li><a href="'.URL.'dashboard/logout" style="color:white; font-size: 1.5em; border-bottom: 3px solid white; ">Logout</a></li></ul>';
		echo $menu;
	}

	public static function acceso($nombre){
		@session_start();
		$rol = Session::get('id_rol');
		$pagina = trim($nombre);
		$general = new general_orm;
		$result = $general::query("select pr.id 
									from permiso_rol as pr
									join pagina as p on p.id = pr.pagina 
									where p.nombre = '".$pagina."' and p.estado = 1 and pr.estado = 1 
									and rol =".$rol);		
		if(!$result){
			//Session::destroy();
			header('location: '.URL.'index');
			exit;

			
		}
		

	}
}