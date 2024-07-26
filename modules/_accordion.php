 <div class="accordion">
  <?php while (have_rows('accordion')) : the_row(); ?>
    <?php $heading_level = get_sub_field('heading_level'); ?>
    <?php $heading = get_sub_field('title'); ?>
    <?php if($heading): ?>
      <?php if($heading_level == 'h2'): ?>
        <h2 class="accordion__toggle" tabindex="0" role="button" aria-pressed="false"><?php echo $heading; ?><?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?></h2>
      <?php elseif($heading_level == 'h3'): ?>
        <h3 class="accordion__toggle" tabindex="0" role="button" aria-pressed="false"><?php echo $heading; ?><?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?></h3>
      <?php elseif($heading_level == 'h4'): ?>
        <h4 class="accordion__toggle" tabindex="0" role="button" aria-pressed="false"><?php echo $heading; ?><?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?></h4>
      <?php elseif($heading_level == 'h5'): ?>
        <h5 class="accordion__toggle" tabindex="0" role="button" aria-pressed="false"><?php echo $heading; ?><?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?></h5>
      <?php elseif($heading_level == 'h6'): ?>
        <h6 class="accordion__toggle" tabindex="0" role="button" aria-pressed="false"><?php echo $heading; ?><?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?></h6>
      <?php else : ?>
        <div  class="accordion__toggle" tabindex="0" role="button" aria-pressed="false"><?php echo $heading; ?><?php echo svgstore('icon-arrow-down', 'Toggle Accordion', 'accordion__icon') ?></div>
      <?php endif; ?>
    <?php endif; ?>
    <div class="accordion__content container--purple">
      <?php the_sub_field('content'); ?>
      <?php while (have_rows('accordion_links')) : the_row(); ?>
          <?php get_template_part('modules/_' . get_row_layout()); ?>
      <?php endwhile; ?>
        
    </div>
  <?php endwhile; ?>
</div>
