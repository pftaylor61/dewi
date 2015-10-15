<?php
/**
 * Displays the searchform of the theme.
 *
 * @package ThemeGrill
 * @subpackage dewi
 * @since dewi 1.0
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form searchform clearfix" method="get">
	<div class="search-wrap">
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'dewi' ); ?>" class="s field" name="s">
		<button class="search-icon" type="submit"></button>
	</div>
</form><!-- .searchform -->