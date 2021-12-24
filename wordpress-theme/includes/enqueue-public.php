<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Подключение скриптов
 *
 * @param string $handle Имя / идентификатор скрипта
 * @param string $src URL на файл скрипта
 * @param array $deps массив зависимостей
 * @param string|bool $ver версия
 * @param bool $in_footer подключать в шапке или подвале
 */
function scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'alexcodeth-public', get_theme_file_uri( 'js/public.js' ), [ 'jquery' ], filemtime( get_theme_file_path( 'js/public.js' ) ), true );
	wp_enqueue_script( 'fancybox', get_theme_file_uri( 'js/fancybox.js' ), [ 'jquery' ], '3.3.5', true );
	file_exists( $init_gallery_script_path = get_theme_file_path( 'js/galleries.js' ) ) && wp_add_inline_script( 'fancybox', file_get_contents( $init_gallery_script_path ), 'after' );
	wp_enqueue_script( 'superembed', get_theme_file_uri( "js/superembed.js" ), [ 'jquery' ], '3.1', true );
	if ( is_singular() ) {
		wp_enqueue_script( 'blogpost', get_theme_file_uri( 'js/blogpost.js' ), [ 'jquery' ],  filemtime( get_theme_file_path( 'js/blogpost.js' ) ), true );
		wp_localize_script( 'blogpost', 'BlogpostParam', [
			'ajaxurl'  => admin_url( 'admin-ajax.php' ),
			'post'     => get_the_ID(),
			'nonce'    => wp_create_nonce( ALEXCODETH_SLUG . date( 'Y-d-m' ) ),
		] );
	}
	wp_enqueue_script( 'alexcodeth-search', get_theme_file_uri( 'js/search.js' ), [ 'jquery' ], filemtime( get_theme_file_path( 'js/search.js' ) ), true );
	wp_localize_script( 'alexcodeth-search', 'SearchParams', [
		'ajaxurl'  => admin_url( 'admin-ajax.php' ),
	] );

}

add_action( 'wp_enqueue_scripts', 'alexcodeth\scripts' );


/**
 * Добавляет предварительную загрузку шрифтов
 * */
function add_preload_resource() {
	foreach ( apply_filters( 'preload_resource_part', [
		// 'css/public'                 => 'style',
		'fonts/Ubuntu-Bold.woff'     => 'font',
		'fonts/Ubuntu-Bold.woff2'    => 'font',
		'fonts/Ubuntu-Light.woff'    => 'font',
		'fonts/Ubuntu-Light.woff'    => 'font',
		'fonts/Ubuntu-Medium.woff'   => 'font',
		'fonts/Ubuntu-Medium.woff'   => 'font',
		'fonts/Ubuntu-Regular.woff'  => 'font',
		'fonts/Ubuntu-Regular.woff'  => 'font',
	] ) as $file_path => $type ) {
		$file_uri = get_theme_file_uri( $file_path );
		if ( $file_uri ) {
			echo '<link rel="preload" href="' . $file_uri . '" as="' . $type . '" crossorigin="anonymous">';
		}
	}
}

add_action( 'head_start', 'alexcodeth\add_preload_resource' );


/**
 * Отключение стилей при выводе их в шапке, чтобы подкючить в подвале сайта
 */
function dequeue_style() {
	wp_dequeue_style( 'contact-form-7' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'exactmetrics-popular-posts-style-css' );
	wp_dequeue_style( 'simple-share-buttons-adder-font-awesome-css' );
}

add_action( 'wp_print_styles', 'alexcodeth\dequeue_style' );


/**
 * Подключение стилей
 *
 * @param string $handle Имя / идентификатор стиля
 * @param string $src URL на файла стиля
 * @param array $deps массив зависимостей
 * @param string|bool $ver версия
 * @param string $media для каких устройств подключать
 */
function print_styles() {
	wp_enqueue_style( 'alexcodeth-fonts', get_theme_file_uri( 'css/fonts.css' ), [], filemtime( get_theme_file_path( 'css/fonts.css' ) ), 'all' );
	// wp_enqueue_style( 'alexcodeth-public', get_theme_file_uri( 'css/public.css' ), [ 'alexcodeth-fonts' ], filemtime( get_theme_file_path( 'css/public.css' ) ), 'all' );
	is_singular() && wp_enqueue_style( 'fancybox', get_theme_file_uri( 'css/fancybox.css' ), [ 'alexcodeth-fonts' ], '3.3.5', 'all' );
	wp_enqueue_style( 'simple-share-buttons-adder-font-awesome-css' );
	wp_enqueue_style( 'contact-form-7' );
	wp_enqueue_style( 'wp-block-library' );
	wp_enqueue_style( 'exactmetrics-popular-posts-style-css' );
}
add_action( 'get_footer', 'alexcodeth\print_styles', 10, 0 );


/**
 * Подключение стилей инлайн для более быстрой отрисовки страницы
 * */
function ctitical_styles() {
	$critical_file_path = get_theme_file_path( 'css/public.css' );
	if ( file_exists( $critical_file_path ) ) {
		echo '<style type="text/css">' . file_get_contents( $critical_file_path ) . '</style>';
	}
}
add_action( 'wp_head', 'alexcodeth\ctitical_styles', 10, 0 );