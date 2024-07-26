<?php 
/**
 * Subheading Module
 * 
 * Module partial used to display subheadings with optional link
 *
 */

$subheading = get_sub_field( 'subheading_text' );
$level = get_sub_field( 'subheading_level' );
$link = get_sub_field( 'link' );
?>
<?php if ( $subheading ) : ?>
	<?php if($level == 'none'): ?>
      <p class="h3"><?php if ( $link ) { echo '<a href="'.$link.'">'; } ?><?php echo $subheading; ?><?php if ( $link ) { echo '</a>'; } ?></p>
      	
    <?php elseif($level == 'h2'): ?>
      <h2><?php if ( $link ) { echo '<a href="'.$link.'">'; } ?><?php echo $subheading; ?><?php if ( $link ) { echo '</a>'; } ?></h2>
    <?php elseif($level == 'h3'): ?>
      <h3><?php if ( $link ) { echo '<a href="'.$link.'">'; } ?><?php echo $subheading; ?><?php if ( $link ) { echo '</a>'; } ?></h3>
    <?php elseif($level == 'h4'): ?>
      <h4><?php if ( $link ) { echo '<a href="'.$link.'">'; } ?><?php echo $subheading; ?><?php if ( $link ) { echo '</a>'; } ?></h4>
    <?php elseif($level == 'h5'): ?>
      <h5><?php if ( $link ) { echo '<a href="'.$link.'">'; } ?><?php echo $subheading; ?><?php if ( $link ) { echo '</a>'; } ?></h5>
    <?php elseif($level == 'h6'): ?>
      <h6><?php if ( $link ) { echo '<a href="'.$link.'">'; } ?><?php echo $subheading; ?><?php if ( $link ) { echo '</a>'; } ?></h6>
    <?php else: ?>
      <div class="h3"><?php if ( $link ) { echo '<a href="'.$link.'">'; } ?><?php echo $subheading; ?><?php if ( $link ) { echo '</a>'; } ?></div>
    <?php endif; ?>
<?php endif; ?>