<?php
/**
Template Name: Single post
 */
get_header(); 


if( is_singular('post') ){ 

get_template_part( 'header', 'blog' ); 

?>

	<div id="primary" class="content-area inner single cf long-form-post">
		<div id="content" class="site-content post-wrap" role="main">
		<?php //echo themerex_get_custom_option('single_style'); ?>
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php 
				if ( is_singular() ) :
					get_template_part( 'content', get_post_format() ); 

				else :
					get_template_part( 'content', 'excerpt' ); 
				endif;

				?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<div id="tertiary" class="sidebar-container" role="complementary">
				<div class="sidebar-inner">
					<div class="widget-area">
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</div><!-- .widget-area -->
				</div><!-- .sidebar-inner -->
			</div><!-- #tertiary -->
		<?php endif; ?>
	</div><!-- #primary -->
<?php

}else{

	// OLD PARENT THEME TEMPLATE:

	if (empty($single_style)) $single_style = themerex_get_custom_option('single_style');

	while ( have_posts() ) { the_post();

		// Move themerex_set_post_views to the javascript - counter will work under cache system
		if (themerex_get_custom_option('use_ajax_views_counter')=='no') {
			themerex_set_post_views(get_the_ID());
		}

		themerex_show_post_layout(
			array(
				'layout' => $single_style,
				'sidebar' => !themerex_param_is_off(themerex_get_custom_option('show_sidebar_main')),
				'content' => themerex_get_template_property($single_style, 'need_content'),
				'terms_list' => themerex_get_template_property($single_style, 'need_terms')
			)
		);

	}

} //endif is single post

get_footer();
?>