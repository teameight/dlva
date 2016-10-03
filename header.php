<?php
/**
 * The Header for our theme.
 */

global $THEMEREX_GLOBALS;

// Theme init - don't remove next row! Load custom options
themerex_core_init_theme();

$theme_skin = themerex_esc(themerex_get_custom_option('theme_skin'));
$body_scheme = themerex_get_custom_option('body_scheme');
if (empty($body_scheme)  || themerex_is_inherit_option($body_scheme)) $body_scheme = 'original';
$blog_style = themerex_get_custom_option(is_singular() && !themerex_get_global('blog_streampage') ? 'single_style' : 'blog_style');
$body_style  = themerex_get_custom_option('body_style');
$article_style = themerex_get_custom_option('article_style');
$top_panel_style = themerex_get_custom_option('top_panel_style');
$top_panel_position = themerex_get_custom_option('top_panel_position');
$top_panel_scheme = themerex_get_custom_option('top_panel_scheme');
$video_bg_show  = themerex_get_custom_option('show_video_bg')=='yes' && (themerex_get_custom_option('video_bg_youtube_code')!='' || themerex_get_custom_option('video_bg_url')!='');
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo esc_attr('scheme_'.$body_scheme); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php
	if (themerex_get_theme_option('responsive_layouts') == 'yes') {
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php
	}
	if (floatval(get_bloginfo('version')) < "4.1") {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php

    if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {

        // Output old, custom favicon feature.
        $favicon = themerex_get_custom_option('favicon');
        if (!$favicon) {
            if ( file_exists(themerex_get_file_dir('skins/'.($theme_skin).'/images/favicon.ico')) )
                $favicon = themerex_get_file_url('skins/'.($theme_skin).'/images/favicon.ico');
            if ( !$favicon && file_exists(themerex_get_file_dir('favicon.ico')) )
                $favicon = themerex_get_file_url('favicon.ico');
        }
        if ($favicon) {
            ?>
            <link rel="icon" type="image/x-icon" href="<?php echo esc_url($favicon); ?>" />
        <?php
        }
    }


	wp_head();
	?>
</head>

<body <?php 
	body_class('themerex_body body_style_' . esc_attr($body_style) 
		. ' body_' . (themerex_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent')
		. ' theme_skin_' . esc_attr($theme_skin)
		. ' article_style_' . esc_attr($article_style)
		. ' layout_' . esc_attr($blog_style)
		. ' template_' . esc_attr(themerex_get_template_name($blog_style))
		. (!themerex_param_is_off($top_panel_position) ? ' top_panel_show top_panel_' . esc_attr($top_panel_position) : 'top_panel_hide')
		. ' ' . esc_attr(themerex_get_sidebar_class())
		. ($video_bg_show ? ' video_bg_show' : '')
	);
	?>
>
	<?php echo force_balance_tags(themerex_get_custom_option('gtm_code')); ?>

	<?php do_action( 'before' ); ?>

	<?php
	// Add TOC items 'Home' and "To top"
	if (themerex_get_custom_option('menu_toc_home')=='yes') echo themerex_do_shortcode( '[trx_anchor id="toc_home" title="'.__('Home', 'themerex').'" description="'.__('{{Return to Home}} - ||navigate to home page of the site', 'themerex').'" icon="icon-home" separator="yes" url="'.esc_url(home_url('/')).'"]' );
	if (themerex_get_custom_option('menu_toc_top')=='yes') echo themerex_do_shortcode( '[trx_anchor id="toc_top" title="'.__('To Top', 'themerex').'" description="'.__('{{Back to top}} - ||scroll to top of the page', 'themerex').'" icon="icon-double-up" separator="yes"]' ); 
	?>

	<?php if ( !themerex_param_is_off(themerex_get_custom_option('show_sidebar_outer')) ) { ?>
	<div class="outer_wrap">
	<?php } ?>

	<?php require_once( themerex_get_file_dir('sidebar_outer.php') ); ?>

	<?php
		$class = $style = '';
		if ($body_style=='boxed' || themerex_get_custom_option('bg_image_load')=='always') {
			$customizer = themerex_get_theme_option('show_theme_customizer') == 'yes';
			if ($customizer && ($img = (int) themerex_get_value_gpc('bg_image', 0)) > 0)
				$class = 'bg_image_'.($img);
			else if ($customizer && ($img = (int) themerex_get_value_gpc('bg_pattern', 0)) > 0)
				$class = 'bg_pattern_'.($img);
			else if ($customizer && ($img = themerex_get_value_gpc('bg_color', '')) != '')
				$style = 'background-color: '.($img).';';
			else if (themerex_get_custom_option('bg_custom')=='yes') {
				if (($img = themerex_get_custom_option('bg_image_custom')) != '')
					$style = 'background: url('.esc_url($img).') ' . str_replace('_', ' ', themerex_get_custom_option('bg_image_custom_position')) . ' no-repeat fixed;';
				else if (($img = themerex_get_custom_option('bg_pattern_custom')) != '')
					$style = 'background: url('.esc_url($img).') 0 0 repeat fixed;';
				else if (($img = themerex_get_custom_option('bg_image')) > 0)
					$class = 'bg_image_'.($img);
				else if (($img = themerex_get_custom_option('bg_pattern')) > 0)
					$class = 'bg_pattern_'.($img);
				if (($img = themerex_get_custom_option('bg_color')) != '')
					$style .= 'background-color: '.($img).';';
			}
		}
	?>

	<div class="body_wrap<?php echo ($class ? ' '.esc_attr($class) : ''); ?>"<?php echo ($style ? ' style="'.esc_attr($style).'"' : ''); ?>>

		<?php
		if ($video_bg_show) {
			$youtube = themerex_get_custom_option('video_bg_youtube_code');
			$video   = themerex_get_custom_option('video_bg_url');
			$overlay = themerex_get_custom_option('video_bg_overlay')=='yes';
			if (!empty($youtube)) {
				?>
				<div class="video_bg<?php echo ($overlay ? ' video_bg_overlay' : ''); ?>" data-youtube-code="<?php echo esc_attr($youtube); ?>"></div>
				<?php
			} else if (!empty($video)) {
				$info = pathinfo($video);
				$ext = !empty($info['extension']) ? $info['extension'] : 'src';
				?>
				<div class="video_bg<?php echo esc_attr($overlay) ? ' video_bg_overlay' : ''; ?>"><video class="video_bg_tag" width="1280" height="720" data-width="1280" data-height="720" data-ratio="16:9" preload="metadata" autoplay loop src="<?php echo esc_url($video); ?>"><source src="<?php echo esc_url($video); ?>" type="video/<?php echo esc_attr($ext); ?>"></source></video></div>
				<?php
			}
		}
		?>

		<div class="page_wrap">

			<?php
			// Top panel 'Above' or 'Over'
			if (in_array($top_panel_position, array('above', 'over'))) {
				themerex_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => $top_panel_scheme
					), false);
			}
			// Slider
			require_once( themerex_get_file_dir('templates/headers/_parts/slider.php') );
			// Top panel 'Below'
			if ($top_panel_position == 'below') {
				themerex_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => $top_panel_scheme
					), false);
			}

			// Top of page section: page title and breadcrumbs
			$show_title = themerex_get_custom_option('show_page_title')=='yes';
			$show_breadcrumbs = themerex_get_custom_option('show_breadcrumbs')=='yes';
			if ($show_title || $show_breadcrumbs) {
				?>
				<div class="top_panel_title top_panel_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo ($show_title ? ' title_present' : '') . ($show_breadcrumbs ? ' breadcrumbs_present' : ''); ?> scheme_<?php echo esc_attr($top_panel_scheme); ?>">
					<div class="top_panel_title_inner top_panel_inner_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo ($show_title ? ' title_present_inner' : '') . ($show_breadcrumbs ? ' breadcrumbs_present_inner' : ''); ?>">
						<div class="content_wrap">
							<?php if ($show_title) { ?>
								<h1 class="page_title"><?php echo strip_tags(themerex_get_blog_title()); ?></h1>
							<?php } ?>
							<?php if ($show_breadcrumbs) { ?>
								<div class="breadcrumbs">
									<?php if (!is_404()) themerex_show_breadcrumbs(); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php
			}
			?>

			<div class="page_content_wrap">

				<?php
				// Content and sidebar wrapper
				if ($body_style!='fullscreen') themerex_open_wrapper('<div class="content_wrap">');
				
				// Main content wrapper
				themerex_open_wrapper('<div class="content">');
				?>