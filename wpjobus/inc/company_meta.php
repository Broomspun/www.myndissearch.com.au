<?php

/**************************************
Custom Post Meta Boxes
***************************************/

	add_action('add_meta_boxes', 'register_company_settings');
	function register_company_settings () {
		add_meta_box('wpjobus_company_basic_settings', 'Basic Info', 'display_wpjobus_company_basic_settings','company');
		add_meta_box('wpjobus_company_services_settings', 'Services', 'display_wpjobus_company_services_settings','company');
		add_meta_box('wpjobus_company_clients_settings', 'Clients', 'display_wpjobus_company_clients_settings','company');
		add_meta_box('wpjobus_company_testimonials_settings', 'Testimonials', 'display_wpjobus_company_testimonials_settings','company');
		add_meta_box('wpjobus_company_portfolio_settings', 'Portfolio', 'display_wpjobus_company_portfolio_settings','company');
		add_meta_box('wpjobus_company_contact_settings', 'Contact', 'display_wpjobus_company_contact_settings','company');
		add_meta_box('wpjobus_company_gallery_settings', 'Gallery', 'display_wpjobus_company_gallery_settings','company');
	}

	function display_wpjobus_company_basic_settings ($post) {
		//get the post meta data
		
		$wpjobus_company_fullname = esc_attr(get_post_meta($post->ID, 'wpjobus_company_fullname',true));
		$wpjobus_company_tagline = esc_attr(get_post_meta($post->ID, 'wpjobus_company_tagline',true));
		$wpjobus_company_foundyear = esc_attr(get_post_meta($post->ID, 'wpjobus_company_foundyear',true));
		$td_company_team_size = esc_attr(get_post_meta($post->ID, 'company_team_size',true));
		$company_industry = esc_attr(get_post_meta($post->ID, 'company_industry',true));
		$company_location = esc_attr(get_post_meta($post->ID, 'company_location',true));
		$resume_about_me = esc_attr(get_post_meta($post->ID, 'company-about-me',true));
		$wpjobus_company_profile_picture = esc_attr(get_post_meta($post->ID, 'wpjobus_company_profile_picture',true));
		$wpjobus_company_cover_image = esc_attr(get_post_meta($post->ID, 'wpjobus_company_cover_image',true));

		?>
		
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

		<style>
			#review_options_popup {
				display: block;
			}

			#poststuff #titlewrap, #post-body #normal-sortables {
				display: none;
			}

			#review_options_popup .option_item {
				background: #FFF;
				margin: 0 -10px 0 -10px;
				border-bottom: 1px solid #EEE;
				padding: 14px 10px 14px 10px;
				width: 100%;
			}

			#review_options_popup .option_item span.text {
				float: left;
				display: block;
				width: 150px;
				margin-top: 5px;
			}

			#review_options_popup .option_item .criteria_name {
				float: left;
				margin-right: 36px;
				width: 400px;
			}

			#review_options_popup .option_item span.text {
				width: 150px;
				margin-right: 10px;
			}

			#review_options_popup .option_item input {
				float: left;
				margin-right: 20px;
			}

			.full {
				width: 100%;
				display: inline-block;
			}

			.recipe-desc {
				float: left;
			}

			.info-text {
				font-style: italic;
				float: left;
				margin-top: 10px;
				width: 70%;
				margin-left: 113px;
			}

			.criteria-image {
				max-width: 590px;
				height: auto;
			}

			#wpjobus_company_portfolio_settings{
				display:block;
			}
			

		</style>

		<div id='review_options_popup'>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Company Name:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_fullname' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_fullname; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Tag Line:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_tagline' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_tagline; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Foundation Year:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_foundyear' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_foundyear; ?>' placeholder="" />
				
			</div>

			<div class="option_item">

				<div class="full">

					<span class='text overall'>Team Size:</span>

					<div style="float: left;">
						<select name="company_team_size" id="company_team_size" style="width: 60px; margin-right: 10px;">
							<?php 
								echo $td_company_team_size;

								for ($i = 1; $i <= 50; $i++) {
							?>
							<option value='<?php echo $i; ?>' <?php selected( $td_company_team_size, $i ); ?>><?php echo $i; ?></option>
							<?php 
								}
							?>
							<option value='50+' <?php selected( $td_company_team_size, "50+" ); ?>>50+</option>
						</select>
					</div>

				</div>

			</div>

			<div class="option_item">

				<div class="full">

					<span class='text overall'>Industry:</span>

					<div style="float: left;">
						<select name="company_industry" id="company_industry" style="width: 260px; margin-right: 10px;">
							<?php 
								global $redux_demo; 
								for ($i = 0; $i < count($redux_demo['resume-industries']); $i++) {
							?>
							<option value='<?php echo $redux_demo['resume-industries'][$i]; ?>' <?php selected( $company_industry, $redux_demo["resume-industries"][$i] ); ?>><?php echo $redux_demo['resume-industries'][$i]; ?></option>
							<?php 
								}
							?>
						</select>
					</div>

				</div>

			</div>

			<div class="option_item">

				<div class="full">

					<span class='text overall'>Location:</span>
					<?php
					global $wpdb;
					$suburbdata = $wpdb->get_results("SELECT * FROM suburb");
					?>
					<div style="float: left;">
						<select name="company_location" id="company_location" class="chosen" style="width: 260px; margin-right: 10px;">
							<?php 
								global $redux_demo; 
								for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
							?>
							<option value='<?php echo $redux_demo['resume-locations'][$i]; ?>' <?php selected( $company_location, $redux_demo["resume-locations"][$i] ); ?>><?php echo $redux_demo['resume-locations'][$i]; ?></option>
							<?php 
								}

								/*foreach ($suburbdata as $key => $value) {
									?>
									<option value='<?php echo $value->suburbname; ?>' <?php selected( $company_location, $value->suburbname); ?>><?php echo $value->suburbname; ?></option>
									<?php
								}*/
							?>
						</select>
					</div>

				</div>

			</div>

			<div class="option_item">
				
				<span class='full'>	
					<span class="text">Description:</span>
					<textarea class="recipe-desc" name="company-about-me" id='company-about-me' cols="70" rows="7" ><?php echo $resume_about_me; ?></textarea>
				</span>
				
			</div>

			<div class="option_item">

				<span class="full">
						<span class="text">Logo</span>

						<span>

						<?php if(!empty($wpjobus_company_profile_picture)) { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img" src="<?php if (!empty($wpjobus_company_profile_picture)) echo $wpjobus_company_profile_picture; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url" type="text" size="36" name="wpjobus_company_profile_picture" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_profile_picture)) echo $wpjobus_company_profile_picture; ?>" />
			                <input class="criteria-image-button-remove button" id="wpjobus_company_profile_picture" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>

			            <?php } else { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img" src="<?php if (!empty($wpjobus_company_profile_picture)) echo $wpjobus_company_profile_picture; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url" type="text" size="36" name="wpjobus_company_profile_picture" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_profile_picture)) echo $wpjobus_company_profile_picture; ?>" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px; display: none;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>

			            <?php } ?>

			            <script>
				            var image_custom_uploader;
				            var $thisItem = '';

				            jQuery(document).on('click','.criteria-image-button', function(e) {
				                e.preventDefault();

				                $thisItem = jQuery(this);

				                //If the uploader object has already been created, reopen the dialog
				                if (image_custom_uploader) {
				                    image_custom_uploader.open();
				                    return;
				                }

				                //Extend the wp.media object
				                image_custom_uploader = wp.media.frames.file_frame = wp.media({
				                    title: 'Choose Image',
				                    button: {
				                        text: 'Choose Image'
				                    },
				                    multiple: false
				                });

				                //When a file is selected, grab the URL and set it as the text field's value
				                image_custom_uploader.on('select', function() {
				                    attachment = image_custom_uploader.state().get('selection').first().toJSON();
				                    var url = '';
				                    url = attachment['url'];
				                    $thisItem.parent().find('.criteria-image-url').val(url);
				                    $thisItem.parent().find( "img.criteria-image" ).attr({
				                        src: url
				                    });
				                    $thisItem.parent().find(".criteria-image-button").css("display", "none");
				                    $thisItem.parent().find(".criteria-image-button-remove").css("display", "block");
				                });

				                //Open the uploader dialog
				                image_custom_uploader.open();
				             });

				             jQuery(document).on('click','.criteria-image-button-remove', function(e) {
				                jQuery(this).parent().find('.criteria-image-url').val('');
				                jQuery(this).parent().find( "img.criteria-image" ).attr({
				                    src: ''
				                });
				                jQuery(this).parent().find(".criteria-image-button").css("display", "block");
				                jQuery(this).css("display", "none");
				             });
						</script>

			        	</span>

			        </span>

			</div>

			<div class="option_item">

				<span class="full">
						<span class="text">Cover Image</span>

						<span>

						<?php if(!empty($wpjobus_company_cover_image)) { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img" src="<?php if (!empty($wpjobus_company_cover_image)) echo $wpjobus_company_cover_image; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url" type="text" size="36" name="wpjobus_company_cover_image" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_cover_image)) echo $wpjobus_company_cover_image; ?>" />
			                <input class="criteria-image-button-remove button" id="wpjobus_company_cover_image" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>

			            <?php } else { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img" src="<?php if (!empty($wpjobus_company_cover_image)) echo $wpjobus_company_cover_image; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url<?php echo $i; ?>2" type="text" size="36" name="wpjobus_company_cover_image" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_cover_image)) echo $wpjobus_company_cover_image; ?>" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px; display: none;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>

			            <?php } ?>

			            <script>
				            var image_custom_uploader;
				            var $thisItem = '';

				            jQuery(document).on('click','.criteria-image-button', function(e) {
				                e.preventDefault();

				                $thisItem = jQuery(this);

				                //If the uploader object has already been created, reopen the dialog
				                if (image_custom_uploader) {
				                    image_custom_uploader.open();
				                    return;
				                }

				                //Extend the wp.media object
				                image_custom_uploader = wp.media.frames.file_frame = wp.media({
				                    title: 'Choose Image',
				                    button: {
				                        text: 'Choose Image'
				                    },
				                    multiple: false
				                });

				                //When a file is selected, grab the URL and set it as the text field's value
				                image_custom_uploader.on('select', function() {
				                    attachment = image_custom_uploader.state().get('selection').first().toJSON();
				                    var url = '';
				                    url = attachment['url'];
				                    $thisItem.parent().find('.criteria-image-url').val(url);
				                    $thisItem.parent().find( "img.criteria-image" ).attr({
				                        src: url
				                    });
				                    $thisItem.parent().find(".criteria-image-button").css("display", "none");
				                    $thisItem.parent().find(".criteria-image-button-remove").css("display", "block");
				                });

				                //Open the uploader dialog
				                image_custom_uploader.open();
				             });

				             jQuery(document).on('click','.criteria-image-button-remove', function(e) {
				                jQuery(this).parent().find('.criteria-image-url').val('');
				                jQuery(this).parent().find( "img.criteria-image" ).attr({
				                    src: ''
				                });
				                jQuery(this).parent().find(".criteria-image-button").css("display", "block");
				                jQuery(this).css("display", "none");
				             });
						</script>

			        	</span>

			        </span>

			</div>

			<br>

		</div>	<!-- end review_options_pop -->


		<?php

		}

		// Ingredients Post Meta //


		function display_wpjobus_company_services_settings ($post) {
		//get the post meta data

			$wpjobus_company_services = get_post_meta($post->ID, 'wpjobus_company_services',true);

			$wpjobus_company_expertise = esc_attr(get_post_meta($post->ID, 'wpjobus_company_expertise',true));

		?>
		
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

		<div id='review_options_popup'>

			<div id="company_service">
				<?php 
					for ($i = 0; $i < (count($wpjobus_company_services)); $i++) {
				?>
				
				<div class="option_item" id="<?php echo $i; ?>">
					
					<span class='text'>Service <?php echo ($i+1); ?></span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Service Name:</span>
						<select  name='wpjobus_company_services[<?php echo $i; ?>][0]' id='wpjobus_company_services[<?php echo $i; ?>][0]'>
						<option value='Accommodation/Tenancy' <?php if($wpjobus_company_services[$i][0] == "Accommodation/Tenancy"){ echo 'selected="selected"'; } ?>>Accommodation/Tenancy </option>			
						<option value='Assist Access/Maintain Employment or Higher Education' <?php if($wpjobus_company_services[$i][0] == "Assist Access/Maintain Employment or Higher Education"){ echo 'selected="selected"'; } ?> >Assist Access/Maintain Employment or Higher Education</option>
						<option value='Assist Prod-Pers Care/Safety' <?php if($wpjobus_company_services[$i][0] == "Assist Prod-Pers Care/Safety"){ echo 'selected="selected"'; } ?> >Assist Prod-Pers Care/Safety</option>
						<option value='Accommodation/Tenancy' <?php if($wpjobus_company_services[$i][0] == "High Intensity Daily Personal Activities"){ echo 'selected="selected"'; } ?> >High Intensity Daily Personal Activities</option>
						<option value='Assistive Equip-Recreation' <?php if($wpjobus_company_services[$i][0] == "Assistive Equip-Recreation"){ echo 'selected="selected"'; } ?> >Assistive Equip-Recreation</option>
						<option value='Assistive Prod-Household Task' <?php if($wpjobus_company_services[$i][0] == "Assistive Prod-Household Task"){ echo 'selected="selected"'; } ?> >Assistive Prod-Household Task</option>
						<option value='Assist-Life Stage, Transition' <?php if($wpjobus_company_services[$i][0] == "Assist-Life Stage, Transition"){ echo 'selected="selected"'; } ?> >Assist-Life Stage, Transition</option>
						<option value='Daily Personal Activities' <?php if($wpjobus_company_services[$i][0] == "Daily Personal Activities"){ echo 'selected="selected"'; } ?> >Daily Personal Activities</option>
						<option value='Assist-Travel/Transport' <?php if($wpjobus_company_services[$i][0] == "Assist-Travel/Transport"){ echo 'selected="selected"'; } ?> >Assist-Travel/Transport</option>
						<option value='Specialised Positive Behaviour Support' <?php if($wpjobus_company_services[$i][0] == "Specialised Positive Behaviour Support"){ echo 'selected="selected"'; } ?> >Specialised Positive Behaviour Support</option>
						<option value='Comms & Info Equipment' <?php if($wpjobus_company_services[$i][0] == "Comms & Info Equipment"){ echo 'selected="selected"'; } ?> >Comms & Info Equipment</option>
						<option value='Community Nursing Care' <?php if($wpjobus_company_services[$i][0] == "Community Nursing Care"){ echo 'selected="selected"'; } ?> >Community Nursing Care</option>
						<option value='Daily Tasks/Shared Living' <?php if($wpjobus_company_services[$i][0] == "Daily Tasks/Shared Living"){ echo 'selected="selected"'; } ?> >Daily Tasks/Shared Living</option>
						<option value='Development-Life Skills' <?php if($wpjobus_company_services[$i][0] == "Development-Life Skills"){ echo 'selected="selected"'; } ?> >Development-Life Skills</option>
						<option value='Early Childhood Supports' <?php if($wpjobus_company_services[$i][0] == "Early Childhood Supports"){ echo 'selected="selected"'; } ?> >Early Childhood Supports</option>
						<option value='Hearing Equipment' <?php if($wpjobus_company_services[$i][0] == "Hearing Equipment"){ echo 'selected="selected"'; } ?> >Hearing Equipment</option>
						<option value='Home Modification' <?php if($wpjobus_company_services[$i][0] == "Home Modification"){ echo 'selected="selected"'; } ?> >Home Modification</option>
						<option value='Household Tasks' <?php if($wpjobus_company_services[$i][0] == "Household Tasks"){ echo 'selected="selected"'; } ?> >Household Tasks</option>
						<option value='Innov Community Participation' <?php if($wpjobus_company_services[$i][0] == "Innov Community Participation"){ echo 'selected="selected"'; } ?> >Innov Community Participation</option>
						<option value='Interpret/Translate' <?php if($wpjobus_company_services[$i][0] == "Interpret/Translate"){ echo 'selected="selected"'; } ?> >Interpret/Translate</option>
						<option value='Assistance Animals' <?php if($wpjobus_company_services[$i][0] == "Assistance Animals"){ echo 'selected="selected"'; } ?> >Assistance Animals</option>
						<option value='Participate Community' <?php if($wpjobus_company_services[$i][0] == "Participate Community"){ echo 'selected="selected"'; } ?> >Participate Community</option>
						<option value='Personal Mobility Equipment' <?php if($wpjobus_company_services[$i][0] == "Personal Mobility Equipment"){ echo 'selected="selected"'; } ?> >Personal Mobility Equipment</option>
						<option value='Exercise Physiology & Personal Training' <?php if($wpjobus_company_services[$i][0] == "Exercise Physiology & Personal Training"){ echo 'selected="selected"'; } ?> >Exercise Physiology & Personal Training</option>
						<option value='Plan Management' <?php if($wpjobus_company_services[$i][0] == "Plan Management"){ echo 'selected="selected"'; } ?> >Plan Management</option>
						<option value='Therapeutic Supports' <?php if($wpjobus_company_services[$i][0] == "Therapeutic Supports"){ echo 'selected="selected"'; } ?> >Therapeutic Supports</option>
						<option value='Specialised Driver Training' <?php if($wpjobus_company_services[$i][0] == "Specialised Driver Training"){ echo 'selected="selected"'; } ?> >Specialised Driver Training</option>
						<option value='Vehicle modifications' <?php if($wpjobus_company_services[$i][0] == "Vehicle modifications"){ echo 'selected="selected"'; } ?> >Vehicle modifications</option>
						<option value='Vision Equipment' <?php if($wpjobus_company_services[$i][0] == "Vision Equipment"){ echo 'selected="selected"'; } ?> >Vision Equipment</option>
						<option value='Specialised support co-ordination' <?php if($wpjobus_company_services[$i][0] == "Specialised support co-ordination"){ echo 'selected="selected"'; } ?> >Specialised support co-ordination</option>
						<option value='Specialised Supported Employment' <?php if($wpjobus_company_services[$i][0] == "Specialised Supported Employment"){ echo 'selected="selected"'; } ?> >Specialised Supported Employment</option>
						<option value='Hearing Services' <?php if($wpjobus_company_services[$i][0] == "Hearing Services"){ echo 'selected="selected"'; } ?> >Hearing Services</option>
						<option value='Group and Centre Based Activities' <?php if($wpjobus_company_services[$i][0] == "Group and Centre Based Activities"){ echo 'selected="selected"'; } ?> >Group and Centre Based Activities</option>
						<option value='Customised Prosthetics' <?php if($wpjobus_company_services[$i][0] == "Customised Prosthetics"){ echo 'selected="selected"'; } ?> >Customised Prosthetics</option>
						
						</select>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Icon code:</span>
						<input type='text' id='wpjobus_company_services[<?php echo $i; ?>][1]' name='wpjobus_company_services[<?php echo $i; ?>][1]' value='<?php if (!empty($wpjobus_company_services[$i][1])) echo $wpjobus_company_services[$i][1]; ?>' class='company_services_name_two' placeholder="<i class='fa fa-rocket'></i>" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Description:</span>
						<textarea class="company_services_notes" name="wpjobus_company_services[<?php echo $i; ?>][2]" id='wpjobus_company_services[<?php echo $i; ?>][2]' cols="70" rows="7" ><?php if (!empty($wpjobus_company_services[$i][2])) echo $wpjobus_company_services[$i][2]; ?></textarea>

					</div>

					<button name="button_del_service" type="button" class="button-secondary button_del_service">delete</button>
					
				</div>
				
				<?php 
					}
				?>


			</div>

			<div id="template_service">
				
				<div class="option_item" id="999">
					<span class='text'>Service 999</span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Service Name testing:</span>
						<select  name='' id='' class='company_services_name'>
						<option value='Accommodation/Tenancy'>Accommodation/Tenancy </option>			
						<option value='Assist Access/Maintain Employment or Higher Education'>Assist Access/Maintain Employment or Higher Education</option>
						<option value='Assist Prod-Pers Care/Safety'>Assist Prod-Pers Care/Safety</option>
						<option value='Accommodation/Tenancy'>High Intensity Daily Personal Activities</option>
						<option value='Assistive Equip-Recreation'>Assistive Equip-Recreation</option>
						<option value='Assistive Prod-Household Task'>Assistive Prod-Household Task</option>
						<option value='Assist-Life Stage, Transition'>Assist-Life Stage, Transition</option>
						<option value='Daily Personal Activities'>Daily Personal Activities</option>
						<option value='Assist-Travel/Transport'>Assist-Travel/Transport</option>
						<option value='Specialised Positive Behaviour Support' >Specialised Positive Behaviour Support</option>
						<option value='Comms & Info Equipment' >Comms & Info Equipment</option>
						<option value='Community Nursing Care'  >Community Nursing Care</option>
						<option value='Daily Tasks/Shared Living'>Daily Tasks/Shared Living</option>
						<option value='Development-Life Skills' >Development-Life Skills</option>
						<option value='Early Childhood Supports'  >Early Childhood Supports</option>
						<option value='Hearing Equipment'>Hearing Equipment</option>
						<option value='Home Modification'>Home Modification</option>
						<option value='Household Tasks'>Household Tasks</option>
						<option value='Innov Community Participation'  >Innov Community Participation</option>
						<option value='Interpret/Translate'>Interpret/Translate</option>
						<option value='Assistance Animals' >Assistance Animals</option>
						<option value='Participate Community'>Participate Community</option>
						<option value='Personal Mobility Equipment'>Personal Mobility Equipment</option>
						<option value='Exercise Physiology & Personal Training'>Exercise Physiology & Personal Training</option>
						<option value='Plan Management' >Plan Management</option>
						<option value='Therapeutic Supports'  >Therapeutic Supports</option>
						<option value='Specialised Driver Training' >Specialised Driver Training</option>
						<option value='Vehicle modifications'  >Vehicle modifications</option>
						<option value='Vision Equipment'  >Vision Equipment</option>
						<option value='Specialised support co-ordination'  >Specialised support co-ordination</option>
						<option value='Specialised Supported Employment'  >Specialised Supported Employment</option>
						<option value='Hearing Services' >Hearing Services</option>
						<option value='Group and Centre Based Activities'  >Group and Centre Based Activities</option>
						<option value='Customised Prosthetics'>Customised Prosthetics</option>
						
						</select>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Icon code:</span>
						<input type='text' id='' name='' value='' class='company_services_name_two' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Notes:</span>
						<textarea class="company_services_notes" name="" id='' cols="70" rows="7" ></textarea>

					</div>

					<button name="button_del_service" type="button" class="button-secondary button_del_service">delete</button>
				</div>

			</div>

			<div class="option_item">
				<button type="button" name="submit_add_service" id='submit_add_service' value="add" class="button-secondary">Add new service</button>
			</div>

			<div class="option_item">
				
				<span class='full'>	
					<span class="text">Expertise:</span>
					<input type='text' id="review-name" class='' name='wpjobus_company_expertise' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_expertise; ?>' placeholder="" />
					<span class="info-text" style="margin-left: 0;">Insert multiple expertise and separate them using commas</span>
				</span>
				
			</div>

			<br>


		</div>	<!-- end review_options_pop -->





		<?php

		}

		function display_wpjobus_company_clients_settings ($post) {

			//get the post meta data
			$wpjobus_company_clients = get_post_meta($post->ID, 'wpjobus_company_clients',true);

		?>
		
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

		<div id='review_options_popup'>

			<div id="company_clients">
				<?php 
					for ($i = 0; $i < (count($wpjobus_company_clients)); $i++) {
				?>
				
				<div class="option_item" id="<?php echo $i; ?>">
					
					<span class='text'>Client <?php echo ($i+1); ?></span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Client Name:</span>
						<input type='text' id='wpjobus_company_clients[<?php echo $i; ?>][0]' name='wpjobus_company_clients[<?php echo $i; ?>][0]' value='<?php if (!empty($wpjobus_company_clients[$i][0])) echo $wpjobus_company_clients[$i][0]; ?>' class='criteria_name' placeholder="">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Contracted for doing:</span>
						<input type='text' id='wpjobus_company_clients[<?php echo $i; ?>][1]' name='wpjobus_company_clients[<?php echo $i; ?>][1]' value='<?php if (!empty($wpjobus_company_clients[$i][1])) echo $wpjobus_company_clients[$i][1]; ?>' class='criteria_name_two' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Period from:</span>
						<input type='text' id='wpjobus_company_clients[<?php echo $i; ?>][2]' name='wpjobus_company_clients[<?php echo $i; ?>][2]' value='<?php if (!empty($wpjobus_company_clients[$i][2])) echo $wpjobus_company_clients[$i][2]; ?>' class='criteria_from_time' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Period to:</span>
						<input type='text' id='wpjobus_company_clients[<?php echo $i; ?>][3]' name='wpjobus_company_clients[<?php echo $i; ?>][3]' value='<?php if (!empty($wpjobus_company_clients[$i][3])) echo $wpjobus_company_clients[$i][3]; ?>' class='criteria_to_time' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Client's Website:</span>
						<input type='text' id='wpjobus_company_clients[<?php echo $i; ?>][4]' name='wpjobus_company_clients[<?php echo $i; ?>][4]' value='<?php if (!empty($wpjobus_company_clients[$i][4])) echo $wpjobus_company_clients[$i][4]; ?>' class='criteria_website' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Notes:</span>
						<textarea class="criteria_notes" name="wpjobus_company_clients[<?php echo $i; ?>][5]" id='wpjobus_company_clients[<?php echo $i; ?>][5]' cols="70" rows="7" ><?php if (!empty($wpjobus_company_clients[$i][5])) echo $wpjobus_company_clients[$i][5]; ?></textarea>

					</div>

					<button name="button_del_client" type="button" class="button-secondary button_del_client">delete</button>
					
				</div>
				
				<?php 
					}
				?>


			</div>

			<div id="template_clients">
				
				<div class="option_item" id="999">
					<span class='text'>Client 999</span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Client Name:</span>
						<input type='text' id='' name='' value='' class='criteria_name' placeholder="">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Contracted for doing:</span>
						<input type='text' id='' name='' value='' class='criteria_name_two' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Period from:</span>
						<input type='text' id='' name='' value='' class='criteria_from_time' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Period to:</span>
						<input type='text' id='' name='' value='' class='criteria_to_time' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Client's Website:</span>
						<input type='text' id='' name='' value='' class='criteria_website' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Notes:</span>
						<textarea class="criteria_notes" name="" id='' cols="70" rows="7" ></textarea>

					</div>

					<button name="button_del_client" type="button" class="button-secondary button_del_client">delete</button>
				</div>

			</div>

			<div class="option_item">
				<button type="button" name="submit_add_client" id='submit_add_client' value="add" class="button-secondary">Add new client</button>
			</div>


			<br>


		</div>	<!-- end review_options_pop -->





		<?php

		}
		
		function display_wpjobus_company_gallery_settings($post)
		{
			
			wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
			$ids = get_post_meta($post->ID, 'wpjobus_company_gallery', true);
			
			//echo $ids;

			?>
			<table class="form-table">
			  <tr><td>
				<a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Add image(s)</a>

				<ul id="gallery-metabox-list">
				<?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>

				  <li>
					<input type="hidden" name="wpjobus_company_gallery[<?php echo $key; ?>]" value="<?php echo $value; ?>">
					<div class="comp_img_out">
					<img class="image-preview" src="<?php echo $image[0]; ?>">
					</div>
					<a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
					<small><a class="remove-image" href="#">Remove image</a></small>
				  </li>

				<?php endforeach; endif; ?>
				</ul>

			  </td></tr>
			</table>
			<?php
			 wp_enqueue_media();
			
			?>
			<script>
			function resetIndex() {
    jQuery('#gallery-metabox-list li').each(function(i) {
      jQuery(this).find('input:hidden').attr('name', 'wpjobus_company_gallery[' + i + ']');
    });
  }

  function makeSortable() {
    jQuery('#gallery-metabox-list').sortable({
      opacity: 0.6,
      stop: function() {
        resetIndex();
      }
    });
  }
			jQuery(document).ready(function(){
				
				var file_frame;

				  jQuery(document).on('click', '#wpjobus_company_gallery_settings a.gallery-add', function(e) {
					 

					e.preventDefault();

					if (file_frame) file_frame.close();

					file_frame = wp.media.frames.file_frame = wp.media({
					  title: jQuery(this).data('uploader-title'),
					  button: {
						text: jQuery(this).data('uploader-button-text'),
					  },
					  multiple: true
					});

					file_frame.on('select', function() {
					  var listIndex = jQuery('#gallery-metabox-list li').index(jQuery('#gallery-metabox-list li:last')),
						  selection = file_frame.state().get('selection');

					  selection.map(function(attachment, i) {
						attachment = attachment.toJSON(),
						index      = listIndex + (i + 1);

						jQuery('#gallery-metabox-list').append('<li><input type="hidden" name="wpjobus_company_gallery[' + index + ']" value="' + attachment.id + '"><img class="image-preview" src="' + attachment.url + '"><a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br><small><a class="remove-image" href="#">Remove image</a></small></li>');
					  });
					});

					makeSortable();
					
					file_frame.open();

				  });
				   jQuery(document).on('click', '#wpjobus_company_gallery_settings a.change-image', function(e) {

					e.preventDefault();

					var that = jQuery(this);

					if (file_frame) file_frame.close();

					file_frame = wp.media.frames.file_frame = wp.media({
					  title: jQuery(this).data('uploader-title'),
					  button: {
						text: jQuery(this).data('uploader-button-text'),
					  },
					  multiple: false
					});

					file_frame.on( 'select', function() {
					  attachment = file_frame.state().get('selection').first().toJSON();

					  that.parent().find('input:hidden').attr('value', attachment.id);
					  that.parent().find('img.image-preview').attr('src', attachment.url);
					});

					file_frame.open();

				  });
				  
				   jQuery(document).on('click', '#wpjobus_company_gallery_settings a.remove-image', function(e) {
					e.preventDefault();

					jQuery(this).parents('li').animate({ opacity: 0 }, 200, function() {
					  jQuery(this).remove();
					  resetIndex();
					});
				  });

				  makeSortable();
				
			});
				
		


			
			
			</script>
			
			<style>
			#gallery-metabox-list li {
			  float: left;
			  width: 150px;
			  text-align: center;
			  margin: 10px 10px 10px 0;
			  width: auto;
				height: auto;
              overflow: hidden;
			  cursor: move;
			}
			.comp_img_out {
			   height: 120px;
			   width: 120px;
			}

			.comp_img_out img {
			   height: 100%;
			   min-width: 100px;
			}
			#gallery-metabox-list li a.change-image.button.button-small {
