<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/WriterInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/RepositoryInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Store/StoreBuilder.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Store/StoreInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Store/File/Paths.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Util/Regex.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Util/Str.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Store/File/Reader.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser/EntryParser.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser/Entry.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Loader/Resolver.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser/Value.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser/Lexer.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser/ParserInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Loader/LoaderInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Loader/Loader.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser/Lines.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser/Parser.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Store/FileStore.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/AdapterRepository.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/ImmutableWriter.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/MultiWriter.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/ReaderInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/MultiReader.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/AdapterInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/EnvConstAdapter.php';
require_once __DIR__ . '/vendor/graham-campbell/result-type/src/Result.php';
require_once __DIR__ . '/vendor/graham-campbell/result-type/src/Success.php';
require_once __DIR__ . '/vendor/phpoption/phpoption/src/PhpOption/Option.php';
require_once __DIR__ . '/vendor/phpoption/phpoption/src/PhpOption/None.php';
require_once __DIR__ . '/vendor/phpoption/phpoption/src/PhpOption/Some.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Dotenv.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/RepositoryBuilder.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Repository/Adapter/ServerConstAdapter.php';

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->load();
$sevdeskApiKey = '9c3288e491899c1220d99c01134fce68';


function initCurl( $data, $url, $postType, $getCode = false ) {
	global $sevdeskApiKey;

	// Initialisieren Sie die cURL-Sitzung
	$ch = curl_init();

	// Setzen Sie die cURL-Optionen für den API-Aufruf
	curl_setopt( $ch, CURLOPT_URL, $url );
	if ( $postType === 'GET' || $postType === 'PUT' ) {
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $postType );
	} else {
		curl_setopt( $ch, $postType, true );
	}
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $data ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
		'Authorization:' . $sevdeskApiKey,
		'Content-Type: application/json'
	) );

	// Führen Sie den API-Aufruf aus, um den neuen Kontakt hinzuzufügen
	$response = curl_exec( $ch );

	// Überprüfen Sie auf cURL-Fehler
	if ( curl_errno( $ch ) ) {
		return false;
	}

	// Überprüfen Sie den HTTP-Statuscode
	if ( $getCode ) {
		$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		if ( $httpCode !== 200 ) {
			return false;
		}
	}

	// Schließen Sie die cURL-Sitzung
	curl_close( $ch );

	// Dekodieren Sie die JSON-Antwort und geben Sie sie zurück
	return json_decode( $response, true );
}

function setSevdeskContact( $orderID ) {
	// Legen Sie Ihre Daten für den neuen Kontakt fest
	$data = [
		'status'     => 100,
		'surename'   => get_post_meta( $orderID, 'firstName', true ),
		'familyname' => get_post_meta( $orderID, 'lastName', true ),
		'email'      => get_post_meta( $orderID, 'emailAddress', true ),
		'phone'      => get_post_meta( $orderID, 'phoneNumber', true ),
		"category"   => [
			"id"         => 3,
			"objectName" => "Category"
		],
		//"description" => "Kunden Beschreibung",
		//"academicTitle" => "Dr.",
		//"titel" => "Dr.",
		"gender"     => get_post_meta( $orderID, 'salutation', true )
	];


	if ( ! empty( get_post_meta( $orderID, 'sevdesk_contact_id', true ) ) && getSevdeskContact( $orderID ) !== false ) {
		$url      = 'https://my.sevdesk.de/api/v1/Contact/' . get_post_meta( $orderID, 'sevdesk_contact_id', true );
		$postType = CURLOPT_PUT;
	} else {
		$url      = 'https://my.sevdesk.de/api/v1/Contact';
		$postType = CURLOPT_POST;
	}


	// Rufen Sie die Antwort von initCurl ab
	$response = initCurl( $data, $url, $postType );

	// Erhalten Sie die ID des neuen Kontakts aus der Antwort
	$contactId = $response['objects']['id'];

	if ( empty( get_post_meta( $orderID, 'sevdesk_contact_id', true ) ) || ( ! empty( get_post_meta( $orderID, 'sevdesk_contact_id', true ) ) && getSevdeskContact( $orderID ) === false ) ) {
		update_post_meta( $orderID, 'sevdesk_contact_id', $contactId );
		setSevdeskAddress( $orderID, $contactId );
		setSevdeskCommunication( $orderID, $contactId );
	} else {
		setSevdeskAddress( $orderID, $contactId, CURLOPT_PUT );
		setSevdeskCommunication( $orderID, $contactId, CURLOPT_PUT );
	}
}

