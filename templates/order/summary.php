<?php
$dateFormat    = get_option( 'date_format' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/app/fpdf/fpdf.php' );

if ( ! class_exists( 'PHPMailer\PHPMailer\PHPMailer' ) ) {
	require( $_SERVER['DOCUMENT_ROOT'] . '/app/PHPMailer/src/PHPMailer.php' );
}

if ( ! class_exists( 'PHPMailer\PHPMailer\Exception' ) ) {
	require( $_SERVER['DOCUMENT_ROOT'] . '/app/PHPMailer/src/Exception.php' );
}

if ( ! class_exists( 'PHPMailer\PHPMailer\SMTP' ) ) {
	require( $_SERVER['DOCUMENT_ROOT'] . '/app/PHPMailer/src/SMTP.php' );
}

class PDF extends FPDF
{
// Page header
	function Header()
	{
		$this->SetFont('Helvetica', '', 9);
		$this->SetTextColor(51, 51, 51);
		$this->SetAutoPageBreak(true, 10);
		$this->Write(5, ' ');
		$this->Ln();
		$this->Ln();
		$this->Image($_SERVER['DOCUMENT_ROOT'] . '/app/logo.png', 75, 10, 60, 0, 'PNG');
		$this->Cell(190, '5', utf8_decode('SWB Solar GmbH | Lochhamerstr. 31 | 82152 Planegg'), 0, 0, 'C');
		$this->Ln();
		$this->Ln();
	}

// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$nb = $this->PageNo();
		$this->SetY(-20);
		$y = $this->getY();
		$this->SetFont('Helvetica', 'I', 8);
		//$this->MultiCell(0, 4, utf8_decode('SWB-Solar Gmbh' . chr(10) . 'Lochhamerstr. 31' . chr(10) . '82152 Planegg'));
		//$this->SetXY(15, $y);
		//$this->MultiCell(0, 4, utf8_decode('Amtsgericht München' . chr(10) . 'HRB 251510' . chr(10) . 'St.-Nr. 143/184/31966'), 0, 'C');
		//$this->SetXY(0, $y);
		//$this->MultiCell(0, 4, utf8_decode(chr(10) . 'Geschäftsführer' . chr(10) . 'Samuel Picciau'), 0, 'R');
		//$this->Cell(0, 15, 'Seite ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
		$this->MultiCell(0, 4, utf8_decode('SWB-Solar GmbH | Lochhamerstr. 31, 82152 Planegg | Steuernummer: 143/184/31966, Handelsregister: Amtsgericht München HRB 251510' . chr(10) . 'Geschäftsführer: Samuel Picciau | Commerzbank, IBAN: DE88 700400 410388 303000, BIC: COBADEFXX'), 0, 'C');
	}

	// Colored table
	function FancyTable($header, $data, $content)
	{
		// Colors, line width and bold font
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(.3);
		$this->SetFont('', 'B');
		// Header
		$w = array(10, 10, 20, 140);
		for ($i = 0; $i < count($header); $i++) $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data

		for ($i = 0; $i < count($data); $i++) {
			$this->Cell($w[$i], 6, utf8_decode($data[$i]), 'LR', 0, 'C');
		}
		$this->Ln();
		$this->Cell(array_sum($w), 0, '', 'LR');
		$this->Ln();
		$this->MultiCell(180, 4.5, utf8_decode($content), 'TLBR');
	}

	protected $B = 0;
	protected $I = 0;
	protected $U = 0;
	protected $HREF = '';

	function WriteHTML($html)
	{
		// HTML parser
		$html = str_replace("\n", ' ', $html);
		$a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
		foreach ($a as $i => $e) {
			if ($i % 2 == 0) {
				// Text
				if ($this->HREF) $this->PutLink($this->HREF, $e); else
					$this->Write(5, $e);
			} else {
				// Tag
				if ($e[0] == '/') $this->CloseTag(strtoupper(substr($e, 1))); else {
					// Extract attributes
					$a2 = explode(' ', $e);
					$tag = strtoupper(array_shift($a2));
					$attr = array();
					foreach ($a2 as $v) {
						if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3)) $attr[strtoupper($a3[1])] = $a3[2];
					}
					$this->OpenTag($tag, $attr);
				}
			}
		}
	}

	function OpenTag($tag, $attr)
	{
		// Opening tag
		if ($tag == 'B' || $tag == 'I' || $tag == 'U') $this->SetStyle($tag, true);
		if ($tag == 'A') $this->HREF = $attr['HREF'];
		if ($tag == 'BR') $this->Ln(5);
	}

	function CloseTag($tag)
	{
		// Closing tag
		if ($tag == 'B' || $tag == 'I' || $tag == 'U') $this->SetStyle($tag, false);
		if ($tag == 'A') $this->HREF = '';
	}

	function SetStyle($tag, $enable)
	{
		// Modify style and select corresponding font
		$this->$tag += ($enable ? 1 : -1);
		$style = '';
		foreach (array('B', 'I', 'U') as $s) {
			if ($this->$s > 0) $style .= $s;
		}
		$this->SetFont('', $style);
	}

	function PutLink($URL, $txt)
	{
		// Put a hyperlink
		$this->SetTextColor(0, 0, 255);
		$this->SetStyle('U', true);
		$this->Write(5, $txt, $URL);
		$this->SetStyle('U', false);
		$this->SetTextColor(0);
	}

	function RoundedRect($x, $y, $w, $h, $r, $style = '')
	{
		$k = $this->k;
		$hp = $this->h;
		if ($style == 'F') $op = 'f'; elseif ($style == 'FD' || $style == 'DF') $op = 'B';
		else
			$op = 'S';
		$MyArc = 4 / 3 * (sqrt(2) - 1);
		$this->_out(sprintf('%.2F %.2F m', ($x + $r) * $k, ($hp - $y) * $k));
		$xc = $x + $w - $r;
		$yc = $y + $r;
		$this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - $y) * $k));

		$this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);
		$xc = $x + $w - $r;
		$yc = $y + $h - $r;
		$this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $yc) * $k));
		$this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);
		$xc = $x + $r;
		$yc = $y + $h - $r;
		$this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - ($y + $h)) * $k));
		$this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);
		$xc = $x + $r;
		$yc = $y + $r;
		$this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $yc) * $k));
		$this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
		$this->_out($op);
	}

	function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
	{
		$h = $this->h;
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1 * $this->k, ($h - $y1) * $this->k, $x2 * $this->k, ($h - $y2) * $this->k, $x3 * $this->k, ($h - $y3) * $this->k));
	}

}

