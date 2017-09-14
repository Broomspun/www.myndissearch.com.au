<?php
/**
 * Template name: My Account Page
 */

if ( !is_user_logged_in() ) { 

	$login = home_url('/')."login";
	wp_redirect( $login ); exit;

} 

global $current_user, $td_user_id, $td_user_info;
get_currentuserinfo();
$td_user_id = $current_user->ID; // You can set $td_user_id to any users, but this gets the current users ID.
$td_user_info = get_userdata($td_user_id);

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
	$delete_post_id = esc_attr(strip_tags($_POST['deletepostid']));
	wp_delete_post( $delete_post_id, true );  /* delete the post we choosed   */
};

get_header(); ?>

	<section id="blog">

		<div class="container">

			<div class="resume-skills">

				<div class="my-account-header-block">

					<span class="my-account-avatar">

						<?php 

							global $td_result;

							$resume_id = $wpdb->get_results( "SELECT ID FROM `{$wpdb->prefix}posts` WHERE post_type = 'resume' and post_status = 'publish' and post_author = '".$td_user_id."' ");

							foreach ($resume_id as $key => $value) {
							    $td_result[] = $value->ID;
							}

							$wpjobus_resume_profile_picture = esc_url(get_post_meta($td_result[0], 'wpjobus_resume_profile_picture',true));
							$wpjobus_resume_fullname = esc_attr(get_post_meta($td_result[0], 'wpjobus_resume_fullname',true));

							if(!empty($wpjobus_resume_profile_picture)) {
								$my_avatar = $wpjobus_resume_profile_picture;
							}

						?>

						<?php require_once(get_template_directory() . '/inc/BFI_Thumb.php'); ?>
									
						<?php  

							if(!empty($my_avatar)) {

								$params = array( 'width' => 100, 'height' => 100, 'crop' => true );

								echo "<img class='author-avatar' src='" . bfi_thumb( "$my_avatar", $params ) . "' alt='' />";

							} else { 

						?>

							<?php $my_avatar = WPJobus_get_avatar_url ( get_the_author_meta('user_email', $td_user_id), $size = '100' ); ?>
							<img class="author-avatar" src="<?php echo $my_avatar; ?>" alt="" />

						<?php } ?>

					</span>

					<span class="my-account-header-title" style="max-width: 460px;">
						<h1 class="resume-section-title"><?php _e( 'My Account', 'themesdojo' ); ?></h1>
						<h3 class="resume-section-subtitle"><?php _e( 'Welcome to your personal cabinet,', 'themesdojo' ); ?><span><?php the_author_meta('display_name', $td_user_id); ?></span>!</h3>
						<a class="my-account-header-settings-link" href="#" style="margin-top: 0; text-align: left;"><i class="fa fa-cog" style="margin-top: 0px;"></i><?php _e( 'Account Settings', 'themesdojo' ); ?></a>
						<a class="my-account-header-subscriptions-link" href="#" style="margin-top: 0; text-align: left;"><i class="fa fa-envelope-o"></i><?php _e( 'Manage E-Mail Subscriptions', 'themesdojo' ); ?></a>
					</span>

					<?php

						$key = 'account_type';
						$single = true;
						$user_account_type = get_user_meta( $td_user_id, $key, $single ); 

						global $redux_demo; 
						$account_type = $redux_demo['account-state'];

						if($user_account_type == "job-seeker" OR $account_type == 1) {

					?>

					<span class="my-account-header-settings">

						<?php

							$resume = $wpdb->get_results( "SELECT DISTINCT ID FROM `{$wpdb->prefix}posts` WHERE post_type = 'resume' and (post_status = 'publish' or post_status = 'draft' or post_status = 'pending') and post_author = '".$td_user_id."' ");

							if(!empty($resume)) {

								$comp_id = $resume[0]->ID; 

						?>

							<span class="my-account-header-settings-link">

								<span class="resume-settings-bttn">

									<?php if(get_post_status($comp_id) != 'pending') { ?>

								    	<span class="my-account-job-single-feature">

								    		<?php global $redux_demo; $logo = $redux_demo['stripe-logo']['url']; $comp_valid = $redux_demo['resume-featured-validity']; $comp_price = $redux_demo['resume-featured-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100); 

								    		if(!empty($comp_price)) { 

								    			$featured_post_status = esc_attr(get_post_meta($comp_id, 'wpjobus_featured_post_status',true)); 

								    			if($featured_post_status == "featured" ) { 

								    				$featured_expiration_date = esc_attr(get_post_meta($comp_id, 'wpjobus_featured_expiration_date',true)); 
								    				$currentDate = current_time('timestamp');

								    				$timeStampCleanDate = date( "m/d/Y", $featured_expiration_date);

								    				if($featured_expiration_date >= $currentDate) {

								    		?>

								    		<span data-rel="tooltip" rel="top" title="<?php _e( "Featured until", "themesdojo" ); ?> <?php echo $timeStampCleanDate; ?>" id="featured" class="make-featured"><i class="fa fa-star"></i></span>

											<?php 

													} else {

														update_post_meta($comp_id, 'wpjobus_featured_post_status', 'regular');

													}

												} else { 

												?>

									    		<span data-rel="tooltip" rel="top" title="<?php echo "Feature ".$price_symbol.$dec."/".$comp_valid." Days"; ?>" id="make-featured-<?php echo $comp_id; ?>" class="make-featured"><i class="fa fa-star-o"></i></span>

									    		<span id="loading-featured-<?php echo $comp_id; ?>" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

									    		<form id="featForm<?php echo $comp_id; ?>" method="post" action="<?php echo get_template_directory_uri(); ?>/paypal/form-handler.php?func=addrow">

									    			<?php global $redux_demo; $comp_valid = $redux_demo['resume-featured-validity']; $comp_price = $redux_demo['resume-featured-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100);  ?>

													<input type="hidden" name="AMT" value="<?php echo $dec; ?>" />
													<input type="hidden" name="plan_price" value="<?php echo $dec; ?>">
													<input type="hidden" name="PAYMENTREQUEST_0_DESC" value="<?php echo $comp_id; ?>" />
													<?php global $redux_demo; $currency_code = $redux_demo['currency_code']; ?>
													<input type="hidden" name="CURRENCYCODE" value="<?php echo $currency_code; ?>">

													<?php $planID = uniqid(); ?>
													<input type="hidden" name="PAYMENTREQUEST_0_CUSTOM" value="<?php echo $planID; ?>">

													<input type="hidden" name="user_ID" value="<?php echo $td_user_id; ?>">

													<input type="hidden" name="plan_name" value="<?php echo $comp_id; ?>">

													<input type="hidden" id="featPostId" name="featPostId" value="<?php echo $comp_id; ?>">
									    			<input type="hidden" id="featPostStatus" name="featPostStatus" value="featured">
									    			<input type="hidden" id="featPostValid" name="featPostValid" value="<?php echo $comp_valid; ?>">

								    				<?php $plan_time = get_post_meta($post->ID, 'plan_time', true); ?>
								    				<input type="hidden" name="plan_time" value="<?php echo $plan_time; ?>">

								    				<?php $date = date('d/m/Y H:i:s'); ?>
								    				<input type="hidden" name="date" value="<?php echo $date; ?>">

								    				<input type="hidden" name="url" value="<?php echo get_template_directory_uri(); ?>">

													<?php global $redux_demo; $paypal_success = $redux_demo['paypal_success']; $paypal_fail = $redux_demo['paypal_fail']; ?>
															  
													<?php if ( isset($paypal_success) ) { ?>
														<input type="hidden" name="RETURN_URL" value="<?php echo $paypal_success; ?>" />
													<?php } ?>
															  
													<?php if ( isset($paypal_fail) ) { ?>
														<input type="hidden" name="CANCEL_URL" value="<?php echo $paypal_fail; ?>" />
													<?php } ?>
															  
													<input type="hidden" name="func" value="start" />

												</form>

									    		<script>

										    		jQuery('#publish-payed-<?php echo $comp_id; ?>').click(function(e) {

	  													e.preventDefault();  // don't submit it
											    		jQuery("#regularForm<?php echo $comp_id; ?>").trigger('submit')

												    });

												</script>

											<?php

												}

											}

											$featured_post_status = esc_attr(get_post_meta($comp_id, 'wpjobus_featured_post_status',true));

											if($featured_post_status == "featured" and empty($comp_price)) { 

												$featured_expiration_date = esc_attr(get_post_meta($comp_id, 'wpjobus_featured_expiration_date',true)); 
								    			$currentDate = current_time('timestamp');

								    			$timeStampCleanDate = date( "m/d/Y", $featured_expiration_date);

								    			if($featured_expiration_date >= $currentDate) {

											?>

											<span data-rel="tooltip" rel="top" title="<?php _e( "Featured until", "themesdojo" ); ?> <?php echo $timeStampCleanDate; ?>" id="featured" class="make-featured"><i class="fa fa-star"></i></span>

											<?php } } ?>

								    	</span>

									<?php } ?>

									<?php if(get_post_status($comp_id) != 'pending') { ?>

							    		<span id="unpublish-<?php echo $comp_id; ?>" data-rel="tooltip" rel="top" title="<?php _e( "Unpublish", "themesdojo" ); ?>" class="my-account-company-single-publish" <?php if(get_post_status($comp_id) == "draft") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye-slash"></i></span>

							    		<?php 

							    			global $redux_demo; $logo = $redux_demo['stripe-logo']['url']; $comp_reg_price = $redux_demo['resume-regular-price']; $dec = sprintf('%.2f', $comp_reg_price / 100); $price_symbol = $redux_demo['job-price-symbol'];

							    			$wpjobus_post_reg_status = esc_attr(get_post_meta($comp_id, 'wpjobus_featured_post_status',true));

							    			if(($wpjobus_post_reg_status == "featured") || ($wpjobus_post_reg_status == "regular") or (empty($comp_reg_price))) {

							    		?>

							    			<span id="publish-<?php echo $comp_id; ?>" data-rel="tooltip" rel="top" title="<?php _e( "Publish", "themesdojo" ); ?>" class="my-account-company-single-publish" <?php if(get_post_status($comp_id) == "publish") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye"></i></span>

							    		<?php } else { ?>

							    			<span id="publish-payed-<?php echo $comp_id; ?>" data-rel="tooltip" rel="top" title="<?php echo "Publish for ".$price_symbol.$dec; ?>" class="my-account-company-single-publish" <?php if(get_post_status($comp_id) == "publish") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye"></i></span>

							    		<?php } ?>

							    		<span id="loading-poststatus-<?php echo $comp_id; ?>" class="my-account-company-single-publish" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

								    	<form id="postStatusForm<?php echo $comp_id; ?>" type="post" action="" >

										    <input type="hidden" id="postId" name="postId" value="<?php echo $comp_id; ?>">
										    <input type="hidden" id="postStatus" name="postStatus" value="">

										    <input type="hidden" name="action" value="wpjobusSubmitPostStatus" />
											<?php wp_nonce_field( 'wpjobusSubmitPostStatus_html', 'wpjobusSubmitPostStatus_nonce' ); ?>

									   	</form>

									   	<form id="regularForm<?php echo $comp_id; ?>" method="post" action="<?php echo get_template_directory_uri(); ?>/paypal/form-handler-regular.php?func=addrow">

									    	<?php global $redux_demo; if(isset($redux_demo['resume-regular-validity'])) { $comp_valid = $redux_demo['resume-regular-validity']; } $comp_price = $redux_demo['resume-regular-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100);  ?>

											<input type="hidden" name="AMT" value="<?php echo $dec; ?>" />
											<input type="hidden" name="plan_price" value="<?php echo $dec; ?>">
											<input type="hidden" name="PAYMENTREQUEST_0_DESC" value="<?php echo $comp_id; ?>" />
											<?php global $redux_demo; $currency_code = $redux_demo['currency_code']; ?>
											<input type="hidden" name="CURRENCYCODE" value="<?php echo $currency_code; ?>">

											<?php $planID = uniqid(); ?>
											<input type="hidden" name="PAYMENTREQUEST_0_CUSTOM" value="<?php echo $planID; ?>">

											<input type="hidden" name="user_ID" value="<?php echo $td_user_id; ?>">

											<input type="hidden" name="plan_name" value="<?php echo $comp_id; ?>">

											<input type="hidden" id="featPostId" name="featPostId" value="<?php echo $comp_id; ?>">
									    	<input type="hidden" id="featPostStatus" name="featPostStatus" value="featured">
									    	<input type="hidden" id="featPostValid" name="featPostValid" value="<?php echo $comp_valid; ?>">

								    		<?php $plan_time = get_post_meta($post->ID, 'plan_time', true); ?>
								    		<input type="hidden" name="plan_time" value="<?php echo $plan_time; ?>">

								    		<?php $date = date('d/m/Y H:i:s'); ?>
								    		<input type="hidden" name="date" value="<?php echo $date; ?>">

								    		<input type="hidden" name="url" value="<?php echo get_template_directory_uri(); ?>">

											<?php global $redux_demo; $paypal_success = $redux_demo['paypal_success']; $paypal_fail = $redux_demo['paypal_fail']; ?>
															  
											<?php if ( isset($paypal_success) ) { ?>
												<input type="hidden" name="RETURN_URL" value="<?php echo $paypal_success; ?>" />
											<?php } ?>
															  
											<?php if ( isset($paypal_fail) ) { ?>
												<input type="hidden" name="CANCEL_URL" value="<?php echo $paypal_fail; ?>" />
											<?php } ?>
															  
											<input type="hidden" name="func" value="start" />

										</form>

									    <script type="text/javascript">

									    	jQuery('#make-featured-<?php echo $comp_id; ?>').click(function(e) {

  												e.preventDefault();  // don't submit it
										    	jQuery("#featForm<?php echo $comp_id; ?>").trigger('submit')

											});

											jQuery(function($) {

												jQuery('#publish-payed-<?php echo $comp_id; ?>').click(function(e) {

  													e.preventDefault();  // don't submit it
										    		jQuery("#regularForm<?php echo $comp_id; ?>").trigger('submit')

											    });

												jQuery(document).on("click","#unpublish-<?php echo $comp_id; ?>",function(e){

													jQuery('#postStatusForm<?php echo $comp_id; ?> #postStatus').val('unpublish');

												    $.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $comp_id; ?>();

													e.preventDefault();
													return false;

												});

												jQuery("#unpublish-<?php echo $comp_id; ?>").click(function(e){

													jQuery('#postStatusForm<?php echo $comp_id; ?> #postStatus').val('unpublish');

													$.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $comp_id; ?>();

													e.preventDefault();
													return false;

												});

												$.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $comp_id; ?> = function() {

													jQuery('#postStatusForm<?php echo $comp_id; ?>').ajaxSubmit({
													    type: "POST",
														data: jQuery('postStatusForm<?php echo $comp_id; ?>').serializeArray,
														url: '<?php echo admin_url('admin-ajax.php'); ?>',
														beforeSend: function() { 
												        	jQuery('#loading-poststatus-<?php echo $comp_id; ?>').css('display', 'block');
												        	jQuery('#unpublish-<?php echo $comp_id; ?>').css('display', 'none');
												        },	 
													    success: function(response) {
													    	jQuery('#loading-poststatus-<?php echo $comp_id; ?>').css('display', 'none');
															jQuery('#publish-<?php echo $comp_id; ?>').css('display', 'block');
															jQuery('#unpublish-<?php echo $comp_id; ?>').css('display', 'none');
															jQuery('#poststatus-<?php echo $comp_id; ?>').html('draft');
															jQuery('#my-account-job-single-title-<?php echo $comp_id; ?>').attr('href', '#');
													        return false;
													    }
													});
												}


												jQuery(document).on("click","#publish-<?php echo $comp_id; ?>",function(e){

													jQuery('#postStatusForm<?php echo $comp_id; ?> #postStatus').val('publish');

											     	$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $comp_id; ?>();

											     	e.preventDefault();
													return false;

												});

												jQuery("#publish-<?php echo $comp_id; ?>").click(function(e){

													jQuery('#postStatusForm<?php echo $comp_id; ?> #postStatus').val('publish');

											     	$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $comp_id; ?>();

											     	e.preventDefault();
													return false;

												});

												$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $comp_id; ?> = function() {

													jQuery('#postStatusForm<?php echo $comp_id; ?>').ajaxSubmit({
													    type: "POST",
														data: jQuery('postStatusForm<?php echo $comp_id; ?>').serializeArray,
														url: '<?php echo admin_url('admin-ajax.php'); ?>',
														beforeSend: function() { 
												        	jQuery('#loading-poststatus-<?php echo $comp_id; ?>').css('display', 'block');
												        	jQuery('#publish-<?php echo $comp_id; ?>').css('display', 'none'); 
												        },	 
													    success: function(response) {
													    	jQuery('#loading-poststatus-<?php echo $comp_id; ?>').css('display', 'none');
															jQuery('#unpublish-<?php echo $comp_id; ?>').css('display', 'block');
															jQuery('#publish-<?php echo $comp_id; ?>').css('display', 'none');
															jQuery('#poststatus-<?php echo $comp_id; ?>').html('published');
															jQuery('#my-account-job-single-title-<?php echo $comp_id; ?>').attr('href', '<?php $view_resume = home_url('/')."resume/".$comp_id; echo $view_resume; ?>');
													        return false;
													    }
													});
												}

												<?php 

												if(($wpjobus_post_reg_status == "featured") || ($wpjobus_post_reg_status == "regular") or (empty($comp_reg_price))) {

												} else {

									    			global $redux_demo;
									    			$stripe_test = $redux_demo['stripe-state'];

									    			if($stripe_test == 2) {
									    				$test_key = $redux_demo['stripe-test-publishable-key'];
									    			} elseif($stripe_test == 1){
									    				$test_key = $redux_demo['stripe-live-publishable-key'];
									    			}

									    		?>

												

												<?php } ?>

											});

										</script>

									<?php } ?>

								</span>

								<?php if(get_post_status($comp_id) == 'pending') { ?>

									<span><i class="fa fa-user"></i><?php _e( 'Public Profile', 'themesdojo' ); ?> (<?php _e( 'Pending review', 'themesdojo' ); ?>)</span>

								<?php } else { ?>

									<a id="my-account-job-single-title-<?php echo $comp_id; ?>" href="<?php if(get_post_status($comp_id) == 'draft') { $view_resume = "#"; } else { $view_resume = home_url('/')."resume/".$comp_id; } echo $view_resume; ?>"><i class="fa fa-user"></i><?php _e( 'Public Profile', 'themesdojo' ); ?></a>

								<?php } ?>

							</span>

							<a class="button-ag-full" href="<?php $edit_resume = home_url('/')."edit-resume/?post=".$comp_id; echo $edit_resume; ?>"><i class="fa fa-file-text-o"></i><?php _e( 'Edit Resume', 'themesdojo' ); ?></a>

						<?php

							} else {

						?>

							<a class="button-ag-full" href="<?php $new_resume = home_url('/')."add-resume"; echo $new_resume; ?>"><i class="fa fa-file-text-o"></i><?php _e( 'Add Resume', 'themesdojo' ); ?></a>

						<?php 

							} 

						?>

					</span>

					<?php } ?>

				</div>

				<div class="my-account-settings">

					<div class="my-account-settings-content">

						<div class="one_half first" style="margin-bottom: 0;">

							<form id="wpjobus-register" type="post" autocomplete="off" action="" >

								<?php

									global $redux_demo; 
									$account_type = $redux_demo['account-state'];

									$key = 'account_type';
									$single = true;
									$user_account_type = get_user_meta( $td_user_id, $key, $single );

									if($account_type == 2) {

								?>

								<span class="one_half first">
									<h3><?php _e( 'Account type:', 'themesdojo' ); ?></h3>
								</span>

								<span class="one_half">
									<select name="account_type" id="account_type" style="width: 100%; margin-bottom: 10px;">
										<option value='job-seeker' <?php selected( "job-seeker", $user_account_type ); ?>><?php _e( 'Job Seeker', 'themesdojo' ); ?></option>
										<option value='job-offer' <?php selected( "job-offer", $user_account_type ); ?>><?php _e( 'Job Offer', 'themesdojo' ); ?></option>
									</select>
								</span>

								<?php } ?>

								<span class="one_half first">
									<h3><?php _e( 'Email:', 'themesdojo' ); ?></h3>
								</span>

								<span class="one_half">
									<input type="text" name="userEmailUpdate" id="userEmailUpdate" class="input-textarea" autocomplete="off"/>
									<label for="userEmailUpdate" class="error userEmailError"></label>
								</span>

								<span class="one_half first">
									<h3><?php _e( 'Password:', 'themesdojo' ); ?></h3>
								</span>

								<span class="one_half">
									<input type="password" name="userPassword" id="userPassword" class="input-textarea" autocomplete="off"/>
								</span>

								<span class="one_half first">
									<h3><?php _e( 'Repeat Password:', 'themesdojo' ); ?></h3>
								</span>

								<span class="one_half">
									<input type="password" name="userConfirmPassword" id="userConfirmPassword" class="input-textarea" autocomplete="off"/>
								</span>

								<input type="hidden" name="userID" value="<?php echo get_current_user_id(); ?>" />
								 
								
								<input type="hidden" name="action" value="wpjobusUpdateAccountForm" />
								<?php wp_nonce_field( 'wpjobusUpdateAccount_html', 'wpjobusUpdateAccount_nonce' ); ?>

								<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Update', 'themesdojo' ); ?>" class="input-submit">	 

								<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>
							  	  
							</form>

							<div id="success">
								<span>
								   	<h3><?php _e( 'Account updated successful.', 'themesdojo' ); ?></h3>
								</span>
							</div>
								 
							<div id="error">
								<span>
								   	<h3><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></h3>
								</span>
							</div>

							<script type="text/javascript">

							jQuery(function($) {
								jQuery('#wpjobus-register').validate({
							        rules: {
							            userEmail: {
							                email: true
							            },
							            userPassword: {
							                minlength: 6,
							            },
							            userConfirmPassword: {
							                minlength: 6,
							                equalTo: "#userPassword"
							            }
							        },
							        messages: {
								        userEmailUpdate: {
								            email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
								        },
								        userPassword: {
								            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>"
								        },
								        userConfirmPassword: {
								            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>",
								            equalTo: "<?php _e( 'Please enter the same password as above', 'themesdojo' ); ?>"
								        }
								    },
							        submitHandler: function(form) {
							        	jQuery('#wpjobus-register .input-submit').css('display','none');
							        	jQuery('#wpjobus-register .submit-loading').css('display','block');
							            jQuery(form).ajaxSubmit({
							            	type: "POST",
									        data: jQuery(form).serializeArray,
									        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
							                success: function(data) {

							                	if(data == 1) {
							                		jQuery('#wpjobus-register :input').attr('disabled', 'disabled');
								                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
								                    	jQuery('#wpjobus-register').css('display','none');
								                        jQuery(this).find(':input').attr('disabled', 'disabled');
								                        jQuery(this).find('label').css('cursor','default');
								                        jQuery('#success').fadeIn();
								                        jQuery('#success span h3').html("<?php _e( 'Password updated successful.', 'themesdojo' ); ?>");

								                        <?php $profile = home_url('/')."login"; ?>
	      												var delay = 500;
	      												setTimeout(function(){ window.location = '<?php echo $profile; ?>';}, delay);

								                    });
							                	}

							                	if(data == 2) {
							                		jQuery('#wpjobus-register :input').attr('disabled', 'disabled');
								                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
								                    	jQuery('#wpjobus-register').css('display','none');
								                        jQuery(this).find(':input').attr('disabled', 'disabled');
								                        jQuery(this).find('label').css('cursor','default');
								                        jQuery('#success').fadeIn();
								                        jQuery('#success span h3').html("<?php _e( 'Account updated successful.', 'themesdojo' ); ?>");

								                        var delay = 10;
      													setTimeout(function(){ window.location.reload(); }, delay); 

								                    });
							                	}

							                	if(data == 3) {
							                		jQuery('#wpjobus-register :input').attr('disabled', 'disabled');
								                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
								                    	jQuery('#wpjobus-register').css('display','none');
								                        jQuery(this).find(':input').attr('disabled', 'disabled');
								                        jQuery(this).find('label').css('cursor','default');
								                        jQuery('#success').fadeIn();
								                        jQuery('#success span h3').html("<?php _e( 'Password and E-mail updated successful.', 'themesdojo' ); ?>");

								                        <?php $profile = home_url('/')."login"; ?>
	      												var delay = 500;
	      												setTimeout(function(){ window.location = '<?php echo $profile; ?>';}, delay);

								                    });
							                	}

							                	if(data == 4) {
							                		jQuery('#wpjobus-register :input').attr('disabled', 'disabled');
								                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
								                    	jQuery('#wpjobus-register').css('display','none');
								                        jQuery(this).find(':input').attr('disabled', 'disabled');
								                        jQuery(this).find('label').css('cursor','default');
								                        jQuery('#success').fadeIn();
								                        jQuery('#success span h3').html("<?php _e( 'Account updated successful.', 'themesdojo' ); ?>");

								                        var delay = 10;
      													setTimeout(function(){ window.location.reload(); }, delay); 

								                    });
							                	}

							                },
							                error: function(data) {
							                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
							                        jQuery('#error').fadeIn();
							                    });
							                }
							            });
							        }
							    });
							});
							</script>

						</div>

					</div>

				</div>

				<div class="my-account-subscriptions">

					<div class="my-account-companies-title">
						<h1 class="resume-section-title" style="margin-bottom: 0;"><i class="fa fa-envelope-o"></i><?php _e( 'Manage E-Mail Subscriptions', 'themesdojo' ); ?></h1>
						<div class="full"><p style="margin-top: 0;"><?php _e( 'Select the categories and locations you want to get notifications by email on new postings from Jobs, Resumes or Companies.', 'themesdojo' ); ?></p></div>
					</div>

					<div class="full" style="margin-bottom: 0;">

						<form id="wpjobus-save-subscriptions" type="post" action="" >

							<ul id="homepage-posts-block" class="tabs-search quicktabs-tabs quicktabs-style-nostyle"> 
							    <li class="grid-feat-ad-style active"><a class="current" href="#"><i class="fa fa-bullhorn"></i><?php _e( 'Job Offers Subscriptions', 'themesdojo' ); ?></a></li>
							   	<li class="list-feat-ad-style"><a class="" href="#"><i class="fa fa-file-text-o"></i><?php _e( 'Resumes Subscriptions', 'themesdojo' ); ?></a></li>
							   	<li class="list-feat-ad-style"><a class="" href="#"><i class="fa fa-briefcase"></i><?php _e( 'Companies Subscriptions', 'themesdojo' ); ?></a></li>
				            </ul>

				            <div class="pane" style="display: block;">

				            	<div class="my-account-subscriptions-title">
									<h1 class="resume-section-title"><?php _e( 'Categories', 'themesdojo' ); ?></h1>
								</div>

								<div class="full subscriptions-block">

									<?php 
										$user_job_categories = get_user_meta( $td_user_id, 'user_job_categories_subcriptions' );
										global $redux_demo, $td_job_industry; 
										for ($i = 0; $i < count($redux_demo['resume-industries']); $i++) {
									?>

									<div class="one_fourth <?php if( $i%4 == 0 ) { echo 'first'; } ?>" style="margin-bottom: 0;">

										<input type="checkbox" name="job-categories[<?php echo $i; ?>]" value="<?php echo $redux_demo['resume-industries'][$i]; ?>" style="float: left; width: auto;" <?php if(!empty($user_job_categories)) { if (in_array($redux_demo['resume-industries'][$i], $user_job_categories[0])) { ?> checked="checked" <?php } } ?> ><?php echo $redux_demo['resume-industries'][$i]; ?>

									</div>

									<?php 
										}
									?>

								</div>

								<div class="my-account-subscriptions-title">
									<h1 class="resume-section-title"><?php _e( 'Locations', 'themesdojo' ); ?></h1>
								</div>

								<div class="full subscriptions-block">

									<?php 
										$user_job_locations = get_user_meta( $td_user_id, 'user_job_locations_subcriptions' );
										global $redux_demo, $td_job_location; 
										for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
									?>

									<div class="one_fourth <?php if( $i%4 == 0 ) { echo 'first'; } ?>" style="margin-bottom: 0;">

										<input type="checkbox" name="job-locations[<?php echo $i; ?>]" value="<?php echo $redux_demo['resume-locations'][$i]; ?>" style="float: left; width: auto;" <?php if(!empty($user_job_locations)) { if (in_array($redux_demo['resume-locations'][$i], $user_job_locations[0])) { ?> checked="checked" <?php } } ?> ><?php echo $redux_demo['resume-locations'][$i]; ?>

									</div>

									<?php 
										}
									?>

								</div>

				            </div>

				            <div class="pane" style="display: block;">

				            	<div class="my-account-subscriptions-title">
									<h1 class="resume-section-title"><?php _e( 'Categories', 'themesdojo' ); ?></h1>
								</div>

								<div class="full subscriptions-block">

									<?php 
										$user_resume_categories = get_user_meta( $td_user_id, 'user_resume_categories_subcriptions' );
										global $redux_demo, $td_job_industry; 
										for ($i = 0; $i < count($redux_demo['resume-industries']); $i++) {
									?>

									<div class="one_fourth <?php if( $i%4 == 0 ) { echo 'first'; } ?>" style="margin-bottom: 0;">

										<input type="checkbox" name="resume-categories[<?php echo $i; ?>]" value="<?php echo $redux_demo['resume-industries'][$i]; ?>" style="float: left; width: auto;" <?php if(!empty($user_resume_categories)) { if (in_array($redux_demo['resume-industries'][$i], $user_resume_categories[0])) { ?> checked="checked" <?php } } ?> ><?php echo $redux_demo['resume-industries'][$i]; ?>

									</div>

									<?php 
										}
									?>

								</div>

								<div class="my-account-subscriptions-title">
									<h1 class="resume-section-title"><?php _e( 'Locations', 'themesdojo' ); ?></h1>
								</div>

								<div class="full subscriptions-block">

									<?php 
										$user_resume_locations = get_user_meta( $td_user_id, 'user_resume_locations_subcriptions' );
										global $redux_demo, $td_job_location; 
										for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
									?>

									<div class="one_fourth <?php if( $i%4 == 0 ) { echo 'first'; } ?>" style="margin-bottom: 0;">

										<input type="checkbox" name="resume-locations[<?php echo $i; ?>]" value="<?php echo $redux_demo['resume-locations'][$i]; ?>" style="float: left; width: auto;" <?php if(!empty($user_resume_locations)) { if (in_array($redux_demo['resume-locations'][$i], $user_resume_locations[0])) { ?> checked="checked" <?php } } ?> ><?php echo $redux_demo['resume-locations'][$i]; ?>

									</div>

									<?php 
										}
									?>

								</div>

				            </div>

				            <div class="pane" style="display: block;">

				            	<div class="my-account-subscriptions-title">
									<h1 class="resume-section-title"><?php _e( 'Categories', 'themesdojo' ); ?></h1>
								</div>

								<div class="full subscriptions-block">

									<?php 
										$user_company_categories = get_user_meta( $td_user_id, 'user_company_categories_subcriptions' );
										global $redux_demo, $td_job_industry; 
										for ($i = 0; $i < count($redux_demo['resume-industries']); $i++) {
									?>

									<div class="one_fourth <?php if( $i%4 == 0 ) { echo 'first'; } ?>" style="margin-bottom: 0;">

										<input type="checkbox" name="company-categories[<?php echo $i; ?>]" value="<?php echo $redux_demo['resume-industries'][$i]; ?>" style="float: left; width: auto;" <?php if(!empty($user_company_categories)) { if (in_array($redux_demo['resume-industries'][$i], $user_company_categories[0])) { ?> checked="checked" <?php } } ?> ><?php echo $redux_demo['resume-industries'][$i]; ?>

									</div>

									<?php 
										}
									?>

								</div>

								<div class="my-account-subscriptions-title">
									<h1 class="resume-section-title"><?php _e( 'Locations', 'themesdojo' ); ?></h1>
								</div>

								<div class="full subscriptions-block">

									<?php 
										$user_company_locations = get_user_meta( $td_user_id, 'user_company_locations_subcriptions' );
										global $redux_demo, $td_job_location; 
										for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
									?>

									<div class="one_fourth <?php if( $i%4 == 0 ) { echo 'first'; } ?>" style="margin-bottom: 0;">

										<input type="checkbox" name="company-locations[<?php echo $i; ?>]" value="<?php echo $redux_demo['resume-locations'][$i]; ?>" style="float: left; width: auto;" <?php if(!empty($user_company_locations)) { if (in_array($redux_demo['resume-locations'][$i], $user_company_locations[0])) { ?> checked="checked" <?php } } ?> ><?php echo $redux_demo['resume-locations'][$i]; ?>

									</div>

									<?php 
										}
									?>

								</div>

				            </div>

				            <div class="full">

				            	<div class="one_half first" style="margin-bottom: 0;">

				            		<span class="close-subscriptions-block"><i class="fa fa-times"></i><?php _e( 'Close', 'themesdojo' ); ?></span>

				            	</div>

				            	<div class="one_half" style="margin-bottom: 0;">

				            		<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Save Subscriptions', 'themesdojo' ); ?>" class="input-submit save-subscriptions-block">	 
									<span class="submit-loading" style="float: right;"><i class="fa fa-refresh fa-spin"></i></span>

				            	</div>

				            </div>

				            <div class="full" style="margin-bottom: 0;">

								<div id="success-subscriptions">
									<span>
										<h3><?php _e( 'Subscriptions Saved Successful.', 'themesdojo' ); ?></h3>
									</span>
									<div class="divider"></div>
								</div>
											 
								<div id="error-subscriptions">
									<span>
										<h3><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></h3>
									</span>
									<div class="divider"></div>
								</div>

							</div>

				            <input type="hidden" id="user_id" name="user_id" value="<?php echo $td_user_id; ?>">

				            <input type="hidden" name="action" value="wpjobusSaveSubscriptionsForm" />
							<?php wp_nonce_field( 'wpjobusSaveSubscriptions_html', 'wpjobusSaveSubscriptions_nonce' ); ?>

				        </form>

				        <script type="text/javascript">

						jQuery(function($) {

							jQuery(document).on("click","#wpjobus-save-subscriptions .save-subscriptions-block",function(e){

								$.fn.wpjobusSaveSubscriptionsFunction();

								e.preventDefault();
								return false;

							});

							$.fn.wpjobusSaveSubscriptionsFunction = function() {

								jQuery('#wpjobus-save-subscriptions').ajaxSubmit({
									type: "POST",
									data: jQuery('#wpjobus-save-subscriptions').serializeArray,
									url: '<?php echo admin_url('admin-ajax.php'); ?>',
									beforeSend: function() { 
									    jQuery('#wpjobus-save-subscriptions .save-subscriptions-block').css('display','none');
									    jQuery('#wpjobus-save-subscriptions .submit-loading').css('display','block');
									},	 
									success: function(data) {
									    jQuery('#wpjobus-save-subscriptions .submit-loading').css('display','none');
									    jQuery('#wpjobus-save-subscriptions .save-subscriptions-block').css('display','block');

									    jQuery('#success-subscriptions').fadeIn();

									    var delay = 20;
      									setTimeout(function(){ 
      										jQuery('#success-subscriptions').fadeOut();
      									}, delay);
									},
									error: function(data) {
									    jQuery('#wpjobus-save-subscriptions .save-subscriptions-block').css('display','block');
									    jQuery('#wpjobus-save-subscriptions .submit-loading').css('display','none');

									    jQuery('#error-subscriptions').fadeIn();
									}
								});

							}
						});
						</script>

					</div>

				</div>

				<?php

					$key = 'account_type';
					$single = true;
					$user_account_type = get_user_meta( $td_user_id, $key, $single ); 

					global $redux_demo; 
					$account_type = $redux_demo['account-state'];

					if($user_account_type == "job-offer" OR $account_type == 1) {

				?>

				<div class="my-account-companies">

					<div class="my-account-companies-title">
						<h1 class="resume-section-title"><i class="fa fa-suitcase"></i><?php _e( 'Company Profiles', 'themesdojo' ); ?></h1>
						<a class="my-account-companies-link" href="<?php $new_company = home_url('/')."add-company"; echo $new_company; ?>"><i class="fa fa-plus-circle"></i><?php _e( 'Add Company Profile', 'themesdojo' ); ?></a>
					</div>

					<div class="my-account-list-header">

						<span class="my-account-company-single-title"><?php _e( 'Title', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-date"><?php _e( 'Added', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-status"><?php _e( 'Status', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-views"><?php _e( 'Views', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-edit"><?php _e( 'Edit', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-delete"><?php _e( 'Delete', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-publish"><?php _e( 'Visibility', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-feature"><?php _e( 'Feature', 'themesdojo' ); ?></span>

					</div>

					<div class="my-account-companies-list">

						<?php 

							$company_id = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE post_type = 'company' and (post_status = 'publish' or post_status = 'draft' or post_status = 'pending') and post_author = '".$td_user_id."' ORDER BY `ID` DESC");

							foreach ($company_id as $key => $value) {
							    $td_result_company[] = $value->ID;
							    $td_result_company_date[] = $value->post_date;
							    $td_result_company_status[] = $value->post_status;

							    $wpjobus_company_fullname = esc_attr(get_post_meta($td_result_company[$key], 'wpjobus_company_fullname',true));

							    $company_id = $td_result_company[$key];

							   ?>

							    <span class="my-account-company-single">

							    	<span id="my-account-job-single-title-<?php echo $td_result_company[$key]; ?>" class="my-account-company-single-title">

							    		<?php if(get_post_status($td_result_company[$key]) == 'pending') { ?>

											<a href="#"><?php echo $wpjobus_company_fullname; ?> (<?php _e( 'Pending review', 'themesdojo' ); ?>)</a>

										<?php } else { ?>

											<a href="<?php if(get_post_status($td_result_company[$key]) == 'draft') { $companylink = "#"; } else { $companylink = home_url('/')."company/".$td_result_company[$key]; } echo $companylink; ?>"><?php echo $wpjobus_company_fullname; ?></a>

										<?php } ?>

							    	</span>

							    	<span class="my-account-company-single-date"><?php echo human_time_diff( strtotime($td_result_company_date[$key]), current_time('timestamp') ) . ' '; _e( 'ago', 'themesdojo' ); ?></span>

							    	<span id="poststatus-<?php echo $td_result_company[$key]; ?>" class="my-account-company-single-status"><?php if($td_result_company_status[$key] == 'publish') { echo _e( 'Published', 'themesdojo' ); } else { echo $td_result_company_status[$key]; } ?></span>

							    	<span class="my-account-company-single-views"><?php $postid = $td_result_company[$key]; echo wpb_get_post_views($postid); ?></span>

							    	<span class="my-account-company-single-edit"><a href="<?php $edit_comp = home_url('/')."edit-company/?post=".$td_result_company[$key]; echo $edit_comp; ?>"><i class="fa fa-pencil-square-o"></i></a></span>

							    	<span class="my-account-company-single-delete">

							    		<?php 

							    		$total_jobs = 0;

							    		$company_jobs = $wpdb->get_results( "SELECT p.ID
																			FROM  `{$wpdb->prefix}posts` p
																			LEFT JOIN  `{$wpdb->prefix}postmeta` m ON p.ID = m.post_id
																			WHERE p.post_type = 'job'
																			AND (p.post_status = 'publish' or p.post_status = 'draft' or p.post_status = 'pending')
																			AND m.meta_key = 'job_company' AND m.meta_value = '".$td_result_company[$key]."'
																			");
				  
										foreach($company_jobs as $job) { 
											$total_jobs++;
										}	

										if($total_jobs > 0) {

							    		?>

							    		<a data-rel="tooltip" rel="top" title="Please first remove jobs asigned to this company!" onclick='return confirm("Please first remove jobs asigned to this company!")' href='#'><i class="fa fa-trash-o"></i></a>

					       			  	<?php } else { ?>

					       			  	<form id="theForm<?php echo $td_result_company[$key]; ?>" name="theForm<?php echo $td_result_company[$key]; ?>" class="delete-listing" action="" method="post">

											<input type="hidden" name="deletepostid" value="<?php echo $td_result_company[$key]; ?>" />

											<a onclick='return confirm("Are you sure you want to delete this?")' href='javascript:document.theForm<?php echo $td_result_company[$key]; ?>.submit();'><i class="fa fa-trash-o"></i></a>

					       			  	</form>

					       			  	<?php } ?>

							    	</span>

							    	<?php if(get_post_status($td_result_company[$key]) != 'pending') { ?>

							    		<span id="unpublish-<?php echo $td_result_company[$key]; ?>" data-rel="tooltip" rel="top" title="<?php _e( "Unpublish", "themesdojo" ); ?>" class="my-account-company-single-publish" <?php if($td_result_company_status[$key] == "draft") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye-slash"></i></span>

							    		<?php 

							    			global $redux_demo; $logo = $redux_demo['stripe-logo']['url']; $comp_reg_price = $redux_demo['company-regular-price']; $dec = sprintf('%.2f', $comp_reg_price / 100); $price_symbol = $redux_demo['job-price-symbol'];

							    			$wpjobus_post_reg_status = esc_attr(get_post_meta($td_result_company[$key], 'wpjobus_featured_post_status',true));

							    			if(($wpjobus_post_reg_status == "featured") || ($wpjobus_post_reg_status == "regular") or (empty($comp_reg_price))) {

							    		?>

							    			<span id="publish-<?php echo $td_result_company[$key]; ?>" data-rel="tooltip" rel="top" title="<?php _e( "Publish", "themesdojo" ); ?>" class="my-account-company-single-publish" <?php if($td_result_company_status[$key] == "publish") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye"></i></span>

							    		<?php } else { ?>

							    			<span id="publish-payed-<?php echo $td_result_company[$key]; ?>" data-rel="tooltip" rel="top" title="<?php echo "Publish for ".$price_symbol.$dec; ?>" class="my-account-company-single-publish" <?php if($td_result_company_status[$key] == "publish") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye"></i></span>

							    		<?php } ?>

							    		<span id="loading-poststatus-<?php echo $td_result_company[$key]; ?>" class="my-account-company-single-publish" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

								    	<form id="postStatusForm<?php echo $td_result_company[$key]; ?>" type="post" action="" >

										    <input type="hidden" id="postId" name="postId" value="<?php echo $td_result_company[$key]; ?>">
										    <input type="hidden" id="postStatus" name="postStatus" value="">

										    <input type="hidden" name="action" value="wpjobusSubmitPostStatus" />
											<?php wp_nonce_field( 'wpjobusSubmitPostStatus_html', 'wpjobusSubmitPostStatus_nonce' ); ?>

									   	</form>

									   	<form id="regularForm<?php echo $td_result_company[$key]; ?>" method="post" action="<?php echo get_template_directory_uri(); ?>/paypal/form-handler-regular.php?func=addrow">

									    	<?php global $redux_demo; if(isset($redux_demo['company-regular-validity'])) { $comp_valid = $redux_demo['company-regular-validity']; } $comp_price = $redux_demo['company-regular-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100);  ?>

											<input type="hidden" name="AMT" value="<?php echo $dec; ?>" />
											<input type="hidden" name="plan_price" value="<?php echo $dec; ?>">
											<input type="hidden" name="PAYMENTREQUEST_0_DESC" value="<?php echo $td_result_company[$key]; ?>" />
											<?php global $redux_demo; $currency_code = $redux_demo['currency_code']; ?>
											<input type="hidden" name="CURRENCYCODE" value="<?php echo $currency_code; ?>">

											<?php $planID = uniqid(); ?>
											<input type="hidden" name="PAYMENTREQUEST_0_CUSTOM" value="<?php echo $planID; ?>">

											<input type="hidden" name="user_ID" value="<?php echo $td_user_id; ?>">

											<input type="hidden" name="plan_name" value="<?php echo $td_result_company[$key]; ?>">

											<input type="hidden" id="featPostId" name="featPostId" value="<?php echo $td_result_company[$key]; ?>">
									    	<input type="hidden" id="featPostStatus" name="featPostStatus" value="featured">
									    	<input type="hidden" id="featPostValid" name="featPostValid" value="<?php echo $comp_valid; ?>">

								    		<?php $plan_time = get_post_meta($post->ID, 'plan_time', true); ?>
								    		<input type="hidden" name="plan_time" value="<?php echo $plan_time; ?>">

								    		<?php $date = date('d/m/Y H:i:s'); ?>
								    		<input type="hidden" name="date" value="<?php echo $date; ?>">

								    		<input type="hidden" name="url" value="<?php echo get_template_directory_uri(); ?>">

											<?php global $redux_demo; $paypal_success = $redux_demo['paypal_success']; $paypal_fail = $redux_demo['paypal_fail']; ?>
															  
											<?php if ( isset($paypal_success) ) { ?>
												<input type="hidden" name="RETURN_URL" value="<?php echo $paypal_success; ?>" />
											<?php } ?>
													  
											<?php if ( isset($paypal_fail) ) { ?>
												<input type="hidden" name="CANCEL_URL" value="<?php echo $paypal_fail; ?>" />
											<?php } ?>
															  
											<input type="hidden" name="func" value="start" />

										</form>

									    <script type="text/javascript">

											jQuery(function($) {

												jQuery('#publish-payed-<?php echo $td_result_company[$key]; ?>').click(function(e) {

		  											e.preventDefault();  // don't submit it
												    jQuery("#regularForm<?php echo $td_result_company[$key]; ?>").trigger('submit')

												});

												jQuery(document).on("click","#unpublish-<?php echo $td_result_company[$key]; ?>",function(e){

													jQuery('#postStatusForm<?php echo $td_result_company[$key]; ?> #postStatus').val('unpublish');

												    $.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $td_result_company[$key]; ?>();

													e.preventDefault();
													return false;

												});

												jQuery("#unpublish-<?php echo $td_result_company[$key]; ?>").click(function(e){

													jQuery('#postStatusForm<?php echo $td_result_company[$key]; ?> #postStatus').val('unpublish');

													$.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $td_result_company[$key]; ?>();

													e.preventDefault();
													return false;

												});

												$.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $td_result_company[$key]; ?> = function() {

													jQuery('#postStatusForm<?php echo $td_result_company[$key]; ?>').ajaxSubmit({
													    type: "POST",
														data: jQuery('postStatusForm<?php echo $td_result_company[$key]; ?>').serializeArray,
														url: '<?php echo admin_url('admin-ajax.php'); ?>',
														beforeSend: function() { 
												        	jQuery('#loading-poststatus-<?php echo $td_result_company[$key]; ?>').css('display', 'block');
												        	jQuery('#unpublish-<?php echo $td_result_company[$key]; ?>').css('display', 'none');
												        },	 
													    success: function(response) {
													    	jQuery('#loading-poststatus-<?php echo $td_result_company[$key]; ?>').css('display', 'none');
															jQuery('#publish-<?php echo $td_result_company[$key]; ?>').css('display', 'block');
															jQuery('#unpublish-<?php echo $td_result_company[$key]; ?>').css('display', 'none');
															jQuery('#poststatus-<?php echo $td_result_company[$key]; ?>').html('draft');
															jQuery('#my-account-job-single-title-<?php echo $td_result_company[$key]; ?> a').attr('href', '#');
													        return false;
													    }
													});
												}


												jQuery(document).on("click","#publish-<?php echo $td_result_company[$key]; ?>",function(e){

													jQuery('#postStatusForm<?php echo $td_result_company[$key]; ?> #postStatus').val('publish');

											     	$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $td_result_company[$key]; ?>();

											     	e.preventDefault();
													return false;

												});

												jQuery("#publish-<?php echo $td_result_company[$key]; ?>").click(function(e){

													jQuery('#postStatusForm<?php echo $td_result_company[$key]; ?> #postStatus').val('publish');

											     	$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $td_result_company[$key]; ?>();

											     	e.preventDefault();
													return false;

												});

												$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $td_result_company[$key]; ?> = function() {

													jQuery('#postStatusForm<?php echo $td_result_company[$key]; ?>').ajaxSubmit({
													    type: "POST",
														data: jQuery('postStatusForm<?php echo $td_result_company[$key]; ?>').serializeArray,
														url: '<?php echo admin_url('admin-ajax.php'); ?>',
														beforeSend: function() { 
												        	jQuery('#loading-poststatus-<?php echo $td_result_company[$key]; ?>').css('display', 'block');
												        	jQuery('#publish-<?php echo $td_result_company[$key]; ?>').css('display', 'none'); 
												        },	 
													    success: function(response) {
													    	jQuery('#loading-poststatus-<?php echo $td_result_company[$key]; ?>').css('display', 'none');
															jQuery('#unpublish-<?php echo $td_result_company[$key]; ?>').css('display', 'block');
															jQuery('#publish-<?php echo $td_result_company[$key]; ?>').css('display', 'none');
															jQuery('#poststatus-<?php echo $td_result_company[$key]; ?>').html('publish');
															jQuery('#my-account-job-single-title-<?php echo $td_result_company[$key]; ?> a').attr('href', '<?php $companylink = home_url('/')."company/".$td_result_company[$key]; echo $companylink; ?>');
													        return false;
													    }
													});
												}

												<?php 

												if(($wpjobus_post_reg_status == "featured") || ($wpjobus_post_reg_status == "regular") or (empty($comp_reg_price))) {

												} else {

									    			global $redux_demo;
									    			$stripe_test = $redux_demo['stripe-state'];

									    			if($stripe_test == 2) {
									    				$test_key = $redux_demo['stripe-test-publishable-key'];
									    			} elseif($stripe_test == 1){
									    				$test_key = $redux_demo['stripe-live-publishable-key'];
									    			}

									    		?>

												

												<?php } ?>

											});

										</script>

							    	<?php } ?>

							    	<?php if(get_post_status($td_result_company[$key]) != 'pending') { ?>

								    	<span class="my-account-job-single-feature">

								    		<?php global $redux_demo; $logo = $redux_demo['stripe-logo']['url']; $comp_valid = $redux_demo['company-featured-validity']; $comp_price = $redux_demo['company-featured-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100); 

								    		if(!empty($comp_price)) { 

								    			$featured_post_status = esc_attr(get_post_meta($td_result_company[$key], 'wpjobus_featured_post_status',true)); 

								    			if($featured_post_status == "featured" ) { 

								    				$featured_expiration_date = esc_attr(get_post_meta($td_result_company[$key], 'wpjobus_featured_expiration_date',true)); 
								    				$currentDate = current_time('timestamp');

								    				if(!empty($featured_expiration_date)) {

									    				$timeStampCleanDate = date( "m/d/Y", $featured_expiration_date);

									    			} else { ?>

									    				<script type="text/javascript">

															jQuery(function($) {

																window.location.reload(true);

															});

														</script>

									    			<?php }

								    				if($featured_expiration_date >= $currentDate) {

								    		?>

								    		<span data-rel="tooltip" rel="top" title="<?php _e( "Featured until", "themesdojo" ); ?> <?php echo $timeStampCleanDate; ?>" id="featured" class="make-featured"><i class="fa fa-star"></i></span>

											<?php 

													} else {

														update_post_meta($td_result_company[$key], 'wpjobus_featured_post_status', 'regular');

													}

												} else { 

												?>

									    		<span data-rel="tooltip" rel="top" title="<?php echo "Feature ".$price_symbol.$dec."/".$comp_valid." Days"; ?>" id="make-featured-<?php echo $td_result_company[$key]; ?>" class="make-featured"><i class="fa fa-star-o"></i></span>

									    		<span id="loading-featured-<?php echo $td_result_company[$key]; ?>" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

									    		<form id="featForm<?php echo $td_result_company[$key]; ?>" method="post" action="<?php echo get_template_directory_uri(); ?>/paypal/form-handler.php?func=addrow">

									    			<?php global $redux_demo; $comp_valid = $redux_demo['company-featured-validity']; $comp_price = $redux_demo['company-featured-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100);  ?>

													<input type="hidden" name="AMT" value="<?php echo $dec; ?>" />
													<input type="hidden" name="plan_price" value="<?php echo $dec; ?>">
													<input type="hidden" name="PAYMENTREQUEST_0_DESC" value="<?php echo $td_result_company[$key]; ?>" />
													<?php global $redux_demo; $currency_code = $redux_demo['currency_code']; ?>
													<input type="hidden" name="CURRENCYCODE" value="<?php echo $currency_code; ?>">

													<?php $planID = uniqid(); ?>
													<input type="hidden" name="PAYMENTREQUEST_0_CUSTOM" value="<?php echo $planID; ?>">

													<input type="hidden" name="user_ID" value="<?php echo $td_user_id; ?>">

													<input type="hidden" name="plan_name" value="<?php echo $td_result_company[$key]; ?>">

													<input type="hidden" id="featPostId" name="featPostId" value="<?php echo $td_result_company[$key]; ?>">
									    			<input type="hidden" id="featPostStatus" name="featPostStatus" value="featured">
									    			<input type="hidden" id="featPostValid" name="featPostValid" value="<?php echo $comp_valid; ?>">

								    				<?php $plan_time = get_post_meta($post->ID, 'plan_time', true); ?>
								    				<input type="hidden" name="plan_time" value="<?php echo $plan_time; ?>">

								    				<?php $date = date('d/m/Y H:i:s'); ?>
								    				<input type="hidden" name="date" value="<?php echo $date; ?>">

								    				<input type="hidden" name="url" value="<?php echo get_template_directory_uri(); ?>">

													<?php global $redux_demo; $paypal_success = $redux_demo['paypal_success']; $paypal_fail = $redux_demo['paypal_fail']; ?>
															  
													<?php if ( isset($paypal_success) ) { ?>
														<input type="hidden" name="RETURN_URL" value="<?php echo $paypal_success; ?>" />
													<?php } ?>
															  
													<?php if ( isset($paypal_fail) ) { ?>
														<input type="hidden" name="CANCEL_URL" value="<?php echo $paypal_fail; ?>" />
													<?php } ?>
															  
													<input type="hidden" name="func" value="start" />

												</form>

									    		<script>

									    		jQuery('#make-featured-<?php echo $td_result_company[$key]; ?>').click(function(e) {

  													e.preventDefault();  // don't submit it
										    		jQuery("#featForm<?php echo $td_result_company[$key]; ?>").trigger('submit')

											    });

												</script>

											<?php

												}

											}

											$featured_post_status = esc_attr(get_post_meta($td_result_company[$key], 'wpjobus_featured_post_status',true));

											if($featured_post_status == "featured" and empty($comp_price)) { 

												$featured_expiration_date = esc_attr(get_post_meta($td_result_company[$key], 'wpjobus_featured_expiration_date',true)); 
								    			$currentDate = current_time('timestamp');

								    			$timeStampCleanDate = date( "m/d/Y", $featured_expiration_date);

								    			if($featured_expiration_date >= $currentDate) {

											?>

											<span data-rel="tooltip" rel="top" title="<?php _e( "Featured until", "themesdojo" ); ?> <?php echo $timeStampCleanDate; ?>" id="featured" class="make-featured"><i class="fa fa-star"></i></span>

											<?php } } ?>

								    	</span>

							    	<?php } ?>

							    </span>

							    <?php
							}

						?>

					</div>

				</div>

				<div class="my-account-jobs">

					<div class="my-account-jobs-title">
						<h1 class="resume-section-title"><i class="fa fa-bullhorn"></i><?php _e( 'Job Offers', 'themesdojo' ); ?></h1>
						<a class="my-account-companies-link" href="<?php $new_job = home_url('/')."add-job"; echo $new_job; ?>"><i class="fa fa-plus-circle"></i><?php _e( 'Add Job Offer', 'themesdojo' ); ?></a>
					</div>

					<div class="my-account-list-header">

						<span class="my-account-job-single-title"><?php _e( 'Title', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-company"><?php _e( 'Company', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-date"><?php _e( 'Added', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-status"><?php _e( 'Status', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-views"><?php _e( 'Views', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-edit"><?php _e( 'Edit', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-delete"><?php _e( 'Delete', 'themesdojo' ); ?></span>

						<span class="my-account-company-single-publish"><?php _e( 'Visibility', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-feature"><?php _e( 'Feature', 'themesdojo' ); ?></span>

					</div>

					<div class="my-account-jobs-list">

						<?php 

							$job_id = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE post_type = 'job' and (post_status = 'publish' or post_status = 'draft' or post_status = 'pending') and post_author = '".$td_user_id."' ORDER BY `ID` DESC");

							foreach ($job_id as $key => $value) {
							    $td_result_job[] = $value->ID;
							    $td_result_job_date[] = $value->post_date;
							    $td_result_job_status[] = $value->post_status;

							    $wpjobus_job_fullname = esc_attr(get_post_meta($td_result_job[$key], 'wpjobus_job_fullname',true));

							    $td_job_company = esc_attr(get_post_meta($td_result_job[$key], 'job_company',true));

							    $wpjobus_company_fullname = esc_attr(get_post_meta($td_job_company, 'wpjobus_company_fullname',true));

							    $job_id = $td_result_job[$key];

							?>

							    <span class="my-account-job-single">

							    	<span id="my-account-job-single-title-<?php echo $td_result_job[$key]; ?>" class="my-account-job-single-title">

							    		<?php if(get_post_status($td_result_job[$key]) == 'pending') { ?>

											<a href="#"><?php echo $wpjobus_job_fullname; ?> (<?php _e( 'Pending review', 'themesdojo' ); ?>)</a>

										<?php } else { ?>

											<a href="<?php if(get_post_status($td_result_job[$key]) == 'draft') { $joblink = "#"; } else { $joblink = home_url('/')."job/".$td_result_job[$key]; } echo $joblink; ?>"><?php echo $wpjobus_job_fullname; ?></a>

										<?php } ?>

							    	</span>

							    	<span class="my-account-job-single-company"><?php echo $wpjobus_company_fullname; ?></span>

							    	<span class="my-account-job-single-date"><?php echo human_time_diff( strtotime($td_result_job_date[$key]), current_time('timestamp') ) . ' '; _e( 'ago', 'themesdojo' ); ?></span>

							    	<span id="poststatus-<?php echo $td_result_job[$key]; ?>" class="my-account-job-single-status"><?php if($td_result_job_status[$key] == 'publish') { echo _e( 'Published', 'themesdojo' ); } else { echo $td_result_job_status[$key]; } ?></span>

							    	<span class="my-account-company-single-views"><?php $postid = $td_result_job[$key]; echo wpb_get_post_views($postid); ?></span>

							    	<span class="my-account-job-single-edit"><a href="<?php $edit_job = home_url('/')."edit-job/?post=".$td_result_job[$key]; echo $edit_job; ?>"><i class="fa fa-pencil-square-o"></i></a></span>

							    	<span class="my-account-job-single-delete">

							    		<form name="theForm<?php echo $td_result_job[$key]; ?>" class="delete-listing" action="" method="post">

											<input type="hidden" name="deletepostid" value="<?php echo $td_result_job[$key]; ?>" />

											<a onclick='return confirm("Are you sure you want to delete this?")' href='javascript:document.theForm<?php echo $td_result_job[$key]; ?>.submit();'><i class="fa fa-trash-o"></i></a>

					       			  	</form>

							    	</span>

							    	<?php if(get_post_status($td_result_job[$key]) != 'pending') { ?>

							    		<span id="unpublish-<?php echo $td_result_job[$key]; ?>" data-rel="tooltip" rel="top" title="<?php _e( "Unpublish", "themesdojo" ); ?>" class="my-account-company-single-publish" <?php if($td_result_job_status[$key] == "draft") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye-slash"></i></span>

							    		<?php 

							    			global $redux_demo; $logo = $redux_demo['stripe-logo']['url']; $comp_reg_price = $redux_demo['job-regular-price']; $dec = sprintf('%.2f', $comp_reg_price / 100); $price_symbol = $redux_demo['job-price-symbol'];

							    			$wpjobus_post_reg_status = esc_attr(get_post_meta($td_result_job[$key], 'wpjobus_featured_post_status',true));

							    			if(($wpjobus_post_reg_status == "featured") || ($wpjobus_post_reg_status == "regular") or (empty($comp_reg_price))) {

							    		?>

							    			<span id="publish-<?php echo $td_result_job[$key]; ?>" data-rel="tooltip" rel="top" title="<?php _e( "Publish", "themesdojo" ); ?>" class="my-account-company-single-publish" <?php if($td_result_job_status[$key] == "publish") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye"></i></span>

							    		<?php } else { ?>

							    			<span id="publish-payed-<?php echo $td_result_job[$key]; ?>" data-rel="tooltip" rel="top" title="<?php echo "Publish for ".$price_symbol.$dec; ?>" class="my-account-company-single-publish" <?php if($td_result_job_status[$key] == "publish") { ?>style="display: none;"<?php } ?>><i class="fa fa-eye"></i></span>

							    		<?php } ?>

							    		<span id="loading-poststatus-<?php echo $td_result_job[$key]; ?>" class="my-account-company-single-publish" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

								    	<form id="postStatusForm<?php echo $td_result_job[$key]; ?>" type="post" action="" >

										    <input type="hidden" id="postId" name="postId" value="<?php echo $td_result_job[$key]; ?>">
										    <input type="hidden" id="postStatus" name="postStatus" value="">

										    <input type="hidden" name="action" value="wpjobusSubmitPostStatus" />
											<?php wp_nonce_field( 'wpjobusSubmitPostStatus_html', 'wpjobusSubmitPostStatus_nonce' ); ?>

									   	</form>

									   	<form id="regularForm<?php echo $td_result_job[$key]; ?>" method="post" action="<?php echo get_template_directory_uri(); ?>/paypal/form-handler-regular.php?func=addrow">

									    	<?php global $redux_demo; if(isset($redux_demo['job-regular-validity'])) { $comp_valid = $redux_demo['job-regular-validity']; } $comp_price = $redux_demo['job-regular-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100);  ?>

											<input type="hidden" name="AMT" value="<?php echo $dec; ?>" />
											<input type="hidden" name="plan_price" value="<?php echo $dec; ?>">
											<input type="hidden" name="PAYMENTREQUEST_0_DESC" value="<?php echo $td_result_job[$key]; ?>" />
											<?php global $redux_demo; $currency_code = $redux_demo['currency_code']; ?>
											<input type="hidden" name="CURRENCYCODE" value="<?php echo $currency_code; ?>">

											<?php $planID = uniqid(); ?>
											<input type="hidden" name="PAYMENTREQUEST_0_CUSTOM" value="<?php echo $planID; ?>">

											<input type="hidden" name="user_ID" value="<?php echo $td_user_id; ?>">

											<input type="hidden" name="plan_name" value="<?php echo $td_result_job[$key]; ?>">

											<input type="hidden" id="featPostId" name="featPostId" value="<?php echo $td_result_job[$key]; ?>">
									    	<input type="hidden" id="featPostStatus" name="featPostStatus" value="featured">
									    	<input type="hidden" id="featPostValid" name="featPostValid" value="<?php echo $comp_valid; ?>">

								    		<?php $plan_time = get_post_meta($post->ID, 'plan_time', true); ?>
								    		<input type="hidden" name="plan_time" value="<?php echo $plan_time; ?>">

								    		<?php $date = date('d/m/Y H:i:s'); ?>
								    		<input type="hidden" name="date" value="<?php echo $date; ?>">

								    		<input type="hidden" name="url" value="<?php echo get_template_directory_uri(); ?>">

											<?php global $redux_demo; $paypal_success = $redux_demo['paypal_success']; $paypal_fail = $redux_demo['paypal_fail']; ?>
															  
											<?php if ( isset($paypal_success) ) { ?>
												<input type="hidden" name="RETURN_URL" value="<?php echo $paypal_success; ?>" />
											<?php } ?>
													  
											<?php if ( isset($paypal_fail) ) { ?>
												<input type="hidden" name="CANCEL_URL" value="<?php echo $paypal_fail; ?>" />
											<?php } ?>
															  
											<input type="hidden" name="func" value="start" />

										</form>

									    <script type="text/javascript">

											jQuery(function($) {

												jQuery('#publish-payed-<?php echo $td_result_job[$key]; ?>').click(function(e) {

		  											e.preventDefault();  // don't submit it
												    jQuery("#regularForm<?php echo $td_result_job[$key]; ?>").trigger('submit')

												});

												jQuery(document).on("click","#unpublish-<?php echo $td_result_job[$key]; ?>",function(e){

													jQuery('#postStatusForm<?php echo $td_result_job[$key]; ?> #postStatus').val('unpublish');

												    $.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $td_result_job[$key]; ?>();

													e.preventDefault();
													return false;

												});

												jQuery("#unpublish-<?php echo $td_result_job[$key]; ?>").click(function(e){

													jQuery('#postStatusForm<?php echo $td_result_job[$key]; ?> #postStatus').val('unpublish');

													$.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $td_result_job[$key]; ?>();

													e.preventDefault();
													return false;

												});

												$.fn.wpjobusSubmitPostStatusUnpublishFunction<?php echo $td_result_job[$key]; ?> = function() {

													jQuery('#postStatusForm<?php echo $td_result_job[$key]; ?>').ajaxSubmit({
													    type: "POST",
														data: jQuery('postStatusForm<?php echo $td_result_job[$key]; ?>').serializeArray,
														url: '<?php echo admin_url('admin-ajax.php'); ?>',
														beforeSend: function() { 
												        	jQuery('#loading-poststatus-<?php echo $td_result_job[$key]; ?>').css('display', 'block');
												        	jQuery('#unpublish-<?php echo $td_result_job[$key]; ?>').css('display', 'none');
												        },	 
													    success: function(response) {
													    	jQuery('#loading-poststatus-<?php echo $td_result_job[$key]; ?>').css('display', 'none');
															jQuery('#publish-<?php echo $td_result_job[$key]; ?>').css('display', 'block');
															jQuery('#unpublish-<?php echo $td_result_job[$key]; ?>').css('display', 'none');
															jQuery('#poststatus-<?php echo $td_result_job[$key]; ?>').html('draft');
															jQuery('#my-account-job-single-title-<?php echo $td_result_job[$key]; ?> a').attr('href', '#');
													        return false;
													    }
													});
												}


												jQuery(document).on("click","#publish-<?php echo $td_result_job[$key]; ?>",function(e){

													jQuery('#postStatusForm<?php echo $td_result_job[$key]; ?> #postStatus').val('publish');

											     	$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $td_result_job[$key]; ?>();

											     	e.preventDefault();
													return false;

												});

												jQuery("#publish-<?php echo $td_result_job[$key]; ?>").click(function(e){

													jQuery('#postStatusForm<?php echo $td_result_job[$key]; ?> #postStatus').val('publish');

											     	$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $td_result_job[$key]; ?>();

											     	e.preventDefault();
													return false;

												});

												$.fn.wpjobusSubmitPostStatusPublishFunction<?php echo $td_result_job[$key]; ?> = function() {

													jQuery('#postStatusForm<?php echo $td_result_job[$key]; ?>').ajaxSubmit({
													    type: "POST",
														data: jQuery('postStatusForm<?php echo $td_result_job[$key]; ?>').serializeArray,
														url: '<?php echo admin_url('admin-ajax.php'); ?>',
														beforeSend: function() { 
												        	jQuery('#loading-poststatus-<?php echo $td_result_job[$key]; ?>').css('display', 'block');
												        	jQuery('#publish-<?php echo $td_result_job[$key]; ?>').css('display', 'none'); 
												        },	 
													    success: function(response) {
													    	jQuery('#loading-poststatus-<?php echo $td_result_job[$key]; ?>').css('display', 'none');
															jQuery('#unpublish-<?php echo $td_result_job[$key]; ?>').css('display', 'block');
															jQuery('#publish-<?php echo $td_result_job[$key]; ?>').css('display', 'none');
															jQuery('#poststatus-<?php echo $td_result_job[$key]; ?>').html('published');
															jQuery('#my-account-job-single-title-<?php echo $td_result_job[$key]; ?> a').attr('href', '<?php $joblink = home_url('/')."job/".$td_result_job[$key]; echo $joblink; ?>');
															
													        return false;
													    }
													});
												}

												<?php 

												if(($wpjobus_post_reg_status == "featured") || ($wpjobus_post_reg_status == "regular") or (empty($comp_reg_price))) {

												} else {

									    			global $redux_demo;
									    			$stripe_test = $redux_demo['stripe-state'];

									    			if($stripe_test == 2) {
									    				$test_key = $redux_demo['stripe-test-publishable-key'];
									    			} elseif($stripe_test == 1){
									    				$test_key = $redux_demo['stripe-live-publishable-key'];
									    			}

									    		?>

												

												<?php } ?>

											});

										</script>

							    	<?php } ?>

							    	<?php if(get_post_status($td_result_job[$key]) != 'pending') { ?>

								    	<span class="my-account-job-single-feature">

								    		<?php global $redux_demo; $logo = $redux_demo['stripe-logo']['url']; $comp_valid = $redux_demo['job-featured-validity']; $comp_price = $redux_demo['job-featured-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100); 

								    		if(!empty($comp_price)) { 

								    			$featured_post_status = esc_attr(get_post_meta($td_result_job[$key], 'wpjobus_featured_post_status',true)); 

								    			if($featured_post_status == "featured" ) { 

								    				$featured_expiration_date = esc_attr(get_post_meta($td_result_job[$key], 'wpjobus_featured_expiration_date',true)); 
								    				$currentDate = current_time('timestamp');

								    				if(!empty($featured_expiration_date)) {

									    				$timeStampCleanDate = date( "m/d/Y", $featured_expiration_date);

									    			} else { ?>

									    				<script type="text/javascript">

															jQuery(function($) {

																window.location.reload(true);

															});

														</script>

									    			<?php }

								    				if($featured_expiration_date >= $currentDate) {

								    		?>

								    		<span data-rel="tooltip" rel="top" title="<?php _e( "Featured until", "themesdojo" ); ?> <?php echo $timeStampCleanDate; ?>" id="featured" class="make-featured"><i class="fa fa-star"></i></span>

											<?php 

													} else {

														update_post_meta($td_result_job[$key], 'wpjobus_featured_post_status', 'regular');

													}

												} else { 

												?>

									    		<span data-rel="tooltip" rel="top" title="<?php echo "Feature ".$price_symbol.$dec."/".$comp_valid." Days"; ?>" id="make-featured-<?php echo $td_result_job[$key]; ?>" class="make-featured"><i class="fa fa-star-o"></i></span>

									    		<span id="loading-featured-<?php echo $td_result_job[$key]; ?>" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>

									    		<form id="featForm<?php echo $td_result_job[$key]; ?>" method="post" action="<?php echo get_template_directory_uri(); ?>/paypal/form-handler.php?func=addrow">

									    			<?php global $redux_demo; $comp_valid = $redux_demo['job-featured-validity']; $comp_price = $redux_demo['job-featured-price']; $price_symbol = $redux_demo['job-price-symbol']; $dec = sprintf('%.2f', $comp_price / 100);  ?>

													<input type="hidden" name="AMT" value="<?php echo $dec; ?>" />
													<input type="hidden" name="plan_price" value="<?php echo $dec; ?>">
													<input type="hidden" name="PAYMENTREQUEST_0_DESC" value="<?php echo $td_result_job[$key]; ?>" />
													<?php global $redux_demo; $currency_code = $redux_demo['currency_code']; ?>
													<input type="hidden" name="CURRENCYCODE" value="<?php echo $currency_code; ?>">

													<?php $planID = uniqid(); ?>
													<input type="hidden" name="PAYMENTREQUEST_0_CUSTOM" value="<?php echo $planID; ?>">

													<input type="hidden" name="user_ID" value="<?php echo $td_user_id; ?>">

													<input type="hidden" name="plan_name" value="<?php echo $td_result_job[$key]; ?>">

													<input type="hidden" id="featPostId" name="featPostId" value="<?php echo $td_result_job[$key]; ?>">
									    			<input type="hidden" id="featPostStatus" name="featPostStatus" value="featured">
									    			<input type="hidden" id="featPostValid" name="featPostValid" value="<?php echo $comp_valid; ?>">

								    				<?php $plan_time = get_post_meta($post->ID, 'plan_time', true); ?>
								    				<input type="hidden" name="plan_time" value="<?php echo $plan_time; ?>">

								    				<?php $date = date('d/m/Y H:i:s'); ?>
								    				<input type="hidden" name="date" value="<?php echo $date; ?>">

								    				<input type="hidden" name="url" value="<?php echo get_template_directory_uri(); ?>">

													<?php global $redux_demo; $paypal_success = $redux_demo['paypal_success']; $paypal_fail = $redux_demo['paypal_fail']; ?>
															  
													<?php if ( isset($paypal_success) ) { ?>
														<input type="hidden" name="RETURN_URL" value="<?php echo $paypal_success; ?>" />
													<?php } ?>
															  
													<?php if ( isset($paypal_fail) ) { ?>
														<input type="hidden" name="CANCEL_URL" value="<?php echo $paypal_fail; ?>" />
													<?php } ?>
															  
													<input type="hidden" name="func" value="start" />

												</form>

									    		<script>

									    		jQuery('#make-featured-<?php echo $td_result_job[$key]; ?>').click(function(e) {

  													e.preventDefault();  // don't submit it
										    		jQuery("#featForm<?php echo $td_result_job[$key]; ?>").trigger('submit')

											    });

												</script>

											<?php

												}

											}

											$featured_post_status = esc_attr(get_post_meta($td_result_job[$key], 'wpjobus_featured_post_status',true));

											if($featured_post_status == "featured" and empty($comp_price)) { 

												$featured_expiration_date = esc_attr(get_post_meta($td_result_job[$key], 'wpjobus_featured_expiration_date',true)); 
								    			$currentDate = current_time('timestamp');

								    			$timeStampCleanDate = date( "m/d/Y", $featured_expiration_date);

								    			if($featured_expiration_date >= $currentDate) {

											?>

											<span data-rel="tooltip" rel="top" title="<?php _e( "Featured until", "themesdojo" ); ?> <?php echo $timeStampCleanDate; ?>" id="featured" class="make-featured"><i class="fa fa-star"></i></span>

											<?php } } ?>

								    	</span>

							    	<?php } ?>

							    </span>

							    <?php
							}

						?>

					</div>

				</div>

				<?php } ?>

				<div class="my-account-jobs">

					<div class="my-account-jobs-title">
						<h1 class="resume-section-title"><i class="fa fa-heart"></i><?php _e( 'My Favorites', 'themesdojo' ); ?></h1>
					</div>

					<div class="my-account-list-header">

						<span class="my-account-job-single-title" style="width: 35%;"><?php _e( 'Title', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-company" style="width: 15%;"><?php _e( 'Type', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-date" style="width: 35%;"><?php _e( 'Added', 'themesdojo' ); ?></span>

						<span class="my-account-job-single-delete" style="width: 15%;"><?php _e( 'Delete', 'themesdojo' ); ?></span>

					</div>

					<div class="my-account-jobs-list">

						<?php 

							global $wpdb;
							$listing_id = $wpdb->get_results( "SELECT * FROM wpjobus_favorites WHERE user_id = '".$td_user_id."' ORDER BY `ID` DESC");

							foreach ($listing_id as $key => $value) {
							    $td_result_listing[] = $value->listing_id;
							    $listing_id = $td_result_listing[$key];
							    $listing_type = $value->listing_type;
							    $listing_fullname = esc_attr(get_post_meta($listing_id, 'wpjobus_'.$listing_type.'_fullname',true));;

							?>

								<?php if(get_post_status($listing_id) == 'publish') { ?>

								    <span id="listing-<?php echo $listing_id; ?>" class="my-account-job-single">

								    	<div id="post-preloader-<?php echo $listing_id; ?>" class="pending-post-single-loading">
											<i class="fa fa-spinner fa-spin"></i>
										</div>

								    	<span id="my-account-<?php echo $listing_type; ?>-single-title-<?php echo $listing_id; ?>" class="my-account-job-single-title" style="width: 35%;">

								    		<a href="<?php $listinglink = home_url('/')."".$listing_type."/".$listing_id; echo $listinglink; ?>"><?php echo $listing_fullname; ?></a>

								    	</span>

								    	<span class="my-account-job-single-company" style="text-transform: capitalize; width: 15%;"><?php echo $listing_type; ?></span>

								    	<span class="my-account-job-single-date" style="width: 35%;"><?php echo human_time_diff( strtotime(get_the_date('', $listing_id)), current_time('timestamp') ) . ' '; _e( 'ago', 'themesdojo' ); ?></span>

								    	<span class="my-account-job-single-delete" style="width: 15%;">

								    		<a id="like-listing-remove-<?php echo $listing_id; ?>" href="#"><i class="fa fa-trash-o"></i></a>

								    		<form id="favorite-form-<?php echo $listing_id; ?>" method="post" class="form">

								      			<input name="favorite_listing_id" id="favorite_listing_id" type="hidden" value="<?php echo $listing_id; ?>" />
								      			<input name="favorite_user_id" id="favorite_user_id" type="hidden" value="<?php $td_user_id = get_current_user_id(); echo $td_user_id; ?>" />
								      			<input name="favorite_status" id="favorite_status" type="hidden" value="1" />
								      			<input name="favorite_type" id="favorite_type" type="hidden" value="<?php echo $listing_type; ?>" />

												<input type="hidden" name="action" value="favoriteForm" />
												<?php wp_nonce_field( 'favoriteForm_html', 'favoriteForm_nonce' ); ?>

											</form>

								      		<script type="text/javascript">

													jQuery(function($) {

														document.getElementById('like-listing-remove-<?php echo $listing_id; ?>').addEventListener('click', function(e) {
																		
															$.fn.favoriteForm<?php echo $listing_id; ?>();

															e.preventDefault();

														});

														$.fn.favoriteForm<?php echo $listing_id; ?> = function() {

															jQuery('#favorite-form-<?php echo $listing_id; ?>').ajaxSubmit({
																type: "POST",
																data: jQuery('#favorite-form').serializeArray,
																url: '<?php echo admin_url('admin-ajax.php'); ?>',
																beforeSend: function() {
														        	jQuery('#post-preloader-<?php echo $listing_id; ?>').css('display', 'block');
														        },	 
															    success: function(response) {
															    	jQuery('#listing-<?php echo $listing_id; ?>').css('display', 'none');
															       	return false;
																}
															});

														}

													});

											</script>

								    	</span>

								    </span>

								<?php

								}

							}

						?>

					</div>

				</div>

			</div>

		</div>

	</section>

<?php get_footer(); ?>