<?php
/**
 * Plugin Name: Modal Plugin
 * Plugin URI: https://www.yourwebsite.com
 * Description: Ce plugin affiche une modal lors du chargement des pages.
 * Version: 1.0
 * Author: Influactive
 * Author URI: https://www.influactive.com
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Enqueue CSS and JS
function modal_plugin_assets(): void {
	wp_enqueue_style( 'modal-plugin-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
	wp_enqueue_script( 'modal-plugin-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array( 'jquery' ), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'modal_plugin_assets' );

// Create admin menu
function modal_plugin_menu(): void {
	add_options_page( 'Modal Plugin Settings', 'Modal Plugin', 'manage_options', 'modal-plugin', 'modal_plugin_options' );
}

add_action( 'admin_menu', 'modal_plugin_menu' );

// Include admin settings
function modal_plugin_options(): void {
	include 'admin-settings.php';
}

// Display Modal
function display_modal(): void {
	$modal_title   = get_option( 'modal_title' );
	$modal_content = get_option( 'modal_content' );
	echo '<dialog id="modal-dialog">
            <h2>' . $modal_title . '</h2>
            <p>' . $modal_content . '</p>
            <button id="close-btn">X</button>
          </dialog>';
}

add_action( 'wp_footer', 'display_modal' );
