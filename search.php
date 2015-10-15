<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */
?>

<?php get_header(); ?>

	<?php do_action( 'dewi_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php get_template_part( 'navigation', 'search' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php dewi_sidebar_select(); ?>
	
	<?php do_action( 'dewi_after_body_content' ); ?>

<?php get_footer(); ?>