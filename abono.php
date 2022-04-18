
<?php
require_once 'controller.php';
$datos=$_GET;
$cliente=$datos['cliente'];
$cliente="'$cliente'";
$abono=$datos['abono'];
if ($abono == ''){
    $abono='NULL';
}
abono($conexion,$cliente,$abono);


?>