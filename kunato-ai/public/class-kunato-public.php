<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://kunato.ai/
 * @since      1.0.0
 *
 * @package    Kunato
 * @subpackage Kunato/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Kunato
 * @subpackage Kunato/public
 * @author     Kunato <ms@kunato.io>
 */
class Kunato_Public {

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

		add_action( 'wp_head', array( $this, 'dns_prefetch' ), 0 );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Kunato_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Kunato_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/kunato-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Kunato_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Kunato_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/kunato-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Get script URL
	 * 
	 * @since   1.0.0
	 */
	public function get_script_url(){
		$kunato_identification = get_option('kunato_identification'); // User Identifier
		if($kunato_identification == "")
			$kunato_identification = 'generic';

		$script_url = 'https://cdn.zzazz.com/widget/'.$kunato_identification.'/widget.js';
		return $script_url;
	}

	/**
	 * Check if its an AMP page
	 * @param      array    $plugin  (amp => amp blue plugin, ampforwp => amp red plugin)
	 * @since 1.0.0
	 */
	public function is_amp_page($plugin = array('amp', 'ampforwp')){
		
		// function of AMP blue plugin
		if(in_array('amp', $plugin)){
			if(function_exists('amp_is_request')){
				return amp_is_request();
			}
		}

		// Add a function for AMP red plugin
		if(in_array('ampforwp', $plugin)){
			if(function_exists('ampforwp_is_amp_endpoint')){
				return ampforwp_is_amp_endpoint();
			}
		}
		return false;
	}

	/**
	 * Get kunato option settings
	 * 
	 * @since 1.0.0
	 */
	public function get_kunato_settings(){
		$kunato_identification = (get_option('kunato_identification') != "") ? get_option('kunato_identification') : 'generic'; // User Identifier
			
		$kunato_currency = (get_option('kunato_currency') && get_option('kunato_currency') != '') ? get_option('kunato_currency') : 'q';

		$kunato_json_array = array('identifier' => $kunato_identification, 'currency' => $kunato_currency);
		return $kunato_json_array;
	}


	/**
	 * Inject Custom Scripts
	 *
	 * @since    1.0.0
	 */
	public function script_injection(){
		// if the request is AMP, do not add this script
		 ?>
			 <script>window.qxSettings = <?php echo wp_json_encode($this->get_kunato_settings()); ?>;</script>
			 <script type='module' src='<?php echo esc_url($this->get_script_url()); ?>' id='kunato-widget-js'></script>
		<?php
	}

	/**
	 * Print DNS prefetch hint for our CDN at the very top of <head>
	 *
	 * @since 1.0.0
	 */
	public function dns_prefetch() {
		echo "<link rel='dns-prefetch' href='//cdn.zzazz.com' />\n";
	}

}
