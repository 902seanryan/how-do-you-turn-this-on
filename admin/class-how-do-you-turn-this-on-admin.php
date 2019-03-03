<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       902seanryan.com
 * @since      1.0.0
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/admin
 * @author     Sean Ryan <902seanryan@gmail.com>
 */
class How_Do_You_Turn_This_On_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

    /**
     * The options name to be used in this plugin
     *
     * @since  	1.0.0
     * @access 	private
     * @var  	string 		$option_name 	Option name of this plugin
     */
    private $option_name = 'how_do_you_turn_this_on';

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
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/how-do-you-turn-this-on-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/how-do-you-turn-this-on-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Add an options page under the Settings submenu
     *
     * @since  1.0.0
     */
	public function add_options_page() {
        $this->plugin_screen_hook_suffix = add_options_page(
            __( 'How Do I Turn This On Settings', 'how-do-i-turn-this-on' ),
            __( 'How Do I Turn This On', 'how-do-i-turn-this-on' ),
            'manage_options',
            $this->plugin_name,
            array( $this, 'display_options_page' )
        );
    }

    /**
     * Render the options page for plugin
     *
     * @since  1.0.0
     */
    public function display_options_page() {
        include_once 'partials/how-do-you-turn-this-on-admin-display.php';
    }

    public function register_setting() {
        // Add a General section
        add_settings_section(
            $this->option_name . '_general',
            __( 'General', 'how-do-you-turn-this-on' ),
            array( $this, $this->option_name . '_general_cb' ),
            $this->plugin_name
        );


        //individual settings registration
        //civ
        register_setting($this->plugin_name, $this->option_name . '_civ_num', array( $this, $this->option_name . '_sanitize_num' ));
        //units
        register_setting($this->plugin_name, $this->option_name . '_unit_num', array( $this, $this->option_name . '_sanitize_num' ));
        //structures
        register_setting($this->plugin_name, $this->option_name . '_struc_num', array( $this, $this->option_name . '_sanitize_num' ));
        //tech
        register_setting($this->plugin_name, $this->option_name . '_tech_num', array( $this, $this->option_name . '_sanitize_num' ));


        //setting for civilzation display number
        add_settings_field(
            $this->option_name . '_civ_num',
            __( 'Civilizations', 'how-do-i-turn-this-on' ),
            array( $this, $this->option_name . '_num_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_civ_num' , 'id' => $this->option_name . '_civ_num', 'label' => __( 'Number of Civilizations to display when not displaying a specific one (Max = 50)', 'how-do-i-turn-this-on' ))
        );

        //unit display number
        add_settings_field(
            $this->option_name . '_unit_num',
            __( 'Units', 'how-do-i-turn-this-on' ),
            array( $this, $this->option_name . '_num_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_unit_num' , 'id' => $this->option_name . '_unit_num', 'label' => __( 'Number of Units to display when not displaying a specific one (Max = 50)', 'how-do-i-turn-this-on' ))
        );

        //structures display number
        add_settings_field(
            $this->option_name . '_struc_num',
            __( 'Structures', 'how-do-i-turn-this-on' ),
            array( $this, $this->option_name . '_num_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_struc_num' , 'id' => $this->option_name . '_struc_num', 'label' => __( 'Number of Structures to display when not displaying a specific one (Max = 50)', 'how-do-i-turn-this-on' ))
        );

        //technologies display number
        add_settings_field(
            $this->option_name . '_tech_num',
            __( 'Technologies', 'how-do-i-turn-this-on' ),
            array( $this, $this->option_name . '_num_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_tech_num', 'id' => $this->option_name . '_tech_num', 'label' => __( 'Number of Technologies to display when not displaying a specific one (Max = 50)', 'how-do-i-turn-this-on' ))
        );

    }

    public function how_do_you_turn_this_on_num_cb($args) {
        $id = isset( $args['id'] )    ? $args['id']    : '';
        $label_for = isset( $args['label_for'] )    ? $args['label_for']    : '';
        $label = isset( $args['label'] )    ? $args['label']    : '';
        $num = get_option($label_for);

        echo '<input type="number" name="' . $label_for . '" id="' . $id . '" value="' . $num . '"> ';
        echo '<label for="' . $label_for .'">'. $label .'</label>';
    }

    /**
     * Render the text for the general section
     *
     * @since  1.0.0
     */
    public function how_do_you_turn_this_on_general_cb() {
        echo '<p>' . __( 'Please change the settings accordingly.', 'how-do-you-turn-this-on' ) . '</p>';
    }

    /**
     * Sanitize the display count before being saved to database
     *
     * @param  string $position $_POST value
     * @since  1.0.0
     * @return string           Sanitized value
     */
    public function how_do_you_turn_this_on_sanitize_num( $num ) {
        if ($num <= 50 && $num >= 0) {
            return $num;
        } else {
            return 50;
        }
    }

}
