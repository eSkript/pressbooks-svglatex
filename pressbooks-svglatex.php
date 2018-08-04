<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/lukaiser
 * @since             1.0.0
 * @package           Pressbooks_Svglatex
 *
 * @wordpress-plugin
 * Plugin Name:       Pressbooks SVG Latex
 * Plugin URI:        https://github.com/eSkript/pressbooks-svglatex
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Lukas Kaiser
 * Author URI:        https://github.com/lukaiser
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pressbooks-svglatex
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pressbooks-svglatex-activator.php
 */
function activate_pressbooks_svglatex($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressbooks-svglatex-activator.php';
	Pressbooks_Svglatex_Activator::activate($networkwide);
}

/**
 * The code that runs during when a new blog is created
 * This action is documented in includes/class-pressbooks-svglatex-activator.php
 */
function activate_new_blog_pressbooks_svglatex($blog_id) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressbooks-svglatex-activator.php';
	Pressbooks_Svglatex_Activator::activate_new_blog($blog_id);
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pressbooks-svglatex-deactivator.php
 */
function deactivate_pressbooks_svglatex($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressbooks-svglatex-deactivator.php';
	Pressbooks_Svglatex_Deactivator::deactivate($networkwide);
}

register_activation_hook( __FILE__, 'activate_pressbooks_svglatex' );
add_action('wpmu_new_blog', 'activate_new_blog_pressbooks_svglatex', 8, 1);
register_deactivation_hook( __FILE__, 'deactivate_pressbooks_svglatex' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pressbooks-svglatex.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pressbooks_svglatex() {

	$plugin = new Pressbooks_Svglatex();
	$plugin->run();

}
run_pressbooks_svglatex();
