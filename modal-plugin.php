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
    throw new RuntimeException("WordPress environment not loaded. Exiting...");
}

/**
 * Enqueues the CSS and JavaScript assets required for the modal plugin.
 *
 * @return void
 */
function modal_plugin_assets(): void
{
    wp_enqueue_style('modal-plugin-style', plugin_dir_url(__FILE__) . 'assets/css/style.min.css', array(), '1.0');
    wp_enqueue_script('modal-plugin-script', plugin_dir_url(__FILE__) . 'assets/js/script.min.js', array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'modal_plugin_assets');

/**
 * Enqueues the CSS asset required for the admin settings page of the modal plugin.
 *
 * @param string $hook The current admin page hook.
 * @return void
 */
function modal_plugin_admin_assets(string $hook): void
{
    if ($hook !== 'settings_page_modal-plugin') {
        return;
    }
    wp_enqueue_style('modal-plugin-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.min.css', array(), '1.0');
}

add_action('admin_enqueue_scripts', 'modal_plugin_admin_assets');

/**
 * Adds an option page for the Modal Plugin to the WordPress admin menu.
 *
 * @return void
 */
function modal_plugin_menu(): void
{
    add_options_page('Modal Plugin Settings', 'Modal Plugin', 'manage_options', 'modal-plugin', 'modal_plugin_options');
}

add_action('admin_menu', 'modal_plugin_menu');

/**
 * Loads the admin settings page for the modal plugin.
 *
 * @return void
 */
function modal_plugin_options(): void
{
    include 'admin-settings.php';
}

/**
 * Displays the modal dialog on the page.
 *
 * @return void
 */
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

/**
 * Returns an array of plugin action links to be displayed on the plugins page.
 *
 * @param array $links An array of existing plugin action links.
 * @return array An array of updated plugin action links with the "Settings" link added.
 */
function modal_plugin_settings_link(array $links): array
{
    $settings_url = 'options-general.php?page=modal-plugin';
    $settings_link = ["<a href='{$settings_url}'>Settings</a>"];

    return array_merge($links, $settings_link);
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_{$plugin}", 'modal_plugin_settings_link');

/**
 * Checks the user permissions to determine if they have the capability to manage options.
 *
 * @return bool true if the user has the capability to manage options, false otherwise.
 * @throws RuntimeException if the WordPress environment is not loaded
 *
 */
function checkUserPermissions(): bool
{
    if (!defined('ABSPATH')) {
        throw new RuntimeException("WordPress environment not loaded. Exiting...");
    }

    if (!current_user_can('manage_options')) {
        return false;
    }

    return true;
}
