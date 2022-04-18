<?php	
	//Datos
    require_once 'controller.php';
	$DEL = $_POST;
	$ALIAS= $DEL['ALIAS'];
	$ALIAS= strtoupper ($ALIAS);
	$ALIAS= "'$ALIAS'";
	
	
	$eliminar=eliminar_Cliente($conexion, $ALIAS);
	echo "$elimiar";
	
?>

