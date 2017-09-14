<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

require_once( 'stripe-php/init.php' );

function sc_set_stripe_key() {
  global $sc_options;
  $key = '';

  // Check first if in live or test mode.
  global $redux_demo;
  $stripe_test = $redux_demo['stripe-state'];

  if($stripe_test == 2) {
    $key = $redux_demo['stripe-test-secret-key'];
  } elseif($stripe_test == 1){
    $key = $redux_demo['stripe-live-secret-key'];
  }

  \Stripe\Stripe::setApiKey( $key );
}

function wpjobusSubmitFeaturedPost() {

  	if ( isset( $_POST['wpjobusSubmitFeaturedPost_nonce'] ) && wp_verify_nonce( $_POST['wpjobusSubmitFeaturedPost_nonce'], 'wpjobusSubmitFeaturedPost_html' ) ) {

      if( isset( $_POST['stripeToken'] ) ) {

        global $current_user, $td_user_id, $td_user_info;
        get_currentuserinfo();
        $td_user_id    = $current_user->ID; // You can set $td_user_id to any users, but this gets the current users ID.
        $user_email = get_the_author_meta('user_email', $td_user_id);
        $planEMAIL  = $user_email;

        $featPostId     = $_POST['featPostId'];
        $postType       = get_post_type( $featPostId );
        $featPostStatus = $_POST['featPostStatus'];
        $featPostValid  = $_POST['featPostValid'];
        $str            = preg_replace('/\D/', '', $featPostValid);
        $currentDate    = current_time('timestamp');
        $timestamp      = strtotime('+'.$str.' days', $currentDate);

        global $redux_demo; 
        $price_code = $redux_demo['job-currency-code'];
        $comp_price = $redux_demo[$postType.'-featured-price'];

        $token         = $_POST['stripeToken'];
        $amount        = $comp_price;
        $store_name    = get_bloginfo('name');
        $description   = get_the_title( $featPostId );
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

          update_post_meta($featPostId, 'wpjobus_featured_post_status', $featPostStatus);

          update_post_meta($featPostId, 'wpjobus_featured_activation_date', $currentDate);
          update_post_meta($featPostId, 'wpjobus_featured_expiration_date', $timestamp);
          update_post_meta($featPostId, 'wpjobus_featured_active_time', $str);

          $my_post = array(
            'ID' => $featPostId,
            'post_status' => 'publish'
          );

          wp_update_post( $my_post );

          wpjobusSendNotifications($featPostId);


        } catch(Stripe_CardError $e) {

          // Catch Stripe errors
          $redirect = $fail_redirect;
          
          $e = $e->getJsonBody();

          $failed = true;
        }

        unset( $_POST['stripeToken'] );

      }


	  } else {

		  $responseFeat = 0;

  	}

    $responseFeat = ob_get_contents();
    ob_end_clean();

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_wpjobusSubmitFeaturedPost', 'wpjobusSubmitFeaturedPost' );
add_action( 'wp_ajax_nopriv_wpjobusSubmitFeaturedPost', 'wpjobusSubmitFeaturedPost' );

