<?php
/*
Plugin Name: ACF Post Classic Templates
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
#register_activation_hook( __FILE__, array( 'PostClassicModeTemplates_Plugin', 'pluginprefix_install' ) );
#register_deactivation_hook( __FILE__, array ( 'PostClassicModeTemplates_Plugin', 'pluginprefix_deactivation' ));
#register_uninstall_hook(__FILE__, array ( 'PostClassicModeTemplates_Plugin', 'pluginprefix_uninstall'));   
if ( !class_exists( 'PostClassicModeTemplates_Plugin' ) ) {
    class PostClassicModeTemplates_Plugin
    {  
		public function __construct() {  
			 	 
			register_activation_hook( __FILE__, array( $this, 'pluginprefix_install' ));
			register_deactivation_hook( __FILE__, array( $this, 'pluginprefix_deactivation' ));
			register_uninstall_hook( __FILE__, array( $this, 'pluginprefix_uninstall' )); 
			add_action( 'init', array ( $this, 'createTaxonomy'), 0 );
			//add_action( 'init', array ( $this, 'updateTaxonomyDefault'), 0 );	
			//add_action('acf/init', array ( $this, 'CreatePostTemplate_TextImages'), 0 );
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );    
		} 
		function CreatePostTemplate_TextImages()
		{ 
		}
		static function GetTaxonomy($by, $value, $type)
		{
			$term = get_term_by($by, $value, $type);
			return $term;
		}
		function createTaxonomy() { 
			// Add new taxonomy, NOT hierarchical (like tags)
			$labels = array(
				'name'                       => _x( 'Template Types', 'Post Classic Mode Template Type', 'textdomain' ),
				'singular_name'              => _x( 'Template Type', 'Template Type', 'textdomain' ),
				'search_items'               => __( 'Search Template Types', 'textdomain' ),
				'popular_items'              => __( 'Popular Template Types', 'textdomain' ),
				'all_items'                  => __( 'All Template Types', 'textdomain' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit Template Type', 'textdomain' ),
				'update_item'                => __( 'Update Template Type', 'textdomain' ),
				'add_new_item'               => __( 'Add New Template Type', 'textdomain' ),
				'new_item_name'              => __( 'New Template Type Name', 'textdomain' ),
				'separate_items_with_commas' => __( 'Separate Template Type with commas', 'textdomain' ),
				'add_or_remove_items'        => __( 'Add or remove Template Types', 'textdomain' ),
				'choose_from_most_used'      => __( 'Choose from the most used Template Types', 'textdomain' ),
				'not_found'                  => __( 'No Template Types found.', 'textdomain' ),
				'menu_name'                  => __( 'Template Type', 'textdomain' ),
			);

			$args = array(
				'hierarchical'          => true,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true, 
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'post-classic-mode-template-type' ),
			);

			register_taxonomy( 'template-type', 'post', $args ); 
		}  
		function updateTaxonomyDefault() {  
			wp_insert_term(
				'Text + Images',   // the term 
				'template-type', // the taxonomy
				array(
					'description' => 'Text + Images',
					'slug'        => 'text-images'
				)
			);
			wp_insert_term(
				'Text + Images + Videos',   // the term 
				'template-type', // the taxonomy
				array(
					'description' => 'Text + Images + Videos',
					'slug'        => 'text-images-videos'
				)
			); 
			wp_insert_term(
				'Text Only 1',   // the term 
				'template-type', // the taxonomy
				array(
					'description' => 'Text Only',
					'slug'        => 'text-only'
				)
			);
		} 
		function admin_menu() {
			/**
			 * Registers a new settings page under Settings.
			 */
			add_options_page(
				__( 'PostClassicModeTemplates', 'textdomain' ),
				__( 'ACF Post Classic Templates', 'textdomain' ),
				'manage_options',
				'acf_post_classic_templates',
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
		static function pluginprefix_install()
		{     
			$this -> createTaxonomy();
			$this -> updateTaxonomyDefault();
			//add_action( 'init', array ( $this, 'PostClassicModeTemplateTypes_Taxonomy_InsertDefault')); 
		}		 
		function pluginprefix_deactivation()
		{ 

		}
		function pluginprefix_uninstall()
		{ 

		}	
		
	}    
	function PostClassicModeTemplates_Plugin()
	{
		global $PostClassicModeTemplates_Plugin; 
		if( !isset($PostClassicModeTemplates_Plugin) )
		{
			$PostClassicModeTemplates_Plugin = new PostClassicModeTemplates_Plugin();
		} 
		return $PostClassicModeTemplates_Plugin;
	} 
	// initialize
	PostClassicModeTemplates_Plugin();
} 
