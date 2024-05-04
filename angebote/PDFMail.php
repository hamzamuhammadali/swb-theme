<?php // email stuff (change data below)
$to = $email;
$from = "info@swb-solar.de";
$message = '<html><body>';
$subject = utf8_decode('Ihr Persönliches Angebot von SWB Solar');
$message .= '<p><h2>Sehr geehrte'. ($salutation === 'Herr' ? 'r Herr ' : ' Frau ') . $lastName . ', </h2>
anbei erhalten Sie unser Angebot für Ihre Photovoltaikanlage.<br>
<br>
Für weitere Fragen steht Ihnen ' . $userName . ' gerne zur Verfügung<br>
<br>
Vielen Dank.<br>
';


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
    82152 Martinsried / Planegg<br>
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
//$phpemail->addAddress('info@fidanhaziri.com');
$phpemail->IsHTML(true);

$phpemail->addStringAttachment($pdfdoc, $filename);
if($storage) {
$phpemail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/'.$anhangStorage, $anhangStorage);
}
$phpemail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/'.$anhangModule, $anhangModule);
$phpemail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/'.get_option('agb'), get_option('agb'));

$phpemail->send();
echo 'SUCCESS';
