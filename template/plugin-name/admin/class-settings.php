<?php
class Plugin_Name_Settings {
	
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		
	}
		
	/**
	 * add_settings_menu
	 *
	 * @return void
	 */
	public function add_settings_menu() {
		add_menu_page(
			__('WordPress Plugin Boilerplate Settings', 'plugin-name'),
			__('WordPress Plugin Boilerplate', 'plugin-name'),
			'manage_options',
			'plugin-name-settings',
			array( $this, 'render_settings_page' ),
			'dashicons-admin-generic',
			100
		);
	}
	
	/**
	 * render_settings_page
	 *
	 * @return void
	 */
	public function render_settings_page() {
		require_once PLUGIN_NAME_PLUGIN_PATH . 'admin/templates/page-settings.php';
	}
}