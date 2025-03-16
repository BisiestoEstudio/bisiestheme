<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bisiestheme
 * @since 1.0.0
 */

define('BISIESTHEME_SLUG', 'bisiestheme');
define('BISIESTHEME_VERSION', '1.0.0');


include(plugin_dir_path(__FILE__) . 'includes/config.php');
include(plugin_dir_path(__FILE__) . 'includes/extras.php');
include(plugin_dir_path(__FILE__) . 'includes/blocks.php');


/**
 * Enqueue the CSS files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function bisiestheme_styles()
{
	// CSS
	wp_enqueue_style('simple', get_template_directory_uri() . '/assets/css/simple.min.css', array(), BISIESTHEME_VERSION);
	wp_enqueue_style('blocks', get_template_directory_uri() . '/assets/css/blocks.css', array(), BISIESTHEME_VERSION);
	wp_enqueue_style('bisiestheme-style', get_stylesheet_uri(), [], BISIESTHEME_VERSION);

	// JS
	wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/app.js', array(), BISIESTHEME_VERSION, true);
}
add_action('wp_enqueue_scripts', 'bisiestheme_styles');
