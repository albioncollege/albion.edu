<?php 
/**
 * Video Full Width Module
 * 
 * Module partial used to display full width video and caption.
 *
 */

$background_color = get_sub_field( 'background_color' );
$bg_color_class   = ( $background_color == 'gray' ) ? ' background--purple-gray' : '';
$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$video            = get_sub_field( 'video_url' );
$caption          = get_sub_field( 'caption' );

if ( $video ) : ?>
    <!-- Video Full Width Module. -->
    <div class="video-fw__component">
        <div class="background<?php echo esc_attr( $bg_color_class ); ?>">
            <div class="video-fw__wrapper container">
                <?php if( $subheading ) : ?>
                    <?php if( $subheading_level == 'h2' ) : ?>
                        <h2 class="h3"><?php echo esc_html( $subheading ); ?></h2>
                    <?php elseif( $subheading_level == 'h3' ) : ?>
                        <h3><?php echo esc_html( $subheading ); ?></h3>
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
                <div class="video">
                    <?php echo $video; ?>
                </div>
                <?php if ( $caption ) : ?>
                    <div class="video-fw__caption">
                        <?php echo esc_html( $caption ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>