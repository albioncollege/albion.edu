<?php
$hero_image              = get_field( 'hero_image' );
$routing_link            = get_field( 'routing_link' );
$background_video        = get_field( 'background_video' );
$link_to_spanish_content = get_field( 'link_to_spanish_content' );
if( $hero_image ) : 
	$image_url   = wp_get_attachment_url( $hero_image );
	$image_style = 'style="background-image: url( ' . esc_url( $image_url ) . ' );"';
?>
		<div class="splash splash--landing" <?php echo $image_style; ?>>
			<?php if ( $background_video ) : ?>
				<button class="splash__control" aria-label="Toggle Video"></button>
				<div class="splash__video">
					<video muted="" loop="" autoplay="" playsinline="">
						<source src="<?php echo esc_url( $background_video['url'] ); ?>" type="<?php echo esc_attr( $background_video['mime_type'] ); ?>" />
					</video>
				</div>
			<?php endif; ?>
			<div class="splash__content container--purple">
				<!-- REGION: Breadcrumb -->
				<?php get_template_part('modules/_breadcrumbs'); ?>
				<!-- /REGION: Breadcrumb -->
				<h1 class="splash__content__headlines"><?php the_title(); ?></h1>
				<?php 
				if ( $routing_link ) :
					$link_url   = $routing_link['url'];
					$link_title = $routing_link['title'];
				?>
					<div class="hero__link">
						<a href="<?php echo esc_url( $link_url ); ?>" class="button__link"><?php echo esc_attr( $link_title ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
<?php endif; ?>
