<?php


// include libraries
include( 'library/post-type.php' );
include( 'library/modules.php' );


// theme settings
function theme_settings() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_editor_style([get_theme_file_uri('/dist/css/styles.css')]);
	register_nav_menus([
		'primary'       => 'Primary',
		'tactical'      => 'Tactical',
		'audience'      => 'Audience',
		'action'        => 'Action',
		'footer'        => 'Footer',
		'action_footer' => 'Action Footer',
		'legal_footer'  => 'Legal Footer',
	]);
	add_image_size('1:1-200', 200, 200, true);
	add_image_size('explore-more', 146, 100, true);
	add_image_size('feature', 482, 321, true);
	add_image_size('quote', 482, 468, true);
	add_image_size('blockquote', 95, 95, true);
	add_image_size('news', 900, 600, true);
	add_image_size('routing', 687, 458, true);
	add_image_size('highlights', 420, 276, true);
	add_image_size('callout', 510, 389, true);
	add_image_size('image-grid', 400, 300, true);
	add_image_size('image-grid-modal', 1200, 800, true);
	if (function_exists('acf_add_options_page')) {
		acf_add_options_page([
			'page_title'  => 'Site Settings',
			'menu_title'  => 'Site Settings',
			'parent_slug' => 'options-general.php',
		]);
	}
}
add_action('after_setup_theme', 'theme_settings');


// theme css
function theme_css() {
	wp_dequeue_style('wp-block-library');
	wp_enqueue_style('theme-typekit-fonts', 'https://use.typekit.net/xdv3bwe.css', [], null, 'all');
	wp_enqueue_style('theme-styles', get_theme_file_uri('/dist/css/main.css'), [], null, 'screen');
}
add_action('wp_enqueue_scripts', 'theme_css');


// theme js
function theme_js() {
	wp_enqueue_script('theme-scripts', get_theme_file_uri('/dist/js/main.js'), [], null, true);
}
add_action('wp_enqueue_scripts', 'theme_js');


// only show acf menu item for local dev
function hide_acf_menu_item() {
	return !( strpos( get_bloginfo( 'url' ), 'jpederson' ) === false && strpos( get_bloginfo( 'url' ), 'dev' ) === false );
}
add_filter( 'acf/settings/show_admin', 'hide_acf_menu_item' );


add_filter('acf/settings/load_json', 'albion_acf_json_load_point');
function albion_acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset($paths[0]);
	// append path
	$paths[] = get_stylesheet_directory() . '/acf-json';
	// return
	return $paths;   
}


// Creating Password Protected Form
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
	$o .= '<p>' . __( "This content is password protected. To view it please enter the password below:" ) . '</p>';
	$o .= '<label class="" for="' . $label . '">' . __( "Password" ) . ' <span class="required">*</span></label><br>';
	$o .= '<input name="post_password" id="' . $label . '" type="password" size="20"><input class="button" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />';
	$o .= '</form>';
	return $o;
}
add_filter( 'the_password_form', 'custom_password_form' );


// add read_private_posts capability to subscriber
function add_sub_caps() {
	$subRole = get_role( 'subscriber' );
	$subRole->add_cap( 'read_private_posts' );
	$subRole->add_cap( 'read_private_pages' );
}
add_action ('init','add_sub_caps');


// Redirect Private Pages to Login
function redirect_private_page_to_login(){
	$queried_object = get_queried_object();
	if ( isset( $queried_object->post_status ) && 'private' === $queried_object->post_status && !is_user_logged_in() ) {
		wp_safe_redirect( wp_login_url( get_permalink( $queried_object->ID ) ) );
		exit;
	}
}
add_action( 'wp', 'redirect_private_page_to_login' );


// remove "Private: " and "Protected: " from private/protected page and post titles
function remove_private_protected_prefix( $title ) {
	$title = str_replace( 'Private: ', '', $title );
	$title = str_replace( 'Protected: ', '', $title );
	return $title;
}
add_filter( 'the_title', 'remove_private_protected_prefix' );


// get current url on any page, post or cpt across the site.
function get_current_url() {
		return home_url( $_SERVER['REQUEST_URI'] );
}


// Strip excess p tags from wysiwyg fields with special classes
function strip($var) {
	$allowed = '<div><span><br><h1><h2><h3><h4><h5><h6>
		<ul><ol><li><dl><dt><dd><strong><em><b><i><u>
		<img><a>';

	return strip_tags($var, $allowed);
}


// display custom mce formats
function custom_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'custom_mce_buttons_2');


// customize mce
function custom_mce_before_init($settings) {
	$settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre';
	$settings['style_formats'] = json_encode([
		[
			'title' => 'Subheadings',
				'items' => [
					[
						'title'    => 'Subheading 1',
						'selector' => 'h3',
						'classes'  => 'h1',
					],
					[
						'title'  => 'Subheading 2',
						'selector' => 'h3',
						'classes'  => 'h2',
					],
					[
						'title'    => 'Subheading 3',
						'selector' => 'h3',
						'classes'  => 'h3',
					],
					[
						'title'  => 'Subheading 4',
						'selector' => 'h3',
						'classes'  => 'h4',
					],
					[
						'title'    => 'Subheading 5',
						'selector' => 'h3',
						'classes'  => 'h5',
					],
					[
						'title'  => 'Subheading 6',
						'selector' => 'h3',
						'classes'  => 'h6',
					],
				]
		], 
		[
			'title'    => 'Large Text',
			'selector' => 'p',
			'classes'  => 'text-large',
		],
		[
			'title'    => 'Small Text',
			'selector' => 'p',
			'classes'  => 'text-small',
		],
		[
			'title'    => 'Caption',
			'selector' => 'p',
			'classes'  => 'caption',
		],
		[
			'title'    => '(Link) Button Underline',
			'selector' => 'a',
			'classes'  => 'button__link'
		],
		[
			'title'    => 'Button Square',
			'selector' => 'a',
			'classes'  => 'button'
		],
		[
			'title'    => 'Button Square Gold',
			'selector' => 'a',
			'classes'  => 'button button--gold'
		]
	]);
	return $settings;
}
add_filter('tiny_mce_before_init', 'custom_mce_before_init');