function getSevdeskContact( $orderID ) {
	$contactID = get_post_meta( $orderID, 'sevdesk_contact_id', true );
	$url       = 'https://my.sevdesk.de/api/v1/Contact/' . $contactID;

	return initCurl( '', $url, 'GET', true );
}

function getSevdeskInvoicePDF( $orderID, $invoiceType = 'invoice' ) {
	$invoiceID = get_post_meta( $orderID, 'sevdesk_' . $invoiceType . '_id', true );
	$url       = 'https://my.sevdesk.de/api/v1/Invoice/' . $invoiceID . '/getPdf';

	return initCurl( '', $url, 'GET' );
}

function generateSevdeskInvoicePdf( $orderID ) {
	$response      = getSevdeskInvoicePDF( $orderID );
	$base64Content = $response['objects']['content'];
	$fileName      = $response['objects']['filename'];
	base64File( $base64Content, $orderID, $fileName );
	update_post_meta( $orderID, 'sevdesk_invoice_pdf', $fileName );
}

function getSevdeskInvoice( $orderID ) {
	$invoiceID = get_post_meta( $orderID, 'sevdesk_invoice_id', true );
	$url       = 'https://my.sevdesk.de/api/v1/Invoice/' . $invoiceID;

	return initCurl( '', $url, 'GET', true );
}

function setSevdeskCommunication( $orderID, $contactId, $postType = CURLOPT_POST ) {

	$email       = get_post_meta( $orderID, 'emailAddress', true );
	$phoneNumber = get_post_meta( $orderID, 'phoneNumber', true );
	$mobile      = get_post_meta( $orderID, 'mobileNumber', true );

	$communicationWays = [
		'email'  => $email,
		'phone'  => $phoneNumber,
		'mobile' => $mobile
	];

	$i = 0;

	foreach ( $communicationWays as $key => $value ) {
		$i ++;

		$communicationID = get_post_meta( $orderID, 'sevdesk_communication_' . $key, true );

		if ( $postType === CURLOPT_PUT && ! empty( $communicationID ) ) {
			$url = 'https://my.sevdesk.de/api/v1/CommunicationWay/' . $communicationID;
		} else {
			$url = 'https://my.sevdesk.de/api/v1/CommunicationWay';
		}

		$data = [
			"contact" => [
				"id"         => $contactId,
				"objectName" => "Contact"
			],
			"type"    => strtoupper( $key ),
			"value"   => $value,
			"key"     => [
				"id"         => $i,
				"objectName" => "CommunicationWayKey"
			],
		];

		$response = initCurl( $data, $url, $postType );

		if ( empty( get_post_meta( $orderID, 'sevdesk_communication_' . $key, true ) ) ) {
			update_post_meta( $orderID, 'sevdesk_communication_' . $key, $response['objects']['id'] );
		}
	}
}


function setSevdeskAddress( $orderID, $contactId, $postType = CURLOPT_POST ) {

	$data = [
		"contact"  => [
			"id"         => $contactId,
			"objectName" => "Contact"
		],
		"street"   => get_post_meta( $orderID, 'street', true ) . ' ' . get_post_meta( $orderID, 'houseNumber', true ),
		"zip"      => get_post_meta( $orderID, 'zip', true ),
		"city"     => get_post_meta( $orderID, 'city', true ),
		"country"  => [
			"id"         => 1,
			"objectName" => "StaticCountry"
		],
		"category" => [
			"id"         => 47,
			"objectName" => "Category"
		]
	];

	if ( $postType === CURLOPT_PUT ) {
		$addressId = get_post_meta( $orderID, 'sevdesk_address_id', true );
		$url       = 'https://my.sevdesk.de/api/v1/ContactAddress/' . $addressId;
		initCurl( $data, $url, $postType );
	} else {
		$url       = 'https://my.sevdesk.de/api/v1/ContactAddress';
		$response  = initCurl( $data, $url, $postType );
		$addressId = $response['objects']['id'];
		update_post_meta( $orderID, 'sevdesk_address_id', $addressId );
	}

}

