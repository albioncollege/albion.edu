<?php
/**
 * Button Module
 * 
 * Module partial used to display buttons.
 *
 */

if( have_rows('links') ): ?>
    <p>
    <?php while( have_rows('links') ) : the_row();
        $button_link = get_sub_field('link');
        if( $button_link ) : ?>
            <a href="<?php echo $button_link['url']; ?>" class="button" <?php echo link_target( $button_link ); ?>><?php echo $button_link['title']; ?></a>
        <?php endif; ?>
    <?php endwhile; ?>
    </p>
<?php endif; ?>
