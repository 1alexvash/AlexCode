<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Добавляет опции темы по умолчанию при её активации
 **/
function setup_default_mods( $old_name ) {
	$theme_slug = get_option( 'stylesheet' );
	$mods = get_theme_mods();
	! is_array( $mods ) && $mods = [];
	update_option( 'theme_mods_' . $theme_slug, array_merge( [

		'sectionintrousedby'        => false,
		'sectionintrotitle'         => '',
		'sectionintrodescription'   => '',
		'sectionintrofotosrc'       => '',
		'sectionintroname'          => '',
		'sectionintrojob'           => '',

		'socialstelegramhrefattr'   => '',
		'socialsgithubhrefattr'     => '',
		'socialsemailhrefattr'      => '',

		'archivetitleprefix'        => '',
		'archivenoposts'            => __( 'Ничего не найдено', ALEXCODETH_TEXTDOMAIN ),
		'archivetags'               => '',

		'additionalscriptswpfooter' => '',
		'additionalscriptswphead'   => '',

		'headersocialsusedby'       => false,

		'footerlogosrc'             => '',
		'footercopyname'            => '&copy;%s - Alex-code',
		'footercopydesc'            => __( 'Все права защищены', ALEXCODETH_TEXTDOMAIN ),
		'footersocialsusedby'       => false,

	], $mods ) );
}

add_action( 'after_switch_theme', 'alexcodeth\setup_default_mods' );