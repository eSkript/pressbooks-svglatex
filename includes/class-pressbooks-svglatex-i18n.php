<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/lukaiser
 * @since      1.0.0
 *
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/includes
 * @author     Lukas Kaiser <reg@lukaiser.com>
 */
class Pressbooks_Svglatex_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pressbooks-svglatex',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
