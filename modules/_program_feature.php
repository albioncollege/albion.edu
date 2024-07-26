<?php 
/**
 * Program Template Module: Features
 * 
 * Module partial used to display features from the Feature custom post type.
 *
 */

$feature_background_color = get_field( 'feature_background_color' );
$bg_color_class           = ( $feature_background_color == 'gray' ) ? ' background--purple-gray' : '';
$feature_panel            = get_field( 'feature' );
$subheading               = get_field( 'subheading', $feature_panel->ID );
$subheading_link          = get_field( 'subheading_link', $feature_panel->ID );
$feature_image            = get_field( 'image', $feature_panel->ID );
$image_size               = 'feature';
$image_caption            = wp_get_attachment_caption( $feature_image );
$body                     = get_field( 'body', $feature_panel->ID );
$feature_links            = get_field( 'links', $feature_panel->ID );
$media_type               = get_field( 'media_type', $feature_panel->ID );
$video                    = get_field( 'video', $feature_panel->ID, false );

if ( $feature_panel ) : ?>
    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">  
        <div class="panel">
            <div class="container container--narrow">
                <div class="grid grid--50">
                    <div>
                        <?php if ( 'video' === $media_type ) : ?>
                            <div class="panel__image">
                                <a class="panel__icon" href="<?php echo esc_url( $video ); ?>" data-minimodal="">
                                    <?php echo svgstore('icon-play', 'Play', ''); ?>
                                </a>
                                <?php echo wp_get_attachment_image( $feature_image, $image_size ); ?>
                            </div>
                        <?php elseif ( $feature_image ): ?>
                            <div class="panel__image">

                                <?php echo wp_get_attachment_image( $feature_image, $image_size ); ?>
                                <?php if ( $image_caption ) : ?>
                                    <p class="caption"><?php echo esc_html( $image_caption ); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="panel__details">
                        <?php if( $subheading ) : ?>
                            <h4>
                                <?php if ( $subheading_link ) : ?>
                                    <a href="<?php echo esc_url( $subheading_link ); ?>">
                                <?php endif; ?>
                                <?php echo esc_html( $subheading ); ?>
                                <?php if ( $subheading_link ) : ?>
                                    </a>
                                <?php endif; ?>
                            </h4>
                        <?php endif; ?>
                        <?php if( $body ) : ?>
                            <?php echo wp_kses_post( $body ); ?>
                        <?php endif; ?>
                        <?php if ( $feature_links ) : 
                            foreach( $feature_links as $link ) :
                                $feature_link = $link['link'];
                                if ( $feature_link ) : ?>
                                    <a href="<?php echo esc_url( $feature_link['url'] ); ?>" class="button"><?php echo esc_html( $feature_link['title'] ); ?></a>
                        <?php
                                endif; //$feature_link
                            endforeach;
                        endif; //$feature_links
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; //$feature_panel ?>