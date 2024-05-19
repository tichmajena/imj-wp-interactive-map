<?php
/*
Plugin Name: My Interactive Map
Plugin URI: https://example.com/my-interactive-map
Description: This is a custom interactive map plugin.
Version: 1.0.0
Author: Your Name
Author URI: https://example.com
License: GPL2
*/

$tag = "my_map";

function display_map()
{
    echo ('<div id="app"></div>');
}

add_shortcode($tag, 'display_map');
// Your plugin code goes here
/*
function enqueue_scripts()
{
 
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');
*/
function enqueue_scripts()
{
    wp_enqueue_script_module('map-script', plugin_dir_url(__FILE__) . 'dist/assets/index.js',);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

function enqueue_styles()
{
    wp_enqueue_style('map-style', plugin_dir_url(__FILE__) . 'dist/assets/index.css');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');


require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/user-name/repo-name/',
    __FILE__,
    'unique-plugin-or-theme-slug'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('stable-branch-name');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('your-token-here');

echo "# imj-wp-interactive-map" >> README.md
