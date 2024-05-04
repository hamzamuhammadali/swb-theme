<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['recaptcha_response'])) {

// Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Ld02ogaAAAAACrcoCmmwneh_QIolMgUrhsB4OL7';
    $recaptcha_response = $_GET['recaptcha_response'];

    function url_get_contents($Url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    $recaptcha = url_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

// Take action based on the score returned:
    if ($recaptcha->score >= 0.5) {

        // EDIT THE 2 LINES BELOW AS REQUIRED
        $email_to = "info@swb-solar.de";
        $email_subject = "SWB-Solar.de Kontaktformular";

        function died($error)
        {
            // your error code can go here
            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
            echo "These errors appear below.<br /><br />";
            echo $error . "<br /><br />";
            echo "Please go back and fix these errors.<br /><br />";
            die();
        }


        // validation expected data exists
        if (!isset($_GET['first_name']) || !isset($_GET['anrede']) || !isset($_GET['email']) || !isset($_GET['telephone']) || !isset($_GET['comments'])) {
            died('We are sorry, but there appears to be a problem with the form you submitted.');
        }


        $anrede = $_GET['anrede']; // required
        $first_name = $_GET['first_name']; // required
        $email_from = $_GET['email']; // required
        $telephone = $_GET['telephone']; // not required
        $comments = $_GET['comments']; // required

        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

        if (!preg_match($email_exp, $email_from)) {
            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
        }

        $string_exp = "/^[A-Za-z .'-]+$/";

        if (!preg_match($string_exp, $first_name)) {
            $error_message .= 'The First Name you entered does not appear to be valid.<br />';
        }

        if (strlen($comments) < 2) {
            $error_message .= 'The Comments you entered do not appear to be valid.<br />';
        }

        if (strlen($error_message) > 0) {
            died($error_message);
        }

        $email_message = "Vom SWB-Solar.de Kontaktformular.\n\n";


        function clean_string($string)
        {
            $bad = array("content-type", "bcc:", "to:", "cc:", "href");
            return str_replace($bad, "", $string);
        }


        $email_message .= "Anrede: " . clean_string($anrede) . "\n";
        $email_message .= "Vorname, Nachname: " . clean_string($first_name) . "\n";
        $email_message .= "Email: " . clean_string($email_from) . "\n";
        $email_message .= "Telefon: " . clean_string($telephone) . "\n";
        $email_message .= "Nachricht: " . clean_string($comments) . "\n";

// create email headers
        $headers = 'From: ' . $email_from . "\r\n" . 'Reply-To: ' . $email_from . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        @mail($email_to, $email_subject, $email_message, $headers);
        ?>

        <!-- include your own success html here -->

        <div class="alert alert-success mt-3" role="alert">
            Vielen Dank für Ihre Anfrage. Wir werden uns in Kürze bei Ihnen melden.
        </div>

        <?php

    }
}
