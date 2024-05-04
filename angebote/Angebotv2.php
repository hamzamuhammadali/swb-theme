<?php
/*
 * Template Name: Angebot v2
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');
$wp->init();
$user = wp_get_current_user();
$userName = $user->display_name;

$postTitleError = '';

if (isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

    $post_information = array('post_title' => esc_attr(strip_tags($_POST['firstName'])) . ' ' . esc_attr(strip_tags($_POST['lastName'])), 'post_type' => 'customer', 'post_status' => 'pending',);

    $post_id = wp_insert_post($post_information);
    add_post_meta($post_id, 'salutation', esc_attr(strip_tags($_POST['salutation'])), true);
    add_post_meta($post_id, 'companyName', esc_attr(strip_tags($_POST['companyName'])), true);
    add_post_meta($post_id, 'firstName', esc_attr(strip_tags($_POST['firstName'])), true);
    add_post_meta($post_id, 'lastName', esc_attr(strip_tags($_POST['lastName'])), true);
    add_post_meta($post_id, 'street', esc_attr(strip_tags($_POST['street'])), true);
    add_post_meta($post_id, 'houseNumber', esc_attr(strip_tags($_POST['houseNumber'])), true);
    add_post_meta($post_id, 'zip', esc_attr(strip_tags($_POST['zip'])), true);
    add_post_meta($post_id, 'city', esc_attr(strip_tags($_POST['city'])), true);
    add_post_meta($post_id, 'phoneNumber', esc_attr(strip_tags($_POST['phoneNumber'])), true);
    add_post_meta($post_id, 'mobileNumber', esc_attr(strip_tags($_POST['mobileNumber'])), true);
    add_post_meta($post_id, 'emailAddress', esc_attr(strip_tags($_POST['emailAddress'])), true);
    add_post_meta($post_id, 'totalIncl', esc_attr(strip_tags($_POST['totalIncl'])), true);
    add_post_meta($post_id, 'totalExcl', esc_attr(strip_tags($_POST['totalExcl'])), true);
    add_post_meta($post_id, 'byMail', esc_attr(strip_tags($_POST['byMail'])), true);
    add_post_meta($post_id, 'status', esc_attr(strip_tags($_POST['byMail'])), true);
    add_post_meta($post_id, 'kwhprice', esc_attr(strip_tags($_POST['kwhprice'])), true);
    add_post_meta($post_id, 'energy', esc_attr(strip_tags($_POST['energy'])), true);
    add_post_meta($post_id, 'energycosts', esc_attr(strip_tags($_POST['energycosts'])), true);
    add_post_meta($post_id, 'storage', esc_attr(strip_tags($_POST['storage'])), true);
    add_post_meta($post_id, 'module', esc_attr(strip_tags($_POST['module'])), true);
    add_post_meta($post_id, 'moduleqty', esc_attr(strip_tags($_POST['moduleqty'])), true);
    add_post_meta($post_id, 'inverter', esc_attr(strip_tags($_POST['inverter'])), true);
    add_post_meta($post_id, 'calculation', esc_attr(strip_tags($_POST['calculation'])), true);
    add_post_meta($post_id, 'agreements', $_POST['agreements'], true);

add_post_meta($post_id, 'byMail', esc_attr(strip_tags($_POST['byMail'])), true);


    $qtyfields = [];
    $args = array('post_type' => 'agreement', 'posts_per_page' => -1);
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            if (get_post_meta(get_the_id(), 'qty', true)) {
                add_post_meta($post_id, 'qty-'.get_the_ID(), esc_attr(strip_tags($_POST['qty-'.get_the_ID()])), true);
            }
        endwhile;
        wp_reset_postdata();
    endif;
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
      <title>Angebot</title>
      <link href='/wp-content/themes/swb/angebote/style.css' rel='stylesheet' type='text/css'>
      <script src='/wp-content/themes/swb/angebote/js/scripts.js?2938932323423'></script>
  </head>
  <body class="angebote" data-body="simple">
    <div class='employee'>
        <div class='container-fluid'>
            <input class='form-control' id='employee_name' required='required' type='hidden' value='<?php echo $userName;?>'>
            <input id='date' name='date' type='hidden'>
            <div class='d-flex justify-content-between'>
                <div class='employee__name'></div>
                <div class='employee__logout'><a href="<?php echo wp_logout_url('https://www.swb.solar/') ?>">Ausloggen</a></div>
            </div>
        </div>
    </div>
    <div class='container'>
        <div class='d-flex'>
            <div class='logo pt-3'>
                <img src='/wp-content/themes/swb/angebote/img/logo.svg' width='260'>
            </div>
        </div>
    </div>
    <!--TODO GOLIVE -->
    <form class="form" action="/wp-content/themes/swb/angebote/AngebotsPDFv2.php" id="ankaufformular" method="post">
      <div class='container'>
        <div class='row alig-items-center'>
          <div class='col-6'>
            <div class='highlight--white pb-1'>
              <div class='container pt-2'>
                <h3 class='text-center'>1. Persönliche Informationen </h3>
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
                  <input class='form-control' id='firstName' name='firstName' required='required' type='text'>
                </div>
                <div class='form-group text'>
                  <label for='lastName'>Name</label>
                  <input class='form-control' id='lastName' name='lastName' required='required' type='text'>
                </div>
              </div>
            </div>
            <div class='highlight--white pb-1'>
              <div class='container pt-2'>
                <h3 class='text-center'>2. Kontaktinformationen</h3>
                <div class='form-group text'>
                  <label for='street'>Straße</label>
                  <input class='form-control' id='street' name='street' required='required' type='text'>
                </div>
                <div class='form-group text'>
                  <label for='houseNumber'>Hausnummer</label>
                  <input class='form-control' id='houseNumber' name='houseNumber' required='required' type='text'>
                </div>
                <div class='form-group text'>
                  <label for='zip'>PLZ</label>
                  <input class='form-control' id='zip' name='zip' pattern="[0-9]*" required='required' type='text'>
                </div>
                <div class='form-group text'>
                  <label for='city'>Ort</label>
                  <input class='form-control' id='city' name='city' required='required' type='text'>
                </div>
                <div class='form-group text'>
                  <label for='phoneNumber'>Telefonnummer</label>
                  <input class='form-control' id='phoneNumber' name='phoneNumber' pattern="[0-9]*" required='required' type='text'>
                </div>
                <div class='form-group text'>
                  <label for='mobileNumber'>Mobilnummer</label>
                  <input class='form-control' id='mobileNumber' name='mobileNumber' pattern="[0-9]*" type='text'>
                </div>
                <div class='form-group text'>
                  <label for='emailAddress'>E-Mail Adresse</label>
                  <input class='form-control' id='emailAddress' name='emailAddress' required='required' type='email'>
                </div>
              </div>
            </div>
          </div>
          <div class='col-6 align-self-center'>
            <div class='highlight--white pb-1'>
              <div class='container pt-2'>
                <h3 class='text-center'>3. Eckdaten Wärmepumpe</h3>
                <div class='form-group text'>
                  <label for='energy'>Eigenverbrauch (kwh)</label>
                  <input class='form-control' id='energy' required='required' pattern="[0-9]*" type='number' name="energy">
                </div>
                <div class='form-group text'>
                  <label for='energycosts'>Stromkosten (€)</label>
                  <input class='form-control' id='energycosts' required='required' type='number' name="energycosts">
                </div>
                <div class='form-group text'>
                  <label for='kwhprice'>kwh Preis (€)</label>
                  <input class='form-control' id='kwhprice' required='required' type='number' readonly name="kwhprice">
                </div>
                <?php /*<div class='form-group text select'>
                  <label for='cloudsize'>Cloudgröße</label>
                  <input class='form-control' id='cloudsize' readonly="" type="text" data-cloudsizes="<?php echo get_option('cloudgroesse')?>">
                </div>
                */?>
                <div class='form-group text'>
                  <label for='storage'>Speicher</label>
                  <select class='form-control' id='storage' name="storage">
                    <option selected value="">Ohne Speicher</option>
                    <?php
                    $args = array('post_type' => 'storage', 'posts_per_page' => -1);
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
                <div class='form-group text select'>
                  <label for='module'>Modul</label>
                  <select class='form-control' id='module' name="module">
                    <option disabled selected value="">Bitte auswählen</option>
                      <?php
                      $args = array('post_type' => 'module', 'posts_per_page' => -1);
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
                </div>
                <div class='form-group text multiselect'>
                  <label>Zusatzvereinbarungen</label>
                  <select class='form-control' id="inverter" name="agreements[]" multiple="multiple">
                      <?php
                      $qtyfields = [];
                      $args = array('post_type' => 'agreement', 'posts_per_page' => -1);
                      $query = new WP_Query($args);
                      if ($query->have_posts()) :
                          while ($query->have_posts()) : $query->the_post();
                              echo '<option' . (get_post_meta(get_the_id(), 'qty', true) ? ' data-qty="true"' : '') . ' value="' . get_the_ID() . '">' . get_post_meta(get_the_id(), 'beschreibung', true) . '</option>';
                              if(get_post_meta(get_the_id(), 'qty', true)) {
                                $qtyfields[get_the_ID()] = get_post_meta(get_the_id(), 'beschreibung', true);
                              }
                          endwhile;
                          wp_reset_postdata();
                      endif;
                      ?>
                  </select>
                </div>
                <?php foreach ($qtyfields as $field => $value) :?>
                  <div class='form-group form-group--hidden text' id="<?php echo $field?>">
                    <label for='qty-<?php echo $field?>'>Stück <?php echo $value;?></label>
                    <input class="form-control" name="qty-<?php echo $field?>" id="qty-<?php echo $field?>" disabled>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class='highlight--white pb-2'>
              <div class='container pt-2'>
                <h3 class='text-center'>4. Angebot</h3>
                <div class='form-group text'>
                  <label for='totalExcl'>Gesamt netto</label>
                  <input class='form-control' id='totalExcl' min='1' name='totalExcl' pattern="[0-9]*" required='required' step='.01' type='number' data-mwst='<?php echo get_option('mwst'); ?>'>
                </div>
                <div class='form-group text'>
                  <label for='totalIncl'>Gesamt brutto</label>
                  <input class='form-control' id='totalIncl' name='totalIncl' readonly='readonly' required='required'
                         step='.01' type='number'>
                </div>
                <input id='byMail' name='byMail' type='checkbox'>
                <label for='byMail'>Angebot per Post senden</label>
              </div>
            </div>
            <div class='container'>
              <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
              <input type="hidden" name="submitted" id="submitted" value="true"/>
              <input type="hidden" name="status" id="submitted" value="pending"/>
              <!-- Todo GO LIVE --><input type="hidden" name="sendpdf" value="true"/>
              <button class='button button--primary col-12'>
                <span>Angebot erstellen</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="statusbar"></div>
    </form>
  </body>
</html>
