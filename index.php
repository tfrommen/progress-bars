<?php # -*- coding: utf-8 -*-
/*
 * Plugin Name: Progress Bars
 * Plugin URI:  https://github.com/tfrommen/progress-bars
 * Description: This plugin registers a configurable shortcode to render HTML5 <code>&lt;progress&gt;</code> elements.
 * Author:      Thorsten Frommen
 * Author URI:  https://tfrommen.de
 * Version:     1.0.0
 * License:     MIT
 */

namespace tfrommen\ProgressBars;

defined( 'ABSPATH' ) or die;

/**
 * Default shortcode tag.
 *
 * @since 1.0.0
 *
 * @var string
 */
const DEFAULT_SHORTCODE_TAG = 'progress';

/**
 * Shortcode tag filter hook name.
 *
 * @since 1.0.0
 *
 * @var string
 */
const FILTER_SHORTCODE_TAG = 'progress_bars.shortcode_tag';

/**
 * Bootstraps the plugin.
 *
 * @since   1.0.0
 * @wp-hook plugins_loaded
 *
 * @return void
 */
function bootstrap() {

	/**
	 * Filters the shortcode tag.
	 *
	 * @since 1.0.0
	 *
	 * @param string $tag The shortcode tag.
	 */
	$tag = trim( apply_filters( FILTER_SHORTCODE_TAG, DEFAULT_SHORTCODE_TAG ) );
	if ( '' !== $tag ) {
		add_shortcode( $tag, function ( $atts = [], $content = '' ) use ( $tag ) {

			$atts = shortcode_atts( [
				'class' => '',
				'id'    => '',
				'max'   => '100',
				'value' => '42',
			], (array) $atts, $tag );
			$atts = array_filter( $atts, function ( $value ) {

				return '' !== trim( $value );
			} );

			$attributes = '';

			foreach ( $atts as $name => $value ) {
				$attributes .= ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
			}

			$content = trim( $content );

			return sprintf(
				'<progress%2$s></progress>%1$s',
				$content ? '<span class="progress-bar-label">' . esc_html( $content ) . '</span>' : '',
				$attributes
			);
		} );
	}
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\bootstrap' );
