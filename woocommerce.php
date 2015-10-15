<?php 
/**
 * Theme Page Section for our theme.
 *
 * @package Old Castle Web Services * @subpackage dewi * @since dewi 1.3.3 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */
?>

<?php get_header(); ?>

	<?php do_action( 'dewi_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
				
				<?php
				/* The loop was formerly here, and has been deleted */
				
				woocommerce_content();
				?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php dewi_sidebar_select(); ?>

	<?php do_action( 'dewi_after_body_content' ); ?>

<?php get_footer(); ?>