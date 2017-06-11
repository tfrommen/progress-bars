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
 * Bootstraps the plugin.
 *
 * @since   1.0.0
 * @wp-hook plugins_loaded
 *
 * @return void
 */
function bootstrap() {

	/**
	 * File with shortcode class.
	 */
	require_once __DIR__ . '/src/Shortcode.php';

	( new Shortcode() )->register();
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\bootstrap' );
