<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Устанавливает префикс для архивов
 * */
function get_custom_archive_title_prefix( $prefix ){
	return get_theme_mod( 'archivetitleprefix' );
}

add_filter( 'get_the_archive_title_prefix', 'alexcodeth\get_custom_archive_title_prefix' );


/**
 * 
 * */
function print_scripts_head() {
	echo force_balance_tags( get_theme_mod( 'additionalscriptswphead' ) );
}

add_action( 'wp_head', 'alexcodeth\print_scripts_head', 99, 0 );


/**
 * 
 * */
function print_scripts_footer() {
	echo force_balance_tags( get_theme_mod( 'additionalscriptswpfooter' ) );
}

add_action( 'wp_footer', 'alexcodeth\print_scripts_footer', 99, 0 );


/**
 * 
 * */
function disable_comment_url( $fields ) { 
	unset( $fields[ 'url' ] );
	return $fields;
}

add_filter( 'comment_form_default_fields','alexcodeth\disable_comment_url' );

remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );


/**
 * Удаление конструкции [...] на конце цитаты
 * */

add_filter( 'excerpt_more', '__return_empty_string' );


/**
 * Добавляет классы для мобилок
 * */
function is_mobile_body_classes( $classes, $class ) {
	if ( wp_is_mobile() ) {
		if ( is_array( $classes ) ) {
			array_push( $classes, 'is-mobile' );
		} else {
			$classes .= ' is-mobile';
		}
	}
	return $classes;
}

add_filter( 'body_class', 'alexcodeth\is_mobile_body_classes', 10, 2 );