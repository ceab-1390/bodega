<?php	
	//Datos
    require_once 'controller.php';
	$VISTA = $_POST;
	$CLIENTE= $VISTA['CLIENTE'];
	$APELLIDO= $VISTA['APELLIDO'];
	$TODO= $VISTA['TODO'];
	if ($TODO == ''){
		$TODO='false';
	}else{
		$TODO = strtoupper($TODO);
	
	}
	if ($APELLIDO == ''){
        $APELLIDO = 'NULL';
    }else{
		$APELLIDO= strtoupper($APELLIDO);
		$APELLIDO= "'$APELLIDO'";
	}
	$CLIENTE= strtoupper ($CLIENTE);
	$CLIENTE= "'$CLIENTE'";
	
	
	$consulta=consulta_cliente($conexion, $CLIENTE, $APELLIDO,$TODO);
	echo "$consulta";
?>

