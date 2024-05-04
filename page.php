<?php get_header(); ?>

<section class="content content--basic">
  <div class="container">
    <div class="row">
      <div class="col-xl-8">
      <h1><?php the_title(); ?></h1>
        <?php if (have_posts()) :
          while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php edit_post_link(); ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
