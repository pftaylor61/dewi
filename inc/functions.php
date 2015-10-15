<?php
/**
 * dewi functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill
 */

/****************************************************************************************/

add_action( 'wp_enqueue_scripts', 'dewi_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function dewi_scripts_styles_method() {
   /**
	* Loads our main stylesheet.
	*/
	wp_enqueue_style( 'dewi_style', get_stylesheet_uri() );

	if( of_get_option( 'dewi_color_skin', 'light' ) == 'dark' ) {
		wp_enqueue_style( 'dewi_dark_style', dewi_CSS_URL. '/dark.css' );
	}

   // Add Genericons, used in the main stylesheet.
   wp_enqueue_style( 'dewi-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/**
	 * Register JQuery cycle js file for slider.
	 */
	wp_register_script( 'jquery_cycle', dewi_JS_URL . '/jquery.cycle.all.min.js', array( 'jquery' ), '3.0.3', true );

   wp_register_style( 'google_fonts', '//fonts.googleapis.com/css?family=Lato' );

	/**
	 * Enqueue Slider setup js file.
	 */
	if ( is_home() || is_front_page() && of_get_option( 'dewi_activate_slider', '0' ) == '1' ) {
		wp_enqueue_script( 'dewi_slider', dewi_JS_URL . '/dewi-slider-setting.js', array( 'jquery_cycle' ), false, true );
	}
	wp_enqueue_script( 'dewi-navigation', dewi_JS_URL . '/navigation.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'dewi-custom', dewi_JS_URL. '/dewi-custom.js', array( 'jquery' ) );

	wp_enqueue_style( 'google_fonts' );

   $dewi_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$dewi_user_agent)) {
		wp_enqueue_script( 'html5', dewi_JS_URL . '/html5shiv.min.js', true );
	}

}

add_action( 'admin_print_styles-appearance_page_options-framework', 'dewi_admin_styles' );
/**
 * Enqueuing some styles.
 *
 * @uses wp_enqueue_style to register stylesheets.
 * @uses wp_enqueue_style to add styles.
 */
function dewi_admin_styles() {
	wp_enqueue_style( 'dewi_admin_style', dewi_ADMIN_CSS_URL. '/admin.css' );
}

/****************************************************************************************/

add_filter('the_content', 'dewi_add_mod_hatom_data');
// Adding the support for the entry-title tag for Google Rich Snippets
function dewi_add_mod_hatom_data($content) {
   $title = get_the_title();
   if ( is_single() ) {
      $content .= '<div class="extra-hatom-entry-title"><span class="entry-title">' . $title . '</span></div>';
   }
   return $content;
}

/****************************************************************************************/

add_filter( 'excerpt_length', 'dewi_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function dewi_excerpt_length( $length ) {
	return 40;
}

add_filter( 'excerpt_more', 'dewi_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function dewi_continue_reading() {
	return '';
}

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function dewi_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
	'size' => 'medium',
	), $atts );

	$out['size'] = $atts['size'];

	return $out;

}
add_filter( 'shortcode_atts_gallery', 'dewi_gallery_atts', 10, 3 );

/****************************************************************************************/

