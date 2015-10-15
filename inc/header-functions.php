<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package 		ThemeGrill
 * @subpackage 		dewi
 * @since 			dewi 1.0
 */

/****************************************************************************************/

// Backwards compatibility for older versions
if ( ! function_exists( '_wp_render_title_tag' ) ) :

   add_action( 'wp_head', 'dewi_render_title' );
   function dewi_render_title() {
      ?>
      <title>
      <?php
      /**
       * Print the <title> tag based on what is being viewed.
       */
      wp_title( '|', true, 'right' );
      ?>
      </title>
      <?php
   }

   add_filter( 'wp_title', 'dewi_filter_wp_title' );
   if ( ! function_exists( 'dewi_filter_wp_title' ) ) :
      /**
       * Modifying the Title
       *
       * Function tied to the wp_title filter hook.
       * @uses filter wp_title
       */
      function dewi_filter_wp_title( $title ) {
         global $page, $paged;

         // Get the Site Name
         $site_name = get_bloginfo( 'name' );

         // Get the Site Description
         $site_description = get_bloginfo( 'description' );

         $filtered_title = '';

         // For Homepage or Frontpage
         if(  is_home() || is_front_page() ) {
            $filtered_title .= $site_name;
            if ( !empty( $site_description ) )  {
               $filtered_title .= ' &#124; '. $site_description;
            }
         }
         elseif( is_feed() ) {
            $filtered_title = '';
         }
         else{
            $filtered_title = $title . $site_name;
         }

         // Add a page number if necessary:
         if( $paged >= 2 || $page >= 2 ) {
            $filtered_title .= ' &#124; ' . sprintf( __( 'Page %s', 'dewi' ), max( $paged, $page ) );
         }

         // Return the modified title
         return $filtered_title;
      }
   endif;

endif;

/****************************************************************************************/

if ( ! function_exists( 'dewi_render_header_image' ) ) :
/**
 * Shows the small info text on top header part
 */
function dewi_render_header_image() {
	$header_image = get_header_image();
	if( !empty( $header_image ) ) {
	?>
		<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
	<?php
	}
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'dewi_featured_image_slider' ) ) :
/**
 * display featured post slider
 */
function dewi_featured_image_slider() {
	global $post;
	?>
		<section id="featured-slider">
			<div class="slider-cycle">
				<?php
				for( $i = 1; $i <= 5; $i++ ) {
					$dewi_slider_title = of_get_option( 'dewi_slider_title'.$i , '' );
					$dewi_slider_text = of_get_option( 'dewi_slider_text'.$i , '' );
					$dewi_slider_image = of_get_option( 'dewi_slider_image'.$i , '' );
					$dewi_slider_button_text = of_get_option( 'dewi_slider_button_text'.$i , __( 'Read more', 'dewi' ) );
					$dewi_slider_link = of_get_option( 'dewi_slider_link'.$i , '#' );
					if( !empty( $dewi_header_title ) || !empty( $dewi_slider_text ) || !empty( $dewi_slider_image ) ) {
						if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
						?>
						<div class="<?php echo $classes; ?>">
							<figure>
								<img alt="<?php echo esc_attr( $dewi_slider_title ); ?>" src="<?php echo esc_url( $dewi_slider_image ); ?>">
							</figure>
							<div class="entry-container">
								<?php if( !empty( $dewi_slider_title ) || !empty( $dewi_slider_text ) ) { ?>
								<div class="entry-description-container">
									<?php if( !empty( $dewi_slider_title ) ) { ?>
									<div class="slider-title-head"><h3 class="entry-title"><a href="<?php echo esc_url( $dewi_slider_link ); ?>" title="<?php echo esc_attr( $dewi_slider_title ); ?>"><span><?php echo esc_html( $dewi_slider_title ); ?></span></a></h3></div>
									<?php
									}
									if( !empty( $dewi_slider_text ) ) {
										?>
									<div class="entry-content"><p><?php echo esc_textarea( $dewi_slider_text ); ?></p></div>
									<?php
									}
									?>
								</div>
								<?php } ?>
								<div class="clearfix"></div>
								<?php if( !empty( $dewi_slider_button_text ) ) { ?>
								<a class="slider-read-more-button" href="<?php echo esc_url( $dewi_slider_link ); ?>" title="<?php echo esc_attr( $dewi_slider_title ); ?>"><?php echo esc_html( $dewi_slider_button_text ); ?></a>
								<?php } ?>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
			<nav id="controllers" class="clearfix"></nav>
		</section>

		<?php
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'dewi_header_title' ) ) :
/**
 * Show the title in header
 */
function dewi_header_title() {
	if( is_archive() ) {
		if ( is_category() ) :
			$dewi_header_title = single_cat_title( '', FALSE );

		elseif ( is_tag() ) :
			$dewi_header_title = single_tag_title( '', FALSE );

		elseif ( is_author() ) :
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			$dewi_header_title =  sprintf( __( 'Author: %s', 'dewi' ), '<span class="vcard">' . get_the_author() . '</span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		elseif ( is_day() ) :
			$dewi_header_title = sprintf( __( 'Day: %s', 'dewi' ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			$dewi_header_title = sprintf( __( 'Month: %s', 'dewi' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		elseif ( is_year() ) :
			$dewi_header_title = sprintf( __( 'Year: %s', 'dewi' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			$dewi_header_title = __( 'Asides', 'dewi' );

		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			$dewi_header_title = __( 'Images', 'dewi');

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			$dewi_header_title = __( 'Videos', 'dewi' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			$dewi_header_title = __( 'Quotes', 'dewi' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			$dewi_header_title = __( 'Links', 'dewi' );

		else :
			$dewi_header_title = __( 'Archives', 'dewi' );

		endif;
	}
	elseif( is_404() ) {
		$dewi_header_title = __( 'Page NOT Found', 'dewi' );
	}
	elseif( is_search() ) {
		$dewi_header_title = __( 'Search Results', 'dewi' );
	}
	elseif( is_page()  ) {
		$dewi_header_title = get_the_title();
	}
	elseif( is_single()  ) {
		$dewi_header_title = get_the_title();
	}
	elseif( is_home() ){
		$queried_id = get_option( 'page_for_posts' );
		$dewi_header_title = get_the_title( $queried_id );
	}
	else {
		$dewi_header_title = '';
	}

	return $dewi_header_title;

}
endif;

/****************************************************************************************/

if ( ! function_exists( 'dewi_breadcrumb' ) ) :
/**
 * Display breadcrumb on header.
 *
 * If the page is home or front page, slider is displayed.
 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
 */
function dewi_breadcrumb() {
	if( function_exists( 'bcn_display' ) ) {
		echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
		echo '<span class="breadcrumb-title">'.__( 'You are here:', 'dewi' ).'</span>';
		bcn_display();
		echo '</div> <!-- .breadcrumb -->';
	}
}
endif;

?>