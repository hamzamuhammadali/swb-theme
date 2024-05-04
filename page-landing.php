<?php
/*
 * Template Name: Themenseite
*/
?>

<?php get_header(); ?>

<section class="content">
  <div class="container-fluid container-fluid--nopadding mb-lg-5">
    <div class="row no-gutters">
      <div class="col-12 col-lg-6">
        <div class="teaser teaser--big"
             style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"></div>
      </div>
      <div class="col-12 col-lg-6 row no-gutters align-items-center pl-md-3 pl-lg-0 py-3 py-lg-4">
        <div class="col-12 col-md-12 col-lg-12 row no-gutters">
          <div class="col-12 col-md-12">
            <div class="teaser__tile teaser__tile--basic">
              <div class="teaser__pre">
                10 Gründe für
              </div>
              <div class="teaser__headline">
                <h1><?php the_title(); ?></h1>
              </div>
              <div class="teaser__text">
                <div class="step__counter step__counter--nomargin">
                  1
                </div>
                  <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="steps steps--nobg mb-5 mb-lg-0">
      <div class="row">
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-eigene-energie.jpg" alt="SWB-Solar Eigene Energie">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                2
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist der eigene Strom
                </div>
                <div class="step__text">
                  Machen Sie Ihren Strom selbst! Maximieren Sie Ihre Selbstversorgung mit eigenem Strom. So machen Sie
                  sich unabhängig von weiteren Strompreissteigerungen!
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-altersvorsorge.jpg" alt="SWB-Solar Altersvorsorge">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                3
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist eine wirksame Altersvorsorge
                </div>
                <div class="step__text">
                  Die Nebenkosten für Strom, Gas und Wasser steigen Jahr für Jahr. Mit Ihrer eigenen
                  Photovoltaik-Anlage produzieren Sie Ihren eigenen Strom. Werden Sie so unabhängig von
                  Strompreissteigerungen – gerade im Ruhestand und deckeln Sie so wirksam Ihre Nebenkosten im Alter.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-plus-ergie.jpg" alt="SWB-Solar Plus Energie">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                4
              </div>
              <div class="step__description">
                <div class="step__title">
                  Macht Ihr Haus zum Plusenergiehaus
                </div>
                <div class="step__text">
                  In vielen Fällen produzieren Hausbesitzer mit einer Photovoltaik-Anlage mehr Strom als sie
                  verbrauchen. So kann auch Ihr Haus zum Plusenergiehaus werden. Ein unschlagbares Verkaufsargument
                  für Ihre Immobilie in Zukunft.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-wertsteigerung.jpg" alt="SWB-Solar Wertsteigerung">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                5
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist wertsteigernd
                </div>
                <div class="step__text">
                  Durch eine eigene Photovoltaik-Anlage steigern Sie unabhängig der Energieeffizienz den Wert Ihrer
                  Immobilie.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-zukunftssicher.jpg" alt="SWB-Solar Zukunftssicher">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                6
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist unbegrenzt und zukunftssicher
                </div>
                <div class="step__text">
                  Sonnenenergie ist kostenlos und steht unbegrenzt zur Verfügung. Die Sonne schickt uns keine
                  Rechnung. Durch Sonnenenergie steht uns jede Sekunde 15.000-mal mehr Energie zur Verfügung als
                  zurzeit alle 7 Milliarden Menschen verbrauchen. Das entspricht einer Energieleistung von weit über
                  100 Millionen Atomkraftwerken pro Sekunde.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-investment.jpg" alt="SWB-Solar Investment">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                7
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist profitabel
                </div>
                <div class="step__text">
                  Dank des Eigenverbrauchs und des Erneuerbare-Energien-Gesetzes (EEG) sparen und verdienen Sie mit
                  Ihrer Photovoltaik-Anlage Geld – gesetzlich gesichert und geregelt für 20 Jahre. Zusätzlich bieten
                  sich attraktive Abschreibungsmöglichkeiten an.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-geldanlage.jpg" alt="SWB-Solar Geldanlage">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                8
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist die andere Form der Geldanlage
                </div>
                <div class="step__text">
                  Die Erträge Ihrer Photovoltaik-Anlage sind unabhängig von den Schwankungen der Kapitalmärkte. Mit
                  Solarstrom verdienen und sparen Sie Geld. Eine Photovoltaik-Anlage trägt sich von selbst – auch in
                  finanziellen Krisenzeiten.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="step">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-unkompliziert.jpg" alt="SWB-Solar unkompliziert">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                9
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist unkompliziert
                </div>
                <div class="step__text">
                  Denn Photovoltaik-Anlagen sind wartungsarm und haben kaum Verschleißteile.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="step mb-0">
            <div class="step__image">
              <img src="/wp-content/uploads/swb-solar-nachhaltigkeit.jpg" alt="SWB-Solar Nachhaltigkeit">
            </div>
            <div class="step__bottom">
              <div class="step__counter">
                10
              </div>
              <div class="step__description">
                <div class="step__title">
                  Ist umweltfreundlich und stoppt den Klimawandel
                </div>
                <div class="step__text">
                  Denn mit Ihrer Photovoltaik-Anlage produzieren Sie sauberen und umweltfreundlichen CO2-freien Strom.
                  Solarstrom ist emissionsfrei, geräuschlos, ressourcenschonend, erneuerbar und zu 100%
                  umweltverträglich.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
