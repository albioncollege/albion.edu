
<?php
/**
 * Generic archive template.
 *
 */

get_header();
$items_per_page      = get_field('items_per_page', 'option');
$post_types_terms    = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
$highlighted_content = get_field('highlighted_content', $post_types_terms);
$post_type           = get_field('post_type');
$paged               = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$current_cat_ID      = get_query_var('cat');
$current_tag_ID      = get_query_var('tag');
$tax_query			 = array();
$term = get_queried_object();


// set some titles
$title = $term->name;


?>
<main class="page" id="main-content">
	<div class="hero">
		<div class="hero__container container--purple">
			<!-- REGION: Breadcrumb -->
				<?php //get_template_part('modules/_breadcrumbs'); ?>
			<!-- /REGION: Breadcrumb -->
			<h1 class="hero__title"><?php echo esc_html( $title ); ?></h1>
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
			<?php if ( have_posts() ) : ?>
			<div class="post-cards-container">
				<div class="post-cards-listing">
				<?php while ( have_posts() ) : the_post(); 
					$external_link = get_field( "external_link", get_the_id());
					$teaser = get_field( 'teaser' );
					$photo_id = get_field( 'image' );
					?>
					<div class="post-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="thumbnail <?php echo ( $teaser ) ? 'teaser-present' : ''; ?>">
								<a href="<?php echo ( $external_link ? $external_link : get_the_permalink() ); ?>"><img src="<?php the_post_thumbnail_url( 'class-notes' ); ?>"/></a>
							</div>
						<?php elseif ( !empty( $photo_id ) ): ?>
							<div class="thumbnail">
								<a href="<?php echo ( $external_link ? $external_link : get_the_permalink() ); ?>"><?php print wp_get_attachment_image( $photo_id, 'full' ); ?></a>
							</div>
						<?php endif; ?>
						<div class="content">
							<div class="link">
								<a href="<?php echo ( $external_link ? $external_link : get_the_permalink() ); ?>"><?php the_title(); ?></a>
							</div>
							<div class="teaser">
								<?php if ( is_category( 'today' ) ) { print wp_trim_words( $teaser, 20 ) ; } ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
				<nav id="pagination" role="navigation" aria-label="Pagination Navigation">
				<?php 
					the_posts_pagination( array(
						'mid_size'  => 2,
						'prev_text' => __( '&laquo;', 'albion' ),
						'next_text' => __( '&raquo;', 'albion' ),
					) );
				?>
				</nav>
			</div>
			<?php else : ?>
				<div class="main__side">
					<div class="news__wrapper">
						 <?php if ( $highlighted_content ) { ?>
						<div class="news__block block--archive">
							 <div class="news__content">
								 <?php echo $highlighted_content ?>
							 </div>
						</div> 
						<?php } ?>
						<p><?php esc_html_e( 'No posts found.', 'albion' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
