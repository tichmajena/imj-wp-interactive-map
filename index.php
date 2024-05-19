<?php
/*
Plugin Name: My Interactive Map
Plugin URI: https://github.com/tichmajena/imj-wp-interactive-map.git
Description: This is a custom interactive map plugin powered by 'D3 JS' and 'Svelte JS'. Use as `Shortcode`, pass the countries as an underscore `_` seperated string. e.g. `[my_map countries="Zimbabwe_Zambia_South Africa_Namibia"]`
Version: 0.1.2
Author: Tich Majena
Author URI: https://github.com/tichmajena/imj-wp-interactive-map/
License: GPL2
*/


$countries;

function display_map($attr)
{
    $options = shortcode_atts([
        'countries' => 'Zimbabwe',
        // Add more parameters here if needed
    ], $attr);
    //$k = array(2) { [0]=> string(35) "countries='[“Zimbabwe”," [1]=> string(21) "“Namibia”" }];
    //updateGlobal($countries, $options);
    // Access the shortcode parameters using $atts['param1'], $atts['param2'], etc.
    //$json = json_encode($options["countries"]);
    return '<div id="app" data-test-"test" data-countries="' .  $options["countries"] . '"></div>';
}


// Your plugin code goes here
/*
function enqueue_scripts()
{
 
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');
*/

function getAttr(&$countries)
{
    return json_encode($countries || ["Zimbabwe"]);
}

function updateGlobal(&$countries, $newValues)
{
    $countries = $newValues;
}

function enqueue_scripts()
{
    wp_enqueue_script_module('map-script', plugin_dir_url(__FILE__) . 'dist/assets/index.js', [], true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

function enqueue_styles()
{
    wp_enqueue_style('map-style', plugin_dir_url(__FILE__) . 'dist/assets/index.css');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

add_shortcode('my_map', 'display_map');

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/tichmajena/imj-wp-interactive-map/',
    __FILE__,
    'imj-wp-interactive-map'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('your-token-here');
