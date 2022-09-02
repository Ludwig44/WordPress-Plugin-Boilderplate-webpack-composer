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
	 * Array contains all pages and their settings
	 *
	 * @return array
	 */
	public function menu_pages_array(){

		return array(
			'my_plugin_settings' => array(
				'title' 		=> __( 'My plugin Settings', PLUGIN_NAME_TEXT_DOMAIN ),
				'capability'	=> 'manage_options',
				'callback'		=> 'render_menu_page',
				'position'		=> 1,
				'icon'			=> 'dashicons-portfolio',
				'tabs'	=> array(
					'tab01_options' => array(
						'title' 	=> __( 'Tab 01', PLUGIN_NAME_TEXT_DOMAIN ),
						'sections'	=> array(
							'first_section_id' => array(
								'title'		=> __( 'First Section', PLUGIN_NAME_TEXT_DOMAIN ),
								'callback'	=> 'first_section_callback',
								'fields'	=> array(
									'my_first_name' => array(
										'label'			=> __( 'First Name', PLUGIN_NAME_TEXT_DOMAIN ),
										'sanitize'		=> 'sanitize_input',
										'args'			=> array(
											'placeholder'	=> __( 'Enter your first name', PLUGIN_NAME_TEXT_DOMAIN ),
											'description'	=> __( 'This is a description', PLUGIN_NAME_TEXT_DOMAIN )
										),
									),
									'my_last_name'	=> array(
										'label'			=> __( 'Last Name', PLUGIN_NAME_TEXT_DOMAIN ),
										'args'			=> array(
											'placeholder'	=> __( 'Enter your last name', PLUGIN_NAME_TEXT_DOMAIN )
										)
									),
									'my_email' => array(
										'label'			=> __( 'Email', PLUGIN_NAME_TEXT_DOMAIN ),
										'args'			=> array(
											'type'		=> 'email'
										)
									),
									'my_select'	=> array(
										'label'			=> __( 'Select', PLUGIN_NAME_TEXT_DOMAIN ),
										'callback'		=> 'render_select',
										'args'			=> array(
											'description'	=>  __( 'This is a description', PLUGIN_NAME_TEXT_DOMAIN ),
											'default'	=> __( 'Select an option', PLUGIN_NAME_TEXT_DOMAIN ),
											'options'	=> array(
												'option01'	=> __( 'Option 01', PLUGIN_NAME_TEXT_DOMAIN ),
												'option02'	=> __( 'Option 02', PLUGIN_NAME_TEXT_DOMAIN ),
												'option03'	=> __( 'Option 03', PLUGIN_NAME_TEXT_DOMAIN ),
												'option04'	=> __( 'Option 04', PLUGIN_NAME_TEXT_DOMAIN ),
											)
										)
									)
								)
							),
							'second_section_id' => array(
								'title'		=> __( 'second Section', PLUGIN_NAME_TEXT_DOMAIN ),
								'fields'	=> array(
									'my_textarea'	=> array(
										'label'			=> __( 'Textarea', PLUGIN_NAME_TEXT_DOMAIN ),
										'callback'		=> 'render_textarea',
										'args'			=> array(
											'placeholder'	=> __( 'Enter your text', PLUGIN_NAME_TEXT_DOMAIN ),
											'description'	=>  __( 'This is a description', PLUGIN_NAME_TEXT_DOMAIN )
										)
									),
									'my_checkbox'	=> array(
										'label'			=> __( 'Checkbox', PLUGIN_NAME_TEXT_DOMAIN ),
										'callback'		=> 'render_checkbox',
										'args'			=> array(
											'description'	=>  __( 'This is a description', PLUGIN_NAME_TEXT_DOMAIN )
										)
									),
									'my_radio'	=> array(
										'label'			=> __( 'Radio', PLUGIN_NAME_TEXT_DOMAIN ),
										'callback'		=> 'render_radio',
										'args'			=> array(
											'description'	=>  __( 'This is a description', PLUGIN_NAME_TEXT_DOMAIN ),
											'options'	=> array(
												'option01'	=> __( 'Option 01', PLUGIN_NAME_TEXT_DOMAIN ),
												'option02'	=> __( 'Option 02', PLUGIN_NAME_TEXT_DOMAIN ),
												'option03'	=> __( 'Option 03', PLUGIN_NAME_TEXT_DOMAIN ),
												'option04'	=> __( 'Option 04', PLUGIN_NAME_TEXT_DOMAIN ),
											)
										)
									),
									'my_toggle'	=> array(
										'label'			=> __( 'Toggle', PLUGIN_NAME_TEXT_DOMAIN ),
										'callback'		=> 'render_toggle',
										'args'			=> array(
											'description'	=>  __( 'This is a description', PLUGIN_NAME_TEXT_DOMAIN )
										)
									)
								)
							)
						)
					),
					'tab02_options' => array(
						'title' 	=> __( 'Tab 02', PLUGIN_NAME_TEXT_DOMAIN ),
						'sections'	=> array(
							'first_section_id02' => array(
								'title'		=> __( 'First Section Tab 02', PLUGIN_NAME_TEXT_DOMAIN ),
								'fields'	=> array(
									'my_first_name02' => array(
										'label'			=> __( 'First Name Tab 02', PLUGIN_NAME_TEXT_DOMAIN ),
									),
									'my_last_name02'	=> array(
										'label'			=> __( 'Last Name Tab 02', PLUGIN_NAME_TEXT_DOMAIN ),
										'args'			=> array(
											'placeholder'	=> 'Enter your last name'
										)
									)
								)
							)
						)
					)
				)
			),
			'my_plugin_settings_02' => array(
				'title'		=> __( 'My plugin Settings 02', PLUGIN_NAME_TEXT_DOMAIN ),
				'parent' 	=> 'my_plugin_settings',
			)
		);
	}
		
	/**
	 * Add settings menus
	 *
	 * @return void
	 */
	public function add_settings_menu() {

		foreach ( $this->menu_pages_array() as $page_slug => $page_data ) {

			$this->create_menu_page( $page_slug, $page_data );

			if ( !isset( $page_data['tabs'] ) ) continue;

			foreach ( $page_data['tabs'] as $tab_slug => $tab_data ) {

				if ( !isset( $tab_data['sections'] ) ) continue;

				foreach ( $tab_data['sections'] as $section_slug => $section_data ) {
					
					$this->create_section( $tab_slug, $section_slug, $section_data );

					if ( !isset( $section_data['fields'] ) ) continue;

					foreach ( $section_data['fields'] as $field_slug => $field_data ) {

						$this->create_field( $tab_slug, $section_slug, $field_slug, $field_data );
					}
				}
			}
		}

	}
	
	/**
	 * Create a menu page
	 *
	 * @return void
	 */
	public function create_menu_page( $page_slug, $page_data ) {

		$page_title			= isset( $page_data['title'] ) ? $page_data['title'] : '';
		$page_parent		= isset( $page_data['parent'] ) ? $page_data['parent'] : '';
		$page_capability	= isset( $page_data['capability'] ) ? $page_data['capability'] : 'manage_options';
		$page_callback		= isset( $page_data['callback'] ) ? $page_data['callback'] : 'render_menu_page';
		$page_icon			= isset( $page_data['icon'] ) ? $page_data['icon'] : '';
		$page_position		= isset( $page_data['position'] ) ? $page_data['position'] : null;

		if ( empty( $page_parent ) ) {

			add_menu_page( $page_title, $page_title, $page_capability, $page_slug, array( $this, $page_callback ), $page_icon, $page_position );

		} else {

			add_submenu_page( $page_parent, $page_title, $page_title, $page_capability, $page_slug, array( $this, $page_callback ), $page_position );
		}
	}
	
	/**
	 * Create a section
	 *
	 * @return void
	 */
	public function create_section( $tab_slug, $section_slug, $section_data ) {

		$section_callback	= isset( $section_data['callback'] ) ? array( $this, $section_data['callback'] ) : '__return_empty_string';
		$section_title		= isset( $section_data['title'] ) ? $section_data['title'] : '';

		add_settings_section( $section_slug, $section_title, $section_callback, $tab_slug );
	}
	
	/**
	 * Create a field
	 *
	 * @return void
	 */
	public function create_field( $tab_slug, $section_slug, $field_slug, $field_data ) {

		$field_label			= isset( $field_data['label'] ) ? $field_data['label'] : '';
		$field_callback			= isset( $field_data['callback'] ) ? $field_data['callback'] : 'render_input';
		$fields_args 			= isset( $field_data['args'] ) ? $field_data['args'] : array();
		$fields_args['slug']	= $field_slug;
		$field_sanitize			= isset( $field_data['sanitize'] ) ? array( $this, $field_data['sanitize'] ) : array();
		
		add_settings_field( $field_slug, $field_label, array( $this, $field_callback ), $tab_slug, $section_slug, $fields_args );
		register_setting( $tab_slug, $field_slug, $field_sanitize );
	}

	/**
	 * Render menu page
	 *
	 * @return void
	 */
	public function render_menu_page() {

		wp_enqueue_style( PLUGIN_NAME_TEXT_DOMAIN . '-settings-style', PLUGIN_NAME_PLUGIN_URL . 'admin/css/page-settings.css', array(), PLUGIN_NAME_VERSION, 'all' );

		$page_slug		= isset( $_GET['page'] ) ? $_GET['page'] : '';
		$pages_array	= $this->menu_pages_array();
		$tabs_array 	= isset( $pages_array[$page_slug]['tabs'] ) ? $pages_array[$page_slug]['tabs'] : array();
		$page_title		= isset( $pages_array[$page_slug]['title'] ) ? $pages_array[$page_slug]['title'] : '';
		$active_tab		= isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : key( $tabs_array );

		?>
			<div class="wrap">
				<h2><?php echo $page_title; ?></h2>
				<?php settings_errors(); ?>
				
				<?php if ( count( $tabs_array ) > 1 ): ?>

					<h2 class="nav-tab-wrapper">
						<?php foreach( $tabs_array as $tab_key => $tab_data ): ?>
							<a href="?page=<?php echo $page_slug; ?>&tab=<?php echo $tab_key; ?>" class="nav-tab <?php echo $tab_key == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo isset( $tab_data['title'] ) ?  $tab_data['title'] : '?'; ?></a>
						<?php endforeach; ?>
					</h2>

				<?php endif; ?>

				<form method="post" action="options.php">
					<?php
						
						settings_fields( $active_tab );
						do_settings_sections( $active_tab );

						submit_button();
					?>
				</form>
			</div>
		<?php

	}
	
	/**
	 * Render input field
	 *
	 * @return void
	 */
	public function render_input( $args ) {

		$field_slug		= isset( $args['slug'] ) ? $args['slug'] : '';
		$type			= isset( $args['type'] ) ? $args['type'] : 'text';
		$placeholder	= isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$description	= isset( $args['description'] ) ? $args['description'] : '';
		$saved_value	= get_option( $field_slug );

		?>
			<input type="<?php echo $type; ?>" name="<?php echo $field_slug; ?>" id="<?php echo $field_slug; ?>" value="<?php echo $saved_value; ?>" class="regular-text" placeholder="<?php echo $placeholder; ?>">
			<?php if ( !empty( $description ) ): ?>
				<p class="description"><?php echo $description; ?></p>
			<?php endif; ?>
		<?php
	}
	
	/**
	 * Render select field
	 *
	 * @return void
	 */
	public function render_select( $args ) {

		$field_slug		= isset( $args['slug'] ) ? $args['slug'] : '';
		$field_default	= isset( $args['default'] ) ? $args['default'] : '';
		$field_options	= isset( $args['options'] ) ? $args['options'] : array();
		$description	= isset( $args['description'] ) ? $args['description'] : '';
		$saved_value	= get_option( $field_slug );

		?>
			<select name="<?php echo $field_slug; ?>" id="<?php echo $field_slug; ?>">
				<?php if ( !empty( $field_default ) ): ?>
					<option value=""><?php echo $field_default; ?></option>
				<?php endif; ?>
				<?php foreach( $field_options as $option_value => $option_label ): ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $option_value, $saved_value ); ?> ><?php echo $option_label; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if ( !empty( $description ) ): ?>
				<p class="description"><?php echo $description; ?></p>
			<?php endif; ?>
		<?php
	}
	
	/**
	 * Render textarea field
	 *
	 * @return void
	 */
	public function render_textarea( $args ) {

		$field_slug		= isset( $args['slug'] ) ? $args['slug'] : '';
		$placeholder	= isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$description	= isset( $args['description'] ) ? $args['description'] : '';
		$saved_value	= get_option( $field_slug );

		?>
			<textarea name="<?php echo $field_slug; ?>" id="<?php echo $field_slug; ?>" class="large-text" rows="3" placeholder="<?php echo $placeholder; ?>"><?php echo $saved_value; ?></textarea>
			<?php if ( !empty( $description ) ): ?>
				<p class="description"><?php echo $description; ?></p>
			<?php endif; ?>
		<?php
	}
	
	/**
	 * Render checkbox field
	 *
	 * @return void
	 */
	public function render_checkbox( $args ) {

		$field_slug		= isset( $args['slug'] ) ? $args['slug'] : '';
		$description	= isset( $args['description'] ) ? $args['description'] : '';
		$saved_value	= get_option( $field_slug );

		?>
			<label>
				<input type="checkbox" name="<?php echo $field_slug; ?>" id="<?php echo $field_slug; ?>" <?php checked( 'on', $saved_value ); ?>>
				<?php echo !empty( $description ) ? $description : ''; ?>
			</label>
		<?php
	}
	
	/**
	 * Render radio field
	 *
	 * @return void
	 */
	public function render_radio( $args ) {

		$field_slug		= isset( $args['slug'] ) ? $args['slug'] : '';
		$field_options	= isset( $args['options'] ) ? $args['options'] : array();
		$description	= isset( $args['description'] ) ? $args['description'] : '';
		$saved_value	= get_option( $field_slug );

		?>
			<fieldset>
				<?php foreach( $field_options as $option_value => $option_label ): ?>
					<label>
						<input type="radio" name="<?php echo $field_slug; ?>" value="<?php echo $option_value; ?>" <?php checked( $option_value, $saved_value ); ?>>
						<span><?php echo $option_label; ?></span>
					</label><br>
				<?php endforeach; ?>
				<?php if ( !empty( $description ) ): ?>
					<p class="description"><?php echo $description; ?></p>
				<?php endif; ?>
			</fieldset>
		<?php
	}

	/**
	 * Render toggle field
	 *
	 * @return void
	 */
	public function render_toggle( $args ) {

		$field_slug		= isset( $args['slug'] ) ? $args['slug'] : '';
		$description	= isset( $args['description'] ) ? $args['description'] : '';
		$saved_value	= get_option( $field_slug );

		?>
			<label class="switch">
				<input type="checkbox" name="<?php echo $field_slug; ?>" id="<?php echo $field_slug; ?>" <?php checked( 'on', $saved_value ); ?>>
				<span class="slider round"></span>
			</label>
			<?php if ( !empty( $description ) ): ?>
				<p class="description"><?php echo $description; ?></p>
			<?php endif; ?>
		<?php
	}
	
	/**
	 * Sanitize input field
	 *
	 * @return void
	 */
	public function sanitize_input( $input ) {

		return strip_tags( stripslashes( $input ) );
	}
	
	/**
	 * Render the description of a section
	 *
	 * @return void
	 */
	public function first_section_callback() {

		echo 'This is the dscription of a section';
	}

}