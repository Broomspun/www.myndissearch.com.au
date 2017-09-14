<?php

	function post_type_jobs() {
		$labels = array(
	    	'name' => _x('Jobs', 'post type general name', 'themesdojo'),
	    	'singular_name' => _x('Jobs', 'post type singular name', 'themesdojo'),
	    	'add_new' => _x('Add New Job', 'book', 'themesdojo'),
	    	'add_new_item' => __('Add New Job', 'themesdojo'),
	    	'edit_item' => __('Edit Job', 'themesdojo'),
	    	'new_item' => __('New Job', 'themesdojo'),
	    	'view_item' => __('View Job', 'themesdojo'),
	    	'search_items' => __('Search Jobs', 'themesdojo'),
	    	'not_found' =>  __('No Jobs found', 'themesdojo'),
	    	'not_found_in_trash' => __('No Jobs found in Trash', 'themesdojo'), 
	    	'parent_item_colon' => ''
		);		
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
	    	'publicly_queryable' => true,
	    	'show_ui' => true, 
	    	'query_var' => true,
	    	'rewrite' => true,
	    	'capability_type' => 'post',
	    	'hierarchical' => false,
	    	'menu_position' => null,
	    	'supports' => array('thumbnail'),
	    	'menu_icon' => 'dashicons-menu'
		); 		

		register_post_type( 'job', $args );						  
	} 
									  
	add_action('init', 'post_type_jobs');


?>