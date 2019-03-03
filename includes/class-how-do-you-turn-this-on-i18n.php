<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       902seanryan.com
 * @since      1.0.0
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/includes
 * @author     Sean Ryan <902seanryan@gmail.com>
 */
class How_Do_You_Turn_This_On_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'how-do-you-turn-this-on',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
