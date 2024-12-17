<?php
/**
 * Footer Module
 * 
 * Module partial used to display content in the footer.
 *
 */

?>
<footer class="footer" id="footer">
    <div class="footer__container container--purple">
        <div class="footer__grid">
            <div>
                <?php echo wp_kses_post( get_field('mission_statement', 'options') ); ?>
            </div>
            <div>
                <?php
                    if ( has_nav_menu( 'action_footer' ) ) {
                        wp_nav_menu([
                            'theme_location' => 'action_footer',
                            'menu_class'     => 'footer__list footer__list--fullwidth',
                            'li_class'       => '',
                            'link_class'     => 'button',
                            'container'      => ''
                        ]);
                    }
                ?>
            </div>
        </div>
        <div class="footer__rule">
            <?php echo svgstore('logo-large', 'Albion', 'footer__logo'); ?>
        </div>
        <div class="footer__grid">
            <div>
            <?php $address = get_field( 'address', 'options' );
            if ( $address ) : ?>
                <p class="footer__location">
                    <?php echo wp_kses_post( strip( $address ) ); ?>
                </p>
            <?php endif; ?>
                <?php if( have_rows('social_links', 'options') ): ?>
                    <div class="footer__social">
                    <?php
                        while( have_rows('social_links', 'options') ) : the_row();
                            $social_link  = get_sub_field( 'link' );
                            if( $social_link ): 
                                $link_url    = $social_link['url'];
                                $link_title  = $social_link['title'];
                                $icon_title  = strtolower( $link_title );
                                if ( $link_title ) : ?>
                                    <a href="<?php echo esc_url( $link_url ); ?>" <?php echo link_target( $social_link ); ?> class="footer__social__link">
                                        <?php echo svgstore('icon-' . $icon_title, $link_title, ''); ?>
                                    </a>                                    
                                
                                <?php
                                // End Link Title if statement.
                                endif;
                            // End Social Link if statement.
                            endif;
                        // End loop.
                        endwhile;
                    echo '</div>';
                // End Social Buttons Row.
                endif; ?>
            </div>
            <div>
                <nav class="footer__nav" aria-label="Footer Navigation">
                <?php
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu([
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer__list',
                            'link_class'     => 'footer__link',
                            'li_class'       => '',
                            'container'      => ''
                        ]);
                    }
                ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="footer__bottom__wrapper">
        <div class="footer__bottom">
            <!-- <p class="footer__cr">
        © 2020 Albion College
      </p> -->
            <nav class="footer__bottom__group">
                <?php
                    if ( has_nav_menu( 'legal_footer' ) ) {
                        wp_nav_menu([
                            'theme_location' => 'legal_footer',
                            'menu_class'     => '',
                            'li_class'       => '',
                            'link_class'     => '',
                            'container'      => ''
                        ]);
                    }
                ?>
            </nav>
        </div>
    </div>
</footer>
<button class="scroll-top">    
    <?php echo svgstore('icon-pointer-top', 'Scroll back to top', ''); ?>
</button>