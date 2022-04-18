<?php


    $DATOS=$_GET;
    $TSP=$DATOS['TSP'];
    $TSP="'$TSP'";
    $TP=$DATOS['TP'];
    $TP="'$TP'";

 

	$conexion = connectar_Bd ("bodega", "postgres", "localhost", "bodega-2");

	if (!$conexion){
		echo "UPS! Error en conexion hacia la base de datos";
	}

	function connectar_Bd ($usuario, $pass, $host, $bd){
		$conexion = pg_connect ("user=".$usuario." ".
		            "password=".$pass." ".
					"host=".$host." ".
					"dbname=".$bd);
	
	return $conexion;
   }

 function  inserta_tsp_con_nombre_tp ($conexion, $tsp, $tp){
            $tabla='"tipo_producto"';
            $tabla1='"tipo_subproducto"';
            $colum = '"tipo_producto"';
            $colum1= '"sub_producto"';
            $colum2= '"tp_id"';
            $find=false;
            $validaTpId = pg_query($conexion, "SELECT * FROM $tabla WHERE $colum = $tp");
                while ($reg = pg_fetch_array($validaTpId)){
                    $tp_id = $reg['id_tp'];
                }
            $validaExiste= pg_query($conexion, "SELECT * FROM $tabla1");
                while ($reg = pg_fetch_array($validaExiste)){
                $aux = $reg['sub_producto'];
                $aux = "'$aux'";
                if ($aux == $tsp){
                    $find=true;
                }
                }

                if ($find == false){
                echo "INSERT INTO $tabla1 ($colum1,$colum2) VALUES ($tsp,$tp_id)";
                }else{
                    echo "tipo sub producto existente no se guardara";
                }


   }
   inserta_tsp_con_nombre_tp($conexion,$TSP,$TP);

?>