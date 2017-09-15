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
	    	'menu_icon' => 'dashicons-menu',
            'taxonomies' => array( 'area' )
		); 		

		register_post_type( 'company', $args );
        flush_rewrite_rules();
	}

function areas_register_taxonomies() {

    $labels = array(
        'name'              => __('All Areas','themesdojo'),
        'singular_name'     => __('Name of Area','themesdojo'),
        'search_items'      => __('Search Areas','themesdojo'),
        'all_items'         => __('All Areas','themesdojo'),
        'parent_item'       => __('Parent Area','themesdojo'),
        'parent_item_colon' => __('Parent Area:','themesdojo'),
        'edit_item'         => __('Edit Area','themesdojo'),
        'update_item'       => __('Update Area','themesdojo'),
        'add_new_item'      => __('Add New Area','themesdojo'),
        'new_item_name'     => __('New Area','themesdojo'),
        'menu_name'         => __('All Areas','themesdojo'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );

    register_taxonomy( 'area', array( 'company' ), $args );

}
									  
	add_action('init', 'post_type_company');
	add_action('init', 'areas_register_taxonomies');

// A callback function to add a custom field to "area" taxonomy
function area_taxonomy_custom_fields($tag)
{
    // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option("taxonomy_term_$t_id"); // Do the check
    ?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="postcodes"><?php _e('Postcode Lists(separated comma and dashline)'); ?></label>
        </th>
        <td>
            <textarea name="term_meta[postcodes]" id="term_meta[postcodes]" rows="5" cols="50" style="width:95%;"><?php echo $term_meta['postcodes'] ? $term_meta['postcodes'] : ''; ?></textarea><br/>
            <span class="description"><?php _e('Postcodes in this area'); ?></span>
        </td>
    </tr>

    <?php
}
// A callback function to save our extra taxonomy field(s)
function save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}
function create_taxonomy_custom_fields(){
    ?>

    <div class="form-field term-postcodes" style="margin-bottom: 20px;">
            <label for="postcodes"><?php _e('Postcode Lists(separated comma and dashline)'); ?></label>
            <textarea name="term_meta[postcodes]" id="term_meta[postcodes]" cols="40" rows="6" style="width:95%;">
            </textarea><br/>
            <span class="description"><?php _e('Postcodes in this area'); ?></span>
    </div>

    <?php
}

// Add the fields to the "area" taxonomy, using callback function
add_action( 'area_edit_form_fields', 'area_taxonomy_custom_fields', 10, 2 );

// Save the changes made on the "area" taxonomy, using callback function
add_action( 'edited_area', 'save_taxonomy_custom_fields', 10, 2 );

// Create custom field called postcodes on the "area" taxonomy, using callback function
add_action( 'area_add_form_fields', 'create_taxonomy_custom_fields', 10, 2 );
add_action( 'create_area', 'save_taxonomy_custom_fields', 10, 2 );

// Create custom column called postcodes
function area_custom_taxonomy_columns( $columns )
{
    $new_columns = array();
    $new_columns['name'] = $columns['name'];
    $new_columns['postcodes'] = __('Postcodes');
    $new_columns['description'] = $columns['description'];
    $new_columns['slug'] = $columns['slug'];
    $new_columns['posts'] = $columns['posts'];

    return $new_columns;
}
add_filter('manage_edit-area_columns' , 'area_custom_taxonomy_columns');

//Add content to the column postcodes
function add_area_column_content($content,$column_name,$term_id){
    $term_meta = get_option("taxonomy_term_$term_id"); // Do the check
    switch ($column_name) {
        case 'postcodes':
            $content = $term_meta['postcodes'];
            break;
        default:
            break;
    }
    return $content;
}
add_filter('manage_area_custom_column', 'add_area_column_content',10,3);
?>