margin-top: 10px;
}
						
			
			
			</style>

		<?php	
		}

		function display_wpjobus_company_testimonials_settings ($post) {

			//get the post meta data
			$wpjobus_company_testimonials = get_post_meta($post->ID, 'wpjobus_company_testimonials',true);

		?>
		
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

		<div id='review_options_popup'>

			<div id="company_testimonials">

				<?php 

					for ($i = 0; $i < (count($wpjobus_company_testimonials)); $i++) {
				?>
				
				<div class="option_item" id="<?php echo $i; ?>">
					
					<span class='text'>Testimonial <?php echo ($i+1); ?></span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Full Name:</span>
						<input type='text' id='wpjobus_company_testimonials[<?php echo $i; ?>][0]' name='wpjobus_company_testimonials[<?php echo $i; ?>][0]' value='<?php if (!empty($wpjobus_company_testimonials[$i][0])) echo $wpjobus_company_testimonials[$i][0]; ?>' class='criteria_name' placeholder="">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Organizationn:</span>
						<input type='text' id='wpjobus_company_testimonials[<?php echo $i; ?>][1]' name='wpjobus_company_testimonials[<?php echo $i; ?>][1]' value='<?php if (!empty($wpjobus_company_testimonials[$i][1])) echo $wpjobus_company_testimonials[$i][1]; ?>' class='criteria_name_two' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Testimonial:</span>
						<textarea class="criteria_notes" name="wpjobus_company_testimonials[<?php echo $i; ?>][2]" id='wpjobus_company_testimonials[<?php echo $i; ?>][2]' cols="70" rows="7" ><?php if (!empty($wpjobus_company_testimonials[$i][2])) echo $wpjobus_company_testimonials[$i][2]; ?></textarea>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">
						<span class="text">Image:</span>

						<span>

						<?php if(!empty($wpjobus_company_testimonials[$i][3])) { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img<?php echo $i; ?>3" src="<?php if (!empty($wpjobus_company_testimonials[$i][3])) echo $wpjobus_company_testimonials[$i][3]; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url<?php echo $i; ?>3" type="text" size="36" name="wpjobus_company_testimonials[<?php echo $i; ?>][3]" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_testimonials[$i][3])) echo $wpjobus_company_testimonials[$i][3]; ?>" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>

			            <?php } else { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img<?php echo $i; ?>3" src="<?php if (!empty($wpjobus_company_testimonials[$i][3])) echo $wpjobus_company_testimonials[$i][3]; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url<?php echo $i; ?>3" type="text" size="36" name="wpjobus_company_testimonials[<?php echo $i; ?>][3]" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_testimonials[$i][3])) echo $wpjobus_company_testimonials[$i][3]; ?>" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px; display: none;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>

			            <?php } ?>

			            <script>
				            var image_custom_uploader;
				            var $thisItem = '';

				            jQuery(document).on('click','.criteria-image-button', function(e) {
				                e.preventDefault();

				                $thisItem = jQuery(this);

				                //If the uploader object has already been created, reopen the dialog
				                if (image_custom_uploader) {
				                    image_custom_uploader.open();
				                    return;
				                }

				                //Extend the wp.media object
				                image_custom_uploader = wp.media.frames.file_frame = wp.media({
				                    title: 'Choose Image',
				                    button: {
				                        text: 'Choose Image'
				                    },
				                    multiple: false
				                });

				                //When a file is selected, grab the URL and set it as the text field's value
				                image_custom_uploader.on('select', function() {
				                    attachment = image_custom_uploader.state().get('selection').first().toJSON();
				                    var url = '';
				                    url = attachment['url'];
				                    $thisItem.parent().find('.criteria-image-url').val(url);
				                    $thisItem.parent().find( "img.criteria-image" ).attr({
				                        src: url
				                    });
				                    $thisItem.parent().find(".criteria-image-button").css("display", "none");
				                    $thisItem.parent().find(".criteria-image-button-remove").css("display", "block");
				                });

				                //Open the uploader dialog
				                image_custom_uploader.open();
				             });

				             jQuery(document).on('click','.criteria-image-button-remove', function(e) {
				                jQuery(this).parent().find('.criteria-image-url').val('');
				                jQuery(this).parent().find( "img.criteria-image" ).attr({
				                    src: ''
				                });
				                jQuery(this).parent().find(".criteria-image-button").css("display", "block");
				                jQuery(this).css("display", "none");
				             });
						</script>

			        	</span>

			        </div>

					<button name="button_del_comp_testimonial" type="button" class="button-secondary button_del_comp_testimonial">delete</button>
					
				</div>
				
				<?php 
					}
				?>


			</div>

			<div id="template_comp_testimonials">
				
				<div class="option_item" id="999">
					<span class='text'>Testimonial 999</span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Full Name:</span>
						<input type='text' id='' name='' value='' class='criteria_name' placeholder="">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Organizationn:</span>
						<input type='text' id='' name='' value='' class='criteria_name_two' placeholder="" style="width: 400px;">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Testimonial:</span>
						<textarea class="criteria_notes" name="" id='' cols="70" rows="7" ></textarea>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">
						<span class="text">Image:</span>

						<span>

						<?php if(!empty($wpjobus_company_testimonials[$i][3])) { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="" src="" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="" type="text" size="36" name="" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="" />
			                <input class="criteria-image-button-remove button" id="" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>

			            <?php } else { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img<?php echo $i; ?>3" src="" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url<?php echo $i; ?>3" type="text" size="36" name="" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px; display: none;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>

			            <?php } ?>

			            <script>
				            var image_custom_uploader;
				            var $thisItem = '';

				            jQuery(document).on('click','.criteria-image-button', function(e) {
				                e.preventDefault();

				                $thisItem = jQuery(this);

				                //If the uploader object has already been created, reopen the dialog
				                if (image_custom_uploader) {
				                    image_custom_uploader.open();
				                    return;
				                }

				                //Extend the wp.media object
				                image_custom_uploader = wp.media.frames.file_frame = wp.media({
				                    title: 'Choose Image',
				                    button: {
				                        text: 'Choose Image'
				                    },
				                    multiple: false
				                });

				                //When a file is selected, grab the URL and set it as the text field's value
				                image_custom_uploader.on('select', function() {
				                    attachment = image_custom_uploader.state().get('selection').first().toJSON();
				                    var url = '';
				                    url = attachment['url'];
				                    $thisItem.parent().find('.criteria-image-url').val(url);
				                    $thisItem.parent().find( "img.criteria-image" ).attr({
				                        src: url
				                    });
				                    $thisItem.parent().find(".criteria-image-button").css("display", "none");
				                    $thisItem.parent().find(".criteria-image-button-remove").css("display", "block");
				                });

				                //Open the uploader dialog
				                image_custom_uploader.open();
				             });

				             jQuery(document).on('click','.criteria-image-button-remove', function(e) {
				                jQuery(this).parent().find('.criteria-image-url').val('');
				                jQuery(this).parent().find( "img.criteria-image" ).attr({
				                    src: ''
				                });
				                jQuery(this).parent().find(".criteria-image-button").css("display", "block");
				                jQuery(this).css("display", "none");
				             });
						</script>

			        	</span>

			        </div>

					<button name="button_del_comp_testimonial" type="button" class="button-secondary button_del_comp_testimonial">delete</button>
				</div>

			</div>

			<div class="option_item">
				<button type="button" name="submit_add_comp_testimonial" id='submit_add_comp_testimonial' value="add" class="button-secondary">Add new testimonial</button>
			</div>


			<br>


		</div>	<!-- end review_options_pop -->





		<?php

		}

