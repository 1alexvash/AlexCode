<?php


if ( ! defined( 'ABSPATH' ) ) { exit; };


define( 'ALEXCODETH_URL', get_template_directory_uri() . '/' );
define( 'ALEXCODETH_DIR', get_template_directory() . '/' );
define( 'ALEXCODETH_TEXTDOMAIN', 'alexcodeth' );
define( 'ALEXCODETH_SLUG', 'alexcodeth' );


get_template_part( 'includes/textdomain' );
get_template_part( 'includes/theme-functions' );
get_template_part( 'includes/brand' );
get_template_part( 'includes/theme-supports' );
get_template_part( 'includes/menus' );
get_template_part( 'includes/search-result' );


if ( is_admin() ) {
	global $pagenow;
	if ( isset( $_GET[ 'activated' ] ) && $pagenow == 'themes.php' ) {
		get_template_part( 'includes/theme-activate' );
	}
	if ( wp_doing_ajax() ) {
		get_template_part( 'includes/blogpost' );
	}
} else {
	get_template_part( 'includes/enqueue-public' );
	get_template_part( 'includes/hooks-public' );
}


if ( is_customize_preview() ) {
	get_template_part( 'customizer/control', 'editor' );
	get_template_part( 'customizer/control', 'terms' );
	get_template_part( 'customizer/panels' );
	get_template_part( 'customizer/scripts' );
	get_template_part( 'customizer/socials' );
	get_template_part( 'customizer/section', 'header' );
	get_template_part( 'customizer/section', 'intro' );
	get_template_part( 'customizer/section', 'footer' );
	get_template_part( 'customizer/template', 'archive' );
	get_template_part( 'customizer/template', 'singular' );
}