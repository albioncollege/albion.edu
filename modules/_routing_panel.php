<?php
/**
 * Routing Panel Module
 * 
 * Module partial used to display a panel of information routing to other pages.
 *
 */

$background_color = get_sub_field('background_color');
$bg_color_class   = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';
$icon_select      = get_sub_field( 'icon' );
$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$intro_text       = get_sub_field( 'intro_text' );

if( have_rows('column_1_links') ) : ?>
    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
        <div class="container container--narrow">
            <div class="panel__headline__wrapper">
                <div class="grid grid--70-30">
                    <div class="panel__headline__details">
                        <?php if( $subheading ) : ?>
                            <?php if( $subheading_level == 'h2' ) : ?>
                                <h2 class="h3"><?php echo esc_html( $subheading ); ?></h2>
                            <?php elseif( $subheading_level == 'h3' ) : ?>
                                <h3 class="h3"><?php echo esc_html( $subheading ); ?></h3>
                            <?php elseif( $subheading_level == 'h4' ) : ?>
                                <h4 class="h3"><?php echo esc_html( $subheading ); ?></h4>
                            <?php elseif( $subheading_level == 'h5' ) : ?>
                                <h5 class="h3"><?php echo esc_html( $subheading ); ?></h5>
                            <?php elseif( $subheading_level == 'h6' ) : ?>
                                <h6 class="h3"><?php echo esc_html( $subheading ); ?></h6>
                            <?php else : ?>
                                <div class="h3"><?php echo esc_html( $subheading ); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ( $intro_text ) : ?>
                            <?php echo wp_kses_post( $intro_text ); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( $icon_select ) : ?>
                        <div class="panel__headline__right panel__headline__right--icon">
                            <div class="panel__headline__icon">
                                <?php echo svgstore( $icon_select, $icon_select, ''); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="grid grid--50">
                    <div>
                        <?php while( have_rows( 'column_1_links' ) ) : the_row();
                            $link = get_sub_field('link');
                            if( $link ) :
                                $link_url    = $link['url'];
                                $link_title  = $link['title']; ?>
                                <p>
                                    <a href="<?php echo esc_url( $link_url ); ?>" class="button__link" <?php echo link_target( $link ); ?>><?php echo esc_html( $link_title ); ?></a>
                                </p>
                            <?php endif; //link ?>
                        <?php endwhile; //column_1_links ?>
                    </div>
                    <?php if ( have_rows( 'column_2_links') ) : ?>
                        <div>
                            <?php while( have_rows( 'column_2_links' ) ) : the_row();
                                $link = get_sub_field('link');
                                if( $link ) :
                                    $link_url    = $link['url'];
                                    $link_title  = $link['title']; ?>
                                    <p>
                                        <a href="<?php echo esc_url( $link_url ); ?>" class="button__link" <?php echo link_target( $link ); ?>><?php echo esc_html( $link_title ); ?></a>
                                    </p>
                                <?php endif; //link ?>
                            <?php endwhile; //column_2_links ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; //column_1_links && column_2_links ?>