function createSevdeskReminder( $orderID, $invoiceID ) {

	$data = [
		"invoice" => [
			"id"         => $invoiceID,
			"objectName" => "Invoice",
		]
	];

	$response   = initCurl( $data, 'https://my.sevdesk.de/api/v1/Invoice/Factory/createInvoiceReminder', CURLOPT_POST );
	$reminderID = $response['objects']['id'];
	update_post_meta( $orderID, 'sevdesk_reminder_id', $reminderID );

	$contactID = get_post_meta( $orderID, 'sevdesk_contact_id', true );

	//PRICES
	$totalIncl = get_post_meta( $orderID, 'totalIncl', true );

	// payment conditions
	$paymentModalitiesArray = (array) json_decode( get_option( 'abschlag' ) );
	$paymentModalities      = 'Soweit nicht anders vereinbart, gelten folgende Zahlungsbedingungen: <br><br>
	<table style="width: 100%">';
	$i                      = 1;
	foreach ( $paymentModalitiesArray as $key => $value ) {
		$paymentModalities .= '<tr><td><strong>' . $value . '</strong></td><td style="text-align: right"><strong>' . number_format( $totalIncl * $key / 100, 2, ',', '.' ) . ' EUR</strong></td></tr>';
		$i ++;
	}
	$paymentModalities .= '</table><br>';

	$bankData = [
		'name'     => 'Test',
		'type'     => 'offline',
		'currency' => 'EUR',
		'status'   => 100,
	];

	$bankAccount = initCurl( $bankData, 'https://my.sevdesk.de/api/v1/CheckAccount', 'GET' );
	$iban        = $bankAccount['objects'][0]['iban'];

	$qrCodeData = 'BCD' . "\n" . '001' . "\n" . '1' . "\n" . 'SCT' . "\n" . "\n" . get_option( 'company' ) . "\n" . $iban . "\n" . 'EUR' . $totalIncl . "\n" . "\n" . "Rechnung #, Auftrag #" . $orderID . ' qr';

	$encodedQRCode = urlencode( $qrCodeData );

	$reminderFooterRaw = get_option( 'reminder_footer' );
	$replaceQRCode     = str_replace( '[QRCODE]', '<img style="border: 1px solid #000; border-radius: 10px;" src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=' . $encodedQRCode . '&choe=UTF-8">', $reminderFooterRaw );
	$reminderFooter    = str_replace( '[IBAN]', chunk_split( $iban, 4, ' ' ), $replaceQRCode );

	$sevUserResponse = initCurl( '', 'https://my.sevdesk.de/api/v1/SevUser/1096202', 'GET' );

	$sevUser = $sevUserResponse['objects'][0]['id'];

	$invoiceNumber = get_post_meta( $orderID, 'sevdesk_invoice_number', true );

	$data = [
		"invoice" => [
			"id"             => $reminderID,
			"objectName"     => "Invoice",
			"contact"        => [
				"id"         => $contactID,
				"objectName" => "Contact"
			],
			"contactPerson"  => [
				"id"         => $sevUser,
				"objectName" => "SevUser"
			],
			"headText"       => get_option( 'reminder_header' ),
			"footText"       => $paymentModalities . $reminderFooter,
			"addressCountry" => [
				"id"         => 1,
				"objectName" => "StaticCountry"
			],
			"status"         => 100,
			"invoiceType"    => 'MA',
			"timeToPay"      => null,
			"mapAll"         => true,
		],
	];

	$url      = 'https://my.sevdesk.de/api/v1/Invoice/Factory/saveInvoice';
	$response = initCurl( $data, $url, CURLOPT_POST );
}

