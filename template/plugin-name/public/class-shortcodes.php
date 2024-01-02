<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plugin_Name_Shortcodes {
	
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}
	
	/**
	 * add_shrortcodes
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function add_shortcodes() {
		add_shortcode( 'plugin_name_to_replace_informations', array( $this, 'shortcode_plugin_name_to_replace_informations' ) );
	}
	
	/**
	 * shortcode_plugin_name_to_replace_informations
	 * 
	 * @since    1.0.0
	 * @param  mixed $atts
	 * @return void
	 */
	public function shortcode_plugin_name_to_replace_informations() {
		return 'WordPress Plugin Boilerplate v' . PLUGIN_NAME_VERSION;
	}
}
