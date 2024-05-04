<?php require_once('fpdf/fpdf.php');

require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/Exception.php');


class PDF extends FPDF
{
// Page header
    function Header()
    {
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(51, 51, 51);
        $this->SetAutoPageBreak(true, 10);
        $this->Write(5, ' ');
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Image('logo.png', 75, 10, 60, 0, 'PNG');
        $this->Cell(180, '5', utf8_decode('SWB Solar GmbH | Lochhamerstr. 31 | 82152 Planegg'), 0, 0, 'C');
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $nb = $this->PageNo();
        $this->SetY(-30);
        $y = $this->getY();
        $this->SetFont('Arial', 'I', 8);
        $this->MultiCell(0, 4, utf8_decode('SWB-Solar Gmbh' . chr(10) . 'Lochhamerstr. 31' . chr(10) . '82152 Planegg'));
        $this->SetXY(15, $y);
        $this->MultiCell(0, 4, utf8_decode('Amtsgericht München' . chr(10) . 'HRB 251510' . chr(10) . 'St.-Nr. 143/184/31966'), 0, 'C');
        $this->SetXY(0, $y);
        $this->MultiCell(0, 4, utf8_decode(chr(10) . 'Geschäftsführer' . chr(10) . 'Samuel Picciau'), 0, 'R');
        $this->Cell(0, 15, 'Seite ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
    }
}

$name = utf8_decode($_POST['name']);
$street = utf8_decode($_POST['street']);
$zip = utf8_decode($_POST['zip']);
$city = utf8_decode($_POST['city']);
$email = utf8_decode($_POST['email']);
$switcher = utf8_decode($_POST['switcher']);


//DC
$moduletype = utf8_decode($_POST['moduletype']);
$moduleqty = utf8_decode($_POST['moduleqty']);
$installation = utf8_decode($_POST['installation']);
$damages = utf8_decode($_POST['damages']);
$damagepv = utf8_decode($_POST['damagepv']);
$damageroof = utf8_decode($_POST['damageroof']);
$damagebuilding = utf8_decode($_POST['damagebuilding']);
$damagecable = utf8_decode($_POST['damagecable']);
$damageline = utf8_decode($_POST['damageline']);
$damageinstallation = utf8_decode($_POST['damageinstallation']);
$damagewr = utf8_decode($_POST['damagewr']);
$cleanedup = utf8_decode($_POST['cleanedup']);
$comments = utf8_decode($_POST['comments']);


//AC Damages
$counternumber = utf8_decode($_POST['counternumber']);
$counternumberex = utf8_decode($_POST['counternumberex']);
$measurement = utf8_decode($_POST['measurement']);
$damages2 = utf8_decode($_POST['damages2']);
$damagesaver = utf8_decode($_POST['damagesaver']);
$damageshelf = utf8_decode($_POST['damageshelf']);
$acdamagebuilding = utf8_decode($_POST['acdamagebuilding']);
$acdamagecable = utf8_decode($_POST['acdamagecable']);
$acdamageline = utf8_decode($_POST['acdamageline']);
$groundinginstalled = utf8_decode($_POST['groundinginstalled']);
$operating = utf8_decode($_POST['operating']);
$tested = utf8_decode($_POST['tested']);
$modified = utf8_decode($_POST['modified']);
$accleanedup = utf8_decode($_POST['accleanedup']);
$photos = utf8_decode($_POST['photos']);
$acComments = utf8_decode($_POST['accomments']);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(15, 0);
$pdf->SetDrawColor(100, 100, 100);

$pdf->AddPage();
$pdf->Ln();
$pdf->Ln();
$pdf->Write(6.5, ' ');
$pdf->Ln();
$pdf->MultiCell(60, 5, $name . ' ' . chr(10) . $street . ' ' . chr(10) . $zip . ' ' . $city . chr(10) . $email, '', 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 18);

if ($switcher === 'dc') {
    $pdf->Write(9, 'Abnahmeprotokoll Photovoltaikanlage bis Wechselrichter');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Ln(3);
    $pdf->Ln();
    $pdf->Write(5, 'Modultyp: ' . $moduletype);
    $pdf->Ln();
    $pdf->Write(5, 'Modulanzahl: ' . $moduleqty);
    $pdf->Ln();
    $pdf->Write(5, 'Montagesystem: ' . $installation);
    if ($damages) {
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Write(9, 'Schadenprotokoll');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Ln(3);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden an der Photovoltaik-Anlage: ') . $damagepv);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden am Dach: ') . $damageroof);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden am Gebäude: ') . $damagebuilding);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden an Stecker (Verkabelung): ') . $damagecable);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden am Leitungsführung: ') . $damageline);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden an Montagesystem: ') . $damageinstallation);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäde am Wechselrichter: ') . $damagewr);
    }
} else {
    $pdf->Write(9, 'Elektrotechnische Abnahme Photovoltaikanlage');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Ln(3);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Zählernummer Bezugszähler: ') . $counternumber);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Zählernummer bei Ausbau: ') . $counternumberex);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Messkonzept: ') . $measurement);
    if ($damages2) {
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Write(9, 'Schadenprotokoll');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Ln(3);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden am Speicher: ') . $damagesaver);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden am Zählerschrank: ') . $damageshelf);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden am Gebäude: ') . $acdamagebuilding);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden am Stecker (Verkabelung): ') . $acdamagecable);
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Sichtbare Schäden an Leitungsführung: ') . $acdamageline);
    }
}

$pdf->SetFont('Arial', 'B', 16);
$pdf->Ln();
$pdf->Ln();

