<?php
/**
 * Call to Action Module
 * 
 * Module partial used to display call to action links.
 *
 */

if( have_rows('links') ): ?>
    <p>
    <?php while ( have_rows('links') ) : the_row();
        $cta_link = get_sub_field('link');
        if ($cta_link) : ?>
            <a href="<?php echo $cta_link['url']; ?>" class="button__link" <?php echo link_target( $cta_link ); ?>><?php echo $cta_link['title']; ?></a>
        <?php endif; ?>
    <?php endwhile;?>
    </p>
<?php endif; ?>