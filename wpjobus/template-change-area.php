<?php
/**
 * Template name: Page for changing Area meta
 */

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

add_filter('remove_parent_areas', 'remove_parent_areas_callback',10,1);
function remove_parent_areas_callback($areas){
    $new_areas = array();
    foreach ($areas as $area){
        if($area->parent==0) continue;
        $id = $area->term_id;
        $key = "taxonomy_term_$id";

        $postcode = get_option($key)['postcodes'];

        if(strstr($postcode,'-')==false) continue;

        $new_areas[] = $area;
    }
    return $new_areas;
}


get_header();


//Retrieve the terms in a given taxonomy or list of taxonomies.

  $areas = get_terms(
          array(
             'taxonomy' => 'area',
             'hide_empty' => false,
          )
  );

    $areas = apply_filters('remove_parent_areas',$areas);

    foreach ($areas as $area){
        $id = $area->term_id;
        $key = "taxonomy_term_$id";

        $postcodes = str_replace(' ','', get_option($key)['postcodes']);

        $aPostcodes = explode(',', $postcodes);

        $newCodes = array();
        foreach($aPostcodes as $code){
            if(strstr($code,'-')==false){
                $newCodes[] = $code;
                continue;
            }
            $subcodes = explode('-', $code);
            $start = $subcodes[0];
            $end = $subcodes[1];

            for($i=$start; $i<=$end; $i++)
                $newCodes[] = $i;
        }

        $newPostcode['postcodes'] = implode(',', $newCodes);
            update_option($key, $newPostcode);

        echo $area->name.' => '.$newPostcode['postcodes'].'<br/>';
    }
?>

	<section id="blog">

		<div class="container">

		</div>

	</section>

<?php get_footer(); ?>