<?php
/**
 * Template name: Page for changing Area meta
 */

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

add_filter('remove_parent_areas', 'remove_parent_areas_callback',10,1);
add_filter('filter_areas_with_the_zipcode', 'filter_areas_with_the_zipcode_callback',10,2);

function filter_areas_with_the_zipcode_callback($areas, $zipcode){
    $new_areas = array();
    foreach ($areas as $area){
        if($area->parent==0) continue;
        $id = $area->term_id;
        $key = "taxonomy_term_$id";

        $postcode = get_option($key)['postcodes'];

        if(strstr($postcode,$zipcode)==false) continue;

        $new_areas[] = $area;

        }

        return $new_areas;
}

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


    $query = new WP_Query( array(
            'post_type'         =>  'company',
            'posts_per_page'    =>  10,
            'post_status'       =>  'publish'
        ) );
?>

	<section id="blog">

		<div class="container">
            <?php
            global $post;
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="entry">
                        <?php

                        $address = get_post_meta($post->ID, 'wpjobus_company_address',true);
                        $zipcode = -1;
                        if(preg_match("/(\d{4})$/", $address, $matches)){
                            $zipcode = $matches[0];
                        };
                        if($zipcode==-1) continue;
                        ?>
                        <h2 class="title"><?php the_title(); ?></h2>
                        <h4><?php echo 'zipcode => ',$zipcode; ?></h4>
                        <?php
                        //find areas in the zip code
                        $areas = get_terms(
                            array(
                                'taxonomy' => 'area',
                                'hide_empty' => false,
                            )
                        );

                        $areas = apply_filters('filter_areas_with_the_zipcode', $areas, $zipcode);

                        $terms = array();
                        if(!empty($areas)){
                            foreach ($areas as $area) {
                                echo $area->name . ', ';
                                $terms[] = $area->term_id;
                            }
                        }
                        echo '<br/>';

                        wp_set_post_terms($post->ID,$terms, 'area');
                        ?>

                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>

		</div>

	</section>

<?php get_footer(); ?>