<?php
/**
 * Child-Theme functions and definitions
 */

wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/main.js', array( 'jquery' ) );