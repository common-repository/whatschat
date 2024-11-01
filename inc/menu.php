<?php

function wachat_admin_menu() {
  add_menu_page( 'WhatsChat Settings', 'WhatsChat', 'manage_options', 'whatschat_plugin_options', 'wachat_admin_menu_function', WACHAT_URL.'/assets/whatschat-icon.svg', 75 );

  if (class_exists('WooCommerce')) {
    add_submenu_page( 'whatschat_plugin_options', 'WooCommerce Chat Settings', 'WooCommerce', 'manage_options', 'wachat_woocommerce_options', 'wachat_woocommerce_menu_function' );
  }

  add_action('admin_init', 'wachat_custom_settings');
}

function wachat_custom_settings() {
  // main settings page options
  register_setting( 'wachat_main_settings_group', 'whatschat_admin_number');
  register_setting( 'wachat_main_settings_group', 'whatschat_chat_message');
  register_setting( 'wachat_main_settings_group', 'whatschat_chat_btn');
  register_setting( 'wachat_main_settings_group', 'whatschat_custom_chat_btn');
  register_setting( 'wachat_main_settings_group', 'whatschat_custom_chat_btn_url');
  register_setting( 'wachat_main_settings_group', 'whatschat_btn_location');
  register_setting( 'wachat_main_settings_group', 'whatschat_min_top_margin');
  register_setting( 'wachat_main_settings_group', 'whatschat_min_right_margin');
  register_setting( 'wachat_main_settings_group', 'whatschat_min_bottom_margin');
  register_setting( 'wachat_main_settings_group', 'whatschat_min_left_margin');
  register_setting( 'wachat_main_settings_group', 'whatschat_chat_btn_size');
  register_setting( 'wachat_main_settings_group', 'whatschat_ga_tracking');

  // main page sections
  add_settings_section( 'wachat_main_settings_section', 'WhatsChat Settings', 'wachat_settings_section_cb', 'whatschat_plugin_options' );



  // fields for main settings page
  add_settings_field('wachat-admin-number', 'Admin Number', 'wachat_admin_number_field', 'whatschat_plugin_options', 'wachat_main_settings_section');
  add_settings_field('wachat-chat-message', 'Chat Message', 'wachat_chat_message_field', 'whatschat_plugin_options', 'wachat_main_settings_section');
  add_settings_field('wachat-chat-btn', 'Chat Button', 'wachat_chat_btn_field', 'whatschat_plugin_options', 'wachat_main_settings_section');
  add_settings_field('wachat-custom-chat-btn', 'Custom Chat Button', 'wachat_custom_chat_btn_field', 'whatschat_plugin_options', 'wachat_main_settings_section');
  add_settings_field('wachat-btn-location', 'Button Location', 'wachat_btn_location_field', 'whatschat_plugin_options', 'wachat_main_settings_section');
  add_settings_field('wachat-chat-btn-size', 'Chat Button Size', 'wachat_chat_btn_size_field', 'whatschat_plugin_options', 'wachat_main_settings_section');
  add_settings_field('wachat-ga-tracking', 'Google Analytics Event Tracking', 'wachat_ga_tracking_field', 'whatschat_plugin_options', 'wachat_main_settings_section');



  if (class_exists('WooCommerce')) {
    // woocommerce settings page options
    register_setting( 'wachat_woocommerce_settings_group', 'whatschat_enable_woocommerce');
    register_setting( 'wachat_woocommerce_settings_group', 'whatschat_woocommerce_chat_number');
    register_setting( 'wachat_woocommerce_settings_group', 'whatschat_woocommerce_chat_btn_text');
    register_setting( 'wachat_woocommerce_settings_group', 'whatschat_woocommerce_chat_message');
    register_setting( 'wachat_woocommerce_settings_group', 'whatschat_woocommerce_chat_styling');

    // woocommerce page sections
    add_settings_section( 'wachat_woocommerce_settings_section', 'WhatsChat WooCommerce Chat Settings', 'wachat_woocommerce_settings_section_cb', 'wachat_woocommerce_options' );

    // fields for woocommerce settings page
    add_settings_field( 'wachat-enable-woocommerce', 'Enable WooCommerce Chat', 'wachat_enable_woocommerce_field', 'wachat_woocommerce_options', 'wachat_woocommerce_settings_section');
    add_settings_field( 'wachat-woocommerce-chat-number', 'WooCommerce Chat Number', 'wachat_woocommerce_chat_number_field', 'wachat_woocommerce_options', 'wachat_woocommerce_settings_section');
    add_settings_field( 'wachat-woocommerce-chat-btn-text', 'WooCommerce Chat Button Text', 'wachat_woocommerce_chat_btn_text_field', 'wachat_woocommerce_options', 'wachat_woocommerce_settings_section');
    add_settings_field( 'wachat-woocommerce-chat-message', 'WooCommerce Chat Message', 'wachat_woocommerce_chat_message_field', 'wachat_woocommerce_options', 'wachat_woocommerce_settings_section');
    add_settings_field( 'wachat-woocommerce-chat-styling', 'CSS Styles for Chat Button', 'wachat_woocommerce_chat_styling_field', 'wachat_woocommerce_options', 'wachat_woocommerce_settings_section');
  }
}


