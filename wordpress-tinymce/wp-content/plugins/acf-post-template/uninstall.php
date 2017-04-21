<?php
// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) || ! WP_UNINSTALL_PLUGIN ||
	dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) ) ) {

	exit;
}
delete_option( 'WPTinyMCETemplate_option_foo' );
//need to do some clean-up when it is uninstalled from a site. see https://developer.wordpress.org/plugins/the-basics/uninstall-methods/