define('EUR', utf8_encode(' ' . chr(128)));
$post = get_post($orderID);
$projectPdf = isset($_GET['projectPdf']);
$orderInfo = get_post_meta($orderID);
$company = utf8_decode($orderInfo['companyName'][0]);
$firstname = utf8_decode($orderInfo['firstName'][0]);
$lastname = utf8_decode($orderInfo['lastName'][0]);
$street = utf8_decode($orderInfo['street'][0]);
$houseNumber = utf8_decode($orderInfo['houseNumber'][0]);
$zip = utf8_decode($orderInfo['zip'][0]);
$city = utf8_decode($orderInfo['city'][0]);
$emailAddress = utf8_decode($orderInfo['emailAddress'][0]);
$phoneNumber = utf8_decode($orderInfo['phoneNumber'][0]);
$mobileNumber = utf8_decode($orderInfo['mobileNumber'][0]);
$energy = utf8_decode($orderInfo['energy'][0]);
$energycosts = utf8_decode($orderInfo['energycosts'][0]);
$kwhprice = utf8_decode($orderInfo['kwhprice'][0]);
$storage = utf8_decode(get_post_meta($orderInfo['storage'][0], 'name', true));
$module = utf8_decode(get_post_meta($orderInfo['module'][0], 'pvmoduleid', true));
$moduleqty = utf8_decode($orderInfo['moduleqty'][0]);
$inverter = utf8_decode(get_post_meta($orderInfo['inverter'][0], 'name', true));
$dc_delivery = utf8_decode($orderInfo['dc_delivery'][0]);
$dc_technician = utf8_decode($orderInfo['dc_technician'][0]);
$dc_appointment = utf8_decode($orderInfo['dc_appointment'][0]);
$ac_appointment = utf8_decode($orderInfo['ac_appointment'][0]);
$ac_technician = utf8_decode($orderInfo['ac_technician'][0]);
$agreements = get_post_meta( $orderID, 'agreements', true );
$price = utf8_decode($orderInfo['totalExcl'][0]);
$author = utf8_decode($orderInfo['author'][0]);
$notes = getNotes($orderID);
$customerNotes = getCustomerNotes($orderID);

