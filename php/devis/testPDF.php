<?php

use Spipu\Html2Pdf\Html2Pdf;

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/../../libExtern/vendor/autoload.php';


try{
    $pdf = new Html2Pdf();
    $pdf->pdf->SetAuthor('DOE John');
    $pdf->pdf->SetTitle('Devis 14');
    $pdf->pdf->SetSubject('Devis' . "service");
    $pdf->pdf->SetKeywords('HTML2PDF, Devis, PHP');
    $pdf->writeHTML($_POST["content"]);

//$pdfContent = $html2pdf->output('my_doc.pdf', 'S');

$pdf->output();
} catch (\Spipu\Html2Pdf\Exception\Html2PdfException $e) {
    echo $e->getMessage();
}