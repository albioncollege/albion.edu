<?php
/**
 * Program Template Module: Learning Objectives
 * 
 * Module partial used to display the program learning objectives.
 *
 */

$learning_h2         = get_field('learning_h2');
$learning_intro_text = get_field('learning_intro_text');

if ( $learning_h2 ) : ?>
    <h2><?php echo esc_html( $learning_h2 ); ?></h2>
<?php endif; ?>
<?php if ( $learning_intro_text ) : ?>
    <?php echo wp_kses_post( $learning_intro_text ); ?>
<?php endif; ?>


<?php
if( have_rows('objectives') ):
    while( have_rows('objectives') ) : the_row();
        $objective = get_sub_field('objective');
        if ( $objective ) : ?>
            <p><?php echo wp_kses_post( $objective ); ?></p>
<?php
        endif; 
    endwhile;
endif;

if( have_rows('learning_links') ):
    while ( have_rows('learning_links') ) : the_row(); ?>
        <div class="button-group">
<?php
        // Button layout.
        if( get_row_layout() == 'button' ):
            $style = get_sub_field('style');
            if( have_rows('links') ):
                while( have_rows('links') ) : the_row(); 
                    $button_link = get_sub_field('link'); 
                    if ( $button_link ) : ?>
                        <a href="<?php echo $button_link['url']; ?>" class="button"><?php echo $button_link['title']; ?></a>
<?php 
                    endif; 
                endwhile;
            endif;

        // Call to Action layout.
        elseif( get_row_layout() == 'call_to_action_link' ): 
            $links = get_sub_field('links');
            if( have_rows('links') ):
                while( have_rows('links') ) : the_row(); 
                    $cta_link = get_sub_field('link'); 
                    if ( $cta_link ) : ?>
                        <a href="<?php echo $cta_link['url']; ?>" class="button__link"><?php echo $cta_link['title']; ?></a>
<?php 
                    endif; 
                endwhile;
            endif;
        endif; ?>
    </div>
<?php
    endwhile;
endif;