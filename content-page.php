<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'dewi_before_post_content' ); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array( 
			'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'dewi' ),
			'after'             => '</div>',
			'link_before'       => '<span>',
			'link_after'        => '</span>'
      ) );
		?>
	</div>
	<footer class="entry-meta-bar clearfix">	        			
		<div class="entry-meta clearfix">
       	<?php edit_post_link( __( 'Edit', 'dewi' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</footer>
	<?php
	do_action( 'dewi_after_post_content' );
   ?>
</article>