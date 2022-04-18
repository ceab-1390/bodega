<?php
	//funcion para conectar con postgres
	$conexion = pg_connect ("host=localhost dbname=bodega user=bodega password=postgres");

	function insertar_en_Cuenta ($cliente, $producto) {
	$tabla='"Cuenta"';
	$colum1='"Cliente"';
	$colum2='"Producto"';
	$Dato1="'$cliente'";
	$Dato2="'$producto'";
	$insert = pg_query ($conexion, "INSERT INTO $tabla ($colum1 , $colum2) VALUES ($Dato1,$Dato2)");
	pg_close ($conexion);
	}
?>
