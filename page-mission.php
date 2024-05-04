<?php
/*
 * Template Name: Mission
*/
?>

<?php get_header(); ?>

<section class="content">
  <div class="container-fluid container-fluid--nopadding mb-5">
    <div class="row no-gutters">
      <div class="col-12 col-lg-6">
        <div class="teaser teaser--big"
             style="background-image:url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);"></div>
      </div>
      <div class="col-12 col-lg-6 row no-gutters align-items-center pl-lg-0 py-3 py-lg-4">
        <div class="col-12 col-md-12 col-lg-12 row no-gutters">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="teaser__tile teaser__tile--basic">
              <div class="teaser__pre">
                Unsere
              </div>
              <div class="teaser__headline">
                <h1><?php the_title();?></h1>
              </div>
              <div class="teaser__text">
                <?php the_content();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
