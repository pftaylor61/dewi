<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */
?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if( !is_active_sidebar( 'dewi_footer_sidebar_one' ) &&
	!is_active_sidebar( 'dewi_footer_sidebar_two' ) &&
	!is_active_sidebar( 'dewi_footer_sidebar_three' ) &&
	!is_active_sidebar( 'dewi_footer_sidebar_four' ) ) {
	return;
}
?>
<div class="footer-widgets-wrapper">
	<div class="inner-wrap">
		<div class="footer-widgets-area clearfix">
			<div class="tg-one-fourth tg-column-1">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'dewi_footer_sidebar_one' ) ):
				endif;
				?>
			</div>
			<div class="tg-one-fourth tg-column-2">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'dewi_footer_sidebar_two' ) ):
				endif;
				?>
			</div>
			<div class="tg-one-fourth tg-after-two-blocks-clearfix tg-column-3">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'dewi_footer_sidebar_three' ) ):
				endif;
				?>
			</div>
			<div class="tg-one-fourth tg-one-fourth-last tg-column-4">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'dewi_footer_sidebar_four' ) ):
				endif;
				?>
			</div>
		</div>
	</div>
</div>