<?php 
/**
 * Theme Page Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage dewi
 * @since dewi 1.0
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