<?php
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_do_cat_loop');

$categoryvariable = $cat;

function custom_do_cat_loop() {
    global $query_args;  // any wp_query() args

    $args= array(
      'cat' => $categoryvariable,
      'orderby' => 'menu_order',
      'order' => 'ASC'
    );
    genesis_custom_loop(wp_parse_args($query_args, $args));
    echo '<!-- the category is '.$cat.' -->';
}
 
genesis(); ?>
