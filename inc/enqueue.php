<?php
function wachat_enqueue_scripts() {
  wp_register_style( 'wachat-frontend-css', WACHAT_URL.'/assets/css/whatschat.css');
  wp_enqueue_style( 'wachat-frontend-css' );
}

function wachat_admin_enqueue () {
  wp_enqueue_media();
  wp_register_script( 'wachat-admin-js', WACHAT_URL.'/assets/js/whatschat-admin.js' , 'jquery', '1.0', true );
  wp_enqueue_script( 'wachat-admin-js' );
  wp_register_style( 'wachat-admin-css', WACHAT_URL.'/assets/css/whatschat-admin.css');
  wp_enqueue_style( 'wachat-admin-css' );
}

?>
