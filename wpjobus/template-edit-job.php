<?php
/**
 * Template name: Edit Job
 */

if ( !is_user_logged_in() ) { 

	$login = home_url('/')."login";
	wp_redirect( $login ); exit;

} 

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

global $current_user, $td_user_id, $td_user_info;
get_currentuserinfo();
$td_user_id = $current_user->ID; // You can set $td_user_id to any users, but this gets the current users ID.
$td_user_info = get_userdata($td_user_id);

$user_error = 0;

$query = new WP_Query(array('post_type' => 'job', 'posts_per_page' =>'-1', 'post_status' => 'publish, draft, pending') );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
	
if(isset($_GET['post'])) {
		
	if($_GET['post'] == $post->ID) {

		$td_current_post = $post->ID;

		$postID = $_GET['post'];

		$post_author_id = get_post_field( 'post_author', $postID );

		if($post_author_id == $td_user_id)  { 

			$wpjobus_job_cover_image = esc_url(get_post_meta($post->ID, 'wpjobus_job_cover_image',true));
			$wpjobus_job_fullname = esc_attr(get_post_meta($post->ID, 'wpjobus_job_fullname',true));
			$td_job_company = esc_attr(get_post_meta($post->ID, 'job_company',true));
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

			$wpjobus_job_hobbies = esc_attr(get_post_meta($post->ID, 'wpjobus_job_hobbies',true));

			$wpjobus_job_address = esc_attr(get_post_meta($post->ID, 'wpjobus_job_address',true));
			$wpjobus_job_phone = esc_attr(get_post_meta($post->ID, 'wpjobus_job_phone',true));
			$wpjobus_job_website = esc_url(get_post_meta($post->ID, 'wpjobus_job_website',true));
			$wpjobus_job_email = esc_attr(get_post_meta($post->ID, 'wpjobus_job_email',true));
			$wpjobus_job_publish_email = esc_attr(get_post_meta($post->ID, 'wpjobus_job_publish_email',true));
			$wpjobus_job_facebook = esc_url(get_post_meta($post->ID, 'wpjobus_job_facebook',true));
			$wpjobus_job_linkedin = esc_url(get_post_meta($post->ID, 'wpjobus_job_linkedin',true));
			$wpjobus_job_twitter = esc_url(get_post_meta($post->ID, 'wpjobus_job_twitter',true));
			$wpjobus_job_googleplus = esc_url(get_post_meta($post->ID, 'wpjobus_job_googleplus',true));

			$wpjobus_job_googleaddress = esc_attr(get_post_meta($post->ID, 'wpjobus_job_googleaddress',true));

			$wpjobus_job_longitude = esc_attr(get_post_meta($post->ID, 'wpjobus_job_longitude',true));
			if(empty($wpjobus_job_longitude)) {
				$wpjobus_job_longitude = 0;
			}

			$wpjobus_job_latitude = esc_attr(get_post_meta($post->ID, 'wpjobus_job_latitude',true));
			if(empty($wpjobus_job_latitude)) {
				$wpjobus_job_latitude = 0;
			}

		} else {

			$user_error = 1;

		}

	}

}

endwhile; endif;
wp_reset_query();

global $td_current_post;

