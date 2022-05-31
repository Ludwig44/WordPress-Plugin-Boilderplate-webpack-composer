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
class Plugin_Name_Cron_Job {

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
	 * The taxonomy.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $taxonomy    The taxonomy where you want to put the image.
	 * @var      array    $taxonomy    The taxonomies where you want to put the image.
	 */
	private $taxonomy;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string   $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_filter('cron_schedules', [$this, 'crons_registrations'] );

		$crons = self::plugin_name_to_replace_crons_list();
		
		foreach ( $crons as $cron_name => $cron_settings ) {
			add_action( 'plugin_name_to_replace_'. $cron_name .'_hook', array($this, 'crons_scripts') );
		}
		
		add_action('wp', [$this, 'plugin_name_to_replace_cron_events'] );
		
	}
	
	/**
	 * List of all crons
	 *
	 * @since    1.0.0
	 * @return array
	 */
	public function plugin_name_to_replace_crons_list():array {
		return array(
			/*
			'exemple' => array(
				"file_path" => "admin/cron/exemple.php",
				'interval' 	=> HOUR_IN_SECONDS * 24,
				'display' 	=> __( 'Exemple of description', PLUGIN_NAME_TEXT_DOMAIN )
			)
			*/
		);
	}

	/**
	* This function allows you to define the recurrence of the cron task for user payments.
	*
	* @since    1.0.0
	*/
    public function crons_registrations($schedules) {
		$crons = self::plugin_name_to_replace_crons_list();
		foreach ( $crons as $cron_name => $cron_settings ) {
			$schedules[ $cron_name ] = array(
				'interval' => $cron_settings['interval'], 
				'display'  => $cron_settings['display']
			);
		}
		return $schedules;
    }
	
	/**
	 * Include crons scripts
	 *
	 * @since    1.0.0
	 * @param  mixed $cron_name
	 * @return void
	 */
	public function crons_scripts( $cron_name ) {
		$crons = self::plugin_name_to_replace_crons_list();
		$is_cron_job = true;
		include plugin_dir_path( dirname( __FILE__ ) ) . $crons[$cron_name]['file_path'];
	}

	/**
	* This function allows you to start the next cron job.
	*
	* @since    1.0.0
	*/
    public function plugin_name_to_replace_cron_events() {
		$crons = self::plugin_name_to_replace_crons_list();
		foreach ($crons as $cron_name => $cron_settings) {
			if ( ! wp_next_scheduled( 'plugin_name_to_replace_'. $cron_name .'_hook', array($cron_name) ) ) {
				wp_schedule_event( time(), $cron_name, 'plugin_name_to_replace_'. $cron_name .'_hook', array($cron_name) );
			}
		}
    }

}
