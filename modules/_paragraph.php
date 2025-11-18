<?php
/**
 * Paragraph Module
 * 
 * Module partial used to display a paragraph.
 *
 */

$background_color = get_sub_field('background_color'); ?>
<?php if ( 'gray' === $background_color ) : ?>
    <div class="background background--purple-gray">
        <div class="container container--extranarrow container--paragraph">
            <?php the_sub_field('content'); ?>
        </div>
    </div>
<?php elseif ( 'white' === $background_color ) : ?>
    <div class="background">
        <div class="container container--extranarrow container--paragraph">
            <?php the_sub_field('content'); ?>
        </div>
    </div>
<?php elseif ( 'none' === $background_color ) : ?>
    <div class="container container--extranarrow container--paragraph">
        <?php the_sub_field('content'); ?>
    </div>
<?php else : ?>
    <?php the_sub_field('content'); ?>
<?php endif; 

?>