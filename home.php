<?php /* 
Template Name: New Home
*/ ?> 

<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">

	<?php genesis_before_content(); ?>
	<div id="content" class="hfeed">

		<div id="home-featured">
			<?php if (!dynamic_sidebar('Home Middle #1')) : ?>
			<!-- 
<div class="widget">
				<h4><?php _e("Home Middle #1 Widget", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Middle #1. It is using the Genesis - Featured Page widget to display what you see in your child theme. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Middle #1 widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your page. The Featured Page widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
			</div>
 -->
			<?php endif; ?>
		</div><!-- end #home-featured -->
 
		<div id="home-slideshow">
			<?php if (!dynamic_sidebar('Home Middle #2')) : ?>
			<!-- 
<div class="widget">
				<h4><?php _e("Home Middle #2 Widget", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Middle #2. It is using the Genesis - Featured Page widget to display what you see in your child theme. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Middle #2 widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your page. The Featured Page widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
			</div>
 -->
			<?php endif; ?>
		</div><!-- end #home-slideshow -->

	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>
