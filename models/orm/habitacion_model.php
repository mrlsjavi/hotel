<?php
	error_reporting(E_ERROR | E_PARSE);
	class Habitacion_Model{

		public function __construct(){

				//parent::__construct();

		}

		public function guardar(){
			$info = json_decode($_POST['info']);

			$data = array(
				'id'=>'',
				'motel' => $info->motel,
				'nombre' => $info->nombre,
				'precio' => $info->precio,
				'duracion' => $info->duracion,
				'columna_matriz' => $info->columna_matriz,
				'fila_matriz' => $info->fila_matriz,
				'estado'=>2);


			$habitacion = new habitacion_orm($data);
			try {
				$result = $habitacion->save();
				if($result == null){
					header("HTTP/1.1 505 Internal Error");
					echo json_encode("no se pudo insertar el registro");
					return;
				}
				echo json_encode($result);
			} catch (Exception $e) {
				echo json_encode($e->getMessage());
			}
		}


		public function llenar_tabla(){
			$habitaciones = habitacion_orm::notwhere('estado', 0);

			$tabla = '<table id="habitaciones" class="display" cellspacing="0" width="100%">
					<thead>
							<tr>
									<th>Motel</th>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Duracion</th>
									<th>Columna</th>
									<th>Fila</th>
									<th>Editar</th>
									<th>Eliminar</th>
							</tr>
					</thead>
					<tfoot>
							<tr>
									<th>Motel</th>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Duracion</th>
									<th>Columna</th>
									<th>Fila</th>
									<th>Editar</th>
									<th>Eliminar</th>
							</tr>
					</tfoot>
					<tbody id="promociones_body">
					';

					//validar si hay respuest
					if(is_array($habitaciones) && count($habitaciones) > 0 ){
						foreach ($habitaciones as $h) {
							$tabla  = $tabla."<tr style=\"text-align: center;\">
													<td>".$h->obj_motel->nombre."</td>
													<td>".$h->nombre."</td>
													<td>".$h->precio."</td>
													<td>".$h->duracion."</td>
													<td>".$h->columna_matriz."</td>
													<td>".$h->fila_matriz."</td>
													<td class = 'editar'   id='".$h->id."'>Editar</td>
													<td class = 'eliminar' id='".$h->id."'>Eliminar</td>";
						}
					}


			$tabla = $tabla.'</tbody>
				</table>';
			echo $tabla;
		}


		public function eliminar(){
			$info = json_decode($_POST['info']);

			$result = habitacion_orm::eliminar_logico($info->id);

			echo json_encode($result);
		}

		public function traer_dato(){
			$info = json_decode($_POST['info']);

			$habitacion = habitacion_orm::where("id", $info->id);



			$result = array('cod' => 1, 'datos' => $habitacion);

			echo json_encode($result);
		}

		public function traer_moteles(){
			$info = json_decode($_POST['info']);
			$moteles = motel_orm::where("estado", 1);
			$result = array('cod' => 1, 'datos' => $moteles);
			echo json_encode($result);
		}

		public function actualizar(){
			$info = json_decode($_POST['info']);

			$data = array(
				'id' => $info->id,
				'motel' => $info->motel,
				'nombre' => $info->nombre,
				'precio' => $info->precio,
				'duracion' => $info->duracion,
				'columna_matriz' => $info->columna_matriz,
				'fila_matriz' => $info->fila_matriz,
				'estado'=>2);


			$habitacion = new habitacion_orm($data);

			$result = $habitacion->save();

			echo json_encode($result);
		}

	}
 ?>
