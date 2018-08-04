<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/lukaiser
 * @since      1.0.0
 *
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/public
 * @author     Lukas Kaiser <reg@lukaiser.com>
 */
class Pressbooks_Svglatex_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Append latex render method to the list of default methods.
	 *
	 * @since    1.0.0
	 */
	public function append_render_methode($list) {
		$list['SVG_Latex'] = 'svg';
		return $list;
	}

	/**
	 * Require custom latex class file.
	 *
	 * @since    1.0.0
	 */
	public function require_class($methode) {
		if($methode == 'SVG_Latex' || $methode == 'svg'){
			require_once( __DIR__ . '/class-svg-latex.php' );
		}
		return $methode;
	}

	/**
	 * Require custom latex class file.
	 *
	 * @since    1.0.0
	 */
	public function add_option($options) {
		$options['SVG_Latex'] = __( 'SVG', 'pressbooks-svglatex' );
		return $options;
	}

}