function sendSevdeskReminder( $orderID ) {
	$reminderCounter = empty( $reminderCounterMeta = get_post_meta( $orderID, 'sevdesk_reminder_counter', true ) ) ? 0 : $reminderCounterMeta;

	$current_date = date( 'Y-m-d' );
	$reminderID   = get_post_meta( $orderID, 'sevdesk_reminder_id', true );
	$invoiceID    = get_post_meta( $orderID, 'sevdesk_invoice_id', true );

	if ( $reminderCounter >= 1 ) {
		$subject = 'Ihre Mahnung von ';
	} else {
		$subject = 'Ihre Zahlungserinnerung von ';
	}

	$emailData = [
		"toEmail"                  => get_post_meta( $orderID, 'emailAddress', true ),
		"subject"                  => $subject . get_option( 'company' ),
		"text"                     => view( 'mails/sevdesk/reminder' . ( $reminderCounter > 0 ? '-' . $reminderCounter : '' ), compact( [ 'orderID' ] ), false ),
		"includeInvoiceForDunning" => true,
	];

	$reminderCounter ++;
	update_post_meta( $orderID, 'sevdesk_reminder_counter', $reminderCounter );

	$response = initCurl( $emailData, 'https://my.sevdesk.de/api/v1/Invoice/' . $reminderID . '/sendViaEmail', CURLOPT_POST );
	var_dump($response );
	die;
	update_post_meta( $orderID, 'sevdesk_reminder_date', $current_date );
}

