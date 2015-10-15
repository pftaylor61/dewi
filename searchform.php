<?php
/**
 * Displays the searchform of the theme.
 *
 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form searchform clearfix" method="get">
	<div class="search-wrap">
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'dewi' ); ?>" class="s field" name="s">
		<button class="search-icon" type="submit"></button>
	</div>
</form><!-- .searchform -->