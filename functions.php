<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Harvest Classic Child Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/genesis' );

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Global removal of Genesis features **/
remove_action('genesis_before_post_content', 'genesis_post_info');
remove_action('genesis_after_post_content', 'genesis_post_meta');
remove_action('genesis_after_endwhile', 'genesis_posts_nav');

/** Move subnav to bottom **/
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_before_footer', 'genesis_do_subnav');


/** Make everything work with PostMash **/
function postMash_call() {
  global $wp_query;
  $wp_query->set('orderby', 'menu_order');
  $wp_query->set('order', 'ASC');
  $wp_query->get_posts();
//     get_posts('orderby=menu_order&order=ASC');
}

add_action('genesis_before_loop','postMash_call');

/** Use shortcodes in widgets **/
add_filter('widget_text', 'do_shortcode');

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Top Left',
	'description' => 'This is the top left section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Top Right',
	'description' => 'This is the top right section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle #1',
	'description' => 'This is the first column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle #2',
	'description' => 'This is the second column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle #3',
	'description' => 'This is the third column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle #4',
	'description' => 'This is the fourth middle widget of the middle section of the homepage to display just under the other 3 widgets',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

/** Add custom post type for Sponsors **/
// init Sponsorship Taxonomies
add_action( 'init', 'create_sponsor_taxonomies', 0 );

// Set up Sponsor
add_action('init', 'lr_create_sponsors_post_type');

add_action('init', 'lr_create_metaboxes');

function lr_create_sponsors_post_type() {
register_post_type('rally-sponsor', 
  array(
    'labels' => array(
    'name' => __('Rally Sponsors'),
    'singular_name' => __('Rally Sponsor')
  ),
    'public' => true,
    'supports' => array('title','editor','thumbnail','page-attributes','excerpt','custom-fields','genesis-seo', 'genesis-layouts'),
    'rewrite' => array('slug' => 'sponsors'),
    'has_archive' => false
  )
);
}

// create two taxonomies, Statuses and Platforms for the post type "sponsor"
function create_sponsor_taxonomies() {
  // Set up Status taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Sponsorships', 'taxonomy general name' ),
    'singular_name' => _x( 'Sponsorship', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Sponsorships' ),
    'popular_items' => __( 'Popular Sponsorships' ),
    'all_items' => __( 'All Sponsorships' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Sponsorship' ),
    'update_item' => __( 'Update Sponsorship' ),
    'add_new_item' => __( 'Add New Sponsorship' ),
    'new_item_name' => __( 'New Sponsorship Name' ),
    'separate_items_with_commas' => __( 'Separate Sponsorships with commas' ),
    'add_or_remove_items' => __( 'Add or remove Sponsorships' ),
    'choose_from_most_used' => __( 'Choose from the most used Sponsorships' )
  );
  // Create Sponsorship taxonomy
  register_taxonomy( 'sponsorship', 'rally-sponsor', array(
    'hierarchical' => false,
    'labels' => $labels, /* NOTICE: the $labels variable here */
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'sponsorship' ),
  ));

} // End of create_sponsor_taxonomies() function.



function lr_create_metaboxes() {
$prefix = 'lr_';
$meta_boxes = array();
$meta_boxes[] = array(
  'id' => 'sponsors',
  'title' => 'Sponsors',
  'pages' => array('rally-sponsor'), //post type
  'context' => 'normal',
  'priority' => 'high',
  'show_names' => true, //Show field names left of input
  'fields' => array(
    array( // populated by the contents of the Sponsorship Taxonomy
      'name' => 'Sponsorship Level',
      'desc' => 'sponsorship level',
      'id' => $prefix . 'sponsorship_taxonomy_select',
      'taxonomy' => 'sponsorship', //Enter Taxonomy Slug
      'type' => 'taxonomy_select',  
    ),
    array(
      'name' => 'Hall of Famer',
      'desc' => 'hall of famer',
      'id' => $prefix . 'fame_checkbox',
      'type' => 'checkbox'
    ),
    array(
      'name' => 'Sponsor Image',
      'desc' => 'Upload an image or enter an URL.',
      'id' => $prefix.'sponsor_image',
      'type' => 'file'
    ),
    array(
      'name' => 'wp_rotator_url',
      'desc' => 'What the rotator will click through to',
      'id' => 'wp_rotator_url',
      'type' => 'text'
    ),
    array(
      'name' => 'WP Rotator Show Info',
      'desc' => 'Should WP Rotator show title and description',
      'id' => 'wp_rotator_show_info',
      'type' => 'checkbox'
    ),
  ),
);
require_once( CHILD_DIR . '/lib/metabox/init.php' );
}

