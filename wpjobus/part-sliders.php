<?php 

if(isset($post)) {

	$page = get_page($post->ID);
	$td_current_page_id = $page->ID;

} else {
	$td_current_page_id = "";
}

$page_slider = get_post_meta($td_current_page_id, 'page_slider', true); 

?>

			<?php if($page_slider == "LayerSlider") : ?>

				<!-- Parallax Container -->
				<div id="layerslider">


					<?php

						$page_layer_slider_shortcode = get_post_meta($td_current_page_id, 'layerslider_shortcode', true);

						if(!empty($page_layer_slider_shortcode))
						{
					?>

					<?php echo do_shortcode($page_layer_slider_shortcode); ?>

					<?php } else { ?>

					<?php echo do_shortcode('[layerslider id="1"]'); ?>

					<?php } ?>

				</div>	
				<!-- End Parallax Container -->

			<?php elseif ($page_slider == "Search with map") : ?>

				<section id="big-map">

					<div id="wpjobus-main-map-preloader"><div class="loading-map"><i class="fa fa-spinner fa-spin"></i></div></div>

					<div id="wpjobus-main-map" style="float: left;"></div>

											<div class="container"> 
					
					
					<div id="search-widget">



							<div class="resume-skills" style="padding-bottom: 0;">

								<div class="full" style="margin-bottom: 0;">

									<ul id="homepage-posts-block" class="tabs-search quicktabs-tabs quicktabs-style-nostyle"> 
									    <li class="grid-feat-ad-style active"><a class="current" href="#"><i class="fa fa-bullhorn"></i><?php _e( 'Jobs Search', 'themesdojo' ); ?></a></li>
									   	<li class="list-feat-ad-style"><a class="" href="#"><i class="fa fa-file-text-o"></i><?php _e( 'SEARCH CARER', 'themesdojo' ); ?></a></li>
									   	<li class="list-feat-ad-style"><a class="" href="#"><i class="fa fa-briefcase"></i><?php _e( 'SEARCH PROVIDER', 'themesdojo' ); ?></a></li>
						            </ul>

						            <div class="pane" style="display: block;">

							            <div class="full" style="margin-bottom: 30px;">
											<h1 class="resume-section-title" style="margin-bottom: 10px; margin-top: 0; display: none;"><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></h1>
											<h3 class="resume-section-subtitle" style="margin-bottom: 0; margin-top: 0;"><?php _e( '' ); ?></h3>
										</div>

						            	<div class="full" style="padding-top: 30px; margin-bottom: 0; border-top: solid 1px #ecf0f1;">

						            		<form action="<?php echo home_url('/'); ?>jobs" method="get" id="search-jobs-form" accept-charset="UTF-8">

							            		<div class="one_fourth first" style="margin-bottom: 0">

							            			<input type="text" name="keyword" id="fullName" value="" class="input-textarea" placeholder="<?php _e( 'Keyword', 'themesdojo' ); ?>" style="margin-bottom: 0;"/>

							            		</div>

							            		<div class="one_fourth" style="margin-bottom: 0">

							            			<select name="job_location" id="job_location" style="width: 100%; margin-bottom: 0;">
							            				<option value='all' ><?php _e( 'Any Location', 'themesdojo' ); ?></option>
														<?php 
															global $redux_demo, $td_job_location; 
														//	for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
														?>
														
														<?php 
														/*<option value='<?php echo $redux_demo['resume-locations'][$i]; ?>' ><?php echo $redux_demo['resume-locations'][$i]; ?></option> */
														?>
														<?php 
															//}
														?>
													</select>

							            		</div>

							            		<div class="one_fourth" style="margin-bottom: 0">

							            			<select name="job_type" id="job_type" style="width: 100%; margin-bottom: 0;">
							            				<option value='all' ><?php _e( 'Any type', 'themesdojo' ); ?></option>
														<?php 
															global $redux_demo, $td_job_location; 
															for ($i = 0; $i < count($redux_demo['job-type']); $i++) {
														?>
														<option value='<?php echo $redux_demo['job-type'][$i]; ?>' ><?php echo $redux_demo['job-type'][$i]; ?></option>
														<?php 
															}
														?>
													</select>

							            		</div>

							            		<div class="one_fourth" style="margin-bottom: 0">

							            			<span onclick="document.getElementById('search-jobs-form').submit(); return false;" id="comp-reset" class="button-ag-full homepage-search-button" style="width: 100%; text-align: center;" ><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></span>

							            		</div>

							            	</form>

						            	</div>

						            </div>

						            <div class="pane" style="display: block;">

						            	<div class="full" style="margin-bottom: 30px;">
											<h1 class="resume-section-title" style="margin-bottom: 10px; margin-top: 0; display: none;"><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></h1>
											<h3 class="resume-section-subtitle" style="margin-bottom: 0; margin-top: 0;"><?php _e( '', 'themesdojo' ); ?></h3>
										</div>

						            	<div class="full" style="padding-top: 30px; margin-bottom: 0; border-top: solid 1px #ecf0f1;">

						            		<form action="<?php echo home_url('/'); ?>resumes" method="get" id="search-resumes-form" accept-charset="UTF-8">

							            		<div class="one_fourth first" style="margin-bottom: 0">

							            			<input type="text" name="keyword" id="fullName" value="" class="input-textarea" placeholder="<?php _e( 'Keyword', 'themesdojo' ); ?>" style="margin-bottom: 0;"/>

							            		</div>

							            		<div class="one_fourth" style="margin-bottom: 0">

							            			<select name="resume_location" id="job_location" style="width: 100%; margin-bottom: 0;">
							            				<option value='all' ><?php _e( 'Any Location', 'themesdojo' ); ?></option>
														<?php 
															global $redux_demo, $td_job_location; 
														//	for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
														?>
														<?php /*<option value='<?php echo $redux_demo['resume-locations'][$i]; ?>' ><?php echo $redux_demo['resume-locations'][$i]; ?></option> */ ?>
														<?php 
														//	}
														?>
													</select>

							            		</div>

							            		<div class="one_fourth" style="margin-bottom: 0">

							            		
													<input type="text" class="form-control" name="availability" id="availabilty_cal" value="" placeholder="body">

							            		</div>

							            		<div class="one_fourth" style="margin-bottom: 0">

							            			<span onclick="document.getElementById('search-resumes-form').submit(); return false;" id="comp-reset" class="button-ag-full homepage-search-button" style="width: 100%; text-align: center;" ><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></span>

							            		</div>

							            	</form>

						            	</div>

						            </div>

						            <div class="pane" style="display: block;">

						            	<div class="full" style="margin-bottom: 30px;">
											<h1 class="resume-section-title" style="margin-bottom: 10px; margin-top: 0; display: none;"><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></h1>
											<h3 class="resume-section-subtitle" style="margin-bottom: 0; margin-top: 0;"><?php _e( '', 'themesdojo' ); ?></h3>
										</div>

						            	<div class="full" style="padding-top: 30px; margin-bottom: 0; border-top: solid 1px #ecf0f1;">

						            		<form action="<?php echo home_url('/'); ?>companies" method="get" id="search-companies-form" accept-charset="UTF-8">

							            		<div class=" first" style="margin-bottom: 0">

							            			<input type="text" name="keyword" id="fullName" value="" class="input-textarea" placeholder="<?php _e( 'Keyword', 'themesdojo' ); ?>" style="margin-bottom: 0;"/>

							            		</div>

							            		<div class="" style="margin-bottom: 0">

							            			<select name="company_location" id="job_location" style="width: 100%; margin-bottom: 0;">
							            				<option value='all' ><?php _e( 'Any Location', 'themesdojo' ); ?></option>
														<?php 
														global $wpdb;
														$suburbdata = $wpdb->get_results("SELECT * FROM suburb");
															global $redux_demo, $td_job_location; 
															foreach ($suburbdata as $key => $value) {
									?>
									<option value='<?php echo $value->suburbname; ?>'><?php echo $value->suburbname; ?></option>
									<?php
								}
															///for ($i = 0; $i < count($redux_demo['resume-locations']); $i++) {
														?>
														<?php /* <option value='<?php echo $redux_demo['resume-locations'][$i]; ?>' ><?php echo $redux_demo['resume-locations'][$i]; ?></option> */ ?>
														<?php 
														//	}
														?>
													</select>

							            		</div>

							            		<div class="" style="margin-bottom: 0">

							            				<select name="company_industry" id="job_type" style="width: 100%; margin-bottom: 0;">
							            				<option value='all' ><?php _e( 'Any Service', 'themesdojo' ); ?></option>
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

												<div class="" style="margin-bottom: 0">

							            		<input type="text" class="form-control" name="availability" id="availabilty_cal_provider" value="" placeholder="body">

							            		</div>

							            		<div class="" style="margin-bottom: 0">

							            			<span onclick="document.getElementById('search-companies-form').submit(); return false;" id="comp-reset" class="button-ag-full homepage-search-button" style="width: 100%; text-align: center;" ><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></span>

							            		</div>

							            	</form>

						            	</div>

						            </div>

								</div>

							</div>

						</div>

					</div>

					<div id="big-map-holder">

						<script type="text/javascript">
						var mapDiv,
							map,
							infobox;
						jQuery(document).ready(function($) {

							mapDiv = $("#wpjobus-main-map");
							mapDiv.height(500).gmap3({
								map: {
									options: {
										"draggable": true
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

											global $td_companies_per_page, $td_total_companies, $td_total_pages, $td_current_page;

											$td_total_companies = 0;

											$td_current_page = max(1, get_query_var('paged'));

											$wpjobus_companies = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}posts` WHERE (post_type = 'company' or post_type = 'job' or post_type = 'resume') and post_status = 'publish' ORDER BY `ID` DESC");

											$current_pos = -1; 

											$current_element_id = 0;

											foreach($wpjobus_companies as $q) {	

												$current_pos++;

												$current_element_id++;

												$company_id = $q->ID;

												if(get_post_type( $company_id ) == "company") {
													
													

													$wpjobus_company_profile_picture = esc_attr(get_post_meta($company_id, 'wpjobus_company_profile_picture',true));
													$wpjobus_company_fullname = esc_attr(get_post_meta($company_id, 'wpjobus_company_fullname',true));
													$company_location = esc_attr(get_post_meta($company_id, 'company_location',true));
													$wpjobus_company_foundyear = esc_attr(get_post_meta($company_id, 'wpjobus_company_foundyear',true));
													$td_company_team_size = esc_attr(get_post_meta($company_id, 'company_team_size',true));

													$wpjobus_company_longitude = get_post_meta($company_id, 'wpjobus_company_longitude',true);
													$wpjobus_company_latitude = get_post_meta($company_id, 'wpjobus_company_latitude',true);


													$iconPath = get_template_directory_uri() .'/images/icon-company.png';

													$companylink = home_url('/')."company/".$company_id;
													
													$wpjobus_company_address=esc_attr(get_post_meta($company_id, 'wpjobus_company_address',true));
													//$get_lat_long_location=get_lat_long_location($wpjobus_company_address);

												} elseif(get_post_type( $company_id ) == "job") {

													$wpjobus_company_fullname = esc_attr(get_post_meta($company_id, 'wpjobus_job_fullname',true));
													$wpjobus_company_longitude = get_post_meta($company_id, 'wpjobus_job_longitude',true);
													$wpjobus_company_latitude = get_post_meta($company_id, 'wpjobus_job_latitude',true);
													$td_job_company = esc_attr(get_post_meta($company_id, 'job_company',true));
													$wpjobus_company_profile_picture = esc_attr(get_post_meta($td_job_company, 'wpjobus_company_profile_picture',true));

													$iconPath = get_template_directory_uri() .'/images/icon-job.png';

													$companylink = home_url('/')."job/".$company_id;

												} elseif(get_post_type( $company_id ) == "resume") {

													$wpjobus_company_fullname = esc_attr(get_post_meta($company_id, 'wpjobus_resume_fullname',true));
													$wpjobus_company_longitude = get_post_meta($company_id, 'wpjobus_resume_longitude',true);
													$wpjobus_company_latitude = get_post_meta($company_id, 'wpjobus_resume_latitude',true);
													$wpjobus_company_profile_picture = esc_attr(get_post_meta($company_id, 'wpjobus_resume_profile_picture',true));

													$iconPath = get_template_directory_uri() .'/images/icon-resume.png';

													$companylink = home_url('/')."resume/".$company_id;

												} 

												if(!empty($wpjobus_company_latitude)) {

										?> 
											{
												

												latLng: [<?php echo $wpjobus_company_latitude; ?>,<?php echo $wpjobus_company_longitude; ?>],
												options: {
													icon: "<?php echo $iconPath; ?>",
													shadow: "<?php echo get_template_directory_uri() ?>/images/shadow.png",
												},
												data: '<div class="marker-holder"><div class="marker-content"><div class="marker-image"><span class="helper"></span><img src="<?php echo $wpjobus_company_profile_picture; ?>" /></div><div class="marker-info-holder"><div class="marker-info"><div class="marker-info-title"><?php echo $wpjobus_company_fullname; ?></div><div class="marker-info-link"><a href="<?php echo $companylink; ?>"><?php _e( "View Profile", "themesdojo" ); ?></a></div></div></div><div class="arrow-down"></div><div class="close"></div></div></div>'

											}
										,

										<?php } } ?>
										
									],
									options:{
										draggable: false
									},
									cluster:{
						          		radius: 20,
										// This style will be used for clusters with more than 0 markers
										0: {
											content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
											width: 62,
											height: 62
										},
										// This style will be used for clusters with more than 20 markers
										20: {
											content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
											width: 82,
											height: 82
										},
										// This style will be used for clusters with more than 50 markers
										50: {
											content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
											width: 102,
											height: 102
										},
										events: {
											click: function(cluster) {
												map.panTo(cluster.main.getPosition());
												map.setZoom(map.getZoom() + 2);
											}
										}
						          	},
									events: {
										click: function(marker, event, context){
											map.panTo(marker.getPosition());

											var ibOptions = {
											    pixelOffset: new google.maps.Size(-125, -88),
											    alignBottom: true
											};

											infobox.setOptions(ibOptions)

											infobox.setContent(context.data);
											infobox.open(map,marker);

											// if map is small
											var iWidth = 260;
											var iHeight = 300;
											if((mapDiv.width() / 2) < iWidth ){
												var offsetX = iWidth - (mapDiv.width() / 2);
												map.panBy(offsetX,0);
											}
											if((mapDiv.height() / 2) < iHeight ){
												var offsetY = -(iHeight - (mapDiv.height() / 2));
												map.panBy(0,offsetY);
											}

										}
									}
								}
							},"autofit");

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

					</div>

				</section>

			<?php elseif ($page_slider == "Search with parallax") : ?>

				<section id="header-cover-image" >
				<div class="container">

					<div id="search-widget">

							<div class="resume-skills" style="padding-bottom: 0;">

								<div class="full" style="margin-bottom: 0;">

									<ul id="homepage-posts-block" class="tabs-search quicktabs-tabs quicktabs-style-nostyle"> 
									 <!--   <li class="grid-feat-ad-style active"><a class="current" href="#"><i class="fa fa-bullhorn"></i><?php _e( 'Jobs Search', 'themesdojo' ); ?></a></li>
									   	<li class="list-feat-ad-style"><a class="" href="#"><i class="fa fa-file-text-o"></i><?php _e( 'SEARCH CARER', 'themesdojo' ); ?></a></li>-->


<?php 

global $post; if($post->ID == 3128):  

?>

<li class="list-feat-ad-style active"><a class="" href="#"><i class="fa fa-briefcase"></i><?php _e( 'SEARCH JOBS', 'themesdojo' ); ?></a></li>


<?php elseif($post->ID == 3124): ?>


<li class="list-feat-ad-style active"><a class="" href="#"><i class="fa fa-briefcase"></i><?php _e( 'SEARCH CARER', 'themesdojo' ); ?></a></li>


<?php else: ?>

<li class="list-feat-ad-style active"><a class="" href="#"><i class="fa fa-briefcase"></i><?php _e( 'SEARCH PROVIDER', 'themesdojo' ); ?></a></li>



<?php endif; ?>
						            


</ul>

<?php
if($post->ID == 3128){
?>
									

						            <div class="pane dbomla" style="display: block;">

							            <div class="full" style="margin-bottom: 30px;">
											<h1 class="resume-section-title" style="margin-bottom: 10px; margin-top: 0; display: none;"><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></h1>
											<h3 class="resume-section-subtitle" style="margin-bottom: 0; margin-top: 0;"><?php _e( '', 'themesdojo' ); ?></h3>
										</div>

						            	<div class="full" style="padding-top: 30px; margin-bottom: 0; border-top: solid 1px #ecf0f1;">

						            		<?php
						            		searchformjob();
						            		?>

						            	</div>

						            </div>
<?php

 }elseif($post->ID == 3124){
?>
						            <div class="pane dbomla" style="display: block;">

						            	<div class="full" style="margin-bottom: 30px;">
											<h1 class="resume-section-title" style="margin-bottom: 10px; margin-top: 0; display: none;"><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></h1>
											<h3 class="resume-section-subtitle" style="margin-bottom: 0; margin-top: 0;"><?php _e( '', 'themesdojo' ); ?></h3>
										</div>

						            	<div class="full" style="padding-top: 30px; margin-bottom: 0; border-top: solid 1px #ecf0f1;">

						            		<?php
						            		searchformcarer();
						            		?>

						            	</div>

						            </div>

<?php
}else{
?>
<div class="pane" style="display: block;">	

						            	<div class="full" style="margin-bottom: 30px;">
											<h1 class="resume-section-title" style="margin-bottom: 10px; margin-top: 0; display: none;"><i class="fa fa-search"></i><?php _e( 'Search', 'themesdojo' ); ?></h1>
											<h3 class="resume-section-subtitle" style="margin-bottom: 0; margin-top: 0;"><?php _e( '', 'themesdojo' ); ?></h3>
										</div>

						            	<div class="full" style="padding-top: 30px; margin-bottom: 0; border-top: solid 1px #ecf0f1;">

						            		<?php
						            		formtoshowmy();
						            		?>

						            	</div>

		 </div>






<?php
}
?>






						            					          

								</div>

							</div>

						</div>

					</div>

					<div class="coverImageHolder">
						
						<?php
						
						

							$parallax_image_url = get_post_meta($td_current_page_id, 'parallax_image_url', true);

							if(!empty($parallax_image_url))
							{
						?>
							<img src="<?php echo $parallax_image_url; ?>" alt="" class="bgImg" style="top: 0px;">

						<?php } ?>
					</div>

				</section>

			<?php endif; ?>
			
			
			<?php 
			//$wpjobus_company_address=get_post_meta(11913, 'wpjobus_company_address',true);
			//echo $wpjobus_company_address.'test';
			//$get_lat_long_location=get_lat_long_location($wpjobus_company_address);
			//echo $get_lat_long_location.'kirti';
			?>
			
			