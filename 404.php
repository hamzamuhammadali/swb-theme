<?php $globalPlattform = !empty(get_option('globalPlattform'));
if($globalPlattform) {
	get_header('global');
} else {
	get_header();
}
?>

<?php if($globalPlattform) :?>
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	<lottie-player src="https://assets9.lottiefiles.com/private_files/lf30_kcwpiswk.json"  background="transparent"  speed="0.3"  style="height: 70vh;"  loop autoplay></lottie-player>
<?php else : ?>
<div class="container">
  <div class="content content--basic">
      <main role="main" aria-label="Content">
        <!-- section -->
        <section>

          <!-- article -->
          <article id="post-404">

            <h1><?php esc_html_e( 'Page not found', 'html5blank' ); ?></h1>
            <h2>
              <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Return home?', 'html5blank' ); ?></a>
            </h2>

          </article>
          <!-- /article -->

        </section>
        <!-- /section -->
      </main>
  </div>
</div>
<?php endif;?>

<?php
if($globalPlattform) {
	get_footer('global');
} else {
	get_footer();
}
?>

