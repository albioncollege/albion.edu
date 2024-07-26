<?php
/**
 * One Column Module: Accordion
 * 
 * Module partial used to display an accordion of content on the One Column template.
 *
 */

$subheading       = get_sub_field('subheading');
$subheading_level = get_sub_field('subheading_level');
$background_color = get_sub_field('background_color');
$bg_color_class   = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';

if ( have_rows('accordion_items') ) : ?>
  <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
    <div class="container">
      <?php if( $subheading ) : ?>
        <?php if( $subheading_level == 'h2' ) : ?>
          <h2 class="h3"><?php echo esc_html( $subheading ); ?></h2>
        <?php elseif( $subheading_level == 'h3' ) : ?>
          <h3><?php echo esc_html( $subheading ); ?></h3>
        <?php elseif( $subheading_level == 'h4' ) : ?>
          <h4 class="h3"><?php echo esc_html( $subheading ); ?></h4>
        <?php elseif( $subheading_level == 'h5' ) : ?>
          <h5 class="h3"><?php echo esc_html( $subheading ); ?></h5>
        <?php elseif( $subheading_level == 'h6' ) : ?>
          <h6 class="h3"><?php echo esc_html( $subheading ); ?></h6>
        <?php else : ?>
          <div class="h3"><?php echo esc_html( $subheading ); ?></div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="accordion">
        <?php while (have_rows('accordion_items')) : the_row(); 
          $heading_level = get_sub_field('heading_level');
          $heading       = get_sub_field('title');
          $content       = get_sub_field('content');
        ?>
          <?php if($heading): ?>
            <?php if($heading_level == 'h2'): ?>
              <h2 class="accordion__toggle">
                <?php echo esc_html( $heading ); ?>
                <?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?>
              </h2>
            <?php elseif($heading_level == 'h3'): ?>
              <h3 class="accordion__toggle">
                <?php echo esc_html( $heading ); ?>
                <?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?>
              </h3>
            <?php elseif($heading_level == 'h4'): ?>
              <h4 class="accordion__toggle">
                <?php echo esc_html( $heading ); ?>
                <?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?>
              </h4>
            <?php elseif($heading_level == 'h5'): ?>
              <h5 class="accordion__toggle">
                <?php echo esc_html( $heading ); ?>
                <?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?>
              </h5>
            <?php elseif($heading_level == 'h6'): ?>
              <h6 class="accordion__toggle">
                <?php echo esc_html( $heading ); ?>
                <?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?>
              </h6>
            <?php else : ?>
              <div class="accordion__toggle__title accordion__toggle">
                <?php echo esc_html( $heading ); ?>
                <?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <div class="accordion__content container--purple">
            <?php echo wp_kses_post( $content ); ?>
            <?php while (have_rows('accordion_links')) : the_row(); ?>
              <?php get_template_part('modules/_' . get_row_layout()); ?>
            <?php endwhile; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
