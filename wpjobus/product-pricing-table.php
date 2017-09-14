<?php
/**
 * Template name: Product Pricing Table
 */

$page = get_page($post->ID);
$td_current_page_id = $page->ID;

get_header(); ?>
	<link type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style-table.css" rel="stylesheet" />






  <section class="layer plans">
  <section>
  <?php
$params = array('posts_per_page' => 2, 'post_type' => 'product');
$wc_query = new WP_Query($params);
?>
<?php if ($wc_query->have_posts()) : ?>
<?php while ($wc_query->have_posts()) :
                $wc_query->the_post(); 
		$product = get_product(get_the_ID());


		
				?>

				



    

    <section class="third lift plan-tier" > 
	<?php if($product->featured == 'yes'){ ?>
	 <h6>Most popular</h6>
	 <?php }  ?>
	<?php if($product->featured == 'yes'){ ?>
      <h4 class="featured-box"><?php the_title(); ?></h4>
	  <?php }else{  ?>
	   <h4><?php the_title(); ?></h4>
	  <?php }  ?>
     <!-- <h5><sup class="superscript">$</sup><span class="plan-price"><?php echo $product->get_price(); ?> </span><sub> /mo</sub></h5>      
		<del>$<?php echo  $product->regular_price; ?>/mo </del>-->

    <?php the_content(); ?>
	<form class="cart" method="post" enctype="multipart/form-data">
     <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->id); ?>">
     <button type="submit"> <?php echo $product->single_add_to_cart_text(); ?> </button>
</form>

    </section>


<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else:  ?>
<p>
     <?php _e( 'No Products'); ?>
</p>
<?php endif; ?>



<!--
    
    <section class="third lift plan-tier callout" onclick="location.href='#';">

      <h6>Most popular</h6>
      <h4>Team</h4>
      <h5><sup class="superscript">$</sup><span class="plan-price">20</span><sub> /mo</sub></h5>

      
      <br>
      <del>$40/mo</del>
      

      <ul>
<li>Up to <strong>10</strong> sites</li>
<li>Up to <strong>10</strong> users per site</li>
<li><strong>Free hosting</strong> (beta)</li>
<li>14 day <strong>free trial</strong></li>
</ul>

    </section>
    
   -->
    
    <div style="clear: both"></div>
  </section>
</section>
<?php get_footer(); ?>