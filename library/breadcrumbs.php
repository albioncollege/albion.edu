<?php

function do_page_breadcrumbs() {

    $breadcrumbs = array( array(
        'title' => get_the_title(),
        'link' => get_the_permalink()
    ) );

    // get the homepage id, and set up 
    $home_id = get_option('page_on_front');
    $parent = wp_get_post_parent_id();

    if ( $parent != 0 ) {
        while ( $parent != 0 ) {

            // get the parent page
            $parent_page = get_page( $parent );
            
            // insert parent page into breadcrumbs array
            array_unshift( $breadcrumbs, array(
                'title' => $parent_page->post_title,
                'link' => get_permalink( $parent_page->ID )
            ) );

            // update parent id
            $parent = wp_get_post_parent_id( $parent_page->ID );
        }
    }

    // insert parent page into breadcrumbs array
    $home_crumb = array(
        'title' => 'Home',
        'link' => get_permalink( $home_id )
    );
    array_unshift( $breadcrumbs, $home_crumb );

    if ( is_archive() || is_home() ) {
        $breadcrumbs = array( $home_crumb );
        $breadcrumbs[] = array(
            'title' => 'News Archive',
            'link' => get_permalink( $home_id )
        );
    }

    // loop through and print out the breadcrumbs
    $crumb_count = count( $breadcrumbs );
    $crumb_id = 1;
    foreach ( $breadcrumbs as $crumb ) {
        if ( $crumb_id > 1 ) { print " &mdash; "; }
        if ( $crumb_id < $crumb_count ) { ?><a href="<?php print $crumb['link']; ?>"><?php }
        print $crumb['title'];
        if ( $crumb_id < $crumb_count ) { ?></a><?php }
        $crumb_id++;
    }
}

