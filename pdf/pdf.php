<?php 
 require_once("TCPDF/tcpdf.php");
 $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('kelompok 2');
$pdf->SetTitle('tugas besar');
$pdf->SetSubject('reporting');
$pdf->SetKeywords('reporting');

$pdf->AddPage();

$html = file_get_contents("http://localhost/belajar/tes.php");

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('report.pdf', 'I');
?>