get_header(); ?>

	<section id="blog">

		<div class="container">

			<div class="resume-skills">

				<?php if($user_error == 1) { ?>

				<h2><?php _e( 'We are sorry but this isn\'t your job offer.', 'themesdojo' ); ?></h2>

				<?php } else { ?>

				<form id="wpjobus-add-resume" type="post" action="" >

					<input type="hidden" id="postID" name="postID" value="<?php echo $td_current_post; ?>">

					<h1 class="resume-section-title"><i class="fa fa-file-text-o"></i><?php _e( 'Edit Job Offer', 'themesdojo' ); ?></h1>
					<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'Hey. It’s easier than it looks. Take a deep breath and complete the fields below. You’ll have a beautiful job offer!', 'themesdojo' ); ?></h3>

					<div class="divider"></div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_half first">

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Job Title:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type="text" name="fullName" id="fullName" value="<?php echo $wpjobus_job_fullname; ?>" class="input-textarea" placeholder="" style="margin-bottom: 0;"/>
									<label for="fullName" class="error userNameError"></label>
								</span>

							</span>

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Career Level:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<select name="job_career_level" id="job_career_level" style="width: 100%;">
										<?php 
											global $redux_demo; 
											for ($i = 0; $i < count($redux_demo['resume_career_level']); $i++) {
										?>
										<option value='<?php echo $redux_demo['resume_career_level'][$i]; ?>' <?php selected( $td_job_career_level, $redux_demo["resume_career_level"][$i] ); ?>><?php echo $redux_demo['resume_career_level'][$i]; ?></option>

										<?php 
											}
										?>
									</select>
								</span>

							</span>

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Presence:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">

									<select name="job_presence_type" id="job_presence_type" style="width: 100%;">
										<?php 
											global $redux_demo; 
											for ($i = 0; $i < count($redux_demo['job_presence_type']); $i++) {
										?>
										<option value='<?php echo $redux_demo['job_presence_type'][$i]; ?>' <?php selected( $td_job_presence_type, $redux_demo["job_presence_type"][$i] ); ?>><?php echo $redux_demo['job_presence_type'][$i]; ?></option>

										<?php 
											}
										?>
									</select>

								</span>

							</span>

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Years of experience:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<select name="job_years_of_exp" id="job_years_of_exp" style="width: 100%;">
										<?php 
											for ($i = 1; $i <= 20; $i++) {
										?>
										<option value='<?php echo $i; ?>' <?php selected( $td_job_years_of_exp, $i ); ?>><?php echo $i; ?></option>
										<?php 
											}
										?>
									</select>
								</span>

							</span>

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Industry:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<select name="job_industry" id="job_industry" style="width: 100%; margin-right: 10px;">
										<?php 
											global $redux_demo; 
											for ($i = 0; $i < count($redux_demo['resume-industries']); $i++) {
										?>
										<option value='<?php echo $redux_demo['resume-industries'][$i]; ?>' <?php selected( $td_job_industry, $redux_demo["resume-industries"][$i] ); ?>><?php echo $redux_demo['resume-industries'][$i]; ?></option>
										<?php 
											}
										?>
									</select>
								</span>

							</span>

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Location:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<select name="job_location" id="job_location" style="width: 100%; margin-right: 10px;">
										<?php 
											global $redux_demo; 
											for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
										?>
										<option value='<?php echo $redux_demo['resume-locations'][$i]; ?>' <?php selected( $td_job_location, $redux_demo["resume-locations"][$i] ); ?>><?php echo $redux_demo['resume-locations'][$i]; ?></option>
										<?php 
											}
										?>
									</select>
								</span>

							</span>

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Company:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<select name="job_company" id="job_company" style="width: 100%;">
										<?php 

											$td_user_id = $current_user->ID;

											$companies = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE post_type = 'company' and post_status = 'publish' and post_author = '".$td_user_id."' ");
							  
											foreach($companies as $company) { 

												$comp_id = $company->ID;

												$wpjobus_company_fullname = esc_attr(get_post_meta($comp_id, 'wpjobus_company_fullname',true)); 
										?>
											
											<option value='<?php echo $comp_id; ?>' <?php selected( $td_job_company, $comp_id ); ?>><?php echo $wpjobus_company_fullname; ?></option>

										<?php } ?>
									</select>
								</span>

							</span>

						</div>

						<div class="one_half">

							<span class="full" style="margin-bottom: 0;">

								<span class="one_half first" style="margin-bottom: 0;">
									<h3><?php _e( 'Job Description:', 'themesdojo' ); ?></h3>
								</span>

							</span>

							<?php 
									
								$settings = array(
										'wpautop' => true,
										'postContent' => 'content',
										'media_buttons' => false,
										'editor_css' => '<style>.mceToolba { background-color: #faf9f4; padding: 5px; }</style>',
										'tinymce' => array(
											'theme_advanced_buttons1' => 'bold,italic,underline,blockquote,separator,strikethrough,bullist,numlist,justifyleft,justifycenter,justifyright,undo,redo,link,unlink,fullscreen',
											'theme_advanced_buttons2' => 'pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo',
											'theme_advanced_buttons3' => '',
											'theme_advanced_buttons4' => ''
										),
										'quicktags' => false
								);
											
								wp_editor( $job_about_me, 'postContent', $settings );

							?>

						</div>

					</div>

					<div class="full">

						<div class="one_half first">

							<span class="full" style="margin-bottom: 0;">

								<span class="full" style="margin-bottom: 0;">
									<h3><i class="fa fa-picture-o"></i><?php _e( 'Cover Image:', 'themesdojo' ); ?></h3>
								</span>

								<div style="width: 100%; float: left;">
									<img class="criteria-image" id="your_cover_url_img" src="<?php if (!empty($wpjobus_job_cover_image)) echo $wpjobus_job_cover_image; ?>" style="float: left; width: auto; margin-bottom: 20px; margin-top: 10px; max-height: 340px;" /> 
								</div>
					            <input class="criteria-image-url" id="your_icover_url" type="text" size="36" name="wpjobus_job_cover_image" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_job_cover_image)) echo $wpjobus_job_cover_image; ?>" />
					            <input class="criteria-image-id" id="your_cover_id" type="text" size="36" name="wpjobus_job_cover_image_id" style="max-width: 200px; float: left; margin-top: 10px; display: none;" value="<?php if (!empty($wpjobus_job_cover_image_id)) echo $wpjobus_job_cover_image_id; ?>" />
					            <i class="fa fa-trash-o"></i><input class="criteria-image-button-remove button" id="your_image_url_button_remove<?php echo $i; ?>2" type="button" value="Delete Image" /> </br>
					            <i class="fa fa-cloud-upload"></i><input class="criteria-image-button button" id="your_image_url_button<?php echo $i; ?>2" type="button" value="Upload Image" />

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
									        var attachId = '';
									        attachId = attachment['id'];
									        $thisItem.parent().find('.criteria-image-id').val(attachId);
									        $thisItem.parent().find('.criteria-image-url').val(url);
									        $thisItem.parent().find( "img.criteria-image" ).attr({
									            src: url
									        });
									        $thisItem.parent().find(".criteria-image-button").css("display", "none");
									        $thisItem.parent().find(".fa-cloud-upload").css("display", "none");
									        $thisItem.parent().find(".criteria-image-button-remove").css("display", "block");
									        $thisItem.parent().find(".fa-trash-o").css("display", "block");
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
									    jQuery(this).parent().find(".fa-cloud-upload").css("display", "block");
									    jQuery(this).css("display", "none");
									    jQuery(this).parent().find(".fa-trash-o").css("display", "none");
									});
								</script>

							</span>

						</div>

						<div class="divider"></div>

					</div>

					<h1 class="resume-section-title"><i class="fa fa-bar-chart-o"></i><?php _e( 'Required Skills', 'themesdojo' ); ?></h1>
					<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'Describe the required skills and expertise for this job.', 'themesdojo' ); ?></h3>

					<div class="divider"></div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_half first">

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3 style="color: #2dcc70;"><?php _e( 'Communication level:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="review-name" class='' name='wpjobus_job_comm_level' style="width: 100%; float: left; margin-bottom: 0;" value='<?php echo $wpjobus_job_comm_level ; ?>' placeholder="70%" />
									<span class="info-text" style="margin-left: 0;"><?php _e( '%(1 to 100 value)', 'themesdojo' ); ?></span>
								</span>

							</span>

						</div>

						<div class="one_half">

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Notes:', 'themesdojo' ); ?></h3>
								</span>

							</span>

							<span class="full" >

								<?php 
									
									$settings = array(
											'wpautop' => true,
											'skillsNotes' => 'content',
											'media_buttons' => false,
											'editor_css' => '<style>.mceToolba { background-color: #faf9f4; padding: 5px; }</style>',
											'tinymce' => array(
												'theme_advanced_buttons1' => 'bold,italic,underline,blockquote,separator,strikethrough,bullist,numlist,justifyleft,justifycenter,justifyright,undo,redo,link,unlink,fullscreen',
												'theme_advanced_buttons2' => 'pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo',
												'theme_advanced_buttons3' => '',
												'theme_advanced_buttons4' => ''
											),
											'quicktags' => false
									);
												
									wp_editor( $wpjobus_job_comm_note, 'skillsNotes', $settings );

								?>

							</span>

						</div>

					</div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_half first">

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3 style="color: #e84c3d;"><?php _e( 'Organizational level:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="review-name" class='' name='wpjobus_job_org_level' style="width: 100%; float: left; margin-bottom: 0;" value='<?php echo $wpjobus_job_org_level; ?>' placeholder="70%" />
									<span class="info-text" style="margin-left: 0;"><?php _e( '%(1 to 100 value)', 'themesdojo' ); ?></span>
								</span>

							</span>

						</div>

						<div class="one_half">

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Notes:', 'themesdojo' ); ?></h3>
								</span>

							</span>

							<span class="full" >

								<?php 
									
									$settings = array(
											'wpautop' => true,
											'orgNotes' => 'content',
											'media_buttons' => false,
											'editor_css' => '<style>.mceToolba { background-color: #faf9f4; padding: 5px; }</style>',
											'tinymce' => array(
												'theme_advanced_buttons1' => 'bold,italic,underline,blockquote,separator,strikethrough,bullist,numlist,justifyleft,justifycenter,justifyright,undo,redo,link,unlink,fullscreen',
												'theme_advanced_buttons2' => 'pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo',
												'theme_advanced_buttons3' => '',
												'theme_advanced_buttons4' => ''
											),
											'quicktags' => false
									);
												
									wp_editor( $wpjobus_job_org_note, 'orgNotes', $settings );

								?>

							</span>

						</div>

					</div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_half first">

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3 style="color: #34495e;"><?php _e( 'Job Related level:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="review-name" class='' name='wpjobus_job_job_rel_level' style="width: 100%; float: left; margin-bottom: 0;" value='<?php echo $wpjobus_job_job_rel_level; ?>' placeholder="70%" />
									<span class="info-text" style="margin-left: 0;"><?php _e( '%(1 to 100 value)', 'themesdojo' ); ?></span>
								</span>

							</span>

						</div>

						<div class="one_half">

							<span class="full" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Notes:', 'themesdojo' ); ?></h3>
								</span>

							</span>

							<span class="full" >

								<?php 
									
									$settings = array(
											'wpautop' => true,
											'jobNotes' => 'content',
											'media_buttons' => false,
											'editor_css' => '<style>.mceToolba { background-color: #faf9f4; padding: 5px; }</style>',
											'tinymce' => array(
												'theme_advanced_buttons1' => 'bold,italic,underline,blockquote,separator,strikethrough,bullist,numlist,justifyleft,justifycenter,justifyright,undo,redo,link,unlink,fullscreen',
												'theme_advanced_buttons2' => 'pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo',
												'theme_advanced_buttons3' => '',
												'theme_advanced_buttons4' => ''
											),
											'quicktags' => false
									);
												
									wp_editor( $wpjobus_job_job_rel_note, 'jobNotes', $settings );

								?>

							</span>

						</div>

						<div class="divider"></div>

					</div>

					<div class="full" style="margin-bottom: 0;">

						<div id="review_job_criteria">
							<?php 

								if(!empty($wpjobus_job_skills)) {

								for ($i = 0; $i < (count($wpjobus_job_skills)); $i++) {

							?>
							
							<div class="full option_item" id="<?php echo $i; ?>">

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Skill', 'themesdojo' ); ?> <span><?php echo ($i+1); ?></span></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<input type='text' id='wpjobus_job_skills[<?php echo $i; ?>][0]' name='wpjobus_job_skills[<?php echo $i; ?>][0]' value='<?php if (!empty($wpjobus_job_skills[$i][0])) echo $wpjobus_job_skills[$i][0]; ?>' class='criteria_name' placeholder="Title">
									</span>

								</span>

								<span class="one_half"  style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3><?php _e( 'Value:', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<input type='text' id='wpjobus_job_skills[<?php echo $i; ?>][1]' name='wpjobus_job_skills[<?php echo $i; ?>][1]' value='<?php if (!empty($wpjobus_job_skills[$i][1])) {echo $wpjobus_job_skills[$i][1];} ?>' class='slider_value' placeholder="70%">
									</span>

								</span>

								<button name="button_del_criteria" type="button" class="button-secondary button_del_job_criteria" style="margin-top: 10px;"><i class="fa fa-trash-o"></i><?php _e( 'Delete Skill', 'themesdojo' ); ?></button>
								
							</div>
							
							<?php 
								} }
							?>


						</div>

						<div id="template_job_criterion">
							
							<div class="option_item full" id="999">

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Skill', 'themesdojo' ); ?> <span>999</span></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<input type='text' id='' name='' value='' class='criteria_name' placeholder="Title">
									</span>

								</span>

								<span class="one_half" style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3><?php _e( 'Value:', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<input type='text' id='' name='' value='' class='slider_value' placeholder="70%">
									</span>

								</span>
								
								<button name="button_del_criteria" type="button" class="button-secondary button_del_job_criteria" style="margin-top: 10px;"><i class="fa fa-trash-o"></i><?php _e( 'Delete Skill', 'themesdojo' ); ?></button>
							</div>

						</div>

						<div class="option_item">
							<button type="button" name="submit_add_criteria" id='submit_add_job_criteria' value="add" class="button-secondary"><i class="fa fa-plus-circle"></i><?php _e( 'Add new skill', 'themesdojo' ); ?></button>
						</div>

						<div class="divider"></div>

					</div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_half first" style="margin-bottom: 20px;">

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Native Language', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="review-name" class='' name='wpjobus_job_native_language' style="width: 100%; float: left; margin-bottom: 0;" value='<?php echo $wpjobus_job_native_language; ?>' placeholder="" />
								</span>

							</span>

						</div>

						<div class="divider"style="margin-top: 0px;"></div>

					</div>

					<div class="full" style="margin-bottom: 0;">

						<div id="job_languages">
							<?php 

								if(!empty($wpjobus_job_languages)) {

								for ($i = 0; $i < (count($wpjobus_job_languages)); $i++) {

							?>
							
							<div class="full option_item" id="<?php echo $i; ?>">
								
								<div class='full'  style="margin-bottom: 0;">
									<span class="one_half first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Language', 'themesdojo' ); ?> <span><?php echo ($i+1); ?></span></h3>
									</span>
								</div>

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Name', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<input type='text' id="wpjobus_job_languages[<?php echo $i; ?>][0]" class="resume_lang_title" name='wpjobus_job_languages[<?php echo $i; ?>][0]' style="width: 100%; float: left;" value='<?php if (!empty($wpjobus_job_languages[$i][0])) echo $wpjobus_job_languages[$i][0]; ?>' placeholder="" />
									</span>

								</span>

								<span class="one_half" style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3><?php _e( 'Understanding', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<select class="resume_lang_understanding" name="wpjobus_job_languages[<?php echo $i; ?>][1]" id="wpjobus_job_languages[<?php echo $i; ?>][1]" style="width: 100%; margin-right: 10px;">
											<option value='Level 1' <?php if(!empty($wpjobus_job_languages[$i][1])) { selected( $wpjobus_job_languages[$i][1], "Level 1" ); } ?>><?php _e( 'Level 1', 'themesdojo' ); ?></option>
											<option value='Level 2' <?php if(!empty($wpjobus_job_languages[$i][1])) { selected( $wpjobus_job_languages[$i][1], "Level 2" ); } ?>><?php _e( 'Level 2', 'themesdojo' ); ?></option>
											<option value='Level 3' <?php if(!empty($wpjobus_job_languages[$i][1])) { selected( $wpjobus_job_languages[$i][1], "Level 3" ); } ?>><?php _e( 'Level 3', 'themesdojo' ); ?></option>
											<option value='Level 4' <?php if(!empty($wpjobus_job_languages[$i][1])) { selected( $wpjobus_job_languages[$i][1], "Level 4" ); } ?>><?php _e( 'Level 4', 'themesdojo' ); ?></option>
											<option value='Level 5' <?php if(!empty($wpjobus_job_languages[$i][1])) { selected( $wpjobus_job_languages[$i][1], "Level 5" ); } ?>><?php _e( 'Level 5', 'themesdojo' ); ?></option>
										</select>
									</span>

								</span>

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Speaking', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<select class="resume_lang_speaking" name="wpjobus_job_languages[<?php echo $i; ?>][2]" id="wpjobus_job_languages[<?php echo $i; ?>][2]" style="width: 100%; margin-right: 10px;">
											<option value='Level 1' <?php if(!empty($wpjobus_job_languages[$i][2])) { selected( $wpjobus_job_languages[$i][2], "Level 1" ); } ?>><?php _e( 'Level 1', 'themesdojo' ); ?></option>
											<option value='Level 2' <?php if(!empty($wpjobus_job_languages[$i][2])) { selected( $wpjobus_job_languages[$i][2], "Level 2" ); } ?>><?php _e( 'Level 2', 'themesdojo' ); ?></option>
											<option value='Level 3' <?php if(!empty($wpjobus_job_languages[$i][2])) { selected( $wpjobus_job_languages[$i][2], "Level 3" ); } ?>><?php _e( 'Level 3', 'themesdojo' ); ?></option>
											<option value='Level 4' <?php if(!empty($wpjobus_job_languages[$i][2])) { selected( $wpjobus_job_languages[$i][2], "Level 4" ); } ?>><?php _e( 'Level 4', 'themesdojo' ); ?></option>
											<option value='Level 5' <?php if(!empty($wpjobus_job_languages[$i][2])) { selected( $wpjobus_job_languages[$i][2], "Level 5" ); } ?>><?php _e( 'Level 5', 'themesdojo' ); ?></option>
										</select>
									</span>

								</span>

								<span class="one_half" style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3><?php _e( 'Writing', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<select class="resume_lang_writing" name="wpjobus_job_languages[<?php echo $i; ?>][3]" id="wpjobus_job_languages[<?php echo $i; ?>][3]" style="width: 100%; margin-right: 10px;">
											<option value='Level 1' <?php if(!empty($wpjobus_job_languages[$i][3])) { selected( $wpjobus_job_languages[$i][3], "Level 1" ); } ?>><?php _e( 'Level 1', 'themesdojo' ); ?></option>
											<option value='Level 2' <?php if(!empty($wpjobus_job_languages[$i][3])) { selected( $wpjobus_job_languages[$i][3], "Level 2" ); } ?>><?php _e( 'Level 2', 'themesdojo' ); ?></option>
											<option value='Level 3' <?php if(!empty($wpjobus_job_languages[$i][3])) { selected( $wpjobus_job_languages[$i][3], "Level 3" ); } ?>><?php _e( 'Level 3', 'themesdojo' ); ?></option>
											<option value='Level 4' <?php if(!empty($wpjobus_job_languages[$i][3])) { selected( $wpjobus_job_languages[$i][3], "Level 4" ); } ?>><?php _e( 'Level 4', 'themesdojo' ); ?></option>
											<option value='Level 5' <?php if(!empty($wpjobus_job_languages[$i][3])) { selected( $wpjobus_job_languages[$i][3], "Level 5" ); } ?>><?php _e( 'Level 5', 'themesdojo' ); ?></option>
										</select>
									</span>

								</span>

								<button name="button_del_language" type="button" class="button-secondary button_del_job_language" style="margin-right: 10px;"><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></button>
								
							</div>
							
							<?php 
								} }
							?>


						</div>

						<div id="template_job_language">
							
							<div class="full option_item" id="999">
								
								<div class='full'  style="margin-bottom: 0;">
									<span class="one_half first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Language', 'themesdojo' ); ?> <span>999</span></h3>
									</span>
								</div>

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Name', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<input type='text' id="" class="resume_lang_title" name='' style="width: 100%; float: left;" value='' placeholder="" />
									</span>

								</span>

								<span class="one_half" style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3><?php _e( 'Understanding', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<select class="resume_lang_understanding" name="" id="" style="width: 100%; margin-right: 10px;">
											<option value='Level 1'><?php _e( 'Level 1', 'themesdojo' ); ?></option>
											<option value='Level 2'><?php _e( 'Level 2', 'themesdojo' ); ?></option>
											<option value='Level 3'><?php _e( 'Level 3', 'themesdojo' ); ?></option>
											<option value='Level 4'><?php _e( 'Level 4', 'themesdojo' ); ?></option>
											<option value='Level 5'><?php _e( 'Level 5', 'themesdojo' ); ?></option>
										</select>
									</span>

								</span>

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3 class="skill-item-title"><?php _e( 'Speaking', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<select class="resume_lang_speaking" name="" id="" style="width: 100%; margin-right: 10px;">
											<option value='Level 1'><?php _e( 'Level 1', 'themesdojo' ); ?></option>
											<option value='Level 2'><?php _e( 'Level 2', 'themesdojo' ); ?></option>
											<option value='Level 3'><?php _e( 'Level 3', 'themesdojo' ); ?></option>
											<option value='Level 4'><?php _e( 'Level 4', 'themesdojo' ); ?></option>
											<option value='Level 5'><?php _e( 'Level 5', 'themesdojo' ); ?></option>
										</select>
									</span>

								</span>

								<span class="one_half" style="margin-bottom: 0;">

									<span class="one_fourth first" style="margin-bottom: 0;">
										<h3><?php _e( 'Writing', 'themesdojo' ); ?></h3>
									</span>

									<span class="three_fourth" style="margin-bottom: 0;">
										<select class="resume_lang_writing" name="" id="" style="width: 100%; margin-right: 10px;">
											<option value='Level 1'><?php _e( 'Level 1', 'themesdojo' ); ?></option>
											<option value='Level 2'><?php _e( 'Level 2', 'themesdojo' ); ?></option>
											<option value='Level 3'><?php _e( 'Level 3', 'themesdojo' ); ?></option>
											<option value='Level 4'><?php _e( 'Level 4', 'themesdojo' ); ?></option>
											<option value='Level 5'><?php _e( 'Level 5', 'themesdojo' ); ?></option>
										</select>
									</span>

								</span>

								<button name="button_del_language" type="button" class="button-secondary button_del_job_language" style="margin-right: 10px;"><i class="fa fa-trash-o"></i><?php _e( 'Delete', 'themesdojo' ); ?></button>
							</div>

						</div>

						<div class="option_item">
							<button type="button" name="submit_add_language" id='submit_add_job_language' value="add" class="button-secondary"><i class="fa fa-plus-circle"></i><?php _e( 'Add new language', 'themesdojo' ); ?></button>
						</div>

						<div class="divider"></div>

					</div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_fifth first">

							<h3 class="skill-item-title"><?php _e( 'Additional Requirements:', 'themesdojo' ); ?></h3>

						</div>

						<div class="four_fifth">

							<input type='text' id="review-name" class='' name='wpjobus_job_hobbies' style="width: 100%; float: left; margin-bottom: 0;" value='<?php echo $wpjobus_job_hobbies; ?>' placeholder="" />
							<span class="info-text" style="margin-left: 0;"><?php _e( 'Insert multiple requirements and separate them using commas', 'themesdojo' ); ?></span>

						</div>

						<div class="divider" style="margin-top: 20px;"></div>

					</div>

					<h1 class="resume-section-title"><i class="fa fa-money"></i><?php _e( 'Salary & Benefits', 'themesdojo' ); ?></h1>
					<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'Let people know the benefits you offer.', 'themesdojo' ); ?></h3>

					<div class="divider"></div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_half first">

							<span class="full" style="margin-bottom: 0;">

								<span class="one_half first" style="margin-bottom: 0;">
									<h3><?php _e( 'Remuneration Amount:', 'themesdojo' ); ?></h3>
								</span>

								<span class="one_half" style="margin-bottom: 0;">
									<input type='text' id="review-name" class='' name='wpjobus_job_remuneration' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_remuneration; ?>' placeholder="" />
								</span>

							</span>

						</div>

						<div class="one_half">

							<span class="full" style="margin-bottom: 0;">

								<span class="one_fourth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Per:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fourth" style="margin-bottom: 0;">
									<select name="wpjobus_job_remuneration_per" id="wpjobus_job_remuneration_per" style="width: 100%;">
										<?php 
											global $redux_demo; 
											for ($i = 0; $i < count($redux_demo['job-remuneration-per']); $i++) {
										?>
										<option value='<?php echo $redux_demo['job-remuneration-per'][$i]; ?>' <?php selected( $wpjobus_job_remuneration_per, $redux_demo["job-remuneration-per"][$i] ); ?>><?php echo $redux_demo['job-remuneration-per'][$i]; ?></option>
										<?php 
											}
										?>
									</select>
								</span>

							</span>

						</div>

						<div class="full">

							<span class="one_fifth first" style="margin-bottom: 0;">
								<h3><?php _e( 'Job Type:', 'themesdojo' ); ?></h3>
							</span>

							<span class="four_fifth" style="margin-bottom: 0; margin-top: 11px;">

								<?php 
									global $redux_demo; 
									for ($i = 0; $i < count($redux_demo['job-type']); $i++) {
								?>

									<span style="margin-right: 20px; float: left;">
										<input type="radio" class='' name='wpjobus_job_type' style="width: 10px; margin-right: 5px; float: left; margin-top: 5px; margin-bottom: 10px;" value='<?php echo $redux_demo['job-type'][$i]; ?>' <?php if ($wpjobus_job_type == $redux_demo['job-type'][$i]) { ?>checked="checked"<?php } ?>/><?php echo $redux_demo['job-type'][$i]; ?>
									</span>
								<?php 
									}
								?>

							</span>

						</div>

						<div class="divider"></div>

					</div>

					<div class="full" style="margin-bottom: 0;">

						<div id="review_job_benefit">
							<?php 

								if(!empty($wpjobus_job_benefits)) {

								for ($i = 0; $i < (count($wpjobus_job_benefits)); $i++) {

							?>
							
							<div class="full option_item" id="<?php echo $i; ?>">

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="full" style="margin-bottom: 8px;">
										<h3 class="skill-item-title"><?php _e( 'Benefit', 'themesdojo' ); ?> <span><?php echo ($i+1); ?></span></h3>
									</span>

									<span class="full" style="margin-bottom: 0;">
										<h3><?php _e( 'Benefit Name:', 'themesdojo' ); ?></h3>
									</span>

									<span class="full" style="margin-bottom: 0;">
										<input type='text' id='wpjobus_job_benefits[<?php echo $i; ?>][0]' name='wpjobus_job_benefits[<?php echo $i; ?>][0]' value='<?php if (!empty($wpjobus_job_benefits[$i][0])) echo $wpjobus_job_benefits[$i][0]; ?>' class='criteria_name' placeholder="Title">
									</span>

								</span>

								<span class="one_half"  style="margin-bottom: 0;">

									<span class="full" style="margin-bottom: 0;">
										<h3><?php _e( 'Benefit Description:', 'themesdojo' ); ?></h3>
									</span>

									<span class="full" style="margin-bottom: 0;">
										<textarea class="job-benefit-desc" name="wpjobus_job_benefits[<?php echo $i; ?>][1]" id='wpjobus_job_benefits[<?php echo $i; ?>][1]' cols="70" rows="4" ><?php if (!empty($wpjobus_job_benefits[$i][1])) echo $wpjobus_job_benefits[$i][1]; ?></textarea>
									</span>

								</span>

								<button name="button_del_job_benefit" type="button" class="button-secondary button_del_job_benefit" style="margin-top: 10px;"><i class="fa fa-trash-o"></i><?php _e( 'Delete Benefit', 'themesdojo' ); ?></button>
								
							</div>
							
							<?php 
								} }
							?>


						</div>

						<div id="template_job_benefit">
							
							<div class="option_item full" id="999">

								<span class="one_half first"  style="margin-bottom: 0;">

									<span class="full" style="margin-bottom: 8px;">
										<h3 class="skill-item-title"><?php _e( 'Benefit', 'themesdojo' ); ?> <span>999</span></h3>
									</span>

									<span class="full" style="margin-bottom: 0;">
										<h3><?php _e( 'Benefit Name:', 'themesdojo' ); ?></h3>
									</span>

									<span class="full" style="margin-bottom: 0;">
										<input type='text' id='' name='' value='' class='criteria_name' placeholder="Title">
									</span>

								</span>

								<span class="one_half"  style="margin-bottom: 0;">

									<span class="full" style="margin-bottom: 0;">
										<h3><?php _e( 'Benefit Description:', 'themesdojo' ); ?></h3>
									</span>

									<span class="full" style="margin-bottom: 0;">
										<textarea class="job-benefit-desc" name="" id='' cols="70" rows="4" ></textarea>
									</span>

								</span>
								
								<button name="button_del_job_benefit" type="button" class="button-secondary button_del_job_benefit" style="margin-top: 10px;"><i class="fa fa-trash-o"></i><?php _e( 'Delete Benefit', 'themesdojo' ); ?></button>
							</div>

						</div>

						<div class="option_item">
							<button type="button" name="submit_add_criteria" id='submit_add_job_benefit' value="add" class="button-secondary"><i class="fa fa-plus-circle"></i><?php _e( 'Add new benefit', 'themesdojo' ); ?></button>
						</div>

						<div class="divider"></div>

					</div>

					<h1 class="resume-section-title"><i class="fa fa-envelope"></i><?php _e( 'Contact Details', 'themesdojo' ); ?></h1>
					<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'We’re almost done! Fill in the contact details accurately.', 'themesdojo' ); ?></h3>

					<div class="divider"></div>

					<div class="full" style="margin-bottom: 0;">

						<div class="one_half first">

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Address:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type="text" name="wpjobus_job_address" id="wpjobus_job_address" style="width: 100%; float: left;" value="<?php echo $wpjobus_job_address; ?>" class="input-textarea" placeholder="" />
								</span>

							</span>

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Phone number:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="wpjobus_job_phone" class='input-textarea' name='wpjobus_job_phone' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_phone; ?>' placeholder="" />
								</span>

							</span>

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Website:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="wpjobus_job_website" class='input-textarea' name='wpjobus_job_website' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_website; ?>' placeholder="" />
								</span>

							</span>

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Email:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="wpjobus_job_email" class='input-textarea' name='wpjobus_job_email' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_email; ?>' placeholder="" />
									<span class="full" style="margin-bottom: 0;">
										<input type="checkbox" class='' name='wpjobus_job_publish_email' style="width: 10px; margin-right: 5px; float: left; margin-top: 7px;" value='publish_email' placeholder="" <?php if (!empty($wpjobus_job_publish_email)) { ?>checked<?php } ?>/><?php _e( 'Publish my email address', 'themesdojo' ); ?>
									</span>
								</span>

							</span>

						</div>

						<div class="one_half">

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Facebook:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="wpjobus_job_facebook" class='input-textarea' name='wpjobus_job_facebook' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_facebook; ?>' placeholder="" />
								</span>

							</span>

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'LinkedIn:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="wpjobus_job_linkedin" class='input-textarea' name='wpjobus_job_linkedin' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_linkedin; ?>' placeholder="" />
								</span>

							</span>

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Twitter:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="wpjobus_job_twitter" class='input-textarea' name='wpjobus_job_twitter' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_twitter; ?>' placeholder="" />
								</span>

							</span>

							<span class="full" >

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Google+:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type='text' id="wpjobus_job_googleplus" class='input-textarea' name='wpjobus_job_googleplus' style="width: 100%; float: left;" value='<?php echo $wpjobus_job_googleplus; ?>' placeholder="" />
								</span>

							</span>

						</div>

						<div class="full" >

							<span class="one_fifth first" style="margin-bottom: 0;">
								<h3><?php _e( 'Google Maps Address:', 'themesdojo' ); ?></h3>
							</span>

							<span class="four_fifth" style="margin-bottom: 0;">
								<input type='text' id="address" class='input-textarea' name='wpjobus_job_googleaddress' style="width: 100%; float: left; margin-bottom: 0;" value='<?php echo $wpjobus_job_googleaddress; ?>' placeholder="" />
								<p class="help-block"><?php _e('Start typing an address and select from the dropdown.', 'themesdojo') ?></p>
							</span>

						</div>

						<div class="full">

							<div id="map-canvas"></div>

							<style>

								#map-canvas {
									display: block;
									width: 100%;
									height: 470px;
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

									  var latlng = new google.maps.LatLng(<?php echo $wpjobus_job_latitude; ?>, <?php echo $wpjobus_job_longitude; ?>);
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

						<div class="full" >

							<div class="one_half first" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Latitude:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type="text" id="latitude" name="wpjobus_job_latitude" value="<?php echo $wpjobus_job_latitude; ?>" class="input-textarea">
								</span>

							</div>

							<div class="one_half" style="margin-bottom: 0;">

								<span class="two_fifth first" style="margin-bottom: 0;">
									<h3><?php _e( 'Longitude:', 'themesdojo' ); ?></h3>
								</span>

								<span class="three_fifth" style="margin-bottom: 0;">
									<input type="text" id="longitude" name="wpjobus_job_longitude" value="<?php echo $wpjobus_job_longitude; ?>" class="input-textarea">
								</span>

							</div>

						</div>

					</div>

					<div class="divider"></div>

					<div class="full save-resume-block">

						<div class="full" style="margin-bottom: 0;">

							<div id="success">
								<span>
									<h3><?php _e( 'Job Offer Updated Successful.', 'themesdojo' ); ?></h3>
								</span>
								<div class="divider"></div>
							</div>
										 
							<div id="error">
								<span>
									<h3><?php _e( 'Something went wrong, try refreshing and submitting the form again.', 'themesdojo' ); ?></h3>
								</span>
								<div class="divider"></div>
							</div>

						</div>

						<input type="hidden" name="action" value="wpjobusEditJobForm" />
						<?php wp_nonce_field( 'wpjobusEditJob_html', 'wpjobusEditJob_nonce' ); ?>

						<span class="draft-resume-button">

							<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php _e( 'Save As Draft', 'themesdojo' ); ?>" class="input-submit">

							<script>
								jQuery(document).on('click','.draft-resume-button .input-submit', function() {

									$thisItem = jQuery(this);
									$thisItem.parent().parent().parent().find('#postStatus').val('draft');
									
								});
							</script>

						</span>

						<span class="submit-resume-button">

							<input style="margin-bottom: 0;" name="submit" type="submit" value="<?php global $redux_demo, $recipe_state; $recipe_state = $redux_demo['resume-state']; if($recipe_state == "1" or current_user_can('administrator')) { _e( 'Update Job Offer', 'themesdojo' ); } else { _e( 'Update Job Offer For Review', 'themesdojo' ) ;} ?>" class="input-submit">	 
							<span class="submit-loading"><i class="fa fa-refresh fa-spin"></i></span>

							<script>
								jQuery(document).on('click','.submit-resume-button .input-submit', function() {

									$thisItem = jQuery(this);
									$thisItem.parent().parent().parent().find('#postStatus').val('published');
									
								});
							</script>

						</span>

					</div>

					<input type="hidden" id="postStatus" name="postStatus" value="">

				</form>

				<script type="text/javascript">

				jQuery(function($) {
					jQuery('#wpjobus-add-resume').validate({
						rules: {
						    fullName: {
						        required: true,
						        minlength: 3
						    },
						    wpjobus_job_email: {
						        required: true,
						        email: true
						    }
						},
						messages: {
							fullName: {
							    required: "<?php _e( 'Please provide a name', 'themesdojo' ); ?>",
							    minlength: "<?php _e( 'Name must be at least 3 characters long', 'themesdojo' ); ?>"
							},
							wpjobus_job_email: {
							    required: "<?php _e( 'Please provide an email address', 'themesdojo' ); ?>",
							    email: "<?php _e( 'Please enter a valid email address', 'themesdojo' ); ?>"
							}
						},
						submitHandler: function(form) {
							tinyMCE.triggerSave();
						    jQuery('#wpjobus-add-resume .input-submit').css('display','none');
						    jQuery('#wpjobus-add-resume .submit-loading').css('display','block');
						    jQuery(form).ajaxSubmit({
						        type: "POST",
								data: jQuery(form).serializeArray(),
								url: '<?php echo admin_url('admin-ajax.php'); ?>', 
						        success: function(data) {
						            if(data != 0) {
						        		jQuery('#wpjobus-add-resume .submit-loading').css('display','none');
						        		jQuery('#success').fadeIn();

						        		<?php $redirect_link = home_url('/')."my-account"; ?>

      									var delay = 5;
      									setTimeout(function(){ window.location = '<?php echo $redirect_link; ?>';}, delay);

						            } else {
						            	jQuery('#wpjobus-add-resume .input-submit').css('display','block');
							        	jQuery('#wpjobus-add-resume .submit-loading').css('display','none');

							            jQuery('#error').fadeIn();
						            }
						        },
						        error: function(data) {
						        	jQuery('#wpjobus-add-resume .input-submit').css('display','block');
						        	jQuery('#wpjobus-add-resume .submit-loading').css('display','none');

						            jQuery('#error').fadeIn();
						        }
						    });
						}
					});
				});
				</script>

				<?php } ?>

			</div>
			
		</div>

	</section>

<?php get_footer(); ?>