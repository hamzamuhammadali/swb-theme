<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');
$wp->init();
$wp->parse_request();
$wp->query_posts();
$wp->register_globals();
$wp->send_headers();
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/fpdf/fpdf.php');

require($_SERVER['DOCUMENT_ROOT'].'/app/PHPMailer/src/PHPMailer.php');
require($_SERVER['DOCUMENT_ROOT'].'/app/PHPMailer/src/Exception.php');

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
        $this->Ln();
        $this->Ln();
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/app/logo.png', 75, 10, 60, 0, 'PNG');
        $this->Cell(180, '5', utf8_decode('SWB Solar GmbH | Lochhamerstr. 31 | 82152 Planegg'), 0, 0, 'C');
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
        $this->MultiCell(0, 4, utf8_decode('SWB-Solar GmbH | Lochhamerstr. 31, 82152 Planegg | Steuernummer: 143/184/31966, Handelsregister: Amtsgericht München HRB 251510'. chr(10). 'Geschäftsführer: Samuel Picciau | Commerzbank, IBAN: DE88 700400 410388 303000, BIC: COBADEFXX'), 0, 'C');
    }

    // Colored table
    function FancyTable($header, $data, $content)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(10, 10, 20, 140);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data

        for($i=0;$i<count($data);$i++)
        {
            $this->Cell($w[$i],6,utf8_decode($data[$i]),'LR',0,'C');
        }
        $this->Ln();
        $this->Cell(array_sum($w),0,'','LR');
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
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

}

define('EUR',utf8_encode(' ' . chr(128)));
$storage = $_POST['storage'];
$module = $_POST['module'];
$moduleqty = $_POST['moduleqty'];
$energy = $_POST['energy'];
$energyCosts = $_POST['energycosts'];
$salutation = utf8_decode($_POST['salutation']);
$name = utf8_decode($_POST['firstName']);
$lastName = utf8_decode($_POST['lastName']);
$street = utf8_decode($_POST['street']);
$houseNumber = utf8_decode($_POST['houseNumber']);
$zip = utf8_decode($_POST['zip']);
$city = utf8_decode($_POST['city']);
$email = utf8_decode($_POST['email']);
$totalExcl = utf8_decode($_POST['totalExcl']);
$totalIncl = utf8_decode($_POST['totalIncl']);
$addtionals = utf8_decode($_POST['additionals']);
$calculation = utf8_decode($_POST['calculation']);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(15, 0);
$pdf->SetDrawColor(100, 100, 100);
$pdf->SetFillColor(8, 170, 255);

$pdf->AddPage();
$pdf->Write(6.5, ' ');
$pdf->Ln();
$pdf->MultiCell(60, 5, $salutation . chr(10) . $name . ' ' . $lastName . chr(10) . $street . ' ' . $houseNumber . chr(10) . $zip . ' ' . $city . chr(10) . $email, '', 'L');
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(0, 5, utf8_decode($city. ', ') . date("d.m.Y"), 0, 0, 'R');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Helvetica', 'B', 18);
    $pdf->Write(9, utf8_decode('Ihr persönliches Angebot'));
    $pdf->SetFont('Helvetica', '', 9);
