<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       902seanryan.com
 * @since      1.0.0
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/public
 * @author     Sean Ryan <902seanryan@gmail.com>
 */

class How_Do_You_Turn_This_On_Public {

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

	/*
	 * API Call URL constants
	 */

	private $API_CIVILIZATIONS_URL = 'https://age-of-empires-2-api.herokuapp.com/api/v1/civilizations';
    private $API_UNITS_URL = 'https://age-of-empires-2-api.herokuapp.com/api/v1/units';
    private $API_TECHNOLOGIES_URL = 'https://age-of-empires-2-api.herokuapp.com/api/v1/technologies';
    private $API_STRUCTURES_URL = 'https://age-of-empires-2-api.herokuapp.com/api/v1/structures';

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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in How_Do_You_Turn_This_On_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The How_Do_You_Turn_This_On_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/how-do-you-turn-this-on-public.css', array(), $this->version, 'all' );

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
		 * An instance of this class should be passed to the run() [how-do-you-turn-this-on]function
		 * defined in How_Do_You_Turn_This_On_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The How_Do_You_Turn_This_On_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/how-do-you-turn-this-on-public.js', array( 'jquery' ), $this->version, false );

	}

	/*
	 * Shortcode init function
	 */
	public function hdytto_shortcode_init() {
	    function hdytto_shortcode($atts = [], $content = null, $tag = '') {

	        $http = new How_Do_You_Turn_This_On_HTTP();

            //TODO: implement call backs to display the actual content correctly to make the output cleaner

            $hydtto_atts = shortcode_atts([
                'cat' =>'civ'], $atts, $tag);

            switch ($hydtto_atts['cat']) {
                case 'civ':
                    $content = $http->http_get_response('https://age-of-empires-2-api.herokuapp.com/api/v1/civilizations');
                    break;
                case 'unit':
                    $content = $http->http_get_response('https://age-of-empires-2-api.herokuapp.com/api/v1/units');
                    break;
                case 'struct':
                    $content = $http->http_get_response('https://age-of-empires-2-api.herokuapp.com/api/v1/structures');
                    break;
                case 'tech':
                    $content = $http->http_get_response('https://age-of-empires-2-api.herokuapp.com/api/v1/technologies');
                    break;
                default:
                    $content = $http->http_get_response('https://age-of-empires-2-api.herokuapp.com/api/v1/civilizations');
            }
	        return $content;
        }
        add_shortcode($this->plugin_name, 'hdytto_shortcode');
    }


    public function how_do_you_turn_this_on_register_widgets() {
        register_widget('How_Do_You_Turn_This_On_Widget');
    }




}

