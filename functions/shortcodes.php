<?php
/**
 * Children Theme shortcode functions and definitions.
 *
 * @package WordPress
 * @subpackage Children_Theme
 * @since Children Theme 1.0
 */

add_filter('widget_text', 'do_shortcode');


function t8_column($atts, $content = null){
 
   return 
   		'<div class="t8-col">'.
   
   		do_shortcode($content) .

   		'</div>';

}
add_shortcode( 't8-column', 't8_column' );

function t8_columns($atts, $content = null){
   extract(shortcode_atts(array(
      'count' => 2,
   ), $atts));
 
   return 
   		'<div class="t8-cols-wrap cols-'.$count.' cf">'.
   
   		do_shortcode($content) .

   		'</div>';

}
add_shortcode( 't8-columns', 't8_columns' );

function t8_button($atts, $content = null){
   extract(shortcode_atts(array(
      'style' => 'green',
      'link' => '#',
      'target' => '_self',
   ), $atts));
 
   return 
   		'<a class="'.$style.' button" target="'. $target .'" href="'. $link .'">'.
   
   		do_shortcode($content) .

   		'</a>';

}
add_shortcode( 'button', 't8_button' );

function wpex_clean_shortcodes($content){   
$array = array (
    '<p>[' => '[', 
    ']</p>' => ']', 
    ']<br />' => ']'
);
$content = strtr($content, $array);
return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');