// disable tablepress css
add_filter('tablepress_use_default_css', '__return_false');


// turn off datatables on new tablepress tables
function tablepress_turn_off_datatables_new_tables($table) {
	$table['options']['use_datatables'] = false;
	return $table;
}
add_filter('tablepress_table_template', 'tablepress_turn_off_datatables_new_tables');


// add tablepress container elements
function tp_add_container($output, $table, $render_options) {
	$output = "<div class='table'><div class='table__scroll'>{$output}</div></div>";
	return $output;
}
add_filter('tablepress_table_output', 'tp_add_container', 10, 3);


// custom excerpt length
function custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);


// add link target if it exists
function link_target( $link ) {
	$target = $link['target'];
	return $target ? 'target="' . $target . '"' : '';
}


// custom link class
function add_menu_link_class( $atts, $item, $args ) {
	if (property_exists($args, 'link_class')) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );


// custom li class.
function wp_nav_menu_custom_li_class( $classes, $item, $args ) {
	if ( isset( $args->li_class ) ) {
			$classes[] = $args->li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'wp_nav_menu_custom_li_class', 1, 3);


// move yoast to the bottom of the menu
function move_yoast_to_bottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'move_yoast_to_bottom');



// FUNCTIONS

// inline svg function.
function svgstore( $svg, $title, $class ) {
	$output = '<span class="' . ($class ? $class : '') . ' svgstore svgstore--'.$svg.'">
		<svg>
			' . ($title ? '<title>' . $title . '</title>' : '' ) . '
			<use xlink:href="'.get_template_directory_uri().'/dist/img/svgstore.svg#'.$svg.'"></use>
		</svg>
	</span>';
	return $output;
}


// get post ids string
function get_post_ids_string($posts)
{
	$string = '';
	foreach ($posts as $post) {
		$string .= $post->ID . ',';
	}
	return $string;
}


// get root id
function get_root_id( $current ) {
	$parent = wp_get_post_parent_id($current);
	return $parent ? get_root_id($parent) : $current;
}


// get root child ids to exclude
function get_root_child_ids( $current, $active ) {
	$exclude = '';
	$children = get_children($current);
	if ($children) {
		foreach ($children as $child) {
			$child_id = $child->ID;
			if ($child_id != $active || get_field('subnav_hide_children', $child_id)) {
				$grandchildren = get_children($child_id);
				$exclude .= get_post_ids_string($grandchildren);
			}
			else {
				$exclude .= get_root_child_ids($child_id, $active);
			}
			if (get_field('exclude_page', $child_id)) {
				$exclude .= $child_id . ',';
			}
		}
	}
	return $exclude;
}


// allow xml uploads
function albion_upload_mimes( $existing_mimes ) {
		// Add xml to the list of mime types.
		$existing_mimes['xml'] = 'text/xml';
		// Return the array back to the function with our added mime type.
		return $existing_mimes;
}
add_filter( 'mime_types', 'albion_upload_mimes' );


// adjust the wysiwyg toolbars
add_filter( 'acf/fields/wysiwyg/toolbars' , 'albion_toolbars'  );
function albion_toolbars( $toolbars ) {
	// Uncomment to view format of $toolbars

	/*echo '< pre >';
		print_r($toolbars);
	echo '< /pre >';
	die;*/
	
	// Add a new toolbar called "Tablepress"
	// - this toolbar has only 1 row with 1 button
	$toolbars['Tablepress Toolbar' ] = array();
	$toolbars['Tablepress Toolbar' ][1] = array('tablepress_insert_table');

	// return $toolbars - IMPORTANT!
	return $toolbars;
}


// default page template title
add_filter('default_page_template_title', function() {
	return __('Default', 'albion');
});


// Filter out Events Columns
function remove_tribe_events_columns( $columns ) {
	unset(
		$columns['template'],
		$columns['comments'],
		$columns['wpseo-metadesc'],
		$columns['wpseo-focuskw'],
		$columns['wpseo-links'],
		$columns['wpseo-linked'],
		$columns['template'],
		// $columns['end-date'],
		// $columns['start-date'],
		// $columns['wpseo-title'],
		// $columns['wpseo-score-readability'],
		// $columns['wpseo-score']
	);
	return $columns;
}
add_filter( 'manage_edit-tribe_events_columns', 'remove_tribe_events_columns', 10, 1 );


// Dynamically populate select field with menu items when it has the name 'nav-menu'
// @link https://www.advancedcustomfields.com/resources/acf-load_field/
// @link https://www.advancedcustomfields.com/resources/dynamically-populate-a-select-fields-choices/
add_filter( 'acf/load_field/name=nav-menu', 'nav_menus_load' );
function nav_menus_load( $field ) {
	$menus = wp_get_nav_menus();
	$field['choices'][0] = '- no menu -';
	if ( ! empty( $menus ) ) {
		foreach ( $menus as $menu ) {
				$field['choices'][ $menu->slug ] = $menu->name;
		}
	}
	return $field;
}

