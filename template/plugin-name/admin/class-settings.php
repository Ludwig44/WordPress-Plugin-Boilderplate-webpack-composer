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
	 * settings_fields
	 *
	 * @return void
	 */
	public function settings_fields(){
		return array(
			'sample_of_text_field' => array(
				'type' => 'text',
				'label' => __( "Sample of text field", PLUGIN_NAME_TEXT_DOMAIN ),
				'description' => __( "Sample of description this parameter is not required", PLUGIN_NAME_TEXT_DOMAIN )
			),
			'sample_of_email_field' => array(
				'type' => 'email',
				'label' => __( "Sample of email field", PLUGIN_NAME_TEXT_DOMAIN )
			),
			'sample_of_select_field' => array(
				'type' 				   => 'select',
				'label' 			   => __( "Sample of select field", PLUGIN_NAME_TEXT_DOMAIN ),
				'select_default_label' => __( "Default with empty value", PLUGIN_NAME_TEXT_DOMAIN ),
				'select_options' 	   => array(
					'sample_of_value' 	=> __( "Sample of label", PLUGIN_NAME_TEXT_DOMAIN ),
					'sample_of_value_2' => __( "Other sample of label", PLUGIN_NAME_TEXT_DOMAIN ),
				),
			),
			'sample_of_textarea_field' => array(
				'type' => 'textarea',
				'label' => __( "Sample of textarea field", PLUGIN_NAME_TEXT_DOMAIN )
			),
			'sample_of_checkbox_field' => array(
				'type' => 'checkbox',
				'label' => __( "Sample of checkbox field", PLUGIN_NAME_TEXT_DOMAIN ),
				'unchecked_value' => false,
				'checkbox_values' => array(
					'first_value' => __( "First value label", PLUGIN_NAME_TEXT_DOMAIN ),
					'second_value' => __( "Second value label", PLUGIN_NAME_TEXT_DOMAIN ),
				)
			),
			'sample_of_radio_field' => array(
				'type' => 'radio',
				'label' => __( "Sample of radio field", PLUGIN_NAME_TEXT_DOMAIN ),
				'radio_values' => array(
					'first_value' => __( "First value label", PLUGIN_NAME_TEXT_DOMAIN ),
					'second_value' => __( "Second value label", PLUGIN_NAME_TEXT_DOMAIN ),
				)
			),
			'sample_of_toggle_field' => array(
				'type' => 'toggle',
				'label' => __( "Sample of toggle field", PLUGIN_NAME_TEXT_DOMAIN ),
			),
		);
	}

	
	/**
	 * enqueue_settings_scripts
	 *
	 * @return void
	 */
	public function enqueue_settings_scripts(){
		wp_enqueue_style( PLUGIN_NAME_TEXT_DOMAIN . '-settings-style', PLUGIN_NAME_PLUGIN_URL . 'admin/css/page-settings.css', array(), PLUGIN_NAME_VERSION, 'all' );
	}
	
	/**
	 * add_settings_menu
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function add_settings_menu() {
		add_menu_page( 
			__('WordPress Plugin Boilerplate', PLUGIN_NAME_TEXT_DOMAIN),
			__('WordPress Plugin Boilerplate', PLUGIN_NAME_TEXT_DOMAIN),
			'manage_options',
			'plugin-name-settings',
			array($this, 'render_settings_page'),
			'dashicons-admin-generic',
			3
		);
	}
	
	/**
	 * render_settings_page
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function render_settings_page(){
		self::enqueue_settings_scripts();
		self::save_settings_fields();
		include_once( PLUGIN_NAME_PLUGIN_PATH . 'admin/templates/page-settings.php' );
	}
	
	/**
	 * render_fields
	 *
	 * @return void
	 */
	public function render_fields(){
		foreach ( self::settings_fields() as $key => $options ) {
			if( isset( $options[ 'type' ], $options[ 'label' ] ) ){
				$default 	 		  = $options['default'] ?? '';
				$select_default_label = $options['select_default_label'] ?? '';
				$value 		 		  = get_option( $key, $default);
				$description 		  = isset( $options['description'] ) ? '<p class="description">'. $options['description'] .'</p>' : '';
				switch ( $options['type'] ) {
					case 'select':
						$input = '<select name="'. $key .'" id="'. $key .'">';
						$input .= '<option value="" '. selected( '', $value, false ) .'>'. $select_default_label . '</option>'; 
						if( isset( $options['select_options'] ) && is_array( $options['select_options'] ) ){
							foreach ($options['select_options'] as $option_value => $option_label) {
								$input .= '<option value="'. $option_value .'" '. selected( $option_value, $value, false ) .'>'. $option_label . '</option>'; 
							}
						}
						$input .= '</select>';
						break;

					case 'textarea':
						$input = '<textarea name="'. $key .'" id="'. $key .'">'. $value .'</textarea>';
						break;
					
					case 'checkbox':
						$unchecked_value = $options['unchecked_value'] ?? false;
						$checkbox_values = $options['checkbox_values'] ?? array();
						$input = '<input type="hidden" name="'. $key .'" value="'. $unchecked_value .'">';
						$input .= '<ul class="checkbox-values">';
						foreach ( $checkbox_values as $checkbox_value => $checkbox_name ) {
							$value_to_compare = is_array( $value ) ? $value : array();
							$checked = in_array( $checkbox_value, $value_to_compare ) ? 'checked="checked"' : '';
							$input .= '<li>';
							$input .= '<label><input type="' . $options['type'] .'" name="'. $key .'[]" id="'. $key . '-' . $checkbox_value .'" value="'. $checkbox_value .'" '. $checked .'>'. $checkbox_name .'</label>';
							$input .= '</li>';
						}
						$input .= '</ul>';
						break;
					
					case 'radio':
						$radio_values = $options['radio_values'] ?? array();
						$input = '<ul class="radio-values">';
						foreach ( $radio_values as $radio_value => $radio_name ) {
							$input .= '<li>';
							$input .= '<label><input type="' . $options['type'] .'" name="'. $key .'" id="'. $key . '-' . $radio_value .'" value="'. $radio_value .'" '. checked( $radio_value, $value, false ) .'>'. $radio_name .'</label>';
							$input .= '</li>';
						}
						$input .= '</ul>';
						break;
					
					case 'toggle':
						$unchecked_value = $options['unchecked_value'] ?? false;
						$checked_value 	 = $options['checkbox_value'] ?? true;
						$input = '<input type="hidden" name="'. $key .'" value="'. $unchecked_value .'">';
						$input .= '<label class="switch"><input type="checkbox" name="'. $key .'" id="'. $key .'" value="'. $checked_value .'" '. checked( $checked_value, $value, false ) .'><span class="slider round"></span></label>';
						break;

					default:
						$input = '<input type="' . $options['type'] .'" name="'. $key .'" id="'. $key .'" value="'. $value .'">';
						break;
				}
				?>
				<tr>
					<th><?php echo $options['label']; ?></th>
					<td>
						<?php echo $input . $description; ?>
					</td>
				</tr>
				<?php
			}
		}
	}
	
	/**
	 * save_settings_fields
	 *
	 * @return void
	 */
	public function save_settings_fields(){
		foreach ( self::settings_fields() as $key => $options ) {
			if( isset( $_POST[ $key ] ) ){
				update_option( $key, $_POST[ $key ] );
			}
		}
	}
}
