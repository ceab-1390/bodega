<?php
	//funcion para conectar con postgres
	$conexion = connectar_Bd ("bodega", "postgres", "localhost", "bodega-2");

	if (!$conexion){
		echo "UPS! Error en conexion hacia la base de datos";
	}

	function connectar_Bd ($usuario, $pass, $host, $bd){
		$conexion = pg_connect ("user=".$usuario." ".
		            "password=".$pass." ".
					"host=".$host." ".
					"dbname=".$bd);
	
	return $conexion;
   }
	
	
	function test ($conexion){
	   $tabla='"test"';
	   $test = pg_query ($conexion, "SELECT * FROM $tabla");
	   while ($reg = pg_fetch_array($test)){
		   $test_aux=$reg['test'];
	   }
	   pg_close($conexion);
	   echo "$test_aux";
   }	

	function insertar_en_Cuenta ($conexion, $cliente, $producto, $pago, $cant) {
	//tabla cliente y columna cliente
	$tabla='"cliente"';
	$colum='"cliente"';
	//tabla cuaderno y columnas del cuaderno
	$tabla2='"cuaderno"';
	$colum1='"producto"';
	$colum2='"cliente"';
	$colum3='"pago"';
	//datos obtenidos de el WS
	$Dato1="'$cliente'";
	$Dato2="'$producto'";
	$Dato3="'$pago'";
	$cant = (int) $cant;
	//
	$aux= pg_query ($conexion, "SELECT * FROM $tabla WHERE $colum = $Dato1");
	while ($aux2 = pg_fetch_array($aux)){
		$comp = $aux2['cliente'];
		$id_cliente = $aux2['id_cliente'];
		$Dato4="'$id_cliente'";
	}
	if ($comp == ''){
		echo "Cliente no existe"; 
	}else{
		$insert = pg_query ($conexion, "INSERT INTO $tabla2 ($colum1 , $colum2, $colum3) VALUES ($Dato2,$Dato4,$Dato3)");
		if (!$insert){
			echo "Ha ocurrido un error al insertar los datos! uno de los datos es erroneo...";
		}else{
			echo "Datos cargados con exito!!";
		}
	}
	pg_close ($conexion);
	
	
	
	}

