<?php

function custom_category_feed_description( $content ) {
    if ( is_feed() && is_category('today') ) {
        // Replace with your desired custom description
        return get_field( 'teaser' );
    }
    return $content;
}
add_filter('the_excerpt_rss', 'custom_category_feed_description');
add_filter('the_content_feed', 'custom_category_feed_description');