$user = wp_get_current_user();
$userName = $user->display_name;
    $pdf->Ln();
    $pdf->WriteHTML('<b>Ihr Berater: ' . $userName.'</b>');
    $pdf->Ln();
    $pdf->Ln();
    if($salutation === 'Herr') {
        $pdf->Write(5, 'Sehr geehrter Herr ' . $lastName . ',');
    } else {
        $pdf->Write(5, 'Sehr geehrte Frau ' . $lastName . ',');
    }
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Write(4.5, utf8_decode("wir freuen uns, Ihnen heute das Angebot für Ihre Photovoltaik-Anlage zusenden zu können.

Gerne stehen wir Ihnen jederzeit mit Rat und Tat zur Seite und unterstützen Sie in der zügigen Planung, Errichtung und Installation Ihrer Photovoltaik-Anlage.

Sie erreichen uns Montags bis Freitags, zwischen 09.00 bis 18.00 Uhr, unter folgender Telefonnummer: 089/ 215376-39. Selbstverständlich dürfen Sie uns, auch außerhalb unserer Geschäftszeiten kontaktieren, Nutzen Sie hierfür unsere E-Mail-Adresse: info@swb-solar.de.

Auf den folgenden Seiten finden Sie Ihr persönliches Angebot sowie die jeweiligen Datenblätter zu den Komponenten.

Wir freuen uns auf Ihre Bestellung und sichern Ihnen pünktliche Lieferung und Montage zu.
Bei Fragen steht Ihnen das gesamte Team der SWB Solar GmbH zur Verfügung.						
											
Mit freundlichen Grüßen,
SWB-Solar GmbH"));

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 35);
$pdf->Ln();
$pdf->SetFont('Helvetica', 'B', 16);
$pdf->Write(5, 'Angebotsdetails');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Helvetica', '', 9);
$pdf->writeHTML(utf8_decode('<b>Leistungsübersicht der SWB Solar GmbH</b><br>Beratung | Planung | Finanzservice | Logistik | Montage und Inbetriebnahme durch unsere zertifizierten Fachkräfte<br><br>Solarstromanlage inkl. Energiespeichersystem mit einer Leistung von: <b>') . number_format(get_post_meta($module, 'typ', true) * $moduleqty / 1000, 2, ',',  '.'). ' kWp</b>');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(248, 197, 197);
$height = (ceil(($pdf->GetStringWidth('Zusatzvereinbarungen: ' . $addtionals) / 180)) * 7) + 2;
$pdf->RoundedRect($pdf->getX(), $pdf->getY(), 180, $height, 1, 'F');
$pdf->Ln(2);
$pdf->MultiCell(180, 5,'Zusatzvereinbarungen: ' . $addtionals, '', 'C', '');
$pdf->SetFillColor(8, 170, 255);
$pdf->Ln(4);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Helvetica', 'B');
$pdf->RoundedRect($pdf->getX(), $pdf->getY(), 180, 7, 1, 'F');
$pdf->Cell(3);
$pdf->Cell(10, 7, 'POS', '', '', '');
$pdf->Cell(16,7, utf8_decode('Einheit'), '', '','' );
$pdf->Cell(155,7, utf8_decode('Bezeichnung'), '', '', '');
$pdf->Ln();
$pdf->Ln(2);
$pdf->SetTextColor(0,0,0);


$storageInformation = get_post_meta($storage);
$moduleInformation = get_post_meta($module);
$anhangStorage = $storageInformation['anhang'][0];
$anhangModule = $moduleInformation['anhang'][0];
$moduleName = $moduleInformation['pvmoduleid'][0];
$storagename = $storageInformation['typ'][0];
$pdf->RoundedRect($pdf->getX(), $pdf->getY(), 180, 7, 1, 'F');
$pdf->SetFont('Helvetica','B');
$pdf->SetTextColor(255,255,255);
$pdf->Cell(3);
$pdf->Cell(10,7, 1, '', '','', );
$pdf->Cell(16,7, utf8_decode($moduleqty . ' Stück'), '', '','', );
$pdf->Cell(155,7, utf8_decode('Hochleistungsmodule'), '', '','', );
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$pdf->Ln(3);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Markenhersteller: '.utf8_decode($moduleInformation['hersteller'][0]),0,'L');
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Modulleistung: '.utf8_decode($moduleInformation['typ'][0]) .  ' Watt',0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Typ: '.utf8_decode($moduleInformation['pvmoduleid'][0]),0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Zelltyp: '.utf8_decode($moduleInformation['modultechnik'][0]),0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Leistungstoleranz: '.utf8_decode($moduleInformation['leistungstoleranz'][0]),0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Modulabmessung: '.$moduleInformation['modulabmessungB'][0] .' x '. $moduleInformation['modulabmessungH'][0].' x '.$moduleInformation['modulabmessungT'][0].' (BxHxT)',0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Gewicht: '.utf8_decode($moduleInformation['kg'][0]),0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Modulwirkungsgrad: '.utf8_decode($moduleInformation['wirkungsgrad'][0]),0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Max. Druckbelastung: '.utf8_decode($moduleInformation['schneelast'][0]) . ' Pa',0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, 'Produktgarantie: '.utf8_decode($moduleInformation['leistungsgarantie'][0]),0,5);
$pdf->Cell(3);
$pdf->MultiCell(151, 4.5, utf8_decode('Ausführliche technische Daten zu den Modulen erhalten Sie mit dem Moduldatenblatt'),0,5);
$pdf->Ln(3);

