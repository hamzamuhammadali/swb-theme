<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );

error_log( 'storage: ' . print_r( $_POST, 1 ) );
$wp->init();
$wp->parse_request();
$wp->query_posts();
$wp->register_globals();
$wp->send_headers();
require_once( __DIR__ . '/../app2/fpdf/fpdf.php' );
if ( ! class_exists( 'PHPMailer\PHPMailer\PHPMailer' ) ) {
	require( __DIR__ . '/../app2/PHPMailer/src/PHPMailer.php' );
}

if ( ! class_exists( 'PHPMailer\PHPMailer\Exception' ) ) {
	require( __DIR__ . '/../app2/PHPMailer/src/Exception.php' );
}

if ( ! class_exists( 'PHPMailer\PHPMailer\SMTP' ) ) {
	require( __DIR__ . '/../app2/PHPMailer/src/SMTP.php' );
}

$company                = utf8_decode( get_option( 'company' ) );
$companyPhone           = get_option( 'telefon' );
$companyMail            = get_option( 'email' );
$companyWebsite         = get_option( 'website' );
$companyFax             = get_option( 'fax' );
$companyWithoutForm     = utf8_decode( get_option( 'companyWithoutForm' ) );
$companyStreet          = utf8_decode( get_option( 'street' ) );
$companyCity            = utf8_decode( get_option( 'city' ) );
$companyZip             = get_option( 'zip' );
$companyVatId           = get_option( 'vatid' );
$companyHandelsregister = utf8_decode( get_option( 'handelsregister' ) );
$companyDirector        = utf8_decode( get_option( 'director' ) );
$companyBank            = utf8_decode( get_option( 'bank' ) );

class PDF extends FPDF {
// Page header
	function Header() {
		global $company;
		global $companyStreet;
		global $companyZip;
		global $companyCity;
		$this->SetFont( 'Helvetica', '', 9 );
		$this->SetTextColor( 51, 51, 51 );
		$this->SetAutoPageBreak( true, 10 );
		$this->Write( 5, ' ' );
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Ln();
		//$this->Image( get_attached_file( get_option( 'logo' ) ), 75, 10, 60, 0, 'PNG' );
		$this->Cell( 180, '5', $company . ' | ' . $companyStreet . ' | ' . $companyZip . ' ' . $companyCity, 0, 0, 'C' );
		$this->Ln();
		$this->Ln();
	}

// Page footer
	function Footer() {
		global $company;
		global $companyStreet;
		global $companyZip;
		global $companyCity;
		global $companyVatId;
		global $companyHandelsregister;
		global $companyDirector;
		global $companyBank;
		// Position at 1.5 cm from bottom
		$nb = $this->PageNo();
		$this->SetY( - 20 );
		$y = $this->getY();
		$this->SetFont( 'Helvetica', 'I', 8 );
		$this->MultiCell( 0, 4, $company . ' | ' . $companyStreet . ', ' . $companyZip . ' ' . $companyCity . ' | Steuernummer: ' . $companyVatId . ', Handelsregister: ' . $companyHandelsregister . chr( 10 ) . utf8_decode( 'Geschäftsführer: ' ) . $companyDirector . ' | ' . $companyBank, 0, 'C' );
	}

