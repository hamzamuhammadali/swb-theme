<?php
/*
 * Template Name: Angebot v2
*/
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
$wp->init();
$user     = wp_get_current_user();
$userName = $user->display_name;

$postTitleError = '';

if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {

	$post_information = array( 'post_title'  => esc_attr( strip_tags( $_POST['firstName'] ) ) . ' ' . esc_attr( strip_tags( $_POST['lastName'] ) ),
	                           'post_type'   => 'customer',
	                           'post_status' => 'pending',
	);

	$post_id = wp_insert_post( $post_information );
	add_post_meta( $post_id, 'salutation', esc_attr( strip_tags( $_POST['salutation'] ) ), true );
	add_post_meta( $post_id, 'companyName', esc_attr( strip_tags( $_POST['companyName'] ) ), true );
	add_post_meta( $post_id, 'firstName', esc_attr( strip_tags( $_POST['firstName'] ) ), true );
	add_post_meta( $post_id, 'lastName', esc_attr( strip_tags( $_POST['lastName'] ) ), true );
	add_post_meta( $post_id, 'street', esc_attr( strip_tags( $_POST['street'] ) ), true );
	add_post_meta( $post_id, 'houseNumber', esc_attr( strip_tags( $_POST['houseNumber'] ) ), true );
	add_post_meta( $post_id, 'zip', esc_attr( strip_tags( $_POST['zip'] ) ), true );
	add_post_meta( $post_id, 'city', esc_attr( strip_tags( $_POST['city'] ) ), true );
	add_post_meta( $post_id, 'phoneNumber', esc_attr( strip_tags( $_POST['phoneNumber'] ) ), true );
	add_post_meta( $post_id, 'mobileNumber', esc_attr( strip_tags( $_POST['mobileNumber'] ) ), true );
	add_post_meta( $post_id, 'emailAddress', esc_attr( strip_tags( $_POST['emailAddress'] ) ), true );
	add_post_meta( $post_id, 'totalIncl', esc_attr( strip_tags( $_POST['totalIncl'] ) ), true );
	add_post_meta( $post_id, 'totalExcl', esc_attr( strip_tags( $_POST['totalExcl'] ) ), true );
	add_post_meta( $post_id, 'byMail', esc_attr( strip_tags( $_POST['byMail'] ) ), true );
	add_post_meta( $post_id, 'status', esc_attr( strip_tags( $_POST['byMail'] ) ), true );
	add_post_meta( $post_id, 'kwhprice', esc_attr( strip_tags( $_POST['kwhprice'] ) ), true );
	add_post_meta( $post_id, 'energy', esc_attr( strip_tags( $_POST['energy'] ) ), true );
	add_post_meta( $post_id, 'energycosts', esc_attr( strip_tags( $_POST['energycosts'] ) ), true );
	add_post_meta( $post_id, 'storage', esc_attr( strip_tags( $_POST['storage'] ) ), true );
	add_post_meta( $post_id, 'module', esc_attr( strip_tags( $_POST['module'] ) ), true );
	add_post_meta( $post_id, 'moduleqty', esc_attr( strip_tags( $_POST['moduleqty'] ) ), true );
	add_post_meta( $post_id, 'inverter', esc_attr( strip_tags( $_POST['inverter'] ) ), true );
	add_post_meta( $post_id, 'calculation', esc_attr( strip_tags( $_POST['calculation'] ) ), true );
	add_post_meta( $post_id, 'agreements', $_POST['agreements'], true );

	add_post_meta( $post_id, 'byMail', esc_attr( strip_tags( $_POST['byMail'] ) ), true );

	if ( $_POST['lead_id'] ) {
		update_post_meta( $_POST['lead_id'], 'lead_status', 'done' );
		update_post_meta( $_POST['lead_id'], 'lead_order', $post_id );
	}

	$qtyfields = [];
	$args      = array( 'post_type' => 'agreement', 'posts_per_page' => - 1 );
	$query     = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
			if ( get_post_meta( get_the_id(), 'qty', true ) ) {
				add_post_meta( $post_id, 'qty-' . get_the_ID(), esc_attr( strip_tags( $_POST[ 'qty-' . get_the_ID() ] ) ), true );
			}
		endwhile;
		wp_reset_postdata();
	endif;
	echo '<input id="postid" value="' . $post_id . '">';
	if(isset($_POST['byMail'])){
		// Define email parameters
		$email = $_POST['emailAddress'];
		$subject = 'Angebot erstellt';
		$message = '
            <html>
            <head>
                <title>' . $subject . '</title>
				<style>
					table {
					  font-family: arial, sans-serif;
					  border-collapse: collapse;
					  width: 100%;
					}

					td, th {
					  border: 1px solid #dddddd;
					  text-align: left;
					  padding: 8px;
					}

					tr:nth-child(even) {
					  background-color: #dddddd;
					}
				</style>
            </head>
            <body>
                <h2>' . $subject . '</h2>
                <p>Sehr geehrte(r) Kunde/Kundin,</p>
                <p>Ihr Angebot wurde erfolgreich erstellt.</p>
                <p>Vielen Dank für Ihr Interesse an unseren Dienstleistungen.</p>
                <p>Mit freundlichen Grüßen,</p>
                <p>Ihr Team von SWB Wärme</p>
				<table>
					  <tr>
						<th>Company</th>
						<th>Contact</th>
						<th>Country</th>
					  </tr>
					  <tr>
						<td>Alfreds Futterkiste</td>
						<td>Maria Anders</td>
						<td>Germany</td>
					  </tr>
					  <tr>
						<td>Centro comercial Moctezuma</td>
						<td>Francisco Chang</td>
						<td>Mexico</td>
					  </tr>
					  <tr>
						<td>Ernst Handel</td>
						<td>Roland Mendel</td>
						<td>Austria</td>
					  </tr>
					  <tr>
						<td>Island Trading</td>
						<td>Helen Bennett</td>
						<td>UK</td>
					  </tr>
					  <tr>
						<td>Laughing Bacchus Winecellars</td>
						<td>Yoshi Tannamuri</td>
						<td>Canada</td>
					  </tr>
					  <tr>
						<td>Magazzini Alimentari Riuniti</td>
						<td>Giovanni Rovelli</td>
						<td>Italy</td>
					  </tr>
					</table>
            </body>
            </html>
        ';
		$headers = array();
		$attachments = array();

		// Add additional headers if needed
		$headers[] = 'Reply-To: Your Name <kontakt@swb-waerme.de>';

		// Call the sendEmail function
		sendEmail($email, $subject, $message, $headers, $attachments);
	}
}

