<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Регистрация меню
 */
function register_theme_nav_menus() {
	register_nav_menus( [
		'main' => __( 'Main menu', ALEXCODETH_TEXTDOMAIN ),
	] );
}

add_action( 'after_setup_theme', 'alexcodeth\register_theme_nav_menus' );