function wachat_settings_section_cb () {
  // main page settings section callback
}

function wachat_woocommerce_settings_section_cb() {
  if (!class_exists('WooCommerce')) {
    echo '<h3>WooCommerce not detected. WooCommerce needs to be installed in order to use these features.';
  }
}

/*
  Fields for the main settings page
*/

function wachat_admin_number_field() {
  $adminNumber = esc_attr(get_option('whatschat_admin_number'));
  echo '<input type="text" name="whatschat_admin_number" value="'.$adminNumber.'" placeholder="Admin Number" size="30" />';
  echo '<p class="description">Enter the administrator\'s number with the country code <br/>and without spaces and dashes. Eg: +12345678910 <br/>This is the WhatApp number where users\' messages will be sent.</p>';
}

function wachat_chat_message_field () {
  $chatMessage = esc_attr(get_option('whatschat_chat_message'));
  if ($chatMessage != '') {
    echo '<textarea name="whatschat_chat_message" cols="30" rows="5" placeholder="Chat Message">'.$chatMessage.'</textarea>';
  } else {
    echo '<textarea name="whatschat_chat_message" cols="30" rows="5" placeholder="Chat Message">Hello. I am interested in your service.</textarea>';
  }
  echo '<p class="description">The first WhatsApp message which will be sent by the user to the Admin.</p>';
}

function wachat_chat_btn_field () {
  $chatBtn = esc_attr(get_option('whatschat_chat_btn'));
  ($chatBtn == '') ? $chatBtn = 1 : '';
  $imgPath = WACHAT_URL.'/assets/images/';
  for($i=1;$i<=6;$i++) {
    echo '<div class="wachat-chat-btn-sample"><input type = "radio" name = "whatschat_chat_btn" id = "wa-btn-0'.$i.'" value = "'.$i.'"';
    echo ($i == $chatBtn) ? ' checked="checked"' : '';
    echo ' /><label class="wachat-label" for = "wa-btn-0'.$i.'"><img src="'.$imgPath.'wa-btn-0'.$i.'.png"></label></div>';
  }
  echo '<p class="description">Select the chat button you want to use.</p>';
}

function wachat_custom_chat_btn_field() {
  $customChatBtn = esc_attr(get_option('whatschat_custom_chat_btn'));
  $customChatBtnURL = esc_attr(get_option('whatschat_custom_chat_btn_url'));
  echo '<input type="checkbox" id="wachat-custom-chat-enabled" name="whatschat_custom_chat_btn" value="true"';
  echo ($customChatBtn == 'true') ? ' checked' : '';
  echo '><a id="wachat-upload-chat-button" class="button-secondary">Upload</a><img id="wachat-chat-buttom-preview" src="';
  echo ($customChatBtnURL != '') ? $customChatBtnURL : '';
  echo '"><input type="hidden" name="whatschat_custom_chat_btn_url" id="wachat-chat-button-field" value="';
  echo ($customChatBtnURL != '') ? $customChatBtnURL : '';
  echo '">';
}