function display_wpjobus_company_portfolio_settings ($post) {

			//get the post meta data
			$wpjobus_company_portfolio = get_post_meta($post->ID, 'wpjobus_company_portfolio',true);

		?>
		
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

		<div id='review_options_popup'>

			<div id="resume_portfolio">

				<?php 

					for ($i = 0; $i < (count($wpjobus_company_portfolio)); $i++) {
				?>
				
				<div class="option_item" id="<?php echo $i; ?>">
					
					<span class='text'>Project <?php echo ($i+1); ?></span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Name:</span>
						<input type='text' id='wpjobus_company_portfolio[<?php echo $i; ?>][0]' name='wpjobus_company_portfolio[<?php echo $i; ?>][0]' value='<?php if (!empty($wpjobus_company_portfolio[$i][0])) echo $wpjobus_company_portfolio[$i][0]; ?>' class='criteria_name' placeholder="">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Category:</span>
						<input type='text' id='wpjobus_company_portfolio[<?php echo $i; ?>][1]' name='wpjobus_company_portfolio[<?php echo $i; ?>][1]' value='<?php if (!empty($wpjobus_company_portfolio[$i][1])) echo $wpjobus_company_portfolio[$i][1]; ?>' class='criteria_name_two' placeholder="" style="width: 400px;">
						<span class="info-text" style="margin-left: 0;">You can leave it empty</span>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Note:</span>
						<textarea class="criteria_notes" name="wpjobus_company_portfolio[<?php echo $i; ?>][2]" id='wpjobus_company_portfolio[<?php echo $i; ?>][2]' cols="70" rows="7" ><?php if (!empty($wpjobus_company_portfolio[$i][2])) echo $wpjobus_company_portfolio[$i][2]; ?></textarea>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">
						<span class="text">Image:</span>

						<span>

						<?php if(!empty($wpjobus_company_portfolio[$i][3])) { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img<?php echo $i; ?>3" src="<?php if (!empty($wpjobus_company_portfolio[$i][3])) echo $wpjobus_company_portfolio[$i][3]; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url<?php echo $i; ?>3" type="text" size="36" name="wpjobus_company_portfolio[<?php echo $i; ?>][3]" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_portfolio[$i][3])) echo $wpjobus_company_portfolio[$i][3]; ?>" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>

			            <?php } else { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img<?php echo $i; ?>3" src="<?php if (!empty($wpjobus_company_portfolio[$i][3])) echo $wpjobus_company_portfolio[$i][3]; ?>" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url<?php echo $i; ?>3" type="text" size="36" name="wpjobus_company_portfolio[<?php echo $i; ?>][3]" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_company_portfolio[$i][3])) echo $wpjobus_company_portfolio[$i][3]; ?>" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px; display: none;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>

			            <?php } ?>

			            <script>
				            var image_custom_uploader;
				            var $thisItem = '';

				            jQuery(document).on('click','.criteria-image-button', function(e) {
				                e.preventDefault();

				                $thisItem = jQuery(this);

				                //If the uploader object has already been created, reopen the dialog
				                if (image_custom_uploader) {
				                    image_custom_uploader.open();
				                    return;
				                }

				                //Extend the wp.media object
				                image_custom_uploader = wp.media.frames.file_frame = wp.media({
				                    title: 'Choose Image',
				                    button: {
				                        text: 'Choose Image'
				                    },
				                    multiple: false
				                });

				                //When a file is selected, grab the URL and set it as the text field's value
				                image_custom_uploader.on('select', function() {
				                    attachment = image_custom_uploader.state().get('selection').first().toJSON();
				                    var url = '';
				                    url = attachment['url'];
				                    $thisItem.parent().find('.criteria-image-url').val(url);
				                    $thisItem.parent().find( "img.criteria-image" ).attr({
				                        src: url
				                    });
				                    $thisItem.parent().find(".criteria-image-button").css("display", "none");
				                    $thisItem.parent().find(".criteria-image-button-remove").css("display", "block");
				                });

				                //Open the uploader dialog
				                image_custom_uploader.open();
				             });

				             jQuery(document).on('click','.criteria-image-button-remove', function(e) {
				                jQuery(this).parent().find('.criteria-image-url').val('');
				                jQuery(this).parent().find( "img.criteria-image" ).attr({
				                    src: ''
				                });
				                jQuery(this).parent().find(".criteria-image-button").css("display", "block");
				                jQuery(this).css("display", "none");
				             });
						</script>

			        	</span>

			        </div>

					<button name="button_del_portfolio" type="button" class="button-secondary button_del_portfolio">delete</button>
					
				</div>
				
				<?php 
					}
				?>


			</div>

			<div id="template_portfolio">
				
				<div class="option_item" id="999">
					<span class='text'>Project 999</span>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Name:</span>
						<input type='text' id='' name='' value='' class='criteria_name' placeholder="">

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Category:</span>
						<input type='text' id='' name='' value='' class='criteria_name_two' placeholder="" style="width: 400px;">
						<span class="info-text" style="margin-left: 0;">You can leave it empty</span>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">

						<span class="text">Note:</span>
						<textarea class="criteria_notes" name="" id='' cols="70" rows="7" ></textarea>

					</div>

					<div class="full" style="margin-top: 20px; margin-bottom: 20px;">
						<span class="text">Image:</span>

						<span>

						<?php if(!empty($wpjobus_resume_testimonials[$i][3])) { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="" src="" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="" type="text" size="36" name="" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="" />
			                <input class="criteria-image-button-remove button" id="" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; display: none;" value="Upload Image" /> </br>

			            <?php } else { ?>

			                <div style="width: 90%; width: -webkit-calc(100% - 120px); width: calc(100% - 120px);  float: left;"><img class="criteria-image" id="your_image_url_img<?php echo $i; ?>3" src="" style="float: left; margin-bottom: 20px;" /> </div>
			                <input class="criteria-image-url" id="your_image_url<?php echo $i; ?>3" type="text" size="36" name="" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="" />
			                <input class="criteria-image-button-remove button" id="your_image_url_button_remove<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px; margin-left: 112px; display: none;" value="Remove" /> </br>
			                <input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>3" type="button" style="max-width: 140px; float: left; margin-top: 10px;" value="Upload Image" /> </br>

			            <?php } ?>

			            <script>
				            var image_custom_uploader;
				            var $thisItem = '';

				            jQuery(document).on('click','.criteria-image-button', function(e) {
				                e.preventDefault();

				                $thisItem = jQuery(this);

				                //If the uploader object has already been created, reopen the dialog
				                if (image_custom_uploader) {
				                    image_custom_uploader.open();
				                    return;
				                }

				                //Extend the wp.media object
				                image_custom_uploader = wp.media.frames.file_frame = wp.media({
				                    title: 'Choose Image',
				                    button: {
				                        text: 'Choose Image'
				                    },
				                    multiple: false
				                });

				                //When a file is selected, grab the URL and set it as the text field's value
				                image_custom_uploader.on('select', function() {
				                    attachment = image_custom_uploader.state().get('selection').first().toJSON();
				                    var url = '';
				                    url = attachment['url'];
				                    $thisItem.parent().find('.criteria-image-url').val(url);
				                    $thisItem.parent().find( "img.criteria-image" ).attr({
				                        src: url
				                    });
				                    $thisItem.parent().find(".criteria-image-button").css("display", "none");
				                    $thisItem.parent().find(".criteria-image-button-remove").css("display", "block");
				                });

				                //Open the uploader dialog
				                image_custom_uploader.open();
				             });

				             jQuery(document).on('click','.criteria-image-button-remove', function(e) {
				                jQuery(this).parent().find('.criteria-image-url').val('');
				                jQuery(this).parent().find( "img.criteria-image" ).attr({
				                    src: ''
				                });
				                jQuery(this).parent().find(".criteria-image-button").css("display", "block");
				                jQuery(this).css("display", "none");
				             });
						</script>

			        	</span>

			        </div>

					<button name="button_del_portfolio" type="button" class="button-secondary button_del_portfolio">delete</button>
				</div>

			</div>

			<div class="option_item">
				<button type="button" name="submit_add_portfolio" id='submit_add_portfolio1' value="add" class="button-secondary">Add new project</button>
			</div>

			

			<br>


		</div>	<!-- end review_options_pop -->





		

		<?php

		}

		function display_wpjobus_company_contact_settings ($post) {

			//get the post meta data
			$wpjobus_company_address = get_post_meta($post->ID, 'wpjobus_company_address',true);
			$wpjobus_company_phone = get_post_meta($post->ID, 'wpjobus_company_phone',true);
			$wpjobus_company_website = get_post_meta($post->ID, 'wpjobus_company_website',true);
			$wpjobus_company_email = get_post_meta($post->ID, 'wpjobus_company_email',true);
			$wpjobus_company_publish_email = get_post_meta($post->ID, 'wpjobus_company_publish_email',true);
			$wpjobus_company_facebook = get_post_meta($post->ID, 'wpjobus_company_facebook',true);
			$wpjobus_company_linkedin = get_post_meta($post->ID, 'wpjobus_company_linkedin',true);
			$wpjobus_company_twitter = get_post_meta($post->ID, 'wpjobus_company_twitter',true);
			$wpjobus_company_googleplus = get_post_meta($post->ID, 'wpjobus_company_googleplus',true);

			$wpjobus_company_googleaddress = get_post_meta($post->ID, 'wpjobus_company_googleaddress',true);
			$wpjobus_company_longitude = get_post_meta($post->ID, 'wpjobus_company_longitude',true);
			$wpjobus_company_latitude = get_post_meta($post->ID, 'wpjobus_company_latitude',true);
			$wpjobus_company_calendar_shortcode = get_post_meta($post->ID, 'wpjobus_company_calendar_shortcode',true);


		?>
		
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

		<div id='review_options_popup'>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Address:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_address' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_address; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Phone number:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_phone' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_phone; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Website:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_website' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_website; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>E-mail:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_email' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_email; ?>' placeholder="" />

				<span style="margin-right: 20px; float: left;">
					<input type="checkbox" class='' name='wpjobus_company_publish_email' style="width: 10px; margin-right: 5px; float: left; margin-top: 1px;" value='publish_email' placeholder="" <?php if (!empty($wpjobus_company_publish_email)) { ?>checked<?php } ?>/>Publish my email address
				</span>
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Facebook:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_facebook' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_facebook; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>LinkedIn:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_linkedin' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_linkedin; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Twitter:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_twitter' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_twitter; ?>' placeholder="" />
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Google+:</span>

				<input type='text' id="review-name" class='' name='wpjobus_company_googleplus' style="width: 300px; float: left;" value='<?php echo $wpjobus_company_googleplus; ?>' placeholder="" />
				
			</div>



			<div id="map-container">

			<div class="option_item" style="height: 24px; margin-bottom: 20px;">
				
				<span class='text overall' style="width: 170px;">Google Map Address</span>

				<input id="address" name="wpjobus_company_googleaddress" type="text" value="<?php echo $wpjobus_company_googleaddress; ?>" style="width: 300px; float: left;">

				<p class="help-block"><?php _e('Start typing an address and select from the dropdown.', 'themesdojo') ?></p>
				
			</div>

				
				<div id="map-canvas"></div>

				<style>

					#map-canvas {
						display: block;
						width: 575px;
						height: 370px;
						position: relative;
						margin-bottom: 10px;
					}

				</style>

				<script type="text/javascript">

								jQuery(document).ready(function($) {

									var geocoder;
									var map;
									var marker;

									var geocoder = new google.maps.Geocoder();

									function geocodePosition(pos) {
									  geocoder.geocode({
									    latLng: pos
									  }, function(responses) {
									    if (responses && responses.length > 0) {
									      updateMarkerAddress(responses[0].formatted_address);
									    } else {
									      updateMarkerAddress('Cannot determine address at this location.');
									    }
									  });
									}

									function updateMarkerPosition(latLng) {
									  jQuery('#latitude').val(latLng.lat());
									  jQuery('#longitude').val(latLng.lng());
									}

									function updateMarkerAddress(str) {
									  jQuery('#address').val(str);
									}

									function initialize() {

									  var latlng = new google.maps.LatLng(<?php echo $wpjobus_company_latitude; ?>, <?php echo $wpjobus_company_longitude; ?>);
									  var mapOptions = {
									    zoom: 16,
									    center: latlng
									  }

									  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

									  geocoder = new google.maps.Geocoder();

									  marker = new google.maps.Marker({
									  	position: latlng,
									    map: map,
									    draggable: true
									  });

									  // Add dragging event listeners.
									  google.maps.event.addListener(marker, 'dragstart', function() {
									    updateMarkerAddress('Dragging...');
									  });
									  
									  google.maps.event.addListener(marker, 'drag', function() {
									    updateMarkerPosition(marker.getPosition());
									  });
									  
									  google.maps.event.addListener(marker, 'dragend', function() {
									    geocodePosition(marker.getPosition());
									  });

									}

									google.maps.event.addDomListener(window, 'load', initialize);

									jQuery(document).ready(function() { 
									         
									  initialize();
									          
									  jQuery(function() {
									    jQuery("#address").autocomplete({
									      //This bit uses the geocoder to fetch address values
									      source: function(request, response) {
									        geocoder.geocode( {'address': request.term }, function(results, status) {
									          response(jQuery.map(results, function(item) {
									            return {
									              label:  item.formatted_address,
									              value: item.formatted_address,
									              latitude: item.geometry.location.lat(),
									              longitude: item.geometry.location.lng()
									            }
									          }));
									        })
									      },
									      //This bit is executed upon selection of an address
									      select: function(event, ui) {
									        jQuery("#latitude").val(ui.item.latitude);
									        jQuery("#longitude").val(ui.item.longitude);

									        var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);

									        marker.setPosition(location);
									        map.setZoom(16);
									        map.setCenter(location);

									      }
									    });
									  });
									  
									  //Add listener to marker for reverse geocoding
									  google.maps.event.addListener(marker, 'drag', function() {
									    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
									      if (status == google.maps.GeocoderStatus.OK) {
									        if (results[0]) {
									          jQuery('#address').val(results[0].formatted_address);
									          jQuery('#latitude').val(marker.getPosition().lat());
									          jQuery('#longitude').val(marker.getPosition().lng());
									        }
									      }
									    });
									  });
									  
									});

								});

				</script>

			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Latitude</span>

				<input type="text" id="latitude" name="wpjobus_company_latitude" value="<?php echo $wpjobus_company_latitude; ?>" size="12" maxlength="10" class="form-text required">
				
			</div>

			<div class="option_item" style="height: 24px;">
				
				<span class='text overall'>Longitude</span>

				<input type="text" id="longitude" name="wpjobus_company_longitude" value="<?php echo $wpjobus_company_longitude; ?>" size="12" maxlength="10" class="form-text required">
				
			</div>

			<div class="full" style="height: 24px;">
				
				<span class='text'>Booking Calendar Shortcode</span>
				
				<input type="text" id="calendar_shortcode" name="wpjobus_company_calendar_shortcode" value='<?php echo $wpjobus_company_calendar_shortcode; ?>' size="100" maxlength="100" class="criteria_name">
				
			</div>

			<br>


		</div>	<!-- end review_options_pop -->



		<?php


		}


	
		add_action ('save_post', 'update_wpjobus_company_settings');
		function update_wpjobus_company_settings ( $td_post_id ) {
		// verify nonce.  

		if (!isset($_POST['cmb_nonce'])) {
			return false;		
		}

		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__))) {
			return false;
		}

		global $td_allowed;

		//regular update		
		update_post_meta($td_post_id, 'wpjobus_company_fullname', wp_kses($_POST['wpjobus_company_fullname'], $td_allowed));
		update_post_meta($td_post_id, 'wpjobus_post_title', wp_kses($_POST['wpjobus_company_fullname'], $td_allowed));
		update_post_meta($td_post_id, 'wpjobus_company_tagline', wp_kses($_POST['wpjobus_company_tagline'], $td_allowed));
		update_post_meta($td_post_id, 'wpjobus_company_foundyear', wp_kses($_POST['wpjobus_company_foundyear'], $td_allowed));
		update_post_meta($td_post_id, 'company_team_size', wp_kses($_POST['company_team_size'], $td_allowed));
		update_post_meta($td_post_id, 'company_industry', wp_kses($_POST['company_industry'], $td_allowed));
		update_post_meta($td_post_id, 'company_location', wp_kses($_POST['company_location'], $td_allowed));
		update_post_meta($td_post_id, 'company-about-me', htmlentities(stripslashes($_REQUEST['company-about-me'])));
		update_post_meta($td_post_id, 'wpjobus_company_profile_picture', wp_kses($_POST['wpjobus_company_profile_picture'], $td_allowed));
		update_post_meta($td_post_id, 'wpjobus_company_cover_image', wp_kses($_POST['wpjobus_company_cover_image'], $td_allowed));

		update_post_meta($td_post_id, 'wpjobus_company_services', $_POST['wpjobus_company_services']);

		update_post_meta($td_post_id, 'wpjobus_company_expertise', wp_kses($_POST['wpjobus_company_expertise'], $td_allowed));

		update_post_meta($td_post_id, 'wpjobus_company_clients', $_POST['wpjobus_company_clients']);

		update_post_meta($td_post_id, 'wpjobus_company_testimonials', $_POST['wpjobus_company_testimonials']);

		update_post_meta($td_post_id, 'wpjobus_company_portfolio', $_POST['wpjobus_company_portfolio']);

		update_post_meta($td_post_id, 'wpjobus_company_address', $_POST['wpjobus_company_address']);
		update_post_meta($td_post_id, 'wpjobus_company_phone', $_POST['wpjobus_company_phone']);
		update_post_meta($td_post_id, 'wpjobus_company_website', $_POST['wpjobus_company_website']);
		update_post_meta($td_post_id, 'wpjobus_company_email', $_POST['wpjobus_company_email']);
		update_post_meta($td_post_id, 'wpjobus_company_facebook', $_POST['wpjobus_company_facebook']);
		update_post_meta($td_post_id, 'wpjobus_company_linkedin', $_POST['wpjobus_company_linkedin']);
		update_post_meta($td_post_id, 'wpjobus_company_twitter', $_POST['wpjobus_company_twitter']);
		update_post_meta($td_post_id, 'wpjobus_company_googleplus', $_POST['wpjobus_company_googleplus']);
		update_post_meta($td_post_id, 'wpjobus_company_googleaddress', $_POST['wpjobus_company_googleaddress']);
		update_post_meta($td_post_id, 'wpjobus_company_longitude', $_POST['wpjobus_company_longitude']);
		update_post_meta($td_post_id, 'wpjobus_company_latitude', $_POST['wpjobus_company_latitude']);
		update_post_meta($td_post_id, 'wpjobus_company_calendar_shortcode', $_POST['wpjobus_company_calendar_shortcode']);
		
		//updating gallery
		
		update_post_meta($td_post_id, 'wpjobus_company_gallery', $_POST['wpjobus_company_gallery']);  

		if($_POST['wpjobus_company_calendar_shortcode'] != ""){

			$wpjobus_resume_booking_calendar_val = stripslashes($_POST['wpjobus_company_calendar_shortcode']);
			$new_booking_val = preg_match("/id=\"(.*?)\"/", $wpjobus_resume_booking_calendar_val, $matches_val);

			
			if(!empty($matches_val)){
				$match_get_val = $matches_val['1'];
				update_post_meta($td_post_id, 'wpjobus_company_calendar_shortcode_id',$match_get_val);

			
			}	
			
		}

		

		update_post_meta($td_post_id, 'wpjobus_company_publish_email', $_POST['wpjobus_company_publish_email']);

	}
