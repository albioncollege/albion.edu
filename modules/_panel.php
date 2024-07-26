<?php
/**
 * Panel Module
 * 
 * Module partial used to display a panel of attributes.
 *
 */

$background_color = get_sub_field('background_color');
$icon_select      = get_sub_field( 'icon' );
$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$intro_text       = get_sub_field( 'intro_text' );
$panel_layout     = get_sub_field( 'panel_layout' );

if( have_rows('items') ) :?>
    <?php if ( 'gray' === $background_color ) : ?>
        <div class="background background--purple-gray">
    <?php elseif ( 'purple' === $background_color ) : ?>
        <div class="background background--purple">
    <?php elseif ( 'none' === $background_color ) : ?>
         <div class="background">
    <?php endif; ?> 
        <div class="container">
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
                                <div><?php echo esc_html( $subheading ); ?></div>
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
                <?php if( $panel_layout == '2up' ): ?>
                    <div class="contrainer container--extranarrow">
                        <div class="grid grid--50">
                <?php elseif( $panel_layout == '3up' ): ?>
                    <div class="grid grid--33-33-33">
                <?php endif; ?>
                <?php while( have_rows('items') ) : the_row();
                    $item_subheading       = get_sub_field('subheading');
                    $item_subheading_level = get_sub_field('subheading_level');
                    $item_subheading_link  = get_sub_field('subheading_link');
                    $item_blurb            = get_sub_field('blurb'); ?>
                    <div>
                        <?php if($item_subheading_level == 'h2'): ?>
                            <h2 class="h4"><?php if ( $item_subheading_link ) : ?>
                                    <a href="<?php echo esc_url( $item_subheading_link ); ?>"><?php echo esc_html( $item_subheading ); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html( $item_subheading ); ?>
                                <?php endif; ?>
                            </h2>
                        <?php elseif($item_subheading_level == 'h3'): ?>
                            <h3 class="h4"><?php if ( $item_subheading_link ) : ?>
                                    <a href="<?php echo esc_url( $item_subheading_link ); ?>"><?php echo esc_html( $item_subheading ); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html( $item_subheading ); ?>
                                <?php endif; ?></h3>
                        <?php elseif($item_subheading_level == 'h4'): ?>
                            <h4 class="h4"><?php if ( $item_subheading_link ) : ?>
                                    <a href="<?php echo esc_url( $item_subheading_link ); ?>"><?php echo esc_html( $item_subheading ); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html( $item_subheading ); ?>
                                <?php endif; ?></h4>
                        <?php elseif($item_subheading_level == 'h5'): ?>
                            <h5 class="h4"><?php if ( $item_subheading_link ) : ?>
                                    <a href="<?php echo esc_url( $item_subheading_link ); ?>"><?php echo esc_html( $item_subheading ); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html( $item_subheading ); ?>
                                <?php endif; ?></h5>
                        <?php elseif($item_subheading_level == 'h6'): ?>
                            <h6 class="h4"><?php if ( $item_subheading_link ) : ?>
                                    <a href="<?php echo esc_url( $item_subheading_link ); ?>"><?php echo esc_html( $item_subheading ); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html( $item_subheading ); ?>
                                <?php endif; ?></h6>
                        <?php else : ?>
                            <div class="h4"><?php if ( $item_subheading_link ) : ?>
                                    <a href="<?php echo esc_url( $item_subheading_link ); ?>"><?php echo esc_html( $item_subheading ); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html( $item_subheading ); ?>
                                <?php endif; ?></div>
                        <?php endif; ?>
                        <?php if ( $item_blurb ) : ?>
                            <?php echo wp_kses_post( $item_blurb ); ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
                <?php if( $panel_layout == '2up' ): ?>
                        </div>
                    </div>
                <?php elseif( $panel_layout == '3up' ): ?>
                    </div>
                <?php endif; ?>    
            </div>
        </div>
    </div>
<?php endif; ?>

