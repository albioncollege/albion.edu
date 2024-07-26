<?php
/**
 * Feature Module
 * 
 * Module partial used to display features.
 *
 */

if( have_rows('features') ): ?>
    <div class="panel"> 
    <?php
    while ( have_rows('features') ) : the_row();
        $feature         = get_sub_field( 'feature' );
        $subheading      = get_field( 'subheading', $feature->ID );
        $subheading_link = get_field( 'subheading_link', $feature->ID );
        $feature_image   = get_field( 'image', $feature->ID );
        $image_size      = 'feature';
        $body            = get_field( 'body', $feature->ID );
        $feature_links   = get_field( 'links', $feature->ID );
        $media_type      = get_field( 'media_type', $feature->ID );
        $video           = get_field( 'video', $feature->ID, false );

        if ( $feature ) : ?>
            <?php if ( $feature_image ) : ?>
                <div class="panel__media">
                    <div class="panel__image">
                        <?php if ( 'video' === $media_type ) : ?>
                            <a class="panel__icon" href="<?php echo esc_url( $video ); ?>" data-minimodal="">
                                <?php echo svgstore('icon-play', 'Play', ''); ?>
                            </a>
                            <?php echo wp_get_attachment_image( $feature_image, $image_size ); ?>
                        <?php elseif ( $feature_image ): ?>
                            <?php echo wp_get_attachment_image( $feature_image, $image_size ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
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
       <?php     
        endif; //$feature 
    endwhile; ?>
    </div>
<?php endif; ?>