	// Colored table
	function FancyTable( $header, $data, $content ) {
		// Colors, line width and bold font
		$this->SetFillColor( 255, 0, 0 );
		$this->SetTextColor( 255 );
		$this->SetDrawColor( 128, 0, 0 );
		$this->SetLineWidth( .3 );
		$this->SetFont( '', 'B' );
		// Header
		$w = array( 10, 10, 20, 140 );
		for ( $i = 0; $i < count( $header ); $i ++ ) {
			$this->Cell( $w[ $i ], 7, $header[ $i ], 1, 0, 'C', true );
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor( 224, 235, 255 );
		$this->SetTextColor( 0 );
		$this->SetFont( '' );
		// Data

		for ( $i = 0; $i < count( $data ); $i ++ ) {
			$this->Cell( $w[ $i ], 6, utf8_decode( $data[ $i ] ), 'LR', 0, 'C' );
		}
		$this->Ln();
		$this->Cell( array_sum( $w ), 0, '', 'LR' );
		$this->Ln();
		$this->MultiCell( 180, 4.5, utf8_decode( $content ), 'TLBR' );
	}

	protected $B = 0;
	protected $I = 0;
	protected $U = 0;
	protected $HREF = '';

	function WriteHTML( $html ) {
		// HTML parser
		$html = str_replace( "\n", ' ', $html );
		$a    = preg_split( '/<(.*)>/U', $html, - 1, PREG_SPLIT_DELIM_CAPTURE );
		foreach ( $a as $i => $e ) {
			if ( $i % 2 == 0 ) {
				// Text
				if ( $this->HREF ) {
					$this->PutLink( $this->HREF, $e );
				} else {
					$this->Write( 5, $e );
				}
			} else {
				// Tag
				if ( $e[0] == '/' ) {
					$this->CloseTag( strtoupper( substr( $e, 1 ) ) );
				} else {
					// Extract attributes
					$a2   = explode( ' ', $e );
					$tag  = strtoupper( array_shift( $a2 ) );
					$attr = array();
					foreach ( $a2 as $v ) {
						if ( preg_match( '/([^=]*)=["\']?([^"\']*)/', $v, $a3 ) ) {
							$attr[ strtoupper( $a3[1] ) ] = $a3[2];
						}
					}
					$this->OpenTag( $tag, $attr );
				}
			}
		}
	}

	function OpenTag( $tag, $attr ) {
		// Opening tag
		if ( $tag == 'B' || $tag == 'I' || $tag == 'U' ) {
			$this->SetStyle( $tag, true );
		}
		if ( $tag == 'A' ) {
			$this->HREF = $attr['HREF'];
		}
		if ( $tag == 'BR' ) {
			$this->Ln( 5 );
		}
	}

	function CloseTag( $tag ) {
		// Closing tag
		if ( $tag == 'B' || $tag == 'I' || $tag == 'U' ) {
			$this->SetStyle( $tag, false );
		}
		if ( $tag == 'A' ) {
			$this->HREF = '';
		}
	}

	function SetStyle( $tag, $enable ) {
		// Modify style and select corresponding font
		$this->$tag += ( $enable ? 1 : - 1 );
		$style      = '';
		foreach ( array( 'B', 'I', 'U' ) as $s ) {
			if ( $this->$s > 0 ) {
				$style .= $s;
			}
		}
		$this->SetFont( '', $style );
	}

	function PutLink( $URL, $txt ) {
		// Put a hyperlink
		$this->SetTextColor( 0, 0, 255 );
		$this->SetStyle( 'U', true );
		$this->Write( 5, $txt, $URL );
		$this->SetStyle( 'U', false );
		$this->SetTextColor( 0 );
	}

	function RoundedRect( $x, $y, $w, $h, $r, $style = '' ) {
		$k  = $this->k;
		$hp = $this->h;
		if ( $style == 'F' ) {
			$op = 'f';
		} elseif ( $style == 'FD' || $style == 'DF' ) {
			$op = 'B';
		} else {
			$op = 'S';
		}
		$MyArc = 4 / 3 * ( sqrt( 2 ) - 1 );
		$this->_out( sprintf( '%.2F %.2F m', ( $x + $r ) * $k, ( $hp - $y ) * $k ) );
		$xc = $x + $w - $r;
		$yc = $y + $r;
		$this->_out( sprintf( '%.2F %.2F l', $xc * $k, ( $hp - $y ) * $k ) );

		$this->_Arc( $xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc );
		$xc = $x + $w - $r;
		$yc = $y + $h - $r;
		$this->_out( sprintf( '%.2F %.2F l', ( $x + $w ) * $k, ( $hp - $yc ) * $k ) );
		$this->_Arc( $xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r );
		$xc = $x + $r;
		$yc = $y + $h - $r;
		$this->_out( sprintf( '%.2F %.2F l', $xc * $k, ( $hp - ( $y + $h ) ) * $k ) );
		$this->_Arc( $xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc );
		$xc = $x + $r;
		$yc = $y + $r;
		$this->_out( sprintf( '%.2F %.2F l', ( $x ) * $k, ( $hp - $yc ) * $k ) );
		$this->_Arc( $xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r );
		$this->_out( $op );
	}

	function _Arc( $x1, $y1, $x2, $y2, $x3, $y3 ) {
		$h = $this->h;
		$this->_out( sprintf( '%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1 * $this->k, ( $h - $y1 ) * $this->k, $x2 * $this->k, ( $h - $y2 ) * $this->k, $x3 * $this->k, ( $h - $y3 ) * $this->k ) );
	}

}

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST['submitted'] ) ) {
	// Create a new PDF instance
	try {
		$company       = "Your Company";
		$companyStreet = $_POST['street'];
		$companyZip    = $_POST['zip'];
		$companyCity   = $_POST['city'];
		$firstName     = $_POST['firstName'];
		$lastName      = $_POST['lastName'];
		$btn_color = "#74BB00";
		$r = hexdec(substr($btn_color, 1, 2));
		$g = hexdec(substr($btn_color, 3, 2));
		$b = hexdec(substr($btn_color, 5, 2));
		$yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
		$text_color = ($yiq >= 198) ? 'black' : 'white';

		// Create a new PDF instance
		$pdf = new PDF();
		$pdf->AddPage();

		// Personal Information
		// 1. Personal Information
		$pdf->SetFont('Helvetica', 'B', 18);
		$pdf->Write(9, utf8_decode('1. Personal Information'));
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Helvetica', '', 9);
		$pdf->Ln();
		$pdf->SetFontSize(12);
		$pdf->SetX(10);
		$pdf->Write(7, 'Salutation: ' . $_POST['salutation']);
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Familienname: ' . $_POST['companyName']);
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Vorname: ' . $_POST['firstName']);
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Name: ' . $_POST['lastName']);
		$pdf->Ln();
		$pdf->Ln();

		// Kontaktinformationen
		$pdf->SetFont('Helvetica', 'B', 18);
		$pdf->Write(9, utf8_decode('2. Kontaktinformationen'));
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Helvetica', '', 9);
		$pdf->Ln();
		$pdf->SetFontSize(12);
		$pdf->SetX(10);
		$pdf->Write(7, 'Straße: ' . $_POST['street'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Hausnummer: ' . $_POST['houseNumber'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'PLZ: ' . $_POST['zip'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Ort: ' . $_POST['city'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Telefonnummer: ' . $_POST['phoneNumber'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Mobilnummer: ' . $_POST['mobileNumber'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'E-Mail Adresse: ' . $_POST['emailAddress'] );
		$pdf->Ln();
		$pdf->Ln();

		// Eckdaten Wärmepumpe
		$calculation      = $_POST['calculation'];
		$gesamtwohnflache = $_POST['gesamtwohnflache'];
		if ( $calculation == 'Fussbodenheizung' ) {
			if ( $gesamtwohnflache == '0-150' ) {
				$value = "Riello NXHM 8 KW";
			} elseif ( $gesamtwohnflache == '150-210' ) {
				$value = "Riello NXHM 10 KW";
			} elseif ( $gesamtwohnflache == '210-270' ) {
				$value = "Riello NXHM 12 KW";
			} elseif ( $gesamtwohnflache == '270-295' ) {
				$value = "Riello NXHM 14 KW";
			} elseif ( $gesamtwohnflache == '295-350' ) {
				$value = "Riello NXHM 16 KW";
			}
		} elseif ( $calculation == 'Konvektoren' ) {
			if ( $gesamtwohnflache == '0-150' ) {
				$value = "Viessmann Vitocal 150-A Luft/Wasser Wärmepumpe 8KW";
			} elseif ( $gesamtwohnflache == '150-210' ) {
				$value = "Viessmann Vitocal 150-A Luft/Wasser Wärmepumpe 10KW";
			} elseif ( $gesamtwohnflache == '210-270' ) {
				$value = "Viessmann Vitocal 150-A Luft/Wasser Wärmepumpe  12KW";
			} elseif ( $gesamtwohnflache == '270-295' ) {
				$value = "Viessmann Vitocal 150-A Luft/Wasser Wärmepumpe  14KW";
			} elseif ( $gesamtwohnflache == '295-350' ) {
				$value = "Viessmann Vitocal 150-A Luft/Wasser Wärmepumpe  16KW";
			}
		} elseif ( $calculation == 'Radiatoren' ) {
			if ( $gesamtwohnflache == '0-150' ) {
				$value = "Daikin WP-Außengerät Altherma 3 HHT Baugröße 8KW 400V 3-phasig";
			} elseif ( $gesamtwohnflache == '150-210' ) {
				$value = "Daikin WP-Außengerät Altherma 3 HHT Baugröße 10KW 400V 3-phasig";
			} elseif ( $gesamtwohnflache == '210-270' ) {
				$value = "Daikin WP-Außengerät Altherma 3 HHT Baugröße 12KW 400V 3-phasig";
			} elseif ( $gesamtwohnflache == '270-295' ) {
				$value = "Daikin WP-Außengerät Altherma 3 HHT Baugröße 14KW 400V 3-phasig";
			} elseif ( $gesamtwohnflache == '295-350' ) {
				$value = "Daikin WP-Außengerät Altherma 3 HHT Baugröße 16KW 400V 3-phasig";
			} elseif ( $gesamtwohnflache == '350-380' ) {
				$value = "Daikin WP-Außengerät Altherma 3 HHT Baugröße 18KW 400V 3-phasig";
			}
		}

		$personen = $_POST['personen'];
		if ( $personen == '1-4' ) {
			$hygiene        = '150';
			$heizungspuffer = "200";
		} else if ( $personen == '4-7' ) {
			$heizungspuffer = "300";
			$hygiene        = '250';
		} else if ( $personen == '7-9' ) {
			$hygiene        = '350';
			$heizungspuffer = "500";
		} else if ( $personen == '9-13' ) {
			$hygiene        = '500';
			$heizungspuffer = "600";
		}

		$pdf->SetFont('Helvetica', 'B', 18);
		$pdf->Write(9, utf8_decode('3. Eckdaten Wärmepumpe'));
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Helvetica', '', 9);
		$pdf->Ln();
		$pdf->SetFontSize(12);
		$pdf->SetX(10);
		$pdf->Write(7, 'Heizkörper: ' . $_POST['calculation'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Baujahr: ' . $_POST['baujahr'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Wärmeerzeuger: ' . $value );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Heizenergieart: ' . $_POST['heizenergieart'] ); // Assuming the same field for Heizenergieart as for Heizkörper
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Heizenergieverbrauch: ' . $_POST['heizenergieverbrauch'] );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Anzahl der Personen im Haus: ' . $personen );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Hygiene Speicher (L): ' . $hygiene );
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(7, 'Heizungspuffer Speicher (L): ' . $heizungspuffer );
		$pdf->Ln();
//		$pdf->AddPage(); // Adding a new page for additional content
//		$pdf->Ln();

		// Zusatzvereinbarungen
		$pdf->SetX(10);
		$pdf->Write(7, 'Zusatzvereinbarungen: ' . ( is_null( $_POST['agreements'] ) ? '' : implode( ', ', $_POST['agreements'] ) ) );
		$pdf->Ln();
		$pdf->Ln();

		// Angebot
		$pdf->SetFont('Helvetica', 'B', 22);
		$pdf->Write(11, utf8_decode('4. Angebot'));
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Helvetica', '', 12);
		$pdf->Ln();
		$pdf->SetFontSize(12);
		$pdf->SetX(10);
		$pdf->Write(6, 'Gesamt netto(€) :' . $_POST['totalExcl']);
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(6, 'Gesamt brutto(€) :' . $_POST['totalIncl']);
		$pdf->Ln();
		$pdf->SetX(10);
		$pdf->Write(6, 'Angebot per Post senden: ' . (isset($_POST['byMail']) ? 'Ja' : 'Nein'));

		// Output the PDF
		$pdf->Output( __DIR__ . '/AngebotPDF.pdf', 'F' );
		echo "SUCCESSPDF_URL=" . site_url( 'wp-content/themes/swb/angebote/AngebotPDF.pdf' );
		exit();
	} catch ( Exception $exception ) {
		error_log( $exception->getMessage() );
	}
}
exit;


$inverter = get_option( 'defaultinverter' );

define( 'EUR', utf8_encode( ' ' . chr( 128 ) ) );
$storage = $_POST['storage'];
$module  = $_POST['module'];
if ( $_POST['inverter'] ) {
	$inverter = $_POST['inverter'];
}
$moduleqty = $_POST['moduleqty'];
if ( empty( $moduleqty ) ) {
	$moduleqty = 1;
}

$energy      = $_POST['energy'];
$energyCosts = $_POST['energycosts'];
$salutation  = utf8_decode( $_POST['salutation'] );
$name        = utf8_decode( $_POST['firstName'] );
$lastName    = utf8_decode( $_POST['lastName'] );
$street      = utf8_decode( $_POST['street'] );
$houseNumber = utf8_decode( $_POST['houseNumber'] );
$zip         = utf8_decode( $_POST['zip'] );
$city        = utf8_decode( $_POST['city'] );

if ( isset( $_POST['additionals'] ) ) {
	$addtionals = utf8_decode( $_POST['additionals'] );
}
$email     = utf8_decode( $_POST['emailAddress'] );
$totalExcl = utf8_decode( $_POST['totalExcl'] );
$totalIncl = utf8_decode( $totalExcl * ( 1 + (int) get_option( 'mwst' ) / 100 ) );

if ( is_array( $_POST['agreements'] ) ) {
	$agreements = $_POST['agreements'];
} else if ( ! empty( $_POST['agreements'] ) ) {
	$agreementString = $_POST['agreements'];
	$agreements      = explode( ',', $agreementString );

}

$calculation = utf8_decode( $_POST['calculation'] );
$sendPdf     = utf8_decode( $_POST['sendpdf'] );
$postAuthor  = utf8_decode( $_POST['post_author'] );
$postID      = '';
if ( ! empty( $_POST['postid'] ) ) {
	$postID = $_POST['postid'];
} else {
	$postID = utf8_decode( $_POST['post_ID'] );
}
$byMail = utf8_decode( $_POST['byMail'] );


$hex = get_option( 'color' );
list( $r, $g, $b ) = sscanf( $hex, "#%02x%02x%02x" );

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins( 15, 0 );
$pdf->SetDrawColor( 100, 100, 100 );
$pdf->SetFillColor( $r, $g, $b );

if ( ! $_POST['confirmation'] ) {
	$pdf->AddPage();
	$pdf->Write( 6.5, ' ' );
	$pdf->Ln();
	$pdf->MultiCell( 60, 5, $salutation . chr( 10 ) . $name . ' ' . $lastName . chr( 10 ) . $street . ' ' . $houseNumber . chr( 10 ) . $zip . ' ' . $city, '', 'L' );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
}


$user = wp_get_current_user();
if ( $postAuthor ) {
	$userMail  = get_the_author_meta( 'user_email', $postAuthor );
	$userName  = get_the_author_meta( 'display_name', $postAuthor );
	$userPhone = get_the_author_meta( 'handynummer', $postAuthor );
} else {
	$userName  = $user->display_name;
	$userMail  = $user->user_email;
	$userPhone = $user->handynummer;
}

if ( ! empty( get_the_author_meta( 'mailtext', $postAuthor ) ) ) {
	$mailtext = get_the_author_meta( 'mailtext', $postAuthor );
} else if ( $user->mailtext ) {
	$mailtext = $user->mailtext;
} else {
	$mailtext = 'anbei erhalten Sie unser Angebot für Ihre Wärmepumpe.<br> 
    <br>
    Für weitere Fragen steht Ihnen ' . $userName . ' gerne zur Verfügung<br>
    <b>Kontakt: ' . $userPhone . ' | ' . $userMail . '</b>
    <br>
    <br>
    Vielen Dank.<br><br>
Mit freundlichen Grüßen,<br>
Ihr ' . $companyWithoutForm . ' Team';
}

if ( ! $_POST['confirmation'] ) {
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 90, 11, 1, 'F' );
	$pdf->Ln( 1.2 );
	$pdf->Cell( 1 );
	$pdf->MultiCell( 90, 4.5, utf8_decode( 'Ihr persönlicher Berater: ' . $userName . '
Kontakt: ' . ( $userPhone ? $userPhone : get_option( 'telefon' ) ) . ' | ' . ( $userMail ? $userMail : get_option( 'email' ) ) ) );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->SetFillColor( $r, $g, $b );
	$pdf->setY( $pdf->getY() - 10 );
	$pdf->Cell( 0, 5, $companyCity . ', ' . date( "d.m.Y" ), 0, 0, 'R' );
	$pdf->Ln();
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$pdf->SetFont( 'Helvetica', 'B', 18 );
	$pdf->Write( 9, utf8_decode( 'Ihr persönliches Angebot' ) );
	$pdf->SetTextColor( $r, $g, $b );
	$pdf->Write( 9, ' #' . $postID );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->SetFont( 'Helvetica', '', 9 );
	$pdf->Ln();
	$pdf->Ln();
	if ( $salutation === 'Herr' ) {
		$pdf->Write( 5, 'Sehr geehrter Herr ' . $lastName . ',' );
	} else {
		$pdf->Write( 5, 'Sehr geehrte Frau ' . $lastName . ',' );
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Write( 4.5, utf8_decode( 'wir freuen uns, Ihnen heute das Angebot für Ihre Wärmepumpe zusenden zu können.

Gerne stehen wir Ihnen jederzeit mit Rat und Tat zur Seite und unterstützen Sie in der zügigen Planung, Errichtung und Installation Ihrer Photovoltaik-Anlage.

Sie erreichen uns Montags bis Freitags, zwischen ' . get_option( 'openingHours' ) . ', unter folgender Telefonnummer: ' . $companyPhone . '. Selbstverständlich dürfen Sie uns, auch außerhalb unserer Geschäftszeiten kontaktieren, Nutzen Sie hierfür unsere E-Mail-Adresse: ' . get_option( 'email' ) . '.

Auf den folgenden Seiten finden Sie Ihr persönliches Angebot sowie die jeweiligen Datenblätter zu den Komponenten.

Wir freuen uns auf Ihre Bestellung und sichern Ihnen pünktliche Lieferung und Montage zu.
Bei Fragen steht Ihnen das gesamte Team der ' . $company . ' zur Verfügung.						
											
Mit freundlichen Grüßen,
' .
	                               $company ) );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	//$pdf->Image( __DIR__ . '/img/club-premiumpartner.jpg', 80, $pdf->getY(), 50, 0, 'JPG' );
}
$pdf->AddPage();
$pdf->SetAutoPageBreak( true, 35 );
$pdf->Ln();
$pdf->MultiCell( 60, 5, $salutation . chr( 10 ) . $name . ' ' . $lastName . chr( 10 ) . $street . ' ' . $houseNumber . chr( 10 ) . $zip . ' ' . $city, '', 'L' );
$pdf->setY( $pdf->getY() - 6 );
if ( $_POST['confirmation'] ) {
	$pdf->SetFont( 'Helvetica', 'B', 15 );
	$pdf->Cell( 180, 5, utf8_decode( 'Auftragsbestätigung zu Ihrem Auftrag #' . $postID ), '', '', 'R' );
} else {
	$pdf->SetFont( 'Helvetica', 'B', 18 );
	$pdf->Cell( 180, 5, 'Angebotsdetails #' . $postID, '', '', 'C' );
}
$pdf->Ln( 6 );
$pdf->Ln();
$pdf->SetFont( 'Helvetica', '', 9 );

$pdf->setTextColor( 255, 255, 255 );
$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, 12, 1, 'F' );
$pdf->Ln( 1.5 );
$pdf->SetFont( 'Helvetica', 'B', 9 );
$pdf->MultiCell( 180, 4.5, utf8_decode( 'Leistungsübersicht der ' . $company ), '', 'C' );
$pdf->SetFont( 'Helvetica', '', 9 );
$pdf->MultiCell( 180, 4.5, utf8_decode( 'Beratung | Planung | Finanzservice | Logistik | Montage und Inbetriebnahme durch unsere zertifizierten Fachkräfte' ), '', 'C' );
$pdf->setTextColor( 0, 0, 0 );

//$pdf->MultiCell( <b>') . number_format(get_post_meta($module, 'typ', true) * $moduleqty / 1000, 2, ',',  '.'). ' kWp</b>)
if ( ! empty( $addtionals ) ) {
	$pdf->Ln();
	$pdf->SetFillColor( 208, 0, 0 );
	$pdf->setTextColor( 255, 255, 255 );
	$height = ( ceil( ( $pdf->GetStringWidth( 'Zusatzvereinbarungen: ' . $addtionals ) / 180 ) ) * 5 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, $height + 3, 1, 'F' );
	$pdf->Ln( 2 );
	$pdf->Cell( 3 );
	$pdf->MultiCell( 174, 4.5, 'Zusatzvereinbarungen: ' . $addtionals, '', 'C', '' );
	$pdf->SetFillColor( $r, $g, $b );
	$pdf->Ln( 3 );
	$pdf->setTextColor( 0, 0, 0 );
}

$pdf->Ln( 3 );
$pdf->Ln();
$pdf->SetFont( 'Helvetica', 'B' );
$pdf->MultiCell( 130, 5, utf8_decode( 'Solarstromanlage inkl. Energiespeichersystem mit einer Leistung von: ' ) );
$pdf->SetXY( 165, $pdf->getY() - 6.5 );
$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 7, 1, 'F' );
$pdf->setTextColor( 255, 255, 255 );
$pdf->MultiCell( 30, 7, number_format( get_post_meta( $module, 'typ', true ) * $moduleqty / 1000, 2, ',', '.' ) . ' kWp', '', 'C' );
$pdf->setTextColor( 0, 0, 0 );
$pdf->SetFont( 'Helvetica', '' );
$pdf->Ln( 2 );
$pdf->SetTextColor( 255, 255, 255 );
$pdf->SetFont( 'Helvetica', 'B' );
$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, 7, 1, 'F' );
$pdf->Cell( 3 );
$pdf->Cell( 10, 7, 'POS', '', '', '' );
$pdf->Cell( 20, 7, utf8_decode( 'Einheit' ), '', '', '' );
$pdf->Cell( 155, 7, utf8_decode( 'Bezeichnung' ), '', '', '' );
$pdf->Ln();
$pdf->Ln( 2 );
$pdf->SetTextColor( 0, 0, 0 );


$inverterInformation = get_post_meta( $inverter );
$anhanginverter      = $inverterInformation['anhang'][0];

/*$storageInformation  = get_post_meta( $storage );
$moduleInformation   = get_post_meta( $module );
$anhangStorage       = $storageInformation['anhang'][0];
$anhangModule        = $moduleInformation['anhang'][0];
$moduleName          = $moduleInformation['pvmoduleid'][0];
$storagename         = $storageInformation['typ'][0];
$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, 7, 1, 'F' );
$pdf->SetFont( 'Helvetica', 'B' );
$pdf->SetTextColor( 255, 255, 255 );
$pdf->Cell( 3 );
$pdf->Cell( 10, 7, 1, '', '', '', );
$pdf->Cell( 20, 7, utf8_decode( $moduleqty . ' Stück' ), '', '', '', );
$pdf->Cell( 155, 7, utf8_decode( 'Hochleistungsmodule' ), '', '', '', );
$pdf->SetFont( 'Helvetica' );
$pdf->SetTextColor( 0, 0, 0 );
$pdf->Ln();
$pdf->Ln( 3 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Markenhersteller: ' . utf8_decode( $moduleInformation['hersteller'][0] ), 0, 'L' );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Modulleistung: ' . utf8_decode( $moduleInformation['typ'][0] ) . ' Watt', 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Typ: ' . utf8_decode( $moduleInformation['pvmoduleid'][0] ), 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Zelltyp: ' . utf8_decode( $moduleInformation['modultechnik'][0] ), 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Leistungstoleranz: ' . utf8_decode( $moduleInformation['leistungstoleranz'][0] ), 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Modulabmessung: ' . $moduleInformation['modulabmessungB'][0] . ' x ' . $moduleInformation['modulabmessungH'][0] . ' x ' . $moduleInformation['modulabmessungT'][0] . ' (BxHxT)', 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Gewicht: ' . utf8_decode( $moduleInformation['kg'][0] ), 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Modulwirkungsgrad: ' . utf8_decode( $moduleInformation['wirkungsgrad'][0] ), 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Max. Druckbelastung: ' . utf8_decode( $moduleInformation['schneelast'][0] ) . ' Pa', 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, 'Produktgarantie: ' . utf8_decode( $moduleInformation['leistungsgarantie'][0] ), 0, 5 );
$pdf->Cell( 3 );
$pdf->MultiCell( 151, 4.5, utf8_decode( 'Ausführliche technische Daten zu den Modulen erhalten Sie mit dem Moduldatenblatt' ), 0, 5 );
$pdf->Ln( 3 );*/

/*if ( $storage ) {
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

	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, 7, 1, 'F' );
	$pdf->Cell( 3 );

	$i = 3;
	$pdf->SetFont( 'Helvetica', 'B' );
	$pdf->SetTextColor( 255, 255, 255 );
	$pdf->Cell( 10, 7, 2, '', '', '', );
	$pdf->Cell( 20, 7, utf8_decode( '1 Stück' ), '', '', '', );
	$pdf->Cell( 155, 7, utf8_decode( $storageInformation['typ'][0] ), '', '', '', );
	$pdf->SetFont( 'Helvetica' );
	$pdf->SetTextColor( 0, 0, 0 );
	$pdf->Ln();
	$pdf->Ln( 3 );

	foreach ( $storageArray as $storageInfo ) {
		if ( ! empty( $storageInfo ) ) {
			$pdf->Cell( 3 );
			$pdf->SetFont( 'zapfdingbats', '', 9 );
			$pdf->Cell( 4, 4.5, chr( 51 ) );
			$pdf->SetFont( 'Helvetica', '', 9 );
			$pdf->MultiCell( 151, 4.5, utf8_decode( $storageInfo ), 0, 5 );
		}
	}
	$pdf->Ln( 3 );
} else {*/
$i = 2;
//}

if ( $inverter ) {
	$inverterArray = array(
		$inverterInformation['beschreibung'][0],
		$inverterInformation['beschreibung2'][0],
		$inverterInformation['beschreibung3'][0],
		$inverterInformation['beschreibung4'][0],
		$inverterInformation['beschreibung5'][0],
		$inverterInformation['beschreibung6'][0]
	);

	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, 7, 1, 'F' );
	$pdf->Cell( 3 );

	$pdf->SetFont( 'Helvetica', 'B' );
	$pdf->SetTextColor( 255, 255, 255 );
	$pdf->Cell( 10, 7, $i, '', '', '', );
	$pdf->Cell( 20, 7, utf8_decode( 'pauschal' ), '', '', '', );
	$pdf->Cell( 155, 7, utf8_decode( $inverterInformation['name'][0] ), '', '', '', );
	$pdf->SetFont( 'Helvetica' );
	$pdf->SetTextColor( 0, 0, 0 );
	$pdf->Ln();
	$pdf->Ln( 3 );

	foreach ( $inverterArray as $inverterInfo ) {
		if ( ! empty( $inverterInfo ) ) {
			$pdf->Cell( 3 );
			$pdf->SetFont( 'zapfdingbats', '', 9 );
			$pdf->Cell( 4, 4.5, chr( 51 ) );
			$pdf->SetFont( 'Helvetica', '', 9 );
			$pdf->MultiCell( 151, 4.5, utf8_decode( $inverterInfo ), 0, 5 );
		}
	}
}

$pdf->Ln( 3 );

$args  = array( 'post_type' => 'misc', 'posts_per_page' => - 1, 'order' => 'ASC' );
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	while ( $query->have_posts() ) : $query->the_post();

		$miscInformation = get_post_meta( get_the_ID() );
		$valueCount      = count( array_filter( $miscInformation, function ( $value ) {
			return ! empty( $value[0] ) && $value[0] !== '';
		} ) ); // - 2 Einträge;
		$heightLeft      = ( 276 - $pdf->getY() );
		if ( $heightLeft < $valueCount * 6 + 3 ) {
			$pdf->AddPage();
			$pdf->Ln( 3 );
		}
		$pdf->SetFont( 'Helvetica', 'B' );
		$pdf->SetTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, 7, 1, 'F' );
		$pdf->Cell( 3 );
		$pdf->Cell( 10, 7, $i + 1, '', '', '', '' );
		foreach ( $miscInformation as $key => $val ) {
			if ( $key === 'einheit' ) {
				$pdf->SetTextColor( 255, 255, 255 );
				//$pdf->SetFont('Helvetica','B',9);
				$pdf->Cell( 20, 7, utf8_decode( $val[0] ), '', '', '', );
			} else if ( $key === 'name' && ! empty( $val[0] ) ) {
				$pdf->SetTextColor( 255, 255, 255 );
				$pdf->Cell( 155, 7, utf8_decode( $val[0] . ' ' ), '', '', '', );
				$pdf->Ln();
				$pdf->Ln( 3 );
			} else if ( $key != '_edit_lock' && $key != '_edit_last' && ! empty( $val[0] ) ) {
				$pdf->Cell( 3 );
				$pdf->SetTextColor( 0, 0, 0 );
				$pdf->SetFont( 'zapfdingbats', '', 9 );
				$pdf->Cell( 4, 4.5, chr( 51 ) );
				$pdf->SetFont( 'Helvetica', '', 9 );
				$pdf->MultiCell( 170, 4.5, utf8_decode( $val[0] ), 0, 5 );
				$pdf->SetAutoPageBreak( true, 35 );
				//$pdf->writeHTML(utf8_encode($val[0]));
				//$pdf->Write(5, chr(149). ' '. utf8_decode($val[0]));
			}
		}
		$pdf->Ln( 3 );
		$i ++;

