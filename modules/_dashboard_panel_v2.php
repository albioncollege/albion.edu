<?php
/**
 * Dashboard Panel Module v2
 * 
 * Module partial used to display an admissions dashboard panel.
 *
 */

$subheading       = get_sub_field( 'subheading' );
$subheading_level = get_sub_field( 'subheading_level' );
$index            = 0
?>
<div class="background background--dark-gray dashboard-panel-v2">
    <div class="container">
        <div class="slider-wrapper">
			<?php if( $subheading ) : ?>
				<<?= $subheading_level ?>><?= esc_html( $subheading ); ?></<?= $subheading_level ?>>
			<?php endif; ?>
            <div class="main-carousel" data-flickity='{ "cellAlign": "center", "contain": true, "wrapAround": true, "autoPlay": true, "lazyLoad": true, "prevNextButtons": false, "wrapAround": true }'>
                <?php while( have_rows( 'slides' ) ) : the_row(); $image = get_sub_field( 'image' );?>
                    <div class="slide">
						<?php if( $image ) : 
							$image_url = $image['url'] ?>
							<div class="image">
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
							</div>
						<?php endif; ?>
                    </div>
                <?php endwhile; //slides ?>
            </div>
        </div>
		<div class="wrapper">
			<?php while( have_rows( 'slides' ) ) : the_row();
				$subheading      = get_sub_field( 'subheading');
				$text            = get_sub_field( 'text' );
				$link            = get_sub_field( 'link' ); ?>
				<div class="card background--white <?php if ( $index == 0 ) : ?>active<?php endif; ?>">
					<h3><?php echo wp_kses_post( $subheading ); ?></h3>
					<div class="text"><?php echo wp_kses_post( $text ); ?></div>
					<?php if ( $link ) :
						$link_url        = $link['url'];
						$link_title      = $link['title']; ?>                                       
						<div class="button">
							<a href="<?php echo esc_url( $link_url ); ?>" class="button__link"><?php echo esc_html( $link_title ); ?></a>
						</div>
					<?php endif; ?>
				</div>
				<?php ++$index; ?>
			<?php endwhile; //slides ?>
		</div>
    </div>
</div>