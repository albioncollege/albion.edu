<?php
/**
 * Program Template Module: Additional Information
 * 
 * Module partial used to display the program's additional information.
 *
 */

$additional_info_background_color = get_field( 'additional_info_background_color' );
$bg_color_class                   = ( $additional_info_background_color == 'gray' ) ? ' background--purple-gray' : '';
$additional_info_h2               = get_field( 'additional_info_h2' );
$additional_intro_text            = get_field( 'additional_intro_text' );

if( have_rows('additional_info_column_1_links') && have_rows('additional_info_column_2_links') ) : ?>
    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
        <div class="container container--narrow">
            <div class="panel__headline__wrapper">
                <div class="grid grid--70-30">
                    <div class="panel__headline__details">
                        <?php if ( $additional_info_h2 ) : ?>
                            <h2 class="h3"><?php echo esc_html( $additional_info_h2 ); ?></h2>
                        <?php endif; ?>
                        <?php if ( $additional_intro_text ) : ?>
                            <?php echo wp_kses_post( $additional_intro_text ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="panel__headline__right panel__headline__right--icon">
                        <div class="panel__headline__icon">
                            <?php echo svgstore('icon-bubble', 'Bubble', ''); ?>
                        </div>
                    </div>
                </div>
                <div class="grid grid--50">
                    <div>
                        <?php while( have_rows('additional_info_column_1_links') ) : the_row();
                            $addtl_info_links_1  = get_sub_field('link');
                            if( $addtl_info_links_1 ): 
                                $link_url = $addtl_info_links_1['url'];
                                $link_title = $addtl_info_links_1['title'];
                        ?>
                                <p>
                                    <a href="<?php echo esc_url( $link_url ); ?>" class="button__link"><?php echo esc_html( $link_title ); ?></a>
                                </p>
                        <?php
                            endif; //$addtl_info_links_1
                        endwhile; ?>
                    </div>
                    <div>
                        <?php while( have_rows('additional_info_column_2_links') ) : the_row();
                            $addtl_info_links_2  = get_sub_field('link');
                            if( $addtl_info_links_2 ): 
                                $link_url = $addtl_info_links_2['url'];
                                $link_title = $addtl_info_links_2['title'];
                        ?>
                                <p>
                                    <a href="<?php echo esc_url( $link_url ); ?>" class="button__link"><?php echo esc_html( $link_title ); ?></a>
                                </p>
                        <?php
                            endif; //$addtl_info_links_2
                        endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>