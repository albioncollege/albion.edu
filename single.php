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
		<div class="main__inner right_sidebar">
			<div id="sidebar" class="sidebar sidebar--header">

				<?php 

				$related = get_related_programs( get_the_ID() );

				// if we have related page ids
				if ( !empty( $related ) ) {
					
					// query for all the related programs
					$related_query = new WP_Query( array( 
						'post_type' => 'page', 
						'post__in' => $related, 
						'post_parent' => 30
					));

					if ( $related_query->have_posts() ) {
						?>
				<div class="related-programs">
					<h4>Related Programs</h4>
						<?php
						
						while( $related_query->have_posts() ) : $related_query->the_post();
							?>
					<div class="program">
						<a href="<?php the_permalink(); ?>">
							<div class="program-image"><?php the_post_thumbnail(); ?></div>
							<div class="program-title"><h6><?php the_title(); ?></h6></div>
						</a>
					</div>
							<?php
						endwhile;
						wp_reset_postdata();

						?>
				</div>
						<?php
					}
				}


				// get the post category ids
				$category_ids = wp_get_post_categories( get_the_ID() );
				
				// if we have related page ids
				if ( !empty( $category_ids ) ) {
					
					// query for all the related programs
					$related_posts_query = new WP_Query( array( 
						'post_type' => 'post', 
						'cat_in' => $category_ids,
						'post__not_in' => array( get_the_ID() ),
						'posts_per_page' => 4
					));

					if ( $related_posts_query->have_posts() ) {
						?>
				<div class="related-posts">
					<h4>Related Posts</h4>
					<ul>
						<?php
						
						while( $related_posts_query->have_posts() ) : $related_posts_query->the_post();
							?>
					<li class="related-post">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
							<?php
						endwhile;
						wp_reset_postdata();

						?>
					</ul>
				</div>
						<?php
					}
				}


				?>
			</div>

			<div class="main__side">
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