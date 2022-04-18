<?php
require('/usr/share/fpdf/fpdf.php');

$DATOS=$_GET;
$SERVER = $DATOS['SERVER'];//servidor
$TIPO= $DATOS['TIPO'];//tipo de alarma
$ALERTA=$DATOS['FILE'];
$ALARMA= fopen($ALERTA, "r");
$TEXT= fread($ALARMA,filesize($ALERTA));
fclose($ALARMA);
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
 // Logo
 $this->Image('icono-header.png',0,0,210);
 $this->Ln(40);
 //Arial bold 15
 $this->SetFont('Arial','B',15);
 //Movernos a la derecha
 $this->Cell(70);
 //Título
 $this->Cell(50,10,'Alarmas CSPA',1,0,'C');
 //Salto de línea
 $this->Ln(10);
}

// Pie de página
/*function Footer()
{
}*/
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(95, 10, 'Servidor', 1);
$pdf->Cell(95, 10, $SERVER, 1);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(95, 10, 'Tipo de alerta: ', 1);
$pdf->Cell(95, 10, $TIPO, 1);
$pdf->Ln(10);
$pdf->MultiCell(190, 10 ,'Descripcion: ');
$pdf->MultiCell(190, 10 ,$TEXT,1);
$pdf->Ln(10);
//$pdf->Cell(60, 10, echo_p(), 1);
$pdf->Ln(10);
$pdf->Output();

?>

