<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


function customizer_register_footer( $wp_customize ) {

	$wp_customize->add_section(
		ALEXCODETH_SLUG . '_footer',
		[
			'title'            => __( 'Подвал сайта', ALEXCODETH_TEXTDOMAIN ),
			'priority'         => 30,
			'panel'            => 'template_section',
		]
	); /**/

	$wp_customize->add_setting(
		'footerlogosrc',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Image_Control(
			$wp_customize,
			'footerlogosrc',
			[
				'label'         => __( 'Превью', ALEXCODETH_TEXTDOMAIN ),
				'section'       => ALEXCODETH_SLUG . '_footer',
				'settings'      => 'footerlogosrc',
			]
		)
	);
	$wp_customize->selective_refresh->add_partial( 'footerlogosrc', [
		'selector'         => '#footer-logo',
		'render_callback'  => '__return_false',
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'footercopyname',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'footercopyname',
		[
			'section'           => ALEXCODETH_SLUG . '_footer',
			'label'             => __( 'Копирайт (имя)', ALEXCODETH_TEXTDOMAIN ),
			'description'       => '(%s - год)',
			'type'              => 'text',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'footercopyname', [
		'selector'         => '#copyright-name',
		'render_callback'  => function () { return customizer_get_text_theme_mod( 'footercopyname' ); },
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'footercopydesc',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'footercopydesc',
		[
			'section'           => ALEXCODETH_SLUG . '_footer',
			'label'             => __( 'Копирайт (описание)', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'text',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'footercopydesc', [
		'selector'         => '#copyright-desc',
		'render_callback'  => function () { return customizer_get_text_theme_mod( 'footercopydesc' ); },
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'footersocialsusedby',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'alexcodeth\sanitize_checkbox',
		]
	);
	$wp_customize->add_control(
		'footersocialsusedby',
		[
			'section'           => ALEXCODETH_SLUG . '_footer',
			'label'             => __( 'Использовать блок социальных сетей', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'checkbox',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'footersocialsusedby', [
		'render_callback'  => '__return_false',
		'fallback_refresh' => true,
	] ); /**/

}

add_action( 'customize_register', 'alexcodeth\customizer_register_footer', 10, 1 );