function sendSevdeskInvoice( $orderID, $status, $invoiceID = null, $invoiceType = 'RE', $updateReminder = false ) {

	$modulePower = getModulePower( $orderID );
	$moduleQty   = (int) get_post_meta( $orderID, 'moduleqty', true );

	// MODULE INFOS
	$moduleID           = get_post_meta( $orderID, 'module', true );
	$moduleName         = get_post_meta( $moduleID, 'produktTyp', true );
	$moduleManufacturer = get_post_meta( $moduleID, 'hersteller', true );
	$moduleTyp          = get_post_meta( $moduleID, 'typ', true );

	$pvIncludes = get_option( 'pv_includes' );

	$contactID          = get_post_meta( $orderID, 'sevdesk_contact_id', true );
	$storageID          = get_post_meta( $orderID, 'storage', true );
	$storageName        = get_post_meta( $storageID, 'name', true );
	$storageDescription = get_post_meta( $storageID, 'beschreibung', true );

	//PRICES
	$totalIncl   = get_post_meta( $orderID, 'totalIncl', true );
	$acFlatPrice = get_option( 'ac_flat' );
	$dcPrice     = get_option( 'dc_price' );;

	$storagePrice = (int) get_post_meta( $storageID, 'price', true );
	$pvPrice      = $totalIncl - ( $dcPrice * $modulePower + $acFlatPrice + $storagePrice );

	// payment conditions
	$paymentModalitiesArray = (array) json_decode( get_option( 'abschlag' ) );
	$paymentModalities      = 'Soweit nicht anders vereinbart, gelten folgende Zahlungsbedingungen: <br><br>
	<table style="width: 100%">';
	$i                      = 1;
	foreach ( $paymentModalitiesArray as $key => $value ) {
		$paymentModalities .= '<tr><td><strong>' . $value . '</strong></td><td style="text-align: right"><strong>' . number_format( $totalIncl * $key / 100, 2, ',', '.' ) . ' EUR</strong></td></tr>';
		$i ++;
	}
	$paymentModalities .= '</table><br>';

	$bankData = [
		'name'     => 'Test',
		'type'     => 'offline',
		'currency' => 'EUR',
		'status'   => 100,
	];

	$bankAccount = initCurl( $bankData, 'https://my.sevdesk.de/api/v1/CheckAccount', 'GET' );
	$iban        = $bankAccount['objects'][0]['iban'];

	$invoiceInstance = getInvoiceSequence();
	$qrCodeData      = 'BCD' . "\n" . '001' . "\n" . '1' . "\n" . 'SCT' . "\n" . "\n" . get_option( 'company' ) . "\n" . $iban . "\n" . 'EUR' . $totalIncl . "\n" . "\n" . "Rechnung #, Auftrag #" . $orderID . ' qr';

	$encodedQRCode = urlencode( $qrCodeData );

	$invoiceFooterRaw = get_option( 'invoice_footer' );
	$replaceQRCode    = str_replace( '[QRCODE]', '<img style="border: 1px solid #000; border-radius: 10px;" src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=' . $encodedQRCode . '&choe=UTF-8">', $invoiceFooterRaw );
	$invoiceFooter    = str_replace( '[IBAN]', chunk_split( $iban, 4, ' ' ), $replaceQRCode );

	$existingPositions = get_post_meta( $orderID, 'sevdesk_invoice_pos', true );

	$sevUserResponse = initCurl( '', 'https://my.sevdesk.de/api/v1/SevUser/1096202', 'GET' );

	$sevUser = $sevUserResponse['objects'][0]['id'];

	$taxRate = get_option( 'mwst' );

	$data = [
		"invoice"            => [
			"id"              => $invoiceID,
			"objectName"      => "Invoice",
			"invoiceNumber"   => $invoiceInstance,
			"contact"         => [
				"id"         => $contactID,
				"objectName" => "Contact"
			],
			"contactPerson"   => [
				"id"         => $sevUser,
				"objectName" => "SevUser"
			],
			"header"          => 'Rechnung Nr. ' . $invoiceInstance,
			"headText"        => get_option( 'invoice_header' ),
			"footText"        => $paymentModalities . $invoiceFooter,
			"invoiceDate"     => wp_date( 'd.m.Y' ),
			"discount"        => 0,
			"discountTime"    => 0,
			"addressCountry"  => [
				"id"         => 1,
				"objectName" => "StaticCountry"
			],
			"status"          => 100,
			"smallSettlement" => 0,
			"taxRate"         => $taxRate,
			"taxText"         => "Umsatzsteuer " . get_option( 'mwst' ) . "%",
			"taxType"         => "default",
			"invoiceType"     => $invoiceType,
			"currency"        => "EUR",
			"timeToPay"       => null,
			"sendDate"        => wp_date( 'd.m.Y' ),
			"mapAll"          => true,
		],
		"takeDefaultAddress" => true,
		"invoicePosSave"     => [
			[
				"objectName"     => "InvoicePos",
				"mapAll"         => true,
				"quantity"       => 1,
				"price"          => $pvPrice,
				"name"           => "Photovoltaikanlage",
				"unity"          => [
					"id"         => 1,
					"objectName" => "Unity"
				],
				"positionNumber" => 1,
				"text"           => /*TODO*/
					$moduleQty . " Stk. Module " . $moduleName . " " . $moduleTyp . "\nHersteller: " . $moduleManufacturer . "\nGesamtleistung " . number_format( $modulePower, 2, ',' ) . " kWP\n" . $pvIncludes,
				"taxRate"        => $taxRate
			],
			[
				"objectName"     => "InvoicePos",
				"mapAll"         => true,
				"quantity"       => 1,
				"price"          => $storagePrice,
				"name"           => "Speicher",
				"unity"          => [
					"id"         => 1,
					"objectName" => "Unity"
				],
				"positionNumber" => 2,
				"text"           => $storageName . ', ' . $storageDescription . ', inklusive Wechselrichter',
				"taxRate"        => $taxRate
			],
			[
				"objectName"     => "InvoicePos",
				"mapAll"         => true,
				"quantity"       => $modulePower,
				"price"          => $dcPrice,
				"name"           => "Dachmontage",
				"unity"          => [
					"id"         => 1,
					"objectName" => "Unity"
				],
				"positionNumber" => 3,
				"text"           => "Montageleistung, reine Arbeitszeit",
				"taxRate"        => $taxRate
			],
			[
				"objectName"     => "InvoicePos",
				"mapAll"         => true,
				"quantity"       => 1,
				"price"          => get_option( 'ac_flat' ),
				"name"           => "Elektromontage AC",
				"unity"          => [
					"id"         => 7,
					"objectName" => "Unity"
				],
				"positionNumber" => 4,
				"text"           => "Elektromeister reine Arbeitszeit 8 Std.",
				"taxRate"        => $taxRate
			]
		],
		"invoicePosDelete"   => []
	];

	if ( ! empty( $existingPositions ) ) {
		foreach ( $existingPositions as $position ) {
			$data["invoicePosDelete"][] = [
				"id"         => $position,
				"objectName" => "InvoicePos"
			];
		}
	}

	$url      = 'https://my.sevdesk.de/api/v1/Invoice/Factory/saveInvoice';
	$response = initCurl( $data, $url, $invoiceID === null ? CURLOPT_POST : CURLOPT_PUT );

	$invoiceId = $response['objects']['invoice']['id'];
	if ( ! empty( $invoiceId ) ) {
		update_post_meta( $orderID, 'sevdesk_invoice_id', $invoiceId );
	}
	update_post_meta( $orderID, 'sevdesk_invoice_number', $invoiceInstance );
	update_post_meta( $orderID, 'sevdesk_user_id', $sevUser );

	$invoicePos = $response['objects']['invoicePos'];

	$invoicePosArray = [];

	foreach ( $invoicePos as $position ) {
		$invoicePosArray[] = $position['id'];
	}

	update_post_meta( $orderID, 'sevdesk_invoice_pos', $invoicePosArray );

	if ( $status === 200 ) {
		$current_date = date( 'Y-m-d' );
		update_post_meta( get_the_ID(), 'sevdesk_invoice_date', $current_date );

		if ( get_post_meta( $orderID, 'status', true ) !== 'funding' ) {
			$emailData = [
				"toEmail" => get_post_meta( $orderID, 'emailAddress', true ),
				"subject" => 'Ihre Rechnung',
				"text"    => view( 'mails/sevdesk/invoice', compact( [ 'orderID' ] ), false )
			];

			$mail = initCurl( $emailData, 'https://my.sevdesk.de/api/v1/Invoice/' . $invoiceId . '/sendViaEmail', CURLOPT_POST );
		}
	}
}

