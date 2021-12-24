<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * 
 * */
function customizer_register_scripts( $wp_customize ) {

	$wp_customize->add_section(
		ALEXCODETH_SLUG . '_scripts',
		[
			'title'             => __( 'Дополнительные скрипты', 'diamondlaser' ),
			'priority'          => 100,
		]
	); /**/

	$wp_customize->add_setting(
		'additionalscriptswphead',
		[
			'transport'         => 'postMessage',
		]
	);
	$wp_customize->add_control(
		'additionalscriptswphead',
		[
			'section'           => ALEXCODETH_SLUG . '_scripts',
			'label'             => __( 'Выводится перед закрывающим тегом HEAD', 'diamondlaser' ),
			'type'              => 'textarea',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'additionalscriptswphead', [
		'render_callback'       => '__return_false',
		'fallback_refresh'      => true,
	] ); /**/

	$wp_customize->add_setting(
		'additionalscriptswpfooter',
		[
			'transport'         => 'postMessage',
		]
	);
	$wp_customize->add_control(
		'additionalscriptswpfooter',
		[
			'section'           => ALEXCODETH_SLUG . '_scripts',
			'label'             => __( 'Выводится в подвале сайта перед закрывающим тегом BODY', 'diamondlaser' ),
			'type'              => 'textarea',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'additionalscriptswpfooter', [
		'render_callback'       => '__return_false',
		'fallback_refresh'      => true,
	] ); /**/

}

add_action( 'customize_register', 'alexcodeth\customizer_register_scripts', 10, 1 );


/**
 * 
 * */
function customizer_decor_scripts() {
	?>

		<style>
			#accordion-section-<?php echo ALEXCODETH_SLUG; ?>_scripts .accordion-section-title::before {
				content: "\f14b";
				display: inline;
				font: normal 20px/1 dashicons;
				vertical-align: middle;
			}
		</style>

	<?php
}

add_action( 'customize_controls_print_styles', 'alexcodeth\customizer_decor_scripts' );