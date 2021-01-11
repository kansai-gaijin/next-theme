<?php get_header(); ?>
<?php
if (!is_front_page()) :
  do_action('theme/page/header');
endif;
?>
<section class="section">
  <div class="wrapper">
    <div class="content">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post() ?>
          <?php
          do_action('theme/page/content');
          ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>