function renderSevdeskInvoice( $invoiceID ) {
	$response = initCurl( '', 'https://my.sevdesk.de/api/v1/Invoice/' . $invoiceID . '/render', CURLOPT_POST );

	return $response;
}

function getInvoiceSequence() {
	$sequenceUrl = 'https://my.sevdesk.de/api/v1/SevSequence/Factory/getByType?objectType=Invoice&type=RE';

	$response = initCurl( '', $sequenceUrl, 'GET' );

	$referenceFormat       = $response['objects']['format'];
	$referenceNextSequence = $response['objects']['nextSequence'];

	return str_replace( '%NUMBER', $referenceNextSequence, $referenceFormat );
}

function generateSevdeskExistingInvoice( $orderID ) {
	$invoiceFileName  = get_post_meta( $orderID, 'sevdesk_invoice_pdf', true );
	$invoiceId        = get_post_meta( $orderID, 'sevdesk_invoice_id', true );
	$invoiceIDChecked = metadata_exists( 'post', $orderID, 'sevdesk_sent_via_sevdesk' );

	if ( $invoiceId && empty( $invoiceFileName ) && ! $invoiceIDChecked ) {
		// Wenn eine RechnungsID existiert und diese den Status 200 hat, wurde sie versendet
		$invoice           = getSevdeskInvoice( $orderID );
		$invoiceStatusSent = $invoice['objects'][0]['status'] === '200';

		if ( $invoiceStatusSent ) {
			update_post_meta( $orderID, 'sevdesk_sent_via_sevdesk', 'on' );
			$invoiceDate = date( "Y-m-d", strtotime( $invoice['objects'][0]['invoiceDate'] ) );
			update_post_meta( $orderID, 'first-billing', $invoiceDate );

			$paymentModalitiesArray = (array) json_decode( get_option( 'abschlag' ) );
			update_post_meta( $orderID, 'sevdesk_payment_due', array_keys( $paymentModalitiesArray )[0] );
			update_post_meta( $orderID, 'sevdesk_invoice_render', 'off' );
			generateSevdeskInvoicePdf( $orderID );
		} else {
			update_post_meta( $orderID, 'sevdesk_sent_via_sevdesk', 'off' );
		}
	}
}

