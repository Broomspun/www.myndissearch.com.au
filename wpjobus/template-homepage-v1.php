<?php
/**
 * Template name: Homepage
 */

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

get_header(); ?>
<link rel='stylesheet'   href='<?php echo get_template_directory_uri(); ?>/homecarousel/owl.carousel.min.css' type='text/css' />
<link rel='stylesheet'   href='<?php echo get_template_directory_uri(); ?>/homecarousel/owl.theme.default.min.css' type='text/css' />
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/homecarousel/owl.carousel.js'></script>

	<?php
		include (get_template_directory() . "/part-sliders.php");
	?>

	<?php
		$page_title_state = get_post_meta($td_current_page_id, 'page_title_state', true);
		if($page_title_state == "off")
		{
	?>

	<section id="page-title">

		<div class="container">

			<h1 class="page-title"><?php the_title(); ?></h1>

		</div>

	</section>

	<?php } ?>

	<section id="page" style="padding: 0;">

		<div class="container">

			<div class="full" style="margin-bottom: 0;">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
				<?php the_content(); ?>
															
				<?php endwhile; endif; ?> 
				
			</div>
			
			
			
			

		</div>

	</section>
	
			
	
	
	

<?php get_footer(); ?>