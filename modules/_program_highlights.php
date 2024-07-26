<?php
/**
 * Program Template Module: Highlights
 * 
 * Module partial used to display the program attributes.
 *
 */

$highlights_background_color = get_field( 'highlights_background_color' );
$bg_color_class              = ( $highlights_background_color == 'gray' ) ? ' background--purple-gray' : '';
$highlights_h2               = get_field( 'highlights_h2' );
$highlights_intro_text       = get_field( 'highlights_intro_text' );

if( have_rows('highlights') ) : ?>
    <div class="feature__component">
        <div class="background<?php echo esc_attr( $bg_color_class ); ?>">  
            <div class="container container--narrow">
                <?php if ( $highlights_h2 ) : ?>
                    <h2 class="h3"><?php echo esc_html( $highlights_h2 ); ?></h2>
                <?php endif; ?>
                <?php if ( $highlights_intro_text ) : ?>
                    <?php echo wp_kses_post( $highlights_intro_text ); ?>
                <?php endif; ?>
                <div class="feature__grid">
                
                    <?php while( have_rows('highlights') ) : the_row();
                        $highlights_h3      = get_sub_field( 'highlights_highlights_h3' );
                        $highlights_h3_link = get_sub_field( 'highlights_highlights_link' );
                        $highlights_image   = get_sub_field( 'highlights_highlights_image' );
                        $image_size         = 'highlights';
                        $highlights_blurb   = get_sub_field( 'highlights_highlights_blurb' );

                        if ( $highlights_h3 ) : ?>
                        <div class="feature__card">
                            <h3 class="feature__card__title h4">
                            <?php if ( $highlights_h3_link ) : ?>
                                <a href="<?php echo esc_url( $highlights_h3_link ); ?>">
                            <?php endif; ?>
                                <?php echo esc_html( $highlights_h3 ); ?>
                            <?php if ( $highlights_h3_link ) : ?>
                                </a>
                            <?php endif; ?>
                            </h3>
                            <?php if ( $highlights_image ) : ?>
                                <?php echo wp_get_attachment_image( $highlights_image, $image_size ); ?>
                            <?php endif; ?>
                            <?php if ( $highlights_blurb ) : ?>
                                <div class="blurb"><?php echo wp_kses_post( $highlights_blurb ); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
