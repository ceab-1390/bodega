<?php
require_once 'controller.php';
    $DATOS=$_POST;
    $USER=$DATOS['USER'];
    $PASS=$DATOS['PASS'];
    $USER="'$USER'";
    $USER=strtoupper($USER);
    validar_acceso($conexion, $USER, $PASS);




?>