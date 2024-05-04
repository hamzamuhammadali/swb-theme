<!-- footer -->
<footer>
  <div class="container">
    <div class="row offset-65">
      <div class="col-12 col-lg-4">
        <div class="footer__address">
            <?php echo do_shortcode('[googleinfo type="address"]'); ?>
        </div>

        <div class="footer__contact">
            <?php echo do_shortcode('[googleinfo type="contact"]'); ?>
        </div>

        <div class="footer__opening">
          <div class="row no-gutters">
            <div class="col-auto">
                <?php echo do_shortcode('[googleinfo type="hours"]'); ?>
            </div>
          </div>
        </div>

        <div class="footer__nav">
            <?php
            global $post;
            $thePostID = $post->ID;

            $getMenu = wp_get_nav_menu_items('footer'); // Where menu1 can be ID, slug or title

            foreach ($getMenu as $item) {
                echo '<a href="' . $item->url . '">' . $item->title . '</a>';
            }
            ?>
        </div>
      </div>
      <div class="col-12 col-lg-8">
        <div class="footer__map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10653.233493596563!2d11.4501051!3d48.1235762!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1ce7e150a6840f1c!2sSWB-Solar%20GmbH!5e0!3m2!1sde!2sde!4v1615914633018!5m2!1sde!2sde"
                  width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-lg-auto mr-lg-auto text-center-down-md">
          Copyright © 2021 SWB-Solar.de - Alle Rechte vorbehalten
          <div class="copyright__credits">Icons von <a href="https://www.freepik.com" title="Freepik">Freepik</a>
            auf <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        </div>
        <div class="col-12 col-lg-3 text-right">
          <div class="kookle">
            by <a href="https://www.kookie.digital" target="_blank" title="Kookle - Digital & Print"><img width="80"
                                                                                                     src="https://www.kookie.digital/src/img/logo-kookie-white.svg"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
<script defer src="/wp-content/themes/swb/min.js"></script>
</body>
</html>
