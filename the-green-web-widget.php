<?php
/**
 * @link		www.thegreenwebfoundation.org
 * @since		0.1.0
 * @package		The_Green_Web_Widget
 *
 * @wordpress-plugin
 * Plugin Name:	The Green Web Widget
 * Description: A plugin for showing The Green Web Foundation badge as a widget on your WordPress blog or website.
 * Version: 	0.1.0
 * Author:		The Green Web Foundation
 * Author URI:	https://www.thegreenwebfoundation.org
 * License:		GPL-2.0+
 * License URI:	http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:	the-green-web-widget
 * Domain Path:	/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-the-green-web-widget.php';

/**
 * Begins execution of the plugin.
 *
 * @since 0.1.0
 */
function run_the_green_web_widget() {

	add_action( 'widgets_init', function() {
		register_widget( 'The_Green_Web_Widget' );
	});

}

run_the_green_web_widget();
