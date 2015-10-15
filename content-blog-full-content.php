<?php
/**
 * The template used for displaying blog post full content.
 *
 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'dewi_before_post_content' ); ?>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
		</h1><!-- .entry-title -->
	</header>

	<div class="entry-content clearfix">
		<?php
			the_content();
			wp_link_pages( array(
			'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'dewi' ),
			'after'             => '</div>',
			'link_before'       => '<span>',
			'link_after'        => '</span>'
      ) );
		?>
	</div>

	<?php dewi_entry_meta(); ?>

	<?php
	do_action( 'dewi_after_post_content' );
   ?>
</article>