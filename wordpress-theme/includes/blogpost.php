<?php


namespace alexcodeth;


use WP_Post;


if ( ! defined( 'ABSPATH' ) ) { exit; };


function blogpost_handler() {

	if ( isset( $_POST[ 'nonce' ] ) && wp_verify_nonce( $_POST[ 'nonce' ], ALEXCODETH_SLUG . date( 'Y-d-m' ) ) && isset( $_POST[ 'post' ] ) ) {
		$post_id = sanitize_key( $_POST[ 'post' ] );
		if ( get_post( $post_id ) instanceof WP_Post ) {
			$meta_key = in_array( $_POST[ 'action' ], [ 'viewed', 'like', 'dislike' ] ) ? $_POST[ 'action' ] : 'viewed';
			$meta_value = intval( get_post_meta( $post_id, $meta_key, true ) );
			$meta_value = $meta_value + 1;
			update_post_meta( $post_id, $meta_key, $meta_value );
			wp_send_json_success( $meta_value );
		} else {
			wp_send_json_error( 'error' );
		}
	}
	wp_die();
}

add_action( 'wp_ajax_' . 'viewed', 'alexcodeth\blogpost_handler' );
add_action( 'wp_ajax_nopriv_' . 'viewed', 'alexcodeth\blogpost_handler' );

add_action( 'wp_ajax_' . 'like', 'alexcodeth\blogpost_handler' );
add_action( 'wp_ajax_nopriv_' . 'like', 'alexcodeth\blogpost_handler' );

add_action( 'wp_ajax_' . 'dislike', 'alexcodeth\blogpost_handler' );
add_action( 'wp_ajax_nopriv_' . 'dislike', 'alexcodeth\blogpost_handler' );