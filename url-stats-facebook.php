<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/url-stats-from-facebook/
 * @since             1.0.1
 * @package           URL-Stats-Facebook
 *
 * @wordpress-plugin
 * Plugin Name:       URL Stats from Facebook
 * Plugin URI:        https://github.com/SKempin/url-stats-from-facebook
 * Description:       Easily embed the Facebook like, share and comment counts of any URL via Wordpress shortcodes.
 * Version:           1.0.1
 * Author:            Stephen Kempin
 * Author URI:        http://www.stephenkempin.co.uk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       URL-Stats-Facebook
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
// function activate_Plugin_Name() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-activator.php';
// 	Plugin_Name_Activator::activate();
// }

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
// function deactivate_Plugin_Name() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
// 	Plugin_Name_Deactivator::deactivate();
// }

// register_activation_hook( __FILE__, 'activate_Plugin_Name' );
// register_deactivation_hook( __FILE__, 'deactivate_Plugin_Name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/usf.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_usf() {

	$plugin = new usf();
	$plugin->run();

}
run_usf();



// Add plugin options page
include_once plugin_dir_path( __FILE__ ) . 'admin/partials/usf-admin-display.php';
function usf_settings() {
    add_menu_page('URL Stats FB', 'URL Stats FB', 'administrator', 'usf_settings', 'usf_display_settings',  'dashicons-facebook');
}
add_action('admin_menu', 'usf_settings');



/** @var array|WP_Error $response */
// $response = wp_remote_get( 'https://graph.facebook.com/v2.7/muse/?fields=about%2Cfan_count%2Ctalking_about_count%2Ccheckins%2Cwere_here_count%2Cposts.limit(1)%2Cratings.limit(1)&access_token=EAACEdEose0cBAFR6HHhntqWaamOjvV9K7w2aC7FZB5PKQkVkZBP5mGK0NoVuRGZC4mVuH6n9wzZC1lGLsEihZBh1xJnQuZBZBuI4uG0bzGYdnTdAZCoZA0ZAL0kD0C3S0Gr39XF7TWVyPBaKZAK5CkD5SvEUoZB9dCVDfKRJSVNZCNANW0QZDZD' );

// if ( is_array( $response ) && ! is_wp_error( $response ) ) {
//     $headers = $response['headers']; // array of http header lines
//     $body    = $response['body']; // use the content
// }
// // echo $body;
// $arrayfb = json_decode($body, true);

// print_r($arrayfb);
// echo "fan count is".$arrayfb['fan_count'];
// echo "TEST count is".$arrayfb['posts']['data'][0]['message'];

// $test = explode(':', $body);
// // $cars = array($body);
// print_r($test);

// $test2 = json_encode($body);
// echo $test2;

// $response = wp_remote_retrieve_body( 'https://graph.facebook.com/v2.7/theanthemics/?fields=about%2Cfan_count%2Ctalking_about_count%2Ccheckins%2Cwere_here_count%2Cposts.limit(1)%2Cratings.limit(1)&access_token=EAACEdEose0cBAOuiV56bXdRyG9sZAH94WEEDIWxvDx8SCeGZBNf4Tw7lV20Stw6uUUPAIW5h5HdYiLqVUocV81ntdQYTrJrERbMNFsXdZCZB3Difl4KbKywnkNtHqS8DNZAAaXNaZCvgOqyHlgS68HkPx4n1UIY5naJfTtIZCmy7wZDZD' );
// print_r($response);


// $at = get_option('at');

// Query for page statistics
function usf_dataCheck($url) {


    // $response = wp_remote_get( 'https://graph.facebook.com/v2.7/muse/?fields=about%2Cfan_count%2Ctalking_about_count%2Ccheckins%2Cwere_here_count%2Cposts.limit(1)%2Cratings.limit(1)&access_token=EAACEdEose0cBAFR6HHhntqWaamOjvV9K7w2aC7FZB5PKQkVkZBP5mGK0NoVuRGZC4mVuH6n9wzZC1lGLsEihZBh1xJnQuZBZBuI4uG0bzGYdnTdAZCoZA0ZAL0kD0C3S0Gr39XF7TWVyPBaKZAK5CkD5SvEUoZB9dCVDfKRJSVNZCNANW0QZDZD' );

    // $fbg_response = wp_remote_get( 'https://graph.facebook.com/v2.7/'.$url.'/?fields=about%2Cfan_count%2Ctalking_about_count%2Ccheckins%2Cwere_here_count%2Cposts.limit(1)%2Cratings.limit(1)&access_token=EAACEdEose0cBAFR6HHhntqWaamOjvV9K7w2aC7FZB5PKQkVkZBP5mGK0NoVuRGZC4mVuH6n9wzZC1lGLsEihZBh1xJnQuZBZBuI4uG0bzGYdnTdAZCoZA0ZAL0kD0C3S0Gr39XF7TWVyPBaKZAK5CkD5SvEUoZB9dCVDfKRJSVNZCNANW0QZDZD' );


$token = 'EAACEdEose0cBAPnVCFL7vHbMBlZAxWjkSfofGVgB5j3XiZBvZBKeTpt8hhluegorIz3T5YDS30fuGbyt0ZB56IAGKzZCAUgDbDcQGXQv8QNN9ELYmMQOeZBtqbY5DVkgt2c4YWNfMUXaG4ZBZAXYaLlwtnhzfAgAIydWtb7J9MYXOQZDZD';
    $fbg_response = wp_remote_get( 'https://graph.facebook.com/v2.7/'.$url.'/?fields=about%2Cfan_count%2Ctalking_about_count%2Ccheckins%2Cwere_here_count%2Cposts.limit(1)%2Cratings.limit(1)&access_token='.$token.'');

// print_r($fbg_response);


if ( is_array( $fbg_response ) && ! is_wp_error( $fbg_response ) ) {
    $headers = $fbg_response['headers']; // array of http header lines
    $body = $fbg_response['body']; // use the content
}

 $GLOBALS [$fbg_array] = json_decode($body, true);


// $fbg_array = json_decode($body, true);

 // echo $fbg_array;

// set_transient( 'facebook_test', $fbg_array, 0 );


// print_r($GLOBALS [$fbg_array]);

}


// Get URL option from admin
$page = get_option('usf_page_url');



// $read_facebook = get_transient( 'facebook_test' );

// print_r($read_facebook);

// echo "TEST".$GLOBALS [$fbg_array];

// Generate Shortcodes
$shortcode_pageURL = $page;

usf_dataCheck($shortcode_pageURL);




// // likes shortcode
function usf_likes() {
	global $shortcode_pageURL;
	echo '<span class="usf-likes">'.$GLOBALS [$fbg_array]['fan_count'].'</span>';
}
add_shortcode('usf_likes', 'usf_likes');


// // shares shortcode
function usf_shares() {
	global $shortcode_pageURL;
	$counts_array = usf_dataCheck($shortcode_pageURL);
	echo '<span class="usf-shares">'.$counts_array[1][1].'</span>';
}
add_shortcode('usf_shares', 'usf_shares');


// // comments shortcode
// function usf_comments() {
// 	global $shortcode_pageURL;
// 	$counts_array = usf_dataCheck($shortcode_pageURL);
// 	echo '<span class="usf-comments">'.$counts_array[2][1].'</span>';
// }
// add_shortcode('usf_comments', 'usf_comments');