<?php
/*
Template Name: One Column
Template Post Type: page
*/

get_header();

?>
<main class="page" id="main-content">

	<?php get_template_part( 'modules/_hero.php' ); ?>

	<a name="main-content"></a>
	<div class="subnav__landing container">
		<?php if( have_rows( 'subnavigation_links' ) ) : ?>
			<nav class="subnav has-submenu" aria-label="Side Navigation">
				<button class="subnav__toggle" aria-haspopup="true" aria-expanded="false"><?php esc_html_e( 'In this section', 'albion' ); ?></button>
				<ul class="subnav__list">
				<?php
					while( have_rows('subnavigation_links') ) : the_row();
						$subnav_links = get_sub_field('links');
						if ( is_array( $subnav_links ) ) :
							$link_url     = $subnav_links['url'];
							$link_title   = $subnav_links['title'];
							?>
						<li><a href="<?php echo esc_url( $link_url ); ?>" <?php echo link_target( $subnav_links ); ?>><?php echo esc_html( $link_title ); ?></a></li>
							<?php 
						endif;
					endwhile;
					?>
				</ul>
			</nav>
		<?php endif; ?>
		<div class="subnav__extra">
			<?php if ( $link_to_spanish_content ) :
				$link_url   = $link_to_spanish_content['url'];
				$link_title = $link_to_spanish_content['title']; ?>
				<p><a href="<?php echo esc_url( $link_url ); ?>" class="button__link"><?php echo esc_attr( $link_title ); ?></a></p>
			<?php endif; ?>
			
			<?php
			$social_bar    = get_field( 'social_bar' );
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
					<a href="<?php echo esc_url( $facebook_url ); ?>" class="subnav__social__link">
						<?php echo svgstore('icon-facebook', 'Facebook', ''); ?>
					</a>
				<?php endif; ?>
				<?php if ( $twitter_url ) : ?>
					<a href="<?php echo esc_url( $twitter_url ); ?>" class="subnav__social__link">
						<?php echo svgstore('icon-twitter', 'Twitter', ''); ?>
					</a>
				<?php endif; ?>
				<?php if ( $instagram_url ) : ?>
					<a href="<?php echo esc_url( $instagram_url ); ?>" class="subnav__social__link">
						<?php echo svgstore('icon-instagram', 'Instagram', ''); ?>
					</a>
				<?php endif; ?>
				<?php if ( $youtube_url ) : ?>
					<a href="<?php echo esc_url( $youtube_url ); ?>" class="subnav__social__link">
						<?php echo svgstore('icon-youtube', 'YouTube', ''); ?>
					</a>
				<?php endif; ?>
				<?php if ( $linkedin_url ) : ?>
					<a href="<?php echo esc_url( $linkedin_url ); ?>" class="subnav__social__link">
						<?php echo svgstore('icon-linkedin', 'LinkedIn', ''); ?>
					</a>
				<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( post_password_required() ) :
		echo get_the_password_form();
	elseif( ! post_password_required() ) : ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php while (have_rows('modules')) : the_row(); ?>
				<?php $layout = get_row_layout(); ?>
				<?php if (in_array($layout, ['button', 'call_to_action_link', 'intro_text', 'table','subheading', 'snippet', 'quote'], true )) : ?>
					<div class="container container--extranarrow container--paragraph">
						<?php get_template_part('modules/_' . get_row_layout()); ?>
					</div>
				<?php elseif (in_array($layout, ['horizontal_rule','accordion','tabs'], true )) : ?>
					<div class="container container--extranarrow">
						<?php get_template_part('modules/_' . get_row_layout()); ?>
					</div>
				<?php else: ?>
					<?php get_template_part('modules/_' . get_row_layout()); ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endwhile; endif; wp_reset_postdata(); ?>
	<?php endif; ?>
</main>
<?php get_footer(); ?>