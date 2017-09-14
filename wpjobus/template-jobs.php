<?php
/**
 * Template name: Jobs
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
							<h1 class="resume-section-title"><i class="fa fa-search"></i><?php _e( 'Search for Jobs', 'themesdojo' ); ?></h1>
							<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'Use our awesome search tool to find job offers!', 'themesdojo' ); ?></h3>
						</div>

						<!--<div class="full" style="margin-bottom: 0;>
							<div class="loading"><i class="fa fa-spinner fa-spin"></i></div>
						</div>-->
<div id="companies-block">
						<ul id="companies-block-list-ul">
							<?php
							$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
							$args = array(
										'post_type' => 'job',
										'posts_per_page' => 10,
										'paged' => $paged
								);
							$args['meta_query'] =array();
							$args['meta_query']['relation'] = 'AND';
							if($_REQUEST['keyword']!=''){
								$args['s'] = $_REQUEST['keyword'];
							}
							if($_REQUEST['job_location']!=''){
								$args['meta_query'][] = array(
																'key'     => 'job_location',
																'value'   => $_REQUEST['job_location'],
																'compare' => '=',
															);
							}
							if($_REQUEST['job_type']!=''){
								$args['meta_query'][] = array(
																'key'     => 'wpjobus_job_type',
																'value'   => $_REQUEST['job_type'],
																'compare' => '=',
															);
							}

							if($_REQUEST['job_presence']!=''){
								$args['meta_query'][] = array(
																'key'     => 'job_presence_type',
																'value'   => $_REQUEST['job_presence'],
																'compare' => '=',
															);
							}


							
							
							
						
		


							$the_query = new WP_Query( $args );
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$company_id = get_the_id();
									$td_result_company_date = get_the_date("Y-m-d h:m:s", $company_id );
										
										$wpjobus_job_fullname = esc_attr(get_post_meta($company_id, 'wpjobus_job_fullname',true));

										$wpjobus_job_longitude = esc_attr(get_post_meta($company_id, 'wpjobus_job_longitude',true));
										$wpjobus_job_latitude = esc_attr(get_post_meta($company_id, 'wpjobus_job_latitude',true));

										$td_job_company = esc_attr(get_post_meta($company_id, 'job_company',true));
										$wpjobus_company_fullname = esc_attr(get_post_meta($td_job_company, 'wpjobus_company_fullname',true));
										$wpjobus_company_profile_picture = esc_url(get_post_meta($td_job_company, 'wpjobus_company_profile_picture',true));

										$td_job_location = esc_attr(get_post_meta($company_id, 'job_location',true));

										$iconPath = get_template_directory_uri() .'/images/icon-job.png';

							?> 

							<li id="<?php echo $current_element_id; ?>" data-longitude="<?php echo esc_attr( $wpjobus_job_longitude ); ?>" data-latitude="<?php echo esc_attr( $wpjobus_job_latitude ); ?>" data-thumb="<?php echo esc_url($wpjobus_company_profile_picture); ?>" data-title="<?php echo esc_attr($wpjobus_job_fullname); ?>" data-label="<?php echo esc_url($iconPath); ?>" data-link="<?php $companylink = home_url('/')."job/".$company_id; echo esc_url($companylink); ?>" data-text="<?php _e( "View Job Offer", "themesdojo" ); ?>">

								<a href="<?php $companylink = home_url('/')."job/".$company_id; echo $companylink; ?>">

									<div class="company-holder-block">

										<span class="company-list-icon">
											<span class="helper"></span>
											<?php if($wpjobus_company_profile_picture != ""){ ?>
											<img src="<?php echo $wpjobus_company_profile_picture; ?>" alt="<?php echo $wpjobus_job_fullname; ?>" />
											<?php }else{ ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/logo-small.png" alt="<?php echo $wpjobus_job_fullname; ?>" />
											<?php } ?>
										</span>

										<span class="company-list-name-block" style="max-width: 380px;">
											<span class="company-list-name"><?php echo $wpjobus_job_fullname; ?></span>
											<span class="company-list-location"><i class="fa fa-briefcase"></i><?php echo $wpjobus_company_fullname; ?><i class="fa fa-map-marker" style="margin-left: 10px;"></i><?php echo $td_job_location; ?><i class="fa fa-calendar-o" style="margin-left: 10px;"></i><?php echo human_time_diff( strtotime($td_result_company_date), current_time('timestamp') ) . ' '; _e( 'ago', 'themesdojo' ); ?>
											</span>
										</span>

										<span class="company-list-view-profile">

											<span class="company-view-profile">
												<span class="company-view-profile-title-holder">
													<span class="company-view-profile-title"><?php _e( 'View', 'themesdojo' ); ?></span>
													<span class="company-view-profile-subtitle"><?php _e( 'Job Offer', 'themesdojo' ); ?></span>
												</span>
												<i class="fa fa-eye"></i>
											</span>

										</span>

										<span class="company-list-badges" style="margin-top: 19px;">

											<?php

												global $redux_demo, $color, $colorState;
												$colorState = 0;

												if(isset($redux_demo['job-type'][0])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][0] ) {
															$colorState = 1;
															$color = '#16a085';
														}
													}

													if(isset($redux_demo['job-type'][1])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][1] ) {
															$colorState = 1;
															$color = '#3498db';
														}
													}

													if(isset($redux_demo['job-type'][2])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][2] ) {
															$colorState = 1;
															$color = '#e74c3c';
														}
													}

													if(isset($redux_demo['job-type'][3])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][3] ) {
															$colorState = 1;
															$color = '#1abc9c';
														}
													}

													if(isset($redux_demo['job-type'][4])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][4] ) {
															$colorState = 1;
															$color = '#8e44ad';
														}
													}

													if(isset($redux_demo['job-type'][5])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][5] ) {
															$colorState = 1;
															$color = '#9b59b6';
														}
													}

													if(isset($redux_demo['job-type'][6])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][6] ) {
															$colorState = 1;
															$color = '#34495e';
														}
													}

													if(isset($redux_demo['job-type'][7])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][7] ) {
															$colorState = 1;
															$color = '#e67e22';
														}
													}

													if(isset($redux_demo['job-type'][8])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][8] ) {
															$colorState = 1;
															$color = '#e74c3c';
														}
													}

													if(isset($redux_demo['job-type'][9])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][9] ) {
															$colorState = 1;
															$color = '#16a085';
														}
													}

													if(isset($redux_demo['job-type'][10])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][10] ) {
															$colorState = 1;
															$color = '#2980b9';
														}
													}

													if(isset($redux_demo['job-type'][11])) {
														if(($wpjobus_job_type = get_post_meta($company_id, 'wpjobus_job_type',true)) == $redux_demo['job-type'][11] ) {
															$colorState = 1;
															$color = '#2ecc71';
														}
													}

											?>

											<span class="job-offers-post-badge" style="max-width: 220px; <?php if($colorState ==1) { ?>background-color: <?php echo $color; ?>; border: solid 2px <?php echo $color; ?>;<?php } ?>">
												<span class="job-offers-post-badge-job-type" style="width: 110px; <?php if($colorState ==1) { ?>color: <?php echo $color; ?>;<?php } ?>"><?php echo $wpjobus_job_type = esc_attr(get_post_meta($company_id, 'wpjobus_job_type',true)); ?></span>
												<span class="job-offers-post-badge-amount"><?php echo $wpjobus_job_remuneration = esc_attr(get_post_meta($company_id, 'wpjobus_job_remuneration',true)); ?></span>
												<span class="job-offers-post-badge-amount-per">/<?php echo $wpjobus_job_remuneration_per = esc_attr(get_post_meta($company_id, 'wpjobus_job_remuneration_per',true)); ?></span>
											</span>

										</span>

									</div>

								</a>

							</li>

							<?php 
								}
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
																FROM  `{$wpdb->prefix}posts` p
																LEFT JOIN  `{$wpdb->prefix}postmeta` m ON p.ID = m.post_id
																WHERE p.post_type = 'job'
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

						<span class="filters-title"><i class="fa fa-star"></i><?php _e( 'Featured Jobs!', 'themesdojo' ); ?></span>

						<div id="owl-demo" class="owl-carousel owl-theme featured-items">

							<?php foreach($wpjobus_jobs as $job) {

								$curren_job++; 
								  	
								$job_id = $job->ID;

								if($curren_job <= 5) {

							?>

							<div class="item">

						  		<a href="<?php $link_job = home_url('/')."job/".$job_id; echo $link_job; ?>">

							  		<div class="featured-item">

							  			<span class="featured-item-image">

							  				<?php 

							  					$wpjobus_job_cover_image = esc_url(get_post_meta($job_id, 'wpjobus_job_cover_image',true));
							  					$wpjobus_job_fullname = esc_attr(get_post_meta($job_id, 'wpjobus_job_fullname',true));
							  					$wpjobus_job_type = esc_attr(get_post_meta($job_id, 'wpjobus_job_type',true));
							  					$wpjobus_job_remuneration_per = esc_attr(get_post_meta($job_id, 'wpjobus_job_remuneration_per',true));
												$wpjobus_job_remuneration = esc_attr(get_post_meta($job_id, 'wpjobus_job_remuneration',true));
												$td_job_company = esc_attr(get_post_meta($job_id, 'job_company',true));
												$wpjobus_company_fullname = esc_attr(get_post_meta($td_job_company, 'wpjobus_company_fullname',true));
												$td_job_location = esc_attr(get_post_meta($job_id, 'job_location',true));

							  					if(!empty($wpjobus_job_cover_image)) {

									  				require_once(get_template_directory() . '/inc/BFI_Thumb.php'); 
													$params = array( 'width' => 340, 'height' => 200, 'crop' => true );
													echo "<img class='big-img' src='" . bfi_thumb( "$wpjobus_job_cover_image", $params ) . "' alt='" . $wpjobus_job_fullname . "'/>";

												} else {

													echo "<span class='featured-image-replacer'><i class='fa fa-bullhorn'></i>";

												}

											?>

							  			</span>

							  			<span class="featured-item-badge">

							  				<span class="featured-item-job-badge">

							  					<span class="featured-item-job-badge-title"><?php echo $wpjobus_job_type; ?></span>

							  					<span class="featured-item-job-badge-info">

							  						<span class="featured-item-job-badge-info-sum"><?php echo $wpjobus_job_remuneration; ?> / </span>

													<span class="featured-item-job-badge-info-per"> <?php echo $wpjobus_job_remuneration_per; ?></span>						  						

							  					</span>

							  				</span>

							  			</span>

							  			<span class="featured-item-content">

							  				<span class="featured-item-content-title"><?php echo $wpjobus_job_fullname; ?></span>
							  				<span class="featured-item-content-subtitle">

							  					<span><i class="fa fa-briefcase"></i><?php echo $wpjobus_company_fullname; ?></span><span><i class="fa fa-map-marker" style="margin-left: 15px;"></i><?php echo $td_job_location; ?></spam>

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
							searchformjob();
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