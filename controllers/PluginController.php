<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 11.06.16
 * Time: 19:48
 */

namespace Bunch\Controllers;

use Amostajo\LightweightMVC\Controller;

class PluginController extends Controller
{
    public function init(){
        if ( $active_plugins = get_option('active_plugins') ) {
            $search_plugins = array(
                'timber-library/timber.php',
                'advanced-custom-fields/acf.php',
                'acf-options-page/acf-options-page.php',
                'acf-repeater/acf-repeater.php',
                'mycred/mycred.php',
            );

            $deactivate = false;
            foreach ($search_plugins as $plugin){
                if(!array_search($plugin, $active_plugins)){
                    $deactivate =true;
                    break;
                }
            }

            if($deactivate){
                $deactivate_this = array(
                    plugin_basename(__FILE__)
                );
                $active_plugins = array_diff( $active_plugins, $deactivate_this );
                update_option( 'active_plugins', $active_plugins );
                add_action('admin_notices', [&$this, 'yourMastActivatePlugins'] );
            }
        }
    }

    public function showPluginSlug($plugin_meta, $plugin_file, $plugin_data, $status){
        echo '<code>' . $plugin_file . '</code><br />';
        return $plugin_meta;
    }

    public function yourMastActivatePlugins(){
        $message = "Для активации этого плагина необходимо установить следующие плагины 
        Timber, 
        Advanced Custom Fields, 
        Advanced Custom Fields: Repeater Field, 
        Advanced Custom Fields: Options Page, 
        myCRED";
        echo "<div class='error'> <p>{$message}</p></div>";
    }

    function githubPluginUpdaterInit() {

        require_once (__DiR__.'/../model/plugin/updater.php');

        define('WP_GITHUB_FORCE_UPDATE', true);

        $proper_folder_name = 'bunch-with-post';
        $git_url = 'github.com/shitikovkirill/'.$proper_folder_name;

        $config = array(
            'slug' => BWP_PLUGIN_BASENAME, // this is the slug of your plugin
            'proper_folder_name' => $proper_folder_name, // this is the name of the folder your plugin lives in
            'api_url' => 'https://api.'.$git_url, // the github API url of your github repo
            'raw_url' => 'https://raw.'.$git_url.'/master', // the github raw url of your github repo
            'github_url' => 'https://'.$git_url, // the github url of your github repo
            'zip_url' => 'https://'.$git_url.'/zipball/master', // the zip url of the github repo
            'sslverify' => true, // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
            'requires' => '3.0', // which version of WordPress does your plugin require?
            'tested' => '3.3', // which version of WordPress is your plugin tested up to?
            'readme' => 'README.md' // which file to use as the readme for the version number
        );

        $w = new \WPGitHubUpdater($config);

    }
}