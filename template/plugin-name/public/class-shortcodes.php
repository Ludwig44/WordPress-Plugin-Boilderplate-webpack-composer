<?php

/**
 * Add shortcodes for Plugin Name.
 *
 * @link       http://example.com/
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */
class Plugin_Name_Shortcodes {

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
