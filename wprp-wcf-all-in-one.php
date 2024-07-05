<?php 
/**
 * Plugin Name: All In One - Wordpress Custom Functionlity
 * Description: Created Custom Functionlity for all wordpress defualt Functionlity for develope custom Functionlity.
 * Version: 1.0.0
 * Author: Rahul Prajapati
 * Text Domain: wprp-wcf-aio
 * Author URI: https://github.com/rahuldevphp/
 * Plugin URI: https://github.com/rahuldevphp/ 
 * 
 * @package All In One - Worpress Custom Functionlity
 * @author Rahul Prajapati 
 * 
 * prefix text "_wprp_wcf_aio_"
 */

if( ! defined( 'WPRP_WCF_AIO_VERSION' ) ) {
	define( 'WPRP_WCF_AIO_VERSION', '1.0.0' ); // Version of plugin
}

if( ! defined( 'WPRP_WCF_AIO_DIR' ) ) {
	define( 'WPRP_WCF_AIO_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( ! defined( 'WPRP_WCF_AIO_URL' ) ) {
	define( 'WPRP_WCF_AIO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}

if( ! defined( 'WPRP_WCF_AIO_PLUGIN_BASENAME' ) ) {
	define( 'WPRP_WCF_AIO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}

if( ! defined( 'WPRP_WCF_AIO_POST_TYPE' ) ) {
	define( 'WPRP_WCF_AIO_POST_TYPE', 'blog_post' ); // Plugin post type
}

if( ! defined( 'WPRP_WCF_AIO_CAT' ) ) {
	define( 'WPRP_WCF_AIO_CAT', 'blog-category' ); // Plugin category name
}

if( ! defined( 'WPRP_WCF_AIO_META_PREFIX' ) ) {
	define( 'WPRP_WCF_AIO_META_PREFIX', '_wprp_wcf_aio_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain and do stuff once all plugin is loaded
 * This gets the plugin ready for translation
 * 
 * @package All In One - Worpress Custom Functionlity
 * @since 1.0.0
 */
function wprp_wcf_aio_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$wprp_wcf_aio_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wprp_wcf_aio_lang_dir = apply_filters( 'wprp_wcf_aio_languages_directory', $wprp_wcf_aio_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'wprp-wcf-aio' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'wprp-wcf-aio', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPRP_WCF_AIO_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'wprp-wcf-aio', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'wprp-wcf-aio', false, $wprp_wcf_aio_lang_dir );
	}
}

/**
 * Plugins Load functions 
 * 
 * @package All In One - Worpress Custom Functionlity
 * @since 1.0.0
 */
function wprp_wcf_aio_blog_plugin_loaded() {

	global $pagenow;

	wprp_wcf_aio_load_textdomain();	
}

add_action('plugins_loaded', 'wprp_wcf_aio_blog_plugin_loaded');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package All In One - Worpress Custom Functionlity
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wprp_wcf_aio_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package All In One - Worpress Custom Functionlity
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wprp_wcf_aio_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package All In One - Worpress Custom Functionlity
 * @since 1.0.0
 */
function wprp_wcf_aio_install() {

	// Install functionality
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package All In One - Worpress Custom Functionlity
 * @since 1.0.0
 */
function wprp_wcf_aio_uninstall() {
	// Uninstall functionality
}

// Functions file
require_once( WPRP_WCF_AIO_DIR . '/includes/wprp-wcf-aio-functions.php' );

// Plugin Post type file
require_once( WPRP_WCF_AIO_DIR . '/includes/wprp-wcf-aio-post-types.php' );

// Script Class
require_once( WPRP_WCF_AIO_DIR . '/includes/class-wprp-wcf-aio-script.php' );

// Public Class
require_once( WPRP_WCF_AIO_DIR . '/includes/class-wprp-wcf-aio-public.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {

	// Admin Class
	require_once( WPRP_WCF_AIO_DIR . '/includes/admin/class-wprp-wcf-aio-admin.php' );
}

?>