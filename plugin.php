<?php
/*

Plugin Name: Bunch with post

Description: Bunch with post

Version: 1.0

Author: Shitikov Kirill

*/

//------------------------------------------------------------
//
// NOTE:
//
// Try NOT to add any code line in this file.
//
// Use "plugin\Main.php" to add your hooks.
//
//------------------------------------------------------------
define('BWP_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('BWP_PLUGIN_PATH', __DIR__);

require_once( plugin_dir_path( __FILE__ ) . 'boot/bootstrap.php' );
