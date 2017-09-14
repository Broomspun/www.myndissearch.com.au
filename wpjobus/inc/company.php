<?php

	function post_type_company() {
		$labels = array(
	    	'name' => _x('Companies', 'post type general name', 'themesdojo'),
	    	'singular_name' => _x('Companies', 'post type singular name', 'themesdojo'),
	    	'add_new' => _x('Add New Company', 'book', 'themesdojo'),
	    	'add_new_item' => __('Add New Company', 'themesdojo'),
	    	'edit_item' => __('Edit Company', 'themesdojo'),
	    	'new_item' => __('New Company', 'themesdojo'),
	    	'view_item' => __('View Company', 'themesdojo'),
	    	'search_items' => __('Search Companies', 'themesdojo'),
	    	'not_found' =>  __('No Companies found', 'themesdojo'),
	    	'not_found_in_trash' => __('No Companies found in Trash', 'themesdojo'), 
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

		register_post_type( 'company', $args );						  
	} 
									  
	add_action('init', 'post_type_company');


?>