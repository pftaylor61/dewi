<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

if ( !function_exists( 'optionsframework_option_name' ) ) {
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	return $themename;
}
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	$options = array();

	// Header Options Area
	$options[] = array(
		'name' => __( 'Header', 'dewi' ),
		'type' => 'heading'
	);

	// Header Logo upload option
	$options[] = array(
		'name' 	=> __( 'Header Logo', 'dewi' ),
		'desc' 	=> __( 'Upload logo for your header. Recommended image size is 100 X 100 pixels.', 'dewi' ),
		'id' 		=> 'dewi_header_logo_image',
		'type' 	=> 'upload'
	);

	// Header logo and text display type option
	$header_display_array = array(
		'logo_only' 	=> __( 'Header Logo Only', 'dewi' ),
		'text_only' 	=> __( 'Header Text Only', 'dewi' ),
		'both' 	=> __( 'Show Both', 'dewi' ),
		'none'		 	=> __( 'Disable', 'dewi' )
	);
	$options[] = array(
		'name' 		=> __( 'Show', 'dewi' ),
		'desc' 		=> __( 'Choose the option that you want.', 'dewi' ),
		'id' 			=> 'dewi_show_header_logo_text',
		'std' 		=> 'text_only',
		'type' 		=> 'radio',
		'options' 	=> $header_display_array 
	);

	// Header Image replace postion
	$options[] = array(
		'name' => __( 'Need to replace Header Image?', 'dewi' ),
		'desc' => sprintf( __( '<a href="%1$s">Click Here</a>', 'dewi' ), admin_url('themes.php?page=custom-header') ),
		'type' => 'info'
	);

	// Header image position option
	$options[] = array(
		'name' 		=> __( 'Header Image Position', 'dewi' ),
		'desc' 		=> __( 'Choose top header image display position.', 'dewi' ),
		'id' 			=> 'dewi_header_image_position',
		'std' 		=> 'above',
		'type' 		=> 'radio',
		'options' 	=> array(
							'above' => __( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'dewi' ),
							'below' => __( 'Position Below: Display the Header image just below the site title and main menu part.', 'dewi' )
						)

	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Design', 'dewi' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' 		=> __( 'Site Layout', 'dewi' ),
		'desc' 		=> __( 'Choose your site layout. The change is reflected in whole site.', 'dewi' ),
		'id' 			=> 'dewi_site_layout',
		'std' 		=> 'box_1218px',
		'type' 		=> 'radio',
		'options' 	=> array(
							'box_1218px' 	=> __( 'Boxed layout with content width of 1218px', 'dewi' ),
							'box_978px' 	=> __( 'Boxed layout with content width of 978px', 'dewi' ),
							'wide_1218px' 	=> __( 'Wide layout with content width of 1218px', 'dewi' ),
							'wide_978px' 	=> __( 'Wide layout with content width of 978px', 'dewi' ),
						)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout', 'dewi' ),
		'desc' 		=> __( 'Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.', 'dewi' ),
		'id' 			=> 'dewi_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> dewi_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> dewi_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> dewi_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> dewi_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout for pages only', 'dewi' ),
		'desc' 		=> __( 'Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'dewi' ),
		'id' 			=> 'dewi_pages_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> dewi_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> dewi_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> dewi_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> dewi_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout for single posts only', 'dewi' ),
		'desc' 		=> __( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'dewi' ),
		'id' 			=> 'dewi_single_posts_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> dewi_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> dewi_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> dewi_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> dewi_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Blog Posts display type', 'dewi' ),
		'desc' 		=> __( 'Choose the display type for the latests posts view or posts page view (static front page).', 'dewi' ),
		'id' 			=> 'dewi_archive_display_type',
		'std' 		=> 'blog_large',
		'type' 		=> 'radio',
		'options' 	=> array(
							'blog_large' 	=> __( 'Blog Image Large', 'dewi' ),
							'blog_medium' 	=> __( 'Blog Image Medium', 'dewi' ),
							'blog_medium_alternate' 	=> __( 'Blog Image Alternate Medium', 'dewi' ),
							'blog_full_content' 	=> __( 'Blog Full Content', 'dewi' ),
						)
	);

	// Site primary color option
	$options[] = array(
		'name' 		=> __( 'Primary color option', 'dewi' ),
		'desc' 		=> __( 'This will reflect in links, buttons and many others. Choose a color to match your site.', 'dewi' ),
		'id' 			=> 'dewi_primary_color',
		'std' 		=> '#0FBE7C',
		'type' 		=> 'color' 
	);

	// Site dark light skin option
	$options[] = array(
		'name' 		=> __( 'Color Skin', 'dewi' ),
		'desc' 		=> __( 'Choose the light or dark skin. This will be reflected in whole site.', 'dewi' ),
		'id' 			=> 'dewi_color_skin',
		'std' 		=> 'light',
		'type' 		=> 'images',
		'options' 	=> array(
							'light' 	=> dewi_ADMIN_IMAGES_URL . '/light-color.jpg',
							'dark' 	=> dewi_ADMIN_IMAGES_URL . '/dark-color.jpg'
						)
	);	

	$options[] = array(
		'name' 		=> __( 'Need to replace default background?', 'dewi' ),
		'desc' 		=> sprintf( __( '<a href="%1$s">Click Here</a>', 'dewi' ), admin_url('themes.php?page=custom-background') ).'&nbsp;&nbsp;&nbsp;'.__( 'Note: The background will only be seen if you choose any of the boxed layout option in site layout option.', 'dewi' ),
		'type' 		=> 'info'
	);

	$options[] = array(
		'name' 		=> __( 'Custom CSS', 'dewi' ),
		'desc' 		=> __( 'Write your custom css.', 'dewi' ),
		'id' 			=> 'dewi_custom_css',
		'std' 		=> '',
		'type' 		=> 'textarea'
	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Additional', 'dewi' ),
		'type' => 'heading'
	);

	// Favicon activate option
	$options[] = array(
		'name' 		=> __( 'Activate favicon', 'dewi' ),
		'desc' 		=> __( 'Check to activate favicon. Upload fav icon from below option', 'dewi' ),
		'id' 			=> 'dewi_activate_favicon',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	// Fav icon upload option
	$options[] = array(
		'name' 	=> __( 'Upload favicon', 'dewi' ),
		'desc' 	=> __( 'Upload favicon for your site.', 'dewi' ),
		'id' 		=> 'dewi_favicon',
		'type' 	=> 'upload'
	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Slider', 'dewi' ),
		'type' => 'heading'
	);

	// Slider activate option
	$options[] = array(
		'name' 		=> __( 'Activate slider', 'dewi' ),
		'desc' 		=> __( 'Check to activate slider.', 'dewi' ),
		'id' 			=> 'dewi_activate_slider',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	// Disable slider in blog page
	$options[] = array(
		'name' 		=> __( 'Disable slider in Posts page', 'dewi' ),
		'desc' 		=> __( 'Check to disable slider in Posts Page', 'dewi' ),
		'id' 			=> 'dewi_blog_slider',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	// Slide options
	for( $i=1; $i<=5; $i++) {
		$options[] = array(
			'name' 	=>	sprintf( __( 'Image Upload #%1$s', 'dewi' ), $i ),
			'desc' 	=> __( 'Upload slider image.', 'dewi' ),
			'id' 		=> 'dewi_slider_image'.$i,
			'type' 	=> 'upload'
		);
		$options[] = array(
			'desc' 	=> __( 'Enter title for your slider.', 'dewi' ),
			'id' 		=> 'dewi_slider_title'.$i,
			'std' 	=> '',
			'type' 	=> 'text'
		);
		$options[] = array(
			'desc' 	=> __( 'Enter your slider description.', 'dewi' ),
			'id' 		=> 'dewi_slider_text'.$i,
			'std' 	=> '',
			'type' 	=> 'textarea'
		);
		$options[] = array(
			'desc' 	=> __( 'Enter the button text. Default is "Read more"', 'dewi' ),
			'id' 		=> 'dewi_slider_button_text'.$i,
			'std' 	=> __( 'Read more', 'dewi' ),
			'type' 	=> 'text'
		);
		$options[] = array(
			'desc' 	=> __( 'Enter link to redirect slider when clicked', 'dewi' ),
			'id' 		=> 'dewi_slider_link'.$i,
			'std' 	=> '',
			'type' 	=> 'text'
		);
	}	

	return $options;
}

add_action( 'optionsframework_after','dewi_options_display_sidebar' );

/**
 * dewi admin sidebar
 */
function dewi_options_display_sidebar() { 
	 ?>
        <div id="optionsframework-sidebar">
		<div class="metabox-holder">
	    	<div class="ocws_postbox">
	    		<h3><?php esc_attr_e( 'About Dewi', 'dewi' ); ?></h3>
                        <img src="<?php echo dewi_ASSETS_URL.'/screenshot240.png'; ?>" style="margin-right:auto; margin-left:auto;" />
      			<div class="ocws_inside_box"> 
                            <p><strong>Dewi</strong> is a responsive theme, produced by <a href="http://www.oldcastleweb.com" target="_blank">Old Castle Web Services</a>. It grew out of a fork of the <em>Spacious</em> theme, produced by ThemeGrill, and contains code from the <a href="https://github.com/devinsays/options-framework-theme" target="_blank">Options Framework</a> plugin.</p>
	      			
      			</div><!-- ocws_inside_box -->
	    	</div><!-- .ocws_postbox -->
	  	</div><!-- .metabox-holder -->
	</div><!-- #optionsframework-sidebar -->
        
        
<?php
}
?>