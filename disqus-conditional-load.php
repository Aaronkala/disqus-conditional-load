<?php
/**
 * Plugin Name:     Disqus Conditional Load for Gofore
 * Plugin URI:      https://dclwp.com
 * Description:     Disqus commenting system for WordPress with advanced features like like <strong>lazy load, shortcode</strong> etc. Customized for Gofore.
 * Version:         11.0.0
 * Author:          Joel James, <a href="http://aaronalex.fi">Aaron Hakala</a>
 * Author URI:      https://duckdev.com/
 * Donate link:     https://paypal.me/JoelCJ
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:     disqus-conditional-load
 * Domain Path:     /languages
 *
 * Disqus Conditional Load is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Disqus Conditional Load is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Disqus Conditional Load. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category Core
 * @package  DCL
 * @author   Joel James <mail@cjoel.com>
 * @license  http://www.gnu.org/licenses/ GNU General Public License
 * @link     https://dclwp.com
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

// These are constants. Seriously!
$constants = array(
	// Oh yeah, we decide these constants.
	// These constants can not be overwritten.
	'fixed' => array(
		'DCL_NAME' => 'disqus-conditional-load',
		'DCL_DOMAIN' => 'disqus-conditional-load',
		'DCL_DIR' => plugin_dir_path( __FILE__ ),
		'DCL_PATH' => plugin_dir_url( __FILE__ ),
		'DCL_BASE_FILE' => __FILE__,
		'DCL_VERSION' => '11.0.0',
	),

	// Aaaand, here is something for your choice.
	// These constants can be overwritten.
	'open' => array(
		// Set who all can access plugin settings.
		// You can change this if you want to give others access.
		'DCL_ACCESS' => 'manage_options',
	)
);

// Now, let the constants born.
foreach ( $constants['fixed'] as $constant => $value ) {
	define( $constant, $value );
}

// Let open constants born too.
foreach ( $constants['open'] as $constant => $value ) {
	// Check if it is defined already.
	if ( ! defined( $constant ) ) {
		define( $constant, $value );
	}
}

/**
 * Plugin activation actions. We are starting fellas!
 *
 * Actions to perform during plugin activation.
 * We will be registering default options in this function.
 *
 * @uses   register_activation_hook() To register activation hook.
 * @since  10.0.0
 * @access private
 *
 * @return void
 */
function activate_dcl() {

    require_once DCL_DIR . 'includes/class-dcl-activator.php';

	// The very beginning!
    DCL_Activator::activate();
}

// Make use of activation hook.
register_activation_hook( DCL_BASE_FILE , 'activate_dcl' );

// Our helper functions. Thanks for the help, helper.
include_once DCL_DIR . 'includes/class-dcl-helper.php';

// Load all required files for the plugin to work.
require_once DCL_DIR . 'includes/class-disqus-conditional-load.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 10.0.0
 * @access public
 *
 * @return void
 */
function run_dcl() {

	( new Disqus_Conditional_Load() )->run();
}

run_dcl();

/*** I will find you, and I will thank you! - Joel James ***/