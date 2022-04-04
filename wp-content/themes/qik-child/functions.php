<?php
/**
 * Child functions.php
 *
 * @package Qik Child
 */

/**
 * Enqueue child theme css.
 */
function qik_child_enqueue_styles() {
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'qik_child_enqueue_styles' );
