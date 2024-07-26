<?php
/**
 * Router Grid Module
 * 
 * Module partial used to display a grid of information routing out from the page.
 *
 */

$background_color = get_sub_field( 'background_color' );
$bg_color_class   = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';
$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$grid_layout     = get_sub_field( 'grid_layout' );
 
if( have_rows('grid_items') ) : ?>
    <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
        <div class="router">
            <div class="container">
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
            <?php if( $grid_layout == '3up' ): ?>
                <div class="grid grid--33-33-33">
            <?php elseif( $grid_layout == '4up' ): ?>
                <div class="grid grid--25-25-25-25">
            <?php endif; ?>
                    <?php while( have_rows('grid_items') ) : the_row();
                        $image      = get_sub_field( 'image' );
                        $image_size = 'routing';
                        $link       = get_sub_field( 'link' ); ?>
                        <div>
                            <?php if ( $link ) :  
                                    $link_url    = $link['url'];
                                    $link_title  = $link['title']; ?>
                            <a class="router__card__link" href="<?php echo esc_url( $link_url ); ?>">
                                <?php echo wp_get_attachment_image( $image, $image_size, "", array( "class" => "image--full" ) ); ?>
                                <p>
                                    <span class="button__link"><?php echo esc_html( $link_title ); ?></span>
                                </p>
                            </a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>