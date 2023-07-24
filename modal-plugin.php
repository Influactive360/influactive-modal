<?php
/**
 * Plugin Name: Modal by Influactive
 * Description: Ce plugin affiche une modal lors du chargement des pages.
 * Version: 1.0
 * Author: Influactive
 * Author URI: https://www.influactive.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: influactive-modal
 * Domain Path: /languages
 **/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue CSS and JS
function modal_plugin_assets(): void
{
    wp_enqueue_style('modal-plugin-style', plugin_dir_url(__FILE__) . 'assets/css/style.min.css');
    wp_enqueue_script('modal-plugin-script', plugin_dir_url(__FILE__) . 'assets/js/script.min.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'modal_plugin_assets');

// Enqueue CSS for admin settings page
function modal_plugin_admin_assets($hook): void
{
    if ($hook !== 'settings_page_modal-plugin') {
        return;
    }
    wp_enqueue_style('modal-plugin-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.scss');
}

add_action('admin_enqueue_scripts', 'modal_plugin_admin_assets');

// Create admin menu
function modal_plugin_menu(): void
{
    add_options_page('Modal Plugin Settings', 'Modal Plugin', 'manage_options', 'modal-plugin', 'modal_plugin_options');
}

add_action('admin_menu', 'modal_plugin_menu');

// Include admin settings
function modal_plugin_options(): void
{
    include 'admin-settings.php';
}

// Display Modal
function display_modal(): void
{
    $modal_title = get_option('modal_title');
    $modal_content = get_option('modal_content');
    echo '<dialog id="modal-dialog">
            <h2>' . $modal_title . '</h2>
            <p>' . $modal_content . '</p>
            <button id="close-btn">X</button>
          </dialog>';
}

add_action('wp_footer', 'display_modal');

// Add settings link on plugin page
function modal_plugin_settings_link($links)
{
    $settings_link = '<a href="options-general.php?page=modal-plugin">Settings</a>';
    array_unshift($links, $settings_link);

    return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'modal_plugin_settings_link');
