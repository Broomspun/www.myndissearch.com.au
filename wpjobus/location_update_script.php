<?php
/**
Template Name: Location Update Script
 */

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

get_header(); 

?>

    

	<section id="page-title">

		<?php
		$l=1;
		global $post;
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		//$paged=2;
		/*$companyidsin=array(
11412,11388,11269,11253,11203,11059,10924,10677,10661,10631,10606,10592,10529,10284,10198,10197,10145,10102,9971,9938,
9931,9907,9888,9827,9801,9738,9601,9490,9303,9273,9202,9187,9161,9113,9059,9045,8977,8969,8951,8730,8725,8645,8630,8556,8466,8339,8097,8090
,8021,7912,7832,7823,7679,7661,7648,7465,7242,7232,6964,6896,6872,6839,6810,6796,6751,6744,6672,6653,6499,6498
,6407,6245,6082,6030,5905,5745,5666,5545,5527,5338,5261,5174
);
*/
		$args = array( 'posts_per_page' =>50, 'post_type'=>'company','paged'=>$paged );  
		$the_query = new WP_Query( $args );

		$myposts = get_posts( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
		
		$wpjobus_company_address=get_post_meta(get_the_ID(), 'wpjobus_company_address',true);
		if(!empty($wpjobus_company_address) && $wpjobus_company_address!='test' && $wpjobus_company_address!='CONFIDENTIAL')
		{
		echo '<li>'.$l.'-'.$wpjobus_company_address.'  '.get_the_ID().'</li>';
		echo '<li>'.getlatlong($wpjobus_company_address).'</li>';
		
		$exp_ar=explode(',',getlatlong($wpjobus_company_address));
		$latitude=$exp_ar[0];
		$longitude=$exp_ar[1];
		//update_post_meta(get_the_ID(),'wpjobus_company_googleaddress',$wpjobus_company_address);
		//update_post_meta(get_the_ID(),'wpjobus_company_latitude',$latitude);
		//update_post_meta(get_the_ID(),'wpjobus_company_longitude',$longitude);
		$l++;
		}



		endwhile;
		
      if (function_exists(custom_pagination)) {
        custom_pagination($the_query->max_num_pages,"",$paged);
      }
   
		wp_reset_postdata();
		
		
		
		?>

	</section>

<?php
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}
function getlatlong($dlocation)
{
	$address = $dlocation; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&key=AIzaSyBjbJkxJP94Km86KgKYKtXH3U1-Hi1sM08&sensor=false');
		//print_r($geocode);
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
		return $latitude.','.$longitude;
	
}

 get_footer(); 


?>