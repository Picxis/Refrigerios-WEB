<?php
ob_start(); // Iniciar el buffer de salida para evitar problemas de envío de contenido antes del PDF
require('../reports/fpdf.php');
include "conexion.php"; 

mysqli_set_charset($conexion, 'utf8'); // Asegurar que la conexión use UTF-8

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,utf8_decode('Reporte de Usuarios'),0,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

// Cabecera de la tabla con anchos ajustados
$pdf->Cell(25,10,utf8_decode('ID'),1);
$pdf->Cell(40,10,utf8_decode('Nombre'),1);
$pdf->Cell(40,10,utf8_decode('Apellido'),1);
$pdf->Cell(50,10,utf8_decode('Correo'),1);
$pdf->Cell(35,10,utf8_decode('Dirección'),1); // Agregando columna de dirección
$pdf->Ln();

// Ajuste de la consulta SQL (se asume que la columna de dirección se llama 'direccionUsuario')
$sql = "SELECT idUsuario, nombreUsuario, apellidoUsuario, correoUsuario, direccionUsuario FROM Usuario"; // Añadido 'direccionUsuario'
$query = mysqli_query($conexion, $sql);

if (!$query) {
    die("Error en la consulta: " . mysqli_error($conexion)); // Mostrar el error en caso de fallo
}

while ($data = mysqli_fetch_array($query)) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 10, $data['idUsuario'], 1);
    $pdf->Cell(40, 10, utf8_decode($data['nombreUsuario']), 1);
    $pdf->Cell(40, 10, utf8_decode($data['apellidoUsuario']), 1);
    $pdf->Cell(50, 10, utf8_decode($data['correoUsuario']), 1);
    $pdf->Cell(35, 10, utf8_decode($data['direccionUsuario']), 1); // Imprimir dirección
    $pdf->Ln();
}

// Limpiar el buffer de salida
ob_end_clean();

// Generar el PDF
$pdf->Output('I', 'Reporte_Usuarios.pdf');

$conexion->close();
?>
