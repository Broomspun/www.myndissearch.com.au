<?php
/**
 * Template name: Login Page
 */

if ( is_user_logged_in() ) { 

	$profile = home_url('/')."my-account";
	wp_redirect( $profile ); exit;

} 

if(isset($_GET['info'])) { $info_text = $_GET['info']; };
global $redux_demo; 
$access_state_text = $redux_demo['access-state-text'];

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

get_header(); ?>

	<section id="blog">

		<div class="container">

			<div class="resume-skills">

				<h1 class="resume-section-title"><i class="fa fa-check"></i><?php _e( 'Login', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php if(!empty($info_text)) { if($info_text == "accesspage") { echo $access_state_text; } else { _e( 'You’ll be able to post your resume, apply for a job, add companies profiles and post job offers!', 'themesdojo' ); } } ?></h3>

				<div class="divider"></div>

				<div class="full">

					<div class="one_half first">

						<form id="wpjobus-register" type="post" action="" >

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
									<input type="password" name="userPassword" id="userPassword" value="" class="input-textarea" placeholder="" />
									<label for="userPassword" class="error userPasswordError"></label>

									<fieldset class="input-full-width" style="padding: 0;">
										<input name="rememberme" type="checkbox" value="forever" style="float: left; width: auto; margin-right: 5px; margin-top: 2px;"/><span style="margin-left: 10px; float: left; margin-bottom: 10px;"><?php _e( 'Remember me', 'themesdojo' ); ?></span>
										<a style="float: right;" class="" href="<?php $reset = home_url('/')."reset"; echo $reset; ?>"><?php _e( 'Forgot Password', 'themesdojo' ); ?></a>
									</fieldset>

								</span>

							</div>
							
							<input type="hidden" name="action" value="wpjobusLoginForm" />
							<?php wp_nonce_field( 'wpjobusLogin_html', 'wpjobusLogin_nonce' ); ?>


							<?php 

							include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

							if ( is_plugin_active( "linkedin-login/linkedin-login.php" ) ) { ?>
								<container class="full">
									<div class="one_third first">

										<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Login', 'themesdojo' ); ?>" class="input-submit">

									<br></br>

									</div>
										
									<div class="two_third">
										<?php echo do_shortcode('[wpli_login_link]'); ?> 
									</div>
								<container>
							
							<?php }	else {	?>

									<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Login', 'themesdojo' ); ?>" class="input-submit">

							<?php } ?>


							<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>

							<div class="divider"></div>

							<div class="full">

								<?php _e( 'Don\'t have an account yet?', 'themesdojo' ); ?> <a href="<?php $register = home_url('/')."register"; echo $register; ?>" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Register"><?php printf( __( 'Register', 'themesdojo' )); ?></a>

							</div>
						  	  
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
							jQuery('#wpjobus-register').validate({
						        rules: {
						            userName: {
						                required: true,
						                minlength: 3
						            },
						            userPassword: {
						                required: true,
						                minlength: 1,
						            }
						        },
						        messages: {
							        userName: {
							            required: "<?php _e( 'Please provide a username', 'themesdojo' ); ?>",
							            minlength: "<?php _e( 'Your username must be at least 3 characters long', 'themesdojo' ); ?>"
							        },
							        userPassword: {
							            required: "<?php _e( 'Please provide a password', 'themesdojo' ); ?>",
							            minlength: "<?php _e( 'Your password must be at least 6 characters long', 'themesdojo' ); ?>"
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
						                		jQuery(".userNameError").text("<?php _e( 'Username doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','inline-block');

						                		jQuery('#wpjobus-register .input-submit').css('display','inline-block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 2) {
						                		jQuery("#userPassword").addClass("error");
						                		jQuery(".userPasswordError").text("<?php _e( 'Password doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userPasswordError').css('display','inline-block');

						                		jQuery('#wpjobus-register .input-submit').css('display','inline-block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	if(data == 3) {
						                		jQuery("#userName").addClass("error");
						                		jQuery(".userNameError").text("<?php _e( 'Username doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userNameError').css('display','inline-block');

						                		jQuery("#userPassword").addClass("error");
						                		jQuery(".userPasswordError").text("<?php _e( 'Password doesn’t exists. Please try another one.', 'themesdojo' ); ?>");
						                		jQuery('.userPasswordError').css('display','block');

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

	</section>

<?php get_footer(); ?>