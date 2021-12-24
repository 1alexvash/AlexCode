<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


echo apply_filters( 'breadcrumbs_before_outer', '<div class="breadcrumbs-outer"><div class="container">' );

if ( function_exists( 'yoast_breadcrumb' ) && is_array( $wpseo_titles = get_option( 'wpseo_titles' ) ) && array_key_exists( 'breadcrumbs-enable', $wpseo_titles ) && $wpseo_titles[ 'breadcrumbs-enable' ] ) {
	yoast_breadcrumb();
} else {
	echo apply_filters( 'breadcrumbs_before_inner', '<ul class="breadcrumbs">' );
	if ( ! is_front_page() ) {
		echo '<li><a href="', home_url(), '">', __( 'Home', ALEXCODETH_TEXTDOMAIN ), '</a></li>';
		if ( is_category() || is_tag() ) {
			echo '<li>';
			the_category( ' ' );
			echo '</li>';
		} elseif ( is_page() || is_single() ) {
			echo '<li><span>', the_title( '', '', false ), '<span></li>';
		}
	}
	else {
		echo __( 'Домашняя страница', ALEXCODETH_TEXTDOMAIN );
	}
	echo apply_filters( 'breadcrumbs_after_inner', '</ul>' );
}

echo apply_filters( 'breadcrumbs_after_outer', '</div></div>' );