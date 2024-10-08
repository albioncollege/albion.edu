<?php


// function to check if we have sidebar 'nav-menu' module
function has_sidebar_nav_module() {
    
    // see if we have a nav set for this page in the subnav metabox
    $subnav_menu = get_field( 'nav-menu' );
    if ( !empty( $subnav_menu ) ) {
        return true;
    }

    // false by default
    $has_nav_menu = false;

    if ( have_posts() ): 
        while ( have_posts() ): the_post(); 
            while ( have_rows('sidebar_column_modules') ): the_row();

            // if there's a nav menu, set it to true, otherwise don't do anything
            if ( get_row_layout() == 'nav_menu' ) $has_nav_menu = true; 

            endwhile; // layout loop
        endwhile; // post loop
    endif; // have posts

    // reset the post data
    wp_reset_postdata();
    
    // return it
    return $has_nav_menu;

}


// add a wysiwyg 'short' class
add_action('admin_head', 'acf_wysiwyg_short');
function acf_wysiwyg_short() {
	?>
	<style>
    .short .acf-editor-wrap iframe {			
        height: 170px !important;
    }
    .short .mce-statusbar {
        display: none;
    }
    .message-spaced {
        margin-top: 30px !important;
        padding-top: 10px !important;
        padding-bottom: 0 !important;
        border-bottom: 1px solid #bbb !important;
        font-size: 1.2em;
    }
	</style>
	<?php
}

