<?php
/**
 * Template name: Reset Password Page
 */

if ( is_user_logged_in() ) { 

	global $redux_demo; 
	$profile = $redux_demo['profile'];
	wp_redirect( $profile ); exit;

}

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

get_header(); ?>

	<section id="blog">

		<div class="container">

			<div class="resume-skills">

				<h1 class="resume-section-title"><i class="fa fa-check"></i><?php _e( 'Reset Password', 'themesdojo' ); ?></h1>

				<div class="divider"></div>

				<div class="full">

					<div class="one_half first">

						<form id="wpjobus-register" type="post" action="" >

							<div class="full" style="margin-bottom: 0;">  
						  	
							  	<span class="one_fourth first">
									<h3><?php _e( 'Email:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fourth">
									<input type="text" name="userEmail" id="userEmail" value="" class="input-textarea" placeholder="" />
									<label for="userEmail" class="error userEmailError"></label>
								</span>

							</div>
							
							<input type="hidden" name="action" value="wpjobusResetForm" />
							<?php wp_nonce_field( 'wpjobusReset_html', 'wpjobusReset_nonce' ); ?>

							<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Submit', 'themesdojo' ); ?>" class="input-submit">	 

							<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>
						  	  
						</form>

						<div id="success">
							<span>
							   	<h3><?php _e( 'Check your email for new password.', 'themesdojo' ); ?></h3>
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
						                required: true,
						                email: true
						            }
						        },
						        messages: {
							        userEmail: {
							            required: "<?php _e( 'Please provide an email address', 'themesdojo' ); ?>",
							            email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
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
						                	if(data == 2) {
						                		jQuery("#userEmail").addClass("error");
						                		jQuery(".userEmailError").text("<?php _e( 'There is no user available for this email.', 'themesdojo' ); ?>");
						                		jQuery('.userEmailError').css('display','inline-block');

						                		jQuery('#wpjobus-register .input-submit').css('display','inline-block');
						        				jQuery('#wpjobus-register .submit-loading').css('display','none');
						                	}

						                	
						                	if(data == 1) {
						                		jQuery('#wpjobus-register :input').attr('disabled', 'disabled');
							                    jQuery('#wpjobus-register').fadeTo( "slow", 0, function() {
							                    	jQuery('#wpjobus-register').css('display','none');
							                        jQuery(this).find(':input').attr('disabled', 'disabled');
							                        jQuery(this).find('label').css('cursor','default');
							                        jQuery('#success').fadeIn();
							                    });
						                	}

						                	if(data == 3) {
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

					<div class="one_half">



					</div>

				</div>

			</div>

		</div>

	</section>

<?php get_footer(); ?>