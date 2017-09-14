<?php
/**
 * Template name: Register Page
 */

if ( is_user_logged_in() ) { 

	$profile = home_url('/')."my-account";
	wp_redirect( $profile ); exit;

} 

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

get_header(); ?>

	<?php

		global $account_type;

		// Retrieve the URL variables (using PHP).
		if (isset($_GET['account_type'])) {
		    $account_type = $_GET['account_type'];
		} else {
		    $account_type = "";
		}

	?>

	<section id="blog">

		<div class="container">

			<div class="resume-skills">

				<h1 class="resume-section-title"><i class="fa fa-check"></i><?php _e( 'Register an Account ', 'themesdojo' ); ?></h1>

				<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'You’ll be able to post your carer resume, apply for a job, add provider profiles and post job offers!', 'themesdojo' ); ?></h3>

				<div class="divider"></div>

				<div class="full">

					<?php 					
						if(get_option('users_can_register')) { //Check whether user registration is enabled by the administrator
					?>

					<div class="one_half first">

						<form id="wpjobus-register" type="post" action="" >  
						  	
						  	<span class="one_half first">
								<h3><?php _e( 'Username:', 'themesdojo' ); ?></h3>
							</span>

							<span class="one_half">
								<input type="text" name="userName" id="userName" value="" class="input-textarea" placeholder="" />
								<label for="userName" class="error userNameError"></label>
							</span>

							<span class="one_half first">
								<h3><?php _e( 'Email:', 'themesdojo' ); ?></h3>
							</span>

							<span class="one_half">
								<input type="text" name="userEmail" id="userEmail" value="" class="input-textarea" placeholder="" />
								<label for="userEmail" class="error userEmailError"></label>
							</span>

							<span class="one_half first">
								<h3><?php _e( 'Password:', 'themesdojo' ); ?></h3>
							</span>

							<span class="one_half">
								<input type="password" name="userPassword" id="userPassword" value="" class="input-textarea" placeholder="" />
							</span>

							<span class="one_half first">
								<h3><?php _e( 'Repeat Password:', 'themesdojo' ); ?></h3>
							</span>

							<span class="one_half">
								<input type="password" name="userConfirmPassword" id="userConfirmPassword" value="" class="input-textarea" placeholder="" />
							</span>

							<?php

								global $redux_demo; 

						
								$account_type_settings = $redux_demo['account-state'];

								$key = 'account_type';
								$single = true;

								if($account_type_settings == 2) {

							?>

							<span class="one_half first">
								<h3><?php _e( 'Account type:', 'themesdojo' ); ?></h3>
							</span>

							<span class="one_half">
								<select name="account_type" id="account_type" style="width: 100%; margin-bottom: 10px;">
									<option value='job-offer' <?php selected( "job_offer", $account_type ); ?>><?php _e( 'Provider', 'themesdojo' ); ?></option>
									<option value='job-participant' <?php selected( "job-participant", $account_type ); ?>><?php _e( 'Participant', 'themesdojo' ); ?></option>
									<!-- <option value='job-seeker' <?php //selected( "job_seeker", $account_type ); ?>><?php //_e( 'Carer', 'themesdojo' ); ?></option> -->
									
								</select>
							</span>

							<?php } ?>
							
							<input type="hidden" name="action" value="wpjobusRegisterForm" />
							<?php wp_nonce_field( 'wpjobusRegister_html', 'wpjobusRegister_nonce' ); ?>

							<?php 
							

							include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

							if ( is_plugin_active( "linkedin-login/linkedin-login.php" ) ) { ?>
								<container class="full">
									<div class="one_third first">

										<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Register', 'themesdojo' ); ?>" class="input-submit">

									<br></br>

									</div>
										
									<div class="two_third">
										<?php echo do_shortcode('[wpli_login_link]'); ?> 
									</div>
								<container>
							
							<?php }	else {	?>

									<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Register', 'themesdojo' ); ?>" class="input-submit">

							<?php } ?>

							<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>
						  	  
						</form>

						<div id="success">
							<span>
							   	<h3><?php _e( 'Registration successful.', 'themesdojo' ); ?></h3>
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
						            userName: {
						                required: true,
						                minlength: 3
						            },
						            userEmail: {
						                required: true,
						                email: true
						            },
						            userPassword: {
						                required: true,
						                minlength: 6,
						            },
						            userConfirmPassword: {
						                required: true,
						                minlength: 6,
						                equalTo: "#userPassword"
						            }
						        },
						        messages: {
							        userName: {
							            required: "<?php _e( 'Please provide a username', 'themesdojo' ); ?>",
							            minlength: "<?php _e( 'Your username must be at least 3 characters long', 'themesdojo' ); ?>"
							        },
							        userEmail: {
							            required: "<?php _e( 'Please provide an email address', 'themesdojo' ); ?>",
							            email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
							        },
							        userPassword: {
							            required: "<?php _e( 'Please provide a password', 'themesdojo' ); ?>",
							            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>"
							        },
							        userConfirmPassword: {
							            required: "<?php _e( 'Please provide a password', 'themesdojo' ); ?>",
							            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>",
							            equalTo: "<?php _e( 'Please enter the same password as above', 'themesdojo' ); ?>"
							        }
							    },
						        submitHandler: function(form) {
						        	jQuery('#wpjobus-register .input-submit').css('display','none');
						        	jQuery('#wpjobus-register .submit-loading').css('display','inline-block');
						            jQuery(form).ajaxSubmit({
						            	type: "POST",
								        data: jQuery(form).serializeArray(),
								        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
						                success: function(data) {
						                	if(data == 1) {
						                		jQuery("#userName").addClass("error");
						                		jQuery(".userNameError").text("<?php _e( 'Username exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','inline-block');

						                		jQuery('#wpjobus-register .input-submit').css('display','inline-block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 2) {
						                		jQuery("#userEmail").addClass("error");
						                		jQuery(".userEmailError").text("<?php _e( 'Email exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userEmailError').css('display','inline-block');

						                		jQuery('#wpjobus-register .input-submit').css('display','inline-block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 3) {
						                		jQuery("#userName").addClass("error");
						                		jQuery(".userNameError").text("<?php _e( 'Username exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','inline-block');

						                		jQuery("#userEmail").addClass("error");
						                		jQuery(".userEmailError").text("<?php _e( 'Email exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userEmailError').css('display','inline-block');

						                		jQuery('#wpjobus-register .input-submit').css('display','inline-block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 4) {
						                		jQuery('#wpjobus-register :input').attr('disabled', 'disabled');
							                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
							                    	jQuery('#wpjobus-register').css('display','none');
							                        jQuery(this).find(':input').attr('disabled', 'disabled');
							                        jQuery(this).find('label').css('cursor','default');
							                        jQuery('#success').fadeIn();

							                        <?php $profile = home_url('/')."my-account"; ?>
      												var delay = 1000;
      												setTimeout(function(){ window.location = '<?php echo $profile; ?>';}, delay); 
							                    });
						                	}

						                	if(data == 5) {
						                		jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
							                        jQuery('#error').fadeIn();
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

					<div class="one_half social-links">

						<h3 style="margin-top: 0;"><?php _e( 'Social account register', 'themesdojo' ); ?></h3>

						<?php
						/**
						 * Detect plugin. For use on Front End only.
						 */
						include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

						// check for plugin using plugin name
						if ( is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) {
						  //plugin is activated
						
						?>

						<a class="register-social-button-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;"><i class="fa fa-facebook-square"></i> Facebook</a>

						<?php } ?>

						<?php
						/**
						 * Detect plugin. For use on Front End only.
						 */
						include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

						// check for plugin using plugin name
						if ( is_plugin_active( "nextend-twitter-connect/nextend-twitter-connect.php" ) ) {
						  //plugin is activated
						
						?>
						
						<a class="register-social-button-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1&redirect='+window.location.href; return false;"><i class="fa fa-twitter-square"></i> Twitter</a>

						<?php } ?>

						<?php
						/**
						 * Detect plugin. For use on Front End only.
						 */
						include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

						// check for plugin using plugin name
						if ( is_plugin_active( "nextend-google-connect/nextend-google-connect.php" ) ) {
						  //plugin is activated
						
						?>

						<a class="register-social-button-google" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;"><i class="fa fa-google-plus-square"></i> Google</a>

						<?php } ?>

					</div>

					<?php }
						
						else echo "<span class='registration-closed'>Registration is currently disabled. Please try again later.</span>";

					?>

				</div>

			</div>

		</div>

	</section>

<?php get_footer(); ?>