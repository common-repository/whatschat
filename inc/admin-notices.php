<?php

function wachat_admin_notices() {
  if ($notices= get_option('wachat_deferred_admin_notices')) {
    foreach ($notices as $notice) {
      echo $notice;
    }
    delete_option('wachat_deferred_admin_notices');
  }
}

?>