function checkSevdeskPayments() {
	global $sevdeskApiKey;

	$args = [
		'post_type'      => 'customer', // Ersetzen Sie IHR_CUSTOM_POST_TYPE durch den Namen Ihres Custom Post Typs
		'post_status'    => 'private',
		'posts_per_page' => - 1,
		'meta_query'     => [
			[
				'key'     => 'sevdesk_invoice_id',
				'compare' => 'EXISTS',
			],
			[
				'key'     => 'sevdesk_paid_due_amount',
				'compare' => 'NOT EXISTS'
			],
			[
				'key'     => 'sevdesk_reminder_counter',
				'compare' => 'NOT EXISTS'
			],
			[
				'key'     => 'step',
				'value'   => 3,
				'compare' => '>=',
			],

		],
	];

	$orders           = get_posts( $args );
	$multiCurlHandles = [];
	$multiCurlResults = [];

	// Initialisiere cURL-Multi-Handle
	$multiCurl = curl_multi_init();

	foreach ( $orders as $order ) {
		$invoiceId = get_post_meta( $order->ID, 'sevdesk_invoice_id', true );
		$url       = 'https://my.sevdesk.de/api/v1/Invoice/' . $invoiceId;

		// Initialisiere das cURL-Handle für diese Anfrage
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, [
			'Authorization: ' . $sevdeskApiKey,
			'Content-Type: application/json'
		] );

		// Füge das cURL-Handle zum Multi-Handle hinzu
		curl_multi_add_handle( $multiCurl, $ch );

		$multiCurlHandles[] = $ch;
	}

	// Führe alle cURL-Anfragen gleichzeitig aus
	$running = null;
	do {
		curl_multi_exec( $multiCurl, $running );
	} while ( $running > 0 );

	// Sammle die Ergebnisse der cURL-Anfragen
	foreach ( $multiCurlHandles as $ch ) {
		$multiCurlResults[] = curl_multi_getcontent( $ch );
		curl_multi_remove_handle( $multiCurl, $ch );
	}

	// Schließe das cURL-Multi-Handle
	curl_multi_close( $multiCurl );

	// Verarbeite die API-Antworten für jeden Kunden
	foreach ( $orders as $key => $order ) {
		$invoiceData          = json_decode( $multiCurlResults[ $key ], true );
		$paidAmount           = $invoiceData['objects'][0]['paidAmount'];
		$sumGross             = $invoiceData['objects'][0]['sumGross'];
		$duePaymentPercentage = getDuePercentage( $order->ID );
		$duePayment           = $sumGross * $duePaymentPercentage / 100;
		$reminderCounter      = (int) get_post_meta( $order->ID, 'sevdesk_reminder_counter', true ) ?: null;
		$reminderQty          = (int) get_option( 'reminder_qty' );

		//update_post_meta( $order->ID, 'sevdesk_paid_amount_percentage', 100 / $duePayment * $paidAmount );
		update_post_meta( $order->ID, 'sevdesk_paid_amount', number_format( $paidAmount, 2, '.', '' ) );

		if ( $paidAmount > 0 && $duePayment > 0 ) {
			update_post_meta( $order->ID, 'sevdesk_paid_amount_percentage', 100 / $duePayment * $paidAmount );
			if ( $paidAmount >= $duePayment ) {
				update_post_meta( $order->ID, 'sevdesk_paid_due_amount', true );
				delete_post_meta( $order->ID, 'sevdesk_reminder_render' );
			} else {
				delete_post_meta( $order->ID, 'sevdesk_paid_due_amount', true );
			}
		} else {
			update_post_meta( $order->ID, 'sevdesk_paid_amount_percentage', 0 );
		}

		if ( $paidAmount !== $duePayment && getOverDue( $order->ID ) ) {
			update_post_meta( $order->ID, 'sevdesk_ready_to_remind', 'true' );
			if ( $reminderCounter >= 1 && $reminderCounter <= $reminderQty ) {
				automateSevdeskReminder( $order->ID );
			}
		} else {
			delete_post_meta( $order->ID, 'sevdesk_ready_to_remind' );
		}

		generateSevdeskExistingInvoice( $order->ID );
	}


	// Das aktuelle Datum und die Uhrzeit erfassen
	$current_datetime = current_time( 'mysql' );
	$cronData         = [ $current_datetime, count( $orders ) ];

	// Die aktuelle Zeit in einer WordPress-Option speichern
	update_option( 'payments_latest_update', $cronData );

}

