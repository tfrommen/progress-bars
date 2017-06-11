<?php # -*- coding: utf-8 -*-

namespace tfrommen\ProgressBars;

/**
 * Shortcode.
 *
 * @package tfrommen\ProgressBars
 * @since   1.0.0
 */
class Shortcode {

	/**
	 * Shortcode tag filter hook name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	const FILTER_TAG = 'progress_bars.shortcode_tag';

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		/**
		 * Filters the shortcode tag.
		 *
		 * @since 1.0.0
		 *
		 * @param string $tag The shortcode tag.
		 */
		$this->tag = trim( apply_filters( self::FILTER_TAG, 'progress' ) );
	}

	/**
	 * Registers the shortcode.
	 *
	 * @since 1.0.0
	 *
	 * @return bool Whether or not the shortcode was registered successfully.
	 */
	public function register() {

		if ( '' === $this->tag ) {
			return false;
		}

		if ( shortcode_exists( $this->tag ) ) {
			return false;
		}

		add_shortcode( $this->tag, [ $this, 'render' ] );

		return true;
	}

	/**
	 * Renders the shortode markup.
	 *
	 * @since 1.0.0
	 *
	 * @param array       $atts    Optional. Shortcode attributes. Defaults to empty array.
	 * @param string|null $content Optional. Shortcode content. Defaults to empty string.
	 *
	 * @return string The generated markup.
	 */
	public function render( $atts = [], $content = '' ) {

		$attributes = '';

		foreach ( $this->normalize_atts( $atts ) as $name => $value ) {
			$attributes .= ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
		}

		$content = trim( $content );

		return sprintf(
			'<progress%2$s></progress>%1$s',
			$content ? '<span class="progress-bar-label">' . wp_kses_post( $content ) . '</span>' : '',
			$attributes
		);
	}

	/**
	 * Normalizes the given shortcode attributes.
	 *
	 * @param mixed $atts Raw shortcode attributes.
	 *
	 * @return string[] Normalized shortcode attributes.
	 */
	private function normalize_atts( $atts ) {

		$atts = shortcode_atts( [
			'class' => '',
			'id'    => '',
			'max'   => '100',
			'value' => '42',
		], (array) $atts, $this->tag );

		$classes = explode( ' ', "progress-bar {$atts['class']}" );
		$classes = array_unique( array_map( 'trim', $classes ) );

		$atts['class'] = implode( ' ', $classes );

		$atts = array_filter( $atts, function ( $value ) {

			return '' !== trim( $value );
		} );

		return $atts;
	}
}
