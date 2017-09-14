<?php

require_once( 'stripe-php/init.php' );

function wpjobusSubmitPostStatus() {

  	if ( isset( $_POST['wpjobusSubmitPostStatus_nonce'] ) && wp_verify_nonce( $_POST['wpjobusSubmitPostStatus_nonce'], 'wpjobusSubmitPostStatus_html' ) ) {

  		$postId = $_POST['postId'];
  		$postStatus = $_POST['postStatus'];

        if($postStatus == 'publish') {

      		$my_post = array(
    			'ID' => $postId,
    			'post_status' => 'publish'
    		);

            wpjobusSendNotifications($postId);

        } elseif($postStatus == 'unpublish') {

            $my_post = array(
                'ID' => $postId,
                'post_status' => 'draft'
            );

        }

        wp_update_post( $my_post );


	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_wpjobusSubmitPostStatus', 'wpjobusSubmitPostStatus' );
add_action( 'wp_ajax_nopriv_wpjobusSubmitPostStatus', 'wpjobusSubmitPostStatus' );

function wpjobusSubmitPayedPostStatus() {

    if ( isset( $_POST['wpjobusSubmitPayedPostStatus_nonce'] ) && wp_verify_nonce( $_POST['wpjobusSubmitPayedPostStatus_nonce'], 'wpjobusSubmitPayedPostStatus_html' ) ) {

        if( isset( $_POST['stripeToken'] ) ) {

            global $current_user, $td_user_id, $td_user_info;
            get_currentuserinfo();
            $td_user_id    = $current_user->ID; // You can set $td_user_id to any users, but this gets the current users ID.
            $user_email = get_the_author_meta('user_email', $td_user_id);
            $planEMAIL  = $user_email;

            $postId         = $_POST['postId'];
            $postType       = get_post_type( $postId );

            global $redux_demo; 
            $price_code = $redux_demo['job-currency-code'];
            $comp_price = $redux_demo[$postType.'-regular-price'];

            $token         = $_POST['stripeToken'];
            $amount        = $comp_price;
            $store_name    = get_bloginfo('name');
            $description   = get_the_title( $postId );
            $currency      = $price_code;
            $test_mode     = ( isset( $_POST['sc_test_mode'] ) ? $_POST['sc_test_mode'] : 'false' );

            $charge = array();
            $query_args = array();

            $meta = array();
            $meta = apply_filters( 'sc_meta_values', $meta );

            sc_set_stripe_key();

            // Create new customer
            $new_customer = \Stripe\Customer::create( array(
              'email' => $planEMAIL,
              'card'  => $token
            ));

            // Create the charge on Stripe's servers - this will charge the user's default card
            try {
              $charge = \Stripe\Charge::create(array(
                  'amount'      => $amount, // amount in cents, again
                  'currency'    => $currency,
                  'customer'    => $new_customer['id'],
                  'description' => $description,
                  'metadata'    => $meta
                )
              );

                $failed = false;

                $postStatus = 'regular';

                update_post_meta($postId, 'wpjobus_featured_post_status', $postStatus);

                $my_post = array(
                    'ID' => $postId,
                    'post_status' => 'publish'
                );

                wp_update_post( $my_post );

                wpjobusSendNotifications($postId);


            } catch(Stripe_CardError $e) {

              // Catch Stripe errors
              $redirect = $fail_redirect;
              
              $e = $e->getJsonBody();

              $failed = true;
            }

            unset( $_POST['stripeToken'] );

        }

    } else {

        $response = 0;

    }

    die(); // this is required to return a proper result

}
add_action( 'wp_ajax_wpjobusSubmitPayedPostStatus', 'wpjobusSubmitPayedPostStatus' );
add_action( 'wp_ajax_nopriv_wpjobusSubmitPayedPostStatus', 'wpjobusSubmitPayedPostStatus' );

