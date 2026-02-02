<?php


function albion_search_query( $query ) {
    if ( $query->is_search() && ! is_admin() ) {
        
        // take post type checkboxes into account
        //$query->set( 'post_type', ( isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : array( 'post', 'page', 'area', 'event', 'people' ) ) );

        // change number of results per page
        //$query->set( 'posts_per_page', 40 );
        
    }
    return $query;
}
add_filter( 'pre_get_posts', 'albion_search_query' );


// pagination
function paginate( $prev = '&laquo;', $next = '&raquo;' ) {
    global $wp_query, $wp_rewrite;

    $current = ( $wp_query->query_vars['paged'] > 1 ? $wp_query->query_vars['paged'] : 1 );

    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
	);

    // if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    print '<div class="paginate">' . paginate_links( $pagination ) . '</div>';
}


add_filter( 'relevanssi_excerpt_content', 'rlv_remove_pull_quotes' );
function rlv_remove_pull_quotes( $content ) {
    $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@";
    return preg_replace( $regex, '', $content );
}


