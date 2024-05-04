<?php
/*
 * Template Name: Kontakt
*/
?>

<?php get_header(); ?>

<section class="content">
  <div class="container-fluid container-fluid--nopadding mb-3 mb-lg-5">
    <div class="row no-gutters">
      <div class="col-12 col-lg-6">
        <div class="teaser teaser--big"
             style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"></div>
      </div>
      <div class="col-12 col-lg-6 row no-gutters align-items-center pl-lg-0 py-3 py-lg-4">
        <div class="col-12 col-md-12 col-lg-12 row no-gutters">
          <div class="col-12 col-md-12">
            <div class="teaser__tile teaser__tile--basic">
              <div class="teaser__pre">
                Unsere
              </div>
              <div class="teaser__headline">
                <h1><?php the_title(); ?></h1>
                  <?php the_content(); ?>
                <div class="row path-black mt-3">
                  <div class="col-auto">
                      <?php echo do_shortcode('[googleinfo type="address"]'); ?>
                  </div>
                  <div class="col-auto">
                      <?php echo do_shortcode('[googleinfo type="hours"]'); ?>
                  </div>
                  <div class="col-auto">
                      <?php echo do_shortcode('[googleinfo type="contact"]'); ?>
                  </div>
                </div>
              </div>
              <div class="teaser__text">
                <form autocomplete="on" class="contactform" name="contactform" method="get"
                      action="/wp-content/themes/swb/mail.php" id="contactform">
                  <div class="form-group">
                    <input type="radio" name="anrede" value="Frau" id="frau" required>
                    <label class="form-check-label" for="frau">
                      Frau
                    </label> &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="anrede" value="Herr" id="herr" required>
                    <label class="form-check-label" for="herr">
                      Herr
                    </label>
                  </div>
                  <div class="form-group text">
                    <label for="first_name">Vorname, Nachname</label>
                    <input class="form-control" type="text" name="first_name" maxlength="50" size="30" id="first_name"
                           required>
                  </div>
                  <div class="form-group text">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" maxlength="50" size="30" class="form-control" id="email" required>
                  </div>
                  <div class="form-group text">
                    <label for="telephone">Telefon</label>
                    <input type="text" name="telephone" maxlength="50" size="30" class="form-control" id="telephone"
                           required>
                  </div>
                  <div class="form-group text">
                    <label for="comments">Ihre Nachricht</label>
                    <textarea name="comments" id="comments" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-check text">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                    <label class="form-check-label" for="defaultCheck1">
                      <span>
                        Ich akzeptiere die <a href="/datenschutzerklaerung">Datenschutzerklärung</a> dieser Webseite.
                      </span>
                    </label>
                  </div>
                  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                  <div>
                    <button type="submit" class="button button--primary">
                      <span>Abschicken</span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="teaser__tile teaser__tile--nogap">
      <div class="teaser__pre">
        FAQ
      </div>
      <div class="teaser__headline">
        <h2 class="h1">Fragen & Antworten</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="faq">
          <div class="faq__question">
            <h3>Was ist Photovoltaik?</h3>
          </div>
          <div class="faq__answer">
            Photovoltaik ist eine Technologie zur Erzeugung von Strom aus Sonnenenergie. Dazu werden Photovoltaik- bzw.
            Solarmodule eingesetzt, beispielsweise auf Dächern, die wiederum aus vielen einzelne Solarzellen bestehen.
            Die Solarzellen von Photovoltaikanlagen wandeln die Energie von eintreffenden Sonnenstrahlen in Strom um.
            Bei diesem handelt es sich zunächst um Gleichstrom, der dann mit Hilfe eines Wechselrichters in Wechselstrom
            umgewandelt wird. Erst dadurch wird er für das Stromnetz nutzbar.
          </div>
        </div>
        <div class="faq">
          <div class="faq__question">
            <h3>Ist eine Baugenehmigung notwendig?</h3>
          </div>
          <div class="faq__answer">
            Nein. Außer bei denkmalgeschützten Gebäuden benötigen Hausbesitzer keine Baugenehmigung für die Errichtung
            einer Photovoltaikanlage auf dem eigenen Dach.
          </div>
        </div>
        <div class="faq">
          <div class="faq__question">
            <h3>Lohnt sich eine Photovoltaikanlage für ein kleines Haus?</h3>
          </div>
          <div class="faq__answer">
            Photovoltaikanlagen bieten viele Vorteile für alle Arten von Gebäuden und lohnen sich somit auch für
            kleinere Häuser. Eine kleine Photovoltaikanlage mit 20 m³ schafft es bereits ein Haus mit 3.000 kWh
            Solarstrom jährlich zu versorgen.
          </div>
        </div>
        <div class="faq">
          <div class="faq__question">
            <h3>Wie lange dauert die Installation auf dem Dach?</h3>
          </div>
          <div class="faq__answer">
            In den meisten Fällen geht die Installation der Photovoltaikanlage schnell vonstatten. Bei der Montage auf
            einem Hausdach dauert der Vorgang zumeist nicht länger als einen Tag.
          </div>
        </div>
        <div class="faq">
          <div class="faq__question">
            <h3>Wie funktioniert ein Stromspeicher?</h3>
          </div>
          <div class="faq__answer">
            Die aktuell verfügbaren Stromspeichersysteme basieren auf Lithium-Ionen Technologie.
            Lithium-Ionen Technologie hat sich mittlerweile unter Anlagenbetreibern etabliert, da diese Art von
            Batterien deutlich häufiger be- und entladen werden kann und einen höheren Wirkungsgrad erzielt.
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="faq">
          <div class="faq__question">
            <h3>Welche Dachausrichtung wird benötigt.</h3>
          </div>
          <div class="faq__answer">
            In der Regel eignen sich Dächer mit einer Süd-, Ost- sowie West-Ausrichtung am besten für die Installation
            einer PV-Anlage. Doch auch hier gibt es Ausnahmen. Ein Nord-Dach im Süden Deutschlands kann z.B. so gut wie
            ein Ost- oder West Dach im Norden Deutschlands sein. Die Region und die Dachneigung spielen hierbei also
            ebenfalls eine wichtige Rolle.
          </div>
        </div>
        <div class="faq">
          <div class="faq__question">
            <h3>Ist eine Finanzierung möglich?</h3>
          </div>
          <div class="faq__answer">
            Ja, eine Finanzierung von Photovoltaikanlagen ist möglich. Sie haben die Möglichkeit Ihre Photovoltaikanlage
            über die bestehenden Stromkosten zu Refinanzieren, ohne die Haushaltskasse mehr zu belasten.
          </div>
        </div>
        <div class="faq">
          <div class="faq__question">
            <h3>Wie lange beträgt die durchschnittliche Lebensdauer?</h3>
          </div>
          <div class="faq__answer">
            Die Lebensdauer einen PV-Anlage ist länger als erwartet: Anlagen mit hochqualitativen Komponenten besitzen
            bei regelmäßiger Wartung eine Lebensdauer von mehr als 25 Jahren.
          </div>
        </div>
        <div class="faq">
          <div class="faq__question">
            <h3>Lohnt sich ein Batteriespeicher?</h3>
          </div>
          <div class="faq__answer">
            Die Preise für Stromspeicher sind in den letzten Jahren stark gesunken. Die Installation einer
            Photovoltaikanlage mit Batteriespeicher oder das Nachrüsten einer bestehenden Anlage mit einem solchen,
            lohnt sich aber auch aus anderen Gründen:
            * Mit einer PV-Anlage mit Speicher machen Sie sich langfristig unabhängig von den Strompreis-Erhöhungen.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://www.google.com/recaptcha/api.js?render=6Ld02ogaAAAAAP03F4C14NZiznr-ovI_pl9NUS2U"></script>
<script>
  grecaptcha.ready(function () {
    grecaptcha.execute('6Ld02ogaAAAAAP03F4C14NZiznr-ovI_pl9NUS2U', {action: 'contact'}).then(function (token) {
      var recaptchaResponse = document.getElementById('recaptchaResponse');
      recaptchaResponse.value = token;
    });
  });
</script>

<?php get_footer(); ?>
