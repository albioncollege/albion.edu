<?php
/**
 * Table Module
 * 
 * Module partial used to display a table.
 *
 */

$table = get_sub_field( 'table' );

if( $table ): ?>
    <?php echo wp_kses_post( $table ); ?>
<?php endif; ?>
