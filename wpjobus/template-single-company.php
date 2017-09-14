<?php
/**
 * Company Page
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

//$get_post_user_plan = get_post_user_plan($post->post_author);//old code
$get_post_user_plan = get_post_user_plan(get_current_user_id());//New code
//$get_post_user_plan = 'Gold Membership'; 
//check_current_role('administrator')=='success';




$wpjobus_company_cover_image = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_cover_image',true));
$wpjobus_company_fullname = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_fullname',true));
$wpjobus_company_tagline = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_tagline',true));
$company_industry = esc_attr(get_post_meta($td_this_post_id, 'company_industry',true));
$td_company_team_size = esc_attr(get_post_meta($td_this_post_id, 'company_team_size',true));
$resume_about_me = html_entity_decode(get_post_meta($td_this_post_id, 'company-about-me',true));
$wpjobus_company_foundyear = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_foundyear',true));
$wpjobus_company_profile_picture = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_profile_picture',true));
$company_location = esc_attr(get_post_meta($td_this_post_id, 'company_location',true));

$wpjobus_resume_prof_title = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_prof_title',true));
$td_resume_career_level = esc_attr(get_post_meta($td_this_post_id, 'resume_career_level',true));

$wpjobus_resume_comm_level = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_comm_level',true));
$wpjobus_resume_comm_note = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_comm_note',true));

$wpjobus_resume_org_level = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_org_level',true));
$wpjobus_resume_org_note = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_org_note',true));

$wpjobus_resume_job_rel_level = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_job_rel_level',true));
$wpjobus_resume_job_rel_note = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_job_rel_note',true));

$wpjobus_company_services = get_post_meta($td_this_post_id, 'wpjobus_company_services',true);
$wpjobus_company_expertise = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_expertise',true));

$wpjobus_resume_education = get_post_meta($td_this_post_id, 'wpjobus_resume_education',true);
$wpjobus_resume_award = get_post_meta($td_this_post_id, 'wpjobus_resume_award',true);
$wpjobus_company_clients = get_post_meta($td_this_post_id, 'wpjobus_company_clients',true);
$wpjobus_company_testimonials = get_post_meta($td_this_post_id, 'wpjobus_company_testimonials',true);

$wpjobus_resume_remuneration = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_remuneration',true));
$wpjobus_resume_remuneration_per = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_remuneration_per',true));

$wpjobus_resume_job_freelance = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_job_freelance',true));
$wpjobus_resume_job_part_time = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_job_part_time',true));
$wpjobus_resume_job_full_time = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_job_full_time',true));
$wpjobus_resume_job_internship = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_job_internship',true));
$wpjobus_resume_job_volunteer = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_resume_job_volunteer',true));

$wpjobus_company_portfolio = get_post_meta($td_this_post_id, 'wpjobus_company_portfolio',true);


$wpjobus_company_address = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_address',true));
$wpjobus_company_phone = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_phone',true));
$wpjobus_company_website = esc_url(get_post_meta($td_this_post_id, 'wpjobus_company_website',true));
$wpjobus_company_email = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_email',true));
$wpjobus_company_publish_email = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_publish_email',true));
$wpjobus_company_facebook = esc_url(get_post_meta($td_this_post_id, 'wpjobus_company_facebook',true));
$wpjobus_company_linkedin = esc_url(get_post_meta($td_this_post_id, 'wpjobus_company_linkedin',true));
$wpjobus_company_twitter = esc_url(get_post_meta($td_this_post_id, 'wpjobus_company_twitter',true));
$wpjobus_company_googleplus = esc_url(get_post_meta($td_this_post_id, 'wpjobus_company_googleplus',true));

$wpjobus_company_googleaddress = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_googleaddress',true));
$wpjobus_company_longitude = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_longitude',true));
$wpjobus_company_latitude = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_latitude',true));
$wpjobus_company_calendar_shortcode_id = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_calendar_shortcode_id',true));

//company gallery
$wpjobus_company_gallery=get_post_meta($post->ID, 'wpjobus_company_gallery', true);

get_header(); 

global $redux_demo;
$contact_email = esc_attr(get_post_meta($td_this_post_id, 'wpjobus_company_email',true));
$wpcrown_contact_email_error = esc_attr($redux_demo['contact-email-error']);
$wpcrown_contact_name_error = esc_attr($redux_demo['contact-name-error']);
$wpcrown_contact_message_error = esc_attr($redux_demo['contact-message-error']);
$wpcrown_contact_thankyou = esc_attr($redux_demo['contact-thankyou-message']);
$wpcrown_contact_test_error = esc_attr($redux_demo['contact-test-error']);

?>

<script>

function highlightStar(obj,id) {
	removeHighlight(id);		
	jQuery('.demo-table #provider_rating-'+id+' li').each(function(index) {
		jQuery(this).addClass('highlight');
		if(index == jQuery('.demo-table #provider_rating-'+id+' li').index(obj)) {
			return false;	
		}
	});
}

function removeHighlight(id) {
	jQuery('.demo-table #provider_rating-'+id+' li').removeClass('selected');
	jQuery('.demo-table #provider_rating-'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	jQuery('.demo-table #provider_rating-'+id+' li').each(function(index) {
		jQuery(this).addClass('selected');
		jQuery('#provider_rating-'+id+' #rating').val((index+1));
		if(index == jQuery('.demo-table #provider_rating-'+id+' li').index(obj)) {
			return false;	
		}
	});
			var class_name ="";
			 if(id == 1){
						class_name = 'first';
					  }else if(id == 2){
						 class_name = 'second';
                      }else if(id == 3){
						 class_name = 'third';
                      }else if(id == 4){
						 class_name = 'four';
                      }else if(id == 5){
						 class_name = 'five';
                      }
			
			var provider_type_rating = jQuery('#provider_rating-'+id+' #rating').val();
			var current_post_id = '<?php echo $td_this_post_id ?>';
			jQuery.ajax({
					type: "POST",
					url: ajaxurl,
					data: {
					action : 'add_providers_ratings',
					id : id,
					rating : provider_type_rating,
					post_id : current_post_id,
			  },
					beforeSend: function(){
						jQuery('.rating-pro-'+class_name+'-right .pro-loader').show();
						
											
					},		   		
				 })
				.done(function( data ) {		
					  jQuery('.rating-pro-'+class_name+'-right .pro-loader').hide();
					  var parsedData = JSON.parse(data);
					  var ratings = parsedData.rating;
					  var type_id = parsedData.type_id;
					  var class_selected = "";
					  var keyname = ""
					  if(type_id == 1){
						keyname = 'first';
					  }else if(type_id == 2){
						 keyname = 'second';
                      }else if(type_id == 3){
						 keyname = 'third';
                      }else if(type_id == 4){
						 keyname = 'four';
                      }else if(type_id == 5){
						 keyname = 'five';
                      }

					  
					  var rating_show = '';
					  for (var i = 1; i <= 5; i++) {
						  class_selected = '';
						  if(i <= ratings){

							class_selected = 'selected';
						  }
						 rating_show +=  '<li class="'+class_selected+'" onmouseover="highlightStar(this,'+type_id+');" onmouseout="removeHighlight('+type_id+');" onClick="addRating(this,'+type_id+');">&#9733;</li>&nbsp;';							
					  }
					
					
					  jQuery('.rating-pro-'+keyname+'-ul').html(rating_show);					 
					  jQuery("#provider_rating-"+type_id+" #rating").val(ratings);
					 

					  if(parsedData.type == 1){
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').html('Please login to add ratings.');
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').css({"color":"red","font-weight":"600"});
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').show();
					  }

					  if(parsedData.type == 2){
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').html('You have already added rating for this provider.');
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').css({"color":"red","font-weight":"600"});
						 jQuery('.rating-pro-'+class_name+'-right .pro-message').show();
					  }

					   if(parsedData.type == 3){
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').html('Thank you.');
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').css({"color":"#9CD092","font-weight":"600"});
						  jQuery('.rating-pro-'+class_name+'-right .pro-message').show();
						  jQuery('.rating-pro-'+class_name+'-right .pro-average').html(parsedData.average+"/"+parsedData.total);
						  jQuery('.rating-pro-'+class_name+'-right .pro-total').html("("+parsedData.total+")");
						  
					  }

					  

					  
					 
				});



}



function resetRating(id) {
	if(jQuery('#provider_rating-'+id+' #rating').val() != 0) {
		jQuery('.demo-table #provider_rating-'+id+' li').each(function(index) {
			jQuery(this).addClass('selected');
			if((index+1) == jQuery('#provider_rating-'+id+' #rating').val()) {
				return false;	
			}
		});
	}
} </script>




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

							$author_id = $wpdb->get_results( "SELECT DISTINCT post_author FROM `{$wpdb->prefix}posts` WHERE post_type = 'company' and ID = '".$td_this_post_id."' ORDER BY `ID` DESC");

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

				      								<?php $redirect_link = home_url('/')."?post_type=company&p=".$td_this_post_id."&preview=true"; ?>

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

		
		
		<div class="container">
			<div class="col-md-offset-1 col-md-10">
				<div class="scmh_sub">
				<?php 
				if($get_post_user_plan != 'Free Listing'){
				
				?>
					<div class="schm_logo">
					<img src="<?php echo $wpjobus_company_profile_picture; ?>">
						
					</div>
					<?php
				}
					
					?>
					<div class="schm_heading">
						<h3><?php echo $wpjobus_company_fullname.' - '.$wpjobus_company_tagline; ?></h3>
						
						<div class="loca_phne">
						<?php
						if(!empty($wpjobus_company_address))
						{
							echo '<span><i class="fa fa-map-marker"></i> '.$wpjobus_company_address.'</span>';
						}
						
						if(!empty($wpjobus_company_phone))
						{
							echo '<span><i class="fa fa-phone"></i> '.$wpjobus_company_phone.'</span>';
						}
						
						?>
							
						</div>
						
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
	      			<input name="favorite_type" id="favorite_type" type="hidden" value="company" />

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
				</div>
			</div>
		</div>
		
		
		

		<div class="coverImageHolder">
			<img src="<?php echo $wpjobus_company_cover_image; ?>" alt="" class="bgImg">
		</div>

	</section>

	
	<section id="company-menu" class="m_top_links">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="mtl_sub">
						<ul class="nav navbar-nav">

				<li class="menuItem active backtophome"><a href="#backtop"><?php _e( 'Home', 'themesdojo' ); ?></a></li>
				<li class="menuItem"><a href="#resume-contact-block"><?php _e( 'Profile', 'themesdojo' ); ?></a></li>
				<?php if($get_post_user_plan != 'Free Listing'){ ?>
				<?php if($get_post_user_plan != 'Silver Membership') { ?>
				<li class="menuItem"><a href="#resume-jobs-block"><?php _e( 'Job Offers', 'themesdojo' ); ?></a></li>
				<?php } ?>
				<li class="menuItem"><a href="#resume-experience-block"><?php _e( 'Clients', 'themesdojo' ); ?></a></li>
				<?php if($get_post_user_plan != 'Silver Membership') { ?>
				<li class="menuItem"><a href="#resume-portfolio-block"><?php _e( 'Portfolio', 'themesdojo' ); ?></a></li>
				<?php } 
				 ?>
				<li class="menuItem"><a href="#resume-gallery-block"><?php _e( 'Gallery', 'themesdojo' ); ?></a></li>
				<?php   
				
				} ?>
				<li class="menuItem"><a href="#resume-contact-block"><?php _e( 'Contact', 'themesdojo' ); ?></a></li>

			</ul>

			<select id="mobile-nav-bar" onchange="location = this.options[this.selectedIndex].value;">

				<option value="#backtop"><?php _e( 'Home', 'themesdojo' ); ?></option>
				<option value="#resume-about-block"><?php _e( 'Profile', 'themesdojo' ); ?></option>
				<option value="#resume-jobs-block"><?php _e( 'Job Offers', 'themesdojo' ); ?></option>
				<option value="#resume-experience-block"><?php _e( 'Clients', 'themesdojo' ); ?></option>
				<option value="#resume-portfolio-block"><?php _e( 'Portfolio', 'themesdojo' ); ?></option>
				<option value="#resume-contact-block"><?php _e( 'Contact', 'themesdojo' ); ?></option>

			</select>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="resume-contact-block" class="main_description">
		<div class="container">
			<div class="md-table">
				<div class="md-table-cell">
					<div class="map_dtals">
						<div class="map_image" id="resume-map">
							
						</div>
						<script type="text/javascript">
					var mapDiv,
						map,
						infobox;
					jQuery(document).ready(function($) {

						mapDiv = $("#resume-map");
						mapDiv.height(600).gmap3({
							map: {
								options: {
									"center": [<?php echo (!empty($wpjobus_company_latitude)?$wpjobus_company_latitude:'-25.274398'); ?>,<?php echo (!empty($wpjobus_company_longitude)?$wpjobus_company_longitude:'133.77513599999997'); ?>]
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
									<?php $params = array( "width" => 230, "height" => 150, "crop" => true ); $image = wp_get_attachment_image_src( get_post_thumbnail_id( $td_this_post_id ), "single-post-thumbnail" ); ?>

									latLng: [<?php echo $wpjobus_company_latitude; ?>,<?php echo $wpjobus_company_longitude; ?>],
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
						<div class="m_othr_detals">
							<div class="row">
								<div class="col-md-6">
								<?php
										if(!empty($wpjobus_company_address)) { 
										?>
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-map-marker"></i></span>
										
										<div class="mod-main">
										<?php
									
										echo '<span class="mod-txt">'.$wpjobus_company_address.' </span>';
										
										?>
										</div>
									</div>
									<?php
										}
										
										if(!empty($wpjobus_company_email)) 
										{ 
										if(!empty($wpjobus_company_publish_email)) {
									
									?>
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-map-marker"></i></span>
										
										<div class="mod-main">
										<?php 
										
											echo '<span class="mod-txt"><a href="mailto:'.$wpjobus_company_email.'">'.$wpjobus_company_email.'</a></span>';
											
										
									
									?>
										</div>
									</div>
									<?php
									}
										
										
										}
										 if(!empty($wpjobus_company_facebook) && $get_post_user_plan != 'Free Listing') {
										?>
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-facebook-square"></i></span>
										
										<div class="mod-main">
										<?php
										$return = $wpjobus_company_facebook;
										$url = $wpjobus_company_facebook;
										if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

										 
										echo '<span class="mod-txt"><a href="'.$return.'">Facebook</a> </span>';
										
										?>
										</div>
									</div>
									
									<?php
										 }
										  if(!empty($wpjobus_company_googleplus) && $get_post_user_plan != 'Free Listing') {
										?>
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-google-plus-square"></i></span>
										
										<div class="mod-main">
										<?php
										$return = $wpjobus_company_googleplus;
										$url = $wpjobus_company_googleplus;
										if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

										 
										echo '<span class="mod-txt"><a href="'.$return.'">Google+</a> </span>';
										
										?>
										</div>
									</div>
									
									<?php
										 }
									?>
									
								</div>
								<div class="col-md-6">
								<?php 
								if(!empty($wpjobus_company_phone)) {
								
								?>
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-map-marker"></i></span>
										
										<div class="mod-main">
										<?php
										 
										echo '<span class="mod-txt">'.$wpjobus_company_phone.' </span>';
										
										?>
										</div>
									</div>
									
									<?php
									}
									if($get_post_user_plan != 'Free Listing') 
									{
										
										 
										 if(!empty($wpjobus_company_linkedin)) {
										?>
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-linkedin-square"></i></span>
										
										<div class="mod-main">
										<?php
										$return = $wpjobus_company_linkedin;
										$url = $wpjobus_company_linkedin;
										if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

										 
										echo '<span class="mod-txt"><a href="'.$return.'">LinkedIn</a> </span>';
										
										?>
										</div>
									</div>
									
									<?php
										 }
										if(!empty($wpjobus_company_twitter)) {
										?>
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-twitter-square"></i></span>
										
										<div class="mod-main">
										<?php
										$return = $wpjobus_company_twitter;
										$url = $wpjobus_company_twitter;
										if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

										 
										echo '<span class="mod-txt"><a href="'.$return.'">Twitter</a> </span>';
										
										?>
										</div>
									</div>
									
									<?php
										 }
									}
										

									?>
									
									
								</div>
							
							</div>
							<?php
										if(!empty($wpjobus_company_website)) { 
										?>
							
							<div class="row">
								<div class="col-md-12">
									<div class="mod-sub">
										<span class="mod-ico"><i class="fa fa-map-marker"></i></span>
										
										<div class="mod-main">
										<?php
										 
										$return = $wpjobus_company_website;
							$url = $wpjobus_company_website;
							if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }

										echo '<span class="mod-txt"><a href="'.$return.'">'.$wpjobus_company_website.'</a></span>';
										?>
										</div>
									</div>
									
									
								</div>
							
							</div>
							<?php
							
							}
										?>
						</div>
						
					</div>
				</div>
				<div class="md-table-cell">
					<div class="main-des-sec">
						
						<div class="mds-head">
							<h2><?php echo $wpjobus_company_fullname; ?></h2>
						</div>
						<div class="mds-rating">
							<ul>
								<?php echo do_shortcode('[mr_rating_result]'); ?>
							</ul>
						</div>
						<div class="mds-txt">
							<?php
							$content = $resume_about_me;

						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);

						echo $content;
							
							
							?>
						</div>
						<?php
						if($get_post_user_plan != 'Free Listing'){ 
						if (!empty($wpjobus_company_expertise) && ($get_post_user_plan != 'Silver Membership')) {
						
						?>
						<div class="mds-extra-srv">
							<div class="mds-es-head">
								<h3><?php _e( 'Expertise', 'themesdojo' ); ?> : <?php _e( 'What we are good at.', 'themesdojo' ); ?></h3>
							</div>
							

							<ul>
							<?php echo $wpjobus_company_expertise; ?>
							</ul>
						</div>
						
						<?php
						}
						}
						
						
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<?php if($get_post_user_plan != 'Free Listing'){ ?>
		<section class="m-srvces-show company_services_out" id="resume-skills-block">
		<div class="container">
			<div class="row row-margin">
				<div class="col-md-12">
					<div class="mss-heading">
						<h3><?php _e( 'Services', 'themesdojo' ); ?></h3>
					</div>
				</div>
			</div>
			<?php
			$current = -1;

					if(!empty($wpjobus_company_services)) {
						echo '<div class="row">';

					for ($i = 0; $i < (count($wpjobus_company_services)); $i++) {

						echo '<div class="col-md-4 col-sm-6">
					<div class="mss-sub mss-active">
						<span>'.esc_attr($wpjobus_company_services[$i][0]).'</span>
					</div><div class="mss-sub mss-disable">';
					if($wpjobus_company_services[$i][2])
					echo '<span>'.esc_attr($wpjobus_company_services[$i][2]).'</span>';
				    else
					echo '<span>No Content Available. </span>';
					echo '</div></div>';
					}
					
				echo '</div>';
					}
			
			?>
			
			
				

				
			
		</div>
	</section>
	
	<?php
	}
	
	if($get_post_user_plan != 'Free Listing' && $get_post_user_plan != 'Silver Membership'){
	?>
	<section class="m-vacancies company_availability_out">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="mss-heading">
						<?php

						global $redux_demo; 
						$company_contact_title = $redux_demo['company-contact-title'];

						if(!empty($company_contact_title)) {

					?>

					<h3><?php echo $company_contact_title; ?></h3>

					<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="">
						<?php if (($get_post_user_plan != 'Free Listing') && ($get_post_user_plan != 'Silver Membership')) { ?>
				<div class="">

					

					<?php

						global $redux_demo; 
						$company_contact_subtitle = $redux_demo['company-contact-subtitle'];

						if(!empty($company_contact_subtitle)) {

					?>

					<h3 class="resume-section-subtitle"><?php echo $company_contact_subtitle; ?></h3>

					<?php } ?>

					<div id="resume-contact">
                        
                        <?php

							global $redux_demo; 
							$company_contact_state = $redux_demo['company-contact-state'];
						
						
							if($company_contact_state == 1) {
									//echo do_shortcode($wpjobus_company_calendar_shortcode);
									

						?>

						
                        
                        <?php } elseif($company_contact_state == 2) { ?>

							<?php 
							 $val_num = stripslashes($wpjobus_company_calendar_shortcode_id);
							 if($val_num != ""){
							
							 $wpjobus_company_calendar_shortcodenew = '[wpdevart_booking_calendar id="'.$val_num.'"]';

								echo  do_shortcode($wpjobus_company_calendar_shortcodenew);
							 }else{
								echo  do_shortcode('[contact-form-7 id="11935" title="Provider Availability Form"]'); 
							 }
							//$company_contact_form = $redux_demo['company-contact-form-7']; echo do_shortcode($company_contact_form); 
							
							//echo $wpjobus_company_calendar_shortcodenew;

							//$get_allmeta = get_post_meta($td_this_post_id);

							//echo '<pre>';
							//print_r($get_allmeta);
							?>

						<?php } elseif($company_contact_state == 3) { ?>

							<?php $company_contact_form = $redux_demo['company-gravity-forms']; echo do_shortcode("[gravityform title=false id=".$company_contact_form." ajax=true]"); ?>

						<?php } elseif($company_contact_state == 4) { ?>

							<?php $company_contact_form = $redux_demo['company-ninja-forms']; echo do_shortcode($company_contact_form); ?>

						<?php } ?>

					</div>

				</div>
				<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<?php 
	}
	 if($get_post_user_plan != 'Free Listing'){
	
	if ($get_post_user_plan != 'Silver Membership') { ?>
	<section class="review-main-sec company_rate_out" id="resume-rating-block">
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<div class="rms-big-rating">
						
						<span class="rms-ra-txt"><?php _e( 'Provider Ratings', 'themesdojo' ); ?></span>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="rms-small-rating">
					<div class="demo-table">
							<div id="provider_rating-1">
								<?php 
										  $get_value_average = get_post_meta( $td_this_post_id, 'provider_first_rating_average', true);
										  if($get_value_average != ''){
											 $get_value_int_average = floor($get_value_average);
										  }else{
											$get_value_int_average = 0;
										  }
										  $get_value_int_average;
										  $get_value_total = get_post_meta( $td_this_post_id, 'provider_first_rating_total', true);
										  
										$get_value_total1 = get_post_meta( $td_this_post_id, 'provider_first_rating_total', true);
										if(!$get_value_total1)
										$get_value_total1 = 0;
										  
								?>
								<input type="hidden" name="rating" id="rating" value="<?php echo $get_value_int_average; ?>" />
								<div class="rating-pro-first-left">
									<ul onMouseOut="resetRating(1);" class="rating-pro-first-ul">
										  <?php
										
										  for($i=1;$i<=5;$i++) {
											  $selected = "";
											    if($i<=$get_value_int_average) {
													 $selected = "selected";
												 }
										  
										  ?>
										  <li class="<?php echo $selected; ?>" onmouseover="highlightStar(this,1);" onmouseout="removeHighlight(1);" onClick="addRating(this,1);">&#9733;</li>  
										  <?php }  ?>
									</ul>
								</div>
								<div class="rating-pro-first-right"><span class="pro-average"><?php echo $get_value_average; ?>/<?php echo $get_value_total; ?></span><span class="pro-total">(<?php echo $get_value_total1; ?>)</span><span class="pro-loader"><i class="fa fa-spinner fa-spin"></i></span><span class="pro-message"></span></div>
							 </div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="rms-small-rating">
						<div class="demo-table">
							<div id="provider_rating-2">
								<?php 
										  $get_value_average = get_post_meta( $td_this_post_id, 'provider_second_rating_average', true);
										  if($get_value_average != ''){
											 $get_value_int_average = floor($get_value_average);
										  }else{
											$get_value_int_average = 0;
										  }
										  $get_value_total = get_post_meta( $td_this_post_id, 'provider_second_rating_total', true);
										  $get_value_total1 = get_post_meta( $td_this_post_id, 'provider_first_rating_total', true);
										if(!$get_value_total1)
										$get_value_total1 = 0;
								?>
								<input type="hidden" name="rating" id="rating" value="<?php echo $get_value_int_average; ?>" />
								<div class="rating-pro-second-left">
									<ul onMouseOut="resetRating(2);"  class="rating-pro-second-ul">
										   <?php
										
										  for($i=1;$i<=5;$i++) {
											  $selected = "";
											    if($i<=$get_value_int_average) {
													$selected = "selected";
												 }
										  
										  ?>
										  <li class="<?php echo $selected; ?>" onmouseover="highlightStar(this,2);" onmouseout="removeHighlight(2);" onClick="addRating(this,2);">&#9733;</li>  
										  <?php }  ?>
									</ul>
								</div>
								<div class="rating-pro-second-right"><span class="pro-average"><?php echo $get_value_average; ?>/<?php echo $get_value_total; ?></span><span class="pro-total">(<?php echo $get_value_total1; ?>)</span><span class="pro-loader"><i class="fa fa-spinner fa-spin"></i></span><span class="pro-message"></span></div>
							 </div>
							
						</div>
						<span class="rms-ra-txt">Respectful interactions and communication</span>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="rms-small-rating">
						<div class="demo-table">
							<div id="provider_rating-3">
								<?php 
										  $get_value_average = get_post_meta( $td_this_post_id, 'provider_third_rating_average', true);
										  if($get_value_average != ''){
											 $get_value_int_average = floor($get_value_average);
										  }else{
											$get_value_int_average = 0;
										  }
										  $get_value_total = get_post_meta( $td_this_post_id, 'provider_third_rating_total', true);
										  $get_value_total1 = get_post_meta( $td_this_post_id, 'provider_first_rating_total', true);
										if(!$get_value_total1)
										$get_value_total1 = 0;
								?>
								<input type="hidden" name="rating" id="rating" value="<?php echo $get_value_int_average; ?>" />
								<div class="rating-pro-third-left">
									<ul onMouseOut="resetRating(3);"  class="rating-pro-third-ul">
										   <?php
										 
										  for($i=1;$i<=5;$i++) {
											  $selected = "";
											    if( $i<=$get_value_int_average) {
													$selected = "selected";
												 }
										  
										  ?>
										  <li class="<?php echo $selected; ?>" onmouseover="highlightStar(this,3);" onmouseout="removeHighlight(3);" onClick="addRating(this,3);">&#9733;</li>  
										  <?php }  ?>
									</ul>
								</div>
								<div class="rating-pro-third-right"><span class="pro-average"><?php echo $get_value_average; ?>/<?php echo $get_value_total; ?></span><span class="pro-total">(<?php echo $get_value_total1; ?>)</span><span class="pro-loader"><i class="fa fa-spinner fa-spin"></i></span><span class="pro-message"></span></div>
							 </div>
							
						</div>
						<span class="rms-ra-txt">Safe and Comfortable environment</span>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="rms-small-rating">
						<div class="demo-table">
							<div id="provider_rating-4">
								<?php 
										  $get_value_average = get_post_meta( $td_this_post_id, 'provider_four_rating_average', true);
										  if($get_value_average != ''){
											 $get_value_int_average = floor($get_value_average);
										  }else{
											$get_value_int_average = 0;
										  }
										  $get_value_total = get_post_meta( $td_this_post_id, 'provider_four_rating_total', true);
										  
										  $get_value_total1 = get_post_meta( $td_this_post_id, 'provider_first_rating_total', true);
										if(!$get_value_total1)
										$get_value_total1 = 0;
								?>
								<input type="hidden" name="rating" id="rating" value="<?php echo $get_value_int_average; ?>" />
								<div class="rating-pro-four-left">
									<ul onMouseOut="resetRating(4);"  class="rating-pro-four-ul">
										   <?php
										
										  
										  for($i=1;$i<=5;$i++) {
											  $selected = "";
											    if($i<=$get_value_int_average) {
													$selected = "selected";
												 }
										  
										  ?>
										  <li class="<?php echo $selected; ?>" onmouseover="highlightStar(this,4);" onmouseout="removeHighlight(4);" onClick="addRating(this,4);">&#9733;</li>  
										  <?php }  ?>
									</ul>
								</div>
								<div class="rating-pro-four-right"><span class="pro-average"><?php echo $get_value_average; ?>/<?php echo $get_value_total; ?></span><span class="pro-total">(<?php echo $get_value_total1; ?>)</span><span class="pro-loader"><i class="fa fa-spinner fa-spin"></i></span><span class="pro-message"></span></div>
							 </div>
							
						</div>
						<span class="rms-ra-txt">Responsive to concerns raised</span>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="rms-small-rating">
						<div class="demo-table">
							<div id="provider_rating-5">
								<?php 
										  $get_value_average = get_post_meta( $td_this_post_id, 'provider_five_rating_average', true);
										  if($get_value_average != ''){
											 $get_value_int_average = floor($get_value_average);
										  }else{
											$get_value_int_average = 0;
										  }
										  $get_value_total = get_post_meta( $td_this_post_id, 'provider_five_rating_total', true);
										  $get_value_total1 = get_post_meta( $td_this_post_id, 'provider_first_rating_total', true);
										if(!$get_value_total1)
										$get_value_total1 = 0;
								?>
								<input type="hidden" name="rating" id="rating" value="<?php echo $get_value_int_average; ?>" />
								<div class="rating-pro-five-left">
									<ul onMouseOut="resetRating(5);"  class="rating-pro-five-ul">
										  <?php
										 
										  for($i=1;$i<=5;$i++) {
											  $selected = "";
											    if($i<=$get_value_int_average) {
													$selected = "selected";
												 }
										  
										  ?>
										  <li class="<?php echo $selected; ?>" onmouseover="highlightStar(this,5);" onmouseout="removeHighlight(5);" onClick="addRating(this,5);">&#9733;</li>  
										  <?php }  ?>
									</ul>
								</div>
								<div class="rating-pro-five-right"><span class="pro-average"><?php echo $get_value_average; ?>/<?php echo $get_value_total; ?></span><span class="pro-total">(<?php echo $get_value_total1; ?>)</span><span class="pro-loader"><i class="fa fa-spinner fa-spin"></i></span><span class="pro-message"></span></div>
							 </div>
							
						</div>
						<span class="rms-ra-txt">Quality of care and customer service</span>
					</div>
				</div>
				
				
				
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="rte-btns rate_buttons_out">
						<?php
						echo do_shortcode('[mr_rating_form]');
						
						?>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
	<?php
	}
	
	}
	
	?>
	
	
	

	
	

	
	
<?php if($get_post_user_plan != 'Free Listing'){ ?>
	
	<?php if ($get_post_user_plan != 'Silver Membership') { ?>

<style>
.demo-table {width: 48%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333; display:inline}
.demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
.rating-pro-first-left {
    display: inline-block;
}
.rating-pro-first-right {
    display: inline-block;
}
.rating-pro-second-left {
    display: inline-block;
}
.rating-pro-second-right {
    display: inline-block;
}
.rating-pro-third-left {
    display: inline-block;
}
.rating-pro-third-right {
    display: inline-block;
}
.rating-pro-four-left {
    display: inline-block;
}
.rating-pro-four-right {
    display: inline-block;
}
.rating-pro-five-left {
    display: inline-block;
}
.rating-pro-five-right {
    display: inline-block;
}
.pro-average {
    color: #999;
    padding-left: 10px;
}
.pro-total {
    color: #999;
    padding-left: 6px;
}
.pro-loader{
	display:none;
	padding-left:10px;
}
.pro-message{
	padding-left:10px;
}
</style>

	<section id="resume-jobs-block" class="company_jobofers_out">

		<div class="container">

			<div class="resume-skills job_offers_out">

				<h1 class="resume-section-title"><?php _e( 'Job Offers', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'We’re hiring! Please check our job offers and contact us.', 'themesdojo' ); ?></h3>

				<div class="work-experience-holder">

					<?php 

						$querystr2 = "SELECT DISTINCT ID FROM $wpdb->posts, $wpdb->postmeta WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_company' AND $wpdb->postmeta.meta_value = $id AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'job' AND $wpdb->posts.post_date < NOW() ORDER BY $wpdb->posts.post_date DESC
						";
							
						//$querystr2 = "SELECT * FROM $wpdb->posts  where  $wpdb->posts.post_type = 'job'";
						$pageposts2 = $wpdb->get_results($querystr2, OBJECT);

					?>

					<?php if ($pageposts2): ?>
					<?php global $td_jobOffer; ?>
				 	<?php foreach ($pageposts2 as $td_jobOffer): ?>
					<?php setup_postdata($td_jobOffer); ?>

					    <div class="job-offers-post" id="post-<?php the_ID(); ?>">
					     	<div class="one_third first" style="margin-bottom: 0;">
					     		<h3><a href="<?php $td_result_job_id = $td_jobOffer->ID; $joblink = home_url('/')."job/".$td_result_job_id; echo $joblink; ?>"><?php echo $wpjobus_job_fullname = esc_attr(get_post_meta($td_jobOffer->ID, 'wpjobus_job_fullname',true)); ?></a></h3>
					     	</div>
					     	<div class="two_third" style="margin-bottom: 0;">

					     		<div class="one_third first" style="margin-bottom: 0;">
					     			<span class="job-location"><i class="fa fa-map-marker"></i><?php echo $td_job_location = esc_attr(get_post_meta($td_jobOffer->ID, 'job_location',true)); ?></span>
					     		</div>

					     		<div class="one_third" style="margin-bottom: 0;">
					     			<span class="job-time"><i class="fa fa-calendar"></i><?php the_time('F jS, Y') ?></span>
					     		</div>

					     		<div class="one_third" style="margin-bottom: 0;">
					     			<?php

					     				$company_id = $td_this_post_id;
					     				global $redux_demo;
										$colorState = 0;

										if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][0] ) {
											$colorState = 1;
											$color = "#16a085";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][1] ) {
											$colorState = 1;
											$color = "#3498db";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][2] ) {
											$colorState = 1;
											$color = "#e74c3c";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][3] ) {
											$colorState = 1;
											$color = "#1abc9c";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][4] ) {
											$colorState = 1;
											$color = "#8e44ad";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][5] ) {
											$colorState = 1;
											$color = "#9b59b6";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][6] ) {
											$colorState = 1;
											$color = "#34495e";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][7] ) {
											$colorState = 1;
											$color = "#e67e22";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][8] ) {
											$colorState = 1;
											$color = "#e74c3c";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][9] ) {
											$colorState = 1;
											$color = "#16a085";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][10] ) {
											$colorState = 1;
											$color = "#2980b9";
										} elseif(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][11] ) {
											$colorState = 1;
											$color = "#2ecc71";
										}

									?>

					     			<span class="job-offers-post-badge" style="<?php if($colorState ==1) { ?>background-color: <?php echo $color; ?>; border: solid 2px <?php echo $color; ?>;<?php } ?>">
										<span class="job-offers-post-badge-job-type" style="<?php if($colorState ==1) { ?>color: <?php echo $color; ?>;<?php } ?>"><?php echo $wpjobus_job_type = esc_attr(get_post_meta($td_jobOffer->ID, 'wpjobus_job_type',true)); ?></span>
										<span class="job-offers-post-badge-amount"><?php echo $wpjobus_job_remuneration = esc_attr(get_post_meta($td_jobOffer->ID, 'wpjobus_job_remuneration',true)); ?></span>
										<span class="job-offers-post-badge-amount-per">/<?php echo $wpjobus_job_remuneration_per = esc_attr(get_post_meta($td_jobOffer->ID, 'wpjobus_job_remuneration_per',true)); ?></span>
									</span>
					     		</div>

					     	</div>
					    </div>

					<?php endforeach; ?>
					  
					<?php else : ?>
					    <h3 class="resume-section-subtitle nodata_avaiable"><?php _e( 'We are sorry, but there are no jobs available.', 'themesdojo' ); ?></h3>
					<?php endif; ?>

				</div>

			</div>

		</div>

	</section>
<?php } ?>
	<section id="resume-experience-block" class="company_clients_out">

		<div class="container">

			<div class="resume-skills clients_sec_out">

			<?php if ($get_post_user_plan != 'Silver Membership') { ?>

				<h1 class="resume-section-title"><?php _e( 'Clients', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'Here’s a list of companies which are our beloved clients.', 'themesdojo' ); ?></h3>

				<div class="divider clint_divider"></div>

				<div class="work-experience-holder">

					<?php 
					

						if(isArrayEmpty($wpjobus_company_clients)) {

							for ($i = 0; $i < (count($wpjobus_company_clients)); $i++) {
					?>
					
					<div class="client_loop_out">
					
					<div class="clint_head_titles">
					<h2><?php echo esc_attr($wpjobus_company_clients[$i][0]); ?></h2>
					<h3><?php echo esc_attr($wpjobus_company_clients[$i][1]); ?></h3>

					
					</div>
					
					<div class="clint_head_period">
					
					<h5><?php echo esc_attr($wpjobus_company_clients[$i][2]); ?> - <?php echo esc_attr($wpjobus_company_clients[$i][3]); ?></h5>
					<?php
					$return = esc_url($wpjobus_company_clients[$i][4]);
					$url = esc_url($wpjobus_company_clients[$i][4]);
					if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }
					
					?>
					<h6 class="cl_link"><a href="<?php echo $return; ?>"><?php echo esc_url($wpjobus_company_clients[$i][4]); ?></a></h6>
					</div>
					
					<div class="clint_msg_block">
						<span class="work-experience-notes"><?php echo esc_attr($wpjobus_company_clients[$i][5]); ?></span>
					
					</div>
					

				
					</div>

					<?php } }
					else
					{
						echo '<h3 class="nodata_avaiable resume-section-subtitle">No Clients Available</h3>';
					}
					

					?>

				</div>

				<?php } 
				
				
				
				if(isArrayEmpty($wpjobus_company_testimonials)) { ?>
				<div class="testimonials_main_out">
				<h1 class="resume-section-title"> <?php _e( 'Testimonials', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle"><?php _e( 'Here’s what clients are saying about our company. ', 'themesdojo' ); ?></h3>

				<div id="owl-demo-2" class="owl_car_review owl-carousel owl-theme">

					<?php 
						for ($i = 0; $i < (count($wpjobus_company_testimonials)); $i++) {
					?>
 
				  	<div class="item">
					<div class="testimonial_auth_out">
					<h3>
						<span class="resume-testimonial-author">
							<?php echo esc_attr($wpjobus_company_testimonials[$i][0]); ?>
							</span> 
					</h3>
					</div>
				  		<div class="resume-testimonials">

				  			<span class="resume-testimonials-image">

				  				<?php 

				  					$wpjobus_company_testimonials_profile_picture = esc_url($wpjobus_company_testimonials[$i][3]);

					  				require_once(get_template_directory() . '/inc/BFI_Thumb.php'); 
									$params = array( 'width' => 70, 'height' => 70, 'crop' => true );
									echo "<img src='" . bfi_thumb( "$wpjobus_company_testimonials_profile_picture", $params ) . "' alt='" . esc_attr($wpjobus_company_testimonials[$i][0]) . "'/>";

								?>

				  			</span>

				  			<span class="resume-testimonials-quote"><i class="fa fa-quote-right"></i></span>

				  			<div class="resume-testimonials-note"><?php echo esc_attr($wpjobus_company_testimonials[$i][2]); ?></div>

				  			<div class="resume-testimonials-author-box">
							
							<span class="resume-testimonial-author-position"><i><?php echo esc_attr($wpjobus_company_testimonials[$i][1]); ?></i></span>
							</div>

				  		</div>

				  	</div>

				  	<?php } ?>
				 
				</div>
				</div>

				<?php } ?>
				

			</div>

		</div>

	</section>
<?php }



?>

	

<?php
if($get_post_user_plan != 'Free Listing')
{

?>
<section id="resume-portfolio-block" class="company_portfolio_out">

		<div class="container">

			<h1 class="resume-section-title"><?php _e( 'Portfolio', 'themesdojo' ); ?></h1>
			<h3 class="resume-section-subtitle"><?php _e( 'Here are some of my works.', 'themesdojo' ); ?></h3>

			<section class="ff-container">

				<?php

					$categories = 0;

					if(!empty($wpjobus_company_portfolio)) {

						for ($i = 0; $i < (count($wpjobus_company_portfolio)); $i++) {

							if(!empty($wpjobus_company_portfolio[$i][1])) {
								$categories++;
							}

						}

					}

				?>

				<?php if($categories > 0) { ?>
 
			    <input id="select-type-all" name="radio-set-1" type="radio" class="ff-selector-type-all" checked="checked" />
			    <label for="select-type-all" class="ff-label-type-all"><?php _e( 'All', 'themesdojo' ); ?></label>

			    <?php 

			    if(!empty($wpjobus_company_portfolio)) {

				    for ($i = 0; $i < (count($wpjobus_company_portfolio)); $i++) {

						if(!empty($wpjobus_company_portfolio[$i][1])) {
							$all_project_cat[] = $wpjobus_company_portfolio[$i][1];
						}

					}

				}

				?>

					<?php

					$catProjID = 0;

					$directors = array_unique($all_project_cat);
					$k=1;
					foreach ($directors as $director) { 
					$catProjID++; 
					$directorClass_0 = preg_replace('/^\/[^a-zA-Z0-9_ -%][().][\/]/s', '_', $director); 
					$directorClass = preg_replace('/\s*,\s*/', '_', $directorClass_0);
					$string1 = preg_replace('/\s+/', '', $director);
					?>

						<style>

				    		.ff-container input.ff-selector-type-<?php echo $directorClass; ?>:checked ~ label.ff-label-type-<?php echo $directorClass; ?> {
							    background: #999;
							    color: #fff;
							    padding: 10px 20;
							}

							.ff-container input.ff-selector-type-<?php echo $directorClass; ?>:checked ~ .ff-items .ff-item-type-<?php echo $directorClass; ?> {
							    opacity: 1;
							}

							.ff-container input.ff-selector-type-<?php echo $directorClass; ?>:checked ~ .ff-items li:not(.ff-item-type-<?php echo $directorClass; ?>) {
							    opacity: 0.1;
							}

							.ff-container input.ff-selector-type-<?php echo $directorClass; ?>:checked ~ .ff-items li:not(.ff-item-type-<?php echo $directorClass; ?>) span {
							    display: none;
							}


				    	</style>

						<input id="select-type-<?php echo $directorClass; ?>" name="radio-set-1" type="radio" class="ff-selector-type-<?php echo $directorClass; ?>" />
				    	<label for="select-type-<?php echo $directorClass; ?>" id="port_label_<?php echo $string1; ?>" class="ff-label-type-<?php echo $directorClass; ?> port_label"><?php echo $director; ?></label>
						
					<?php
					$k++;
					} ?>

			    <?php } ?>
			     
			    <div class="clr"></div>
			     
			    <ul class="ff-items <?php if($categories == 0) { ?>visibile-projects<?php } ?>">

			    	<?php 

			    	$current = -1;
					$n=1;

			    	if(!empty($wpjobus_company_portfolio)) {

					    for ($p = 0; $p < (count($wpjobus_company_portfolio)); $p++) {

					    	$directorClassProj_0 = preg_replace('/[^a-zA-Z0-9_ -%][().][\/]/s', '_', $wpjobus_company_portfolio[$p][1]); $directorClassProj = preg_replace('/\s*,\s*/', '_', $directorClassProj_0);
					    	$current++;
							$string2 = preg_replace('/\s+/', '', $wpjobus_company_portfolio[$p][1]);

						?>

				        <li class="ff-item-type-<?php echo $directorClassProj; ?> <?php if($current%3 ==0) { echo 'first'; } ?> port_label_<?php echo  $string2;?>">
				            <a href="<?php echo $wpjobus_company_portfolio[$p][3]; ?>" data-lightbox="portfolio" data-title="<?php echo $wpjobus_company_portfolio[$p][2]; ?>">
				                <span><?php echo $wpjobus_company_portfolio[$p][0]; ?></span>

				                <?php 

									require_once(get_template_directory() . '/inc/BFI_Thumb.php'); 
									$params = array( 'width' => 430, 'height' => 247, 'crop' => true );
									$wpjobus_company_portfolio_img = $wpjobus_company_portfolio[$p][3];
									if(empty($wpjobus_company_portfolio_img))
									{
									$wpjobus_company_portfolio_imgarr=wp_get_attachment_image_src(12073);
								    $wpjobus_company_portfolio_img=$wpjobus_company_portfolio_imgarr[0];
									}
									echo "<img src='" . bfi_thumb( "$wpjobus_company_portfolio_img", $params ) . "' alt='" . $wpjobus_company_portfolio[$p][0] . "'/>";

								?>

				            </a>
				        </li>

				    <?php 
					$n++;
					
					} }
					else
					{
						echo '<h3 class="resume-section-subtitle nodata_avaiable">No Portfolios Available.</h3>';
						
					}
					?>

			    </ul>
			     
			</section>

		</div>

	</section>
	<section  class="photos-main-sec company_pgallery_out">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="mss-heading">
						<h3>Photos</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="pms-sub">
					<?php
					$wpjobus_company_gallery = get_post_meta($post->ID, 'wpjobus_company_gallery', true);
					if($wpjobus_company_gallery)
					{
						echo '<ul class="img-gal">';
					
						foreach($wpjobus_company_gallery as $wpjobus_company_gall)
						{
							
							$galimg=wp_get_attachment_url( $wpjobus_company_gall);
							echo ' <li class=""><img class="img-responsive" src="'.$galimg.'"></li>';
							
						}
						echo '</ul>';
					}
					else
					{
						echo '<div class="work-experience-holder">

								
								<h3 class="resume-section-subtitle nodata_avaiable">No Gallery available.</h3>
								
							</div>';
						
					}
					
					?>
						  
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<div class="modal lightbox-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	<?php
}
	
	?>
	
	
		
<?php endwhile; ?>

<?php get_footer(); ?>