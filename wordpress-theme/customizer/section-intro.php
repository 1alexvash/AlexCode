<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


function customizer_register_template_section( $wp_customize ) {

	$wp_customize->add_section(
		ALEXCODETH_SLUG . '_section_intro',
		[
			'title'            => __( 'Об авторе', ALEXCODETH_TEXTDOMAIN ),
			'priority'         => 20,
			'panel'            => 'template_section',
		]
	); /**/

	$wp_customize->add_setting(
		'sectionintrousedby',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'alexcodeth\sanitize_checkbox',
		]
	);
	$wp_customize->add_control(
		'sectionintrousedby',
		[
			'section'           => ALEXCODETH_SLUG . '_section_intro',
			'label'             => __( 'Использовать секцию "Об авторе"', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'checkbox',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'sectionintrousedby', [
		'render_callback'  => '__return_false',
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'sectionintrotitle',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'sectionintrotitle',
		[
			'section'           => ALEXCODETH_SLUG . '_section_intro',
			'label'             => __( 'Заголовок &lt;H1&gt;', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'text',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'sectionintrotitle', [
		'selector'         => '#intro-title',
		'render_callback'  => function () { return customizer_get_text_theme_mod( 'sectionintrotitle' ); },
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'sectionintrodescription',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_kses_post',
		]
	);
	$wp_customize->add_control(
		new WP_Customize_Control_Tinymce_Editor(
			$wp_customize,
			'sectionintrodescription',
			[
				'label'                 => __( 'Описание', ALEXCODETH_TEXTDOMAIN ),
				'section'               => ALEXCODETH_SLUG . '_section_intro',
				'settings'              => 'sectionintrodescription'
			]
		)
	);
	$wp_customize->selective_refresh->add_partial( 'sectionintrodescription', [
		'selector'         => '#intro-description',
		'render_callback'  => function () { return customizer_get_editor_theme_mod( 'sectionintrodescription' ); },
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'sectionintrofotosrc',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		]
	);
	$wp_customize->add_control(
		new \WP_Customize_Image_Control(
			$wp_customize,
			'sectionintrofotosrc',
			[
				'label'         => __( 'Превью', ALEXCODETH_TEXTDOMAIN ),
				'section'       => ALEXCODETH_SLUG . '_section_intro',
				'settings'      => 'sectionintrofotosrc',
			]
		)
	);
	$wp_customize->selective_refresh->add_partial( 'sectionintrofotosrc', [
		'selector'         => '#intro-foto',
		'render_callback'  => function () {
			return customizer_render_parts_element_by_id( 'parts/section', 'intro', [], 'intro-foto' );
		},
		'container_inclusive' => true,
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'sectionintroname',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'sectionintroname',
		[
			'section'           => ALEXCODETH_SLUG . '_section_intro',
			'label'             => __( 'Имя автора', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'text',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'sectionintroname', [
		'selector'         => '#intro-name',
		'render_callback'  => function () { return customizer_get_text_theme_mod( 'sectionintroname' ); },
		'fallback_refresh' => true,
	] ); /**/

	$wp_customize->add_setting(
		'sectionintrojob',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'sectionintrojob',
		[
			'section'           => ALEXCODETH_SLUG . '_section_intro',
			'label'             => __( 'Работа автора', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'text',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'sectionintrojob', [
		'selector'         => '#intro-jpb',
		'render_callback'  => function () { return customizer_get_text_theme_mod( 'sectionintrojob' ); },
		'fallback_refresh' => true,
	] ); /**/

}

add_action( 'customize_register', 'alexcodeth\customizer_register_template_section', 10, 1 );