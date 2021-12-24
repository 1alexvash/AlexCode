<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


function theme_supports() {
	add_theme_support( 'menus' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_filter( 'widget_text', 'do_shortcode' );
	add_image_size( 'blogpost-image', 790, 394, true );
	add_image_size( 'post-img', 380, 380, true );
}

add_action( 'after_setup_theme', 'alexcodeth\theme_supports' );


/**
 * Возвращает список социальных сетей для которых есть иконки и которые отображаются вблоках контактов сайта
 * */
function get_list_of_socials( $items = [] ) {
	return array_merge( $items, [
		'telegram' => __( 'Telegram', ALEXCODETH_TEXTDOMAIN ),
		'github'   => __( 'GitHub', ALEXCODETH_TEXTDOMAIN ),
		'email'    => __( 'Email', ALEXCODETH_TEXTDOMAIN ),
	] );
}

add_filter( 'socials_list', 'alexcodeth\get_list_of_socials', 10, 1 );