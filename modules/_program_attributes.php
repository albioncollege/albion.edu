<?php
/**
 * Program Template Module: Attributes
 * 
 * Module partial used to display the program attributes.
 *
 */

$attributes_background_color = get_field( 'attributes_background_color' );
$bg_color_class              = ( $attributes_background_color == 'gray' ) ? ' background--purple-gray' : '';
$attributes_layout           = get_field( 'attributes_layout' );
$features_h2                 = get_field( 'features_h2' );
$features_intro_text         = get_field( 'features_intro_text') ;

if( have_rows('features') ) : ?>
    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
        <div class="container container--narrow">
            <div class="panel__headline__wrapper">
                <?php if ( $features_h2 || $features_intro_text ) : ?>
                    <div class="grid grid--70-30">
                        <div class="panel__headline__details">
                            <?php if ( $features_h2 ) : ?>
                                <h2 class="h3"><?php echo esc_html( $features_h2 ); ?></h2>
                            <?php endif; ?>
                            <?php if ( $features_intro_text ) : ?>
                                <?php echo wp_kses_post( $features_intro_text ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="panel__headline__right panel__headline__right--icon">
                            <div class="panel__headline__icon">
                                <?php echo svgstore('icon-certification', 'Certification', ''); ?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if ( '2up' === $attributes_layout ) : ?>
                    <div class="grid grid--50">
                <?php elseif ( '3up' === $attributes_layout ) : ?>
                    <div class="grid grid--33-33-33">
                <?php endif; ?>
                    <?php while( have_rows('features') ) : the_row();
                        $features_h3      = get_sub_field('features_features_h3');
                        $features_h3_link = get_sub_field('features_features_link');
                        $features_blurb   = get_sub_field('features_features_blurb'); 
                    ?>
                        <div>
                            <?php if ( $features_h3 ) : ?>
                                <h3 class="h4">
                                <?php if ( $features_h3_link ) : ?>
                                    <a href="<?php echo esc_url( $features_h3_link ); ?>">
                                <?php endif; ?>
                                    <?php echo esc_html( $features_h3 ); ?>
                                <?php if ( $features_h3_link ) : ?>
                                    </a>
                                <?php endif; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ( $features_blurb ) : ?>
                                <?php echo wp_kses_post( $features_blurb ); ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
