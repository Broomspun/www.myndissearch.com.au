<?php
/**
 * Template name: Page for Writing Services
 */


$file = fopen(get_stylesheet_directory_uri()."/raw.csv","r");

$providers = array();
$i = 0;
while(! feof($file)){
    $records = fgetcsv($file);
    if($i==0){
        $i++;
        continue;
    }

    $key = $records[1];
    if(!key_exists($key, $providers)) {
        $providers[$key][] = array(
                'service'       =>      $records[0],
                'location'      =>      $records[2],
                'phone'         =>      $records[3],
                'website'       =>      $records[4],
                'email'         =>      $records[5],
                'address'       =>      $records[6],
        );
    }
    else {
        $providers[$key][] = array(
            'service'       =>      $records[0],
            'location'      =>      $records[2],
            'phone'         =>      $records[3],
            'website'       =>      $records[4],
            'email'         =>      $records[5],
            'address'       =>      $records[6],
        );
    }
}

get_header();

    $service_lists = array(
               	"Assistance Animals",
				"Accommodation/Tenancy",
				"Assist Access/Maintain Employment or Higher Education",
				"Assistive Equip-Recreation",
				"Assist Prod-Pers Care/Safety",
				"Assist-Travel/Transport",
				"Assistive Prod-Household Task",
				"Assist-Life Stage, Transition",
				"Behaviour Support",
				"Customised Prosthetics",
				"Comms & Info Equipment",
				"Community Nursing Care",
				"Daily Personal Activities",
				"Daily Tasks/Shared Living",
				"Development-Life Skills",
				"Early Childhood Supports",
				"Exercise Physiology &amp; Personal Training",
				"Group and Centre Based Activities",
				"High Intensity Daily Personal Activities",
				"Hearing Services",
				"Hearing Equipment",
				"Home Modification",
				"Household Tasks",
				"Innov Community Participation",
				"Interpret/Translate",
				"Participate Community",
				"Personal Mobility Equipment",
				"Plan Management",
				"Personal Activities High",
				"Specialised Positive Behaviour Support",
				"Specialised Disability Accommodation",
				"Specialised Driver Training",
				"Specialised support co-ordination",
				"Specialised Supported Employment",
				"Support Coordination",
				"Specialised Hearing Services",
				"Therapeutic Supports",
				"Vehicle modifications",
				"Vision Equipment",
    );


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
                        $company_name = get_post_meta($post->ID, 'wpjobus_company_fullname',true);
                        if($company_name=='') continue;

                        ?>
                        <h2 class="title"><?php the_title(); ?></h2>
                        <h4><?php echo 'company name => ',$company_name; ?></h4>
                        <?php

                        $services = array();

                        if(key_exists($company_name, $providers)){
                            $services = $providers[$company_name];
                        }

                        $company_service = array();

                        foreach ($services as $service){
                            $service_name = $service['service'];
                            if(in_array($service_name, $service_lists))
                                $company_service[] = array(
                                    $service_name,'',''
                                );
                        }

                        if(!empty($company_service))
                            update_post_meta($post->ID,'wpjobus_company_services', $company_service);

                        //find areas in the zip code
                        echo '<br/>';


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