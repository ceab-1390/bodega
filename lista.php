<?php	
	//Datos
    require_once 'controller.php';
	$VISTA = $_POST;
	$NOMBRE= $VISTA['NOMBRE'];
    $APELLIDO= $VISTA['APELLIDO'];
	$ALIAS= $VISTA['ALIAS'];
	if ($ALIAS == ''){
		$ALIAS = 'NULL';
		$NOMBRE= strtoupper ($NOMBRE);
		$NOMBRE= "'$NOMBRE'";
		$consulta=consulta_cliente_lista($conexion, $ALIAS, $NOMBRE);
	}else{
		$NOMBRE='NULL';
		$ALIAS = strtoupper($ALIAS);
		$ALIAS = "'$ALIAS'";
		$consulta=consulta_cliente_lista($conexion, $ALIAS, $NOMBRE);
	}

?>

