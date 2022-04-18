
<?php

	//Datos
    require_once 'controller.php';
	$IN = $_POST;
	$OPC = $IN['OPC'];


	switch ($OPC){
		case 0:
			lista_clientes($conexion);
		break;

		case 1:
			$CLIENTE= $IN['CLIENTE'];
			$NOMBRE= $IN['NOMBRE'];
			$APELLIDO= $IN['APELLIDO'];
			$CI= $IN['CI'];
			$TLF= $IN['TLF'];
			$DIRECCION = $IN['DIRECCION'];
			$EMAIL = $IN['EMAIL'];
			$MODIF=$IN['MODIFICAR'];
			$ID=$IN['ID'];
			//Mayusculas
			$CLIENTE= strtoupper ($CLIENTE);
			$NOMBRE= strtoupper ($NOMBRE);
			$APELLIDO= strtoupper($APELLIDO);
			$CI= strtoupper($CI);
			$TLF= strtoupper($TLF);
			$DIRECCION= strtoupper($DIRECCION);
			$EMAIL= strtoupper($EMAIL);
			//Comillas
			$CLIENTE= "'$CLIENTE'";
			$NOMBRE= "'$NOMBRE'";
			$APELLIDO= "'$APELLIDO'";
			$DIRECCION= "'$DIRECCION'";
			$EMAIL= "'$EMAIL'";
			//$MODIF = "'$MODIF'";
			if ($CI == ''){
				$CI = 'NULL';
			}else{
				$CI= "'$CI'";
			}
			if ($TLF == ''){
				$TLF = 'NULL';
			}else{
				$TLF= "'$TLF'";
			}
			//$consulta=consulta_cliente_lista($conexion, $CLIENTE);
			//echo "$consulta";

       		insertar_Cliente ($conexion, $CLIENTE, $NOMBRE, $APELLIDO, $CI, $TLF, $MODIF, $ID, $DIRECCION, $EMAIL);
			break;
		}

?>