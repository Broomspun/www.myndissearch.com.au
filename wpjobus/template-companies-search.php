<?php
/**
* Template name: Companies Search Template
*/
$page = get_page($post->ID);
$td_current_page_id = $page->ID;
get_header();
include (get_template_directory() . "/part-sliders.php");

	
?>
<section id="blog" class="company-search" style="padding-top: 0; margin-top: 0px;">
	<div class="container">
		<div class="resume-skills">
		
				<div class="two_third first">
					<div class="full">
						<h1 class="resume-section-title"><i class="fa fa-search"></i><?php _e( 'Search for NDIS Providers', 'themesdojo' ); ?></h1>
						<h3 class="resume-section-subtitle" style="margin-bottom: 0;"><?php _e( 'Find the right NDIS Provider for your healthcare and disability requirements.', 'themesdojo' ); ?></h3>
					</div>
					<!--<div class="full" style="margin-bottom: 0;">
						<div class="loading"><i class="fa fa-spinner fa-spin"></i></div>
					</div>-->
					<div id="companies-block">
						<ul id="companies-block-list-ul">
							<?php
							/*echo '<pre>';
							print_r($wp_query);
							echo '</pre>';
							exit;*/
							$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
							$args = array(
										'post_type' => 'company',
										'posts_per_page' => 10,
										'paged' => $paged,
										'meta_key' => 'wpjobus_company_fullname',
										'orderby'   => 'meta_value',
        								'order' => 'asc',
										
								);
							$args['meta_query'] =array();
							$args['meta_query']['relation'] = 'AND';
							if($_REQUEST['keyword']!=''){
								$args['s'] = $_REQUEST['keyword'];
							}
							if($_REQUEST['company_location']!=''){
								$args['meta_query'][] = array(
																'key'     => 'company_location',
																'value'   => $_REQUEST['company_location'],
																'compare' => '=',
															);
							}
							if($_REQUEST['company_industry']!=''){
								$args['meta_query'][] = array(
																'key'     => 'wpjobus_company_services',
																'value'   => $_REQUEST['company_industry'],
																'compare' => 'LIKE',
															);
							}
							if($_REQUEST['company_rating']!=''){
								$args['meta_query'][] = array(
																'key'     => 'mr_rating_results_star_rating_new',
																'value'   => $_REQUEST['company_rating'],
																'compare' => '=',
															);
							}
							if (!empty($_REQUEST['availability'])){
							function availability_search_filter($join) {
								global $wp_query, $wpdb;

								if (!empty($_REQUEST['availability'])) {
									 $join .= " LEFT JOIN $wpdb->postmeta m10 ON $wpdb->posts.ID = m10.post_id ";
									 $join .= ' LEFT JOIN  `wp_wpdevart_dates` m5 ON m10.meta_value = m5.calendar_id LEFT JOIN  `wp_wpdevart_dates` m6 ON m10.meta_value = m6.calendar_id ';
	
								}

								return $join;
							}

							add_filter('posts_join', 'availability_search_filter');


							function availability_search_whereString( $where, $wp_query )
							{
								global $wpdb;
								if (!empty($_REQUEST['availability'])){
									$type_availability = $_GET['availability'];

									 $where .= " AND m10.meta_key = 'wpjobus_company_calendar_shortcode_id' AND m5.day = '".$type_availability."' and m5.data NOT LIKE '%booked%' AND  m6.data NOT LIKE '%unavailable%' ";

									

									
									return $where;
								}
							}

							add_filter( 'posts_where', 'availability_search_whereString', 10, 2 );
							}
							

							
							
							
						
		


							$the_query = new WP_Query( $args );
					

					
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									$company_id = get_the_id();
									$wpjobus_company_profile_picture = esc_url(get_post_meta($company_id, 'wpjobus_company_profile_picture',true));
									$wpjobus_company_fullname = esc_attr(get_post_meta($company_id, 'wpjobus_company_fullname',true));
									$company_location = esc_attr(get_post_meta($company_id, 'company_location',true));
									$wpjobus_company_foundyear = esc_attr(get_post_meta($company_id, 'wpjobus_company_foundyear',true));
									$td_company_team_size = esc_attr(get_post_meta($company_id, 'company_team_size',true));
									$wpjobus_company_longitude = esc_attr(get_post_meta($company_id, 'wpjobus_company_longitude',true));
									$wpjobus_company_latitude = esc_attr(get_post_meta($company_id, 'wpjobus_company_latitude',true));
									$iconPath = get_template_directory_uri() .'/images/icon-company.png';
									?>
										<li id="<?php echo $current_element_id; ?>" data-longitude="<?php echo esc_attr( $wpjobus_company_longitude ); ?>" data-latitude="<?php echo esc_attr( $wpjobus_company_latitude ); ?>" data-thumb="<?php echo esc_url($wpjobus_company_profile_picture); ?>" data-title="<?php echo esc_attr($wpjobus_company_fullname); ?>" data-label="<?php echo esc_url($iconPath); ?>" data-link="<?php $companylink = home_url('/')."company/".$company_id; echo esc_url($companylink); ?>" data-text="<?php _e( "View Profile", "themesdojo" ); ?>">
									<a href="<?php $companylink = home_url('/')."company/".$company_id; echo $companylink; ?>">
										<div class="company-holder-block">
											<span class="company-list-icon">
												<span class="helper"></span>
												
												<?php if($wpjobus_company_profile_picture != ""){ ?>
											<img src="<?php echo $wpjobus_company_profile_picture; ?>" alt="<?php echo $wpjobus_company_fullname; ?>" />
											<?php }else{ ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/logo-small.png" alt="<?php echo $wpjobus_company_fullname; ?>" />
											<?php } ?>

											</span>
											<span class="company-list-name-block">
												<span class="company-list-name"><?php echo $wpjobus_company_fullname; ?></span>
												<span class="company-list-location"><i class="fa fa-map-marker"></i><?php echo $company_location; ?>
												</span>
											</span>
											<span class="company-list-view-profile">
												<span class="company-view-profile">
													<span class="company-view-profile-title-holder">
														<span class="company-view-profile-title"><?php _e( 'See', 'themesdojo' ); ?></span>
														<span class="company-view-profile-subtitle"><?php _e( 'Profile', 'themesdojo' ); ?></span>
													</span>
													<i class="fa fa-eye"></i>
												</span>
											</span>
											<span class="company-list-badges">
												
												<?php
													$jobs_offer = 0;
													$id = $company_id;
													$querystr = "SELECT DISTINCT ID FROM $wpdb->posts, $wpdb->postmeta WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_company' AND $wpdb->postmeta.meta_value = $id AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'job' AND $wpdb->posts.post_date < NOW() ORDER BY $wpdb->posts.post_date DESC
												";
												
													$pageposts = $wpdb->get_results($querystr, OBJECT);
													$jobs_offer = 0;
												?>
												<?php global $post; ?>
												<?php foreach ($pageposts as $post): ?>
												
												<?php $jobs_offer++; ?>
												<?php endforeach; ?>
												
												<span class="company-jobs-block">
													<i class="fa fa-bullhorn"></i>
													<span class="experience-period"><?php echo $jobs_offer; ?></span>
													<span class="experience-subtitle"><?php if($jobs_offer != 1){ ?><?php _e( 'Jobs', 'themesdojo' ); ?><?php } else { ?><?php _e( 'Job', 'themesdojo' ); ?><?php } ?></span>
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
				<?php /* <div class="one_third">
					<?php
					
						$currentDate = current_time('timestamp');
						$total_jobs = 0;
						$wpjobus_jobs = $wpdb->get_results( "SELECT DISTINCT p.ID
															FROM  `{$wpdb->prefix}posts` p
															LEFT JOIN  `wp_postmeta` m ON p.ID = m.post_id
															WHERE p.post_type = 'company'
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
					<span class="filters-title"><i class="fa fa-star"></i><?php _e( 'Featured Business!', 'themesdojo' ); ?></span>
					<div id="owl-demo" class="owl-carousel owl-theme featured-items">
						<?php foreach($wpjobus_jobs as $job) {
							$curren_job++;
								
							$job_id = $job->ID;
							if($curren_job <= 5) {
						?>
						<div class="item">
							<a href="<?php $link_job = home_url('/')."company/".$job_id; echo $link_job; ?>">
								<div class="featured-item">
									<span class="featured-item-image">
										<?php
											$wpjobus_company_cover_image = esc_url(get_post_meta($job_id, 'wpjobus_company_cover_image',true));
											$wpjobus_company_fullname = esc_attr(get_post_meta($job_id, 'wpjobus_company_fullname',true));
											$wpjobus_company_tagline = esc_attr(get_post_meta($job_id, 'wpjobus_company_tagline',true));
											$wpjobus_company_foundyear = esc_attr(get_post_meta($job_id, 'wpjobus_company_foundyear',true));
											$company_location = esc_attr(get_post_meta($job_id, 'company_location',true));
											$wpjobus_company_profile_picture = esc_url(get_post_meta($job_id, 'wpjobus_company_profile_picture',true));
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
											if(!empty($wpjobus_company_cover_image)) {
												require_once(get_template_directory() . '/inc/BFI_Thumb.php');
												$params = array( 'width' => 340, 'height' => 200, 'crop' => true );
												echo "<img class='big-img' src='" . bfi_thumb( "$wpjobus_company_cover_image", $params ) . "' alt='" . $wpjobus_company_fullname . "'/>";
											} else {
												echo "<span class='featured-image-replacer'><i class='fa fa-briefcase'></i>";
												}
											?>
											<?php if(!empty($wpjobus_company_profile_picture)) { ?>
											<span class="featured-item-content-title-logo">
												<span class="featured-item-content-company-title-logo-img">
													<span class="helper"></span>
													<img src="<?php echo $wpjobus_company_profile_picture; ?>" alt="">
												</span>
											</span>
											<?php } ?>
										</span>
										<span class="featured-item-badge">
											<span class="featured-item-job-badge">
												<span class="featured-item-job-badge-title"><?php _e( 'EST. IN', 'themesdojo' ); ?> <?php echo $wpjobus_company_foundyear; ?></span>
												<span class="featured-item-job-badge-info">
													<span class="featured-item-job-badge-info-sum"><?php echo $total_jobs; ?></span>
													<span class="featured-item-job-badge-info-per"><?php if($total_jobs == 1) { _e( 'Job', 'themesdojo' ); } else { _e( 'Jobs', 'themesdojo' ); } ?></span>
												</span>
											</span>
										</span>
										<span class="featured-item-content">
											<span class="featured-item-content-title"><?php echo $wpjobus_company_fullname; ?></span>
											<span class="featured-item-content-tagline"><?php echo $wpjobus_company_tagline; ?></span>
											<span class="featured-item-content-subtitle">
												<span><i class="fa fa-map-marker"></i><?php echo $company_location; ?></span>
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
								formtoshowmy();
								?>
							</div>
						</div> */ ?>
						
					<script type="text/javascript">
					jQuery(function($) {
						var marker;
						var markers = [];
						/*function initializeMap() {
							var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
							var isDraggable = w > 480 ? true : false;
							var latlng = new google.maps.LatLng( 40.7127837, -74.00594130000002 );
								var mapOptions = {
									zoom: 16,
									height: 500,
									mapTypeControl: false,
									scrollwheel: false,
									needsFit: true,
									isPanned: false,
									formIndex: 0,
									center: latlng,
									draggable: isDraggable,
							}
							map = new google.maps.Map(document.getElementById('wpjobus-main-map'), mapOptions);
							createMarkers();
						}; */
						/*function createMarkers() {
						var oms = new OverlappingMarkerSpiderfier(map, {
							markersWontMove: true,
							markersWontHide: true,
						keepSpiderfied: true
					});
						oms.addListener('unspiderfy', function(spidered, unspidered) {
							for (var i = 0; i < spidered.length; i++) {
							spidered[i].setLabel("" + (i + 1));
							spidered[i].setOptions({
								zIndex: i
							});
							}
						});
						// Clusterer
						var styles = [[{
							url: placesdojoMapSettings.url_theme + '/images/cluster-1.png',
							width: 62, height: 62,
							opt_anchor: [15, 15],
							textColor: '#ffffff',
							textSize: 12
							}, {
							url: placesdojoMapSettings.url_theme + '/images/cluster-2.png',
							width: 82, height: 82,
							opt_anchor: [20, 20],
							textColor: '#ffffff',
							textSize: 14
								}	, {
							url: placesdojoMapSettings.url_theme + '/images/cluster-3.png',
							width: 102, height: 102,
							opt_anchor: [25, 25],
							textColor: '#ffffff',
							textSize: 16
							}, {
							url: placesdojoMapSettings.url_theme + '/images/cluster-3.png',
							width: 102, height: 102,
							opt_anchor: [30, 30],
							textColor: '#ffffff',
							textSize: 16
							}]];
						var markerCluster = new MarkerClusterer(map, markers, {styles: styles[0]});
					minClusterZoom = 14;
							markerCluster.setMaxZoom(minClusterZoom);
							markerCluster.setMap(map);
						var infobox = new InfoBox({
						disableAutoPan: false,
						maxWidth: 244,
						pixelOffset: new google.maps.Size(-126, -160),
						zIndex: null,
						boxStyle: {
						opacity: 1,
						width: "244px",
						height: "94px"
						},
						closeBoxMargin: "28px 26px 0px 0px",
						closeBoxURL: "",
						infoBoxClearance: new google.maps.Size(1, 1),
						pane: "floatPane",
						enableEventPropagation: false
						});
						var self = this;
							var section = jQuery( '#companies-block' ).eq( map.formIndex );
							this.results = {};
							this.items = section.find( '#companies-block-list-ul li' );
							//var marker, i;
						var bounds = new google.maps.LatLngBounds();
						var totalListings = 0;
							jQuery.each( this.items, function(i, el) {
								totalListings++;
								var $el = jQuery(el);
								if ( ! ( $el.data( 'longitude' ) && $el.data( 'latitude' ) ) ) {
									return;
								}
								var data = {
									id:       $el.attr( 'id' ),
									lat:      $el.data( 'latitude' ),
									lng:      $el.data( 'longitude' ),
									thumb:    $el.data( 'thumb' ),
									title:    $el.data( 'title' ),
									link:     $el.data( 'link' ),
									label:    $el.data( 'label' ),
									text:     $el.data( 'text' )
								}
								var siteLatLng = new google.maps.LatLng( data.lat, data.lng );
						var marker = new MarkerWithLabel({
						position: siteLatLng,
						map: map,
						draggable: false,
						title: data.title,
						icon: data.label,
						html:  '<div class="marker-holder"><div class="marker-content"><div class="marker-image"><span class="helper"></span><img src="'+data.thumb+'" /></div><div class="marker-info-holder"><div class="marker-info"><div class="marker-info-title">'+data.title+'</div><div class="marker-info-link"><a href="'+data.link+'">'+data.text+'</a></div></div></div><div class="arrow-down"></div></div></div>'
						});
						google.maps.event.addListener(marker, "click", function () {
									infobox.setContent(this.html);
						infobox.open(map, this);
										});
						google.maps.event.addListener(map, 'click', function() {
								infobox.close();
								});
						bounds.extend(siteLatLng);
						markers.push(marker);
						oms.addMarker(marker);
						markerCluster.addMarker(marker);
							});
					
					map.fitBounds(bounds);
					}*/
						jQuery( "#advance-search-slider" ).slider({
						range: "min",
					/*value: <?php echo $medium; ?>,
						min: <?php echo $min; ?>,
					max: <?php echo $max; ?>,*/
					slide: function( event, ui ) {
					jQuery( "#comp_est_year" ).val( ui.value );
					jQuery( ".comp_est_year_num" ).text( ui.value );
					},
					stop: function() {
					jQuery('#companies_current_page').val('1');
					$.fn.wpjobusSubmitFormFunction();
					
					}
					});
					jQuery("#comp_min_team").focusout(function() {
					jQuery('#companies_current_page').val('1');
					$.fn.wpjobusSubmitFormFunction();
					
					});
					jQuery("#comp_max_team").focusout(function() {
					jQuery('#companies_current_page').val('1');
					$.fn.wpjobusSubmitFormFunction();
					
					});
					jQuery("#comp_keyword").focusout(function() {
					jQuery('#companies_current_page').val('1');
					$.fn.wpjobusSubmitFormFunction();
					
					});
					jQuery("#comp_keyword").keydown(function() {
					if (event.keyCode == 13) {
					jQuery('#companies_current_page').val('1');
					$.fn.wpjobusSubmitFormFunction();
					
					}
					});
					jQuery(document).on("click","#comp-team-submit-clear",function(e){
					jQuery('#comp_min_team').val('');
					jQuery('#comp_max_team').val('');
					});
					jQuery(document).on("click","#comp-reset",function(e){
					jQuery('#comp_min_team').val('');
					jQuery('#comp_max_team').val('');
					jQuery('#comp_keyword').val('');
					jQuery('#companies_current_page').val('1');
					jQuery('.filters-list-category-all').addClass('active');
					jQuery('.company-category-all').val('1');
					jQuery('.filters-list-category-one').removeClass('active');
					jQuery('.company-category').val('');
					jQuery('.filters-list-location-all').addClass('active');
					jQuery('.company-location-all').val('1');
					jQuery('.filters-list-location').removeClass('active');
					jQuery('.company-location').val('');
					jQuery( "#comp_est_year" ).val( '<?php echo $min; ?>' );
					jQuery('.filters-has-jobs-all').addClass('active');
					jQuery('.filters-has-jobs-all-input').val('1');
					jQuery('.filters-has-jobs-yes').removeClass('active');
					jQuery('.filters-has-jobs-yes-input').val('');
					jQuery('.filters-has-jobs-no').removeClass('active');
					jQuery('.filters-has-jobs-no-input').val('');
					jQuery('.filters-lists li').removeClass('active');
					jQuery('.filters-lists input.job_presence_type_option').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					});
					jQuery(document).on("click","ul.filters-lists li.filters-list-one",function(e){
					jQuery('#companies_current_page').val('1');
					
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery(this).find('.job_presence_type_option').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					} else {
					jQuery(this).addClass('active');
					var id = jQuery(this).find('.job_presence_type_option_value').val();
					jQuery(this).find('.job_presence_type_option').val(id);
					jQuery(this).parent().find('.filters-list-all').removeClass('active');
					jQuery(this).parent().find('.filters-list-all .job_presence_type_option').val('');
					jQuery('.filters-has-jobs-yes').addClass('active');
					jQuery('.filters-has-jobs-yes-input').val('1');
					jQuery('.filters-has-jobs-all').removeClass('active');
					jQuery('.filters-has-jobs-all-input').val('');
					jQuery('.filters-has-jobs-no').removeClass('active');
					jQuery('.filters-has-jobs-no-input').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click","ul.filters-lists li.filters-list-all",function(e){
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery(this).find('.job_presence_type_option').val('');
					} else {
					jQuery('#companies_current_page').val('1');
					jQuery(this).addClass('active');
					jQuery(this).find('.job_presence_type_option').val('1');
					jQuery(this).parent().find('.filters-list-one').removeClass('active');
					jQuery(this).parent().find('.filters-list-one .job_presence_type_option').val('');
					jQuery('.filters-has-jobs-yes').addClass('active');
					jQuery('.filters-has-jobs-yes-input').val('1');
					jQuery('.filters-has-jobs-all').removeClass('active');
					jQuery('.filters-has-jobs-all-input').val('');
					jQuery('.filters-has-jobs-no').removeClass('active');
					jQuery('.filters-has-jobs-no-input').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".filters-has-jobs-all",function(e){
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery('.filters-has-jobs-all-input').val('');
					} else {
					jQuery('#companies_current_page').val('1');
					jQuery(this).addClass('active');
					jQuery('.filters-has-jobs-all-input').val('1');
					jQuery('.filters-has-jobs-yes').removeClass('active');
					jQuery('.filters-has-jobs-yes-input').val('');
					jQuery('.filters-has-jobs-no').removeClass('active');
					jQuery('.filters-has-jobs-no-input').val('');
					jQuery('.filters-lists li').removeClass('active');
					jQuery('.filters-lists input.job_presence_type_option').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".filters-has-jobs-yes",function(e){
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery('.filters-has-jobs-yes-input').val('');
					} else {
					jQuery('#companies_current_page').val('1');
					jQuery(this).addClass('active');
					jQuery('.filters-has-jobs-yes-input').val('1');
					jQuery('.filters-has-jobs-all').removeClass('active');
					jQuery('.filters-has-jobs-all-input').val('');
					jQuery('.filters-has-jobs-no').removeClass('active');
					jQuery('.filters-has-jobs-no-input').val('');
					jQuery('.filters-lists li').removeClass('active');
					jQuery('.filters-lists input.job_presence_type_option').val('');
					jQuery('.filters-list-all').addClass('active');
					jQuery('.filters-list-all .job_presence_type_option').val('1');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".filters-has-jobs-no",function(e){
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery('.filters-has-jobs-no-input').val('');
					} else {
					jQuery('#companies_current_page').val('1');
					jQuery(this).addClass('active');
					jQuery('.filters-has-jobs-no-input').val('1');
					jQuery('.filters-has-jobs-yes').removeClass('active');
					jQuery('.filters-has-jobs-yes-input').val('');
					jQuery('.filters-has-jobs-all').removeClass('active');
					jQuery('.filters-has-jobs-all-input').val('');
					jQuery('.filters-lists li').removeClass('active');
					jQuery('.filters-lists input.job_presence_type_option').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".filters-list-category-all",function(e){
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery('.company-category-all').val('');
					} else {
					jQuery('#companies_current_page').val('1');
					jQuery(this).addClass('active');
					jQuery('.company-category-all').val('1');
					jQuery('.filters-list-category-one').removeClass('active');
					jQuery('.company-category').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".filters-list-category-one",function(e){
					jQuery('#companies_current_page').val('1');
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery(this).find('.company-category').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					} else {
					jQuery(this).addClass('active');
					var id = jQuery(this).find('.company-category-value').val();
					jQuery(this).find('.company-category').val(id);
					jQuery(this).parent().find('.filters-list-category-all').removeClass('active');
					jQuery(this).parent().find('.company-category-all').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".filters-list-location-all",function(e){
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery('.company-location-all').val('');
					} else {
					jQuery('#companies_current_page').val('1');
					jQuery(this).addClass('active');
					jQuery('.company-location-all').val('1');
					jQuery('.filters-list-location').removeClass('active');
					jQuery('.company-location').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".filters-list-location",function(e){
					jQuery('#companies_current_page').val('1');
					if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active');
					jQuery(this).find('.company-location').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					} else {
					jQuery(this).addClass('active');
					var id = jQuery(this).find('.company-location-value').val();
					jQuery(this).find('.company-location').val(id);
					jQuery(this).parent().find('.filters-list-location-all').removeClass('active');
					jQuery(this).parent().find('.company-location-all').val('');
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					}
					});
					jQuery(document).on("click",".pagination a.page-numbers",function(e){
					var hrefprim = jQuery(this).attr('href');
					var href = hrefprim.replace("#", "");
					jQuery('#companies_current_page').val(href);
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					});
					jQuery(".pagination a.page-numbers").click(function(e){
					var hrefprim = jQuery(this).attr('href');
					var href = hrefprim.replace("#", "");
					jQuery('#companies_current_page').val(href);
					$.fn.wpjobusSubmitFormFunction();
					
					e.preventDefault();
					return false;
					});
					/*$.fn.wpjobusSubmitFormFunction = function() {
					jQuery('#companies_map_block').val('0');
					$contentheight = jQuery('#companies-block').height(),
					jQuery("html, body").animate({ scrollTop: 0 }, 800);
					jQuery('#wpjobus-companies').ajaxSubmit({
					type: "POST",
					data: jQuery('#wpjobus-companies').serializeArray(),
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					beforeSend: function() {
					jQuery('#wpjobus-main-map-preloader').fadeIn(500);
					jQuery('.loading').fadeIn(500);
					jQuery('#companies-block').stop().animate({'opacity' : '0'}, 250, function() {
					jQuery('#companies-block').css('height', $contentheight);
					});
					},
					success: function(response) {
					jQuery('#wpjobus-main-map-preloader').fadeOut(100);
					jQuery('.loading').fadeOut(100, function(){
					jQuery("#companies-block").html(response);
					jQuery("#companies-block").css('height', 'auto');
					jQuery("#companies-block").stop().animate({'opacity' : '1'}, 250);
					jQuery('#companies-block-list-ul').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
					if (isInView) {
					// element is now visible in the viewport
					if (jQuery(this).hasClass('animated-list')) {
					
					} else {
					jQuery(this).addClass('animated-list');
					jQuery('#companies-block-list-ul li').each(function(i) {
					var $li = jQuery(this);
					setTimeout(function() {
					$li.addClass('animate');
					}, i*100); // delay 150 ms
					});
					}
					}
					});
					initializeMap()
					createMarkers();
					});
					return false;
					}
					});
					}*/
					});
					</script>
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
				<div class="one_third one_t_bg <?php if($td_current_post == 1) { ?>first<?php } ?>" style="text-align: center; margin-bottom: 0;">
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
					<div class="blog_cont_bg">
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
				</div>
				<?php } endwhile; ?>
				
				<?php $wp_query = null; $wp_query = $temp;?>
				
			</div>
		</section>
		<div class="container">
			<div class="row">
				<div class='col-sm-6'>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker1'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<script type="text/javascript">
				/*  $(function () {
				$('#datetimepicker1').datetimepicker();
				});*/
				</script>
			</div>
		</div>
		<?php get_footer(); ?>