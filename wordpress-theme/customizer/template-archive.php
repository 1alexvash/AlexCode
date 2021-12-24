<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


function customizer_register_template_archive( $wp_customize ) {

	$wp_customize->add_section(
		ALEXCODETH_SLUG . '_template_archive',
		[
			'title'            => __( 'Архивы', ALEXCODETH_TEXTDOMAIN ),
			'description'      => __( 'Настройки шаблона архивов, категорий, блога.', ALEXCODETH_TEXTDOMAIN ),
			'priority'         => 30,
			'panel'            => 'page_templates',
		]
	); /**/

	$wp_customize->add_setting(
		'archivetitleprefix',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'archivetitleprefix',
		[
			'section'           => ALEXCODETH_SLUG . '_template_archive',
			'label'             => __( 'Текст перед заголовком архива', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'text',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'archivetitleprefix', [
		'render_callback'  => '__return_false',
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'archivenoposts',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'archivenoposts',
		[
			'section'           => ALEXCODETH_SLUG . '_template_archive',
			'label'             => __( 'Текст если посты не найдены', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'text',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'archivenoposts', [
		'render_callback'  => '__return_false',
		'fallback_refresh' => true,
	] ); /**/
	
	$wp_customize->add_setting(
		'archivetags',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_parse_id_list',
		]
	);
	$wp_customize->add_control(
		new WP_Customize_Control_Terms(
			$wp_customize,
			'archivetags',
			[
				'label'         => __( 'Список тегов', ALEXCODETH_TEXTDOMAIN ),
				'section'       => ALEXCODETH_SLUG . '_template_archive',
				'type'          => 'control_terms',
				'taxonomy'      => 'post_tag',
			]
		)
	);
	$wp_customize->selective_refresh->add_partial( 'archivetags', [
		'render_callback'  => '__return_false',
		'fallback_refresh' => true,
	] ); /**/

}

add_action( 'customize_register', 'alexcodeth\customizer_register_template_archive', 10, 1 );