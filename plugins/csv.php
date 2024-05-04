<?php
// Hook, um das Admin-Menü zu erstellen
add_action('admin_menu', 'custom_csv_import_menu');

function custom_csv_import_menu() {
	add_submenu_page(
		'settings',
		'CSV Import',
		'CSV Import',
		'manage_options',
		'custom-csv-import',
		'custom_csv_import_page'
	);
}

function custom_csv_import_page() {
	?>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/css/sass/steps.css">
	<div class="postbox m-3">
		<div class="container py-3 px-4">
			<?php
			// Wenn das Formular gesendet wurde, die Datei verarbeiten
			if (isset($_POST['upload_csv'])) {
				handle_csv_upload();
			}
			?>

			<div class="dashboard__header">
				<h1>Preis CSV Import</h1>
			</div>

			<form method="post" enctype="multipart/form-data">
				<div class="d-flex flex-wrap align-items-center">
					<div class="mb-3 label--small-upload">
					<input type="file" name="csv_file" id="csvAttachment" accept=".csv"><br>
					<button type="submit" name="upload_csv" class="button button-primary mt-1" style="width: 100%"><span>Hochladen</span></button>
					</div>
				</div>
			</form>

			<?php
			// Zeige die CSV-Datei tabellarisch an
			display_csv_table();
			?>
		</div>
	</div>
	<?php
}

function handle_csv_upload() {
	if (empty($_FILES['csv_file']['tmp_name'])) {
		echo '<div class="error"><p>Bitte wählen Sie eine CSV-Datei aus.</p></div>';
		return;
	}

	$upload_dir = wp_upload_dir(); // Holen Sie das Upload-Verzeichnis von WordPress

	// Zielverzeichnis für die CSV-Datei festlegen (wp-content/uploads/csv/)
	$target_dir = $upload_dir['basedir'] . '/csv/';

	// Erstellen Sie das Verzeichnis, wenn es nicht existiert
	if (!file_exists($target_dir)) {
		wp_mkdir_p($target_dir);
	}

	// Zielweg für die CSV-Datei
	$target_file = $target_dir . basename($_FILES['csv_file']['name']);

	// Verschieben Sie die hochgeladene Datei in das Zielverzeichnis
	if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $target_file)) {
		// Verarbeiten Sie die CSV-Datei und zeigen Sie eine Erfolgsmeldung an
		array_map('str_getcsv', file($target_file));

		// Speichern Sie den Dateinamen der zuletzt hochgeladenen CSV-Datei in einer Option
		update_option('last_uploaded_csv', basename($target_file));

		// Speichern Sie das Upload-Datum in einer Option
		update_option('last_csv_upload', current_time('mysql'));

		echo '<div class="updated m-0"><p>CSV-Datei erfolgreich verarbeitet.</p></div>';
	} else {
		echo '<div class="error m-0"><p>Fehler beim Hochladen der CSV-Datei.</p></div>';
	}
}

function display_csv_table() {

	?>
	<table class="default_list" style="width: 100%; padding: 0!important;">
		<thead>
		<tr>
			<th>Modul</th>
			<th>Modul Anzahl</th>
			<th>Speicher</th>
			<th>Preis</th>
		</tr>
		</thead>
		<tbody>
		<?php
		// Lese die CSV-Datei ein
		$csv_file = fopen(wp_upload_dir()['path'].'/csv/'.get_option('last_uploaded_csv'), 'r');

		// Iteriere durch die Zeilen der CSV-Datei und zeige sie in der Tabelle an
		while (($row_data = fgetcsv($csv_file, 0, ';')) !== false) {
			$row_data[0] = preg_replace('/\x{EF}\x{BB}\x{BF}/', '', $row_data[0]);

			echo '<tr>';
			echo '<td>' . esc_html(get_post_meta($row_data[0], 'pvmoduleid', true)) . '</td>';
			echo '<td>' . esc_html($row_data[1]) . '</td>';
			echo '<td>' . esc_html(get_post_meta($row_data[2], 'typ', true)) . '</td>';

			echo '<td>' . esc_html(number_format(floatval(str_replace(',', '.', $row_data[3])), 2, ',', '.')) . ' €</td>';
			echo '</tr>';
		}

		fclose($csv_file);
		?>

		</tbody>
	</table>

	<?php

	$last_upload = get_option('last_csv_upload', 'N/A');
	echo '<div class="mt-3 text-center"><sup>
				<strong>Letztes Update</strong><br>' . date('d.m.Y', strtotime($last_upload)) . ' um ' .  date('G:i', strtotime($last_upload)). ' Uhr </sup></div>';

}

function update_order_counters($order_id) {
	// Holen Sie den Benutzer der Bestellung
	$user_id = get_post_field('post_author', $order_id);

	// Aktualisieren Sie den Benutzerzähler
	$current_counter = get_user_meta($user_id, 'order_counter', true);
	update_user_meta($user_id, 'order_counter', $current_counter + 1);

	// Holen Sie das Datum der Bestellung
	$order_date = get_post_meta($order_id, 'order_start_date', true);

	// Holen Sie den Monat aus dem Datum
	$order_month = date('Ym', strtotime($order_date));

	// Aktualisieren Sie den Zähler für den Monat
	$current_month_counter = get_user_meta($user_id, 'order_counter_' . $order_month, true);
	update_user_meta($user_id, 'order_counter_' . $order_month, $current_month_counter + 1);
}

add_action('publish_orders', 'update_order_counters');


function getMargin() {

}
