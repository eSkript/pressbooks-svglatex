<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/lukaiser
 * @since      1.0.0
 *
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/includes
 * @author     Lukas Kaiser <reg@lukaiser.com>
 */
class Pressbooks_Svglatex_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate($networkwide) {
		if (function_exists('is_multisite') && is_multisite()) {
			// check if it is a network activation - if so, run the activation function for each blog id
			if ($networkwide) {
				// Get all blog ids
				$site_ids = get_sites( array( 'fields' => 'ids', 'network_id' => get_current_network_id() ) );
				foreach ( $site_ids as $site_id ) {
					switch_to_blog( $site_id );
					self::deactivate_one();
					restore_current_blog();
				}
				return;
			}   
		} 
		self::deactivate_one();
	}

	/**
	 * Deactivate plugin for one blog
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private static function deactivate_one(){
		$options = get_option( 'pb_latex' );
		if($options['method'] == 'SVG_Latex'){
			$options['method'] = 'Automattic_Latex_WPCOM';
			update_option( 'pb_latex', $options );
		}
	}

}
