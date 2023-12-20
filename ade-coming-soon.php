<?php

/**
 * Plugin Name: Ade Coming Soon Pgae
 * Plugin URI:  https://www.adeleyeayodeji.com
 * Author:      Adeleye Ayodeji
 * Author URI:  https://www.adeleyeayodeji.com
 * Description: This is a simple coming soon page plugin that allows you to create a coming soon page for your website using Elementor Page Builder.
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: ade-coming-soon
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('ADE_COMING_SOON_VERSION', time());
define('ADE_COMING_SOON_MINIMUM_WP_VERSION', '4.0');
define('ADE_COMING_SOON_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ADE_COMING_SOON_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ADE_COMING_SOON_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ADE_COMING_SOON_TEXT_DOMAIN', 'ade-coming-soon');


// Include the main class.
require_once ADE_COMING_SOON_PLUGIN_DIR . 'includes/class-ade-coming-soon.php';
//include helpers
require_once ADE_COMING_SOON_PLUGIN_DIR . 'includes/helpers.php';
