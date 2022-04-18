
<?php
	//echo date ("F j, Y, g:i a");
	$DATOS=$_POST;
	//if (isset ($_POST)){
	$CLIENTE=$DATOS['CLIENTE'];
	$PRODUCTO=$DATOS['PRODUCTO'];
	$PAGO=$DATOS['PAGO'];
	$CANT = $DATOS['CANT'];
	$CLIENTE= strtoupper ($CLIENTE);
	require_once 'controller.php';
    insertar_en_Cuenta ($conexion, $CLIENTE, $PRODUCTO, $PAGO, $CANT);
	
?>
