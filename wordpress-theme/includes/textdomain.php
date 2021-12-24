<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Загрузка "переводов"
 */
function load_textdomain() {
	load_theme_textdomain( ALEXCODETH_TEXTDOMAIN, ALEXCODETH_DIR . 'languages/' );
}
add_action( 'after_setup_theme', 'alexcodeth\load_textdomain' );
