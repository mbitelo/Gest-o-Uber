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
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = 'http://localhost/phppdf/images/demhab.png';
		$this->Image($image_file, 30, 5, 150, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-10);
		// Set font
		$this->SetFont('helvetica', 'I', 6);
		// Page number
		$this->Cell(0, 8, 'Gerado automaticamente pelo Portal DEMHAB', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	} 
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Portal DEMHAB');
$pdf->SetTitle('REQUERIMENTO');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/bra.php')) {
	require_once(dirname(__FILE__).'/lang/bra.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// create some HTML content
@$data = "Gravataí, ". date("d"). " de " . date("m") . " de " . date("Y");
@$nome = $_GET["nome"];
@$matricula = $_GET["matricula"];
@$qtddias = $_GET["qtddias"];
@$dias = $_GET["dias"];

$html = <<<EOF
<style>
.branco{
	height: 30px;}
.titulo{
	height: 70px;
	text-decoration: bold;
}
.corpo {
	text-align: justify;
	height: 280px;
}
.data{
	text-align: right;
	height:200px;
}

.assinatura{
	height:250x;
	text-align:center;
	border-top: 1px solid black;
	}
.rodape{
	width:90%;
	}
</style>

<table>
<tr><td colspan="7" class="branco"></td></tr>

<tr><td colspan="7" class="titulo"><span style="text-align:center;">REQUERIMENTO DE FOLGA<br><br></span></td></tr>

<tr><td colspan="7" class="corpo"><p>Eu, <b>$nome</b>, matrícula <b>$matricula</b>, solicito <b>$qtddias</b> dia(s) de folga, na(s) data(s) <b>$dias</b></p></td></tr>

<tr><td colspan="7" class="data">$data</td></tr>

<tr><td></td><td class="assinatura" colspan="2">Assinatura do funcionário</td><td></td><td class="assinatura" colspan="2">Assinatura da chefia imediata</td><td></td></tr>

<tr><td colspan="6" class="rodape">Aqui vai todo um blá bbá blá sobre banco de horas do funcionario junto com uma quadrado que deve constar q quantidade de horas</td><td style="border:1px solid black;width:10%;"></td></tr>
</table>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$js = 'print(true);';

// set javascript
$pdf->IncludeJS($js);



// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