function consulta_cliente($conexion, $cliente, $apellido, $todo){
	$tabla='"cliente"';
	$colum1='"nombre"';
	$colum2='"apellido"';
	//Funcion para generar la vista de un cliente
	$cliente_aux=$cliente;
	if ($todo == 'false'){
	if ($apellido == 'NULL'){
	$registros= pg_query($conexion, "select * from $tabla where  $colum1 = $cliente_aux or $colum2 = $apellido");
	//fin de la funcion
				while ($reg = pg_fetch_array($registros)){
					$cliente_aux_2 = $reg['cliente'];
					$id_cliente = $reg['id_cliente'];
				}
    pg_close($conexion);
				//cliente existe o no existe
				if ($id_cliente == ''){
					$consulta='0';
				}else{
					$consulta='1';
					}
				return $consulta;
				//fin de cliente existe o no
						}else{
						$registros= pg_query($conexion, "select * from $tabla where  $colum1 = $cliente_aux and $colum2 = $apellido");
						while ($reg = pg_fetch_array($registros)){
							$id_cliente = $reg['id_cliente'];
						}
						pg_close($conexion);
						if ($id_cliente == ''){
							$consulta='3';
						}else{
							$consulta='1';
							}
						return $consulta;
						

						}
	}else if ($todo == 'TRUE'){
		$registros= pg_query($conexion, "select * from $tabla");
		//fin de la funcion
					while ($reg = pg_fetch_array($registros)){
						$cliente_aux_2 = $reg['cliente'];
						echo $cliente_aux_2;
						echo ",";
						$id_cliente = $reg['id_cliente'];
					}
	}
}


	function validar_acceso($conexion, $user, $pass){
		$tabla='"usuarios"';
		$colum='"usuario"';
		$colum2='"password"';
		$registros= pg_query($conexion, "SELECT * FROM $tabla WHERE $colum = $user");
			while($reg = pg_fetch_array($registros)){
				$val_user=$reg['usuario'];
				$val_pass=$reg['password'];
			}
			if ($val_user == ''){
				echo "usuario no encontrado";
			}else if("$val_pass" == "$pass"){
					echo "1";
			}else{
				echo "0";
				
			}
			
	}



	function consulta_cliente_lista($conexion, $alias, $cliente){
		$tabla='"cliente"';
		if ($alias == 'NULL'){
			
			$colum1='"nombre"';
			$colum2='"apellido"';
		//Funcion para generar la vista de un cliente
		$cliente_aux=$cliente;
		$cliente_aux= strtoupper ($cliente_aux);
		$registros= pg_query($conexion, "select * from $tabla where  $colum1 = $cliente_aux");
		//fin de la funcion
					while ($reg = pg_fetch_array($registros)){
						$cliente_aux_2 = $reg['nombre'];
						echo $cliente_aux_2;
						echo " ";
						$cliente_aux_2 = $reg['apellido'];
						echo $cliente_aux_2;
						echo ',';
				
					}
		pg_close($conexion);
				}else if ($cliente == 'NULL'){
					$colum1='"cliente"';
					//$colum2='"apellido"';
					//Funcion para generar la vista de un cliente por alias
					$cliente_aux=$alias;
					$registros= pg_query($conexion, "select * from $tabla where  $colum1 = $cliente_aux");
					//fin de la funcion
								while ($reg = pg_fetch_array($registros)){
									$cliente_aux_2 = $reg['nombre'];
									echo $cliente_aux_2;
									echo ",";
									$cliente_aux_2 = $reg['apellido'];
									echo $cliente_aux_2;
									echo ',';
									$cliente_aux_2 = $reg['cedula'];
									echo $cliente_aux_2;
									echo ',';
									$cliente_aux_2 = $reg['telefono'];
									echo $cliente_aux_2;
									echo ',';
									$cliente_aux_2 = $reg['id_cliente'];
									echo $cliente_aux_2;
									echo ',';
							
								}		
				}
	}

	function insertar_Cliente ($conexion, $alias, $nombre, $apellido, $cedula, $telefono, $modificar, $id_cliente, $direccion, $email){
		$tabla='"cliente"';
		$colum1='"alias"';
		$colum2='"nombre"';
		$colum3='"apellido"';
		$colum4='"cedula"';
		$colum5='"telefono"';
		$colum6='"id_cliente"';
		$colum7='"direccion"';
		$colum8='"email"';
		//$alias= $nombre + $apellido;
		//condicion de modificar
		if ($modificar == 'false'){
		$cargarCliente = pg_query($conexion, "INSERT INTO $tabla ($colum1, $colum2, $colum3, $colum4, $colum5, $colum7, $colum8) VALUES ($alias, $nombre, $apellido, $cedula, $telefono, $direccion, $email)" );
		if (!$cargarCliente){
		echo "Error en la carga de datos";
		}else{
			echo "Datos cargados con exito!!!";
		}
		pg_close($conexion);
		}else if ($modificar == 'true'){

				$consulta = pg_query ($conexion, "SELECT * FROM $tabla WHERE $colum6 = $id_cliente");
					while ($reg = pg_fetch_array($consulta)){
						$alias_c = $reg['cliente'];
						$alias_c = "'$alias_c'";
					}
				if ($alias_c == $alias ){
								$cargarCliente = pg_query($conexion, "UPDATE $tabla SET $colum4 = $cedula , $colum5 = $telefono, $colum7 = $direccion, $colum8 = $email WHERE $colum6 = $id_cliente" );
								if (!$cargarCliente){
								echo "Error al actualizar cliente";
								}else{
									echo "Cliente Actualizado con exito";
								}	

				}else {
					$consulta = pg_query ($conexion, "SELECT * FROM $tabla");
						while ($reg = pg_fetch_array($consulta)){
						$alias_c = $reg['cliente'];
						$alias_c = "'$alias_c'";
						$id = $reg['id_cliente'];

						if ($alias_c == $alias and $id_cliente != $id){
							echo "Ya existe un cliente con ese alias";
							$valido = 'false';
						}
					}if ($valido != 'false'){
						$cargarCliente = pg_query($conexion, "UPDATE $tabla SET $colum1 = $alias, $colum2 = $nombre, $colum3 = $apellido, $colum4 = $cedula , $colum5 = $telefono, $colum7 = $direccion, $colum8 = $email WHERE $colum6 = $id_cliente" );
						//echo "Puede modifivcar todo el cliente";
							if (!$cargarCliente){
								echo "Error en carga de datos";
							}else{
								echo "Cliente actualizado con exito";
							}
					}

				}

				}

	}

	function eliminar_Cliente ($conexion, $alias){
		$tabla='"cliente"';
		$colum1='"cliente"';
		$colum2='"id_cliente"';

		//$alias= $nombre + $apellido;
		$id_cliente_aux = pg_query($conexion, "SELECT * FROM $tabla WHERE $colum1 = $alias " );
				while ($reg = pg_fetch_array($id_cliente_aux)){
					$id_cliente = $reg['id_cliente'];
	
		}
		$id_cliente = "'$id_cliente'";

		$eliminarCliente = pg_query($conexion, "DELETE FROM $tabla WHERE $colum2 = $id_cliente;" );
		if (!$eliminarCliente){
		echo "Error al eliminar datos";
		}else{
			echo "datos eliminados con exito!!!";
		}
	}

	function insertar_Producto ($conexion, $producto, $descripcion, $tp, $tsp, $marca){
		$tabla='"producto"';
		$colum1='"producto"';
		$colum2='"descripcion"';
		$colum3='"tipo_p_id"';
		$colum4='"tsp_id"';
		$colum5= '"marca_id"';
		$colum6= '"cant_stock"';
		$colum7= '"und_vendida"';
		$colum8= '"cant_agregado"';
		$colum9= '"precio_und_div"';
		$colum10= '"precio_und_bs"';

		$validaProducto= pg_query($conexion, "SELECT * FROM $tabla");
			while ($reg = pg_fetch_array($validaProducto)){
				$producto_aux = $reg['producto'];
				$marca_aux = $reg['marca_id'];
				$descrip_aux = $reg['descripcion'];

				$producto_aux = "'$producto_aux'";
				$descrip_aux = "'$descrip_aux'";
				
				if ($producto_aux == $producto and $descrip_aux == $descripcion and $marca_aux == $marca ){
					$find=  true;
					echo "Ya existe un producto con ese nombre!!! puede verlo pulsando en ver todos los productos";
				}
			}
			if ($find != true){
				$insertaProducto = pg_query($conexion, "INSERT INTO $tabla ($colum1, $colum2, $colum3, $colum4, $colum5, $colum6, $colum7, $colum8, $colum9, $colum10) VALUES ($producto, $descripcion, $tp, $tsp, $marca, 0, 0, 0, 0, 0)");
				if(!$insertaProducto){
					echo "Error en carga de datos del producto";
				}else{
					echo "Producto cargado con exito";
				}
			}



	pg_close($conexion);




	}

	function lista_Productos($conexion){
			$tabla='"producto"';
			$tabla2= '"marcas"';
			$colum1= '"producto"';
			$colum2='"descripcion"';
			$colum3='"nombre_m"';
			$lista_aux = pg_query ($conexion, "SELECT $colum1,$colum2,$colum3 FROM $tabla,$tabla2");
				while ($lista = pg_fetch_array($lista_aux)){
					$producto = $lista['producto'];
					$descripcion = $lista['descripcion'];
					$marca = $lista['nombre_m'];
					echo "$producto". ": (";
					echo " ";
					echo "$descripcion" . ")";
					echo " ";
					echo "MARCA: (";
					echo "$marca". ")";
					echo ",";
				}
	}

