<?php

/**

 * Theme Header Section for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">

 *

 * @package Old Castle Web Services
 * @subpackage dewi
 * @since dewi 1.3.3
 * This version by Old Castle Web Services, 2015 - based on Spacious by ThemeGrill

 */

?>

<!DOCTYPE html>

<!--[if IE 7]>

<html class="ie ie7" <?php language_attributes(); ?>>

<![endif]-->

<!--[if IE 8]>

<html class="ie ie8" <?php language_attributes(); ?>>

<![endif]-->

<!--[if !(IE 7) & !(IE 8)]><!-->

<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>

	<?php

	/**

	 * Print the <title> tag based on what is being viewed.

	 */

	wp_title( '|', true, 'right' );

	echo " MSH Creation Center";

	?>

</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php

/**

 * This hook is important for wordpress plugins and other many things

 */

wp_head();

?>
<?php
$ocws_smbpath = get_stylesheet_directory_uri()."/32x32/";
?>
<script language = "JavaScript">

function preloader() 

{

fbimage = new Image(); 
fbimage.src = <?php echo $ocws_smbpath; ?> + "fb.png";
twitterimage = new Image(); 
twitterimage.src = <?php echo $ocws_smbpath; ?> + "twitter.png";
youtubeimage = new Image(); 
youtubeimage.src = <?php echo $ocws_smbpath; ?> + "youtube.png";
pinterestimage = new Image(); 
pinterestimage.src = <?php echo $ocws_smbpath; ?> + "pinterest.png";
googleplusimage = new Image(); 
googleplusimage.src = <?php echo $ocws_smbpath; ?> + "googleplus.png";
tumblrimage = new Image(); 
tumblrimage.src = <?php echo $ocws_smbpath; ?> + "tumblr.png";
rssimage = new Image(); 
rssimage.src = <?php echo $ocws_smbpath; ?> + "rss.png";
podcastimage = new Image(); 
podcastimage.src = <?php echo $ocws_smbpath; ?> + "podcast.png";

}

</script>

</head>



<body onLoad="javascript:preloader()" <?php body_class(); ?>>
<a href="https://plus.google.com/109879549069360646399" rel="publisher"></a>

<?php	do_action( 'before' ); ?>


<div id="page" class="hfeed site">
		<?php ocws_social_media_buttons(); ?>
		


	<?php do_action( 'dewi_before_header' ); ?>

	<header id="masthead" class="site-header clearfix">
	<!-- Start of news section                  -->
<!-- This is where the News section will go -->

	<div id="ocws_newssection" class="ocws_nsstyle">
	
	<?php
		echo ocws_latest_news();
		// echo "( See Main Site > News )";
	?>
	
	</div><!-- //end of div ocws_newssection -->

<!-- End of News Section                    -->



		<?php if( of_get_option( 'dewi_header_image_position', 'above' ) == 'above' ) { dewi_render_header_image(); } ?>



		<div id="header-text-nav-container">

			<div class="inner-wrap">



				<div id="header-text-nav-wrap" class="clearfix">

					<div id="header-left-section">

						<?php

						if( ( of_get_option( 'dewi_show_header_logo_text', 'text_only' ) == 'both' || of_get_option( 'dewi_show_header_logo_text', 'text_only' ) == 'logo_only' ) && of_get_option( 'dewi_header_logo_image', '' ) != '' ) {

						?>

							<div id="header-logo-image">

								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option( 'dewi_header_logo_image', '' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>

							</div><!-- #header-logo-image -->
							


						<?php

						}
						
						?>


							
						<?php

						if( of_get_option( 'dewi_show_header_logo_text', 'text_only' ) == 'both' || of_get_option( 'dewi_show_header_logo_text', 'text_only' ) == 'text_only' ) {

						?>



						<div id="header-text">

							<h1 id="site-title">

								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

							</h1>

							<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2><!-- #site-description -->

						</div><!-- #header-text -->

						<?php

						}

						?>

					</div><!-- #header-left-section -->

					<div id="header-right-section">

						<?php

						if( is_active_sidebar( 'dewi_header_sidebar' ) ) {

						?>

						<div id="header-right-sidebar" class="clearfix">

						<?php

							// Calling the header sidebar if it exists.

							if ( !dynamic_sidebar( 'dewi_header_sidebar' ) ):

							endif;

						?>

						</div>

						<?php

						}

						?>

						<nav id="site-navigation" class="main-navigation" role="navigation">

							<h3 class="menu-toggle"><?php _e( 'Menu', 'dewi' ); ?></h3>

							<?php

								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu( array( 'theme_location' => 'primary' ) );

								}

								else {

									wp_page_menu();

								}

							?>

						</nav>

			    	</div><!-- #header-right-section -->



			   </div><!-- #header-text-nav-wrap -->

			</div><!-- .inner-wrap -->

		</div><!-- #header-text-nav-container -->



		<?php if( of_get_option( 'dewi_header_image_position', 'above' ) == 'below' ) { dewi_render_header_image(); } ?>



		<?php

   	if( of_get_option( 'dewi_activate_slider', '0' ) == '1' ) {

   		if( of_get_option( 'dewi_blog_slider', '0' ) == '0' ) {

   			if( is_home() || is_front_page() ) {

   				dewi_featured_image_slider();

			}

   		} else {

   			if( is_front_page() ) {

   				dewi_featured_image_slider();

   			}

   		}

   	}



		if( ( '' != dewi_header_title() )  && !( is_front_page() ) ) {

			if( !( of_get_option( 'dewi_blog_slider', '0' ) == '0' && is_home( ) ) ){ ?>

				<div class="header-post-title-container clearfix">

					<div class="inner-wrap">

						<div class="post-title-wrapper">

							<?php

							if( '' != dewi_header_title() ) {

							?>

						   	<h1 class="header-post-title-class"><?php echo dewi_header_title(); ?></h1>

						   <?php

							}

							?>

						</div>

						<?php if( function_exists( 'dewi_breadcrumb' ) ) { dewi_breadcrumb(); } ?>

					</div>

				</div>

			<?php

			}

	   	}

		?>

	</header>

	<?php do_action( 'dewi_after_header' ); ?>

	<?php do_action( 'dewi_before_main' ); ?>

	<div id="main" class="clearfix">

		<div class="inner-wrap">