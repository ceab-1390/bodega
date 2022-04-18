
<?php
	$DATOS=$_POST;
    $TODOS=$DATOS['TODOS'];
    require_once 'controller.php';
    if ($TODOS == 'true'){
        lista_Productos($conexion);
    }
    else {
    $PRODUCTO=$DATOS['PRODUCTO'];
	$DESCRIPCION=$DATOS['DESCRIPCION'];
    $TP=$DATOS['TP'];
    $TSP=$DATOS['TSP'];
    $MARCA=$DATOS['MARCA'];
    //mayusculas
	$PRODUCTO= strtoupper ($PRODUCTO);
    $DESCRIPCION= strtoupper($DESCRIPCION);
    //comillas
    $PRODUCTO="'$PRODUCTO'";
    $DESCRIPCION= "'$DESCRIPCION'";
    $TP= "'$TP'";
    $TSP="'$TSP'";
    $MARCA= "'$MARCA'";
    insertar_Producto ($conexion, $PRODUCTO, $DESCRIPCION, $TP, $TSP, $MARCA);
}
?>
