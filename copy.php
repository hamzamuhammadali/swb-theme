<?php

function upload_and_parse_vcf() {
	$files       = $_FILES['upload_files'];
	$upload_path = wp_upload_dir()['path'] . '/';

	$success_msg = '';
	$error_msg   = '';

	for ( $i = 0; $i < count( $files['name'] ); $i ++ ) {
		$filename = $files['name'][ $i ];
		$filetmp  = $files['tmp_name'][ $i ];

		if ( move_uploaded_file( $filetmp, $upload_path . $filename ) ) {
			// Überprüfen des Dateityps
			$filetype = wp_check_filetype( $filename );
			if ( $filetype['ext'] === 'vcf' ) {
				$parser = new VCardParser( $filetmp );
				$vcards = $parser->parseFromFile( $upload_path . $filename );

				// Neue Beiträge im Custom Post Type "leads" erstellen
				foreach ( $vcards as $vcard ) {
					$postarr = array(
						'post_title'  => $vcard->fullname,
						'post_type'   => 'lead',
						'post_status' => 'private'
					);
					$post_id = wp_insert_post( $postarr );

					// Benutzerdefinierte Felder mit den geparsten Daten füllen
					update_post_meta( $post_id, 'lead_name', $vcard->fullname );
					update_post_meta( $post_id, 'lead_firstName', $vcard->firstname );
					update_post_meta( $post_id, 'lead_lastName', $vcard->lastname );
					update_post_meta( $post_id, 'lead_email', $vcard->email );
					update_post_meta( $post_id, 'lead_phone', $vcard->phone );
					update_post_meta( $post_id, 'lead_address', $vcard->address );
					update_post_meta( $post_id, 'lead_organization', $vcard->organization );
					update_post_meta( $post_id, 'lead_note', $vcard->note );
				}

				// VCF-Datei löschen
				unlink( $upload_path . $filename );
				$success_msg .= sprintf( __( 'Die Datei <strong>%s</strong> wurde erfolgreich hochgeladen und verarbeitet.', 'textdomain' ), $filename ) . '<br>';

			} elseif ( $filetype['ext'] === 'eml' ) {
				$postarr = array(
					'post_title'  => $filename,
					'post_type'   => 'lead',
					'post_status' => 'private'
				);
				$post_id = wp_insert_post( $postarr );

				// EML-Datei als post meta "lead_eml" speichern
				$file_url = $upload_path . $filename;
				update_post_meta( $post_id, 'lead_eml', $file_url );
				$success_msg .= sprintf( __( 'Die Datei <strong>%s</strong> wurde erfolgreich hochgeladen.', 'textdomain' ), $filename ) . '<br>';

			} else {
				unlink( $upload_path . $filename );
				$error_msg .= sprintf( __( 'Die Datei %s hat ein ungültiges Dateiformat.', 'textdomain' ), $filename ) . '<br>';
			}

		} else {
			$error_msg .= sprintf( __( 'Es gab einen Fehler beim Hochladen der Datei %s', 'textdomain' ), $filename ) . '<br>';

		}
	}

	// Ausgabe der Erfolgs- und Fehlermeldungen
	if ( $success_msg ) {
		die( '<div class="success">' . $success_msg . '</div>' );
	}

	if ( $error_msg ) {
		die( '<div class="error">' . $error_msg . '</div>' );
	}
}
?>