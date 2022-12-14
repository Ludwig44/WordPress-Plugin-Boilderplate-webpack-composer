<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com/
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */
class Plugin_Name_Settings {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
		
	/**
	 * add_settings_menu
	 *
	 * @return void
	 */
	public function add_settings_menu() {
		add_menu_page(
			__('WordPress Plugin Boilerplate Settings', PLUGIN_NAME_TEXT_DOMAIN),
			__('WordPress Plugin Boilerplate', PLUGIN_NAME_TEXT_DOMAIN),
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
		wp_enqueue_style( PLUGIN_NAME_TEXT_DOMAIN . '-settings', PLUGIN_NAME_PLUGIN_URL . 'admin/css/components.css', array(), PLUGIN_NAME_VERSION, 'all' );
		require_once PLUGIN_NAME_PLUGIN_PATH . 'admin/templates/page-settings.php';
	}
	
	/**
	 * render_component
	 *
	 * @param  mixed $data
	 * @return void
	 */
	public function render_component( $data = array() ) {
		$data['type'] 		= $data['type'] ?? 'text';
		$data['name'] 		= $data['name'] ?? '';
		$file_name 			= $data['type'] == 'text' || $data['type'] == 'email' || $data['type'] == 'tel' ? 'text' : $data['type'];
		$path_to_component 	= PLUGIN_NAME_PLUGIN_PATH . 'admin/components/' . $file_name . '.php';

		if( file_exists( $path_to_component ) ) {
			?>
			<tr>
				<th>
					<label for="<?php echo esc_attr( $data['name'] ?? '' ); ?>"><?php echo esc_html( $data['label'] ?? '' ); ?></label>
				</th>
				<td class="<?php echo esc_attr( $data['name'] ?? '' ); ?>-container">
					<?php include $path_to_component; ?>
					<?php if( isset( $data['description'] ) ) { 
						?>
						<p class="description"><?php echo esc_html( $data['description'] ); ?></p>
						<?php 
					} 
					?>
				</td>
			</tr>
			<?php
		}
	}
}