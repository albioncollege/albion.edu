<?php 
/**
 * Program Template Module: Image
 * 
 * Module partial used to display image related to the program.
 *
 */

$program_image = get_field('image');
$size  = 'full';
if( $program_image ) : ?>
    <figure class="program__image">
        <?php echo wp_get_attachment_image( $program_image, $size ); ?>
    </figure>
<?php endif; ?>