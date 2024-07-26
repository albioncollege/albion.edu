
<?php
/**
 *  Archive template for the Class Notes Category custom taxonomy.
 *
 */

get_header();
$items_per_page      = get_field('items_per_page', 'option');
$terms    = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
$highlighted_content = get_field('highlighted_content', $terms);
$paged               = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

if ( is_tax( 'class_notes_category' ) ) {
  $title = single_term_title( '', false );
  $args = array(
    'post_type'      => 'class_notes', 
    'post_status'    => 'publish',
    'paged'          => $paged,
    'posts_per_page' => $items_per_page,
    'tax_query'      => array (
      array(
        'taxonomy' => 'class_notes_category',
        'field'    => 'term_id',
        'terms'    => $terms->term_id,

      ),
    ),
  );
}

$custom_tax_query = new WP_Query( $args ); ?>
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
      <div id="sidebar" class="sidebar sidebar--header">
      <?php
				if( is_single() || is_tax( 'class_notes_category' ) ){
					$single_note_terms = wp_get_post_terms( get_the_ID(), 'class_notes_category' );
					foreach ( $single_note_terms as $post_term ) {
						$note_term_name = $post_term->name;
					}
	
					$class_notes_terms = get_terms( array(
						'taxonomy'   => 'class_notes_category',
						'hide_empty' => false
					) );
		
					if ( ! empty( $class_notes_terms ) && ! is_wp_error( $class_notes_terms ) ){
						foreach ( $class_notes_terms as $term ) {
							$term_name = $term->name;
							$term_link = home_url('/class-notes-category/') . trailingslashit( $term->slug );
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							$term_link_paged = $term_link . 'page/' . trailingslashit( $paged );

							if ( ( $term_link === get_current_url() ) || ( $term_link_paged === get_current_url() ) || ( $term_name === $note_term_name ) ){
								$subnav .= '<li class="current_page_item"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
							}else{
								$subnav .= '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
							}
						}
					}  
				}else {
					$subnav = wp_list_pages([
					'child_of' => $root_id,
					'echo' => false,
					'depth' => 2,
					'title_li' => '',
					'exclude' => get_root_child_ids($root_id, $current_id),
					]);
				}
				?>
				<?php if ($subnav) : ?>
					<nav class="subnav has-submenu" aria-label="Side Navigation">
						<button class="subnav__toggle" aria-haspopup="true" aria-expanded="false">
							<?php esc_html_e( 'In this section', 'albion' ); ?>
						</button>
						<h2 class="subnav__heading">
							<?php esc_html_e( 'In this section', 'albion' ); ?>
						</h2>
						
						<ul class="subnav__list">
							<?php echo $subnav; ?>
						</ul>	
					</nav>
        <?php endif; ?>
      </div>
      <?php if ( $custom_tax_query->have_posts() ) : ?>
        <div class="main__side">
          <div class="news__wrapper">
            <?php if ( $highlighted_content ) : ?>
            <div class="news__block block--archive">
               <div class="news__content">
                 <?php echo $highlighted_content ?>
               </div>
            </div> 
            <?php endif; ?>
            <?php while ( $custom_tax_query->have_posts() ) : $custom_tax_query->the_post(); 
              $teaser = get_field( "teaser", get_the_id());
              $external_link = get_field( "external_link", get_the_id());
              ?>
              <div class="news__block block--archive">
                <div class="news__content">
                    <div class="news__link">
                        <a href="<?php echo ( $external_link ? $external_link : get_the_permalink() ); ?>">
                            <?php the_title(); ?>
                        </a>
                    </div>
                    <span><?php echo get_the_date(); ?></span>
                    <span class="teaser"><?php echo $teaser ?></span>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <nav id="pagination" role="navigation" aria-label="Pagination Navigation">
            <?php 
              the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Prev', 'albion' ),
                'next_text' => __( 'Next', 'albion' ),
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