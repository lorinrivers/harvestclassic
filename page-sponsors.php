<?php
/*
 *Template Name: Sponsors Template
 */

add_action('genesis_after_loop', 'lr_list_media');
add_action('genesis_after_loop', 'lr_list_platinum');
add_action('genesis_after_loop', 'lr_list_titanium');
add_action('genesis_after_loop', 'lr_list_gold');
add_action('genesis_after_loop', 'lr_list_silver');
add_action('genesis_after_loop', 'lr_list_friend');
remove_action('genesis_before_post_content', 'genesis_post_info');
remove_action('genesis_after_post_content', 'genesis_post_meta');


function lr_list_media(){
$media_args = array(
'post_type' => 'rally-sponsor',
'posts_per_page' => '-1',
'sponsorship' => 'media',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$media = new WP_Query($media_args);
$count = $media->post_count;
 ?>
<div id="media">
<h1>Media Sponsors</h1>
<?php while ($media->have_posts()): $media->the_post(); ?>
<?php $post_counter++; ?>
<div class="sponsor<?php if( $post_counter == $count ) echo ' last' ?>">
  <?php if(genesis_get_custom_field('lr_sponsor_image') !== '') { ?>
    <img alt="<?php echo get_the_title(); ?> Logo" src="<?php echo genesis_get_custom_field('lr_sponsor_image'); ?>">
  <?php } ?>
  <h2 id="rally-sponsor-<?php the_ID(); ?>">
  <?php if(genesis_get_custom_field('wp_rotator_url') == 'none') { ?>
    <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
  <?php } else { ?>
    <a href="<?php echo genesis_get_custom_field('wp_rotator_url'); ?>" rel="external" title="Permanent Link to <?php the_title(); ?>">
  <?php } ?>
  <?php the_title(); ?>
  </a></h2>
  <?php if(genesis_get_custom_field('lr_fame_checkbox') == true) { ?>
    <h3 class="fame">Hall of Famer!</h3>
  <?php } ?>
  <p>
  <?php the_content(); ?>
  </p>
</div> <!-- end .sponsor -->
<?php endwhile; ?>
</div><!-- end #media -->
<?php } ?>

<?php
function lr_list_platinum(){
$platinum_args = array(
'post_type' => 'rally-sponsor',
'posts_per_page' => '-1',
'sponsorship' => 'platinum',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$platinum = new WP_Query($platinum_args);
$count = $platinum->post_count;
?>
<div id="platinum">
<h1>Platinum Sponsors</h1>
<?php  while ($platinum->have_posts()): $platinum->the_post(); ?>
<?php $post_counter++; ?>
<div class="sponsor<?php if( $post_counter == $count ) echo ' last' ?>">
  <?php if(genesis_get_custom_field('lr_sponsor_image') !== '') { ?>
     <img alt="<?php echo get_the_title(); ?> Logo" src="<?php echo genesis_get_custom_field('lr_sponsor_image'); ?>">
  <?php } ?>
  <h2 id="rally-sponsor-<?php the_ID(); ?>">
  <?php if(genesis_get_custom_field('wp_rotator_url') == '') { ?>
    <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
  <?php } else { ?>
    <a href="<?php echo genesis_get_custom_field('wp_rotator_url'); ?>" rel="external" title="Permanent Link to <?php the_title(); ?>">
  <?php } ?>
  <?php the_title(); ?>
  </a></h2>
  <?php if(genesis_get_custom_field('lr_fame_checkbox') == true) { ?>
    <h3 class="fame">Hall of Famer!</h3>
  <?php } ?>
  <p>
  <?php the_content(); ?>
  </p>
</div> <!-- end .sponsor -->
<?php endwhile; ?>
</div><!-- end #platinum -->
<?php } ?>

<?php
function lr_list_titanium(){
$titanium_args = array(
'post_type' => 'rally-sponsor',
'posts_per_page' => '-1',
'sponsorship' => 'titanium',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$titanium = new WP_Query($titanium_args);?>
<div id="titanium">
<h2>Titanium Sponsors</h2>
<ul>
<?php  while ($titanium->have_posts()): $titanium->the_post(); ?>
  <li id="rally-sponsor-<?php the_ID(); ?>">
  <?php if(genesis_get_custom_field('wp_rotator_url') == 'none') { ?>
    <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
  <?php } else { ?>
    <a href="<?php echo genesis_get_custom_field('wp_rotator_url'); ?>" rel="external" title="Permanent Link to <?php the_title(); ?>">
  <?php } ?>
    <?php the_title(); ?></a>
  </li>

<?php endwhile; ?>
</ul>
</div><!-- end #titanium -->
<?php } ?>

<?php
function lr_list_gold(){
$gold_args = array(
'post_type' => 'rally-sponsor',
'posts_per_page' => '-1',
'sponsorship' => 'gold',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$gold = new WP_Query($gold_args);?>
<div id="gold">
<h3>Gold Sponsors</h3>
<ul>
<?php  while ($gold->have_posts()): $gold->the_post(); ?>
  <li id="rally-sponsor-<?php the_ID(); ?>">
  <?php if(genesis_get_custom_field('wp_rotator_url') == 'none') { ?>
    <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
  <?php } else { ?>
    <a href="<?php echo genesis_get_custom_field('wp_rotator_url'); ?>" rel="external" title="Permanent Link to <?php the_title(); ?>">
  <?php } ?>
    <?php the_title(); ?></a>
  </li>
<?php endwhile; ?>
</ul>
</div><!-- end #gold -->
<?php } ?>

<?php
function lr_list_silver(){
$silver_args = array(
'post_type' => 'rally-sponsor',
'posts_per_page' => '-1',
'sponsorship' => 'silver',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$silver = new WP_Query($silver_args);?>
<div id="silver">
<h4>Silver Sponsors</h4>
<ul>
<?php  while ($silver->have_posts()): $silver->the_post(); ?>
  <li id="rally-sponsor-<?php the_ID(); ?>">
    <?php the_title(); ?>
  </li>
<?php endwhile; ?>
</ul>
</div><!-- end #silver -->
<?php } ?>

<?php
function lr_list_friend(){
$friend_args = array(
'post_type' => 'rally-sponsor',
'posts_per_page' => '-1',
'sponsorship' => 'friend',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$friend = new WP_Query($friend_args);
$count = $friend->post_count;
?>
<?php $post_counter = 0; ?>
<div id="friend">
<h4>Friends of the Rally</h4>
<ul>
<?php  while ($friend->have_posts()): $friend->the_post(); ?>
<?php $post_counter++; ?>
<li id="rally-sponsor-<?php the_ID(); ?>"><?php the_title(); ?><?php if( $post_counter < $count ) echo ', ' ?></li>
<?php endwhile; ?>
</ul>
</div><!-- end #friend -->
<?php } ?>

<?php 
genesis();
?>
