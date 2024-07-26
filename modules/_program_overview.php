<?php
/**
 * Program Template Module: Overview
 * 
 * Module partial used to display the program overview.
 *
 */

$overview_h2    = get_field('overview_h2');
$overview_blurb = get_field('overview_blurb');

if ( $overview_h2 ) : ?>
    <h2><?php echo esc_html( $overview_h2 ); ?></h2>
<?php endif; ?>
<?php if ( $overview_blurb ) : ?>
    <?php echo wp_kses_post( $overview_blurb ); ?>
<?php endif; ?>