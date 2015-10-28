<?php

/**

 * dewi functions related to defining constants, adding files and WordPress core functionality.

 *

 * Defining some constants, loading all the required files and Adding some core functionality.

 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.

 * @uses register_nav_menu() To add support for navigation menu.

 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.

 *

 * @package ThemeGrill

 * @subpackage dewi

 * @since dewi 1.0

 */



/**

 * Set the content width based on the theme's design and stylesheet.

 */

if ( ! isset( $content_width ) )

	$content_width = 700;



add_action( 'after_setup_theme', 'dewi_setup' );

add_theme_support( 'post-formats', array('aside') );

/**

 * All setup functionalities.

 *

 * @since 1.0

 */

if( !function_exists( 'dewi_setup' ) ) :

function dewi_setup() {



	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 */

	load_theme_textdomain( 'dewi', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head

	add_theme_support( 'automatic-feed-links' );



	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.

	add_theme_support( 'post-thumbnails' );

	

	// Declaring support for Woocommerce

	add_theme_support( 'woocommerce' );

 

	// Registering navigation menus.

	register_nav_menus( array(	

		'primary' 	=> 'Primary Menu',

		'footer' 	=> 'Footer Menu'

	) );



	// Cropping the images to different sizes to be used in the theme

	add_image_size( 'featured-blog-large', 750, 350, true );

	add_image_size( 'featured-blog-medium', 270, 270, true );

	add_image_size( 'featured', 642, 300, true );

	add_image_size( 'featured-blog-medium-small', 230, 230, true );	



	// Setup the WordPress core custom background feature.

	add_theme_support( 'custom-background', apply_filters( 'dewi_custom_background_args', array(

		'default-color' => 'eaeaea'

	) ) );



	// Adding excerpt option box for pages as well

	add_post_type_support( 'page', 'excerpt' );

}

endif;



/**

 * Define Directory Location Constants 

 */

define( 'dewi_PARENT_DIR', get_template_directory() );

define( 'dewi_CHILD_DIR', get_stylesheet_directory() );



define( 'dewi_INCLUDES_DIR', dewi_PARENT_DIR. '/inc' );	

define( 'dewi_CSS_DIR', dewi_PARENT_DIR . '/css' );

define( 'dewi_JS_DIR', dewi_PARENT_DIR . '/js' );

define( 'dewi_LANGUAGES_DIR', dewi_PARENT_DIR . '/languages' );



define( 'dewi_ADMIN_DIR', dewi_INCLUDES_DIR . '/admin' );

define( 'dewi_WIDGETS_DIR', dewi_INCLUDES_DIR . '/widgets' );



define( 'dewi_ADMIN_IMAGES_DIR', dewi_ADMIN_DIR . '/images' );

define( 'dewi_ADMIN_CSS_DIR', dewi_ADMIN_DIR . '/css' );





/** 

 * Define URL Location Constants 

 */

define( 'dewi_PARENT_URL', get_template_directory_uri() );

define( 'dewi_CHILD_URL', get_stylesheet_directory_uri() );



define( 'dewi_INCLUDES_URL', dewi_PARENT_URL. '/inc' );

define( 'dewi_CSS_URL', dewi_PARENT_URL . '/css' );

define( 'dewi_JS_URL', dewi_PARENT_URL . '/js' );

define( 'dewi_LANGUAGES_URL', dewi_PARENT_URL . '/languages' );

define( 'dewi_ASSETS_URL', dewi_PARENT_URL . '/assets' );



define( 'dewi_ADMIN_URL', dewi_INCLUDES_URL . '/admin' );

define( 'dewi_WIDGETS_URL', dewi_INCLUDES_URL . '/widgets' );



define( 'dewi_ADMIN_IMAGES_URL', dewi_ADMIN_URL . '/images' );

define( 'dewi_ADMIN_CSS_URL', dewi_ADMIN_URL . '/css' );



/** Load functions */

require_once( dewi_INCLUDES_DIR . '/custom-header.php' );

require_once( dewi_INCLUDES_DIR . '/functions.php' );

require_once( dewi_INCLUDES_DIR . '/header-functions.php' );



require_once( dewi_ADMIN_DIR . '/meta-boxes.php' );		



/** Load Widgets and Widgetized Area */
// I think the widgets in this theme might be risky. 
// I commented the line below to return to default widgets
//require_once( dewi_WIDGETS_DIR . '/widgets.php' );

/* These lines are designed to produce a simple widget area */
/**
 * Register our sidebars and widgetized areas.
 *
 */
function dewi_prov_widgets_init() {

	register_sidebar( array(
		'name' 				=> __( 'Right Sidebar', 'dewi' ),
		'id' 					=> 'dewi_right_sidebar',
		'description'   	=> __( 'Shows widgets at Right side.', 'dewi' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

}
add_action( 'widgets_init', 'dewi_prov_widgets_init' );



/**

 * Adds support for a theme option.

 */

 
if ( !function_exists( 'optionsframework_init' ) ) {

	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/admin/options/' );

	require_once( dewi_ADMIN_DIR . '/options/options-framework.php' );

	require_once( dewi_PARENT_DIR . '/options.php' );

}




// Custom functions
// ================

// The following functions have been written, or amended, for the OCWS dewi theme, which is a child theme of dewi.



function dewi_footer_copyright() {

	$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';



	$wp_link = '<a href="'.esc_url( 'http://wordpress.org' ).'" target="_blank" title="' . esc_attr__( 'WordPress', 'dewi' ) . '"><span>' . __( 'WordPress', 'dewi' ) . '</span></a>';

	

	$ocws_link = '<a href="'.esc_url( 'http://oldcastleweb.com' ).'" target="_blank" title="' . esc_attr__( 'Oldcastle Web Services', 'dewi' ) . '"><span>' . __( 'Oldcastle Web Services', 'dewi' ) . '</span></a>';



	$tg_link =  '<a href="'.esc_url( 'http://themegrill.com/themes/spacious' ).'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'dewi' ).'" rel="designer"><span>'.__( 'ThemeGrill', 'dewi') .'</span></a>';



	$default_footer_value = sprintf( __( 'Copyright &copy; %1$s by %2$s.', 'dewi' ), date( 'Y' ), $site_link ).' '.sprintf( __( 'Powered by %s,', 'dewi' ), $wp_link ).' '.sprintf( __( 'using the theme: <strong>%1$s</strong> from %2$s.', 'dewi' ), 'Dewi', $ocws_link ).' '.sprintf( __( '(<em>Adapted from the theme </em>%1$s<em>, from %2$s.</em>)', 'dewi' ), 'Spacious', $tg_link );



	$dewi_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';

	echo $dewi_footer_copyright;

}

function ocws_latest_news() { // 1 post and news cat is 4
	// at the moment this function is not working, so it is commented out in the header.php file

		$args = array(
		  'cat'            => 4,
		  'posts_per_page' => 3
		);

		$new_query = new WP_Query( $args );
		
		$ocws_string = ""; ?>
			<p class="ocws_marquee"><span><strong>Latest News:&nbsp;&nbsp;</strong>
		<?php
		$ocws_c = false;
		if ( $new_query->have_posts() ) :
		  while ( $new_query->have_posts() ) : $new_query->the_post(); 
				if ($ocws_c) {
					echo "&nbsp;&nbsp&mdash;&nbsp;&nbsp;";
				}
				$ocws_c = true;
				
				?>
			  <a href="<?php echo esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
			
		  <?php endwhile;
		endif; ?>
			</span></p>
		<?php

		wp_reset_postdata();

	return $ocws_string;

} // end function ocws_latest_news

function ocws_social_media_buttons() {// start of code to produce social media buttons

$ocws_smbpath = get_stylesheet_directory_uri()."/32x32/";
$fburl = "https://www.facebook.com/mshcreationcenter";
$twitterurl = "https://twitter.com/7wondersmuseum";
$youtubeurl = "https://www.youtube.com/7wondersmuseum";
$pinteresturl = "https://www.pinterest.com/7wondersmuseum";
$googleplusurl = "http://gplus.to/7wondersmuseum";
$tumblrurl = "http://7wondersmuseum.tumblr.com/";
$rssfeed = "http://feeds.feedburner.com/MSHCreationCenter";
$podcastfeed = "http://feeds.feedburner.com/tmatw";

?>
		<div id="ocws_social_media" class="ocws_social">
		<ul>
 		<li><a href="<?php echo $fburl; ?>" target="_blank" onMouseOver="document.btn_fb.src='<?php echo $ocws_smbpath; ?>fb.png'" onMouseOut="document.btn_fb.src='<?php echo $ocws_smbpath; ?>fb_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>fb_gray.png" alt="MSH Facebook Page" title="Facebook" name="btn_fb" />
		</a></li>
  		<li><a href="<?php echo $twitterurl; ?>" target="_blank" onMouseOver="document.btn_twitter.src='<?php echo $ocws_smbpath; ?>twitter.png'" onMouseOut="document.btn_twitter.src='<?php echo $ocws_smbpath; ?>twitter_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>twitter_gray.png" alt="MSH Twitter" title="Twitter" name="btn_twitter" />
		</a></li>
  		<li><a href="<?php echo $youtubeurl; ?>" target="_blank" onMouseOver="document.btn_youtube.src='<?php echo $ocws_smbpath; ?>youtube.png'" onMouseOut="document.btn_youtube.src='<?php echo $ocws_smbpath; ?>youtube_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>youtube_gray.png" alt="MSH Youtube Channel" title="YouTube Channel" name="btn_youtube" />
		</a></li>
  		<li><a href="<?php echo $pinteresturl; ?>" target="_blank" onMouseOver="document.btn_pinterest.src='<?php echo $ocws_smbpath; ?>pinterest.png'" onMouseOut="document.btn_pinterest.src='<?php echo $ocws_smbpath; ?>pinterest_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>pinterest_gray.png" alt="MSH Pinterest Page" title="Pinterest" name="btn_pinterest" />
		</a></li>
  		<li><a href="<?php echo $googleplusurl; ?>" target="_blank" onMouseOver="document.btn_googleplus.src='<?php echo $ocws_smbpath; ?>googleplus.png'" onMouseOut="document.btn_googleplus.src='<?php echo $ocws_smbpath; ?>googleplus_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>googleplus_gray.png" alt="MSH Google Plus Page" title="Google+" name="btn_googleplus" />
		</a></li>
  		<li><a href="<?php echo $tumblrurl; ?>" target="_blank" onMouseOver="document.btn_tumblr.src='<?php echo $ocws_smbpath; ?>tumblr.png'" onMouseOut="document.btn_tumblr.src='<?php echo $ocws_smbpath; ?>tumblr_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>tumblr_gray.png" alt="MSH Tumblr Blog" title="Tumblr Blog" name="btn_tumblr" />
		</a></li>
  		<li><a href="<?php echo $rssfeed; ?>" target="_blank" onMouseOver="document.btn_rss.src='<?php echo $ocws_smbpath; ?>rss.png'" onMouseOut="document.btn_rss.src='<?php echo $ocws_smbpath; ?>rss_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>rss_gray.png" alt="RSS Feed" title="RSS Feed" name="btn_rss" />
		</a></li>
  		<li><a href="<?php echo $podcastfeed; ?>" target="_blank" onMouseOver="document.btn_podcast.src='<?php echo $ocws_smbpath; ?>podcast.png'" onMouseOut="document.btn_podcast.src='<?php echo $ocws_smbpath; ?>podcast_gray.png'">
		<img src="<?php echo $ocws_smbpath; ?>podcast_gray.png" alt="Podcast Feed" title="Podcast Feed" name="btn_podcast" />
		</a></li>
		</ul>
		</div><!-- end of div id ocws_social_media -->

<?php
} // end of code to produce social media buttons / function ocws_social_media_buttons()


?>

