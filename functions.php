<?php
/**
 * Child-Theme functions and definitions
 */

wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/main.js', array( 'jquery' ) );

function dlva_child_theme_setup() {

	register_nav_menu( 'head_butt_rt', __( 'Header right buttons', 'children_theme' ) );

}
add_action( 'after_setup_theme', 'dlva_child_theme_setup' );