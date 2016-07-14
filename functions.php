<?php
/**
 * Child-Theme functions and definitions
 */

wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'custom-js', 'main.js', array( 'jquery' ) );