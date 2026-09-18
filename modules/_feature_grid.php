<?php
/**
 * Feature Grid Module
 * 
 * Module partial used to display a grid of feature blocks.
 *
 */

$background_color = get_sub_field('background_color');
$bg_color_class   = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';
$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
if ( empty( $subheading_level ) ) $subheading_level = 'h3';
$intro_text       = get_sub_field( 'intro_text' );
$heading_class    = ( is_page_template( 'page--home.php' )) ? 'large-headline' : 'h3';


?>
<?php if( have_rows('blocks') ) : ?>
<div class="feature__component__v3">
    <div class="feature__grid__v3">
    <?php while( have_rows('blocks') ) : the_row();
        $index = get_row_index();
        $block_subheading       = get_sub_field( 'subheading' );
        $block_subheading_level = get_sub_field( 'subheading_level' );
        $block_subheading_link  = get_sub_field( 'subheading_link' );
        $block_image            = get_sub_field( 'image' );
        $block_image_size       = 'full'; 
        $block_blurb            = get_sub_field( 'blurb' );

        if ( $block_subheading ) : ?>
            <?php if( $block_image ) : ?>
            <div class="feature__card__v3 <?php print ( is_int( $index/2 ) ? 'even' : 'odd' ); print ( $index==1 ? ' visible' : '' ); ?>" style="background-image: url(<?php echo wp_get_attachment_image_url( $block_image, $block_image_size ); ?>);">
                <div class="box">
                    <?php if ( $block_subheading_link ) { echo '<a href="'.$block_subheading_link.'">'; } ?>
                    <?php if($block_subheading_level == 'h2'): ?>
                        <h2 class="h4 feature__card__title"><span><?php echo esc_html( $block_subheading ); ?></span></h2>
                    <?php elseif($block_subheading_level == 'h3'): ?>
                        <h3 class="h4 feature__card__title"><span><?php echo esc_html( $block_subheading ); ?></span></h3>
                    <?php elseif($block_subheading_level == 'h4'): ?>
                        <h4 class="h4 feature__card__title"><span><?php echo esc_html( $block_subheading ); ?></span></h4>
                    <?php elseif($block_subheading_level == 'h5'): ?>
                        <h5 class="h4 feature__card__title"><span><?php echo esc_html( $block_subheading ); ?></span></h5>
                    <?php elseif($block_subheading_level == 'h6'): ?>
                        <h6 class="h4 feature__card__title"><span><?php echo esc_html( $block_subheading ); ?></span></h6>
                    <?php else : ?>
                        <div class="h4 feature__card__title"><span><?php echo esc_html( $block_subheading ); ?></span></div>
                    <?php endif; ?>
                    <?php if ( $block_subheading_link ) { echo '</a>'; } ?>
                    <?php if ( $block_blurb ) : ?>
                        <div class="blurb"><?php echo wp_kses_post( $block_blurb ); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endwhile; //blocks ?>
    </div>
    <div class="feature__grid__controls">
        <div class="prev"></div>
        <div class="next"></div>
    </div>
</div>
<?php endif; ?>