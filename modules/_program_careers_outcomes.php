<?php
/**
 * Program Template Module: Careers & Outcomes
 * 
 * Module partial used to display the program careers and outcomes.
 *
 */

$careers_background_color = get_field( 'careers_background_color' );
$bg_color_class           = ( $careers_background_color == 'gray' ) ? ' background--purple-gray' : '';
$careers_h2               = get_field( 'careers_h2' );
$careers_intro_text       = get_field( 'careers_intro_text' );
$list_1_h3                = get_field( 'list_1_h3' );
$list_2_h3                = get_field( 'list_2_h3' );

if( have_rows('list_1_items') || have_rows('list_2_items') ) : ?>
    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">  
        <div class="container container--narrow">
            <div class="panel__headline__wrapper">
                <div class="grid grid--70-30">
                    <div class="panel__headline__details">
                    <?php if ( $careers_h2 ) : ?>
                        <h2 class="h3"><?php echo esc_html( $careers_h2 ); ?></h2>
                    <?php endif; ?>
                    <?php if ( $careers_intro_text ) : ?>
                        <?php echo wp_kses_post( $careers_intro_text ); ?>
                    <?php endif; ?>
                    </div>
                    <div class="panel__headline__right panel__headline__right--icon">
                        <div class="panel__headline__icon">
                            <?php echo svgstore('icon-briefcase', 'Briefcase', ''); ?>
                        </div>
                    </div>
                </div>
                <div class="grid grid--50 grid--narrow">
                    <div>
                        <?php if ( $list_1_h3 ) : ?>
                            <h3 class="h4"><?php echo esc_html( $list_1_h3 ); ?></h3>
                        <?php endif; ?>
                        <ul>
                            <?php while( have_rows('list_1_items') ) : the_row(); ?>
                                <?php $list_1_item = get_sub_field('list_1_items_item'); ?>
                                <li><?php echo wp_kses_post( $list_1_item ); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <div>
                        <?php if ( $list_2_h3 ) : ?>
                            <h3 class="h4"><?php echo esc_html( $list_2_h3 ); ?></h3>
                        <?php endif; ?>
                        <ul>
                            <?php while( have_rows('list_2_items') ) : the_row(); ?>
                                <?php $list_2_item = get_sub_field('list_2_items_item'); ?>
                                <li><?php echo wp_kses_post( $list_2_item ); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>