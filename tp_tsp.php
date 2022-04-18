<?php

require_once 'controller.php';
$DATOS=$_POST;
$OPC = $DATOS['OPC'];

switch ($OPC){

    case 0:
            //crea la lista de tipos_p si $TP es falso
            $TP = false;
            tp($conexion, $TP);
    break;

    case 1:
        //crea la lista de sub_tipos_p a partir de la seleccion
        $TSP = false;
        $TP = $DATOS['TP'];
        $TP = "'$TP'";
        tsp($conexion, $TP, $TSP);
    break;

    case 2: 
        //guardar un tipo nuevo
        $TP = $DATOS['TP'];
        $TP = strtoupper($TP);
        $TP = "'$TP'";
        insertar_TP($conexion, $TP);
    break;

    case 3: 
        //guardar un sub tipo nuevo
        $TSP = $DATOS['TSP'];
        $TP = $DATOS['TP'];
        $TSP = strtoupper($TSP);
        $TSP = "'$TSP'";
        $TP = "'$TP'";
        insertar_TSP($conexion, $TSP, $TP);
    break;

    case 4: 
        //Modificar un tipo  quedo en esta funcion desde android ya estan los parametros falta purgar y crear la funcion de modificar
        $TP = $DATOS['TP'];
        $TP_OLD = $DATOS['TP_OLD'];
        $TP = strtoupper($TP);
        $TP = "'$TP'";
        $TP_OLD = "'$TP_OLD'";
        modificar_TP($conexion, $TP, $TP_OLD);
    break;

    case 5: 
        //Modificar un tipo de sub producto
        $TSP = $DATOS['TSP'];
        $TSP_OLD = $DATOS['TSP_OLD'];
        $TP= $DATOS['TP'];
        $TSP = strtoupper($TSP);
        $TSP = "'$TSP'";
        $TSP_OLD = "'$TSP_OLD'";
        $TP = "'$TP'";
        modificar_TSP($conexion, $TSP, $TSP_OLD, $TP);
    break;
    

}
    
?>