if ( ! is_array( $agreements ) ) {
	$agreements = [];
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetMargins(15, 0);
$pdf->SetDrawColor(100, 100, 100);
$pdf->SetFillColor(8, 170, 255);
$pdf->Ln();
$pdf->MultiCell(180, 5, 'Auftrag #' . $orderID, '', 'C');
$pdf->MultiCell(180, 5, utf8_decode('Verkäufer: ' . get_the_author_meta('display_name', $post->post_author)),'', 'C');
$pdf->Ln();
$pdf->Write(5, utf8_decode('Persönliche Informationen'));
$pdf->Ln();
if($company) {
	$pdf->Write(5, $company);
	$pdf->Ln();
}
$pdf->Write(5, $firstname . ' '. $lastname);
$pdf->Ln();
$pdf->Write(5, $street . ' ' . $houseNumber);
$pdf->Ln();
$pdf->Write(5, $zip . ' ' . $city);
$pdf->Ln();
$pdf->Ln();
if (!$projectPdf) {
$pdf->Write(5, 'Kontaktinformationen');
$pdf->Ln();
	$pdf->Write(5, 'E-Mail: ' . $emailAddress);
	$pdf->Ln();
	$pdf->Write(5, 'Telefon: ' . $phoneNumber);
	$pdf->Ln();
	$pdf->Write(5, 'Mobil: ' . $mobileNumber);
	$pdf->Ln();
	$pdf->Ln();
}
$pdf->Write(5, utf8_decode('Photovoltaikanlage'));
$pdf->Ln();
$pdf->Write(5, 'Speicher: ' . $storage);
$pdf->Ln();
$pdf->Write(5, 'Module: ' . $moduleqty .' x '. $module);
$pdf->Ln();
$pdf->Write(5, 'Wechselrichter: ' . $inverter);
$pdf->Ln();

if($agreements) {
	if ( ! is_array( $agreements ) ) {
		$agreements = [];
	}
	$pdf->Ln();
	$pdf->Write(5, "Zusatzvereinbarungen:");
	$pdf->Ln();

	for ( $i = 0, $iMax = count( $agreements ); $i < $iMax; $i ++ )  {
		if($qtyField = get_post_meta($agreements[ $i ], 'qty', true)) {
		$pdf->Write(5, utf8_decode(get_post_meta($orderID,'qty-'.$agreements[ $i ],true). 'x ' . str_replace("€", EUR, get_post( $agreements[ $i ] )->post_title)));
		$pdf->Ln();
		} else {
			$pdf->Write(5, utf8_decode(str_replace(" €", EUR, get_post( $agreements[ $i ] )->post_title)));
			$pdf->Ln();
		}
	}
}
if (!$projectPdf) {
	$pdf->Write(5, 'Preis Netto: '. number_format($price, '2', ',', '.') . utf8_decode(EUR));
	$pdf->Ln();
}

$pdf->Ln();

if($dc_technician) {
	$pdf->Write(5, 'Montage Termine');
	$pdf->Ln();
	$pdf->Write(5, 'DC Monteur: '. utf8_decode(get_the_author_meta('display_name', $dc_technician)));
	$pdf->Ln();
	$pdf->Write(5, 'DC Montage: '. date_i18n( $dateFormat, strtotime( $dc_appointment ) ));
	$pdf->Ln();
	$pdf->Write(5, 'Liefertermin: '. date_i18n( $dateFormat, strtotime( $dc_delivery ) ));
	$pdf->Ln();
}
if($ac_technician) {
	$pdf->Write(5, 'AC Monteur: '. utf8_decode(get_the_author_meta('display_name', $ac_technician)));
	$pdf->Ln();
	$pdf->Write(5, 'AC Montage: '. date_i18n( $dateFormat, strtotime( $ac_appointment ) ));
	$pdf->Ln();
	$pdf->Ln();
}

if (!empty($notes && !$projectPdf)) {
$pdf->Write(5, 'Interne Anmerkungen: ');
$pdf->Ln();

	foreach ( $notes as $note ) {
		$pdf->Write(5, $note['date'] . ', ' . utf8_decode($note['author']) . ': ' . utf8_decode($note['message']));
		$pdf->Ln();
	}
	$pdf->Ln();
}

if (!empty($customerNotes) && !$projectPdf) {
$pdf->Write(5, 'Kundenmitteilungen:');
$pdf->Ln();

	foreach ( $customerNotes as $note ) {
		$pdf->Write(5, $note['date'] . ', ' . utf8_decode($note['author']) . ': ' . utf8_decode($note['message']));
		$pdf->Ln();
	}
}

if($projectPdf) {
	$pdf->Output('D', $orderID . '_Projektierung.pdf');
} else {
	$pdf->Output(wp_upload_dir()['path']. '/orders-attachments/' . $orderID . '/Auftrag_'. $orderID . '.pdf', 'F');
}