function checkSevdeskPaymentsCron() {
	if ( ! wp_next_scheduled( 'checkSevdeskPaymentsEvent' ) ) {
		wp_schedule_event( strtotime( '08:00:00' ), 'daily', 'checkSevdeskPaymentsEvent' );
	}
}

add_action( 'init', 'checkSevdeskPaymentsCron' );

add_action( 'checkSevdeskPaymentsEvent', 'checkSevdeskPayments' );


function sendSevdeskRemindersCron() {
	if ( ! wp_next_scheduled( 'sendSevdeskRemindersEvent' ) ) {
		wp_schedule_event( strtotime( '13:00:00' ), 'daily', 'sendSevdeskRemindersEvent' );
	}
}

add_action( 'init', 'sendSevdeskRemindersCron' );
add_action( 'sendSevdeskRemindersEvent', 'sendSevdeskReminders' );


function sendSevdeskReminders() {

	$args = [
		'post_type'      => 'customer', // Ersetzen Sie IHR_CUSTOM_POST_TYPE durch den Namen Ihres Custom Post Typs
		'post_status'    => 'private',
		'posts_per_page' => - 1,
		'p'              => 24755, // TODO REMOVE THIS
		'meta_query'     => [
			[
				'key'     => 'sevdesk_reminder_pdf',
				'compare' => 'EXISTS',
			],
			[
				'key'     => 'sevdesk_reminder_counter',
				'value'   => 4,
				'compare' => '<',
			],
			[
				'key'     => 'step',
				'value'   => 3,
				'compare' => '>=',
			],
			[
				'key'     => 'sevdesk_ready_to_remind',
				'compare' => 'EXISTS'
			]
		],
	];

	$orders = get_posts( $args );

	foreach ( $orders as $order ) {
		$reminderCounter = (int) get_post_meta( $order->ID, 'sevdesk_reminder_counter', true ) ?: null;
		$reminderID      = (int) get_post_meta( $order->ID, 'sevdesk_reminder_id', true );

		$reminderCounterSuffix = '';

		if ( $reminderCounter !== null ) {
			$reminderCounterSuffix = '-' . $reminderCounter;
		}

		createSevdeskReminder( $order->ID, $reminderID );
		$response      = getSevdeskInvoicePDF( $order->ID, 'reminder' );
		$base64Content = $response['objects']['content'];
		$fileName      = 'ZE_' . $response['objects']['filename'];
		base64File( $base64Content, $order->ID, $fileName );
		update_post_meta( $order->ID, 'sevdesk_reminder_pdf' . $reminderCounterSuffix, $fileName );
		update_post_meta( $order->ID, 'sevdesk_reminder_date' . $reminderCounterSuffix, date( 'Y-m-d' ) );
		sendSevdeskReminder( $order->ID );
	}

	// Das aktuelle Datum und die Uhrzeit erfassen
	$current_datetime = current_time( 'mysql' );
	$cronData         = [ $current_datetime, count( $orders ) ];

	// Die aktuelle Zeit in einer WordPress-Option speichern
	update_option( 'reminders_latest_update', $cronData );
}

if ( checkRoles( 'administrator' ) ) {
	require_once 'sevdesk-update.php';
}