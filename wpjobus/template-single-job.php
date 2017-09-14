<?php
/**
 * Job Page
 */

while ( have_posts() ) : the_post();

global $redux_demo; 
$access_state = $redux_demo['access-state'];

if ( !is_user_logged_in() && $access_state == 1) {

	$login = home_url('/')."login?info=accesspage";
	wp_redirect( $login ); exit;

} 

$td_this_post_id = $post->ID;

if(empty($td_this_post_id)) {

	$page = get_page($post->ID);
	$td_this_post_id = $page->ID;

} 

$wpjobus_job_cover_image = esc_attr(get_post_meta($post->ID, 'wpjobus_job_cover_image',true));
$wpjobus_job_fullname = esc_attr(get_post_meta($post->ID, 'wpjobus_job_fullname',true));
$job_company = esc_attr(get_post_meta($post->ID, 'job_company',true));
$td_job_location = esc_attr(get_post_meta($post->ID, 'job_location',true));
$td_job_career_level = esc_attr(get_post_meta($post->ID, 'job_career_level',true));
$td_job_presence_type = esc_attr(get_post_meta($post->ID, 'job_presence_type',true));
$wpjobus_job_type = esc_attr(get_post_meta($post->ID, 'wpjobus_job_type',true));
$wpjobus_job_remuneration_per = esc_attr(get_post_meta($post->ID, 'wpjobus_job_remuneration_per',true));
$wpjobus_job_remuneration = esc_attr(get_post_meta($post->ID, 'wpjobus_job_remuneration',true));
$wpjobus_job_benefits = get_post_meta($post->ID, 'wpjobus_job_benefits',true);

$td_job_industry = esc_attr(get_post_meta($post->ID, 'job_industry',true));
$job_about_me = html_entity_decode(get_post_meta($post->ID, htmlentities('job-about-me'),true));
$td_job_years_of_exp = esc_attr(get_post_meta($post->ID, 'job_years_of_exp',true));
$wpjobus_resume_profile_picture = esc_attr(get_post_meta($post->ID, 'wpjobus_resume_profile_picture',true));

$wpjobus_resume_prof_title = esc_attr(get_post_meta($post->ID, 'wpjobus_resume_prof_title',true));
$td_resume_career_level = esc_attr(get_post_meta($post->ID, 'resume_career_level',true));

$wpjobus_job_comm_level = esc_attr(get_post_meta($post->ID, 'wpjobus_job_comm_level',true));
$wpjobus_job_comm_note = esc_attr(get_post_meta($post->ID, 'wpjobus_job_comm_note',true));

$wpjobus_job_org_level = esc_attr(get_post_meta($post->ID, 'wpjobus_job_org_level',true));
$wpjobus_job_org_note = esc_attr(get_post_meta($post->ID, 'wpjobus_job_org_note',true));

$wpjobus_job_job_rel_level = esc_attr(get_post_meta($post->ID, 'wpjobus_job_job_rel_level',true));
$wpjobus_job_job_rel_note = esc_attr(get_post_meta($post->ID, 'wpjobus_job_job_rel_note',true));

$wpjobus_job_skills = get_post_meta($post->ID, 'wpjobus_job_skills',true);
$wpjobus_job_native_language = esc_attr(get_post_meta($post->ID, 'wpjobus_job_native_language',true));
$wpjobus_job_languages = get_post_meta($post->ID, 'wpjobus_job_languages',true);

$wpjobus_job_hobbies = get_post_meta($post->ID, 'wpjobus_job_hobbies',true);

$wpjobus_job_address = esc_attr(get_post_meta($post->ID, 'wpjobus_job_address',true));
$wpjobus_job_phone = esc_attr(get_post_meta($post->ID, 'wpjobus_job_phone',true));
$wpjobus_job_website = esc_url(get_post_meta($post->ID, 'wpjobus_job_website',true));
$wpjobus_job_email = get_post_meta($post->ID, 'wpjobus_job_email',true);
$wpjobus_job_publish_email = esc_attr(get_post_meta($post->ID, 'wpjobus_job_publish_email',true));
$wpjobus_job_facebook = esc_url(get_post_meta($post->ID, 'wpjobus_job_facebook',true));
$wpjobus_job_linkedin = esc_url(get_post_meta($post->ID, 'wpjobus_job_linkedin',true));
$wpjobus_job_twitter = esc_url(get_post_meta($post->ID, 'wpjobus_job_twitter',true));
$wpjobus_job_googleplus = esc_url(get_post_meta($post->ID, 'wpjobus_job_googleplus',true));

$wpjobus_job_googleaddress = esc_attr(get_post_meta($post->ID, 'wpjobus_job_googleaddress',true));
$wpjobus_job_longitude = esc_attr(get_post_meta($post->ID, 'wpjobus_job_longitude',true));
$wpjobus_job_latitude = esc_attr(get_post_meta($post->ID, 'wpjobus_job_latitude',true));

get_header(); 

global $redux_demo;
$contact_email = esc_attr(get_post_meta($post->ID, 'wpjobus_job_email',true));
$wpcrown_contact_email_error = esc_attr($redux_demo['contact-email-error']);
$wpcrown_contact_name_error = esc_attr($redux_demo['contact-name-error']);
$wpcrown_contact_message_error = esc_attr($redux_demo['contact-message-error']);
$wpcrown_contact_thankyou = esc_attr($redux_demo['contact-thankyou-message']);
$wpcrown_contact_test_error = esc_attr($redux_demo['contact-test-error']);

