<?php
/*
Plugin Name: WhatsChat
Description: WhatsApp Chat plugin for users and buyers of your site to chat with you via WhatsApp. WooCommerce integration allows buyers to chat with you from the product page. On Desktop devices, clicking on the chat button will open a WhatsApp Web window in the default browser. On mobile devices, it will directly open the WhatsApp application.
Version: 0.5
Author: 1StopWP
Author URI: https://1stopwp.com
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: whatschat
*/

if(!function_exists('add_action')) {
    die('This file cannot be accessed directly');
}

//constants
define('WACHAT_BASENAME', plugin_basename(__FILE__));
define('WACHAT_URL', plugins_url('', __FILE__));

//includes
include('inc/activate.php');
include('inc/admin-notices.php');
include('inc/menu.php');
include('inc/code-include.php');
include('inc/enqueue.php');
include('inc/plugin-meta.php');
include('inc/wc-afteraddtocartbtn.php');


//hooks
register_activation_hook(__FILE__, 'wachat_activation');
add_action('admin_menu', 'wachat_admin_menu');
add_action('wp_footer', 'wachat_code_include');
add_action('wp_enqueue_scripts', 'wachat_enqueue_scripts');
add_action('admin_enqueue_scripts', 'wachat_admin_enqueue');
add_filter('plugin_row_meta', 'wachat_custom_plugin_row_meta', 10, 2);
add_filter('plugin_action_links_' . WACHAT_BASENAME, 'wachat_add_action_links');
add_action('admin_notices', 'wachat_admin_notices' );

// woocommerce hooks
add_action( 'woocommerce_after_add_to_cart_button', 'wachat_add_content_after_addtocart_button_func' );
