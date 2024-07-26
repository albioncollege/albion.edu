<?php

// get the current id
$current_id = get_queried_object_id();

// get the parent page id
$root_id = wp_get_post_parent_id($current_id);

// see if they want to hide the siblings (which will show the nav for the parent page and its siblings)
$hide_siblings = get_field('hide_siblings');

// we want the siblings hidden
if ( $hide_siblings ) {

	// get the children pages and make an array of ids
	$children = get_page_children( $current_id );
	$childids = array();
	if ( !empty( $children ) ) {
		foreach ( $children as $child ) {
			$childids[] = $child->ID;
		}

		// get the subnav items
		$subnav = wp_list_pages( array(
			'child_of' => $current_id,
			'echo' => false,
			'depth' => 2,
			'title_li' => '',
			'include'  =>  $current_id . ',' . implode( ',', $childids ),
		) );
	}

} else {

	// if this is a single post or a taxonomy
	if ( is_single() || is_tax( 'post_types' ) ) {

		// get all the terms for this post type, and loop through them
		$single_post_terms = wp_get_post_terms( get_the_ID(), 'post_types' );
		foreach ( $single_post_terms as $post_term ) {
			$post_term_name = $post_term->name;
		}

		// get the post types
		$post_types_terms = get_terms( array(
			'taxonomy'   => 'post_types',
			'hide_empty' => false
		) );

		// if we have terms
		if ( ! empty( $post_types_terms ) && ! is_wp_error( $post_types_terms ) ){
			foreach ( $post_types_terms as $term ) {
				$term_name = $term->name;
				$term_link = home_url('/') . trailingslashit( $term->slug );
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$term_link_paged = $term_link . 'page/' . trailingslashit( $paged );
				// var_dump($term->parent);
				// var_dump(get_term_children( $term->ID, 'post_types' ));


				if ( ( $term_link === get_current_url() ) || ( $term_link_paged === get_current_url() ) || ( $term_name === $post_term_name ) ){
					$subnav .= '<li class="current_page_item"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
				} else {
					$subnav .= '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
				}
			}
		}
	} else {

		// 
		$subnav = wp_list_pages( array(
			'child_of' => $root_id,
			'echo' => false,
			'depth' => 2,
			'title_li' => '',
			'exclude' => get_root_child_ids( $root_id, $current_id ),
		) );

	}
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