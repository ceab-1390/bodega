

<?php
	
	$DATOS=$_POST;
	//if (isset ($_POST)){
	$CLIENTE=$DATOS['CLIENTE'];
	$PRODUCTO=$DATOS['PRODUCTO'];
	include 'carga_datos.php';
	insertar_en_Cuenta ($CLIENTE, $PRODUCTO);

	//funcion para conectar con postgres
	//$conexion = pg_connect ("host=localhost dbname=bodega user=bodega password=postgres");

	/*$tabla='"Cuenta"';
	$colum1='"Cliente"';
	$colum2='"Producto"';
	$Dato1="'$CLIENTE'";
	$Dato2="'$PRODUCTO'";
	$insert = pg_query ($conexion, "INSERT INTO $tabla ($colum1 , $colum2) VALUES ($Dato1,$Dato2)");
	pg_close ($conexion);*/
	
	/*/Funcion para generar la vista de un cliente:
	$VISTA = $_GET;
	$CLIENT= $VISTA['CLIENT'];
	$Dato_vista= "'$VISTA'";
	$registros= pg_query($conexion, "select * from $tabla where  $colum1 = $Dato_vista");
	//fin de la funcion
	echo "<vista>";
		echo "<table border=1>";
			echo "<tr>";
				echo "<td>CIENTE </td>";
				echo "<td>PRODUCTO </td>";
				while ($reg = pg_fetch_array($registros)){
					echo "<tr>";
					echo "<td>". $reg['Cliente'] . "</td>";
					echo "<td>". $reg['Producto'] . "</td>";
					echo "</tr>";
				}
	echo "</vista>";
*/

	//}
		

?>
