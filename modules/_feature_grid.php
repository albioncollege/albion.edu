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
$intro_text       = get_sub_field( 'intro_text' );
$heading_class    = (is_page_template( 'page--home.php' )) ? 'large-headline' : 'h3';

if( have_rows('blocks') ) : ?>
    <div class="feature__component">
        <div class="background<?php echo esc_attr( $bg_color_class ); ?>">  
            <div class="container container--narrow">
                <?php if( $subheading ) : ?>
                    <?php if( $subheading_level == 'h2' ) : ?>
                        <h2 class="<?php echo $heading_class; ?>"><?php echo esc_html( $subheading ); ?></h2>
                    <?php elseif( $subheading_level == 'h3' ) : ?>
                        <h3 class="<?php echo $heading_class; ?>"><?php echo esc_html( $subheading ); ?></h3>
                    <?php elseif( $subheading_level == 'h4' ) : ?>
                        <h4 class="<?php echo $heading_class; ?>"><?php echo esc_html( $subheading ); ?></h4>
                    <?php elseif( $subheading_level == 'h5' ) : ?>
                        <h5 class="<?php echo $heading_class; ?>"><?php echo esc_html( $subheading ); ?></h5>
                    <?php elseif( $subheading_level == 'h6' ) : ?>
                        <h6 class="<?php echo $heading_class; ?>"><?php echo esc_html( $subheading ); ?></h6>
                    <?php else : ?>
                        <div class="<?php echo $heading_class; ?>"><?php echo esc_html( $subheading ); ?></div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ( $intro_text ) : ?>
                    <?php echo wp_kses_post( $intro_text ); ?>
                <?php endif; ?>

                <div class="feature__grid">

                    <?php while( have_rows('blocks') ) : the_row();
                        $block_subheading       = get_sub_field( 'subheading' );
                        $block_subheading_level = get_sub_field( 'subheading_level' );
                        $block_subheading_link  = get_sub_field( 'subheading_link' );
                        $block_image            = get_sub_field( 'image' );
                        $block_image_size       = 'highlights'; 
                        $block_blurb            = get_sub_field( 'blurb' );

                        if ( $block_subheading ) : ?>
                            <div class="feature__card">
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
                                <?php if( $block_image ) : ?>
                                    <?php echo wp_get_attachment_image( $block_image, $block_image_size ); ?>
                                <?php endif; ?>
                                <?php if ( $block_subheading_link ) { echo '</a>'; } ?>
                                <?php if ( $block_blurb ) : ?>
                                    <div class="blurb"><?php echo wp_kses_post( $block_blurb ); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; //blocks ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>