?>

	<section id="popup-login">

		<div class="container">

			<div class="resume-skills">

				<a id="close-popup-login" href="#" data-rel="tooltip" rel="top" title="<?php _e( "close", "themesdojo" ); ?>" ><i class="fa fa-times"></i></a>

				<h1 class="resume-section-title"><i class="fa fa-check"></i><?php _e( 'Login', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'Don\'t have an account?', 'themesdojo' ); ?> <a id="open-register-popup" href="#"><?php _e( 'Sign up now.', 'themesdojo' ); ?></a></h3>

				<div class="divider"></div>

				<div class="full" style="margin-bottom: 0;">

					<div class="one_half first" style="margin-bottom: 0;">

						<form id="wpjobus-login" type="post" action="" >

							<div class="full" style="margin-bottom: 0;">  
						  	
							  	<span class="one_third first">
									<h3><?php _e( 'Username:', 'themesdojo' ); ?></h3>
								</span>

								<span class="two_third">
									<input type="text" name="userName" id="userName" value="" class="input-textarea" placeholder="" />
									<label for="userName" class="error userNameError"></label>
								</span>

							</div>

							<div class="full" style="margin-bottom: 0;">

								<span class="one_third first">
									<h3><?php _e( 'Password:', 'themesdojo' ); ?></h3>
								</span>

								<span class="two_third">
									<input type="password" name="userPassword" id="userPasswordRegister" value="" class="input-textarea" placeholder="" />
									<label for="userPassword" class="error userPasswordError"></label>

									<fieldset class="input-full-width" style="padding: 0;">
										<input name="rememberme" type="checkbox" value="forever" style="float: left; width: auto; margin-right: 5px; margin-top: 2px;"/><span style="margin-left: 10px; float: left; margin-bottom: 10px;"><?php _e( 'Remember me', 'themesdojo' ); ?></span>
										<a style="float: right;" class="" href="<?php $reset = home_url('/')."reset"; echo $reset; ?>"><?php _e( 'Forgot Password', 'themesdojo' ); ?></a>
									</fieldset>

								</span>

							</div>
							
							<input type="hidden" name="action" value="wpjobusLoginForm" />
							<?php wp_nonce_field( 'wpjobusLogin_html', 'wpjobusLogin_nonce' ); ?>

							<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Login', 'themesdojo' ); ?>" class="input-submit">	 

							<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>
						  	  
						</form>

						<div id="success">
							<span>
							   	<h3><?php _e( 'Login successful.', 'themesdojo' ); ?></h3>
							</span>
						</div>
							 
						<div id="error">
							<span>
							   	<h3><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></h3>
							</span>
						</div>

						<script type="text/javascript">

						jQuery(function($) {
							jQuery('#wpjobus-login').validate({
						        rules: {
						            userName: {
						                required: true,
						                minlength: 3
						            },
						            userPasswordRegister: {
						                required: true,
						                minlength: 1,
						            }
						        },
						        messages: {
							        userName: {
							            required: "<?php _e( 'Please provide a username', 'themesdojo' ); ?>",
							            minlength: "<?php _e( 'Your username must be at least 3 characters long', 'themesdojo' ); ?>"
							        },
							        userPasswordRegister: {
							            required: "<?php _e( 'Please provide a password', 'themesdojo' ); ?>",
							            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>"
							        }
							    },
						        submitHandler: function(form) {
						        	jQuery('#wpjobus-login .input-submit').css('display','none');
						        	jQuery('#wpjobus-login .submit-loading').css('display','block');
						            jQuery(form).ajaxSubmit({
						            	type: "POST",
								        data: jQuery(form).serializeArray(),
								        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
						                success: function(data) {
						                	if(data == 1) {
						                		jQuery("#userName").addClass("error");
						                		jQuery(".userNameError").text("<?php _e( 'Username doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','block');

						                		jQuery('#wpjobus-login .input-submit').css('display','block');
						        				jQuery('#wpjobus-login .submit-loading').css('display','none');
						                	}

						                	if(data == 2) {
						                		jQuery("#userPassword").addClass("error");
						                		jQuery(".userPasswordError").text("<?php _e( 'Password doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userPasswordError').css('display','block');

						                		jQuery('#wpjobus-login .input-submit').css('display','block');
						        				jQuery('#wpjobus-login .submit-loading').css('display','none');
						                	}

						                	if(data == 3) {
						                		jQuery("#userName").addClass("error");
						                		jQuery(".userNameError").text("<?php _e( 'Username doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','block');

						                		jQuery("#userPassword").addClass("error");
						                		jQuery(".userPasswordError").text("<?php _e( 'Password doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userPasswordError').css('display','block');

						                		jQuery('#wpjobus-login .input-submit').css('display','block');
						        				jQuery('#wpjobus-login .submit-loading').css('display','none');
						                	}

						                	if(data == 4) {
						                		jQuery('#wpjobus-login :input').attr('disabled', 'disabled');
							                    jQuery('#wpjobus-login').fadeTo( "slow", 0, function() {
							                        jQuery(this).find(':input').attr('disabled', 'disabled');
							                        jQuery(this).find('label').css('cursor','default');
							                        jQuery('#success').fadeIn();

      												var delay = 10;
      												setTimeout(function(){ window.location.reload(); }, delay); 
							                    });
						                	}

						                	if(data == 5) {
						                		jQuery('#wpjobus-login').fadeTo( "slow", 0, function() {
							                        jQuery('#error').fadeIn();
							                    });
						                	}
						                },
						                error: function(data) {
						                    jQuery('#wpjobus-login').fadeTo( "slow", 0, function() {
						                        jQuery('#error').fadeIn();
						                    });
						                }
						            });
						        }
						    });
						});
						</script>

					</div>

					<div class="one_half social-links" style="margin-bottom: 0;">

						<?php 					
							if(get_option('users_can_register')) { //Check whether user registration is enabled by the administrator
						?>

						<h3 style="margin-top: 0;"><?php _e( 'Social account login', 'themesdojo' ); ?></h3>

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

						<?php } ?>

					</div>

				</div>

			</div>

		</div>

		<div id="close-login" class="close-login"></div>

		<script type="text/javascript">

			jQuery(function($) {

				document.getElementById('close-login').addEventListener('click', function(e) {
											
					jQuery('#popup-login').css('display','none');

				});

				document.getElementById('close-popup-login').addEventListener('click', function(e) {
											
					jQuery('#popup-login').css('display','none');

				});

				document.getElementById('open-register-popup').addEventListener('click', function(e) {
											
					jQuery('#popup-login').css('display','none');
					jQuery('#popup-register').css('display','block');

				});

			});
		</script>

	</section>

	<section id="popup-register">

		<div class="container">

			<div class="resume-skills">

				<a id="close-popup-register" data-rel="tooltip" rel="top" title="<?php _e( "close", "themesdojo" ); ?>" href="#"><i class="fa fa-times"></i></a>

				<h1 class="resume-section-title"><i class="fa fa-check"></i><?php _e( 'Register an Account', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'Have an account?', 'themesdojo' ); ?> <a id="open-login-popup" href="#"><?php _e( 'Login now.', 'themesdojo' ); ?></a></h3>

				<div class="divider"></div>

				<div class="full" style="margin-bottom: 0;">

					<?php 					
						if(get_option('users_can_register')) { //Check whether user registration is enabled by the administrator
					?>

					<div class="one_half first" style="margin-bottom: 0;">

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
							
							<input type="hidden" name="action" value="wpjobusRegisterForm" />
							<?php wp_nonce_field( 'wpjobusRegister_html', 'wpjobusRegister_nonce' ); ?>

							<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Register', 'themesdojo' ); ?>" class="input-submit">	 

							<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>
						  	  
						</form>

						<div id="successRegister">
							<span>
							   	<h3><?php _e( 'Registration successful.', 'themesdojo' ); ?></h3>
							</span>
						</div>
							 
						<div id="errorRegister">
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
						        	jQuery('#wpjobus-register .submit-loading').css('display','block');
						            jQuery(form).ajaxSubmit({
						            	type: "POST",
								        data: jQuery(form).serializeArray(),
								        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
						                success: function(data) {
						                	if(data == 1) {
						                		jQuery("#userName").addClass("error");
						                		jQuery(".userNameError").text("<?php _e( 'Username exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','block');

						                		jQuery('#wpjobus-register .input-submit').css('display','block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 2) {
						                		jQuery("#userEmail").addClass("error");
						                		jQuery(".userEmailError").text("<?php _e( 'Email exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userEmailError').css('display','block');

						                		jQuery('#wpjobus-register .input-submit').css('display','block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 3) {
						                		jQuery("#userName").addClass("error");
						                		jQuery(".userNameError").text("<?php _e( 'Username exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','block');

						                		jQuery("#userEmail").addClass("error");
						                		jQuery(".userEmailError").text("<?php _e( 'Email exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userEmailError').css('display','block');

						                		jQuery('#wpjobus-register .input-submit').css('display','block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 4) {
							                    jQuery('#wpjobus-register :input').attr('disabled', 'disabled');
							                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
							                        jQuery(this).find(':input').attr('disabled', 'disabled');
							                        jQuery(this).find('label').css('cursor','default');
							                        jQuery('#successRegister').fadeIn();

      												var delay = 10;
      												setTimeout(function(){ window.location.reload(); }, delay); 
							                    });
						                	}

						                	if(data == 5) {
						                		jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
							                        jQuery('#errorRegister').fadeIn();
							                    });
						                	}
						                },
						                error: function(data) {
						                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
						                        jQuery('#errorRegister').fadeIn();
						                    });
						                }
						            });
						        }
						    });
						});
						</script>

					</div>

					<div class="one_half social-links" style="margin-bottom: 0;">

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

		<div id="close-register" class="close-register"></div>

		<script type="text/javascript">

			jQuery(function($) {

				document.getElementById('close-register').addEventListener('click', function(e) {
											
					jQuery('#popup-register').css('display','none');

				});

				document.getElementById('close-popup-register').addEventListener('click', function(e) {
											
					jQuery('#popup-register').css('display','none');

				});

				document.getElementById('open-login-popup').addEventListener('click', function(e) {
											
					jQuery('#popup-login').css('display','block');
					jQuery('#popup-register').css('display','none');

				});

			});
		</script>

	</section>

	<section id="resume-cover-image">

		<?php 
			if (current_user_can('administrator')) {
		?>

		<div class="admin-settings-header">

			<div class="admin-settings-header-top">

				<div class="container">

					<div class="one_fifth first">

						<span><?php _e( 'Status:', 'themesdojo' ); ?> <?php echo get_post_status($td_this_post_id); ?></span>

					</div>

					<div class="one_fifth">

						<span><?php _e( 'Type:', 'themesdojo' ); ?> <?php $wpjobus_post_reg_status = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_featured_post_status',true)); echo $wpjobus_post_reg_status; ?></span>

					</div>

					<div class="one_fifth">

						<span><?php _e( 'Submitted on:', 'themesdojo' ); ?> <?php echo get_the_time('d/m/Y', $td_this_post_id); ?></span>

					</div>

					<div class="one_fifth">

						<?php if($wpjobus_post_reg_status == "featured") { ?>

						<span><?php _e( 'Expires on:', 'themesdojo' ); ?> <?php $wpjobus_post_exp = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_featured_expiration_date',true)); if(!empty($wpjobus_post_exp)) { echo $time = date("m/d/Y", $wpjobus_post_exp); } ?></span>

						<?php } ?>

					</div>

					<div class="one_fifth">

						<?php

							$author_id = $wpdb->get_results( "SELECT DISTINCT post_author FROM `{$wpdb->prefix}posts` WHERE post_type = 'job' and ID = '".$td_this_post_id."' ORDER BY `ID` DESC");

							foreach ($author_id as $key => $value) {
							    
							    $td_result_author = $value->post_author;

							}

						?>

						<span style="float: right;"><?php _e( 'Username:', 'themesdojo' ); ?> <?php $td_user_info = get_userdata($td_result_author); echo $td_user_info->user_login; ?></span>

					</div>

				</div>

			</div>

			<div class="admin-settings-header-content">

				<div class="container">

					<div class="one_fourth first" style="margin-bottom: 0;">

						<h3><?php _e( 'Admin Menu', 'themesdojo' ); ?></h3>

					</div>

					<div class="three_fourth" style="margin-bottom: 0; margin: 18px 0;">

						<div style="float: right">

							<form id="wpjobus-add-company" type="post" action="" >

								<span style="margin-right: 10px; margin-top: 12px;"><?php _e( 'Status:', 'themesdojo' ); ?></span>

								<?php $post_status = get_post_status($td_this_post_id); ?>

								<select name="post-status" id="post-status" style="width: 150px; margin-right: 30px; margin-bottom: 0;">
									<option value='publish' <?php selected( $post_status, "publish" ); ?>>publish</option>
									<option value='draft' <?php selected( $post_status, "draft" ); ?>>draft</option>
									<option value='pending' <?php selected( $post_status, "pending" ); ?>>pending</option>
								</select>

								<span style="margin-right: 10px; margin-top: 12px;"><?php _e( 'Type:', 'themesdojo' ); ?></span>

								<select name="post-type" id="post-type" style="width: 150px; margin-right: 30px; margin-bottom: 0;">
									<option value='featured' <?php selected( $wpjobus_post_reg_status, "featured" ); ?>>featured</option>
									<option value='regular' <?php selected( $wpjobus_post_reg_status, "regular" ); ?>>regular</option>
								</select>

								<div class="exp-days-block" style="display: <?php if($wpjobus_post_reg_status == "featured") { ?>block;<?php } else { ?>none;<?php } ?>">

									<span style="margin-right: 10px; margin-top: 12px;"><?php _e( 'Expires in:', 'themesdojo' ); ?></span>

									<?php 

										if($wpjobus_post_reg_status == "featured") {

											$wpjobus_featured_expiration_date = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_featured_expiration_date',true));

											$start = current_time('timestamp');
											$end = $wpjobus_featured_expiration_date;

											$days_between = ceil(abs($end - $start) / 86400); 

										} else {

											$days_between = "";
											
										}

									?>

									<input type="text" name="exp-time" id="exp-time" value="<?php echo $days_between; ?>" class="input-textarea" placeholder="" style="width: 50px; margin-right: 10px; margin-bottom: 0;"/>

									<span style="margin-right: 30px; margin-top: 12px;"><?php _e( 'days', 'themesdojo' ); ?></span>

								</div>

								<input type="hidden" id="featPostId" name="featPostId" value="<?php echo $td_this_post_id; ?>">

								<input style="margin: 0;" name="submit" type="submit" value="Update" class="input-submit">
								<span class="submit-loading" style="margin: 0;"><i class="fa fa-refresh fa-spin"></i></span>

								<span id="success" style="float: left; width: auto; margin: 10px 0;"><?php _e( 'Done', 'themesdojo' ); ?></span>

								<input type="hidden" name="action" value="wpjobusAdminFeaturedCompanyForm" />
								<?php wp_nonce_field( 'wpjobusAdminFeaturedCompanyForm_html', 'wpjobusAdminFeaturedCompanyForm_nonce' ); ?>

							</form>

							<script type="text/javascript">

								jQuery(function($) {

									$("#post-type").change(function(){

										if($(this).val() == "featured" ) {

									    	jQuery('.exp-days-block').css('display','block');

									 	} else {

									   		jQuery('.exp-days-block').css('display','none');

									  	}

									});

									jQuery('#wpjobus-add-company').validate({
										rules: {
										},
										messages: {
										},
										submitHandler: function(form) {
										    jQuery('#wpjobus-add-company .input-submit').css('display','none');
										    jQuery('#wpjobus-add-company .submit-loading').css('display','block');
										    jQuery(form).ajaxSubmit({
										        type: "POST",
												data: jQuery(form).serializeArray(),
												url: '<?php echo admin_url('admin-ajax.php'); ?>', 
										        success: function(data) {
										            jQuery('#wpjobus-add-company .submit-loading').css('display','none');
										        	jQuery('#success').fadeIn(); 

				      								<?php $redirect_link = home_url('/')."?post_type=job&p=".$td_this_post_id."&preview=true"; ?>

				      								var delay = 1;
				      								setTimeout(function(){ window.location = '<?php echo $redirect_link; ?>';}, delay);
										        },
										        error: function(data) {
										        	jQuery('#wpjobus-add-company .input-submit').css('display','block');
										        	jQuery('#wpjobus-add-company .submit-loading').css('display','none');

										            jQuery('#error').fadeIn();
										        }
										    });
										}
									});

								});

							</script>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php } ?>

		<div class="bannerText">
			<div class="menu-nav-trigger">
				<span class="zebra-line top"></span>
				<span class="zebra-line middle"></span>
				<span class="zebra-line bottom"></span>
			</div>

			<?php if($wpjobus_job_remuneration >0 ) { ?>

			<span class="banner-hello">
				<span class="job_work_type"><?php echo $wpjobus_job_type; ?></span>
				<span class="job_remuneration"><?php echo $wpjobus_job_remuneration; ?></span>
				<span class="job_remuneration_per">/<?php echo $wpjobus_job_remuneration_per; ?></span>
			</span>

			<?php } ?>

	      	<h1><?php echo $wpjobus_job_fullname; ?></h1>
	      	<h2><i class="fa fa-briefcase"></i><?php $wpjobus_company_fullname = esc_attr(get_post_meta($job_company, 'wpjobus_company_fullname',true)); echo $wpjobus_company_fullname; ?> <i class="fa fa-map-marker"></i><?php echo $td_job_location; ?></h2>
	      	<span class="cover-resume-breadcrumbs"><a href="<?php echo home_url('/'); ?>"><i class="fa fa-home"></i></a> <i class="fa fa-chevron-right"></i> <a href="<?php echo home_url('/'); ?>/jobs"><?php _e( 'Jobs', 'themesdojo' ); ?></a> <i class="fa fa-chevron-right"></i>  <?php echo $td_job_industry; ?> </span>
	      	<span class="like-listing">

	      		<?php 

	      			$td_user_id = get_current_user_id();

	      			global $wpdb;
	      			$myFav = $wpdb->get_results( 'SELECT id FROM wpjobus_favorites WHERE user_id = "'.$td_user_id.'" AND listing_id = "'.$td_this_post_id.'" ' );

	      			if(empty($myFav)) {
	      				$favStatus = 0;
	      			} else {
	      				$favStatus = 1;
	      			}

	      		?>

	      		<span id="like-listing-container" class="like-listing-container">
	      			<i class="fa fa-heart-o" <?php if(empty($myFav)) { ?>style="display: block"<?php } else { ?>style="display: none"<?php } ?> ></i>
	      			<i class="fa fa-heart" <?php if(empty($myFav)) { ?>style="display: none"<?php } else { ?>style="display: block"<?php } ?>></i>
	      		</span>

	      		<i class="fa fa-spinner fa-spin"></i>

	      		<?php 

	      			$td_user_id = get_current_user_id(); 

	      			if(empty($td_user_id)) {

	      		?>

	      		<script type="text/javascript">

						jQuery(function($) {

							document.getElementById('like-listing-container').addEventListener('click', function(e) {
											
								$.fn.favoriteForm();

								e.preventDefault();

							});

							$.fn.favoriteForm = function() {

								jQuery('#popup-login').css('display', 'block');

							}

						});

				</script>

	      		<?php

	      			} else {

	      		?>

	      		<form id="favorite-form" method="post" class="form">

	      			<input name="favorite_listing_id" id="favorite_listing_id" type="hidden" value="<?php echo $td_this_post_id; ?>" />
	      			<input name="favorite_user_id" id="favorite_user_id" type="hidden" value="<?php echo $td_user_id; ?>" />
	      			<input name="favorite_status" id="favorite_status" type="hidden" value="<?php echo $favStatus; ?>" />
	      			<input name="favorite_type" id="favorite_type" type="hidden" value="job" />

					<input type="hidden" name="action" value="favoriteForm" />
					<?php wp_nonce_field( 'favoriteForm_html', 'favoriteForm_nonce' ); ?>

				</form>

	      		<script type="text/javascript">

						jQuery(function($) {

							document.getElementById('like-listing-container').addEventListener('click', function(e) {
											
								$.fn.favoriteForm();

								e.preventDefault();

							});

							$.fn.favoriteForm = function() {

								jQuery('#favorite-form').ajaxSubmit({
									type: "POST",
									data: jQuery('#favorite-form').serializeArray(),
									url: '<?php echo admin_url('admin-ajax.php'); ?>',
									beforeSend: function() {
										jQuery('#like-listing-container .fa').css('display', 'none');
							        	jQuery('.like-listing .fa-spinner').css('display', 'inline-block');
							        	jQuery('#like-listing-container .fa-heart-o').removeClass("bounce");
							        	jQuery('#like-listing-container .fa-heart').removeClass("bounce");
							        },	 
								    success: function(response) {
								    	if(response == 1) {
											jQuery('#like-listing-container .fa-heart').css('display', 'block');
											jQuery('#like-listing-container .fa-heart').addClass("bounce");
								        	jQuery('.like-listing .fa-spinner').css('display', 'none');
								        	jQuery('#favorite_status').val(1);
										} 
										if(response == 0) {
											jQuery('#like-listing-container .fa-heart-o').css('display', 'block');
											jQuery('#like-listing-container .fa-heart-o').addClass("bounce");
								        	jQuery('.like-listing .fa-spinner').css('display', 'none');
								        	jQuery('#favorite_status').val(0);
										} 
								       	return false;
									}
								});

							}

						});

				</script>

				<?php } ?>

	      	</span>
	    </div>

		<div class="coverImageHolder">
			<img src="<?php echo $wpjobus_job_cover_image; ?>" alt="" class="bgImg">
		</div>

	</section>

	<section id="job-menu">

		<div class="container">

			<ul class="nav navbar-nav">

				<li class="menuItem active backtophome"><a href="#backtop"><i class="fa fa-home"></i><?php _e( 'Overview', 'themesdojo' ); ?></a></li>
				
				<?php if($wpjobus_job_comm_level > 0 || strlen(trim(($wpjobus_job_comm_note))) > 0 || $wpjobus_job_org_level > 0 || strlen(trim($wpjobus_job_org_note)) > 0 || $wpjobus_job_job_rel_level > 0 || strlen(trim($wpjobus_job_job_rel_note)) > 0 || !empty($wpjobus_job_skills) || !empty($wpjobus_job_languages)) { ?>
				
				<li class="menuItem"><a href="#resume-skills-block"><i class="fa fa-bar-chart-o"></i><?php _e( 'Qualifications', 'themesdojo' ); ?></a></li>
				
				<?php } ?>
				
				<?php if (strlen(trim($wpjobus_job_remuneration)) > 0 || (is_array($wpjobus_job_benefits) && sizeof($wpjobus_job_benefits) > 0 )) {	?>

				<li class="menuItem"><a href="#resume-experience-block"><i class="fa fa-money"></i><?php _e( 'Sallary & Benefits', 'themesdojo' ); ?></a></li>
				
				<?php } ?>
				
				<li class="menuItem"><a href="#resume-contact-block"><i class="fa fa-envelope"></i><?php _e( 'Job Application', 'themesdojo' ); ?></a></li>

			</ul>

			<select id="mobile-nav-bar" onchange="location = this.options[this.selectedIndex].value;">

				<option value="#backtop"><?php _e( 'Overview', 'themesdojo' ); ?></option>
				<option value="#resume-skills-block"><?php _e( 'Qualifications', 'themesdojo' ); ?></option>
				
				<?php if (strlen(trim($wpjobus_job_remuneration)) > 0 || sizeof($wpjobus_job_benefits) > 0) {	?>
				
				<option value="#resume-experience-block"><?php _e( 'Sallary & Benefits', 'themesdojo' ); ?></option>
				
				<?php } ?>
				
				<option value="#resume-contact-block"><?php _e( 'Job Application', 'themesdojo' ); ?></option>

			</select>

		</div>

	</section>

	<section id="resume-about-block" style="text-align: left;">

		<div class="container">

			<div class="full" style="display: inline-block;">

				<div class="three_fifth first" style="margin-bottom: 0; margin-top: 50px;">

					<div class="full" style="margin-bottom: 0;">
						<?php 

							$content = $job_about_me;

							$content = apply_filters('the_content', $content);
							$content = str_replace(']]>', ']]&gt;', $content);

							echo wpautop($content);

						?>
					</div>

				</div>

				<div class="two_fifth" style="margin-top: 50px;">

					<span class="job-info-details">
						<span class="job-info-id"><i class="fa fa-square-o"></i><?php _e( 'ID', 'themesdojo' ); ?></span>
						<span class="job-info-data">#<?php $id = get_the_ID(); echo $id; ?></span>
					</span>

					<span class="job-info-details">
						<span class="job-info-id"><i class="fa fa-map-marker"></i><?php _e( 'Location', 'themesdojo' ); ?></span>
						<span class="job-info-data"><?php echo $td_job_location; ?></span>
					</span>

					<span class="job-info-details">
						<span class="job-info-id"><i class="fa fa-folder-o"></i><?php _e( 'Industry', 'themesdojo' ); ?></span>
						<span class="job-info-data"><?php echo $td_job_industry; ?></span>
					</span>

					<span class="job-info-details">
						<span class="job-info-id"><i class="fa fa-bolt"></i><?php _e( 'Type', 'themesdojo' ); ?></span>
						<span class="job-info-data"><?php echo $wpjobus_job_type; ?></span>
					</span>

					<span class="job-info-details">
						<span class="job-info-id"><i class="fa fa-rocket"></i><?php _e( 'Role', 'themesdojo' ); ?></span>
						<span class="job-info-data"><?php echo $wpjobus_job_fullname; ?></span>
					</span>

					<span class="job-info-details">
						<span class="job-info-id"><i class="fa fa-flask"></i><?php _e( 'Career Level', 'themesdojo' ); ?></span>
						<span class="job-info-data"><?php echo $td_job_career_level; ?></span>
					</span>

					<span class="job-info-details">
						<span class="job-info-id"><i class="fa fa-home"></i><?php _e( 'Presence', 'themesdojo' ); ?></span>
						<span class="job-info-data"><?php echo $td_job_presence_type; ?></span>
					</span>

				</div>

			</div>

		</div>

	</section>

	<section id="resume-skills-block">

		<div class="container">


			<?php if($wpjobus_job_comm_level > 0 || strlen(trim(($wpjobus_job_comm_note))) > 0 || $wpjobus_job_org_level > 0 || strlen(trim($wpjobus_job_org_note)) > 0 || $wpjobus_job_job_rel_level > 0 || strlen(trim($wpjobus_job_job_rel_note)) > 0 || !empty($wpjobus_job_skills) || !empty($wpjobus_job_languages)) { ?>

			<div class="resume-skills">

				<h1 class="resume-section-title"><i class="fa fa-rocket"></i><?php _e( 'Required Skills', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'Here’s an overview qualifications you need for this job.', 'themesdojo' ); ?></h3>

				<div class="one_half first">

				<?php if ($wpjobus_job_comm_level > 0) { ?> 
					
					<span class="main-skills-item">
						<span class="main-skills-item-title"><?php _e( 'Communication', 'themesdojo' ); ?></span>
						<span class="main-skills-item-bar">
							<span class="main-skills-item-bar-color" style="width: <?php echo $wpjobus_job_comm_level; ?>; background-color: #2ecc71;"></span>
						</span>
					</span>

				<?php } ?>

				<?php if (strlen(trim($wpjobus_job_comm_note)) > 0) { ?>
					<div class="full main-skills-item-note"><?php echo $wpjobus_job_comm_note; ?></div>
				<?php } ?>

				<?php if ($wpjobus_job_org_level > 0) { ?> 
					<span class="main-skills-item">
						<span class="main-skills-item-title"><?php _e( 'Organizational', 'themesdojo' ); ?></span>
						<span class="main-skills-item-bar">
							<span class="main-skills-item-bar-color" style="width: <?php echo $wpjobus_job_org_level; ?>; background-color: #e74c3c;"></span>
						</span>
					</span>
				<?php } ?>

				<?php if (strlen(trim($wpjobus_job_org_note)) > 0) { ?>
					<div class="full main-skills-item-note"><?php echo $wpjobus_job_org_note; ?></div>
				<?php } ?>

				<?php if ($wpjobus_job_job_rel_level > 0) { ?> 
					<span class="main-skills-item">
						<span class="main-skills-item-title"><?php _e( 'Job Related', 'themesdojo' ); ?></span>
						<span class="main-skills-item-bar">
							<span class="main-skills-item-bar-color" style="width: <?php echo $wpjobus_job_job_rel_level; ?>; background-color: #34495e;"></span>
						</span>
					</span>
				<?php } ?>

				<?php if (strlen(trim($wpjobus_job_job_rel_note))) { ?>
					<div class="full main-skills-item-note"><?php echo $wpjobus_job_job_rel_note; ?></div>
				<?php } ?>
				</div>

				<div class="one_half" style="border-top: solid 1px #ecf0f1; padding-top: 50px;">

					<?php 

						if(!empty($wpjobus_job_skills)) {

							for ($i = 0; $i < (count($wpjobus_job_skills)); $i++) {
					?>

					<span class="main-skills-item" style="border: none; padding: 0; margin-bottom: 10px;">
						<span class="main-skills-item-title" style="color: #999;"><?php echo $wpjobus_job_skills[$i][0]; ?></span>
						<span class="main-skills-item-bar">
							<span class="main-skills-item-bar-color" style="width: <?php echo $wpjobus_job_skills[$i][1]; ?>; background-color: #2980b9;"></span>
						</span>
					</span>

					<?php } } ?>

					<div class="divider"></div>
					
					<div class="one_half first">
						
						<span class="main-skills-item-title-language">
							
							<?php 

							$languages_total = count($wpjobus_job_languages); 
							
							if(strlen(trim($wpjobus_job_native_language))>0 && !empty($wpjobus_job_languages))
						    {$languages_total++;}
							
							echo $languages_total;

							?>

							<?php _e( 'Languages', 'themesdojo' ); ?>
						
						</span>

					</div>

					<div class="one_half"><span class="main-skills-item-title-language native-language"><?php echo $wpjobus_job_native_language; ?></span> <span class="main-skills-item-title-language native-small-language"><?php _e( '(Native)', 'themesdojo' ); ?></span></div>
					
					<?php 

						if(!empty($wpjobus_job_languages)) {

							for ($i = 0; $i < (count($wpjobus_job_languages)); $i++) {
					?>

					<div class="full main-skills-item-language">

						<div class="full"><span class="main-skills-item-title-language native-language-all"><?php echo esc_attr($wpjobus_job_languages[$i][0]); ?></span></div>

						<div class="full" style="margin-bottom: 0;">

							<div class="one_half first" style="margin-bottom: 10px;"><span class="main-skills-item-title-language native-small-language-all"><?php _e( 'Understanding', 'themesdojo' ); ?></span></div>

							<div class="one_half" style="margin-bottom: 10px;">
								<span class="main-skills-item-title-language">

									<?php if($wpjobus_job_languages[$i][1] == "Level 1") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][1] == "Level 2") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][1] == "Level 3") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][1] == "Level 4") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][1] == "Level 5") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i>

									<?php } ?>

								</span>
							</div>

						</div>

						<div class="full" style="margin-bottom: 0;">

							<div class="one_half first" style="margin-bottom: 10px;"><span class="main-skills-item-title-language native-small-language-all"><?php _e( 'Speaking', 'themesdojo' ); ?></span></div>

							<div class="one_half" style="margin-bottom: 10px;">
								<span class="main-skills-item-title-language">

									<?php if($wpjobus_job_languages[$i][2] == "Level 1") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][2] == "Level 2") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][2] == "Level 3") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][2] == "Level 4") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][2] == "Level 5") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i>

									<?php } ?>

								</span>
							</div>

						</div>

						<div class="full" style="margin-bottom: 0;">

							<div class="one_half first" style="margin-bottom: 10px;"><span class="main-skills-item-title-language native-small-language-all"><?php _e( 'Writing', 'themesdojo' ); ?></span></div>

							<div class="one_half" style="margin-bottom: 10px;">
								<span class="main-skills-item-title-language">

									<?php if($wpjobus_job_languages[$i][3] == "Level 1") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][3] == "Level 2") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][3] == "Level 3") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][3] == "Level 4") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment-o"></i>

									<?php } ?>

									<?php if($wpjobus_job_languages[$i][3] == "Level 5") { ?>

									<i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i><i class="fa fa-comment"></i>

									<?php } ?>

								</span>
							</div>

						</div>

					</div>

							<?php } } ?>

				</div>

				<?php if (!empty($wpjobus_job_hobbies)) { ?>

				<div class="divider"></div>

				<h1 class="resume-section-title"><i class="fa fa-cogs"></i><?php _e( 'Aditional Requirements', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'What else it would be nice to have.', 'themesdojo' ); ?></h3>

				<div class="full hobbies-block" style="text-align: center;">

					<?php $wpjobus_job_hobbies = str_replace(", ", ",", $wpjobus_job_hobbies); $wpjobus_job_hobbies = str_replace(",", "</span><span class='hobbies-item'>", $wpjobus_job_hobbies); ?>

					<span class="hobbies-item"><?php echo $wpjobus_job_hobbies; ?></span>

				</div>

				<div class="full" style="text-align: center;">

				<span class="company-est-year-block" style="max-width: 200px;">
					<i class="fa fa-calendar"></i>
					<span class="experience-period" style="font-size: 16px;"><?php echo $td_job_years_of_exp; ?> <?php _e( 'Years', 'themesdojo' ); ?></span>
					<span class="experience-subtitle" style="font-size: 12px;"><?php _e( 'Of experience', 'themesdojo' ); ?></span>
				</span>

				</div>

				<?php } ?>

			</div>

			<?php }  ?>

		</div>

	</section>

