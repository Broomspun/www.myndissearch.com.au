<?php

function favoriteForm() {

  	if ( isset( $_POST['favoriteForm_nonce'] ) && wp_verify_nonce( $_POST['favoriteForm_nonce'], 'favoriteForm_html' ) ) {

		session_start();
		/**
		 * Form posting handler
		 */
		$pagePath = explode('/wp-content/', get_template_directory());
    	include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));

		/**
		* Add transaction info to database 
		*/

		global $wpdb;

		$wpdb->query('CREATE TABLE IF NOT EXISTS `wpjobus_favorites` (
	        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        `user_id` TEXT NOT NULL,
	        `listing_id` TEXT NOT NULL,
	        `listing_type` TEXT NOT NULL
	    ) ENGINE = MYISAM ;');

		$listing_id = $_POST['favorite_listing_id'];
		$td_user_id = $_POST['favorite_user_id'];
		$status = $_POST['favorite_status'];
		$type = $_POST['favorite_type'];

		if($status == 0) {

			$favorite_information = array(
			    'user_id' => $td_user_id,
			    'listing_id' => $listing_id,
			    'listing_type' => $type
		  	); 

			$insert_format = array('%s', '%s');

			$wpdb->insert('wpjobus_favorites', $favorite_information, $insert_format);

			$response = 1;

		} else {

			$favorite_information = array(
			    'user_id' => $td_user_id,
			    'listing_id' => $listing_id
		  	); 

			$wpdb->delete( 'wpjobus_favorites', $favorite_information, $where_format = null );

			$response = 0;

		} 

        //=========================================

	  } else {

		$response = 3;

  	}

  	echo $response;

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_favoriteForm', 'favoriteForm' );
add_action( 'wp_ajax_nopriv_favoriteForm', 'favoriteForm' );


