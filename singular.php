<?php get_header(); ?>

<?php the_content(); ?>

<?php if ( post_password_required() ) :
  echo get_the_password_form();
elseif( ! post_password_required() ) : ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php while (have_rows('main_column_modules')) : the_row(); ?>
      <?php get_template_part('modules/_' . get_row_layout()); ?>
    <?php endwhile; ?>
  <?php endwhile; endif; wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>
