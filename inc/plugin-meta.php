<?php



function wachat_custom_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'whatschat.php' ) !== false ) {
		$new_links = array(
				'support' => '<a href="https://wordpress.org/support/plugin/whatschat" target="_blank">Support</a>',
        'reviews' => '<a href="https://wordpress.org/support/plugin/whatschat/reviews/" target="_blank">Rate the plugin ★★★★★</a>'
				);

		$links = array_merge( $links, $new_links );
	}

	return $links;
}



function wachat_add_action_links ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'options-general.php?page=whatschat_plugin_options' ) . '">Settings</a>',
 );
return array_merge( $links, $mylinks );
}

?>