function wachat_btn_location_field () {
  $btnLocation = esc_attr(get_option('whatschat_btn_location'));
  $topMargin = esc_attr(get_option('whatschat_min_top_margin'));
  $rightMargin = esc_attr(get_option('whatschat_min_right_margin'));
  $bottomMargin = esc_attr(get_option('whatschat_min_bottom_margin'));
  $leftMargin = esc_attr(get_option('whatschat_min_left_margin'));
  ($topMargin == '') ? $topMargin = 25 : '' ;
  ($rightMargin == '') ? $rightMargin = 25 : '' ;
  ($bottomMargin == '') ? $bottomMargin = 25 : '' ;
  ($leftMargin == '') ? $leftMargin = 25 : '' ;
  ($btnLocation == '') ? $btnLocation = 'bottom-right' : '' ;
  echo '<input type="radio" name="whatschat_btn_location" value="top-right" id="btn-loc-top-r"';
  echo ($btnLocation == 'top-right') ? ' checked' : '';
  echo '><label class="wachat-label" for="btn-loc-top-r">Top Right</label>';
  echo '<input type="radio" name="whatschat_btn_location" value="bottom-right" id="btn-loc-bot-r"';
  echo ($btnLocation == 'bottom-right') ? ' checked' : '';
  echo '><label class="wachat-label" for="btn-loc-bot-r">Bottom Right</label>';
  echo '<input type="radio" name="whatschat_btn_location" value="top-left" id="btn-loc-top-l"';
  echo ($btnLocation == 'top-left') ? ' checked' : '';
  echo '><label class="wachat-label" for="btn-loc-top-l">Top Left</label>';
  echo '<input type="radio" name="whatschat_btn_location" value="bottom-left" id="btn-loc-bot-l"';
  echo ($btnLocation == 'bottom-left') ? ' checked' : '';
  echo '><label class="wachat-label" for="btn-loc-bot-l">Bottom Left</label>';
  echo '<p class="description wachat-bot-margin">Position of the button on the screen.</p>';
  echo '<input type="number" name="whatschat_min_top_margin" id="wachat-top-margin" value="'.$topMargin.'" class="wachat-num-field"><label class="wachat-label" for="wachat-top-margin">Top Margin</label>';
  echo '<input type="number" name="whatschat_min_right_margin" id="wachat-right-margin" value="'.$rightMargin.'" class="wachat-num-field"><label class="wachat-label" for="wachat-right-margin">Right Margin</label>';
  echo '<input type="number" name="whatschat_min_bottom_margin" id="wachat-bottom-margin" value="'.$bottomMargin.'" class="wachat-num-field"><label class="wachat-label" for="wachat-bottom-margin">Bottom Margin</label>';
  echo '<input type="number" name="whatschat_min_left_margin" id="wachat-left-margin" value="'.$leftMargin.'" class="wachat-num-field"><label class="wachat-label" for="wachat-left-margin">Left Margin</label>';
  echo '<p class="description">Minimum distance from the edge of the window in pixels.</p>';

}

function wachat_chat_btn_size_field () {
  $chatBtnSize = esc_attr(get_option('whatschat_chat_btn_size'));
  ($chatBtnSize == '') ? $chatBtnSize = 50 : '' ;
  echo '<input type="number" name="whatschat_chat_btn_size" value="'.$chatBtnSize.'" min="1" class="wachat-num-field">pixels';
  echo '<p class="description">The height of the chat button in pixels. The width of the buton will be calculated automatically.</p>';
}

