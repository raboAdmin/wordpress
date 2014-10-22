<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/08/14
 * Time: 11:31 AM
 *
 * function prefix & text domain: "rabodirect"
 */

// Load external files
include_once( get_template_directory() . '/inc/rabodirect-shortcodes.php' );

// Setup theme

if( ! function_exists('rabodirect_setup') ) :

	function rabodirect_setup() {
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'header'   => __( 'Header menu', 'rabodirect' ),
			'footer' => __( 'Footer menu', 'rabodirect' ),
		) );
	}

endif;
add_action( 'after_setup_theme', 'rabodirect_setup' );

// Load assets (CSS and JS files
if(! function_exists('rabodirect_enqueue_assets') ) :

function rabodirect_enqueue_assets() {

    // CSS
	wp_enqueue_style( 'rabodirect-style', get_stylesheet_uri() );
//	wp_enqueue_style('rabodirect-main', get_template_directory_uri() . '/css/main.css');

    // JS
	wp_enqueue_script(
		'modernizr',
		get_template_directory_uri() . '/js/vendor/modernizr.custom.rabodirect.js',
		array(),
		'2.8.3'
	);

	// wp_enqueue_script() args reference:

	// 1. Hook/Identifier
	// 2. File path
	// 3. Dependencies
	// 4. Version number
	// 5. Load before closing </body> tag? (Boolean)

	wp_enqueue_script(
		'rabodirect-client',
		get_template_directory_uri() . '/dist/js/rabodirect.min.js',
		array('jquery', 'modernizr'),
		'0.0.1',
		true
	);

	// Make server-side variables available in the client script
    // This is where you switch off the cache
	wp_localize_script('rabodirect-client', 'rabodirectGlobals', array(
		'templateDirectoryURI'      => get_template_directory_uri(),
		'cacheInterestRates'        => true,
		'cacheInterestRatesHours'   => 1
	));

}

add_action('wp_enqueue_scripts', 'rabodirect_enqueue_assets');



endif;

// Remove the "wpautop" filter from ALL editable content
// We shall instead add the filter inside the shortcodes

remove_filter( 'the_content', 'wpautop' );
function wpse_wpautop_nobr( $content ) {
    return wpautop( $content, false );
}

add_filter( 'the_content', 'wpse_wpautop_nobr' );
add_filter( 'the_content', 'wpse_wpautop_nobr' );
//add_filter( 'the_content', 'wpautop' , 99);
//add_filter( 'the_content', 'shortcode_unautop',100 );