	endwhile;

	if ( ! empty( $agreements ) ) {

		$heightLeft2 = ( 276 - $pdf->getY() );
		$valueCount2 = count( array_filter( $agreements, function ( $value ) {
			return ! empty( $value[0] ) && $value[0] !== '';
		} ) ); // - 2 Einträge;
		//var_dump($heightLeft2);die;
		if ( $heightLeft2 < $valueCount2 * 6 + 10 ) {
			$pdf->AddPage();
			$pdf->Ln( 3 );
		}

		$pdf->SetFillColor( 208, 0, 0 );
		$pdf->setTextColor( 255, 255, 255 );

		$pdf->SetFont( 'Helvetica', 'B' );
		$pdf->SetTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 180, 7, 1, 'F' );
		$pdf->Cell( 3 );
		$pdf->Cell( 10, 7, $i + 1, '', '', '', '' );

		$pdf->SetTextColor( 255, 255, 255 );
		//$pdf->SetFont('Helvetica','B',9);
		$pdf->Cell( 20, 7, ' ', '', '', '', );

		$pdf->SetTextColor( 255, 255, 255 );
		$pdf->Cell( 155, 7, utf8_decode( 'Zusatzvereinbarungen' ), '', '', '', );
		$pdf->Ln();
		$pdf->Ln( 3 );

