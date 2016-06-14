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
		$this->add_filter('timber/loader/paths', 'TimberController@addLocation', 1000);
		$this->add_filter('timber/loader/twig', 'TimberController@changeTwig', 1000);
		
		$this->add_action ( 'djd-site-post-before-button', 'MyCredController@addCreditForm');
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

		$this->add_action ( 'mycred_load_hooks', 'MyCredController@loadMyCustomHook');
		$this->add_filter ( 'mycred_setup_hooks', 'MyCredController@registerMyCustomHook');

		$this->add_filter('timber/loader/paths', 'TimberController@addLocation', 1000);
		$this->add_filter('timber/loader/twig', 'TimberController@changeTwig', 1000);
	}
}