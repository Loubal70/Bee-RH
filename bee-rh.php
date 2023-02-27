<?php

/**
 * Plugin Name: Amphibee RH
 * Plugin URI: https://amphibee.fr/
 * Plugin Prefix: bee_rh
 * Plugin ID: bee-rh
 * Description: Plugin pour les ressources humaines d'Amphibee.
 * Version: 1.0.1
 * Author: Louis BOULANGER
 * Author URI: https://louis-boulanger.fr/
 * Text Domain: bee-rh
 * Domain Path: languages
 * Domain Var: BEE_RH_TD
 */

use Themosis\Core\Application;

define('BEE_RH_TD', 'bee-rh');
define('DB_PREFIX', env('DATABASE_PREFIX', 'wp_'));

/*
|--------------------------------------------------------------------------
| Bootstrap Plugin
|--------------------------------------------------------------------------
|
| We bootstrap the plugin. The following code is loading your plugin
| configuration and resources.
*/
$plugin = (Application::getInstance())->loadPlugin(__FILE__, 'config');

/*
|--------------------------------------------------------------------------
| Plugin i18n | l10n
|--------------------------------------------------------------------------
|
| Registers the "languages" directory for storing the plugin translations.
| The plugin text domain constant name is the plugin "Domain Var" header
| and its value the "Text Domain" header.
*/
load_themosis_plugin_textdomain(
    $plugin->getHeader('text_domain'),
    $plugin->getPath($plugin->getHeader('domain_path'))
);

/*
|--------------------------------------------------------------------------
| Plugin Assets Locations
|--------------------------------------------------------------------------
|
| You can define your plugin assets paths and URLs. You can add as many
| locations as you want. The key is your asset directory path and
| the value is its public URL.
*/
$plugin->assets([
    $plugin->getPath('dist') => $plugin->getUrl('dist')
]);

/*
|--------------------------------------------------------------------------
| Plugin Views
|--------------------------------------------------------------------------
|
| Register the plugin "views" directory. You can configure the list of
| view directories from the "config/prefix_plugin.php" configuration file.
*/
$plugin->views($plugin->config('plugin.views', []));

/*
|--------------------------------------------------------------------------
| Plugin Service Providers
|--------------------------------------------------------------------------
|
| Register the plugin "views" directory. You can configure the list of
| view directories from the "config/prefix_plugin.php" configuration file.
*/
$plugin->providers($plugin->config('plugin.providers', []));

/*
|--------------------------------------------------------------------------
| Plugin Includes
|--------------------------------------------------------------------------
|
| Auto includes files by providing one or more paths. By default, we setup
| an "inc" directory within the plugin. Use that "inc" directory to extend
| your WordPress application. Nested files are also included.
*/
$plugin->includes([
    $plugin->getPath('inc')
]);
