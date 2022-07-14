<?php
require_once "conexion.php";
require_once './src/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$sql = 'SELECT id_per,name_per,lastname_per,datebirth_per,address_per,phone_per,email_per FROM persons';
$result = $conn->query($sql, PDO::FETCH_ASSOC);
$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Personas");
$hojaActiva->getColumnDimension('A')->setWidth(5);
$hojaActiva->setCellValue('A1', 'ID');
$hojaActiva->getColumnDimension('B')->setWidth(10);
$hojaActiva->setCellValue('B1', 'Nombre');
$hojaActiva->getColumnDimension('C')->setWidth(10);
$hojaActiva->setCellValue('C1', 'Apellido');
$hojaActiva->getColumnDimension('D')->setWidth(20);
$hojaActiva->setCellValue('D1', 'Fecha de Nacimiento');
$hojaActiva->getColumnDimension('E')->setWidth(10);
$hojaActiva->setCellValue('E1', 'Dirección');
$hojaActiva->getColumnDimension('F')->setWidth(10);
$hojaActiva->setCellValue('F1', 'Teléfono');
$hojaActiva->getColumnDimension('G')->setWidth(20);
$hojaActiva->setCellValue('G1', 'Correo Electrónico');

$fila = 2;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $hojaActiva->setCellValue('A' . $fila, $row['id_per']);
    $hojaActiva->setCellValue('B' . $fila, $row['name_per']);
    $hojaActiva->setCellValue('C' . $fila, $row['lastname_per']);
    $hojaActiva->setCellValue('D' . $fila, $row['datebirth_per']);
    $hojaActiva->setCellValue('E' . $fila, $row['address_per']);
    $hojaActiva->setCellValue('F' . $fila, $row['phone_per']);
    $hojaActiva->setCellValue('G' . $fila, $row['email_per']);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="personas.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
