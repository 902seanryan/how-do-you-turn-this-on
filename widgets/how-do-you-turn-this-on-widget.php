<?php

/**
 * Widget functionality of the plugin
 *
 * @link       902seanryan.com
 * @since      1.0.0
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/widgets
 */

/**
 * Widget functionality of the plugin
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/widgets
 * @author     Sean Ryan <902seanryan@gmail.com>
 *
 */

class How_Do_You_Turn_This_On_Widget extends WP_Widget {



    public function __construct() {
        $widget_ops = array(
            'classname' => 'how_do_you_turn_this_on_widget',
            'description' => 'Widget for displaying AoE II stuff',
        );



        parent::__construct('how_do_you_turn_this_on_widget', 'How_Do_You_Turn_This_On_Widget', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        $http = new How_Do_You_Turn_This_On_HTTP();
        $unit =  ($http->http_get_request('https://age-of-empires-2-api.herokuapp.com/api/v1/unit/'.$instance['unit_display']));
        //$output = '<ul class="individual_item"><li>' . $unit->name . '</li></ul>';
        var_dump($instance['unit_display']);
        //echo $output;
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        $http = new How_Do_You_Turn_This_On_HTTP();
        $unit_display = ! empty( $instance['unit_display'] ) ? $instance['unit_display'] : esc_html__( 'Unit', 'how-do-you-turn-this-on' );
        $unit_names = $http->http_get_request('https://age-of-empires-2-api.herokuapp.com/api/v1/units');
        $unit_names = json_decode(wp_remote_retrieve_body($unit_names))->units;
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'unit_display' ) ); ?>"><?php esc_attr_e( 'Unit:', 'how-do-you-turn-this-on' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'unit_display' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'unit_display' ) ); ?>">
                <?php foreach($unit_names as $unit) {
                    if ($instance['unit_display'] == $unit->id) {
                        echo '<option value=' . $unit->id . ' selected>' . $unit->name . '</option>';
                    } else {
                        echo '<option value=' . $unit->id . '>' . $unit->name . '</option>';
                    }
                }?>
            </select>
        </p>


        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved

        $instance = array();
        $instance['unit_display'] = ( ! empty( $new_instance['unit_display'] ) ) ? sanitize_text_field( $new_instance['unit_display'] ) : '';

        return $instance;
    }




}