<?php

require_once 'controller.php';
$DATOS=$_POST;
$OPC = $DATOS['OPC'];

switch ($OPC){

    case 0:
            //crea la lista de tipos_p
            $TP = false;
            tp($conexion, $TP);
    break;
    
    case 1:
        //lista de id tipos_p
        $TP=$DATOS['TP'];
        $TP = "'$TP'";
        tp($conexion, $TP);
    break;

    case 2:
        //lista tipos sub asociados al id de el tipo_p
        $opc = true;
        $TSP= $DATOS['TSP'];
        tsp($conexion, $TSP, $opc);
    break;

    case 3:
        //consulta el id del TSP seleccionado
        $opc= false;
        $TSP= $DATOS['TSP'];
        $TSP= "'$TSP'";
        tsp($conexion, $TSP, $opc);
    break;

    case 4:
        //crea una lista de los sub_productos y el producto del cual depende
        listaTsp_tp($conexion);
    break;

    case 5:
        //inserta un nuevo tipo de prodocto
        $TP_TSP=$DATOS['TP_TSP'];
        $TP_TSP = strtoupper($TP_TSP);
        $TP_TSP = "'$TP_TSP'";
        insertar_TP($conexion, $TP_TSP);
    break;

    case 6:
        //inserta un nuevo tipo de sub_producto
        $TP_TSP=$DATOS['TSP'];
        $TP_ID=$DATOS['TP_ID'];
        $TP_TSP = strtoupper($TP_TSP);
        $TP_TSP = "'$TP_TSP'";
        insertar_TSP($conexion, $TP_TSP, $TP_ID);
    break;

    case 7:
        //modificar tipo de producto existente
        $TP=$DATOS['TP'];
        $TP_ID=$DATOS['TP_ID'];
        $TP = strtoupper($TP);
        $TP = "'$TP'";
        modificar_TP($conexion, $TP, $TP_ID);
    break;

}
?>l