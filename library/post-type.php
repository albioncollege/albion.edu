<?php


// contact card cpt
function cpt_card() {

    register_post_type( 'contact_card', array (
        'public'   => true,
        'label'    => 'Contact Cards',
        'label_single'    => 'Contact Card',
        'supports' => ['title', 'editor'],
        'rewrite'  => ['slug' => 'bio', 'with_front' => false],  
        'menu_icon' => 'dashicons-admin-users'
    ) );

}
add_action('init', 'cpt_card');
  


// social bar cpt
function cpt_socialbar() {
    
    register_post_type( 'social_bar', array (
        'public'   => true,
        'label'    => 'Social Bar',
        'supports' => ['title', 'editor'],
        'rewrite'  => ['slug' => 'social_bar', 'with_front' => false],
        'menu_icon' => 'dashicons-format-status'
    ) );

}
add_action('init', 'cpt_socialbar');
  


// feature cpt
function cpt_feature() {

    register_post_type( 'feature', array (
        'public'   => true,
        'label'    => 'Feature',
        'supports' => ['title', 'editor'],
        'rewrite'  => ['slug' => 'feature', 'with_front' => false],
        'menu_icon' => 'dashicons-welcome-view-site'
    ) );

}
add_action('init', 'cpt_feature');
  


// quote cpt
function cpt_quote() {
    
    register_post_type('quote', array (
        'public'   => true,
        'label'    => 'Quote',
        'supports' => ['title', 'editor'],
        'rewrite'  => ['slug' => 'quote', 'with_front' => false],
        'menu_icon' => 'dashicons-format-quote'
    ) );

}
add_action('init', 'cpt_quote');
  


// snippet cpt
function cpt_snippet() {
    
    register_post_type('snippet', array (
        'public'   => true,
        'label'    => 'Snippet',
        'supports' => ['title', 'editor'],
        'rewrite'  => ['slug' => 'snippet', 'with_front' => false],
        'menu_icon' => 'dashicons-media-code'
    ) );
    
}
add_action('init', 'cpt_snippet');
  


/*
* Post Types Taxonomy
* A custom taxonomy for posts.
*/
function register_taxonomy_post_types() {
    $labels = array(
        'name'              => _x( 'Post Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Post Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Post Types' ),
        'all_items'         => __( 'All Post Types' ),
        'parent_item'       => __( 'Parent Post Type' ),
        'parent_item_colon' => __( 'Parent Post Type:' ),
        'edit_item'         => __( 'Edit Post Type' ),
        'update_item'       => __( 'Update Post Type' ),
        'add_new_item'      => __( 'Add New Post Type' ),
        'new_item_name'     => __( 'New Post Type Name' ),
        'menu_name'         => __( 'Post Types' ),
    );
    $args   = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        "rewrite" => array( 'slug' => 'post-types', 'with_front' => true, ),
    );
    register_taxonomy( 'post_types', [ 'post' ], $args );
}
add_action( 'init', 'register_taxonomy_post_types' );
  


add_action( 'init', function(){
    global $wp_rewrite;
    $wp_rewrite->use_verbose_page_rules = true;
}, 1 );
  


/*
* Custom Permalink for Posts and Post Types Taxonomy.
*
* @param $permalink string The post's permalink.
*
*/
function post_types_permalink( $permalink, $post, $leavename ) {
    if ( strpos( $permalink, '%post-types%' ) === FALSE ) return $permalink;
           
    $terms = wp_get_post_terms( get_the_ID(), 'post_types' );
    
    if ( !empty( $terms ) ) { 
        foreach ( $terms as $term ) {  
            if ( !is_wp_error( $term ) && !empty( $term ) ){
                $taxonomy_slug = $term->slug;
            } 
        }
    } else {
        $permalink = trailingslashit( home_url('post/' . $post->post_name ) );
        return $permalink;
    } 
    return str_replace('%post-types%', $taxonomy_slug, $permalink);
}
add_filter( 'post_link', 'post_types_permalink', 10, 3 );
  


/*
* Rewrite rules for Post Types custom taxonomy.
*
* @param $wp_retwrite array Used to rewrite rules in .htacess file.
*/
function custom_taxonomy_rewrite_rules( $wp_rewrite ) {
    $rules = array();
    $terms = get_terms( array(
        'taxonomy' => 'post_types',
        'hide_empty' => false,
    ) );
    
    foreach ($terms as $term) {    
        $rules[$term->slug . '/([^/]*)$'] = 'index.php?post_type=' . $term->taxonomy . '&name=$matches[1]';
        $rules[$term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
        $rules[$term->slug . '/page/?([0-9]{1,})/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&paged=$matches[1]';
    }

    $rules['^post/(.*)$'] = 'index.php?name=$matches[1]';

    // merge with global rules
    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'custom_taxonomy_rewrite_rules');



add_filter('gform_pre_render', 'populate_select_fields');
function populate_select_fields($form) {

    // get the list of class note categories for the field
    $terms = get_terms(array(
        'taxonomy' => 'note_category',
        'hide_empty' => false,
    ));

    // build an array for the field labels
    $choices = array();
    foreach ($terms as $term) {
        $choices[] = array(
            'text' => $term->name,
            'value' => $term->term_id,
        );
    }

    // find the field based on its CSS class (no need to target IDs)
    foreach ( $form['fields'] as &$field ) {
        if ($field->cssClass == 'class-notes-category' ) {
            // Update choices for the select field
            $field->choices = $choices;
            break;
        }
    }

    return $form;
}

add_filter('gform_pre_render', 'populate_year_select_fields');
function populate_year_select_fields($form) {

    // years dropdowns.
    $years = array();
    $yr = 2025;
    while ( $yr >= 1944 ) {
        $years[] = array(
            'text' => $yr,
            'value' => $yr,
        );
        $yr--;
    }

    // find the field based on its CSS class (no need to target IDs)
    foreach ( $form['fields'] as &$field ) {
        if ($field->cssClass == 'class-notes-year' ) {
            // Update choices for the select field
            $field->choices = $years;
            break;
        }
    }

    return $form;
}


