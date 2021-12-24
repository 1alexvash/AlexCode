<?php


namespace alexcodeth;

use WP_Customize_Control;

if ( ! defined( 'ABSPATH' ) ) { exit; };


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WP_Customize_Control_Terms' ) ) :


	class WP_Customize_Control_Terms extends WP_Customize_Control {


		public $type = 'control_terms';


		protected $taxonomy;


		public function __construct( $manager, $id, $args = [] ) {
			parent::__construct( $manager, $id, $args );
			! array_key_exists( 'taxonomy', $args ) && $this->taxonomy = 'category';
			$this->input_attrs = array_merge( $this->input_attrs, [
				'type'  => 'hidden',
				'id'    => esc_attr( $this->id ),
			] );
		}

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'customize-preview' );
			wp_enqueue_script(
				'control-terms',
				get_theme_file_uri( 'js/control-terms.js' ),
				[ 'jquery', 'customize-preview' ],
				filemtime( get_theme_file_path( 'js/control-terms.js' ) ),
				true
			);
			wp_add_inline_script(
				'control-terms',
				"jQuery( document ).ready( function () { jQuery( '#customize-control-{$this->id}' ).WPCustomizeTerms(); } );",
				'after'
			);
			wp_enqueue_style( 'control-terms', get_theme_file_uri( 'css/control-terms.css' ), [], filemtime( get_theme_file_path( 'css/control-terms.css' ) ), 'all' );
		}


		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$terms = get_terms( [
				'hide_empty' => false,
				'taxonomy'   => $this->taxonomy,
				'number'     => '',
				'fields'     => 'all',
			] );
			?>
				<div class="control-terms">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php if ( ! empty( $this->description ) ) : ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php endif; ?>
					<input
						<?php echo $this->render_atts( $this->input_attrs ); ?>
						<?php $this->link(); ?>
						value="<?php echo esc_attr( $this->value() ); ?>"
					/>
					<?php if ( is_array( $terms ) && ! empty( $terms ) ) : ?>
						<div class="inside">
							<?php echo $this->get_terms_list( 0, $terms, wp_parse_id_list( $this->value() ) ); ?>
						</div>
					<?php else : ?>
						<p><?php  _e( 'Подходящие термы не найдены!', ALEXCODETH_TEXTDOMAIN ); ?></p>
					<?php endif; ?>
				</div>
			<?php
		}


		/**
		 * Возвращает список страниц с чекбоксами
		 * */
		function get_terms_list( $parent_id = 0, $terms = [], $checked = [] ) {
			$childs = wp_list_filter( $terms, [ 'parent' => $parent_id ], 'AND' );
			return empty( $childs ) ? '' : '<ul>' . implode( PHP_EOL, array_map( function ( $child ) use ( $terms, $checked ) {
				return sprintf(
					'<li><label><input type="checkbox" value="%1$s" %2$s> <span class="title">%3$s</span></labe> %4$s</li>',
					$child->term_id,
					checked( in_array( $child->term_id, $checked ), true, false ),
					$child->name,
					$this->get_terms_list( $child->term_id, $terms, $checked )
				);
			}, $childs ) ) . '</ul>';
		}


		/**
		 * Формирует html код аттрибутов элемента управления формы
		 * @param  array  $atts  ассоциативный массив аттрибут=>значение
		 * @return string        html-код
		 */
		public static function render_atts( array $atts = [] ) {
			$html = '';
			if ( ! empty( $atts ) ) {
				foreach ( $atts as $key => $value ) {
					$html .= ' ' . $key . '="' . $value . '"';
				}
			}
			return $html;
		}




	}


endif;