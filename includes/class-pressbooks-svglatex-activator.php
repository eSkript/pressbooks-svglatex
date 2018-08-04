<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/lukaiser
 * @since      1.0.0
 *
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Pressbooks_Svglatex
 * @subpackage Pressbooks_Svglatex/includes
 * @author     Lukas Kaiser <reg@lukaiser.com>
 */
class Pressbooks_Svglatex_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate($networkwide) {
		if (function_exists('is_multisite') && is_multisite()) {
			// check if it is a network activation - if so, run the activation function for each blog id
			if ($networkwide) {
				// Get all blog ids
				$site_ids = get_sites( array( 'fields' => 'ids', 'network_id' => get_current_network_id() ) );
				foreach ( $site_ids as $site_id ) {
					switch_to_blog( $site_id );
					self::activate_one();
					restore_current_blog();
				}
				return;
			}   
		} 
		self::activate_one();
	}

	/**
	 * Activate plugin for one blog
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private static function activate_one(){
		$options = get_option( 'pb_latex' );
		$options['method'] = 'SVG_Latex';
		update_option( 'pb_latex', $options );
	}

	/**
	 * Activate new blog
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param	 int	$blog_id	The blog id of the new blog
	 */
	public static function activate_new_blog($blog_id){
		if (is_plugin_active_for_network('pressbooks-svglatex/pressbooks-svglatex.php')) {
			switch_to_blog( $blog_id );
			self::activate_one();
			restore_current_blog();
		}
	}

}
