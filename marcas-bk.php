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
            //consultar el id de la marca seleccionada
            $MARCA= $DATOS['MARCA'];
            $MARCA= "'$MARCA'";
            seleccionaMarca($conexion, $MARCA);
    break;

    case 2:
        //guarda la marca seleccionada
        $MARCA= $DATOS['MARCA'];
        $MARCA= strtoupper($MARCA);
        $MARCA= "'$MARCA'";
        nuevaMarca($conexion,$MARCA);
    break;

    case 3:
        //modifica la marca seleccionada
        $MARCA= $DATOS['MARCA'];
        $ID_M= $DATOS['ID_M'];
        $MARCA= strtoupper($MARCA);
        $MARCA= "'$MARCA'";
        modificaMarca($conexion,$MARCA, $ID_M);
    break;
}
?>