//Funcion de tipos y sub tipos de productos
function tp($conexion, $tp){
	$tabla='"tipo_producto"';
	$tabla1='"tipo_subproducto"';
	$colum= '"id_tp"';
	$colum1= '"tipo_producto"';
	if ($tp == false){
	$consultaTp= pg_query($conexion, "SELECT * FROM $tabla");
		while ($reg = pg_fetch_array($consultaTp)){
			$tipo_aux= $reg['tipo_producto'];
			echo "$tipo_aux";
			echo ',';
		}
	}else {
		$consultaTp= pg_query($conexion, "SELECT * FROM $tabla WHERE $colum1 = $tp");
		while ($reg = pg_fetch_array($consultaTp)){
			$tipo_aux= $reg['id_tp'];
			echo "$tipo_aux";
			//echo ',';
		}
	}
}

function tsp($conexion, $tsp, $opc){
	$tabla='"tipo_subproducto"';
	$colum= '"tp_id"';
	$colum1= '"sub_producto"';
	if ($opc == true){	
		$consultaTsp= pg_query($conexion, "SELECT * FROM $tabla WHERE $colum = $tsp");
		while ($reg = pg_fetch_array($consultaTsp)){
			$tsp_aux= $reg['sub_producto'];
			echo "$tsp_aux";
			echo ',';
		}
	}else if ($opc == false){
		$consultaTsp= pg_query($conexion, "SELECT * FROM $tabla WHERE $colum1 = $tsp");
		while ($reg = pg_fetch_array($consultaTsp)){
			$tsp_aux= $reg['id_tsp'];
			echo "$tsp_aux";
		}
	}
}

