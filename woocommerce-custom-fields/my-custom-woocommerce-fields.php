<?php
/*
 * Plugin Name:       WooCommerce Custom Fields
 * Plugin URI:        https://example.com/
 * Description:       Adds custom fields (Length, Width, Height) to WooCommerce products.
 * Version:           1.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Chetan Chowdhari
 * Author URI:        https://chowdharichetan.github.io/
 * License:           None
 * License URI:       https://example.com/
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       woocommerce-custom-fields
 * Domain Path:       /languages
 */


// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include custom fields functions
require_once(plugin_dir_path(__FILE__) . 'includes/custom-fields.php');

// Include Rest API functions
require_once(plugin_dir_path(__FILE__) . 'includes/rest-api.php');

?>


