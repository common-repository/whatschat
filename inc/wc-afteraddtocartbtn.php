<?php

function wachat_add_content_after_addtocart_button_func() {
  $enableWoocommerce = esc_attr(get_option('whatschat_enable_woocommerce'));
  $chatNumber = esc_attr(get_option('whatschat_woocommerce_chat_number'));
  $chatBtnText = esc_attr(get_option('whatschat_woocommerce_chat_btn_text'));
  $chatMessage = esc_attr(get_option('whatschat_woocommerce_chat_message'));
  $chatStyling = get_option('whatschat_woocommerce_chat_styling');

  $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
  $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
  $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
  $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

  $message = rawurlencode($chatMessage);

  $productName = get_the_title();

  if ($iphone || $android || $palmpre || $ipod || $berry == true) {
    $url = 'https://api.whatsapp.com/send?phone='.$chatNumber.'&text='.$message.' (Product name: '.$productName.')';
  } else {
    $url = 'https://web.whatsapp.com/send?phone='.$chatNumber.'&text='.$message.' (Product name: '.$productName.')';
  }

  if ($enableWoocommerce == 'enabled' && class_exists('WooCommerce')) {
    echo '<a class="button" href="'.$url.'" target="_blank" ';
    echo ($chatStyling != '') ? 'style="'.$chatStyling.'"' : '';
    echo '>'.$chatBtnText.'</a>';
  }
}

?>