<?php if (strlen(trim($wpjobus_job_remuneration)) > 0 || (is_array($wpjobus_job_benefits) && sizeof($wpjobus_job_benefits) > 0 )) {	?>
	<section id="resume-experience-block" style="margin-bottom: 30px;">

		<div class="container">

			<div class="resume-skills">

				<h1 class="resume-section-title"><i class="fa fa-money"></i><?php _e( 'Salary & Benefits', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'Here’s what you get.', 'themesdojo' ); ?></h3>

				<div class="full benefits-block">

					<?php if($wpjobus_job_remuneration >0 ) { ?>
					<span class="job-salary-benefits">
						<span class="job_work_type"><?php echo $wpjobus_job_type; ?></span>
						<span class="job_remuneration"><?php echo $wpjobus_job_remuneration; ?></span>
						<span class="job_remuneration_per">/<?php echo $wpjobus_job_remuneration_per; ?></span>
					</span>

					<span class="job-salary-benefits-divider"></span>

					<?php } ?>
				</div>

				<div class="job-experience-holder">

					<?php if(is_array($wpjobus_job_benefits) && sizeof($wpjobus_job_benefits) > 0 ) { ?>

						<span class="one_fourth first">

							<span class="work-experience-first-block-content">

								<span class="work-experience-org-name"><?php _e( 'Benefits', 'themesdojo' ); ?></span>

							</span>

						</span>

					<?php } ?>

					<?php 
						if(!empty($wpjobus_job_benefits)) {
							for ($i = 0; $i < (count($wpjobus_job_benefits)); $i++) {
					?>

						<span class="three_fourth" style="float: right; margin-bottom: 0;">

							<span class="one_third first" style="margin-bottom: 0;">

								<span class="work-experience-second-block-content">

									<span class="work-experience-period"><?php echo esc_attr($wpjobus_job_benefits[$i][0]); ?></span>

								</span>

							</span>

							<span class="two_third" style="margin-bottom: 0;">

								<span class="work-experience-third-block-content">

									<span class="work-experience-notes"><?php echo esc_attr($wpjobus_job_benefits[$i][1]); ?></span>

								</span>

							</span>

						</span>

					<?php } } ?>

				</div>

			</div>

		</div>

<?php } ?>
	</section>

	<section id="resume-skills-block">

		<div class="container">

			<div class="resume-skills">

				<?php 

					$wpjobus_company_fullname = esc_attr(get_post_meta($job_company, 'wpjobus_company_fullname',true));
					$wpjobus_company_tagline = esc_attr(get_post_meta($job_company, 'wpjobus_company_tagline',true));
					$wpjobus_company_profile_picture = esc_attr(get_post_meta($job_company, 'wpjobus_company_profile_picture',true));

				?>

				<h1 class="resume-section-title"><i class="fa fa-briefcase"></i><?php _e( 'Company Information', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'A Brief Overview of the Company which posted this job offer', 'themesdojo' ); ?></h3>

				<div class="full job-company-desc" style="text-align: center;">
					<span><img src="<?php echo $wpjobus_company_profile_picture; ?>" alt=""></span>
					<h1><?php echo $wpjobus_company_fullname; ?></h1>
		      		<h2><?php echo $wpjobus_company_tagline; ?></h2>
		      	</div>

				<div class="divider"></div>

				<div class="full" style="text-align: center;">

					<?php 

						$wpjobus_company_foundyear = esc_attr(get_post_meta($job_company, 'wpjobus_company_foundyear',true));
						$td_company_team_size = esc_attr(get_post_meta($job_company, 'company_team_size',true));

					?>

					<span class="company-est-year-block">
						<i class="fa fa-calendar"></i>
						<span class="experience-period"><?php _e( 'Est. In', 'themesdojo' ); ?></span>
						<span class="experience-subtitle"><?php echo $wpjobus_company_foundyear; ?></span>
					</span>

					<span class="company-team-block">
						<i class="fa fa-users"></i>
						<span class="experience-period"><?php echo $td_company_team_size; ?></span>
						<span class="experience-subtitle"><?php _e( 'People', 'themesdojo' ); ?></span>
					</span>

					<?php 

						$id = $job_company;

						$querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts, $wpdb->postmeta WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_company' AND $wpdb->postmeta.meta_value = $id AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'job' AND $wpdb->posts.post_date < NOW() ORDER BY $wpdb->posts.post_date DESC
							";

						$pageposts = $wpdb->get_results($querystr, OBJECT);

						$jobs_offer = 0;

					?>

					<?php if ($pageposts): ?>
					<?php global $post; ?>
					<?php foreach ($pageposts as $post): ?>
						
					<?php $jobs_offer++; ?>

					<?php endforeach; ?>
						

					<span class="company-jobs-block">
						<i class="fa fa-bullhorn"></i>
						<span class="experience-period"><?php echo $jobs_offer; ?></span>
						<span class="experience-subtitle"><?php if($jobs_offer > 1){ ?><?php _e( 'Jobs', 'themesdojo' ); ?><?php } else { ?><?php _e( 'Job', 'themesdojo' ); ?><?php } ?></span>
					</span>

					<?php endif; ?>

				</div>

				<?php 
					$current = -1;

					$wpjobus_company_services = get_post_meta($job_company, 'wpjobus_company_services',true);

					for ($i = 0; $i < (count($wpjobus_company_services)); $i++) {

						$current++;
				?>

				<div class="one_third <?php if($current%3 ==0) { echo 'first '; } ?>" style="text-align: center; margin-bottom: 0;">

					<span class="company-services-icon"><?php echo $wpjobus_company_services[$i][1]; ?></span>
					<span class="company-services-devider"></span>
					<span class="company-services-title"><?php echo esc_attr($wpjobus_company_services[$i][0]); ?></span>
					<span class="company-services-desc" style="margin-bottom: 0;"><?php echo esc_attr($wpjobus_company_services[$i][2]); ?></span>

				</div>

				<?php } ?>

			</div>

		</div>

	</section>

	<section id="resume-contact-block">

		<?php 	
		if(strlen(trim($wpjobus_job_longitude)) > 0 && strlen(trim($wpjobus_job_latitude))) {	?>

		<div id="resume-map"></div>

		<script type="text/javascript">
					var mapDiv,
						map,
						infobox;
					jQuery(document).ready(function($) {

						mapDiv = $("#resume-map");
						mapDiv.height(600).gmap3({
							map: {
								options: {
									"center": [<?php echo $wpjobus_job_latitude; ?>,<?php echo $wpjobus_job_longitude; ?>]
									,"zoom": 16
									,"draggable": true
									,"mapTypeControl": true
									,"mapTypeId": google.maps.MapTypeId.ROADMAP
									,"scrollwheel": false
									,"panControl": true
									,"rotateControl": false
									,"scaleControl": true
									,"streetViewControl": true
									,"zoomControl": true
									<?php global $redux_demo; $map_style = $redux_demo['map-style']; if(!empty($map_style)) { ?>,"styles": <?php echo $map_style; ?> <?php } ?>
								}
							}
							,marker: {
								values: [

								<?php

									$iconPath = get_template_directory_uri() .'/images/icon-services.png';

								?>

								{
									<?php require_once(get_template_directory() . "/inc/BFI_Thumb.php"); ?>
									<?php $params = array( "width" => 230, "height" => 150, "crop" => true ); $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "single-post-thumbnail" ); ?>

									latLng: [<?php echo $wpjobus_job_latitude; ?>,<?php echo $wpjobus_job_longitude; ?>],
									options: {
										icon: "<?php echo esc_url($iconPath); ?>",
										shadow: "<?php echo get_template_directory_uri() ?>/images/shadow.png",
									}
								}	
									
								],
								options:{
									draggable: false
								}
							}
							 		 	});

						map = mapDiv.gmap3("get");

					    infobox = new InfoBox({
					    	pixelOffset: new google.maps.Size(-50, -65),
					    	closeBoxURL: '',
					    	enableEventPropagation: true
					    });
					    mapDiv.delegate('.infoBox .close','click',function () {
					    	infobox.close();
					    });

					    if (Modernizr.touch){
					    	map.setOptions({ draggable : false });
					        var draggableClass = 'inactive';
					        var draggableTitle = "Activate map";
					        var draggableButton = $('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);
					        draggableButton.click(function () {
					        	if($(this).hasClass('active')){
					        		$(this).removeClass('active').addClass('inactive').text("Activate map");
					        		map.setOptions({ draggable : false });
					        	} else {
					        		$(this).removeClass('inactive').addClass('active').text("Deactivate map");
					        		map.setOptions({ draggable : true });
					        	}
					        });
					    }

					});
		</script>

		<?php } ?>

		<div class="container">

			<div class="resume-contact">

				<div class="two_third first">

					<?php

						global $redux_demo; 
						$company_contact_title = $redux_demo['job-contact-title'];

						if(!empty($company_contact_title)) {

					?>

					<h1 class="resume-section-title" style="margin-bottom: 10px;"><i class="fa fa-list-ul"></i><?php echo $company_contact_title; ?></h1>

					<?php } ?>

					<?php

						global $redux_demo; 
						$company_contact_subtitle = $redux_demo['job-contact-subtitle'];

						if(!empty($company_contact_subtitle)) {

					?>

					<h3 class="resume-section-subtitle"><?php echo $company_contact_subtitle; ?></h3>

					<?php } ?>

					<div id="resume-contact">
                        
                        <?php

							global $redux_demo; 
							$job_contact_state = $redux_demo['job-contact-state'];

							if($job_contact_state == 1) {

						?>

						<form id="contact" type="post" action="" >  
						  	
						  	<span class="contact-name">
								<input type="text"  name="contactName" id="contactName" value="" class="input-textarea" placeholder="<?php _e("Name*", "themesdojo"); ?>" />
							</span>
							 
							<span class="contact-email">
								<input type="text" name="email" id="email" value="" class="input-textarea" placeholder="<?php _e("Email*", "themesdojo"); ?>" />
							</span>

							<span class="contact-message">
							    <textarea name="message" id="message" cols="8" rows="8" ></textarea>
							</span>

							<span class="contact-test">
							    <p style="margin-top: 20px;"><?php _e("Human test. Please input the result of 5+3=?", "themesdojo"); ?></p>
							    <input type="text" onfocus="if(this.value=='')this.value='';" onblur="if(this.value=='')this.value='';" name="answer" id="humanTest" value="" class="input-textarea" />
							</span>

							<input type="text" name="receiverEmail" id="receiverEmail" value="<?php echo $wpjobus_job_email; ?>" class="input-textarea" style="display: none;"/>

							<input type="hidden" name="action" value="wpjobContactForm" />
							<?php wp_nonce_field( 'scf_html', 'scf_nonce' ); ?>

							<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Send Message', 'themesdojo' ); ?>" class="input-submit">	 

							<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>
						  	  
						</form>

						<div id="success">
							<span>
							   	<h3><?php echo $wpcrown_contact_thankyou; ?></h3>
							</span>
						</div>
							 
						<div id="error">
							<span>
							   	<h3><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></h3>
							</span>
						</div>

						<script type="text/javascript">

						jQuery(function($) {
							jQuery('#contact').validate({
						        rules: {
						            contactName: {
						                required: true
						            },
						            email: {
						                required: true,
						                email: true
						            },
						            message: {
						                required: true
						            },
						            answer: {
						                required: true,
						                answercheck: true
						            }
						        },
						        messages: {
						            name: {
						                required: "<?php echo $wpcrown_contact_name_error; ?>"
						            },
						            email: {
						                required: "<?php echo $wpcrown_contact_email_error; ?>"
						            },
						            message: {
						                required: "<?php echo $wpcrown_contact_message_error; ?>"
						            },
						            answer: {
						                required: "<?php echo $wpcrown_contact_test_error; ?>"
						            }
						        },
						        submitHandler: function(form) {
						        	jQuery('#contact .input-submit').css('display','none');
						        	jQuery('#contact .submit-loading').css('display','block');
						            jQuery(form).ajaxSubmit({
						            	type: "POST",
								        data: jQuery(form).serializeArray(),
								        url: '<?php echo admin_url('admin-ajax.php'); ?>', 
						                success: function(data) {
						                   	jQuery('#contact :input').attr('disabled', 'disabled');
						                    jQuery('#contact').fadeTo( "slow", 0, function() {
						                    	jQuery('#contact').css('display','none');
						                        jQuery(this).find(':input').attr('disabled', 'disabled');
						                        jQuery(this).find('label').css('cursor','default');
						                        jQuery('#success').fadeIn();
						                    });
						                },
						                error: function(data) {
						                    jQuery('#contact').fadeTo( "slow", 0, function() {
						                        jQuery('#error').fadeIn();
						                    });
						                }
						            });
						        }
						    });
						});
						</script>
                        
                        <?php } elseif($job_contact_state == 2) { ?>

							<?php $job_contact_form = $redux_demo['job-contact-form-7']; echo do_shortcode($job_contact_form); ?>

						<?php } elseif($job_contact_state == 3) { ?>

							<?php $job_contact_form = $redux_demo['job-gravity-forms']; echo do_shortcode("[gravityform title=false id=".$job_contact_form." ajax=true]"); ?>

						<?php } elseif($job_contact_state == 4) { ?>
                        
							<?php $job_contact_form = $redux_demo['job-ninja-forms']; echo do_shortcode($job_contact_form); ?>

						<?php } ?>

					</div>

				</div>

				<div class="one_third">

					<h1 class="resume-section-title" style="margin-bottom: 80px;"><i class="fa fa-envelope"></i><?php _e( 'Contact Details', 'themesdojo' ); ?></h1>

					<span class="resume-contact-info">

						<i class="fa fa-briefcase"></i><span><?php $wpjobus_company_fullname = esc_attr(get_post_meta($job_company, 'wpjobus_company_fullname',true)); echo $wpjobus_company_fullname; ?></span>

					</span>

					<?php if(!empty($wpjobus_job_address)) { ?>

					<span class="resume-contact-info">

						<i class="fa fa-map-marker"></i><span><?php echo $wpjobus_job_address; ?></span>

					</span>

					<?php } ?>

					<?php if(!empty($wpjobus_job_phone)) { ?>

					<span class="resume-contact-info">

						<i class="fa fa-mobile"></i><span><?php echo $wpjobus_job_phone; ?></span>

					</span>

					<?php } ?>

					<?php if(!empty($wpjobus_job_website)) { ?>

					<span class="resume-contact-info">

						<?php 

							$return = $wpjobus_job_website;
							$url = $wpjobus_job_website;
							if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

						?>

						<i class="fa fa-link"></i><span><a href="<?php echo $return; ?>"><?php echo $wpjobus_job_website; ?></a></span>

					</span>

					<?php } ?>

					<?php if(!empty($wpjobus_job_email)) { ?>

					<?php if(!empty($wpjobus_job_publish_email)) { ?>

					<span class="resume-contact-info">

						<i class="fa fa-envelope-o"></i><span><a href="mailto:<?php echo $wpjobus_job_email; ?>"><?php echo $wpjobus_job_email; ?></a></span>

					</span>

					<?php } } ?>

					<?php if(!empty($wpjobus_job_facebook)) { ?>

					<span class="resume-contact-info">

						<?php 

							$return = $wpjobus_job_facebook;
							$url = $wpjobus_job_facebook;
							if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

						?>

						<i class="fa fa-facebook-square"></i><span><a href="<?php echo $return; ?>"><?php _e( 'Facebook', 'themesdojo' ); ?></a></span>

					</span>

					<?php } ?>

					<?php if(!empty($wpjobus_job_linkedin)) { ?>

					<span class="resume-contact-info">

						<?php 

							$return = $wpjobus_job_linkedin;
							$url = $wpjobus_job_linkedin;
							if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

						?>

						<i class="fa fa-linkedin-square"></i><span><a href="<?php echo $return; ?>"><?php _e( 'LinkedIn', 'themesdojo' ); ?></a></span>

					</span>

					<?php } ?>

					<?php if(!empty($wpjobus_job_twitter)) { ?>

					<span class="resume-contact-info">

						<?php 

							$return = $wpjobus_job_twitter;
							$url = $wpjobus_job_twitter;
							if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

						?>

						<i class="fa fa-twitter-square"></i><span><a href="<?php echo $return; ?>"><?php _e( 'Twitter', 'themesdojo' ); ?></a></span>

					</span>

					<?php } ?>

					<?php if(!empty($wpjobus_job_googleplus)) { ?>

					<span class="resume-contact-info">

						<?php 

							$return = $wpjobus_job_googleplus;
							$url = $wpjobus_job_googleplus;
							if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

						?>

						<i class="fa fa-google-plus-square"></i><span><a href="<?php echo $return; ?>"><?php _e( 'Google+', 'themesdojo' ); ?></a></span>

					</span>

					<?php } ?>

				</div>

			</div>

		</div>

	</section>

<?php endwhile; ?>

<?php get_footer(); ?>