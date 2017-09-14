<?php
/**
 * Template name: Test Meta Value
 */

get_header(); 


		$id = 1;

	 
		$rating = 2;
	
	
		$current_post_id = 11913;
	
	 $current_time = date('Y-m-d');

	 if ( is_user_logged_in() ){
		$current_user = wp_get_current_user();
		$usernameget = $current_user->user_login;
		$login_user_id = $current_user->ID;

		global $wpdb;						
		$current_user_posts = $wpdb->get_results( "select id from wp_provider_rating where user_id = '".$login_user_id."' and post_id = '".$current_post_id."' limit 0,2");

		echo '<pre>';

		print_r($current_user_posts);

		if(empty($current_user_posts)){
			 $wpdb->query( "insert into wp_provider_rating (rating_type,user_id,post_id,rating,add_time) values ('".$id."','".$login_user_id."','".$current_post_id."','".$rating."','".$current_time."' )");
			 if($id == 1){
				$key = 'first';
			 }else if($id == 2){
				$key = 'second';
			 }else if($id == 3){
				$key = 'third';
			 }else if($id == 4){
				$key = 'four';
			 }else if($id == 5){
				$key = 'five';
			 }
				
			 $results = $wpdb->get_results( " SELECT rating, COUNT( rating ) AS count_value FROM wp_provider_rating where rating_type = '".$id."' GROUP BY rating ORDER BY rating ASC ");

			 	echo '<pre>';

		print_r($results);
			 $total = 0;
			 $count = 0;
			 foreach($results as $object=>$result){
				$total += $result->rating * $result->count_value;
				$count += $result->count_value;
			 }

			 $average =  $total / $count;

			
			 $meta_key_total = 'provider_'.$key.'rating_total';
			 $meta_key_averate = 'provider_'.$key.'rating_average';

			 update_post_meta( $current_post_id, $meta_key_averate, $average );
			 update_post_meta( $current_post_id, $meta_key_total, $count );

		}




	}

	if($id == 1){
				$key = 'first';
			 }else if($id == 2){
				$key = 'second';
			 }else if($id == 3){
				$key = 'third';
			 }else if($id == 4){
				$key = 'four';
			 }else if($id == 5){
				$key = 'five';
			 }
	 $meta_key_total = 'provider_'.$key.'rating_total';
	 $meta_key_averate = 'provider_'.$key.'rating_average';

	$get_value_average = get_post_meta( $current_post_id, $meta_key_averate);
	$get_value_total = get_post_meta( $current_post_id, $meta_key_total, true);

	print_r($get_value_average);
	print_r($get_value_total);