//funcion de lista de subproducto con su producto principal
function listaTsp_tp($conexion){
	$sql = 'SELECT "sub_producto", "tipo_producto" FROM "tipo_subproducto", "tipo_producto" WHERE "tp_id" = "id_tp"';
	$consulta= pg_query($conexion, $sql);
		while ($reg = pg_fetch_array($consulta)){
			$sub_aux=$reg['sub_producto'];
			$tp_aux=$reg['tipo_producto'];
			echo $sub_aux . " ==> ";
			echo $tp_aux;
			echo ',';
		}
		pg_close($conexion);
}	

//funciones para agregar tipos y sub tipos (insert)

function insertar_TP($conexion, $tp){
	$tabla= '"tipo_producto"';
	$colum= '"tipo_producto"';
	$find=false;
	$validar = pg_query($conexion,"SELECT * FROM $tabla" );
		while ($reg = pg_fetch_array($validar)){
			$tp_aux= $reg['tipo_producto'];
			$tp_aux = "'$tp_aux'";
			if ($tp == $tp_aux){
				$find=true;
			}
		}
		if ($find == false){
			$insert = pg_query($conexion, "INSERT INTO $tabla ($colum) VALUES ($tp)");
				if (!$insert){
					echo "No se pudo cargar el tipo de producto compruebe la base de datos";
				}else{
					echo "Tipo de producto cargado con exito";
				}
		}else {
			echo "Ya existe ese tipo de producto";
		}
		pg_close($conexion);
}

//en construccion para mejora: borrar despues;
function modificar_TP($conexion, $tp, $id_tp){
	$tabla= '"tipo_producto"';
	$colum= '"tipo_producto"';
	$colum1= '"id_tp"';
	$find=false;
	$validar = pg_query($conexion,"SELECT * FROM $tabla" );
		while ($reg = pg_fetch_array($validar)){
			$tp_aux= $reg['tipo_producto'];
			$tp_aux = "'$tp_aux'";
			if ($tp == $tp_aux){
				$find=true;
			}
		}
		if ($find == false){
			$modifica = pg_query($conexion, "UPDATE $tabla SET $colum = $tp WHERE $colum1 = $id_tp");
			
				if (!$modifica){
					echo "No se pudo cargar el tipo de producto compruebe la base de datos";
				}else{
					echo "Tipo de producto modificado con exito";
				}
		}else {
			echo "Ya existe ese tipo de producto";
		}
		pg_close($conexion);
}


function insertar_TSP($conexion, $tsp, $tp_id){
	$tabla='"tipo_subproducto"';
	$colum='"sub_producto"';
	$colum1='"tp_id"';
		
		$validar = pg_query($conexion,"SELECT * FROM $tabla" );
			while ($reg = pg_fetch_array($validar)){
				$tsp_aux= $reg['sub_producto'];
				$tsp_aux = "'$tsp_aux'";
				if ($tsp == $tsp_aux){
				$find=true;
				}
			}
			if ($find == false){
				$insert = pg_query($conexion, "INSERT INTO $tabla ($colum, $colum1) VALUES ($tsp, $tp_id)");
					if (!$insert){
						echo "No se pudo cargar el tipo de sub producto compruebe la base de datos";
					}else{
						echo "Tipo de sub producto cargado con exito";
					}
			}else {
				echo "Ya existe ese tipo de sub producto";
			}
			pg_close($conexion);

}






//fincion abonar / pagar