if($storage) {
    $storageArray = array(
        $storageInformation['name'][0],
        $storageInformation['beschreibung'][0],
        $storageInformation['masse'][0],
        $storageInformation['installation'][0],
        $storageInformation['wartung'][0],
        $storageInformation['sicherheit'][0],
        $storageInformation['sicherheit2'][0],
        $storageInformation['garantie'][0],
        $storageInformation['garantie2'][0]
    );

    $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 180, 7, 1, 'F');
    $pdf->Cell(3);

    $i = 3;
    $pdf->SetFont('Helvetica','B');
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(10,7, 2, '', '','', );
    $pdf->Cell(16,7, utf8_decode('1 Stück'), '', '','', );
    $pdf->Cell(155,7, utf8_decode($storageInformation['typ'][0]), '', '','', );
    $pdf->SetFont('Helvetica');
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln();
    $pdf->Ln(3);

    foreach ($storageArray as $storageInfo) {
        if(!empty($storageInfo)) {
            $pdf->Cell(3);
            $pdf->SetFont('zapfdingbats','',9);
            $pdf->Cell(4, 4.5, chr(51));
            $pdf->SetFont('Helvetica', '', 9);
            $pdf->MultiCell(151, 4.5, utf8_decode($storageInfo),0,5);
        }
    }
    $pdf->Ln(3);
} else {
    $i = 2;
}

$args = array('post_type' => 'misc', 'posts_per_page' => -1, 'order'=>'ASC');
$query = new WP_Query($args);
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        $miscInformation = get_post_meta(get_the_ID());
        $valueCount = count(array_filter($miscInformation, function($value) { return !empty($value[0]) && $value[0] !== ''; })); // - 2 Einträge;
        $heightLeft = (276 - $pdf->getY());
        if($heightLeft < $valueCount * 6) {
            $pdf->AddPage();
        }
        $pdf->SetFont('Helvetica','B');
        $pdf->SetTextColor(255,255,255);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 180, 7, 1, 'F');
        $pdf->Cell(3);
        $pdf->Cell(10,7, $i, '', '','', '');
        foreach ($miscInformation as $key => $val) {
            if($key === 'einheit') {
                $pdf->SetTextColor(255,255,255);
                //$pdf->SetFont('Helvetica','B',9);
                $pdf->Cell(16,7, utf8_decode($val[0]), '', '','', );
            } else if($key === 'name' && !empty($val[0])) {
                $pdf->SetTextColor(255,255,255);
                $pdf->Cell(155,7, utf8_decode($val[0] . ' '), '', '','', );
                $pdf->Ln();
                $pdf->Ln(3);
            } else if($key != '_edit_lock' && $key != '_edit_last' && !empty($val[0])) {
                $pdf->Cell(3);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('zapfdingbats','',9);
                $pdf->Cell(4, 4.5, chr(51));
                $pdf->SetFont('Helvetica', '', 9);
                $pdf->MultiCell(151, 4.5, utf8_decode($val[0]),0,5);
                $pdf->SetAutoPageBreak(true, 35);
                //$pdf->writeHTML(utf8_encode($val[0]));
                //$pdf->Write(5, chr(149). ' '. utf8_decode($val[0]));
            }
        }
        $pdf->Ln(3);
        $i++;

    endwhile;
    if(277 - $pdf->getY() < 150) {
        $pdf->AddPage();
    }
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Helvetica', 'B', 16);
    $pdf->Cell(180,5, utf8_decode('Zahlungsmodalitäten'), '', '','', '');
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(161, 5, utf8_decode(get_option('zahlung')));
    $pdf->Cell(30, 5, number_format($totalIncl * 0.9, 2, ',',  '.') . utf8_decode(EUR), '', 'R');
    $pdf->Ln();
    $pdf->MultiCell(150, 5, $pdf->writeHTML(utf8_decode(get_option('zahlung2'))), '', 'L');
    $pdf->SetXY(165,$pdf->getY()-10);
    $pdf->MultiCell(30, 5,number_format($totalIncl * 0.1, 2, ',',  '.') . utf8_decode(EUR), '', 'R');
    $pdf->Ln();
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Ln();
    $pdf->MultiCell(158, 5, $pdf->writeHTML(utf8_decode(get_option('zahlung3'))), '', 'L');
    $pdf->Ln();
    $pdf->SetFont('Helvetica', 'B', 9);
    $pdf->MultiCell(150, 5, 'Gesamtsumme Netto', '', 'R');
    $pdf->SetXY(165,$pdf->getY()-5);
    $pdf->MultiCell(30, 5,number_format($totalExcl, 2, ',',  '.') . utf8_decode(EUR), 0,'R');
    $pdf->MultiCell(150, 5, get_option('mwst') . '% MwSt. ', '', 'R');
    $pdf->SetXY(165,$pdf->getY()-5);
    $pdf->MultiCell(30, 5,number_format(($totalIncl - $totalExcl), 2, ',',  '.') . utf8_decode(EUR), 0,'R');
    $pdf->MultiCell(150, 5, 'Gesamtsumme Brutto', '', 'R');
    $pdf->SetXY(165,$pdf->getY()-5);
    $pdf->MultiCell(30, 5,number_format($totalIncl, 2, ',',  '.') . utf8_decode(EUR), 0,'R');
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->MultiCell(180, 5, utf8_decode(get_option('zahlung4')) . chr(10) .utf8_decode('Telefon: '. get_option('telefon'). ', E-Mail: ' .get_option('email')) . chr(10). utf8_decode(get_option('marketing')), '', 'C');
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Hiermit nehme ich das Angebot vom '. date("d.m.Y"). ' an und beauftrage die SWB-Solar GmbH zur Durchführung meines Projektes.'));
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Write(5, $city. ', '. date("d.m.Y"));
    $pdf->Ln();
    $pdf->Cell(180,5, utf8_decode('Ort, Datum, Unterschrift ') . $name . ' ' . $lastName, 'T', '','', '');
    $pdf->Ln();
    $pdf->Ln();
