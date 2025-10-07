<?php get_header(); ?>
<main class="page" id="main-content">
	<div class="hero">
		<div class="hero__container container--purple">
			<?php if ( in_category( 'today' ) ) : ?><nav class="breadcrumb" aria-label="Page Breadcrumb"><a href="/category/today">&laquo; Back to Albion Today</a></nav><?php endif; ?>
			<h1 class="hero__title"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="main">
		<div class="main__inner right_sidebar">

			<div class="main__side">
				<?php
				$lede = get_field('lede'); 
				if( $lede ) : ?>
					<p class="text-intro"><?php echo $lede; ?></p>
					<?php 
				endif; ?>
				<?php 
				$teaser = get_field('teaser'); 
				if( $teaser && in_category( 'today' ) ) :
					echo apply_filters( 'the_content', $teaser );
				endif; ?>
				<?php 
					$post_type = get_field( 'post_type' );
					?>
				<?php if(get_the_date('F j, Y') && ($post_type=='news' || $post_type=='announcement' || $post_type=='britons')) : ?>
		          <p class="post-date"><?php the_date('F j, Y'); ?></p>
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
				<?php if ( $post_type=='news' ) { ?>
				<div class="post-categories quiet">
					Posted <?php the_date(); ?> in <?php print get_the_category_list( ", ", "", get_the_ID() ); ?>.
				</div>
				<?php } ?>
			</div>


			<div id="sidebar" class="sidebar sidebar--header">

				<?php
				if ( in_category( 'today' ) ) :
					$event_start = get_field( 'event_start_time' );
					$event_end = get_field( 'event_end_time');
					$event_link = get_field( 'event_link' );
					if ( !empty( $event_start ) ) : ?>
					<div class="additional-info">
						<h4>More Details</h4>
						<p>Start Time: <?php print $event_start ?></p>
						<?php if ( !empty( $event_end ) ) : ?><p>End Time: <?php print $event_end ?></p><?php endif ?>
						<?php if ( !empty( $event_link ) ) : ?>
							<p>Click below to get more information about this event.</p>
							<p><a href="<?php print $event_link; ?>" class="button">Event Info &raquo;</a></p>
						<?php endif ?>
					</div>
					<?php endif;
				endif;
				
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
						'cat' => $category_ids,
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

				if ( has_nav_menu( 'action_news' ) && !in_category( 'today' ) ) { ?>
				<div class="related-posts">
					<h4>Connect With Us</h4>
					<?php
					wp_nav_menu([
						'theme_location' => 'action_news',
						'menu_class'     => 'subnav action-news',
						'li_class'       => '',
						'link_class'     => 'button--gold',
						'container'      => ''
					]);
					?>
				</div>
					<?php
				}

				?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>