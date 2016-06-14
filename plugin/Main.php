<?php

namespace Bunch;

use Amostajo\WPPluginCore\Plugin;

/**
 * Main class.
 * Registers HOOKS used within the plugin.
 * Acts like a bridge or router of actions between Wordpress and the plugin.
 *
 * @link http://wordpress-dev.evopiru.com/documentation/main-class/
 * @version 1.0
 */
class Main extends Plugin
{
	/**
	 * Declares public HOOKS.
	 * - Can be removed if not used.
	 * @since 1.0
	 */
	public function init()
	{
		// i.e.
		// add_action( 'save_post', [ &$this, 'save_post' ] );
		// 
		// $this->add_action( 'save_post', 'PostController@save' );
		// 
		// $this->add_shortcode( 'hello_world', 'view@shout', [ 'message' => 'Hello World!' ] );
	}

	/**
	 * Declares admin dashboard HOOKS.
	 * - Can be removed if not used.
	 * @since 1.0
	 */
	public function on_admin()
	{
		$this->add_action( 'activate_bunch-with-post/plugin.php', 'PluginController@init' );
		$this->add_action( 'admin_init', 'PluginController@init' );
		$this->add_filter( 'plugin_row_meta', 'PluginController@showPluginSlug', 10, 4 );
		$this->add_action( 'init', 'PluginController@githubPluginUpdaterInit');

		$this->add_filter ( 'acf/options_page/settings','AdminController@addOptionPage');
		$this->add_action ( 'admin_menu', 'AdminController@addOptionPage');
	}
}