$leadID = '';
if ( isset( $_POST['lead_id'] ) ) {
	$leadID   = $_POST['lead_id'];
	$leadName = get_post_meta( $leadID, 'lead_name', true ) ? get_post_meta( $leadID, 'lead_name', true ) : get_the_title( $leadID );
	if ( ! get_post_meta( $_POST['lead_id'], 'lead_eml', true ) ) {
		$leadFirstName = get_post_meta( $leadID, 'lead_firstName', true ) ? get_post_meta( $leadID, 'lead_firstName', true ) : false;
		$leadLastName  = get_post_meta( $leadID, 'lead_lastName', true ) ? get_post_meta( $leadID, 'lead_lastName', true ) : false;

		$mailArray = (array) get_post_meta( $leadID, 'lead_email', true );
		$leadEmail = $mailArray ? $mailArray['default'][0] : false;

		$phoneArray = (array) get_post_meta( $leadID, 'lead_phone', true );
		$leadPhone  = $phoneArray ? $phoneArray['default'][0] : false;

		$leadAddress   = '';
		$addressStreet = '';
		$addressPostal = '';
		$addressCity   = '';
		if ( $addressArray = (array) get_post_meta( $leadID, 'lead_address', true ) ) {
			$leadAddress   = $addressArray['default'][0];
			$addressStreet = $addressArray['default'][0]->street;
			$addressPostal = $addressArray['default'][0]->zip;
			$addressCity   = $addressArray['default'][0]->city;
		}


		$leadOrganization = get_post_meta( $leadID, 'lead_organization', true ) ? get_post_meta( $leadID, 'lead_organization', true ) : false;
		$leadNote         = get_post_meta( $leadID, 'lead_note', true ) ? get_post_meta( $leadID, 'lead_note', true ) : false;
	}
}