endif;

function find(array $pricing, $needle)
{
    $last = null; // return value if $pricing array is empty

    foreach ($pricing as $key => $value) {
        if ($key >= $needle) {
            return $key; // found it, return quickly
        }
        $last = $key; // keep the last key thus far
    }

    return $last;
}

$json = json_decode(get_option('cloudgroesse'));
$json = (array) $json;

$energy30 = $energy * 0.3;
$sunHours = 1000; // VARIABEL?
$cloudsize = find($json,$energy30);
$cloudsizePrice = $json[$cloudsize];
$totalPower = get_post_meta($module, 'typ', true) * $moduleqty / 1000;
$energy70 = $energy * 0.7;
$yearPower = $sunHours * $totalPower;
$kwhPrice = number_format($energyCosts / $energy, 2, ',',  '.');
$kw10Price = number_format(get_option('kw10'), 3, ',', '.');
$ockw10Price = number_format(get_option('kw10'), 3, ',', '.');
$kw10kw40Price = number_format(get_option('kw10kw40'), 3, ',', '.');
$ockw10kw40Price = number_format(get_option('ockw10kw40'), 3, ',', '.');
$kwhPriceBackend = number_format(get_option('kwhprice'), 3, ',',  '.');



if($totalPower >= 10) {
    $savings = ($yearPower - $energy70 - $energy30) * get_option('kw10kw40');
} else {
    $savings = ($yearPower - $energy70 - $energy30) * get_option('kw10');
}

$savingsConsumption = $energy70 * get_option('kwhprice');
$savingsConsumption30 = $energy30 * get_option('kwhprice');

$savingsOc = '';

