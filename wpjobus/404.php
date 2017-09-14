<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

    <?php
         include (get_template_directory() . "/part-sliders.php");
    ?>

	<section id="seacrh-result-title">

		 <div class="container">

        	<h2><?php _e( 'Not found', 'wpjobus' ); ?></h2>

        </div>

	</section>

    <section id="ads-homepage">
        
        <div class="container">

        	<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'wpjobus' ); ?></h2>
			<p><?php _e( 'It looks like nothing was found at this location.', 'wpjobus' ); ?></p>

        </div>

    </section>

<?php get_footer(); ?>