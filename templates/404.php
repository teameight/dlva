<?php
/*
 * The template for displaying "Page 404"
*/

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_404_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_404_theme_setup', 1 );
	function themerex_template_404_theme_setup() {
		themerex_add_template(array(
			'layout' => '404',
			'mode'   => 'internal',
			'title'  => 'Page 404',
			'theme_options' => array(
				'article_style' => 'stretch'
			),
			'w'		 => null,
			'h'		 => null
			));
	}
}

// Template output
if ( !function_exists( 'themerex_template_404_output' ) ) {
	function themerex_template_404_output() {
		?>
        <article class="post_item post_item_404">
            <div class="post_content">
                <?php echo do_shortcode('[vc_row][vc_column width="1/1"][trx_columns count="2" top="5.45em" bottom="4.1em" fluid="" animation="none"][trx_column_item align="none" color="" bg_color="" bg_image="" id="" class="" animation="none" css="padding-left: 1.2em;"][trx_title bottom="0.1em" type="3" style="regular" border_bottom="no" border_bottom_position="center" align="none" font_weight="inherit" icon="inherit" image="none" image_size="small" position="top" animation="none"]Sorry![/trx_title][trx_title type="3" style="regular" border_bottom="no" border_bottom_position="center" align="none" font_weight="inherit" icon="inherit" image="none" image_size="small" position="top" animation="none" bottom="1.25em"]The requested page cannot be found.[/trx_title][vc_column_text]Can\'t find what you need? Take a moment and do a search below or<br> start from our homepage.[/vc_column_text][trx_search top="3.4em" style="regular" state="fixed" title="Search" ajax="" animation="none"][/trx_column_item][/trx_columns][/vc_column][/vc_row]');?>
            </div>
        </article>
		<?php
	}
}
?>