if($totalPower >= 10) {
    $savingsOc = ($yearPower - ($energy * 0.8)) * get_option('ockw10kw40') + (($energy * 0.8) * $energyCosts / $energy);
} else {
    $savingsOc = ($yearPower - ($energy * 0.8)) * get_option('ockw10') + (($energy * 0.8) * $energyCosts / $energy);
}

        $pdf->AddPage();
        $pdf->Ln();

        $pdf->SetFont('Helvetica', 'B', 18);
        $pdf->Ln();
        if($storageInformation['cloud'][0] && $storage) {
            $pdf->Cell(180, 5, utf8_decode('Wirtschaftlichkeitsberechnung mit Cloud'), '', '', 'L');
        } else {
            $pdf->Cell(180, 5, utf8_decode('Wirtschaftlichkeitsberechnung ohne Cloud'), '', '', 'L');
        }
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 9);

        $pdf->MultiCell(65, 5, utf8_decode('Modultyp: ' . get_post_meta($module, 'pvmoduleid', true)), '', 'L');
        $pdf->SetXY(65,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(get_post_meta($module, 'typ', true) . ' Watt'), '', 'C');
        $pdf->SetXY(105,$pdf->getY()-5);
        $pdf->MultiCell(60, 5, utf8_decode('Anzahl-Module: '), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,$moduleqty, '', 'R');

        $pdf->MultiCell(65, 5, utf8_decode('Gesamtleistung'), '', 'L');
        $pdf->SetXY(65,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($totalPower, 2, ',', '.') . ' kWp'), '', 'C');
        $pdf->SetXY(105,$pdf->getY()-5);
        $pdf->MultiCell(60, 5, utf8_decode('In Simulation ermittelte kWh/KWp  p.a.:'));
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,number_format($sunHours, 0, ',', '.'), '', 'R');

        $pdf->Ln();
        $pdf->MultiCell(150, 5, utf8_decode('Ergibt Jahresleistung der Anlage in kWh (nach gängiger Simulationssoftware):'), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($yearPower, 0, ',', '.')), '', 'R');

        $pdf->Ln();
        $pdf->SetFont('Helvetica', 'B');
        $pdf->Write(5, utf8_decode('In Simulation ermittelte Einspeisevergütung/Ersparnis (Eigenverbrauch berücksichtigt): '));
        $pdf->SetFont('Helvetica', '');
        $pdf->Ln();
        $pdf->Ln();

        if($totalPower >= 10 && $storage) {
            $pdf->MultiCell(65, 5, utf8_decode('Über 10 kW bis 40 kW'), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($yearPower - $energy70 - $energy30, 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($kw10kw40Price . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('/kWh nach EEG: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format(($yearPower - $energy70 - $energy30) * get_option('kw10kw40'), 2, ',', '.') . EUR), '', 'R');
        } else if($totalPower >= 10) {
            $pdf->MultiCell(65, 5, utf8_decode('Über 10 kW bis 40 kW'), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($yearPower - ($energy * 0.8), 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($ockw10kw40Price . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('/kWh nach EEG: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format(($yearPower - ($energy * 0.8)) * get_option('ockw10kw40'), 2, ',', '.') . EUR), '', 'R');
        } else if ($storage) {
            $pdf->MultiCell(65, 5, utf8_decode('Bis 10 kW'), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($yearPower - $energy70 - $energy30, 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($kw10Price . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('/kWh nach EEG: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format(($yearPower - $energy70 - $energy30) * get_option('kw10'), 2, ',', '.') . EUR), '', 'R');
        } else {
            $pdf->MultiCell(65, 5, utf8_decode('Bis 10 kW'), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($yearPower - ($energy * 0.8), 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($ockw10Price . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('/kWh nach EEG: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format(($yearPower - ($energy * 0.8)) * get_option('ockw10'), 2, ',', '.') . EUR), '', 'R');
        }


        if($storageInformation['installation'][0] && $storage) {
            $pdf->MultiCell(65, 5, utf8_decode('Ersparnis aus Eigenverbrauch '), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($energy70, 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($kwhPriceBackend . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('kWh / Strompreis inkl.Grundpreis: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format($energy70 * get_option('kwhprice'), 2, ',','.') . EUR), '', 'R');

            $pdf->MultiCell(65, 5, utf8_decode('Ersparnis aus ihrer Cloudsystem'), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($energy30, 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($kwhPriceBackend . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('kWh / Strompreis inkl.Grundpreis: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format($energy30 * get_option('kwhprice'), 2, ',','.') . EUR), '', 'R');
        } else if(empty($storageInformation['installation'][0])) {
            $pdf->MultiCell(65, 5, utf8_decode('Ersparnis Eigenverbrauch 70%'), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($energy * 0.7, 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($kwhPriceBackend . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('kWh / Strompreis inkl.Grundpreis: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format(($energy * 0.7) * get_option('kwhprice'), 2, ',','.') . EUR), '', 'R');
        } else {
            $pdf->MultiCell(65, 5, utf8_decode('Ersparnis Eigenverbrauch 30%'), '', 'L');
            $pdf->SetXY(65,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F');
            $pdf->MultiCell(15, 5, number_format($energy * 0.3, 0,',','.'), '', 'R');
            $pdf->SetXY(80.5,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'B');
            $pdf->MultiCell(15, 5, utf8_decode($kwhPriceBackend . EUR), '', 'R');
            $pdf->SetXY(105,$pdf->getY()-5);
            $pdf->MultiCell(60, 5, utf8_decode('kWh / Strompreis inkl.Grundpreis: '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5,utf8_decode(number_format(($energy * 0.3) * get_option('kwhprice'), 2, ',','.') . EUR), '', 'R');
        }


    $pdf->Ln();
        $pdf->Ln();
        if($storage) {
            $pdf->MultiCell(150, 5, utf8_decode('Einspeisevergütung + Ersparnis jährlich gesamt '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5, utf8_decode(number_format($savings + $savingsConsumption + $savingsConsumption30, 2, ',', '.') . EUR), 0,'R');
            $pdf->MultiCell(150, 5, utf8_decode('Einspeisevergütung + Ersparnis monatlich gesamt '), '', 'L');
            $pdf->SetXY(165,$pdf->getY()-5);
            $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
            $pdf->MultiCell(30, 5, utf8_decode(number_format(($savings + $savingsConsumption + $savingsConsumption30) / 12, 2,',','.').EUR), 0,'R');
        } else {
        $pdf->Write(5, utf8_decode('Einspeisevergütung + Ersparnis jährlich gesamt ' . number_format($savingsOc, 2, ',', '.') . EUR.'
    Einspeisevergütung + Ersparnis monatlich gesamt ' . number_format($savingsOc / 12, 2,',','.').EUR));
        }

    $pdf->Ln();
    $pdf->SetFont('Helvetica', 'B');
    $pdf->MultiCell(150, 5, utf8_decode('Komplettpreis für anschlussfertige Photovoltaik-Anlage: '), '', 'L');
    $pdf->SetFont('Helvetica', '');
    $pdf->SetXY(165,$pdf->getY()-5);
    $pdf->SetFillColor(255, 205,95);
    $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
    $pdf->MultiCell(30, 5,number_format($totalExcl, 2, ',',  '.') . utf8_decode(EUR), 0,'R');
    $pdf->MultiCell(150, 5, 'Mehrwertsteuer, '.get_option('mwst') . '% (kann vom Finanzamt erstattet werden)', '', 'L');
    $pdf->SetXY(165,$pdf->getY()-5);
    $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
    $pdf->MultiCell(30, 5,number_format(($totalIncl - $totalExcl), 2, ',',  '.') . utf8_decode(EUR), 0,'R');
    $pdf->MultiCell(150, 5, 'Gesamtsumme Brutto', '', 'L');
    $pdf->SetXY(165,$pdf->getY()-5);
    $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
    $pdf->MultiCell(30, 5,number_format($totalIncl, 2, ',',  '.') . utf8_decode(EUR), 0,'R');
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Bei Finanzierung der Anlage wird durch die Mehrwertsteuererstattung i.d.R. nur der Nettobetrag finanziert.'));
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Helvetica', 'B');
    $pdf->Write(5,utf8_decode('Ertrag im Verhältnis zur Nettoinvestition:'));
    $pdf->SetFont('Helvetica', '');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFillColor(8, 170, 255);
    if($storage) {
        $pdf->MultiCell(150, 5, 'Einspeiseertrag (netto) pro Jahr laut Simulation:', '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($savings + $savingsConsumption + $savingsConsumption30, 2, ',', '.') . EUR), '', 'R');

        $pdf->MultiCell(150, 5, utf8_decode('abzügl. üblicher Kosten Grundpreis Cloud System jährlich'), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($cloudsizePrice * 12, 2, ',', '.') . EUR), '', 'R');

        $pdf->MultiCell(150, 5, utf8_decode('Rückliefermenge in kWh Cloud System jährlich'), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5, number_format($cloudsize, 0, ',', '.') . ' kWh', '','R');

        $pdf->MultiCell(150, 5, utf8_decode('Anlagen-Ertrag p.a. ¹'), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($savings + $savingsConsumption + $savingsConsumption30 - $cloudsizePrice * 12, 2, ',', '.') . EUR), '', 'R');
    } else {

        $pdf->MultiCell(150, 5, utf8_decode('Einspeiseertrag (netto) pro Jahr laut Simulation: '), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($savingsOc, 2, ',', '.') . EUR), '', 'R');

        $pdf->MultiCell(150, 5, utf8_decode('Anlagen-Ertrag p.a. ¹'), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($savingsOc, 2, ',', '.') . EUR), '', 'R');
    }
    $pdf->Ln();
    $pdf->Ln();
    if($storage) {
        $pdf->MultiCell(150, 5, utf8_decode('das entspricht einem Ertragsverhältnis zur Nettoinvestition von '), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,number_format((($savings + $savingsConsumption + $savingsConsumption30 - $cloudsizePrice * 12) * 20 * 1.5) / $totalExcl / 20 * 100, 2, ',', '.') . '%', '', 'R');
    } else {
        $pdf->MultiCell(150, 5, utf8_decode('das entspricht einem Ertragsverhältnis zur Nettoinvestition von '), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,number_format(($savingsOc * 20 * 1.3) / $totalExcl / 20 * 100, 2, ',', '.') . '%' , '', 'R');
    }
    $pdf->Ln();
    $pdf->MultiCell(150, 5, utf8_decode('Geförderter Zeitraum:'), '', 'L');
    $pdf->SetXY(165,$pdf->getY()-5);
    $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
    $pdf->MultiCell(30, 5,'20 Jahre' , '', 'R');
    $pdf->Write(5, utf8_decode('(zzgl. der Monate des Jahres der Inbetriebnahme)'));
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Helvetica', 'B');
    if($storage) {
        $pdf->MultiCell(150, 5, utf8_decode('Einspeisevergütung und Ersparnis (3% Steigerung) über 20 Jahre Förderzeitraum'), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format(($savings + $savingsConsumption + $savingsConsumption30 - $cloudsizePrice * 12) * 20 * 1.5, 2, ',', '.') . EUR), '', 'R');
    } else {

        $pdf->MultiCell(150, 5, utf8_decode('Einspeisevergütung und Ersparnis (3% Steigerung) über 20 Jahre Förderzeitraum'), '', 'L');
        $pdf->SetXY(165,$pdf->getY()-5);
        $pdf->RoundedRect($pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F');
        $pdf->MultiCell(30, 5,utf8_decode(number_format($savingsOc * 20 * 1.3, 2, ',', '.') . EUR), '', 'R');
    }
    $pdf->SetFont('Helvetica', '');

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->Write(3.5, utf8_decode('* Für diese Berechnung, insbesondere für die Höhe der erzielbaren Einspeisevergütung, kann keine Haftung übernommen werden.								
* Für die Rückliefermenge der Cloudgröße, kann keine Haftung übernommen werden.								
¹ Die Berechnung erfolgt über gängige Fachsoftware, die i.d.R. auch von Banken und Investoren zur Beurteilung von Photovoltaik-Anlagen eingesetzt wird (z.B. "PV-SOL").								
* Das Ergebnis hängt von der tatsächlichen Sonneneinstrahlung ab und kann deshalb sowohl niedriger als auch höher ausfallen als hier dagestellt.								
* Diese Berechnung ist eine unverbindliche Beispielberechnung aufgrund der vorgegebenen Daten. Sie ist nicht Gegenstand des Vertrages.'));
        wp_reset_postdata();

    $pdf->Ln();
    $pdf->Ln();
$pdf->Output('', 'Angebot.pdf');
