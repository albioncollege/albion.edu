<?php
/**
 * Image Grid Module
 * 
 * Module partial used to display a grid of images.
 *
 */


$background_color = get_sub_field('background_color');
$bg_color_class   = ($background_color == 'gray') ? ' background--purple-gray' : '';
$subheading       = get_sub_field('subheading');
$subheading_level = get_sub_field('subheading_level');
$routing_link     = get_sub_field( 'routing_link' );
$image_grid       = get_sub_field('image_grid');
$image_size       = 'image-grid';
$image_modal_size = 'image-grid-modal';

if( $image_grid ): ?>

    <!-- Image Grid Module. -->
    <div class="image-grid__component">
        <div class="background<?php echo esc_attr($bg_color_class); ?>">
            <div class="container">
                <div class="image-grid__header">
                    <?php if ( $subheading ) : ?>
                        <?php if ( $subheading_level == 'h2' ) : ?>
                            <h2 class="h3"><?php echo esc_html($subheading) ; ?></h2>
                        <?php elseif ( $subheading_level == 'h3' ) : ?>
                            <h3><?php echo esc_html( $subheading ); ?></h3>
                        <?php elseif ( $subheading_level == 'h4' ) : ?>
                            <h4 class="h3"><?php echo esc_html( $subheading ); ?></h4>
                        <?php elseif ( $subheading_level == 'h5' ) : ?>
                            <h5 class="h3"><?php echo esc_html( $subheading ); ?></h5>
                        <?php elseif ( $subheading_level == 'h6' ) : ?>
                            <h6 class="h3"><?php echo esc_html( $subheading ); ?></h6>
                        <?php else : ?>
                            <div class="h3"><?php echo esc_html( $subheading ); ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    if ( $routing_link ) :
                        $link_url   = $routing_link['url'];
                        $link_title = $routing_link['title'];
                    ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" class="button__link" <?php echo link_target( $routing_link ); ?>><?php echo esc_attr( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="grid grid--25-25-25-25">
                    <?php foreach( $image_grid as $image ): ?>
                        <div class="image-grid__media">
                            <a href="<?php echo wp_get_attachment_image_url( $image, $image_modal_size, '' ); ?>" data-minimodal>
                                <div class="overlay"></div>
                                <?php echo wp_get_attachment_image( $image, $image_size, '', array( "class" => "img-fluid" ) ); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>