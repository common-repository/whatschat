<?php

function wachat_activation() {
  $notices= get_option('wachat_deferred_admin_notices', array());
  $notices[]= '<div class="notice notice-success is-dismissible"><p>Congratulations you have succesfully activated the WhatsChat - 1 click WhatsApp chat plugin. Visit the <a href="' . admin_url('options-general.php?page=whatschat_plugin_options') . '">settings</a> page to configure the plugin.</p><p>Please <a href="https://wordpress.org/support/plugin/whatschat/reviews/" target="_blank">rate the plugin ★★★★★</a></p></div>';
  update_option('wachat_deferred_admin_notices', $notices);
}

?>
