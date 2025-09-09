
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


// exclude specific categories
$exclude_cats		 = get_field( 'exclude-cats', 'option' );
if ( !empty( $exclude_cats ) && !in_array( $current_cat_ID, $exclude_cats ) ) {
	$tax_query = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $exclude_cats,
            'operator' => 'NOT IN',
        ),
    );
}


// load the arguments array
$args = array(
	'post_type'      => 'post', 
	'post_status'    => 'publish',
	'paged'          => $paged,
	'posts_per_page' => $items_per_page,
	'tax_query'      => $tax_query,
);


// set some titles
if ( is_home() ) {
	$title = 'News';
}

if ( is_category() ) {
	$args[ 'cat' ] = $current_cat_ID;
	$title = single_cat_title( '', false );
}

if ( is_tag() ) {
	$args[ 'tag' ] = $current_tag_ID;
	$title = ucfirst( single_tag_title( '', false ) );
}

if ( is_tax() ) {
	$title = single_term_title( '', false );
}


// query the posts
$archive_query = new WP_Query( $args ); 

?>
<main class="page" id="main-content">
	<div class="hero">
		<div class="hero__container container--purple">
			<!-- REGION: Breadcrumb -->
				<?php get_template_part('modules/_breadcrumbs'); ?>
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
			<?php if ( $archive_query->have_posts() ) : ?>
			<div class="post-cards-container">
				<div class="post-cards-listing">
				<?php while ( $archive_query->have_posts() ) : $archive_query->the_post(); 
					$external_link = get_field( "external_link", get_the_id());
					$teaser = get_field( 'teaser' );
					?>
					<div class="post-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="thumbnail <?php echo ( $teaser ) ? 'teaser-present' : ''; ?>">
								<a href="<?php echo ( $external_link ? $external_link : get_the_permalink() ); ?>"><img src="<?php the_post_thumbnail_url( 'class-notes' ); ?>"/></a>
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
