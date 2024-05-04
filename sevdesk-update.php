<?php


function sevdeskUpdateScript() {
	global $sevdeskApiKey;

	$args = [
		'post_type'      => 'customer', // Ersetzen Sie IHR_CUSTOM_POST_TYPE durch den Namen Ihres Custom Post Typs
		'post_status'    => 'private',
		'posts_per_page' => - 1,
		'p'=>25508,
		'meta_query'     => [
			[
				'key'     => 'sevdesk_invoice_id',
				'compare' => 'EXISTS',
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
		update_post_meta($order->ID, 'sevdesk_invoice_date', '2023-12-05');
	}
}
