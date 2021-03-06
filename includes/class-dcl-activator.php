<?php

// If this file is called directly, abort.
defined( 'ABSPATH' ) or exit;

/**
 * Fired during plugin activation. Hmm, yeah. The beginning!
 *
 * This class defines all code necessary to run during the plugin's activation.
 * We will register our default settings here if not exists already.
 *
 * @category   Core
 * @package    DCL
 * @subpackage Activator
 * @author     Joel James <mail@cjoel.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://dclwp.com
 */
class DCL_Activator {

	/**
	 * Perform actions required during activation.
	 *
	 * We register default options to the WordPress if not exists already.
	 * We will keep the old values if already exist.
	 *
	 * @since  10.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function activate() {

		// Default settings for our plugin.
		$options = array(
			'dcl_type' => 'scroll',
			'dcl_div_width' => '',
			'dcl_div_width_type' => 'px',
			'dcl_count_disable' => 1,
			'dcl_btn_txt' => __( 'Load Comments', DCL_DOMAIN ),
			'dcl_btn_class' => '',
			'dcl_message' => __( 'Loading...', DCL_DOMAIN ),
			'dcl_caching' => 0,
			'dcl_cpt_exclude' => '',
			'dcl_cfasync' => 0,
		);

		// Get existing options if exists.
		$existing = get_option( 'dcl_gnrl_options' );

		// Check if valid dcl settings exist.
		if ( $existing && is_array( $existing ) ) {
			foreach ( $options as $key => $value ) {
				// If value exist for a key, keep them.
				if ( array_key_exists( $key, $existing ) ) {
					$options[ $key ] = $existing[ $key ];
				}
			}
		}

		// Update the plugin options.
		update_option( 'dcl_gnrl_options', $options );

		// Plugin activated date (inaccurate for old activations, but just don't care).
		add_option( 'dcl_activated_time', time() );
	}

}
