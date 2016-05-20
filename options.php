<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace( "/\W/", "_", strtolower( $themename ) );
	return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace f4d
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// If using image radio buttons, define a directory path
	$imagepath =  trailingslashit( get_template_directory_uri() ) . 'images/';

	// Background Defaults
	$background_defaults = array(
		'color' => '#222222',
		'image' => $imagepath . 'dark-noise.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' );

	// Editor settings
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	// Footer Position settings
	$footer_position_settings = array(
		'left' => esc_html__( 'Left aligned', f4d ),
		'center' => esc_html__( 'Center aligned', f4d ),
		'right' => esc_html__( 'Right aligned', f4d )
	);

	// Number of shop products
	$shop_products_settings = array(
		'4' => esc_html__( '4 Products', f4d ),
		'8' => esc_html__( '8 Products', f4d ),
		'12' => esc_html__( '12 Products', f4d ),
		'16' => esc_html__( '16 Products', f4d ),
		'20' => esc_html__( '20 Products', f4d ),
		'24' => esc_html__( '24 Products', f4d ),
		'28' => esc_html__( '28 Products', f4d )
	);

	$options = array();

	$options[] = array(
		'name' => esc_html__( 'Basic Settings', f4d ),
		'type' => 'heading' );

	$options[] = array(
		'name' => esc_html__( 'Background', f4d ),
		'desc' => sprintf( wp_kses( __( 'If you&rsquo;d like to replace or remove the default background image, use the <a href="%1$s" title="Custom background">Appearance &gt; Background</a> menu option.', f4d ), array(
			'a' => array(
				'href' => array(),
				'title' => array() )
			) ), admin_url( 'themes.php?page=custom-background' ) ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__( 'Logo', f4d ),
		'desc' => sprintf( wp_kses( __( 'If you&rsquo;d like to replace or remove the default logo, use the <a href="%1$s" title="Custom header">Appearance &gt; Header</a> menu option.', f4d ), array(
			'a' => array(
				'href' => array(),
				'title' => array() )
			) ), admin_url( 'themes.php?page=custom-header' ) ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__( 'Social Media Settings', f4d ),
		'desc' => esc_html__( 'Enter the URLs for your Social Media platforms. You can also optionally specify whether you want these links opened in a new browser tab/window.', f4d ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__('Open links in new Window/Tab', f4d),
		'desc' => esc_html__('Open the social media links in a new browser tab/window', f4d),
		'id' => 'social_newtab',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => esc_html__( 'Twitter', f4d ),
		'desc' => esc_html__( 'Enter your Twitter URL.', f4d ),
		'id' => 'social_twitter',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Facebook', f4d ),
		'desc' => esc_html__( 'Enter your Facebook URL.', f4d ),
		'id' => 'social_facebook',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Google+', f4d ),
		'desc' => esc_html__( 'Enter your Google+ URL.', f4d ),
		'id' => 'social_googleplus',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'LinkedIn', f4d ),
		'desc' => esc_html__( 'Enter your LinkedIn URL.', f4d ),
		'id' => 'social_linkedin',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'SlideShare', f4d ),
		'desc' => esc_html__( 'Enter your SlideShare URL.', f4d ),
		'id' => 'social_slideshare',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Slack', f4d ),
		'desc' => esc_html__( 'Enter your Slack URL.', f4d ),
		'id' => 'social_slack',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Dribbble', f4d ),
		'desc' => esc_html__( 'Enter your Dribbble URL.', f4d ),
		'id' => 'social_dribbble',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Tumblr', f4d ),
		'desc' => esc_html__( 'Enter your Tumblr URL.', f4d ),
		'id' => 'social_tumblr',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Reddit', f4d ),
		'desc' => esc_html__( 'Enter your Reddit URL.', f4d ),
		'id' => 'social_reddit',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Twitch', f4d ),
		'desc' => esc_html__( 'Enter your Twitch URL.', f4d ),
		'id' => 'social_twitch',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'GitHub', f4d ),
		'desc' => esc_html__( 'Enter your GitHub URL.', f4d ),
		'id' => 'social_github',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Bitbucket', f4d ),
		'desc' => esc_html__( 'Enter your Bitbucket URL.', f4d ),
		'id' => 'social_bitbucket',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Stack Overflow', f4d ),
		'desc' => esc_html__( 'Enter your Stack Overflow URL.', f4d ),
		'id' => 'social_stackoverflow',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'CodePen', f4d ),
		'desc' => esc_html__( 'Enter your CodePen URL.', f4d ),
		'id' => 'social_codepen',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Foursquare', f4d ),
		'desc' => esc_html__( 'Enter your Foursquare URL.', f4d ),
		'id' => 'social_foursquare',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'YouTube', f4d ),
		'desc' => esc_html__( 'Enter your YouTube URL.', f4d ),
		'id' => 'social_youtube',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Vimeo', f4d ),
		'desc' => esc_html__( 'Enter your Vimeo URL.', f4d ),
		'id' => 'social_vimeo',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Instagram', f4d ),
		'desc' => esc_html__( 'Enter your Instagram URL.', f4d ),
		'id' => 'social_instagram',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Vine', f4d ),
		'desc' => esc_html__( 'Enter your Vine URL.', f4d ),
		'id' => 'social_vine',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Snapchat', f4d ),
		'desc' => esc_html__( 'Enter your Snapchat URL.', f4d ),
		'id' => 'social_snapchat',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Flickr', f4d ),
		'desc' => esc_html__( 'Enter your Flickr URL.', f4d ),
		'id' => 'social_flickr',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Pinterest', f4d ),
		'desc' => esc_html__( 'Enter your Pinterest URL.', f4d ),
		'id' => 'social_pinterest',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'RSS', f4d ),
		'desc' => esc_html__( 'Enter your RSS Feed URL.', f4d ),
		'id' => 'social_rss',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Advanced settings', f4d ),
		'type' => 'heading' );

	$options[] = array(
		'name' =>  esc_html__( 'Banner Background', f4d ),
		'desc' => esc_html__( 'Select an image and background color for the homepage banner.', f4d ),
		'id' => 'banner_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => esc_html__( 'Footer Background Color', f4d ),
		'desc' => esc_html__( 'Select the background color for the footer.', f4d ),
		'id' => 'footer_color',
		'std' => '#222222',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_html__( 'Footer Content', f4d ),
		'desc' => esc_html__( 'Enter the text you&lsquo;d like to display in the footer. This content will be displayed just below the footer widgets. It&lsquo;s ideal for displaying your copyright message or credits.', f4d ),
		'id' => 'footer_content',
		'std' => f4d_get_credits(),
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$options[] = array(
		'name' => esc_html__( 'Footer Content Position', f4d ),
		'desc' => esc_html__( 'Select what position you would like the footer content aligned to.', f4d ),
		'id' => 'footer_position',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini',
		'options' => $footer_position_settings );

	if( f4d_is_woocommerce_active() ) {
		$options[] = array(
		'name' => esc_html__( 'WooCommerce settings', f4d ),
		'type' => 'heading' );

		$options[] = array(
			'name' => esc_html__('Shop sidebar', f4d),
			'desc' => esc_html__('Display the sidebar on the WooCommerce Shop page', f4d),
			'id' => 'woocommerce_shopsidebar',
			'std' => '1',
			'type' => 'checkbox');

		$options[] = array(
			'name' => esc_html__('Products sidebar', f4d),
			'desc' => esc_html__('Display the sidebar on the WooCommerce Single Product page', f4d),
			'id' => 'woocommerce_productsidebar',
			'std' => '1',
			'type' => 'checkbox');

		$options[] = array(
			'name' => esc_html__( 'Cart, Checkout & My Account sidebars', f4d ),
			'desc' => esc_html__( 'The &lsquo;Cart&rsquo;, &lsquo;Checkout&rsquo; and &lsquo;My Account&rsquo; pages are displayed using shortcodes. To remove the sidebar from these Pages, simply edit each Page and change the Template (in the Page Attributes Panel) to the &lsquo;Full-width Page Template&rsquo;.', f4d ),
			'type' => 'info' );

		$options[] = array(
			'name' => esc_html__('Shop Breadcrumbs', f4d),
			'desc' => esc_html__('Display the breadcrumbs on the WooCommerce pages', f4d),
			'id' => 'woocommerce_breadcrumbs',
			'std' => '1',
			'type' => 'checkbox');

		$options[] = array(
			'name' => esc_html__( 'Shop Products', f4d ),
			'desc' => esc_html__( 'Select the number of products to display on the shop page.', f4d ),
			'id' => 'shop_products',
			'std' => '12',
			'type' => 'select',
			'class' => 'mini',
			'options' => $shop_products_settings );

	}

	return $options;
}
