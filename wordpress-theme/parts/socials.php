<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


$list = apply_filters( 'socials_list', [] );
$items = [];
$format = apply_filters( 'socials_list_item_format', '<li><a href="%1$s" target="_blank" class="%2$s"><img src="%3$s" alt="Icon %2$s"></a></li>' );

array_map( function ( $key ) use ( &$items, $format ) {
	$url = get_theme_mod( 'socials' . $key . 'hrefattr' );
	$src = get_theme_file_uri( 'images/' . $key . '.svg' );
	is_url( $src ) && ! empty( $url ) && array_push( $items, sprintf( $format, $url, $key, $src ) );
}, array_keys( $list ) );

if ( ! empty( $items ) ) {

	echo apply_filters( 'socials_list_before', '<ul class="socials">' ), implode( PHP_EOL, $items ), apply_filters( 'socials_list_after', '</ul>' );

}