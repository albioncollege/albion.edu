<?php
  /*
    
    Template Post Type: page
  */
?>

<?php get_header(); ?>
<main class="page" id="main-content">
	<div class="hero">
		<div class="hero__container container--purple">
	    <!-- REGION: Breadcrumb -->
	      <?php get_template_part('modules/_breadcrumbs'); ?>
	    <!-- /REGION: Breadcrumb -->
			<h1 class="hero__title"><?php the_title(); ?></h1>
			<?php $routing_link = get_field('routing_link');
	        if( $routing_link ) : ?>
		        <div class="hero__link">
		            <a href="<?php echo $routing_link['url']; ?>" class="button__link"><?php echo $routing_link['title']; ?></a>
				</div>
	        <?php endif; ?>
		</div>
	</div>
	<div class="main">
		<div class="main__inner">
			<div class="main__side">
				<?php if ( post_password_required() ) :
					echo get_the_password_form();
				elseif( ! post_password_required() ) : ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php while (have_rows('main_column_modules')) : the_row(); ?>
							<?php get_template_part('modules/_' . get_row_layout()); ?>
						<?php endwhile; ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
			<!-- REGION: Sidebar Navigation -->
			<div id="sidebar" class="sidebar sidebar--header">
			    <!-- whatever goes into this container will go to the top at mobile -->
			    <?php get_template_part('modules/_subnav'); ?>
				<div class="subnav__extra desktop-only">
				    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php while (have_rows('sidebar_column_modules')) : the_row(); ?>
							<?php get_template_part('modules/_' . get_row_layout()); ?>
						<?php endwhile; ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>
			<!-- whatever goes into this container will go to the bottom at mobile -->
			<div class="sidebar mobile-only">
				<div class="subnav__extra">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php while (have_rows('sidebar_column_modules')) : the_row(); ?>
							<?php get_template_part('modules/_' . get_row_layout()); ?>
						<?php endwhile; ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>
			<!-- /REGION: Sidebar Navigation -->
		</div>
	</div>
</main>
<?php get_footer(); ?>