$color      = get_option( 'color' );
$backendURL = '';
if ( checkRoles( [ 'administrator', 'director' ] ) ) {
	$backendURL = '/wp-admin';
} else if ( checkRoles( 'seller' ) ) {
	$backendURL = '/wp-admin/edit.php?post_type=customer';
} else {
	$backendURL = '/wp-admin/admin.php?page=dashboard';
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<title>Angebot</title>
	<link href='/wp-content/themes/swb/angebote/style.css' rel='stylesheet' type='text/css'>
	<script src='/wp-content/themes/swb/angebote/js/scripts.js?29'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="angebote"  data-body="v2">
<div class='employee' style="background: <?php echo $color; ?>">
	<div class='container-fluid'>
		<input class='form-control' id='employee_name' required='required' type='hidden'
		       value='<?php echo $userName; ?>'>
		<input id='date' name='date' type='hidden'>
		<div class='d-flex justify-content-between'>
			<div class='employee__name'></div>
			<div class='employee__logout'><a href="<?php echo wp_logout_url( get_home_url() ) ?>">Ausloggen</a> | <a
					href="<?php echo $backendURL; ?>">Admin Bereich</a></div>
		</div>
	</div>
</div>
<?php if ( $leadID ): ?>
	<div class="lead">
		<div class="lead__header">
			<strong><?php echo $leadID; ?></strong> | <?php echo $leadName ?: ''; ?><br>
		</div>
		<div class="lead__info">
			<?php if ( get_post_meta( $leadID, 'lead_eml', true ) ): ?>
				<?php // echo strip_tags(get_post_meta($lead->ID, 'lead_eml_body', true), '<table></table><td></td><tr></tr>');?>
				<?php echo preg_replace( '/<style\\b[^>]*>(.*?)<\\/style>/s', '', get_post_meta( $leadID, 'lead_eml_body', true ) ); ?>
				<h2>Lead Uploads</h2>
				<?php if ( $attachments = get_post_meta( $leadID, 'lead_eml_attachments', true ) ): ?>
					<?php foreach ( $attachments as $attachment ) : ?>
						<?php $attachmentIcon = 'download-file.svg';
						if ( str_contains( $attachment['url'], '.pdf' ) != 0 ) {
							$attachmentIcon = 'PDF_file_icon.svg';
						} else if ( str_contains( $attachment['url'], '.csv' ) != 0 ) {
							$attachmentIcon = 'csv_file.svg';
						} else if ( str_contains( $attachment['url'], '.vcf' ) != 0 ) {
							$attachmentIcon = 'vcf_file.svg';
						}
						?>
						<a class="d-inline-flex align-items-center order-attachment__icon order-attachment__icon--item pr-3"
						   href="<?php echo $attachment['url']; ?>" target="_blank">
							<div class="d-flex align-items-center justify-content-center m-3">
								<img width="50" src="/wp-content/themes/swb/img/icons/<?php echo $attachmentIcon; ?>">
							</div>
							<span>
								<?php echo $attachment['filename']; ?>
							</span>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php else: ?>
				<?php echo $leadName ?: ''; ?><br>
				<?php echo $leadOrganization ?: ''; ?>
				<br>
				<?php echo $leadEmail ?: ''; ?>
				<br>
				<?php echo $leadPhone ?: ''; ?><br>
				Adresse: <?php echo $addressStreet ?: ''; ?>, <?php echo $addressPostal ?: ''; ?>, <?php echo $addressCity ?: ''; ?>
				<br><br>
				<?php echo str_replace( "[", "<br>[", $leadNote ?: '' ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
<div class='container'>
	<div class='d-flex'>
		<div class='logo pt-3'>
			<img src='<?php echo wp_get_attachment_url( get_option( 'logoprint' ) ); ?>' width='260'>
		</div>
	</div>
</div>
<form class="form" action="/wp-content/themes/swb/angebote/AngebotsPDF.php" id="ankaufformular" method="post">
	<div class='container'>
		<div class='row alig-items-center'>
			<div class='col-lg-6'>
				<div class='highlight--white pb-1'>
					<div class='container pt-2'>
						<h3 class='text-center'>1. Persönliche Informationen</h3>
						<div class='form-group form-group--radio form-group--no-border'>
							<input id='mr' name='salutation' required='required' type='radio' value="Herr">
							<label for='mr'>Herr</label>
							<input id='mrs' name='salutation' required='required' type='radio' value="Frau">
							<label for='mrs'>Frau</label>
						</div>
						<div class='form-group text'>
							<label for='companyName'>Familie</label>
							<input class='form-control' id='companyName' name='companyName' type='text'>
						</div>
						<div class='form-group text'>
							<label for='firstName'>Vorname</label>
							<input class='form-control' id='firstName' name='firstName' required='required'
							       type='text' <?php echo $leadFirstName ? 'value="' . $leadFirstName . '"' : ''; ?>>
						</div>
						<div class='form-group text'>
							<label for='lastName'>Name</label>
							<input class='form-control' id='lastName' name='lastName' required='required'
							       type='text' <?php echo $leadLastName ? 'value="' . $leadLastName . '"' : ''; ?>>
						</div>
					</div>
				</div>
				<div class='highlight--white pb-1'>
					<div class='container pt-2'>
						<h3 class='text-center'>2. Kontaktinformationen</h3>
						<div class='form-group text'>
							<label for='street'>Straße</label>
							<input class='form-control' id='street' name='street' required='required'
							       type='text' <?php echo $addressStreet ? 'value="' . $addressStreet . '"' : ''; ?>>
						</div>
						<div class='form-group text'>
							<label for='houseNumber'>Hausnummer</label>
							<input class='form-control' id='houseNumber' name='houseNumber' required='required'
							       type='text'>
						</div>
						<div class='form-group text'>
							<label for='zip'>PLZ</label>
							<input class='form-control' id='zip' name='zip' pattern="[0-9]*" required='required'
							       type='text' <?php echo $addressPostal ? 'value="' . $addressPostal . '"' : ''; ?>>
						</div>
						<div class='form-group text'>
							<label for='city'>Ort</label>
							<input class='form-control' id='city' name='city' required='required'
							       type='text' <?php echo $addressCity ? 'value="' . $addressCity . '"' : ''; ?>>
						</div>
						<div class='form-group text'>
							<label for='phoneNumber'>Telefonnummer</label>
							<input class='form-control' id='phoneNumber' name='phoneNumber' pattern="[0-9]*"
							       required='required'
							       type='text' <?php echo $leadPhone ? 'value="' . $leadPhone . '"' : ''; ?>>
						</div>
						<div class='form-group text'>
							<label for='mobileNumber'>Mobilnummer</label>
							<input class='form-control' id='mobileNumber' name='mobileNumber' pattern="[0-9]*"
							       type='text'>
						</div>
						<div class='form-group text'>
							<label for='emailAddress'>E-Mail Adresse</label>
							<input class='form-control' id='emailAddress' name='emailAddress' required='required'
							       type='email' <?php echo $leadEmail ? 'value="' . $leadEmail . '"' : ''; ?>>
						</div>
					</div>
				</div>
			</div>
			<div class='col-lg-6 align-self-center'>
				<div class='highlight--white pb-1'>
					<div class='container pt-2'>
						<h3 class='text-center'>3.Eckdaten Wärmepumpe</h3>
						<div class='form-group text'>
						</div>
						<div class='form-group text'>
							<label for='calculation'>Heizkörper</label>
							<select class='form-control' id='calculation' name="calculation">
								<option disabled selected value="">Bitte auswählen</option>
								<option value="Fussbodenheizung">Fussbodenheizung</option>
								<option value="Konvektoren">Konvektoren</option>
								<option value="Radiatoren">Radiatoren</option>
							</select>
						</div>
						<div class='form-group text'>
							<label for='baujahr'>Baujahr</label>
							<input class='form-control' id='energycosts' required='required' type='number'
							       name="baujahr">
						</div>
						<div class='form-group text'>
							<label for='gesamtwohnflache'>Gesamtwohnfläche (m²)</label>
							<select class='form-control' id='gesamtwohnflache' name="gesamtwohnflache">
								<option disabled selected value="">Gesamtwohnfläche (m²)</option>
								<option value="0-150">0-150</option>
								<option value="150-210">150-210</option>
								<option value="210-270">210-270</option>
								<option value="270-295">270-295</option>
								<option value="295-350">295-350</option>
							</select>
						</div>
						<div class='form-group text'>
							<label for='heizenergieart'>Heizenergieart</label>
							<select class='form-control' id='heizenergieart' name="heizenergieart">
								<option disabled selected value="">Bitte auswählen</option>
								<option value="Öl">Öl</option>
								<option value="Gas">Gas</option>
							</select>
						</div>
						<div class='form-group text'>
							<label for='heizenergieverbrauch'>Heizenergieverbrauch</label>
							<input class='form-control' id='heizenergieverbrauch' required='required' type='number'
							       name="heizenergieverbrauch">
						</div>
						<div class='form-group text'>
							<label for='personen'>Wieviele Personen wohnen im Haus (alle Parteien)</label>
							<select class='form-control' id='personen' name="personen">
								<option value="1-4">1-4</option>
								<option value="4-7">4-7</option>
								<option value="7-9">7-9</option>
								<option value="9-13">9-13</option>
							</select>
						</div>
						<?php /*<div class='form-group text select'>
                  <label for='cloudsize'>Cloudgröße</label>
                  <input class='form-control' id='cloudsize' readonly="" type="text" data-cloudsizes="<?php echo get_option('cloudgroesse')?>">
                </div>
                */ ?>
						<?php /*  <div class='form-group text'>
               <label for='storage'>Speicher</label>
              <select class='form-control' id='storage' name="storage">
                <option selected value="">Ohne Speicher</option>
                  <?php
                  $args = [
	                  'post_type'      => 'storage',
	                  'posts_per_page' => - 1,
	                  'meta_query'     => [
		                  [
			                  'key'     => 'active',
			                  'value'   => 'on',
			                  'compare' => '='
		                  ]
	                  ]
                  ];
                  $query = new WP_Query($args);
                  if ($query->have_posts()) :
                      while ($query->have_posts()) : $query->the_post();
	                      $storageAgreements = get_post_meta(get_the_ID(), 'agreements', true);
	                      echo '<option value="' . get_the_ID() . '"'.($storageAgreements ? ' data-agreements="'.$storageAgreements.'"': '').'>' . get_post_meta(get_the_id(), 'name', true) . '</option>';                      endwhile;
                      wp_reset_postdata();
                  endif;
                  ?>
              </select>
            </div>
            <div class='form-group text select'>
              <label for='module'>Modul</label>
              <select class='form-control' id='module' name="module">
                <option disabled selected value="">Bitte auswählen</option>
                  <?php
                  $args = [
	                  'post_type'      => 'module',
	                  'posts_per_page' => - 1,
	                  'meta_query'     => [
		                  [
			                  'key'     => 'active',
			                  'value'   => 'on',
			                  'compare' => '='
		                  ]
	                  ]
                  ];
                  $query = new WP_Query($args);
                  if ($query->have_posts()) :
                      while ($query->have_posts()) : $query->the_post();
                          echo '<option data-kwh="' . get_post_meta(get_the_ID(), 'typ', true) . '" value="' . get_the_ID() . '">' . get_post_meta(get_the_id(), 'pvmoduleid', true) . '</option>';
                      endwhile;
                      wp_reset_postdata();
                  endif;
                  ?>
              </select>
            </div>
            <div class='form-group text select'>
              <label for='moduleqty'>Anzahl Module</label>
              <input id="moduleqty" class="form-control" type="number" pattern="[0-9]*" name="moduleqty">
            </div>
            <div class='form-group text'>
              <label for='inverter'>Wechselrichter</label>
              <select class='form-control' id="inverter" name="inverter">
                <option disabled selected value="">Bitte auswählen</option>
                  <?php
                  $args = array('post_type' => 'inverter', 'posts_per_page' => -1);
                  $query = new WP_Query($args);
                  if ($query->have_posts()) :
                      while ($query->have_posts()) : $query->the_post();
                          echo '<option value="' . get_the_ID() . '">' . get_post_meta(get_the_id(), 'name', true) . '</option>';
                      endwhile;
                      wp_reset_postdata();
                  endif;
                  ?>
              </select>
            </div>
            <div class='form-group text'>
              <label for='energycosts'>Wirtschaftlichkeitsberechnung</label>
              <select class='form-control' id='energycosts' name="calculation">
                <option disabled selected value="">Bitte auswählen</option>
                <option value="Ja">Ja</option>
                <option value="Nein">Nein</option>
              </select>
            </div>*/ ?>

						<div class='form-group text multiselect'>
							<label style="left: 2px;width: 96%;padding: 10px;top: 1px;">Zusatzvereinbarungen</label>
							<select class='form-control' id="agreements" name="agreements[]" multiple="multiple" style="padding-top:42px !important;">
								<?php
								$qtyfields = [];
								$args      = array( 'post_type' => 'agreement', 'posts_per_page' => - 1 );
								$query     = new WP_Query( $args );
								if ( $query->have_posts() ) :
									while ( $query->have_posts() ) : $query->the_post();
										echo '<option' . ( get_post_meta( get_the_id(), 'qty', true ) ? ' data-qty="true"' : '' ) . ' value="' . get_the_ID() . '">' . get_post_meta( get_the_id(), 'beschreibung', true ) . '</option>';
										if ( get_post_meta( get_the_id(), 'qty', true ) ) {
											$qtyfields[ get_the_ID() ] = get_post_meta( get_the_id(), 'beschreibung', true );
										}
									endwhile;
									wp_reset_postdata();
								endif;
								?>
							</select>
						</div>
						<?php foreach ( $qtyfields as $field => $value ) : ?>
							<div class='form-group form-group--hidden text' id="<?php echo $field ?>">
								<label for='qty-<?php echo $field ?>'>Stück <?php echo $value; ?></label>
								<input class="form-control" name="qty-<?php echo $field ?>"
								       id="qty-<?php echo $field ?>" disabled>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class='highlight--white pb-2'>
					<div class='container pt-2'>
						<h3 class='text-center'>4. Angebot</h3>
						<div class='form-group text'>
 							<label for='totalExcl'>Gesamt netto (€)</label>
							<input class='form-control' id='totalExcl' min='1' name='totalExcl' pattern="[0-9]*"
							       required='required' step='.01' type='number'
							       data-mwst='<?php echo get_option( 'mwst' ); ?>'>
						</div>
						<div class='form-group text'>
							<label for='totalIncl'>Gesamt brutto (€)</label>
							<input class='form-control' id='totalIncl' name='totalIncl' readonly='readonly'
							       required='required'
							       step='.01' type='number'>
						</div>
						<input id='byMail' name='byMail' type='checkbox'>
						<label for='byMail'>Angebot per Post senden</label>
					</div>
				</div>
				<div class='container'>
					<?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
					<input type="hidden" name="submitted" id="submitted" value="true"/>
					<?php if ( $leadID ): ?>
						<input type="hidden" name="lead_id" id="submitted" value="<?php echo $leadID; ?>"/>
					<?php endif; ?>
					<input type="hidden" name="status" id="submitted" value="pending"/>
					<input type="hidden" name="sendpdf" value="true"/>
					<button class='button button--primary col-12' style="background: <?php echo $color; ?>">
						<span>Angebot erstellen</span>
					</button>
					<div id="pdfDownloadBtn"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="statusbar"></div>
</form>
<?php if ( $leadID ): ?>
	<script>
		jQuery(document).ready(function ($) {
			$('.lead__header').click(function () {
				$(this).toggleClass('lead__header--active');
			});
		});
	</script>
<?php endif; ?>
</body>
</html>