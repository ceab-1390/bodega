<?php

require_once 'controller.php';
$DATOS=$_POST;
$OPC = $DATOS['OPC'];

switch ($OPC){

    case 0:
            //listar las marcas
            listaDeMarcas($conexion);
    break;
    
    case 1:
        //guarda la marca seleccionada
        $MARCA= $DATOS['MARCA'];
        $MARCA= strtoupper($MARCA);
        $MARCA= "'$MARCA'";
        nuevaMarca($conexion,$MARCA);
    break;

    case 3:
        //modificar la marca seleccionada
        $MARCA= $DATOS['MARCA'];
        $MARCA_OLD= $DATOS['MARCA_OLD'];
        $MARCA= strtoupper($MARCA);
        $MARCA= "'$MARCA'";
        $MARCA_OLD= "'$MARCA_OLD'";
        modificaMarca($conexion,$MARCA, $MARCA_OLD);
    break;
}
?>