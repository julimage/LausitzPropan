<?php
/**
 * Plugin Name: 	Divi Breadcrumbs Module
 * Plugin URI:		https://divibreadcrumbs.com
 * Description:		This plugin adds a Divi Builder Module which generates breadcrumb navigation menus. Each breadcrumb nav is highly customizable to suit every style imaginable.
 * Version: 		1.2.0
 * Author:			CODECRATER
 * Author URI: 		https://divicake.com/author/CODECRATER/
 *
*/

if ( ! defined( 'ABSPATH' ) ) exit;

	
	/**
	 * Adds a hook to the et_builder_ready action. The dcsbcm_Init_Custom_Module function then checks if the Builder Module class exists and if true, runs the new module class.
	 * @since  1.2.0
	*/
	function dcsbcm_Init_Custom_Module() {
		if ( ! class_exists( 'ET_Builder_Module' ) ) { return; }
		require_once( 'includes/dcsbcm-module.php' );
	}
	add_action('et_builder_ready', 'dcsbcm_Init_Custom_Module');
	
	
	/**
	 * Enqueue Admin Styles
	 * @since  1.0.0
	*/
	add_action('admin_footer', 'dcsbcm_admin_scripts');
	function dcsbcm_admin_scripts() {
		echo '<style type="text/css">';
		echo 'li.et_pb_dcsbcm_divi_breadcrumbs_module{background-color:#ff009c !important;color:#fff !important;}';
		echo 'input#et_pb_divi_cake{display:none}'.'li.et_pb_dcsbcm_divi_breadcrumbs_module:before{font-family: "ETmodules";content:"\24";content:"\39";}';
		echo 'li.et_pb_dcsbcm_divi_breadcrumbs_module:hover{background-color:#ec0090 !important;color:rgba(255,255,255,0.9) !important;}';
		echo '</style>';
	}
	
	
	/**
	 * Plugin Updater
	 * @since  1.1.0
	*/
	require_once('includes/wp-updates-plugin.php');
	new WPUpdatesPluginUpdater_1693( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));