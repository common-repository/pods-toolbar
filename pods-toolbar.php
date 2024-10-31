<?php
/**
 * Plugin Name: Pods Toolbar
 * Description: Adds a Pods menu to the Admin Toolbar in the site (not in the admin) and allows for faster navigation within the Pods Framework plugin.
 * Author: Nikhil Vimal
 * Author URI: http://nik.techvoltz.com
 * Version: 1.0
 * Plugin URI:
 * License: GNU GPLv2+
 */

class Pods_Admin_Bar {

	//The Pods Toolbar Instance
	public static function init() {
		static $instance = false;
		if ( ! $instance ) {
			$instance = new Pods_Admin_Bar();
		}
		return $instance;
	}


	public function __construct() {
		add_action('admin_bar_menu', array( $this, 'admin_bar_nodes'),  999);

	}

	/**
	 * The function that creates the menus (nodes) for the admin bar
	 *
	 * @param $wp_admin_bar The WordPress admin bar
	 */
	public function admin_bar_nodes( $wp_admin_bar ) {
		//only displayed on site, not in admin
		if ( ! is_admin()) {

			// Main Parent Node
			$wp_admin_bar->add_node( array(
					'id'    => 'pods_bar',
					'title' => 'Pods',
				)
			);
			
			// Clear Cache in Pods
			$wp_admin_bar->add_node( array(
					'parent' => 'pods_bar',
					'id'    => 'pods_bar_cache_clear',
					'title' => 'Clear Cache',
					'href'  => admin_url( 'page=pods-settings&pods_clearcache=1' ),
				)
			);

			// Add New Node
			$wp_admin_bar->add_node( array(
					'parent' => 'pods_bar',
					'id'    => 'pods_bar_new',
					'title' => 'New Pod',
					'href'  => admin_url('admin.php?page=pods-add-new'),
				)
			);

			// Edit Pods Node
			$wp_admin_bar->add_node( array(
					'parent' => 'pods_bar',
					'id'    => 'pods_bar_edit',
					'title' => 'Edit Pods',
					'href'  => admin_url('admin.php?page=pods'),
				)
			);

			// Components Node
			$wp_admin_bar->add_node( array(
					'parent' => 'pods_bar',
					'id'    => 'pods_bar_components',
					'title' => 'Mange Components',
					'href'  => admin_url('admin.php?page=pods-components'),
				)
			);

			// Settings Node
			$wp_admin_bar->add_node( array(
					'parent' => 'pods_bar',
					'id'    => 'pods_bar_settings',
					'title' => 'Settings',
					'href'  => admin_url('admin.php?page=pods-settings'),
				)
			);

			// Help Bar
			$wp_admin_bar->add_node( array(
					'parent' => 'pods_bar',
					'id'    => 'pods_bar_help',
					'title' => 'Help!',
					'href'  => admin_url('admin.php?page=pods-help'),
				)
			);

			// Want to know more about Pods?
			$wp_admin_bar->add_node( array(
					'parent' => 'wp-logo',
					'id'    => 'pods_bar_about',
					'title' => 'About The Pods Framework',
					'href'  => 'http://pods.io/about/',
				)
			);
		}

	}


}

function load_pods_admin_bar() {
	//Check if plugin is activated, or else...
	if( is_plugin_active( 'pods/init.php' ) ) {

		return Pods_Admin_Bar::init();

	}

}
add_action('plugins_loaded', 'load_pods_admin_bar');