		foreach ( $agreements as $agreement ) {
			$pdf->Cell( 3 );
			$pdf->SetTextColor( 0, 0, 0 );
			$pdf->SetFont( 'zapfdingbats', '', 9 );
			$pdf->Cell( 4, 4.5, chr( 51 ) );
			$pdf->SetFont( 'Helvetica', '', 9 );

			$pdf->MultiCell( 170, 4.5, ( isset( $_POST[ 'qty-' . $agreement ] ) ? $_POST[ 'qty-' . $agreement ] . 'x ' : '' ) . utf8_decode( str_replace( " €", EUR, get_post_meta( $agreement, 'beschreibung', true ) ) ), 0, 5 );
			$pdf->SetAutoPageBreak( true, 35 );
		}
		$pdf->SetFillColor( $r, $g, $b );
	}

	if ( 277 - $pdf->getY() < 150 ) {
		$pdf->AddPage();
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', 'B', 20 );
	$pdf->Cell( 180, 5, utf8_decode( 'Zahlungsmodalitäten' ), '', '', 'C', '' );
	$pdf->SetFont( 'Helvetica', 'B', 9 );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();

	$paymentModalities = (array) json_decode( get_option( 'abschlag' ) );
	foreach ( $paymentModalities as $key => $value ) {
		$pdf->MultiCell( 150, 5, $pdf->writeHTML( utf8_decode( $value ) ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->MultiCell( 30, 5, number_format( $totalIncl * $key / 100, 2, ',', '.' ) . utf8_decode( EUR ), '', 'R' );
	}

	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', '', 9 );
	$pdf->Ln();
	$pdf->MultiCell( 158, 5, $pdf->writeHTML( utf8_decode( get_option( 'zahlung3' ) ) ), '', 'L' );
	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', 'B', 9 );
	$pdf->MultiCell( 150, 5, 'Gesamtsumme Netto', '', 'R' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->MultiCell( 30, 5, number_format( $totalExcl, 2, ',', '.' ) . utf8_decode( EUR ), 0, 'R' );
	$pdf->MultiCell( 150, 5, get_option( 'mwst' ) . '% MwSt.', '', 'R' );
	$pdf->setFont( 'Helvetica', '' );
	$pdf->setFontSize( 7 );
	//$pdf->MultiCell(150, 3, '(kann vom Finanzamt erstattet werden)', '', 'R');
	$pdf->setFont( 'Helvetica', 'B' );
	$pdf->setFontSize( 9 );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->MultiCell( 30, 5, number_format( ( $totalIncl - $totalExcl ), 2, ',', '.' ) . utf8_decode( EUR ), 0, 'R' );
	$pdf->MultiCell( 150, 5, 'Gesamtsumme Brutto', '', 'R' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->MultiCell( 30, 5, number_format( $totalIncl, 2, ',', '.' ) . utf8_decode( EUR ), 0, 'R' );
	$pdf->SetFont( 'Helvetica', '', 9 );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->RoundedRect( $pdf->getX() + 40, $pdf->getY(), 100, 16.5, 1, 'F' );
	$pdf->Ln( 1.5 );
	$pdf->MultiCell( 180, 4.5, utf8_decode( get_option( 'zahlung4' ) ) . chr( 10 ) . utf8_decode( 'Telefon: ' . get_option( 'telefon' ) . ', E-Mail: ' . get_option( 'email' ) ) . chr( 10 ) . utf8_decode( get_option( 'marketing' ) ), '', 'C' );
	$pdf->SetFillColor( $r, $g, $b );
	$pdf->setTextColor( 0, 0, 0 );
	if ( ! $_POST['confirmation'] ) {
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Write( 5, utf8_decode( 'Hiermit nehme ich das Angebot vom ' . date( "d.m.Y" ) . ' an und beauftrage die ' . $company . ' zur Durchführung meines Projektes.' ) );
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Write( 5, $city . ', ' . date( "d.m.Y" ) );
		$pdf->Ln();
		$pdf->Cell( 180, 5, utf8_decode( 'Ort, Datum, Unterschrift ' ) . $name . ' ' . $lastName, 'T', '', '', '' );
		$pdf->Ln();
		$pdf->Ln();
		$pdf->setFontSize( 7 );
		//$pdf->setX(45);
		$pdf->MultiCell( 180, 3, utf8_decode( 'Sofern eine Teilzahlungsvereinbarung geschlossen wird, wird diese zum wesentlichen Bestandteil dieses Auftrages. Die o.g. Zahlungsbedingungen entfallen dann, der Zahlungsausgleich des offenen Betrages erfolgt in diesen Fällen nach Abnahme durch die refinanzierende Bank. Wir weisen Sie hiermit darauf hin, dass die staatlichen Fördermittel nicht Bestandteil dieses Angebots sind und die Firma ' . $company . ' keine Haftung dafür übernimmt.' ), '', 'L', '' );
		$pdf->setFontSize( 9 );

	}
endif;

function find( array $pricing, $needle ) {
	$last = null; // return value if $pricing array is empty

	foreach ( $pricing as $key => $value ) {
		if ( $key >= $needle ) {
			return $key; // found it, return quickly
		}
		$last = $key; // keep the last key thus far
	}

	return $last;
}

$json = json_decode( get_option( 'cloudgroesse' ) );
$json = (array) $json;

$energy30           = $energy * 0.3;
$sunHours           = 1000; // VARIABEL?
$cloudsize          = find( $json, $energy30 );
$cloudsizePrice     = $json[ $cloudsize ];
$totalPower         = get_post_meta( $module, 'typ', true ) * $moduleqty / 1000;
$energy70           = $energy * 0.7;
$energy80           = $energy * 0.8;
$yearPower          = $sunHours * $totalPower;
$kwhPrice           = number_format( $energyCosts / $energy, 3, ',', '.' );
$kwhPriceCalculated = number_format( $energyCosts / $energy, 3 );
$kw10Price          = number_format( get_option( 'kw10' ), 3, ',', '.' );
$ockw10Price        = number_format( get_option( 'kw10' ), 3, ',', '.' );
$kw10kw40Price      = number_format( get_option( 'kw10kw40' ), 3, ',', '.' );
$ockw10kw40Price    = number_format( get_option( 'ockw10kw40' ), 3, ',', '.' );
$kwhPriceBackend    = number_format( get_option( 'kwhprice' ), 3, ',', '.' );


if ( $totalPower >= 10 ) {
	if ( isset( $storageInformation ) && $storageInformation['cloud'][0] != 'Ja' ) {
		$savings = ( $yearPower - $energy80 ) * get_option( 'kw10kw40' );
	} else {
		$savings = ( $yearPower - $energy ) * get_option( 'kw10kw40' );
	}
} else {
	if ( isset( $storageInformation ) && $storageInformation['cloud'][0] != 'Ja' ) {
		$savings = ( $yearPower - $energy80 ) * get_option( 'kw10' );
	} else {
		$savings = ( $yearPower - $energy ) * get_option( 'kw10' );
	}
}

$savingsConsumption   = $energy70 * $kwhPriceCalculated;
$savingsConsumption80 = $energy80 * $kwhPriceCalculated;
$savingsConsumption30 = $energy30 * $kwhPriceCalculated;

$savingsOc = '';

if ( $totalPower >= 10 ) {
	$savingsOc = ( $yearPower - $energy30 ) * get_option( 'ockw10kw40' ) + ( $energy30 * $kwhPriceCalculated );
} else {
	$savingsOc = ( $yearPower - $energy30 ) * get_option( 'ockw10' ) + ( $energy30 * $kwhPriceCalculated );
}

if ( $calculation === 'Ja' && ! $_POST['confirmation'] ) {
	$pdf->AddPage();
	$pdf->Ln();

	$pdf->SetFont( 'Helvetica', 'B', 18 );
	$pdf->Ln();
	if ( $storageInformation['cloud'][0] === 'Ja' && $storage ) {
		$pdf->Cell( 180, 5, utf8_decode( 'Wirtschaftlichkeitsberechnung mit Cloud' ), '', '', 'L' );
	} else {
		$pdf->Cell( 180, 5, utf8_decode( 'Wirtschaftlichkeitsberechnung ohne Cloud' ), '', '', 'L' );
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', '', 9 );

	$pdf->MultiCell( 30, 5, utf8_decode( 'Modultyp: ' ), '', 'L' );
	$pdf->SetXY( 40, $pdf->getY() - 5 );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 55, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 55, 5, utf8_decode( get_post_meta( $module, 'pvmoduleid', true ) . ' - ' . get_post_meta( $module, 'typ', true ) . ' Watt' ), '', 'C' );
	$pdf->setTextColor( 0, 0, 0 );

	$pdf->SetXY( 100, $pdf->getY() - 5 );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->MultiCell( 60, 5, utf8_decode( 'Anzahl-Module: ' ), '', 'L' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 29.5, 5, $moduleqty, '', 'R' );
	$pdf->setTextColor( 0, 0, 0 );

	$pdf->MultiCell( 65, 5, utf8_decode( 'Gesamtleistung:' ), '', 'L' );
	$pdf->SetXY( 40, $pdf->getY() - 5 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 55, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 55, 5, utf8_decode( number_format( $totalPower, 2, ',', '.' ) . ' kWp' ), '', 'C' );
	$pdf->SetXY( 100, $pdf->getY() - 5 );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->MultiCell( 60, 5, utf8_decode( 'In Simulation ermittelte kWh/KWp  p.a.:' ) );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 29.5, 5, number_format( $sunHours, 0, ',', '.' ), '', 'R' );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->Ln();
	$pdf->MultiCell( 150, 5, utf8_decode( 'Ergibt Jahresleistung der Anlage in kWh (nach gängiger Simulationssoftware):' ), '', 'L' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $yearPower, 0, ',', '.' ) ), '', 'R' );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', 'B' );
	$pdf->Write( 5, utf8_decode( 'In Simulation ermittelte Einspeisevergütung/Ersparnis (Eigenverbrauch berücksichtigt): ' ) );
	$pdf->SetFont( 'Helvetica', '' );
	$pdf->Ln();
	$pdf->Ln();

	if ( $totalPower >= 10 && $storageInformation['cloud'][0] === 'Ja' ) {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Über 10 kW bis 40 kW' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $yearPower - $energy70 - $energy30, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kw10kw40Price . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( '/kWh nach EEG: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $yearPower - $energy70 - $energy30 ) * get_option( 'kw10kw40' ), 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $totalPower >= 10 && $storage ) {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Über 10 kW bis 40 kW' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $yearPower - $energy80, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kw10kw40Price . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( '/kWh nach EEG: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $yearPower - $energy80 ) * get_option( 'kw10kw40' ), 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $totalPower >= 10 ) {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Über 10 kW bis 40 kW' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $yearPower - $energy30, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $ockw10kw40Price . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( '/kWh nach EEG: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $yearPower - $energy30 ) * get_option( 'ockw10kw40' ), 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $storage && $storageInformation['cloud'][0] === 'Ja' ) {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Bis 10 kW' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $yearPower - $energy70 - $energy30, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kw10Price . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( '/kWh nach EEG: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $yearPower - $energy30 - $energy70 ) * get_option( 'kw10' ), 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $storage ) {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Bis 10 kW' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $yearPower - $energy80, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kw10Price . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( '/kWh nach EEG: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $yearPower - $energy80 ) * get_option( 'kw10' ), 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Bis 10 kW' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $yearPower - $energy30, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $ockw10Price . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( '/kWh nach EEG: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $yearPower - $energy30 ) * get_option( 'ockw10' ), 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	}


	if ( $storageInformation['cloud'][0] === 'Ja' && $storage ) {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Ersparnis aus Eigenverbrauch ' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $energy70, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kwhPrice . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( 'kWh / Strompreis inkl.Grundpreis: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $energy70 * $kwhPriceCalculated, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 65, 5, utf8_decode( 'Ersparnis aus ihrer Cloudsystem' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $energy30, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kwhPrice . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( 'kWh / Strompreis inkl.Grundpreis: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $energy30 * $kwhPriceCalculated, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $storage ) {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Ersparnis Eigenverbrauch 80%' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $energy80, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->setFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kwhPrice . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( 'kWh / Strompreis inkl. Grundpreis: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $energy80 ) * $kwhPriceCalculated, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else {
		$pdf->MultiCell( 65, 5, utf8_decode( 'Ersparnis Eigenverbrauch 30%' ), '', 'L' );
		$pdf->SetXY( 65, $pdf->getY() - 5 );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->MultiCell( 15, 5, number_format( $energy * 0.3, 0, ',', '.' ), '', 'R' );
		$pdf->SetXY( 80.5, $pdf->getY() - 5 );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->setFillColor( 220, 220, 220 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 15, 4.5, 1, 'F' );
		$pdf->SetFillColor( $r, $g, $b );
		$pdf->MultiCell( 15, 5, utf8_decode( $kwhPrice . EUR ), '', 'R' );
		$pdf->SetXY( 100, $pdf->getY() - 5 );
		$pdf->MultiCell( 60, 5, utf8_decode( 'kWh / Strompreis inkl. Grundpreis: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $energy * 0.3 ) * $kwhPriceCalculated, 2, ',', '.' ) . EUR ), '', 'R' );
	}
	$pdf->setTextColor( 0, 0, 0 );

	$pdf->Ln();
	$pdf->Ln();
	if ( $storage && $storageInformation['cloud'][0] === 'Ja' ) {
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung + Ersparnis jährlich gesamt ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savings + $savingsConsumption + $savingsConsumption30, 2, ',', '.' ) . EUR ), 0, 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung + Ersparnis monatlich gesamt ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $savings + $savingsConsumption + $savingsConsumption30 ) / 12, 2, ',', '.' ) . EUR ), 0, 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $storage ) {
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung + Ersparnis jährlich gesamt ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savings + $savingsConsumption80, 2, ',', '.' ) . EUR ), 0, 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung + Ersparnis monatlich gesamt ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $savings + $savingsConsumption80 ) / 12, 2, ',', '.' ) . EUR ), 0, 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else {
		//Kein Speicher, keine Cloud
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung + Ersparnis jährlich gesamt ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savingsOc, 2, ',', '.' ) . EUR ), 0, 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung + Ersparnis monatlich gesamt ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savingsOc / 12, 2, ',', '.' ) . EUR ), 0, 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	}

	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', 'B' );
	$pdf->MultiCell( 150, 5, utf8_decode( 'Komplettpreis für anschlussfertige Photovoltaik-Anlage: ' ), '', 'L' );
	$pdf->SetFont( 'Helvetica', '' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->SetFillColor( 255, 187, 36 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 29.5, 5, number_format( $totalExcl, 2, ',', '.' ) . utf8_decode( EUR ), 0, 'R' );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->MultiCell( 150, 5, 'Mehrwertsteuer ' . get_option( 'mwst' ) . '% ', '', 'L' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 29.5, 5, number_format( ( $totalIncl - $totalExcl ), 2, ',', '.' ) . utf8_decode( EUR ), 0, 'R' );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->MultiCell( 150, 5, 'Gesamtsumme Brutto', '', 'L' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 29.5, 5, number_format( $totalIncl, 2, ',', '.' ) . utf8_decode( EUR ), 0, 'R' );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->SetFont( 'Helvetica', '', 9 );
	$pdf->Ln();
	$pdf->Write( 5, utf8_decode( 'Bei Finanzierung der Anlage wird durch die Mehrwertsteuererstattung i.d.R. nur der Nettobetrag finanziert.' ) );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', 'B' );
	$pdf->Write( 5, utf8_decode( 'Ertrag im Verhältnis zur Nettoinvestition:' ) );
	$pdf->SetFont( 'Helvetica', '' );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor( $r, $g, $b );
	if ( $storage && $storageInformation['cloud'][0] === 'Ja' ) {
		$pdf->MultiCell( 150, 5, 'Einspeiseertrag (netto) pro Jahr laut Simulation:', '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savings + $savingsConsumption + $savingsConsumption30, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 150, 5, utf8_decode( 'abzügl. üblicher Kosten Grundpreis Cloud System jährlich' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $cloudsizePrice * 12, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 150, 5, utf8_decode( 'Rückliefermenge in kWh Cloud System jährlich' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, number_format( $cloudsize, 0, ',', '.' ) . ' kWh', '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 150, 5, utf8_decode( 'Anlagen-Ertrag p.a. ¹' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savings + $savingsConsumption + $savingsConsumption30 - $cloudsizePrice * 12, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $storage ) {
		$pdf->MultiCell( 150, 5, 'Einspeiseertrag (netto) pro Jahr laut Simulation:', '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savings + $savingsConsumption80, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else {
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeiseertrag (netto) pro Jahr laut Simulation: ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savingsOc, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
		$pdf->MultiCell( 150, 5, utf8_decode( 'Anlagen-Ertrag p.a. ¹' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savingsOc, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	}
	$pdf->Ln();
	if ( $storage && $storageInformation['cloud'][0] === 'Ja' ) {
		$pdf->MultiCell( 150, 5, utf8_decode( 'das entspricht einem Ertragsverhältnis zur Nettoinvestition von ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, number_format( ( ( $savings + $savingsConsumption + $savingsConsumption30 - $cloudsizePrice * 12 ) * 20 * 1.5 ) / $totalExcl / 20 * 100, 2, ',', '.' ) . '%', '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $storage ) {
		$pdf->MultiCell( 150, 5, utf8_decode( 'das entspricht einem Ertragsverhältnis zur Nettoinvestition von ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, number_format( ( ( $savings + $savingsConsumption80 - $cloudsizePrice * 12 ) * 20 * 1.5 ) / $totalExcl / 20 * 100, 2, ',', '.' ) . '%', '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else {
		$pdf->MultiCell( 150, 5, utf8_decode( 'das entspricht einem Ertragsverhältnis zur Nettoinvestition von ' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, number_format( ( $savingsOc * 20 * 1.3 ) / $totalExcl / 20 * 100, 2, ',', '.' ) . '%', '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	}
	$pdf->Ln();
	$pdf->MultiCell( 150, 5, utf8_decode( 'Geförderter Zeitraum:' ), '', 'L' );
	$pdf->SetXY( 165, $pdf->getY() - 5 );
	$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
	$pdf->setTextColor( 255, 255, 255 );
	$pdf->MultiCell( 29.5, 5, '20 Jahre', '', 'R' );
	$pdf->setTextColor( 0, 0, 0 );
	$pdf->Write( 5, utf8_decode( '(zzgl. der Monate des Jahres der Inbetriebnahme)' ) );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', 'B' );
	if ( $storage && $storageInformation['cloud'][0] === 'Ja' ) {
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung und Ersparnis (3% Steigerung) über 20 Jahre Förderzeitraum' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $savings + $savingsConsumption + $savingsConsumption30 - $cloudsizePrice * 12 ) * 20 * 1.5, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else if ( $storage ) {
		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung und Ersparnis (3% Steigerung) über 20 Jahre Förderzeitraum' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( ( $savings + $savingsConsumption ) * 20 * 1.3, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	} else {

		$pdf->MultiCell( 150, 5, utf8_decode( 'Einspeisevergütung und Ersparnis (3% Steigerung) über 20 Jahre Förderzeitraum' ), '', 'L' );
		$pdf->SetXY( 165, $pdf->getY() - 5 );
		$pdf->RoundedRect( $pdf->getX(), $pdf->getY(), 30, 4.5, 1, 'F' );
		$pdf->setTextColor( 255, 255, 255 );
		$pdf->MultiCell( 29.5, 5, utf8_decode( number_format( $savingsOc * 20 * 1.3, 2, ',', '.' ) . EUR ), '', 'R' );
		$pdf->setTextColor( 0, 0, 0 );
	}
	$pdf->SetFont( 'Helvetica', '' );

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont( 'Helvetica', '', 7 );
	$pdf->Write( 3.5, utf8_decode( '* Für diese Berechnung, insbesondere für die Höhe der erzielbaren Einspeisevergütung, kann keine Haftung übernommen werden.								
* Für die Rückliefermenge der Cloudgröße, kann keine Haftung übernommen werden.								
¹ Die Berechnung erfolgt über gängige Fachsoftware, die i.d.R. auch von Banken und Investoren zur Beurteilung von Photovoltaik-Anlagen eingesetzt wird (z.B. "PV-SOL").								
* Das Ergebnis hängt von der tatsächlichen Sonneneinstrahlung ab und kann deshalb sowohl niedriger als auch höher ausfallen als hier dagestellt.								
* Diese Berechnung ist eine unverbindliche Beispielberechnung aufgrund der vorgegebenen Daten. Sie ist nicht Gegenstand des Vertrages.' ) );
	wp_reset_postdata();

	$pdf->Ln();
	$pdf->Ln();
}
// attachment name
$filename = 'Angebot.pdf';
$pdfdoc   = $pdf->Output( '', 'S' );


if ( $sendPdf == true ) {
// email stuff (change data below)
	if ( ! empty( $byMail ) ) {
		$to = get_option( 'postemail' );
	} else {
		$to = $email;
	}
	$from     = $userMail;
	$message  = '<html><body>';
	$subject  = utf8_decode( 'Angebot Photovoltaikanlage #' . $postID );
	$message  .= '<p><h2>Sehr geehrte' . ( $salutation === 'Herr' ? 'r Herr ' : ' Frau ' ) . $_POST['lastName'] . ', </h2>';
	$message  .= $mailtext;
	$message  .= '
</p>
<br>
------------------------------------------
<p>
<img src="' . wp_get_attachment_url( get_option( 'logo' ) ) . '" alt="" width="250">
<br>
<br>' .
	             $company . '<br>' .
	             get_option( 'street' ) . '<br>' .
	             $companyZip . ' ' . get_option( 'city' ) . '<br>' .
	             'T ' . $companyPhone . '<br>' .
	             ( ! empty( $companyFax ) ? 'F ' . $companyFax . '<br>' : '' ) .
	             'E ' . $companyMail . '<br>' .
	             $companyWebsite . '
</p>
<br> 
<br></body></html>';
	$wpMail   = get_option( 'wp_mail_smtp' );
	$phpemail = new PHPMailer\PHPMailer\PHPMailer();
	$phpemail->IsSMTP();
	$phpemail->Host = $wpMail['smtp']['host'];
	//$phpemail->SMTPDebug  = 1; // Kann man zu debug Zwecken aktivieren
	//$phpemail->SMTPAuth   = true;
	$phpemail->Username   = $wpMail['smtp']['user'];
	$phpemail->Password   = get_option( 'smtp_password' );
	$phpemail->SMTPAuth   = true;                  // enable SMTP authentication
	$phpemail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$phpemail->Port       = 587;                   // set the SMTP port for the GMAIL server

	$phpemail->setFrom( $from, $company );
	$phpemail->Subject = $subject;
	$phpemail->Body    = utf8_decode( $message );
	$phpemail->addAddress( $to );
	$phpemail->IsHTML( true );

	$phpemail->addStringAttachment( $pdfdoc, $filename );
	/*if ( $storage ) {
		$phpemail->addAttachment( $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/' . $anhangStorage, $anhangStorage );
	}*/
	if ( $anhanginverter ) {
		$phpemail->addAttachment( $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/' . $anhanginverter, $anhanginverter );
	}
	//$phpemail->addAttachment( $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/' . $anhangModule, $anhangModule );

	error_log( 'addAttachment: ' . print_r( [
			site_url() . '/wp-content/uploads/' . get_option( 'agb' ),
			get_option( 'agb' )
		] ), 1 );
	$phpemail->addAttachment( site_url() . '/wp-content/uploads/' . get_option( 'agb' ), get_option( 'agb' ) );

	if ( ! $phpemail->Send() ) {
		echo "Mailer Error: " . $phpemail->ErrorInfo;
	} else {
		echo "SUCCESS";
	}
} else if ( $_POST['sendConfirmation'] === 'on' ) {
	// email stuff (change data below)
	if ( ! empty( $byMail ) ) {
		$to = get_option( 'postemail' );
	} else {
		$to = $email;
	}
	$from     = $userMail;
	$message  = '<html><body>';
	$subject  = utf8_decode( 'Auftragsbestätigung Photovoltaikanlage #' . $postID );
	$message  .= '<p><h2>Sehr geehrte' . ( $salutation === 'Herr' ? 'r Herr ' : ' Frau ' ) . $_POST['lastName'] . ', </h2>';
	$message  .= 'anbei erhalten Sie die Auftragsbestätigung für Ihre Photovoltaikanlage.<br> 
    <br>
    Für weitere Fragen steht Ihnen ' . $userName . ' gerne zur Verfügung<br>
    <b>Kontakt: ' . $userPhone . ' | ' . $userMail . '</b>
    <br>
    <br>
    Vielen Dank.<br><br>
Mit freundlichen Grüßen,<br>
Ihr ' . $companyWithoutForm . ' Team';
	$message  .= '
</p>
<br>
------------------------------------------
<p>
<img src="' . wp_get_attachment_url( get_option( 'logo' ) ) . '" alt="" width="250">
<br>
<br>' .
	             $company . '<br>' .
	             get_option( 'street' ) . '<br>' .
	             $companyZip . ' ' . get_option( 'city' ) . '<br>' .
	             'T ' . $companyPhone . '<br>' .
	             ( ! empty( $companyFax ) ? 'F ' . $companyFax . '<br>' : '' ) .
	             'E ' . $companyMail . '<br>' .
	             $companyWebsite . '
</p>
<br> 
<br></body></html>';
	$filename = utf8_decode( 'Auftragsbestätigung.pdf' );
	$wpMail   = get_option( 'wp_mail_smtp' );
	$phpemail = new PHPMailer\PHPMailer\PHPMailer();
	$phpemail->IsSMTP();
	$phpemail->Host = $wpMail['smtp']['host'];
	//$phpemail->SMTPDebug  = 1; // Kann man zu debug Zwecken aktivieren
	//$phpemail->SMTPAuth   = true;
	$phpemail->Username   = $wpMail['smtp']['user'];
	$phpemail->Password   = get_option( 'smtp_password' );
	$phpemail->SMTPAuth   = true;                  // enable SMTP authentication
	$phpemail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$phpemail->Port       = 587;                   // set the SMTP port for the GMAIL server

	$phpemail->setFrom( $from, $company );
	$phpemail->Subject = $subject;
	$phpemail->Body    = utf8_decode( $message );
	$phpemail->addAddress( $to );
	$phpemail->IsHTML( true );

	$phpemail->addStringAttachment( $pdfdoc, $filename );
	if ( ! $phpemail->Send() ) {
		echo "Mailer Error: " . $phpemail->ErrorInfo;
	} else {
		update_post_meta( $postID, 'confirmationSent', true );
		echo "SUCCESS";
	}

} else {
	$pdf->Output( '', 'Angebot.pdf' );
}