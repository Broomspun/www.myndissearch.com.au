<?php

function wpjobusSubmitResumesFilter() {

  	if ( isset( $_POST['wpjobusSubmitResumesFilter_nonce'] ) && wp_verify_nonce( $_POST['wpjobusSubmitResumesFilter_nonce'], 'wpjobusSubmitResumesFilter_html' ) ) {

  		global $wpdb, $td_companies_per_page, $td_total_companies, $td_total_pages, $td_current_page, $wpjobus_companies;

		$td_companies_per_page = 18;

		$td_total_companies = 0;

		$td_current_page = $_POST['companies_current_page'];

  		$companies_map_block = $_POST['companies_map_block'];

  		// Job Presence Filter
  		$td_job_presence_type = $_POST['job_presence_type'];
		$td_job_presence_type_all = $_POST['job_presence_type_all'];

		$stringOriginal = '';
		$stringOriginalCount = 0;

		if($td_job_presence_type_all == 1) {

			global $redux_demo; 
			for ($i = 0; $i < count($redux_demo['job-type']); $i++) {

				if($stringOriginalCount != 0) {
					$stringOriginalCountPrim = " OR ";
				} else {
					$stringOriginalCountPrim = "";
				}

				$stringOriginal .= $stringOriginalCountPrim."m.meta_value LIKE '%". $redux_demo['job-type'][$i] ."%'";

				$stringOriginalCount++;

			 }

		} else {

			for ($countQ = 0; $countQ < count($td_job_presence_type); $countQ++) { 

				if(!empty($td_job_presence_type[$countQ])) { 

					if($stringOriginalCount != 0) {
						$stringOriginalCountPrim = " OR ";
					} else {
						$stringOriginalCountPrim = "";
					}

					$stringOriginal .= $stringOriginalCountPrim."m.meta_value LIKE '%". $td_job_presence_type[$countQ] ."%'";

					$stringOriginalCount++;

				}

			  }

		}

		if(!empty($stringOriginal)) {

			$string = "AND m.meta_key = 'wpjobus_resume_job_type'  AND (" . $stringOriginal . ")";

		} else {

			$string = "";

		}
		// End Job Presence Filter

		// Job Career Level Filter
  		$td_job_career_level = $_POST['job_career_level'];
		$td_job_career_level_all = $_POST['job_career_level_all'];

		$stringOriginalLevel = '';
		$stringOriginalLevelCount = 0;

		if($td_job_career_level_all == 1) {

			global $redux_demo; 
			for ($i = 0; $i < count($redux_demo['resume_career_level']); $i++) {

				if($stringOriginalLevelCount != 0) {
					$stringOriginalLevelCountPrim = " OR ";
				} else {
					$stringOriginalLevelCountPrim = "";
				}

				$stringOriginalLevel .= $stringOriginalLevelCountPrim."m2.meta_value = '". $redux_demo['resume_career_level'][$i] ."'";

				$stringOriginalLevelCount++;

			 }

		} else {

			for ($countQ = 0; $countQ < count($td_job_career_level); $countQ++) { 

				if(!empty($td_job_career_level[$countQ])) { 

					if($stringOriginalLevelCount != 0) {
						$stringOriginalLevelCountPrim = " OR ";
					} else {
						$stringOriginalLevelCountPrim = "";
					}

					$stringOriginalLevel .= $stringOriginalLevelCountPrim."m2.meta_value = '". $td_job_career_level[$countQ] ."'";

					$stringOriginalLevelCount++;

				}

			  }

		}

		if(!empty($stringOriginalLevel)) {

			$stringLevel = "AND m2.meta_key = 'resume_career_level'  AND (" . $stringOriginalLevel . ")";

		} else {

			$stringLevel = "";

		}
		// End Job Career Level Filter

		// Job Career Level Filter
  		$td_job_location = $_POST['company_location'];
		$td_job_location_all = $_POST['company_location_all'];

		$stringOriginalLocation = '';
		$stringOriginalLocationCount = 0;

		if($td_job_location_all == 1) {

			global $redux_demo; 
			for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {

				if($stringOriginalLocationCount != 0) {
					$stringOriginalLocationCountPrim = " OR ";
				} else {
					$stringOriginalLocationCountPrim = "";
				}

				$stringOriginalLocation .= $stringOriginalLocationCountPrim."m3.meta_value = '". $redux_demo['resume-locations'][$i] ."'";

				$stringOriginalLocationCount++;

			 }

		} else {

			for ($countQ = 0; $countQ < count($td_job_location); $countQ++) { 

				if(!empty($td_job_location[$countQ])) { 

					if($stringOriginalLocationCount != 0) {
						$stringOriginalLocationCountPrim = " OR ";
					} else {
						$stringOriginalLocationCountPrim = "";
					}

					$stringOriginalLocation .= $stringOriginalLocationCountPrim."m3.meta_value = '". $td_job_location[$countQ] ."'";

					$stringOriginalLocationCount++;

				}

			  }

		}

		if(!empty($stringOriginalLocation)) {

			$stringLocation = "AND m3.meta_key = 'resume_location'  AND (" . $stringOriginalLocation . ")";

		} else {

			$stringLocation = "";

		}
		// End Job Career Level Filter

		// Job Experience Years Filter
  		$comp_est_year = $_POST['comp_est_year'];

		if(!empty($comp_est_year)) {

			$stringEstYear = "AND m5.meta_key = 'resume_years_of_exp' AND m5.meta_value >= ".$comp_est_year."";

		} else {

			$stringEstYear = "";

		}
		// End Experience Years Filter

		// Job Salary Filter
		$comp_min_team = $_POST['comp_min_team'];
		$comp_max_team = $_POST['comp_max_team'];

		if(!empty($comp_min_team)) {

			$string_comp_min_team = "AND m6.meta_key = 'wpjobus_resume_remuneration_raw' AND m6.meta_value >= ".$comp_min_team."";

		} else {

			$string_comp_min_team = "";

		}

		if(!empty($comp_max_team)) {

			$string_comp_max_team = "AND m7.meta_key = 'wpjobus_resume_remuneration_raw' AND m7.meta_value <= ".$comp_max_team."";

		} else {

			$string_comp_max_team = "";

		}
		// End Salary Filter

		// Keyword search filter
		$keyword = $_POST['comp_keyword'];

		if(!empty($keyword)) {

			$stringKeyword = "AND (m8.meta_key = 'resume-about-me' AND m8.meta_value LIKE '%" . $keyword . "%')";

		} else {

			$stringKeyword = "";

		}
		// End keyword search filter

 
		$wpjobus_companies = $wpdb->get_results( "SELECT DISTINCT p.ID
												FROM  `{$wpdb->prefix}posts` p
												LEFT JOIN  `{$wpdb->prefix}postmeta` m ON p.ID = m.post_id
												LEFT JOIN  `{$wpdb->prefix}postmeta` m2 ON p.ID = m2.post_id
												LEFT JOIN  `{$wpdb->prefix}postmeta` m3 ON p.ID = m3.post_id
												LEFT JOIN  `{$wpdb->prefix}postmeta` m4 ON p.ID = m4.post_id
												LEFT JOIN  `{$wpdb->prefix}postmeta` m5 ON p.ID = m5.post_id
												LEFT JOIN  `{$wpdb->prefix}postmeta` m6 ON p.ID = m6.post_id
												LEFT JOIN  `{$wpdb->prefix}postmeta` m7 ON p.ID = m7.post_id
												LEFT JOIN  `{$wpdb->prefix}postmeta` m8 ON p.ID = m8.post_id
												WHERE p.post_type = 'resume'
												AND p.post_status = 'publish'
												".$string."
												".$stringLevel."
												".$stringLocation."
												".$stringEstYear."
												".$string_comp_min_team."
												".$string_comp_max_team."
												".$stringKeyword."
												ORDER BY  `p`.`ID` DESC");


  		if($companies_map_block == 0) {

			?>

			<ul id="companies-block-list-ul">

			<?php
						  
			foreach($wpjobus_companies as $company) { 
			  	$td_total_companies++;
			}

			$td_total_pages = ceil($td_total_companies/$td_companies_per_page);
			$current_pos = -1;
			$current_element_id = 0; 

			foreach($wpjobus_companies as $q) { 

				$current_pos++;

			  	if($td_current_page == 1) {
					$start_loop = 0;
			  	} else {
					$start_loop = ($td_current_page - 1) * $td_companies_per_page;
			  	}

			  	$end_loop = $td_current_page * $td_companies_per_page;

			  	if($current_pos >= $start_loop && $current_pos <= ($end_loop-1)) {

					$current_element_id++;

					$company_id = $q->ID;

					$td_result_company_date = get_the_date("Y-m-d h:m:s", $company_id );
										
					$wpjobus_resume_fullname = esc_attr(get_post_meta($company_id, 'wpjobus_resume_fullname',true));

					$wpjobus_resume_longitude = get_post_meta($company_id, 'wpjobus_resume_longitude',true);
					$wpjobus_resume_latitude = get_post_meta($company_id, 'wpjobus_resume_latitude',true);

					$wpjobus_resume_profile_picture = esc_attr(get_post_meta($company_id, 'wpjobus_resume_profile_picture',true));

					$td_resume_location = esc_attr(get_post_meta($company_id, 'resume_location',true));

					$wpjobus_resume_job_type = get_post_meta($company_id, 'wpjobus_resume_job_type',true);

					$wpjobus_resume_prof_title = esc_attr(get_post_meta($company_id, 'wpjobus_resume_prof_title',true));

					$wpjobus_resume_remuneration = get_post_meta($company_id, 'wpjobus_resume_remuneration',true);
					$wpjobus_resume_remuneration_per = get_post_meta($company_id, 'wpjobus_resume_remuneration_per',true);

					$td_resume_years_of_exp = esc_attr(get_post_meta($company_id, 'resume_years_of_exp',true));

					$iconPath = get_template_directory_uri() .'/images/icon-resume.png';

			?> 

					<li id="<?php echo $current_element_id; ?>" data-longitude="<?php echo esc_attr( $wpjobus_resume_longitude ); ?>" data-latitude="<?php echo esc_attr( $wpjobus_resume_latitude ); ?>" data-thumb="<?php echo esc_url($wpjobus_resume_profile_picture); ?>" data-title="<?php $names = explode(' ', $wpjobus_resume_fullname); $firstname = $names[0]; $lastname = $names[1]; echo $firstname.' '.$lastname[0]; ?>" data-label="<?php echo esc_url($iconPath); ?>" data-link="<?php $companylink = home_url('/')."resume/".$company_id; echo esc_url($companylink); ?>" data-text="<?php _e( "View Resume", "themesdojo" ); ?>">

						<a href="<?php $companylink = home_url('/')."resume/".$company_id; echo $companylink; ?>">

							<div class="company-holder-block">

								<span class="company-list-icon rounded-img">
									<?php 

										require_once(get_template_directory() . '/inc/BFI_Thumb.php'); 

										$params = array( 'width' => 50, 'height' => 50, 'crop' => true );

									?>
									<img src="<?php echo bfi_thumb( "$wpjobus_resume_profile_picture", $params ); ?>" alt="<?php echo $wpjobus_resume_fullname; ?>" />
								</span>

								<span class="company-list-name-block" style="max-width: 380px;">
									<span class="company-list-name"><?php echo $wpjobus_resume_fullname; ?> <span class="resume-prof-title"><?php echo $wpjobus_resume_prof_title; ?></span></span>
									<span class="company-list-location">

										<?php 

											if(!empty($wpjobus_resume_job_type)) {

												for ($i = 0; $i < (count($wpjobus_resume_job_type)); $i++) {

													if(!empty($wpjobus_resume_job_type[$i][1])) {
										?>

										<span class="resume_job_<?php echo $wpjobus_resume_job_type[$i][0]; ?>"><?php echo $wpjobus_resume_job_type[$i][1]; ?></span>

										<?php } } } ?>

										<span><i class="fa fa-map-marker" style="margin-left: 10px;"></i><?php echo $td_resume_location; ?></span>

									</span>
								</span>

								<span class="company-list-view-profile">

									<span class="company-view-profile">
										<span class="company-view-profile-title-holder">
											<span class="company-view-profile-title"><?php _e( 'View', 'themesdojo' ); ?></span>
											<span class="company-view-profile-subtitle"><?php _e( 'Resume', 'themesdojo' ); ?></span>
										</span>
										<i class="fa fa-eye"></i>
									</span>

								</span>

								<span class="company-list-badges" style="margin-top: 19px;">

									<span class="job-offers-post-badge featured-badge">
										<span class="job-offers-post-badge-job-type" style="width: 110px; color: #7f8c8d; line-height: 16px; padding-top: 9px; text-align: right;"><?php echo $td_resume_years_of_exp; ?>+ <?php _e( 'Years Experience', 'themesdojo' ); ?></span>
										<span class="job-offers-post-badge-amount"><?php echo $wpjobus_resume_remuneration; ?></span>
										<span class="job-offers-post-badge-amount-per">/<?php echo $wpjobus_resume_remuneration_per; ?></span>
									</span>

								</span>

							</div>

						</a>

					</li>

			  	<?php } } ?>

			</ul>

			<?php if($current_element_id == 0) { ?>

			  	<div class="full"><h4><?php _e( 'Well, it looks like there are no results matching your criterias.', 'themesdojo' ); ?></h4></div>

			<?php }

			if($td_total_pages > 1) {  

			  	$wpcook_pagination = array(
					  'base' => @add_query_arg('page','%#%'),
					  'format' => '',
					  'total' => $td_total_pages,
					  'current' => $td_current_page,
					  'prev_next' => true,
					  'prev_text'    => __('« Previous', 'themesdojo'),
					  'next_text'    => __('Next »', 'themesdojo'),
					  'type' => 'plain',
					  );

			  	$wpcook_pagination['base'] = '#%#%';

			  	if( !empty($wp_query->query_vars['s']) )
					$wpcook_pagination['add_args'] = array('s'=>get_query_var('s'));

					echo '<div class="pagination">' . paginate_links($wpcook_pagination) . '</div>'; 
			}

			$response = ob_get_contents();

		}

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_wpjobusSubmitResumesFilter', 'wpjobusSubmitResumesFilter' );
add_action( 'wp_ajax_nopriv_wpjobusSubmitResumesFilter', 'wpjobusSubmitResumesFilter' );

