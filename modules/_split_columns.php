<?php 
/**
 * Split Column Module
 * 
 * Module partial used to display columns of modules/text in various ratios
 *
 */

$ratio = get_sub_field( 'split_ratio' );
$grid_class = '';
switch ($ratio) {
  case 'equal':
    $grid_class = ' grid--50';
    break;
  case 'wide_slim':
    $grid_class = ' grid--65-35';
    break;
  case 'slim_wide':
    $grid_class = ' grid--35-65';
    break;
  default:
    break;
}
$valign = get_sub_field( 'valign' );
$size = get_sub_field( 'size' );

?>
<div class="split-columns container<?php print ( $size == 'wide' ? '' : ' container--narrow' ) ?> v<?php print $valign ?>">
  <div class="grid<?php echo $grid_class; ?>">
    <div>
        <?php while ( have_rows( 'column_1' ) ) : the_row(); ?>
            <?php get_template_part( 'modules/_' . get_row_layout() ); ?>
        <?php endwhile; ?>
    </div>
    <div>
        <?php while ( have_rows( 'column_2' ) ) : the_row(); ?>
            <?php get_template_part( 'modules/_' . get_row_layout() ); ?>
        <?php endwhile; ?>
    </div>
  </div>
</div>
