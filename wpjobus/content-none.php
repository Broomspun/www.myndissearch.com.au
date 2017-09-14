<?php
/**
 * The template for displaying a "No posts found" message.
 */
?>

<header class="page-header">
	<h1 style="margin-left: 5px;" class="page-title"><?php _e( 'Nothing Found', 'wpjobus' ); ?></h1>
</header>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wpjobus' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms.', 'wpjobus' ); ?></p>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'wpjobus' ); ?></p>

	<?php endif; ?>
</div><!-- .page-content -->
