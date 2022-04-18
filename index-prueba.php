
<?php
   require('/usr/share/fpdf/fpdf.php');


//funcion para conectar con postgres
$conexion = connectar_Bd ("bodega", "postgres", "localhost", "bodega");

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

 $tabla='"ventas"';
 $colum='"cliente"';
 $user="'cesar'";
 $registros= pg_query($conexion, "SELECT * FROM $tabla WHERE $colum = $user");





$string = '    CESAR ENRIQUE AVILA BRETO';
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('icono-header.png',0,0,210);
    // Arial bold 15
   // $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    //$this->Cell(80);
    // Título
    //$this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(40);
}

// Pie de página
/*function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}*/
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(190, 10, 'CLIENTE'. $string, 1);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(70, 10, 'PRODUCTOS', 1);
$pdf->Cell(60, 10, 'PRECIO', 1);
$pdf->Cell(60, 10, 'FECHA', 1);
$pdf->Ln(10);
    $precio_aux=0;
    $sum = 0;
    while($reg = pg_fetch_array($registros)){  
        $producto=$reg['producto'];
        $precio=$reg['precio'];
        $precio_aux = $precio;
        $fecha=$reg['fecha'];
        $pdf->Cell(70, 10, $producto, 1);
        $pdf->Cell(60, 10, $precio, 1);
        $pdf->Cell(60, 10, $fecha, 1);
        $pdf->Ln(10);
        $sum = $sum + $precio_aux;
    }
$pdf->Cell(70, 10, 'TOTAL', 1);
$pdf->Cell(120, 10, $sum, 1);
$pdf->Ln(10);
//$pdf->Cell(60, 10, echo_p(), 1);
$pdf->Ln(10);
$pdf->Output();
?>
