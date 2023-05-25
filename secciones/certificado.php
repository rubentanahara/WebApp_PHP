<?php
require('../librerias/fpdf/fpdf.php');

include_once '../configuraciones/bd.php';
$conn = BD::CrearInstancia();


print_r($_GET);
$id_curso = isset($_GET["id_curso"]) ? $_GET["id_curso"] : '';
$id_alumno = isset($_GET["id_alumno"]) ? $_GET["id_alumno"] : '';


$sql = "SELECT alumnos.nombre, alumnos.apellidos, curso.nombre_curso
FROM alumnos, cursos WHERE alumnos.id=:id_alumno AND cursos.id=:id_curso";

$sentencia = $conn->prepare($sql);
$sentencia->bindParam(":id_alumno", $id_alumno);
$sentencia->bindParam(":id_curso", $id_curso);
$sentencia->execute();
$alumno = $sentencia->fetch(PDO::FETCH_ASSOC);
print_r($alumno);




/* $pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->Image('../img/logo.png', 10, 10, 20, 20, 'PNG');
$pdf->Cell(30, 10, '', 0);
$pdf->Cell(120, 10, 'Certificado de aprobacion', 0);
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Nombre: ', 0);
$pdf->Cell(120, 10, $alumno['nombre'] . ' ' . $alumno['apellidos'], 0);
$pdf->Ln(10);
$pdf->Cell(30, 10, 'Curso: ', 0);
$pdf->Cell(120, 10, $curso['nombre'], 0);
$pdf->Ln(10);
$pdf->Cell(30, 10, 'Nota: ', 0);
$pdf->Cell(120, 10, $alumno['nota'], 0);
$pdf->Ln(10);
$pdf->Cell(30, 10, 'Fecha: ', 0);
$pdf->Cell(120, 10, $alumno['fecha'], 0);
$pdf->Ln(10);
$pdf->Output(); */
