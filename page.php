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
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					do_action( 'dewi_before_comments_template' );
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();					
	      		do_action ( 'dewi_after_comments_template' );
				?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php dewi_sidebar_select(); ?>

	<?php do_action( 'dewi_after_body_content' ); ?>

<?php get_footer(); ?>