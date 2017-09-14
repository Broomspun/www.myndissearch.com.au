<?php
/**
 * Template name: Resumes
 */

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

get_header(); ?>

	<?php
		include (get_template_directory() . "/part-sliders.php");
	?>

	<section id="blog" style="padding-top: 0; margin-top: 0px;">

		<div class="container">

			<div class="resume-skills">

				<div class="two_third first">

						<div class="full">
							<h1 class="resume-section-title"><i class="fa fa-search"></i><?php _e( 'Search for NDIS Carers', 'themesdojo' ); ?></h1>
							<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'Find the right NDIS Carer for your healthcare and disability requirements.', 'themesdojo' ); ?></h3>
						</div>

						<!--<div class="full" style="margin-bottom: 0;">
							<div class="loading"><i class="fa fa-spinner fa-spin"></i></div>
						</div>-->

<div id="companies-block">
						<ul id="companies-block-list-ul">
							<?php
							$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
							$args = array(
										'post_type' => 'resume',
										'posts_per_page' => 10,
										'paged' => $paged
								);
							$args['meta_query'] =array();
							$args['meta_query']['relation'] = 'AND';
							if($_REQUEST['keyword']!=''){
								$args['s'] = $_REQUEST['keyword'];
							}
							if($_REQUEST['resume_location']!=''){
								$args['meta_query'][] = array(
																'key'     => 'resume_location',
																'value'   => $_REQUEST['resume_location'],
																'compare' => '=',
															);
							}
							if($_REQUEST['resume_type']!=''){
								$args['meta_query'][] = array(
																'key'     => 'resume_work_job_type',
																'value'   => $_REQUEST['resume_type'],
																'compare' => '=',
															);
							}
							
							
						
		


							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$company_id = get_the_id();
									$td_result_company_date = get_the_date("Y-m-d h:m:s", $company_id );
										
										$wpjobus_resume_fullname = esc_attr(get_post_meta($company_id, 'wpjobus_resume_fullname',true));

										$wpjobus_resume_longitude = esc_attr(get_post_meta($company_id, 'wpjobus_resume_longitude',true));
										$wpjobus_resume_latitude = esc_attr(get_post_meta($company_id, 'wpjobus_resume_latitude',true));

										$wpjobus_resume_profile_picture = esc_url(get_post_meta($company_id, 'wpjobus_resume_profile_picture',true));

										$td_resume_location = esc_attr(get_post_meta($company_id, 'resume_location',true));

										$wpjobus_resume_job_type = esc_attr(get_post_meta($company_id, 'wpjobus_resume_job_type',true));

										$wpjobus_resume_prof_title = esc_attr(get_post_meta($company_id, 'wpjobus_resume_prof_title',true));

										$wpjobus_resume_remuneration = esc_attr(get_post_meta($company_id, 'wpjobus_resume_remuneration',true));
										$wpjobus_resume_remuneration_per = esc_attr(get_post_meta($company_id, 'wpjobus_resume_remuneration_per',true));

										$td_resume_years_of_exp = esc_attr(get_post_meta($company_id, 'resume_years_of_exp',true));

										$iconPath = get_template_directory_uri() .'/images/icon-resume.png';

							?> 

							<li id="<?php echo esc_attr($current_element_id); ?>" data-longitude="<?php echo esc_attr( $wpjobus_resume_longitude ); ?>" data-latitude="<?php echo esc_attr( $wpjobus_resume_latitude ); ?>" data-thumb="<?php echo esc_url($wpjobus_resume_profile_picture); ?>" data-title="<?php $names = explode(' ', $wpjobus_resume_fullname); $firstname = $names[0]; $lastname = $names[1]; echo $firstname.' '.$lastname[0]; ?>" data-label="<?php echo esc_url($iconPath); ?>" data-link="<?php $companylink = home_url('/')."resume/".$company_id; echo esc_url($companylink); ?>" data-text="<?php _e( "View Provider", "themesdojo" ); ?>">

								<a href="<?php $companylink = home_url('/')."resume/".$company_id; echo $companylink; ?>">

									<div class="company-holder-block">

										<span class="company-list-icon rounded-img">
											<?php 

												require_once(get_template_directory() . '/inc/BFI_Thumb.php'); 

												$params = array( 'width' => 50, 'height' => 50, 'crop' => true );

											?>
											<?php if($wpjobus_resume_profile_picture != ""){ ?>
											<img src="<?php echo bfi_thumb( "$wpjobus_resume_profile_picture", $params ); ?>" alt="<?php echo $wpjobus_resume_fullname; ?>" />
											<?php }else{ ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/logo-small.png" alt="<?php echo $wpjobus_resume_fullname; ?>" />
											<?php } ?>
											
										</span>

										<span class="company-list-name-block" style="max-width: 380px;">
											<span class="company-list-name"><?php echo $wpjobus_resume_fullname; ?>
											<span class="company-list-name"><?php $names = explode(' ', $wpjobus_resume_fullname); $firstname = $names[0]; $lastname = $names[1]; echo $firstname.' '.$lastname[0];?>
											 <span class="resume-prof-title"><?php echo $wpjobus_resume_prof_title; ?></span></span>
											<span class="company-list-location">

												<?php 

													if(!empty($wpjobus_resume_job_type)) {

														for ($i = 0; $i < (count($wpjobus_resume_job_type)); $i++) {

															if(!empty($wpjobus_resume_job_type[$i][1])) {
												?>

												<span class="resume_job_<?php echo esc_attr($wpjobus_resume_job_type[$i][0]); ?>"><?php echo esc_attr($wpjobus_resume_job_type[$i][1]); ?></span>

												<?php } } } ?>

												<span><i class="fa fa-map-marker"></i><?php echo $td_resume_location; ?></span>

											</span>
										</span>

										<span class="company-list-view-profile">

											<span class="company-view-profile">
												<span class="company-view-profile-title-holder">
													<span class="company-view-profile-title"><?php _e( 'View', 'themesdojo' ); ?></span>
													<span class="company-view-profile-subtitle"><?php _e( 'Carer', 'themesdojo' ); ?></span>
												</span>
												<i class="fa fa-eye"></i>
											</span>

										</span>

										<span class="company-list-badges" style="margin-top: 19px;">

											<span class="job-offers-post-badge featured-badge" >
												<span class="job-offers-post-badge-job-type" style="width: 110px; color: #7f8c8d; line-height: 16px; padding-top: 9px; text-align: right;"><?php echo $td_resume_years_of_exp; ?>+ <?php _e( 'Years Experience', 'themesdojo' ); ?></span>
												<span class="job-offers-post-badge-amount"><?php echo $wpjobus_resume_remuneration; ?></span>
												<span class="job-offers-post-badge-amount-per">/<?php echo $wpjobus_resume_remuneration_per; ?></span>
											</span>

										</span>

									</div>

								</a>

							</li>

							<?php }
							}else{
								?>
								<div class="full"><h4><?php _e( 'Well, it looks like there are no results matching your criterias.', 'themesdojo' ); ?></h4></div>
								<?php
							}
							?>
						</ul>
						<?php 
								
							echo '<div class="pagination">';	
							pagination_bar( $the_query );
							echo '</div>';
						?>
					</div>



						

					</div>

					<div class="one_third" >

						<?php 

							$currentDate = current_time('timestamp');

							$total_jobs = 0;

							$wpjobus_jobs = $wpdb->get_results( "SELECT DISTINCT p.ID
																FROM  `wp_posts` p
																LEFT JOIN  `wp_postmeta` m ON p.ID = m.post_id
																WHERE p.post_type = 'resume'
																AND p.post_status = 'publish'
																AND m.meta_key = 'wpjobus_featured_expiration_date' 
																AND m.meta_value >= '".$currentDate."'
																ORDER BY RAND()");

							foreach($wpjobus_jobs as $q) { 
							  	$total_jobs++;
							}

							if($total_jobs > 0) {

								$curren_job = 0;

						?>

						<span class="filters-title"><i class="fa fa-star"></i><?php _e( 'Featured Carers!', 'themesdojo' ); ?></span>

						<div id="owl-demo" class="owl-carousel owl-theme featured-items">

							<?php foreach($wpjobus_jobs as $job) {

								$curren_job++; 
								  	
								$job_id = $job->ID;

								if($curren_job <= 5) {

							?>

							<div class="item">

						  		<a href="<?php $link_job = home_url('/')."resume/".$job_id; echo $link_job; ?>">

							  		<div class="featured-item">

							  			<span class="featured-item-image">

							  				<?php 

							  					$wpjobus_resume_cover_image = esc_attr(get_post_meta($job_id, 'wpjobus_resume_cover_image',true));
												$wpjobus_resume_fullname = esc_attr(get_post_meta($job_id, 'wpjobus_resume_fullname',true));
												$wpjobus_resume_profile_picture = esc_attr(get_post_meta($job_id, 'wpjobus_resume_profile_picture',true));
												$wpjobus_resume_prof_title = esc_attr(get_post_meta($job_id, 'wpjobus_resume_prof_title',true));
												$td_resume_career_level = esc_attr(get_post_meta($job_id, 'resume_career_level',true));
												$td_resume_location = esc_attr(get_post_meta($job_id, 'resume_location',true));
												$td_resume_years_of_exp = esc_attr(get_post_meta($job_id, 'resume_years_of_exp',true));
												$wpjobus_resume_remuneration = esc_attr(get_post_meta($job_id, 'wpjobus_resume_remuneration',true));
												$wpjobus_resume_remuneration_per = esc_attr(get_post_meta($job_id, 'wpjobus_resume_remuneration_per',true));
												$wpjobus_resume_job_type = esc_attr(get_post_meta($job_id, 'wpjobus_resume_job_type',true));

									    		$total_jobs = 0;

									    		$company_jobs = $wpdb->get_results( "SELECT p.ID
																					FROM  `{$wpdb->prefix}posts` p
																					LEFT JOIN  `{$wpdb->prefix}postmeta` m ON p.ID = m.post_id
																					WHERE p.post_type = 'job'
																					AND (p.post_status = 'publish' or p.post_status = 'draft' or p.post_status = 'pending')
																					AND m.meta_key = 'job_company' AND m.meta_value = '".$job_id."'
																					");
						  
												foreach($company_jobs as $job) { 
													$total_jobs++;
												}	

							  					if(!empty($wpjobus_resume_cover_image)) {

									  				require_once(get_template_directory() . '/inc/BFI_Thumb.php'); 
													$params = array( 'width' => 340, 'height' => 200, 'crop' => true );
													echo "<img class='big-img' src='" . bfi_thumb( "$wpjobus_resume_cover_image", $params ) . "' alt='" . $wpjobus_resume_fullname . "'/>";

												} else {

													echo "<span class='featured-image-replacer'><i class='fa fa-file-text-o'></i>";

												}

											?>

											<?php if(!empty($wpjobus_resume_profile_picture)) { ?>

							  				<span class="featured-item-content-title-logo">
							  					<span class="featured-item-content-title-logo-img">
								  					<span class="helper"></span>
								  					<?php
								  						require_once(get_template_directory() . '/inc/BFI_Thumb.php'); 
														$params = array( 'width' => 70, 'height' => 70, 'crop' => true );
								  					?>
								  					<img src="<?php echo bfi_thumb( "$wpjobus_resume_profile_picture", $params ); ?>" alt="">
								  				</span>
							  				</span>

							  				<?php } ?>

							  			</span>

							  			<span class="featured-item-badge">

							  				<span class="featured-item-job-badge">

							  					<span class="featured-item-job-badge-title"><?php echo $td_resume_years_of_exp; ?> <?php _e( 'Years', 'themesdojo' ); ?></span>

							  					<span class="featured-item-job-badge-info">

							  						<span class="featured-item-job-badge-info-sum"><?php echo $wpjobus_resume_remuneration; ?> / </span>

													<span class="featured-item-job-badge-info-per"><?php echo $wpjobus_resume_remuneration_per; ?></span>						  						

							  					</span>

							  				</span>

							  			</span>

							  			<span class="featured-item-content">

							  				<span class="featured-item-content-title"><?php echo $wpjobus_resume_fullname; ?></span>
							  				<span class="featured-item-content-tagline"><?php echo $td_resume_career_level; ?> <?php echo $wpjobus_resume_prof_title; ?></span>
							  				<span class="featured-item-content-subtitle">

							  					<?php 

													if(!empty($wpjobus_resume_job_type)) {

														for ($i = 0; $i < (count($wpjobus_resume_job_type)); $i++) {

															if(!empty($wpjobus_resume_job_type[$i][1])) {
												?>

												<span class="resume_job_<?php echo esc_attr($wpjobus_resume_job_type[$i][0]); ?>"><?php echo esc_attr($wpjobus_resume_job_type[$i][1]); ?></span>

												<?php } } } ?>

							  					<span style="margin-left: 5px;"><i class="fa fa-map-marker"></i><?php echo $td_resume_location; ?></spam>

							  				</span>

							  			</span>

							  		</div>

							  	</a>

						  	</div>

							<?php } } ?>

						</div>

						<?php } ?>

						<div class="filters">

							<span class="filters-title"><?php _e( 'Search & Refinements', 'themesdojo' ); ?></span>

							

							<?php
						            		searchformcarer();
						            		?>

						            		
							
						</div>

					</div>

					

				

			</div>

			<div class="full">
				<h1 class="resume-section-title"><i class="fa fa-files-o"></i><?php _e( 'Recent News', 'themesdojo' ); ?></h1>
				<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'These are the latest news from our blog.', 'themesdojo' ); ?></h3>
			</div>

			<?php

				global $td_paged, $wp_query, $wp;

				$args = wp_parse_args($wp->matched_query);

				$temp = $wp_query;

				$wp_query= null;

				$wp_query = new WP_Query();

				$wp_query->query('post_type=post&posts_per_page=3');

				$td_current_post = 0;

			?>

			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $td_current_post++; if($td_current_post <= 3) { ?>

			<div class="one_third <?php if($td_current_post == 1) { ?>first<?php } ?>" style="text-align: center; margin-bottom: 0;">

				<?php if ( has_post_thumbnail() ) { ?>

				<div class="full">

					<?php require_once(get_template_directory() . '/inc/BFI_Thumb.php'); ?>

					<?php

						$params = array( 'width' => 550, 'height' => 380, 'crop' => true );
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');

					?>

					<a href="<?php the_permalink() ?>"><img src="<?php echo bfi_thumb( "$large_image_url[0]", $params ); ?>" alt="<?php the_title(); ?>" style="width: 100%; height: auto;"></a>

				</div>

				<?php } ?>

				<h3 style="float: left; width: 100%; text-align: center; margin: 0;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

				<div class="full post-meta" style="margin-bottom: 0;">
					<p><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('M j, Y') ?></a><i class="fa fa-comment" style="margin: 0 10px;"></i><a href="<?php comments_link(); ?>"><?php $my_comments = get_comments_number( $post->ID ); echo $my_comments; ?></a></p>
				</div>

				<div class="full" style="margin-bottom: 0;">
					<?php
						$content = get_the_content();
						echo wp_trim_words( $content , '25' ); 
					?>
					<p><a href="<?php the_permalink() ?>"><?php _e( 'Read More', 'themesdojo' ); ?></a></p>
				</div>

			</div>

			<?php } endwhile; ?>
							
			<?php $wp_query = null; $wp_query = $temp;?>
			
		</div>

	</section>

<?php get_footer(); ?>