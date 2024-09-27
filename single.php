<?php get_header(); ?>
<main class="page" id="main-content">
	<div class="hero">
		<div class="hero__container container--purple">
	    <!-- REGION: Breadcrumb -->
	      <?php get_template_part('modules/_breadcrumbs'); ?>
	    <!-- /REGION: Breadcrumb -->
			<h1 class="hero__title"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="main">
		<div class="main__inner">
			<!--
			<div id="sidebar" class="sidebar sidebar--header">
			    <?php get_template_part('modules/_subnav'); ?>
			    <div class="subnav__extra">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php while (have_rows('sidebar_column_modules')) : the_row(); ?>
							<?php get_template_part('modules/_' . get_row_layout()); ?>
						<?php endwhile; ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>
			-->
			<div class="container container--extranarrow container--paragraph">
				<?php $lede = get_field('lede'); ?>
				<?php if( $lede ) : ?>
					<p class="text-intro"><?php echo $lede; ?></p>
				<?php endif; ?>
				<?php 
					$post_type = get_field( 'post_type' );
					?>
				<?php if(get_the_date('F j, Y') && ($post_type=='news' || $post_type=='announcement' || $post_type=='britons')) : ?>
		          <p><?php the_date('F j, Y'); ?></p>
		        <?php endif; ?>
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
		</div>
	</div>
</main>
<?php get_footer(); ?>