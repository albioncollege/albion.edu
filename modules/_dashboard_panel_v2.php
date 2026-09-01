<?php
/**
 * Dashboard Panel Module v2
 * 
 * Module partial used to display an admissions dashboard panel.
 *
 */

$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
?>
<div class="background background--purple dashboard-panel-v2">
    <div class="container">
        <div class="slider-wrapper">
			<?php if( $subheading ) : ?>
				<<?= $subheading_level ?>><?= esc_html( $subheading ); ?></<?= $subheading_level ?>>
			<?php endif; ?>
            <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "wrapAround": true, "autoPlay": true, "lazyLoad": true, "prevNextButtons": false }'>
                <?php while( have_rows( 'slides' ) ) : the_row();
					$subheading      = get_sub_field( 'subheading');
                    $image           = get_sub_field( 'image' );
					$text            = get_sub_field( 'text' );
                    $link            = get_sub_field( 'link' ); ?>
                    <div class="slide">
						<?php if( $image ) : 
							$image_url = $image['url'] ?>
							<div class="image">
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
							</div>
						<?php endif; ?>
                        <div class="card">
							<div class="text"><?php echo wp_kses_post( $text ); ?></div>
                            <?php if ( $link ) :
                                $link_url        = $link['url'];
                                $link_title      = $link['title']; ?>                                       
                                <div class="link">
                                    <a href="<?php echo esc_url( $link_url ); ?>" class="button__link"><?php echo esc_html( $link_title ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; //slides ?>
            </div>
        </div>
    </div>
</div>