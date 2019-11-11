<?php
$conecta = new mysqli('localhost', 'root', '', 'portaldemhab');
$conteudo = $conecta->query("Select conteudo from requerimento_corpo WHERE idUnico = '$_GET[id]'");
$corpo = utf8_encode($conteudo->fetch_object()->conteudo);
$conteudo = $conecta->query("Select conteudo from requerimento_estilo WHERE idEstilo = '{$_GET["id"][0]}'");
$estilo = utf8_encode($conteudo->fetch_object()->conteudo);
?>
<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('../_include/class/phppdf/tcpdf_include.php');
//require_once('phppdf/tcpdf_include.php');
// create some HTML content

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../cabecalho.png';
        $this->Image($image_file, 25, 5, 160, 0, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
        // set color for background
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-6);
        // Set font
        $this->SetFont('helvetica', 'I', 6);
        // Page number
        $this->Cell(0, 3, 'Gerado automaticamente pelo Portal DEMHAB', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        // Set font
        $this->SetFont('helvetica', '', 6);
        // Page number
        $this->Cell(0, 0, 'Código de identificação: '.$_GET["id"], 0, false, 'C', 0, '', 0, false, 'T', 'M');

    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('Portal DEMHAB');
$pdf->SetAuthor('Portal DEMHAB');
$pdf->SetTitle('REQUERIMENTO');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT); // 35 é a altura da margem do topo - PDF_MARGIN_TOP

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage('P', 'A4');

// create some HTML content

$html = <<<EOF
$estilo
$corpo
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$js = 'print(true);'; $js = 'window.print();';

// set javascript
if($_SERVER['SERVER_NAME'] == "www.demhab") {
    $pdf->IncludeJS($js);
}


// ---------------------------------------------------------

//Close and output PDF document
//$_SERVER['DOCUMENT_ROOT'] . 'AlterarPonto/arquivos/
$pdf->Output('requerimento_' . date("d-m-Y") . '_' . rand(1111, 9999) . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+