function abono($conexion, $cliente, $abono){
	$tabla = '"ventas"';
	$colum = '"cliente"';
	$colum1 = '"pago"';
	$colum2 = '"deuda"';
	$colum4 = '"id"';
	$tf = "'false'";
	$consulta = pg_query($conexion, "SELECT * FROM $tabla WHERE $colum = $cliente AND $colum1 = $tf");
	$total = 0;
	$res = 0;
	$sum = 0;
	
	if ($abono == 'NULL'){
		while ($reg = pg_fetch_array($consulta)){
		
			$campo= $reg['producto'];
			echo "$campo";
			echo " ";
			$campo = $reg['deuda'];
			$sum = $campo;
			echo "$campo";
			echo "</br>";
			//sumatoria
			$total = $total + $sum;
		}
		echo "</br>";
		echo "el total es: ". $total;

	}else{
	while ($reg = pg_fetch_array($consulta)){
		
		$campo= $reg['cliente'];
		$campo = $reg['deuda'];
		$sum = $campo;
		$res = $campo;
		$res = (float) $res;
		$id= $reg['id'];
		//sumatoria
		$total = $total + $sum;
		//abono positivo
		if ($abono > 0){
			$con = '';
			$abono = (float) $abono;
			 $abono =number_format($abono - $res ,2);
				 if ($abono >= 0 ){
					 $tf="'t'";
					 $update = pg_query($conexion, "UPDATE $tabla SET $colum2 = '0' , $colum1 = $tf WHERE $colum4 = '$id' " );
					 }else if ($abono <= 0){
						$debe = $abono * -1;
						$update = pg_query($conexion, "UPDATE $tabla SET $colum2 = $debe WHERE $colum4 = '$id' " );
					 }
			
		}
		
	}
	echo "Vuelto : " . $abono;

}
}

function listaDeMarcas($conexion){
	$tabla = '"marcas"';
	$listaMarcas= pg_query($conexion, "SELECT * FROM $tabla" );
		while ($reg = pg_fetch_array($listaMarcas)){
			$marca_aux=$reg['nombre_m'];
			echo $marca_aux;
			echo ',';
		}	
}

function seleccionaMarca($conexion, $marca){
	$tabla = '"marcas"';
	$colum = '"nombre_m"';
	$listaMarcas= pg_query($conexion, "SELECT * FROM $tabla WHERE $colum = $marca" );
		while ($reg = pg_fetch_array($listaMarcas)){
			$marca_aux=$reg['id_marca'];
			echo $marca_aux;
		}

}

function nuevaMarca($conexion, $marca){
	$tabla = '"marcas"';
	$colum = '"nombre_m"';
	$find=false;
	$listaMarcas= pg_query($conexion, "SELECT * FROM $tabla" );
		while ($reg = pg_fetch_array($listaMarcas)){
			$marca_aux=$reg['nombre_m'];
			$marca_aux= "'$marca_aux'";
			if ($marca_aux == $marca){
				echo "Ya existe una marca con ese nombre, por favor vea la lista de marcas";
				$find= true;
			}
		}
		if ($find != true){
			$nuevaMarca= pg_query($conexion, "INSERT INTO $tabla ($colum) VALUES ($marca)");
			if (!$nuevaMarca){
				echo "Error en la carga de datos compruebe el estado de la base de datos";
			}else{
				echo "Datos cargados con exito!!!";
			}
		}
}

function modificaMarca($conexion,$marca, $id_m){
	$tabla = '"marcas"';
	$colum = '"nombre_m"';
	$colum1 = '"id_marca"';
	$find=false;
	$listaMarcas= pg_query($conexion, "SELECT * FROM $tabla" );
		while ($reg = pg_fetch_array($listaMarcas)){
			$marca_aux=$reg['nombre_m'];
			$marca_aux= "'$marca_aux'";
			if ($marca_aux == $marca){
				echo "Ya existe una marca con ese nombre, por favor vea la lista de marcas";
				$find= true;
			}
		}
		if ($find != true){
			$nuevaMarca= pg_query($conexion, "UPDATE $tabla SET $colum = $marca WHERE $colum1 = $id_m ");
			if (!$nuevaMarca){
				echo "Error en la carga de datos compruebe el estado de la base de datos";
			}else{
				echo "Datos actualizados con exito!!!";
			}
		}

}

?>
