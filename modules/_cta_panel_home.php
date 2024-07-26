<?php
/**
 * CTA Panel Module
 * 
 * Module partial used to display a call to action panel.
 *
 */

$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$intro_text       = get_sub_field( 'intro_text' );
$heading_class    = (is_page_template( 'page--home.php' )) ? 'large-headline' : 'h3';
?>
<div class="background background--gold">
    <div class="container container--gold">
        <div class="panel__headline__wrapper">
            <div class="panel__headline__details">
                <?php if( $subheading ) : ?>
                    <h2 class="<?php echo $heading_class; ?>"><?php echo esc_html( $subheading ); ?></h2>
                <?php endif; ?>
                <?php if( $intro_text ) : ?>
                    <p class="text-intro"><?php echo strip( wp_kses_post( $intro_text ) ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php if( have_rows( 'cta_items' ) ) : ?>

            <div class="panel__cta__wrapper">
                <div class="grid grid--33-33-33">
                    <?php while( have_rows( 'cta_items' ) ) : the_row();
                        $icon     = get_sub_field( 'icon' );
                        $image    = get_sub_field( 'image' );
                        $cta_link = get_sub_field( 'link' ); ?>
                        <div>

                        <?php if( $image ) : 
                            $image_url     = wp_get_attachment_url( $image );
                            $image_style   = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"';
                        ?>
                            <?php if ( $cta_link ) : 
                                $link_url    = $cta_link['url'];
                                $link_title  = $cta_link['title']; ?>
                                <a href="<?php echo esc_url( $link_url ); ?>" class="button__link panel__cta__link" <?php echo link_target( $cta_link ); ?>>
                            <?php endif; ?>
                            <div class="panel__cta" <?php echo ( $image_style ); ?>>
                        <?php endif; ?>
                                <div class="panel__cta__overlay"></div>
                            <?php if ( $icon ) : ?>
                                <div class="panel__cta__icon">
                                    <span>
                                        <?php if ( strpos( $icon, '.svg' ) !== false ) {
                                            $icon = str_replace( site_url(), '', $icon);
                                            include(ABSPATH . $icon);
                                        } ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if ( $cta_link ) : ?>
                                <span class="button__link panel__cta__link"><?php echo esc_html( $link_title ); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ( $cta_link ) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>