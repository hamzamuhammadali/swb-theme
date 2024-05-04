<?php get_header(); ?>
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
<?php get_footer(); ?>
