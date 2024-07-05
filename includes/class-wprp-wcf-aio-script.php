<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package All In One - Wordpress Custom Functionlity
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wprp_Wcf_Aio_Script {

	function __construct() {

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array( $this, 'wprp_wcf_aio_admin_style_script' ) );

		// Action to add style and script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wprp_wcf_aio_public_style_script' ) );
	}

	/**
	 * Enqueue admin styles & script
	 * 
	 * @package All In One - Wordpress Custom Functionlity
 	 * @since 1.0.0
	 */
	function wprp_wcf_aio_admin_style_script( $hook ) {

		global $typenow, $wp_query, $post_type, $wp_version;
		
		/* Styles */
		// Registring admin css
		wp_register_style( 'wprp-wcf-aio-admin-css', WPRP_WCF_AIO_URL.'assets/css/wprp-wcf-aio-admin.css', array(), WPRP_WCF_AIO_VERSION );

		/* Scripts */
		// Registring admin script
		wp_register_script( 'wprp-wcf-aio-admin-js', WPRP_WCF_AIO_URL.'assets/js/wprp-wcf-aio-admin.js', array( 'jquery' ), WPRP_WCF_AIO_VERSION, true );

		wp_localize_script( 'wprp-wcf-aio-admin-js', 'Wcf_Aio_Admin', array( 
																'ajaxurl'	 	=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ), 
																'no_post_msg' 	=> esc_js( __( 'Sorry, No more post to display.', '	' ) )
															) );
		wp_enqueue_style( 'wprp-wcf-aio-admin-css' );
		wp_enqueue_script( 'wprp-wcf-aio-admin-js' );
	}

	/**
	 * Enqueue public styles & script
	 *  
	 * @package All In One - Wordpress Custom Functionlity
 	 * @since 1.0.0
	 */
	function wprp_wcf_aio_public_style_script() {

		global $typenow, $wp_query, $post_type, $wp_version;

		/* Styles */
		// Registring public css
		wp_register_style( 'wprp-wcf-aio-public-css', WPRP_WCF_AIO_URL.'assets/css/wprp-wcf-aio-public.css', array(), WPRP_WCF_AIO_VERSION );

		/* Scripts */
		// Registring public script
		wp_register_script( 'wprp-wcf-aio-public-js', WPRP_WCF_AIO_URL.'assets/js/wprp-wcf-aio-public.js', array( 'jquery' ), WPRP_WCF_AIO_VERSION, true );

		wp_localize_script( 'wprp-wcf-aio-public-js', 'Wcf_Aio_Public', array( 
																'ajaxurl'	 	=> admin_url( 'public-ajax.php', ( is_ssl() ? 'https' : 'http' ) ), 
																'no_post_msg' 	=> esc_js( __( 'Sorry, No more post to display.', '	' ) )
															) );
			
		wp_enqueue_style( 'wprp-wcf-aio-public-css' );
		wp_enqueue_script( 'wprp-wcf-aio-public-js' );
	}
	
}

$wcf_aio_script = new Wprp_Wcf_Aio_Script();