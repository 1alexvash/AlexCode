<?php


namespace alexcodeth;


use WP_Query;


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Редирект на запись со страницы поиска, если найдена всего одна запись
 */
function single_result_redirect() {
	global $wp_query;
	if ( $wp_query->is_search() ) {
		if ( $wp_query->post_count == 1 ) {
			wp_redirect( get_permalink( reset( $wp_query->posts )->ID ) );
			die;
		}
	}
}

add_action( 'template_redirect', 'alexcodeth\single_result_redirect' );


/**
 * Подсветка результатов поиска
 **/
function search_backlight( $text ) {
	if ( in_the_loop() && ( is_search() || ( is_singular() && array_key_exists( 's', $_GET ) ) ) || ( wp_doing_ajax() && 'alex_search' == $_REQUEST[ 'action' ] ) ) {
		$query_terms = get_query_var( 'search_terms' );
		if ( empty( $query_terms ) ) {
			$query_terms = array_filter( ( array ) get_query_var( 's' ) );
		}
		if ( empty( $query_terms ) && isset( $_REQUEST[ 'keyword' ] ) ) {
			$query_terms = array_filter( ( array ) sanitize_text_field( $_REQUEST[ 'keyword' ] ) );
		}
		if ( empty( $query_terms ) ) {
			return $text;
		}
		foreach( $query_terms as $term ){
			$term = preg_quote( $term, '/' );
			$text = preg_replace_callback( "/$term/iu", function( $match ) {
				return '<span class="bg-search">'. $match[ 0 ] .'</span>';
			}, $text );
		}
	}
	return $text;
}

add_filter( 'the_content', 'alexcodeth\search_backlight' );

add_filter( 'get_the_excerpt', 'alexcodeth\search_backlight' );

add_filter( 'the_title', 'alexcodeth\search_backlight' );


/**
 * Добавляет ключ поиска в ссылку поста для подсветки на странице записи
 * */
function add_search_key_for_backlight( $permalink, $post_id ) {
	if ( is_search() && in_the_loop() ) {
		$permalink = esc_url( add_query_arg( [ 's' => get_search_query() ], $permalink ) );
	}
	return $permalink;
}

add_filter( 'the_permalink', 'alexcodeth\add_search_key_for_backlight', 10, 2 );



/**
 * AJAX обработчик для работы динамического поиска
 * */
function search_handler() {
	if ( isset( $_REQUEST[ 'keyword' ] ) && ! empty( $keyword = trim( sanitize_text_field( $_REQUEST[ 'keyword' ] ) ) ) ) {
		$result = '';
		$query = new WP_Query( [
			'post_type'      => 'post',
			'orderby'        => 'title',
			'order'          => 'ASC',
			'numberposts'    => -1,
			's'              => $keyword,
			'posts_per_page' => -1,
		] );
		ob_start();
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				include get_theme_file_path( 'views/entry-search.php' );
			}
			wp_reset_query();
		} else {
			include get_theme_file_path( 'views/search-no-posts.php' );
		}
		$result = ob_get_clean();
		wp_send_json_success( $result, null );
	}
	wp_die();
}

add_action( 'wp_ajax_' . 'alex_search' , 'alexcodeth\search_handler' );
add_action( 'wp_ajax_nopriv_' . 'alex_search', 'alexcodeth\search_handler' );