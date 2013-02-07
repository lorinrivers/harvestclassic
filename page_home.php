<?php
/**
 *
 * Template Name: Home Cats
 * This file handles blog posts with the category Projects within a page.
 *
 */
 
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_do_cat_loop');

//    echo '<!-- custom_do_cat_loop -->';


function custom_do_cat_loop() {
    global $query_args;  // any wp_query() args
    echo '<!-- home cats -->';
    $args= array(
      'cat' => '115',
      'orderby' => 'menu_order',
      'order' => 'ASC'
    );
    genesis_custom_loop(wp_parse_args($query_args, $args));
}
 
genesis(); ?>
