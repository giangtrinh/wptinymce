<?php
/*
Plugin Name: TinyMCE Templates
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: Basic WordPress Plugin Header Comment
Version:     20160911
Author:      WordPress.org
Author URI:  https://developer.wordpress.org/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

function pluginprefix_install()
{
	
}
register_activation_hook( __FILE__, 'pluginprefix_install' );

function pluginprefix_deactivation()
{ 

}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

function pluginprefix_uninstall()
{ 

}
register_uninstall_hook(__FILE__, 'pluginprefix_uninstall');
 
if ( !class_exists( 'WPTinyMCETemplate_Plugin' ) ) {
    class WPTinyMCETemplate_Plugin
    { 
	
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) ); 
			add_action( 'before_wp_tiny_mce', array( $this, 'before_wp_tiny_mce' ) ); //Action Hook: Fires immediately before the TinyMCE settings are printed.
			add_filter( 'mce_buttons', array( $this, 'mce_buttons_1' ), 999 );
			add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2' ), 999 );
			add_filter( 'mce_buttons_3', array( $this, 'mce_buttons_3' ), 999 );
			add_filter( 'mce_buttons_4', array( $this, 'mce_buttons_4' ), 999 );
			add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ) ); //Filter Hook: Fires after tinymce.js is loaded, but before any TinyMCE editor instances are created.
			add_filter( 'mce_external_plugins', array( $this, 'mce_external_plugins' ), 999 );
			add_filter( 'tiny_mce_plugins', array ( $this, 'tiny_mce_plugins' ), 999 ); //Filter Hook: Filters the list of default TinyMCE plugins.
			add_action( 'after_wp_tiny_mce', array( $this, 'after_wp_tiny_mce' ) ); //Action Hook: Fires after any core TinyMCE editor instances are created.
		}  
		function before_wp_tiny_mce($mce_settings)
		{
			return $mce_settings;
		}
		function mce_buttons_1($buttons)
		{
			$buttons[] = 'copy';
		    $buttons[] = 'cut'; 
			array_push( $buttons, 'separator', 'post_template' );
		    return $buttons;
		}
		function mce_buttons_2($buttons)
		{ 	
			return $buttons;
		}
		function mce_buttons_3($buttons)
		{
			return $buttons;
		}
		function mce_buttons_4($buttons)
		{
			return $buttons;
		}		
		function tiny_mce_before_init($mce_settings)
		{   
			$mce_settings['height'] = 500;
			$mce_settings['plugins']= "template";
			//$mce_settings['menubar']= "insert";
			//$mce_settings['toolbar']= "template";
			//$mce_settings['templates']= [{title: 'Some title 1', description: 'Some desc 1', content: 'My content'},{title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}];
			return $mce_settings;
		}
		function mce_external_plugins($plugins)
		{
			$plugins['post_template'] = plugins_url( 'tinymce/visualblocks/edior_plugin.js', __FILE__ );
			return $plugins;
		}
		function tiny_mce_plugins($plugins)
		{  
			return $plugins; 
		}
		function after_wp_tiny_mce($mce_settings)
		{
			return $mce_settings;
		}
		function admin_menu() {
			/**
			 * Registers a new settings page under Settings.
			 */
			add_options_page(
				__( 'TinyMCETemplate', 'textdomain' ),
				__( 'TinyMCE Template', 'textdomain' ),
				'manage_options',
				'tinymce_template',
				array(
					$this,
					'settings_page'
				)
			);
		} 
		
		function settings_page() {
			/**
			 * Settings page display callback.
				if ( ! defined( 'TADV_ADMIN_PAGE' ) ) {
				define( 'TADV_ADMIN_PAGE', true );
				} 
				include_once( TADV_PATH . 'tadv_admin.php' );
			 */
			echo __( 'This is the page content', 'textdomain' );
		} 
	}   
	new WPTinyMCETemplate_Plugin;
} 
