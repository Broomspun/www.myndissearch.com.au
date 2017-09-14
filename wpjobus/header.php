<?php
/*$redux_demo = get_option( 'redux_demo' );
$file = fopen("https://www.myndissearch.com.au/wp-content/uploads/au-towns.csv","r");
$csv_arr[]=array();
$i=0;
while (($line = fgetcsv($file)) !== FALSE){
$file_n= $line;
$arr= implode(',',array_filter($file_n));
$csv_arr[$i]=$arr;
$i++;
}
fclose($file);
$redux_demo['resume-locations'] = array();
update_option( 'redux_demo', $redux_demo); */
/**
* The Header for our theme.
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
	<!--[if IE 8]>
	<html class="ie ie8" <?php language_attributes(); ?>>
	<![endif]-->
	<!--[if !(IE 7) | !(IE 8)  ]><!-->
	<html <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
		global $redux_demo;
		if(isset($redux_demo['favicon']['url'])) {
			$favicon = $redux_demo['favicon']['url'];
			?>
			<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
			<?php } ?>
			<script type="text/javascript">
				var templateDir = "<?php echo get_template_directory_uri() ?>";
			</script>
				<!--[if lt IE 9]>
				<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
				<![endif]-->
				<?php wp_head(); ?>
				<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
				<link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/daterangepicker.css" />
				<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
				<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/moment.js"></script>
				<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/daterangepicker.js"></script>
				<style type="text/css">
					#job_location_chosen{
						margin-bottom: 20px;
					}
					.chosen-container-single .chosen-single span{
						font-size: 15.3333px;
						font-family: Arial;
						line-height: 31px;
						color:#999999;
					}
					.chosen-container-single .chosen-single{
						height: 37px;
						background: #F7F8FC;
						border: 1px solid #ecf0f1;
					}
				</style>
				
				 <script>
	jQuery(document).ready(function () {
    // Handler for .ready() called.
    jQuery('.menuItem a').click(function () {
		var galblock=jQuery(this).attr('href');
		if(galblock=='#resume-gallery-block')
		{
			//alert(galblock);
			jQuery('html, body').animate({
            scrollTop: jQuery('.pms-sub').offset().top - 120
        }, 1000);
		}
        
    });
	
	jQuery('.port_label').click(function(){
		
		var portcont=jQuery(this).attr('id');
		
		jQuery('.ff-items li').css('opacity','0');
		jQuery('.ff-items li').hide();
		jQuery('.'+portcont).show();
		jQuery('.'+portcont).css('opacity','1');
		
	});
	
	jQuery('.ff-label-type-all').click(function(){
		jQuery('.ff-items li').css('opacity','1');
		jQuery('.ff-items li').show();
	});
});
	
	
	</script>
			</head>
			<?php
			$post_type = get_post_type();
			$td_post_id_class = "";
			if(!empty($post_type)) {
				if($post_type == 'resume') {
					$td_post_id_class = "single-resume";
				}
				if($post_type == 'company') {
					$td_post_id_class = "single-company";
				}
				if($post_type == 'job') {
					$td_post_id_class = "single-job";
				}
			}
			?>
			<body id="<?php echo $td_post_id_class; ?>" <?php body_class(); ?>>
				<div id="pageloader">
					<div id="movingBallG">
						<div class="movingBallLineG">
						</div>
						<div id="movingBallG_1" class="movingBallG">
						</div>
					</div>
				</div>
				<section id="top">
					<div class="container">
						<div class="header-stats">
							<span>
								<?php
								$jobs = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE post_type = 'job' and post_status = 'publish'");
								$jobsNum = 0;
								foreach ($jobs as $key => $value) {
									$jobsNum++;
								}
								echo $jobsNum;
								?>
								<?php if($jobsNum == 1) {
									_e( 'Job', 'themesdojo' );
								} else {
									_e( 'Jobs', 'themesdojo' );
								} ?>
							</span>
							<span class="header-stats-divider">|</span>
							<span>
								<?php
								$resumes = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE post_type = 'resume' and post_status = 'publish'");
								$resumesNum = 0;
								foreach ($resumes as $key => $value) {
									$resumesNum++;
								}
								echo $resumesNum;
								?>
								<?php if($resumesNum == 1) {
									_e( 'Carer Resume', 'themesdojo' );
								} else {
									_e( 'Carer Resumes', 'themesdojo' );
								} ?>
							</span>
							<span class="header-stats-divider">|</span>
							<span>
								<?php
								$companies = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE post_type = 'company' and post_status = 'publish'");
								$compNum = 0;
								foreach ($companies as $key => $value) {
									$compNum++;
								}
								echo $compNum;
								?>
								<?php if($compNum == 1) {
									_e( 'Provider', 'themesdojo' );
								} else {
									_e( 'Providers', 'themesdojo' );
								} ?>
							</span>
						</div>
						<div class="top_menu account-menu">
							<?php
							if ( is_user_logged_in() && current_user_can('administrator')) {
								$company_id = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE (post_type = 'company' or post_type = 'job' or post_type = 'resume') and post_status = 'pending'");
								$pending_posts_num = 0;
								foreach ($company_id as $key) {
									$pending_posts_num++;
								}
								?>
								<a class="pending-posts <?php if($pending_posts_num > 0) { ?>pending-active<?php } ?>" href="<?php $pending = home_url('/')."pending"; echo $pending; ?>">
									<i class="fa fa-gavel"></i><?php echo $pending_posts_num; ?>
								</a>
								<?php } ?>
								<ul class="menu" style="padding-left: 0;">
									<?php
									if ( is_user_logged_in() ) {
										?>
										<?php if (the_slug_exists('my-account')) { ?>
										<li class="first">
											<a href="<?php $profile = home_url('/')."my-account"; echo $profile; ?>" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Login"><?php printf( __( 'My Account', 'themesdojo' )); ?></a>
										</li>
										<?php } ?>
										<li class="last">
											<a href="<?php echo wp_logout_url(get_option('siteurl')); ?>" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Logout"><?php printf( __( 'Log out', 'themesdojo' )); ?></a>
										</li>
										<?php } else { ?>
										<?php if (the_slug_exists('login')) { ?>
										<li class="first">
											<a href="<?php $login = home_url('/')."login"; echo $login; ?>" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Login"><?php printf( __( 'Login', 'themesdojo' )); ?></a>
										</li>
										<?php } ?>
										<?php if (the_slug_exists('register')) { ?>
										<li class="last">
											<a href="<?php $register = home_url('/')."register"; echo $register; ?>" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Register"><?php printf( __( 'Register', 'themesdojo' )); ?></a>
										</li>
										<?php } ?>
										<?php } ?>
									</ul>
								</div>
								<div class="top-social-icons">
									<?php
									global $redux_demo;
									$facebook_link = $redux_demo['facebook-link'];
									$twitter_link = $redux_demo['twitter-link'];
									$dribbble_link = $redux_demo['dribbble-link'];
									$flickr_link = $redux_demo['flickr-link'];
									$github_link = $redux_demo['github-link'];
									$pinterest_link = $redux_demo['pinterest-link'];
									$youtube_link = $redux_demo['youtube-link'];
									$google_plus_link = $redux_demo['google-plus-link'];
									$linkedin_link = $redux_demo['linkedin-link'];
									$tumblr_link = $redux_demo['tumblr-link'];
									$vimeo_link = $redux_demo['vimeo-link'];
									?>
									<?php if(!empty($facebook_link)) { ?>
									<a class="target-blank" href="<?php echo $facebook_link; ?>"><i class="fa fa-facebook-square"></i></a>
									<?php } ?>
									<?php if(!empty($twitter_link)) { ?>
									<a class="target-blank" href="<?php echo $twitter_link; ?>"><i class="fa fa-twitter-square"></i></a>
									<?php } ?>
									<?php if(!empty($dribbble_link)) { ?>
									<a class="target-blank" href="<?php echo $dribbble_link; ?>"><i class="fa fa-dribbble"></i></a>
									<?php } ?>
									<?php if(!empty($flickr_link)) { ?>
									<a class="target-blank" href="<?php echo $flickr_link; ?>"><i class="fa fa-flickr"></i></a>
									<?php } ?>
									<?php if(!empty($github_link)) { ?>
									<a class="target-blank" href="<?php echo $github_link; ?>"><i class="fa fa-github-square"></i></a>
									<?php } ?>
									<?php if(!empty($pinterest_link)) { ?>
									<a class="target-blank" href="<?php echo $pinterest_link; ?>"><i class="fa fa-pinterest-square"></i></a>
									<?php } ?>
									<?php if(!empty($youtube_link)) { ?>
									<a class="target-blank" href="<?php echo $youtube_link; ?>"><i class="fa fa-youtube-square"></i></a>
									<?php } ?>
									<?php if(!empty($google_plus_link)) { ?>
									<a class="target-blank" href="<?php echo $google_plus_link; ?>"><i class="fa fa-google-plus-square"></i></a>
									<?php } ?>
									<?php if(!empty($linkedin_link)) { ?>
									<a class="target-blank" href="<?php echo $linkedin_link; ?>"><i class="fa fa-linkedin-square"></i></a>
									<?php } ?>
									<?php if(!empty($tumblr_link)) { ?>
									<a class="target-blank" href="<?php echo $tumblr_link; ?>"><i class="fa fa-tumblr-square"></i></a>
									<?php } ?>
									<?php if(!empty($vimeo_link)) { ?>
									<a class="target-blank" href="<?php echo $vimeo_link; ?>"><i class="fa fa-vimeo-square"></i></a>
									<?php } ?>
								</div>
								<div class="top_menu">
									<?php wp_nav_menu(array('theme_location' => 'secondary', 'container' => 'false')); ?>
								</div>
							</div>
						</section>
						<header id="header">
							<div class="container">
								<div class="full" style="margin-bottom: 0;">
									<a class="logo" href="<?php echo home_url('/'); ?>">
										<?php
										global $redux_demo;
										if(isset($redux_demo['logo']['url'])) {
											$logo = $redux_demo['logo']['url'];
											?>
											<img src="<?php echo $logo; ?>" alt="Logo" />
											<?php } else { ?>
											<img src="https://www.myndissearch.com.au/wp-content/uploads/2017/08/care-search-logo.png" alt=""/>
											<?php } ?>
										</a>
										<?php if ( the_slug_exists('add-company') || the_slug_exists('add-job') || the_slug_exists('add-resume') ) { ?>
										<span class="top_menu new-posts-menu">
											<?php if ( !is_user_logged_in() ) { ?>
											<ul class="menu">
												<li><a href="#" class="button-ag-full"><?php printf( __( 'REGISTER', 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
													<ul class="sub-menu add-listing-submenu">
														<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>
														<?php if (the_slug_exists('add-company')) { ?>
														<li><a href="<?php $new_company = home_url('/')."provider-plans/"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'Provider', 'themesdojo' )); ?></a></li>
														<?php } ?>
														<?php if (the_slug_exists('add-job')) { ?>
														<li><a href="<?php $new_job = home_url('/')."login/"; echo $new_job; ?>"><i class="fa fa-bullhorn"></i><?php printf( __( 'Participant', 'themesdojo' )); ?></a></li>
														<?php } ?>
														<?php /*if (the_slug_exists('add-resume')) { ?>
														<li><a href="<?php $new_resume = home_url('/')."carer-plans/"; echo $new_resume; ?>"><i class="fa fa-file-text-o"></i><?php printf( __( 'Carer', 'themesdojo' )); ?></a></li>
														<?php }*/ ?>
													</ul>
												</li>
											</ul>
											<?php } else { ?>
											<?php
											global $redux_demo;
											$account_type = $redux_demo['account-state'];
											if($account_type == 1) {
												?>
											<?php
												$get_provider_plan =  get_provider_package_plan();
														if($get_provider_plan == 'Free Listing'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __('YOUR PLAN FREE', 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																<ul class="sub-menu add-listing-submenu">
																	<!--<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>-->
																
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO SILVER', 'themesdojo' )); ?></a></li>
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO GOLD', 'themesdojo' )); ?></a></li>
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO PLATINUM', 'themesdojo' )); ?></a></li>
																	
																	
																</ul>
															</li>
														</ul>
														<?php }else if($get_provider_plan == 'Silver Membership'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __( 'YOUR PLAN SILVER', 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																<ul class="sub-menu add-listing-submenu">
																	<!--<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>-->
																
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO GOLD', 'themesdojo' )); ?></a></li>
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO PLATINUM', 'themesdojo' )); ?></a></li>
																	
																	
																</ul>
															</li>
														</ul>
														<?php }else if($get_provider_plan == 'Gold Membership'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __( 'YOUR PLAN GOLD', 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																<ul class="sub-menu add-listing-submenu">
																	<!--<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>-->
																
																
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO PLATINUM', 'themesdojo' )); ?></a></li>
																	
																	
																</ul>
															</li>
														</ul>
														<?php }else if($get_provider_plan == 'Platinum Membership'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __( 'YOUR PLAN PLATINUM', 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																
															</li>
														</ul>
													<?php } ?>
													
													<?php } else { ?>
													<?php
													global $current_user;
													$key = 'account_type';
													$single = true;
													$td_user_id = $current_user->ID;
													$user_account_type = get_user_meta( $td_user_id, $key, $single );
													if($user_account_type == "job-offer") {

														$get_provider_plan =  get_provider_package_plan();
														if($get_provider_plan == 'Free Listing'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __( $get_provider_plan, 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																<ul class="sub-menu add-listing-submenu">
																	<!--<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>-->
																
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO SILVER', 'themesdojo' )); ?></a></li>
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO GOLD', 'themesdojo' )); ?></a></li>
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO PLATINUM', 'themesdojo' )); ?></a></li>
																	
																	
																</ul>
															</li>
														</ul>
														<?php }else if($get_provider_plan == 'Silver Membership'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __( $get_provider_plan, 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																<ul class="sub-menu add-listing-submenu">
																	<!--<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>-->
																
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO GOLD', 'themesdojo' )); ?></a></li>
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO PLATINUM', 'themesdojo' )); ?></a></li>
																	
																	
																</ul>
															</li>
														</ul>
														<?php }else if($get_provider_plan == 'Gold Membership'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __( $get_provider_plan, 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																<ul class="sub-menu add-listing-submenu">
																	<!--<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>-->
																
																
																	<li><a href="<?php $new_company = home_url('/')."provider-plan"; echo $new_company; ?>"><i class="fa fa-briefcase"></i><?php printf( __( 'UPGRADE TO PLATINUM', 'themesdojo' )); ?></a></li>
																	
																	
																</ul>
															</li>
														</ul>
														<?php }else if($get_provider_plan == 'Platinum Membership'){
														?>
														<ul class="menu">
															<li><a href="#" class="button-ag-full"><?php printf( __( $get_provider_plan, 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																
															</li>
														</ul>






														<?php
																}
														}
														?>
														<?php
														global $current_user;
														$key = 'account_type';
														$single = true;
														$td_user_id = $current_user->ID;
														$user_account_type = get_user_meta( $td_user_id, $key, $single );
														if($user_account_type == "job-seeker") {
															global $current_user;
															$td_user_id = $current_user->ID;
															$resume = $wpdb->get_results( "SELECT DISTINCT ID FROM `{$wpdb->prefix}posts` WHERE post_type = 'resume' and (post_status = 'publish' or post_status = 'draft' or post_status = 'pending') and post_author = '".$td_user_id."' ");
															if(empty($resume)) {
																?>
																<ul class="menu">
																	<li><a href="#" class="button-ag-full"><?php printf( __( 'REGISTER', 'themesdojo' )); ?><i class="fa fa-plus-circle"></i></a>
																		<ul class="sub-menu add-listing-submenu">
																			<img class="sub-menu-top-corner" src="<?php echo get_template_directory_uri(); ?>/images/sub-menu-corner.png"/>
																			<?php if (the_slug_exists('add-resume')) { ?>
																			<li><a href="<?php $new_resume = home_url('/')."add-resume"; echo $new_resume; ?>"><i class="fa fa-file-text-o"></i><?php printf( __( 'Carer', 'themesdojo' )); ?></a></li>
																			<?php } ?>
																		</ul>
																	</li>
																</ul>
																<?php } ?>
																<?php } ?>
																<?php } ?>
																<?php } ?>
															</span>
															<?php } ?>
															<div class="main_menu">
																<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => 'false')); ?>
															</div>
														</div>
													</div>
												</header>