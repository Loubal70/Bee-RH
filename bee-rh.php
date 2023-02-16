<?php
/**
 * Plugin Name: Amphibee RH
 * Plugin URI: https://amphibee.fr/
 * Description: Plugin pour les ressources humaines d'Amphibee.
 * Version: 1.0.0
 * Author: Louis BOULANGER
 * Author URI: https://louis-boulanger.fr/
 * Text Domain: amphibee-rh
 */

// Définir les constantes du plugin
define('AMPHIBEE_RH_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('AMPHIBEE_RH_PLUGIN_URL', plugin_dir_url(__FILE__));

//// Inclure l'autoloader de Composer
require_once(__DIR__ . '/vendor/autoload.php');

require_once(AMPHIBEE_RH_PLUGIN_PATH . 'inc/main.php');
