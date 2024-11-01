<?php

function wachat_code_include() {

  $adminNumber = esc_attr(get_option('whatschat_admin_number'));
  $chatMessage = esc_attr(get_option('whatschat_chat_message'));
  $chatBtn = esc_attr(get_option('whatschat_chat_btn'));
  $chatBtnSize = esc_attr(get_option('whatschat_chat_btn_size'));
  $gaTracking = esc_attr(get_option('whatschat_ga_tracking'));
  $customChatBtn = esc_attr(get_option('whatschat_custom_chat_btn'));
  $customChatBtnURL = esc_attr(get_option('whatschat_custom_chat_btn_url'));
  $btnLocation = esc_attr(get_option('whatschat_btn_location'));
  $topMargin = esc_attr(get_option('whatschat_min_top_margin'));
  $rightMargin = esc_attr(get_option('whatschat_min_right_margin'));
  $bottomMargin = esc_attr(get_option('whatschat_min_bottom_margin'));
  $leftMargin = esc_attr(get_option('whatschat_min_left_margin'));

  $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
  $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
  $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
  $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

  $message = rawurlencode($chatMessage);

  // check if is a mobile or PC
  if ($iphone || $android || $palmpre || $ipod || $berry == true) {
    $url = 'https://api.whatsapp.com/send?phone='.$adminNumber.'&text='.$message;
  } else {
    $url = 'https://web.whatsapp.com/send?phone='.$adminNumber.'&text='.$message;
  }

  $message = rawurlencode($chatMessage);

  if($adminNumber != '') {
    echo '<div id="whatschat-icon" style="';
    switch ($btnLocation) {
      case 'top-right' :
        echo 'top:'.$topMargin.'px;right:'.$rightMargin.'px';
        break;
      case 'bottom-right' :
        echo 'bottom:'.$bottomMargin.'px;right:'.$rightMargin.'px';
        break;
      case 'top-left' :
        echo 'top:'.$topMargin.'px;left:'.$leftMargin.'px';
        break;
      case 'bottom-left' :
        echo 'bottom:'.$bottomMargin.'px;left:'.$leftMargin.'px';
        break;
    }
    echo '">'; // end opening div
    echo '<a href="'.$url.'" target="_blank" title="Click to chat"';
    if ($gaTracking == 'enabled') {
      echo ' onClick="_gaq.push([\'_trackEvent\', \'WhatsChat\', \'Click to Chat\', \'Number: '.$adminNumber.'\']);"'; // google analytics event tracking
    }
    echo '>'; // end anchor tag
    echo '<img src="';
    if ($customChatBtn == 'true' && $customChatBtnURL != '') {
      echo $customChatBtnURL;
    } else {
      echo WACHAT_URL . '/assets/images/wa-btn-0'.$chatBtn.'.png';
    }
    echo '" alt="Chat with us on WhatsApp" style="height:'.$chatBtnSize.'px;" /></a></div>';
  }
}

?>
