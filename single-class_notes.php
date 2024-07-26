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
			<div class="main__side">
		        <p><?php the_date('F j, Y'); ?></p>
				<?php if ( post_password_required() ) :
					echo get_the_password_form();
				elseif( ! post_password_required() ) : ?>
					<?php $content = get_field('content'); ?>
                    <?php if( $content ) : ?>
                        <p class="text-intro"><?php echo $content; ?></p>
                    <?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>