$pdf->Write(9, 'Sonstige Informationen');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(3);
$pdf->Ln();
if ($switcher === 'dc') {
    $pdf->Write(5, utf8_decode('Baustelle sauber hinterlassen: ') . $cleanedup);
}
if ($switcher === 'ac') {
    $pdf->Write(5, utf8_decode('Erdung angeschlossen: ') . $groundinginstalled);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Speicher in Betrieb genommen: ') . $operating);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Photovoltaikanlagen Test durchgeführt: ') . $tested);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Zählerschrank Umbau: ') . $modified);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Baustelle sauber hinterlassen: ') . $accleanedup);
    $pdf->Ln();
    $pdf->Write(5, utf8_decode('Fotos erstellt: ') . $photos);
}
if ($comments) {
    $pdf->Ln();
    $pdf->Write(5, $comments);
} else if ($acComments) {
    $pdf->Ln();
    $pdf->Write(5, $acComments);
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


if ($switcher === 'dc') {
    $pdf->Write(5, utf8_decode('Hiermit bestätigt der Kunde, dass die Dacharbeiten seiner Photovoltaikanlage zu seiner Zufriedenheit durchgefürt worden sind, fertig gestellt sind und keine Mängel bestehen. Die Anlage ist hiermit abgenommen'));
} else {
    $pdf->Write(5, utf8_decode('Hiermit bestätigt der Kunde, dass die Elektroarbeiten seiner Photovoltaikanlage zu seiner Zufriedenheit durchgefürt worden sind, fertig gestellt sind und keine Mängel bestehen. Die Anlage ist hiermit abgenommen. Es erfolgte eine Einweisung in die Funktion und Bedienung der Anlage. Anlagenbetreiber sind für die funktionierende Internetverbindung selbst verantwortlich. Sämtliche AC Montage- und Installationsarbeiten wurden zur vollsten Zufriedenheit ausgeführt. Es erfolgte eine Belehrung zum Hinweis (EEG-Verstoß).'));
}
$pdf->Ln(0);

$y = $pdf->GetY() + 5;

$signatureImg = 'signature.png';
$signaure = $_POST['signature'];
$dataPiecesSignature = explode(',', $signaure);
$encodedImgSignature = $dataPiecesSignature[1];
$decodedImgSignature = base64_decode($encodedImgSignature);

if (file_put_contents($signatureImg, $decodedImgSignature) !== false) {
    $pdf->Image($signatureImg, 15, $y, 40, 0, 'PNG');
    unlink($signatureImg);
}

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$x = $pdf->GetX() + 8;
$y = $pdf->GetY() + 8;
$pdf->SetDrawColor(0, 0, 0);
$pdf->Line(16, $y, 194, $y);
$pdf->Ln();
$pdf->Ln();
$pdf->Write(5, $city . ', ' . date("d.m.Y") . ' Unterschrift ' . $name);

// attachment name
$filename = 'Abnahmeprotokoll_' . $switcher . '.pdf';
$pdfdoc = $pdf->Output('', 'S');

// email stuff (change data below)
$to = $email;
$from = "info@swb-solar.de";
$message = '<html><body>';
if ($switcher === 'dc') {
    $subject = 'Abnahmeprotokoll Photovoltaikanlage bis Wechselrichter';
    $message .= '<p><h2>Sehr geehrte/r Frau/Herr ' . $name . ', </h2>
anbei erhalten Sie Ihr Abnahmeprotokoll zur erfolgreichen Modulmontage.<br> 
<br>
Die nächsten Schritte sehen wie folgt aus:<br>
Bitte überweisen Sie die erste Anzahlungsrechnung über 80%. <br>
Nach Erhalt dieser Summe, werden wir uns mit Ihnen in Verbindung setzen, um den Elektrikertermin zu vereinbaren.<br>
<br>
Bei Fragen stehen wir Ihnen gerne zur Verfügung.<br>
';
} else {
    $subject = 'Elektrotechnische Abnahme Photovoltaikanlage';
    $message .= '<p><h2>Sehr geehrte/r Frau/Herr ' . $name . ', </h2>
anbei erhalten Sie das Abnahmeprotokoll zu Ihrem Elektroanschluss.<br> 
<br>
Nach Erhalt der letzten 20% werden wir ihrem Netzbetreiber die Freigabe zum Zählertausch erteilen.<br>
Ihr zuständiger Netztbetreiber wird sich dann mit ihnen in Verbindung setzen, um einen Termin mit Ihnen zu vereinbaren.<br>
<br>
Bei Fragen stehen wir Ihnen gerne zur Verfügung.<br>
';
}

$message .= '<br>
Mit freundlichen Grüßen,<br>
Ihr SWB-Solar Team
</p>
<br>
------------------------------------------
<p>
<img src="https://app.swb.solar/logo.png" alt="" width="150">
<br>
<br> 
SWB-Solar GmbH<br>
Lochhamerstr. 31<br>
82152 Martinsried<br>
T   089 21 53 76-39<br>
F   089 21 53 79-64<br>
E info@swb-solar.de<br>
www.swb.solar 
</p></body></html>';

$phpemail = new PHPMailer\PHPMailer\PHPMailer();
$phpemail->setFrom($from, 'SWB-Solar GmbH');
$phpemail->Subject = $subject;
$phpemail->Body = utf8_decode($message);
$phpemail->addAddress($to);
$phpemail->IsHTML(true);

$phpemail->addStringAttachment($pdfdoc, $filename);

$phpemail->send();
echo 'SUCCESS';
