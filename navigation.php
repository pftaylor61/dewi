<?php
/**
 * The template part for displaying navigation.
 *
 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */
?>

<?php
if( is_archive() || is_home() || is_search() ) {
	/**
	 * Checking WP-PageNaviplugin exist
	 */
	if ( function_exists('wp_pagenavi' ) ) : 
		wp_pagenavi();

	else: 
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : 
		?>
		<ul class="default-wp-page clearfix">
			<li class="previous"><?php next_posts_link( __( '&laquo; Previous', 'dewi' ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Next &raquo;', 'dewi' ) ); ?></li>
		</ul>
		<?php
		endif;
	endif;
}

if ( is_single() ) {
	if( is_attachment() ) {
	?>
		<ul class="default-wp-page clearfix">
			<li class="previous"><?php previous_image_link( false, __( '&larr; Previous', 'dewi' ) ); ?></li>
			<li class="next"><?php next_image_link( false, __( 'Next &rarr;', 'dewi' ) ); ?></li>
		</ul>
	<?php
	}
	else {
	?>
		<ul class="default-wp-page clearfix">
			<li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'dewi' ) . '</span> %title' ); ?></li>
			<li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'dewi' ) . '</span>' ); ?></li>
		</ul>
	<?php
	}	
}

?>