add_filter( 'body_class', 'dewi_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function dewi_body_class( $classes ) {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'dewi_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'dewi_page_layout', true );
	}

	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
	$dewi_default_layout = of_get_option( 'dewi_default_layout', 'right_sidebar' );

	$dewi_default_page_layout = of_get_option( 'dewi_pages_default_layout', 'right_sidebar' );
	$dewi_default_post_layout = of_get_option( 'dewi_single_posts_default_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $dewi_default_page_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $dewi_default_page_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $dewi_default_page_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $dewi_default_page_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( is_single() ) {
			if( $dewi_default_post_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $dewi_default_post_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $dewi_default_post_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $dewi_default_post_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( $dewi_default_layout == 'right_sidebar' ) { $classes[] = ''; }
		elseif( $dewi_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
		elseif( $dewi_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
		elseif( $dewi_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
	}
	elseif( $layout_meta == 'right_sidebar' ) { $classes[] = ''; }
	elseif( $layout_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
	elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
	elseif( $layout_meta == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }


	if( is_page_template( 'page-templates/blog-image-alternate-medium.php' ) ) {
		$classes[] = 'blog-alternate-medium';
	}
	if( is_page_template( 'page-templates/blog-image-medium.php' ) ) {
		$classes[] = 'blog-medium';
	}
	if ( of_get_option( 'dewi_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
		$classes[] = 'blog-alternate-medium';
	}
	if ( of_get_option( 'dewi_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
		$classes[] = 'blog-medium';
	}
	if( of_get_option( 'dewi_site_layout', 'box_1218px' ) == 'wide_978px' ) {
		$classes[] = 'wide-978';
	}
	elseif( of_get_option( 'dewi_site_layout', 'box_1218px' ) == 'box_978px' ) {
		$classes[] = 'narrow-978';
	}
	elseif( of_get_option( 'dewi_site_layout', 'box_1218px' ) == 'wide_1218px' ) {
		$classes[] = 'wide-1218';
	}
	else {
		$classes[] = '';
	}

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'dewi_sidebar_select' ) ) :
/**
 * Fucntion to select the sidebar
 */
function dewi_sidebar_select() {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'dewi_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'dewi_page_layout', true );
	}

	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
	$dewi_default_layout = of_get_option( 'dewi_default_layout', 'right_sidebar' );

	$dewi_default_page_layout = of_get_option( 'dewi_pages_default_layout', 'right_sidebar' );
	$dewi_default_post_layout = of_get_option( 'dewi_single_posts_default_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $dewi_default_page_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $dewi_default_page_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		if( is_single() ) {
			if( $dewi_default_post_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $dewi_default_post_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		elseif( $dewi_default_layout == 'right_sidebar' ) { get_sidebar(); }
		elseif ( $dewi_default_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
	}
	elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }
	elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/****************************************************************************************/

add_action( 'admin_head', 'dewi_favicon' );
add_action( 'wp_head', 'dewi_favicon' );
/**
 * Fav icon for the site
 */
function dewi_favicon() {
	if ( of_get_option( 'dewi_activate_favicon', '0' ) == '1' ) {
		$dewi_favicon = of_get_option( 'dewi_favicon', '' );
		$dewi_favicon_output = '';
		if ( !empty( $dewi_favicon ) ) {
			$dewi_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $dewi_favicon ).'" type="image/x-icon" />';
		}
		echo $dewi_favicon_output;
	}
}

/****************************************************************************************/

add_action('wp_head', 'dewi_custom_css');
/**
 * Hooks the Custom Internal CSS to head section
 */
function dewi_custom_css() {
	$primary_color = of_get_option( 'dewi_primary_color', '#0FBE7C' );
	$dewi_internal_css = '';
	if( $primary_color != '#0FBE7C' ) {
		$dewi_internal_css = ' blockquote { border-left: 3px solid '.$primary_color.'; }
			.dewi-button, input[type="reset"], input[type="button"], input[type="submit"], button { background-color: '.$primary_color.'; }
			.previous a:hover, .next a:hover { 	color: '.$primary_color.'; }
			a { color: '.$primary_color.'; }
			#site-title a:hover { color: '.$primary_color.'; }
			.main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a { color: '.$primary_color.'; }
			.main-navigation ul li ul { border-top: 1px solid '.$primary_color.'; }
			.main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover { color: '.$primary_color.'; }
			.site-header .menu-toggle:hover { background: '.$primary_color.'; }
			.main-small-navigation li:hover { background: '.$primary_color.'; }
			.main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item { background: '.$primary_color.'; }
			.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a  { color: '.$primary_color.'; }
			.small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a, .small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a, .small-menu ul li:hover > a { color: '.$primary_color.'; }
			#featured-slider .slider-read-more-button { background-color: '.$primary_color.'; }
			#controllers a:hover, #controllers a.active { background-color: '.$primary_color.'; color: '.$primary_color.'; }
			.breadcrumb a:hover { color: '.$primary_color.'; }
			.tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover, .tg-one-fourth .widget-title a:hover { color: '.$primary_color.'; }
			.pagination span { background-color: '.$primary_color.'; }
			.pagination a span:hover { color: '.$primary_color.'; border-color: .'.$primary_color.'; }
			.widget_testimonial .testimonial-post { border-color: '.$primary_color.' #EAEAEA #EAEAEA #EAEAEA; }
			.call-to-action-content-wrapper { border-color: #EAEAEA #EAEAEA #EAEAEA '.$primary_color.'; }
			.call-to-action-button { background-color: '.$primary_color.'; }
			#content .comments-area a.comment-permalink:hover { color: '.$primary_color.'; }
			.comments-area .comment-author-link a:hover { color: '.$primary_color.'; }
			.comments-area .comment-author-link span { background-color: '.$primary_color.'; }
			.comment .comment-reply-link:hover { color: '.$primary_color.'; }
			.nav-previous a:hover, .nav-next a:hover { color: '.$primary_color.'; }
			#wp-calendar #today { color: '.$primary_color.'; }
			.widget-title span { border-bottom: 2px solid '.$primary_color.'; }
			.footer-widgets-area a:hover { color: '.$primary_color.' !important; }
			.footer-socket-wrapper .copyright a:hover { color: '.$primary_color.'; }
			a#back-top:before { background-color: '.$primary_color.'; }
			.read-more, .more-link { color: '.$primary_color.'; }
			.post .entry-title a:hover, .page .entry-title a:hover { color: '.$primary_color.'; }
			.post .entry-meta .read-more-link { background-color: '.$primary_color.'; }
			.post .entry-meta a:hover, .type-page .entry-meta a:hover { color: '.$primary_color.'; }
			.single #content .tags a:hover { color: '.$primary_color.'; }
			.widget_testimonial .testimonial-icon:before { color: '.$primary_color.'; }
			a#scroll-up { background-color: '.$primary_color.'; }
			.search-form span { background-color: '.$primary_color.'; }';
	}

	if( !empty( $dewi_internal_css ) ) {
		?>
		<style type="text/css"><?php echo $dewi_internal_css; ?></style>
		<?php
	}

	$dewi_custom_css = of_get_option( 'dewi_custom_css', '' );
	if( !empty( $dewi_custom_css ) ) {
		?>
		<style type="text/css"><?php echo $dewi_custom_css; ?></style>
		<?php
	}
}

/**************************************************************************************/

if ( ! function_exists( 'dewi_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function dewi_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'dewi' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'dewi' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'dewi' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'dewi' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'dewi' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // dewi_content_nav

/**************************************************************************************/

if ( ! function_exists( 'dewi_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function dewi_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'dewi' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'dewi' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 74 );
					printf( '<div class="comment-author-link">%1$s%2$s</div>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'dewi' ) . '</span>' : ''
					);
					printf( '<div class="comment-date-time">%1$s</div>',
						sprintf( __( '%1$s at %2$s', 'dewi' ), get_comment_date(), get_comment_time() )
					);
					printf( __( '<a class="comment-permalink" href="%1$s">Permalink</a>', 'dewi'), esc_url( get_comment_link( $comment->comment_ID ) ) );
					edit_comment_link();
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'dewi' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'dewi' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**************************************************************************************/

add_action( 'dewi_footer_copyright', 'dewi_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'dewi_footer_copyright' ) ) :
function dewi_footer_copyright() {
	$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

	$wp_link = '<a href="'.esc_url( 'http://wordpress.org' ).'" target="_blank" title="' . esc_attr__( 'WordPress', 'dewi' ) . '"><span>' . __( 'WordPress', 'dewi' ) . '</span></a>';

	$tg_link =  '<a href="'.esc_url( 'http://themegrill.com/themes/dewi' ).'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'dewi' ).'" rel="designer"><span>'.__( 'ThemeGrill', 'dewi') .'</span></a>';

	$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s.', 'dewi' ), date( 'Y' ), $site_link ).' '.sprintf( __( 'Powered by %s.', 'dewi' ), $wp_link ).' '.sprintf( __( 'Theme: %1$s by %2$s.', 'dewi' ), 'dewi', $tg_link );

	$dewi_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
	echo $dewi_footer_copyright;
}
endif;

/**************************************************************************************/

if ( ! function_exists( 'dewi_posts_listing_display_type_select' ) ) :
/**
 * Function to select the posts listing display type
 */
function dewi_posts_listing_display_type_select() {
	if ( of_get_option( 'dewi_archive_display_type', 'blog_large' ) == 'blog_large' ) {
		$format = 'blog-image-large';
	}
	elseif ( of_get_option( 'dewi_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
		$format = 'blog-image-medium';
	}
	elseif ( of_get_option( 'dewi_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
		$format = 'blog-image-medium';
	}
	elseif ( of_get_option( 'dewi_archive_display_type', 'blog_large' ) == 'blog_full_content' ) {
		$format = 'blog-full-content';
	}
	else {
		$format = get_post_format();
	}

	return $format;
}
endif;

/****************************************************************************************/

add_action('admin_init','dewi_textarea_sanitization_change', 100);
/**
 * Override the default textarea sanitization.
 */
function dewi_textarea_sanitization_change() {
   remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
   add_filter( 'of_sanitize_textarea', 'dewi_sanitize_textarea_custom',10,2 );
}

/**
 * sanitize the input for custom css
 */
function dewi_sanitize_textarea_custom( $input,$option ) {
   if( $option['id'] == "dewi_custom_css" ) {
      $output = wp_filter_nohtml_kses( $input );
   } else {
      $output = $input;
   }
   return $output;
}

/****************************************************************************************/

if ( ! function_exists( 'dewi_entry_meta' ) ) :
/**
 * Shows meta information of post.
 */
function dewi_entry_meta() {
   if ( 'post' == get_post_type() ) :
      echo '<footer class="entry-meta-bar clearfix">';
      echo '<div class="entry-meta clearfix">';
      ?>

      <span class="by-author author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>

      <?php
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
      if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
         $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
      }
      $time_string = sprintf( $time_string,
         esc_attr( get_the_date( 'c' ) ),
         esc_html( get_the_date() ),
         esc_attr( get_the_modified_date( 'c' ) ),
         esc_html( get_the_modified_date() )
      );
      printf( __( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'dewi' ),
         esc_url( get_permalink() ),
         esc_attr( get_the_time() ),
         $time_string
      ); ?>

      <?php if( has_category() ) { ?>
         <span class="category"><?php the_category(', '); ?></span>
      <?php } ?>

      <?php if ( comments_open() ) { ?>
         <span class="comments"><?php comments_popup_link( __( 'No Comments', 'dewi' ), __( '1 Comment', 'dewi' ), __( '% Comments', 'dewi' ), '', __( 'Comments Off', 'dewi' ) ); ?></span>
      <?php } ?>

      <?php edit_post_link( __( 'Edit', 'dewi' ), '<span class="edit-link">', '</span>' ); ?>

      <?php if ( ( of_get_option( 'dewi_archive_display_type', 'blog_large' ) != 'blog_full_content' ) && !is_single() ) { ?>
         <span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'dewi' ); ?></a></span>
      <?php } ?>

      <?php
      echo '</div>';
      echo '</footer>';
   endif;
}
endif;


?>