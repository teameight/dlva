<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_header_1_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_header_1_theme_setup', 1 );
	function themerex_template_header_1_theme_setup() {
		themerex_add_template(array(
			'layout' => 'header_1',
			'mode'   => 'header',
			'title'  => __('Header 1', 'themerex'),
			'icon'   => themerex_get_file_url('templates/headers/images/1.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'themerex_template_header_1_output' ) ) {
	function themerex_template_header_1_output($post_options, $post_data) {
		global $THEMEREX_GLOBALS;

		// WP custom header
		$header_css = '';
		if ($post_options['position'] != 'over') {
			$header_image = get_header_image();
			$header_css = $header_image!='' 
				? ' style="background: url('.esc_url($header_image).') repeat center top"' 
				: '';
		}
		?>
		
		<div class="top_panel_fixed_wrap"></div>

		<header class="top_panel_wrap top_panel_style_1 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_<?php echo esc_attr(themerex_get_custom_option('top_panel_position')); ?>">
			
			<?php if (themerex_get_custom_option('show_top_panel_top')=='yes') { ?>
				<div class="top_panel_top">
					<div class="content_wrap clearfix">
						<?php
						$top_panel_top_components = array('contact_info', 'open_hours', 'login', 'socials', 'currency', 'bookmarks', 'phone');
						require_once( themerex_get_file_dir('templates/headers/_parts/top-panel-top.php') );
						?>
					</div>
				</div>
			<?php } ?>

			<div class="top_panel_middle" <?php echo ($header_css); ?>>
				<div class="content_wrap">
					<div class="columns_wrap columns_fluid">
						<div class="column-2_5 contact_logo">
							<?php require_once( themerex_get_file_dir('templates/headers/_parts/logo.php') ); ?>
						</div><div class="column-3_5 top_search_panel">

							<div class="headbutts">
								<?php wp_nav_menu( array( 'theme_location' => 'head_butt_rt' ) ); ?>
							</div>

                            <?php

                            if (themerex_get_theme_option('show_search') == 'yes') {

                                echo themerex_do_shortcode('[trx_search style="flat" open="fixed" title="'.__('Enter keyword', 'themerex').'"]');
                            }
                            ?>
                        </div>
                    </div>
				</div>
			</div>

			<div class="top_panel_bottom">
				<div class="content_wrap clearfix">
					<a href="#" class="menu_main_responsive_button icon-down"><?php _e('Select menu item', 'themerex'); ?></a>
					<nav role="navigation" class="menu_main_nav_area">
						<?php
						if (empty($THEMEREX_GLOBALS['menu_main'])) $THEMEREX_GLOBALS['menu_main'] = themerex_get_nav_menu('menu_main');
						if (empty($THEMEREX_GLOBALS['menu_main'])) $THEMEREX_GLOBALS['menu_main'] = themerex_get_nav_menu();
						echo ($THEMEREX_GLOBALS['menu_main']);
						?>
					</nav>
				</div>
			</div>

			</div>
		</header>

		<?php
	}
}
?>