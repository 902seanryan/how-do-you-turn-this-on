<?php

/**
 * HTTP Request functionality of the plugin
 *
 * @link       902seanryan.com
 * @since      1.0.0
 *
 * @package    How_Do_You_Turn_This_On
 * @subpackage How_Do_You_Turn_This_On/inlcudes
 */

class How_Do_You_Turn_This_On_HTTP {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct() {

    }

// example: GET request
    public function http_get_request($url)
    {

        $url = esc_url_raw($url);

        $args = array('user-agent' => 'How Do You Turn This On: HTTP API; ' . home_url());

        return wp_safe_remote_get($url, $args);

    }

// example: GET response
    public function http_get_response($url)
    {


        $response = $this->http_get_request($url);
        // response data
        $body = json_decode(wp_remote_retrieve_body($response));

        return $this->format_http_response($body);

    }

    public function format_http_response($obj) {

        if (isset($obj->structures)) {

            $i = 0;
            $structs= $obj->structures;
            $content = '<ul class="full_list">';
            $num = get_option('how_do_you_turn_this_on_struc_num');
            foreach($structs as $struct) {
                if ($i >= $num) {
                    break;
                }
                $i++;
                $content .= '<h3>Structures</h3><ul class="individual_item">';
                $content .= '<li>Structure: ' . $struct->name . '</li>';
                $content .= '<li>Expansion: ' . $struct->expansion. '</li>';
                $content .= '<li>Age: ' . $struct->age. '</li>';

                $content .= '</ul>'; // end of individual civ display
            }
            $content .= '</ul>'; // end of whole list
        } else if (isset($obj->civilizations)) {
            $i = 0;
            //$content = $this->http_get_response('https://age-of-empires-2-api.herokuapp.com/api/v1/units');
            $civs = $obj->civilizations;
            $content = '<h3>Civilizations</h3><ul class="full_list">';
            $num = get_option('how_do_you_turn_this_on_civ_num');
            foreach($civs as $civ) {
                if ($i >= $num) {
                    break;
                }
                $i++;
                $content .= '<ul class="individual_item">';
                $content .= '<li>Civilization: ' . $civ->name . '</li>';
                $content .= '<li>Expansion: ' . $civ->expansion. '</li>';
                $content .= '<li>Army Type: ' . $civ->army_type. '</li>';
                $content .= '<li>Expansion: ' . $civ->expansion. '</li>';

                $content .= '</ul>'; // end of individual civ display
            }
            $content .= '</ul>'; // end of whole list
        } else if (isset($obj->units)) {
            $i = 0;
            $units = $obj->units;
            $content = '<h3>Units</h3><ul class="full_list">';
            $num = get_option('how_do_you_turn_this_on_unit_num');
            foreach($units as $unit) {
                if ($i >= $num) {
                    break;
                }
                $i++;
                $content .= '<ul class="individual_item">';
                $content .= '<li>Unit: ' . $unit->name . '</li>';
                $content .= '<li>Description: ' . $unit->description . '</li>';
                $content .= '<li>Expansion: ' . $unit->expansion. '</li>';
                $content .= '<li>Age: ' . $unit->age. '</li>';

                $content .= '</ul>'; // end of individual civ display
            }
            $content .= '</ul>'; // end of whole list
        } else if (isset($obj->technologies)) {
            $i = 0;
            $techs = $obj->technologies;
            $content = '<h3>Technologies</h3><ul class="full_list">';
            $num = get_option('how_do_you_turn_this_on_tech_num');
            foreach($techs as $tech) {
                if ($i >= $num) {
                    break;
                }
                $i++;
                $content .= '<ul class="individual_item">';
                $content .= '<li>Technology: ' . $tech->name . '</li>';
                $content .= '<li>Description: ' . $tech->description . '</li>';
                $content .= '<li>Expansion: ' . $tech->expansion. '</li>';
                $content .= '<li>Age: ' . $tech->age. '</li>';

                $content .= '</ul>'; // end of individual civ display
            }
            $content .= '</ul>'; // end of whole list
        } else {
            $i = 0;
            $structs= json_decode(wp_remote_retrieve_body(wp_safe_remote_get('https://age-of-empires-2-api.herokuapp.com/api/v1/structures')))->structures;
            $content = '<ul class="full_list">';
            $num = get_option('how_do_you_turn_this_on_struc_num');
            foreach($structs as $struct) {
                if ($i >= $num) {
                    break;
                }
                $i++;
                $content .= '<ul class="individual_item">';
                $content .= '<li>Structure: ' . $struct->name . '</li>';
                $content .= '<li>Expansion: ' . $struct->expansion. '</li>';
                $content .= '<li>Age: ' . $struct->age. '</li>';

                $content .= '</ul>'; // end of individual civ display
            }
            $content .= '</ul>'; // end of whole list
        }

        return $content;

    }

}