function wachat_ga_tracking_field () {
  $gaTracking = esc_attr(get_option('whatschat_ga_tracking'));
  if ($gaTracking == 'enabled') {
    echo '<input id="ga-tracking-enabled" type="checkbox" name="whatschat_ga_tracking" value="enabled" checked><label for="ga-tracking-enabled">Enable Google Analytics event tracking</label>';
  } else {
    echo '<input id="ga-tracking-enabled" type="checkbox" name="whatschat_ga_tracking" value="enabled"><label for="ga-tracking-enabled">Enable Google Analytics event tracking</label>';
  }

}

/*
  Fields for the WooCommerce settings page
*/

function wachat_enable_woocommerce_field() {
  $enableWoocommerce = esc_attr(get_option('whatschat_enable_woocommerce'));
  if ($enableWoocommerce == 'enabled') {
    echo '<input id="wachat-woocommerce-enabled" type="checkbox" name="whatschat_enable_woocommerce" value="enabled" checked><label for="wachat-woocommerce-enabled">Enable WooCommerce chat</label>';
  } else {
    echo '<input id="wachat-woocommerce-enabled" type="checkbox" name="whatschat_enable_woocommerce" value="enabled"><label for="wachat-woocommerce-enabled">Enable WooCommerce chat</label>';
  }
  echo '<p class="description">This option enables the WhatsChat, 1 click chat, on WooCommerce single product pages</p>';
}

function wachat_woocommerce_chat_number_field() {
  $chatNumber = esc_attr(get_option('whatschat_woocommerce_chat_number'));
  $adminNumber = esc_attr(get_option('whatschat_admin_number'));
  ($chatNumber == '' && $adminNumber != '') ? $chatNumber = $adminNumber : '';
  echo '<input type="text" name="whatschat_woocommerce_chat_number" value="'.$chatNumber.'" placeholder="Chat Number" size="30" />';
  echo '<p class="description">This is the WhatsApp number which will be be used for chatting for WooCommerce products.</p>';
}

function wachat_woocommerce_chat_btn_text_field() {
  $chatText = esc_attr(get_option('whatschat_woocommerce_chat_btn_text'));
  ($chatText == '') ? $chatText = 'Chat Now' : '';
  echo '<input type="text" name="whatschat_woocommerce_chat_btn_text" value="'.$chatText.'" placeholder="Chat Button Text" size="30" />';
  echo '<p class="description">This is the text which will be displayed on the chat button on WooCommerce single product pages.</p>';
}

function wachat_woocommerce_chat_message_field () {
  $chatMessage = esc_attr(get_option('whatschat_woocommerce_chat_message'));
  ($chatMessage == '') ? $chatMessage = 'Hello. I am interested in your product.' : '';
  echo '<textarea name="whatschat_woocommerce_chat_message" cols="30" rows="5" placeholder="Chat Message">'.$chatMessage.'</textarea>';
  echo '<p class="description">The first WhatsApp message which will be sent by the user. The Product Name will be added to the message automatically.</p>';
}

function wachat_woocommerce_chat_styling_field () {
  $chatStyling = get_option('whatschat_woocommerce_chat_styling');
  echo '<textarea name="whatschat_woocommerce_chat_styling" cols="30" rows="5" placeholder="CSS Styles">'.$chatStyling.'</textarea>';
  echo '<p class="description">Custom CSS styles which will be applied to the WooCommerce chat button. You can use any CSS styling here.</p>';
}

// functions to display menu pages

function wachat_admin_menu_function() {
  settings_errors();
  ?>
    <form method="post" action="options.php">
      <?php
      settings_fields('wachat_main_settings_group');
      do_settings_sections('whatschat_plugin_options');
      submit_button();
      ?>
    </form>
  <?php
}

function wachat_woocommerce_menu_function() {
  settings_errors();
  ?>
    <form method="post" action="options.php">
      <?php
      settings_fields('wachat_woocommerce_settings_group');
      do_settings_sections('wachat_woocommerce_options');
      submit_button();
      ?>
    </form>
  <?php
}


?>