// Filter the request to just give posts for the given taxonomy, if applicable.
// This allows filtering by taxonomy in the custom post type admin page
function taxonomy_filter_restrict_manage_posts() {
    global $typenow;

    // If you only want this to work for your specific post type,
    // check for that $type here and then return.
    // This function, if unmodified, will add the dropdown for each
    // post type / taxonomy combination.

    $post_types = get_post_types( array( '_builtin' => false ) );

    if ( in_array( $typenow, $post_types ) ) {
    	$filters = get_object_taxonomies( $typenow );

        foreach ( $filters as $tax_slug ) {
            $tax_obj = get_taxonomy( $tax_slug );
            wp_dropdown_categories( array(
                'show_option_all' => __('Show All '.$tax_obj->label ),
                'taxonomy' 	  => $tax_slug,
                'name' 		  => $tax_obj->name,
                'orderby' 	  => 'name',
                'selected' 	  => $_GET[$tax_slug],
                'hierarchical' 	  => $tax_obj->hierarchical,
                'show_count' 	  => false,
                'hide_empty' 	  => true
            ) );
        }
    }
}

add_action( 'restrict_manage_posts', 'taxonomy_filter_restrict_manage_posts' );

function taxonomy_filter_post_type_request( $query ) {
  global $pagenow, $typenow;

  if ( 'edit.php' == $pagenow ) {
    $filters = get_object_taxonomies( $typenow );
    foreach ( $filters as $tax_slug ) {
      $var = &$query->query_vars[$tax_slug];
      if ( isset( $var ) ) {
        $term = get_term_by( 'id', $var, $tax_slug );
        $var = $term->slug;
      }
    }
  }
}

add_filter( 'parse_query', 'taxonomy_filter_post_type_request' );

add_action( 'wp_print_styles', 'child_add_pixie_style_sheet', 200 );
/**
 * Add a style sheet for any IE .
 *
 * @author Gary Jones
 * @link http://dev.studiopress.com/ie-conditional-style-sheets.htm
 */
function child_add_pixie_style_sheet() {
    wp_enqueue_style( 'pixie', CHILD_URL . '/iestyle.css', array(), '1.0' );
}
 
add_filter( 'style_loader_tag', 'child_make_pixie_style_sheet_conditional', 10, 2 );
/**
 * Add conditional comments around IE style sheet.
 *
 * @author Gary Jones & Michael Fields (@_mfields)
 * @link http://dev.studiopress.com/ie-conditional-style-sheets.htm
 *
 * @param string $tag Existing style sheet tag
 * @param string $handle Name of the enqueued style sheet
 * @return string Amended markup
 */
function child_make_pixie_style_sheet_conditional( $tag, $handle ) {
    if ( 'pixie' == $handle )
        $tag = '<!--[if IE]>' . "\n" . $tag . '<![endif]-->' . "\n";
    return $tag;
}

add_filter('genesis_nav_items', 'child_subnav_right', 10, 2);
add_filter('wp_nav_menu_items', 'child_subnav_right', 10, 2);
function child_subnav_right($menu, $args) {
    
    $args = (array)$args;
    
    if ( $args['theme_location'] != 'secondary' )
        return $menu;

        // I hate output buffering, but I have no choice
        ob_start();
        get_search_form();
        $search = ob_get_clean();
        
        $menu .= '<li class="right search">'.$search.'</li>';
    
    return $menu;
}  

/** add_filter( 'pre_get_posts', 'lr_archive_query' );
 * Archive Query
 *
 * Sets all archives to unlimited
 * @since 1.0.0
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 *
 * @param object $query
* function lr_archive_query( $query ) {
*	if( $query->is_main_query() && $query->is_category( 103 )) {
*		$query->set( 'posts_per_page', -1 );
*	}
*}
*/

/** add_action( 'pre_get_posts', 'be_change_event_posts_per_page' ); */
/**
 * Change Posts Per Page for Event Archive
 * 
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */
/** function be_change_event_posts_per_page( $query ) {

	if( $query->is_main_query() && !is_admin() && is_category( array( 103, 'activities', 'Activities' )  )   ){
		$query->set( 'posts_per_page', '-1' );
	}

}
*/