<?php
/**
 * Social Bar Module
 * 
 * Module partial used to display social links in sidebar.
 *
 */


    $social_bar    = get_sub_field( 'social_bar' );
    $text          = get_field( 'text', $social_bar->ID );
    $facebook_url  = get_field( 'facebook_url', $social_bar->ID );
    $twitter_url   = get_field( 'twitter_url', $social_bar->ID );
    $instagram_url = get_field( 'instagram_url', $social_bar->ID );
    $youtube_url   = get_field( 'youtube_url', $social_bar->ID );
    $linkedin_url  = get_field( 'linkedin_url', $social_bar->ID );
    if ( $social_bar ) : ?>
        <div class="subnav__social">
        <?php if ( $text ) : ?>
            <div class="subnav__social__title">
                <?php echo esc_html( $text ); ?>
            </div>
        <?php endif; ?>
        <?php if ( $facebook_url ) : ?>
            <a href="<?php echo esc_url( $facebook_url ); ?>" class="subnav__social__link" target="_blank">
                <?php echo svgstore('icon-facebook', 'Facebook', ''); ?>
            </a>
        <?php endif; ?>
        <?php if ( $twitter_url ) : ?>
            <a href="<?php echo esc_url( $twitter_url ); ?>" class="subnav__social__link" target="_blank">
                <?php echo svgstore('icon-twitter', 'Twitter', ''); ?>
            </a>
        <?php endif; ?>
        <?php if ( $instagram_url ) : ?>
            <a href="<?php echo esc_url( $instagram_url ); ?>" class="subnav__social__link" target="_blank">
                <?php echo svgstore('icon-instagram', 'Instagram', ''); ?>
            </a>
        <?php endif; ?>
        <?php if ( $youtube_url ) : ?>
            <a href="<?php echo esc_url( $youtube_url ); ?>" class="subnav__social__link" target="_blank">
                <?php echo svgstore('icon-youtube', 'YouTube', ''); ?>
            </a>
        <?php endif; ?>
        <?php if ( $linkedin_url ) : ?>
            <a href="<?php echo esc_url( $linkedin_url ); ?>" class="subnav__social__link" target="_blank">
                <?php echo svgstore('icon-linkedin', 'LinkedIn', ''); ?>
            </a>
        <?php endif; ?>
        </div>
    <?php endif; ?>