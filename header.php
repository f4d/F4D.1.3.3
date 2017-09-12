<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package F4D
 * @since F4D 1.0
 */
?><!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->


<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta http-equiv="cleartype" content="on">

	<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head();
	$business_schema = get_field('business_schema', 'option');
	$founder = get_field('founder', 'option');
	$street_address = get_field('street_address', 'option');
	$address_city = get_field('address_city', 'option');
	$address_state = get_field('address_state', 'option');
	$address_zip = get_field('address_zip', 'option');
	$naics = get_field('naics', 'option');
	$nap = get_field('display_nap', 'option');
	$nap_loc = get_field('nap_location', 'option');
	$nap_name = get_field('nap_name', 'option');
	$company_description = get_field('company_description', 'option');
	$nap_add = $street_address . ' ' . $address_city . ', ' . $address_state . ' ' . $address_zip;
	$nap_add_url = get_field('nap_address_url', 'option');
	$nap_phone = get_field('nap_phone', 'option');
	$nap_email = get_field('nap_email', 'option');
	$attachment_id = get_field('header_logo', 'option');
	$metadata = wp_get_attachment_metadata($attachment_id);	
	$img_size = $metadata['width'];			
	$logo_url = $metadata['file'];
	$socialplace = get_field('social_media_location', 'option');
	$header_function = get_field('header_function', 'option');
	$logo_place = get_field('logo_placement', 'option');
	$mobile_nav = get_field('mobile_nav', 'option');
	$member_of = get_field('member', 'option');
	?>
	
	<?php if ($business_schema == "Yes") {?>
	<script type="application/ld+json">
		{
  			"@context": "http://schema.org",
  			"@type": "LocalBusiness",
  			"address": {
    		"@type": "PostalAddress",
    		<?php if (!empty( $address_city )) { echo '
			"addressLocality": "' . $address_city . '",'; }
			if (!empty( $address_state )) { echo '
			"addressRegion": "' . $address_state . '",'; }
			if (!empty( $address_zip )) { echo '
			"postalCode": "' . $address_zip . '",'; }
			if (!empty( $street_address )) { echo '
			"streetAddress": "' . $street_address . '"'; }
			?>
		},
			<?php if (!empty( $company_description )) { echo '
			"description": "' . $company_description . '",'; }
			if (!empty( $nap_name )) { echo '
			"name": "' . $nap_name . '",'; }
			if (!empty( $nap_phone )) { echo '
			"telephone": "' . $nap_phone . '",'; }
			if (!empty( $naics )) { echo '
			"naics": "' . $naics . '",
			'; }
			echo '"logo": "';
			echo site_url() . '/wp-content/uploads/' . $logo_url . '",
			"url": "'; 
			echo site_url(); 
			echo '",';
			if (!empty( $founder )) { echo '
			"founder": "' . $founder . '",
			'; } ?>
			<?php if(!empty( $member_of )){
					$i=0;
					echo '"memberof": [';  
					foreach ( $member_of as $member ) {
						$memberName = $member['name'];
						$memberURL = $member['url'];
						if ($i > 0) {echo ',';}
						echo '{';
						echo '"name": "';
						echo $memberName;
					   	echo '",';
						echo '"url": "';
						echo $memberURL;
						echo '"';
						echo '}';
						$i++;
					}
					echo '],';
			}; ?>
			
  			"openingHours": [
   				"Mo-Fr 9:00-17:00"
  			]
		}
	</script>
	<?php } ?>
</head>

<body <?php body_class(); ?> id="f4d-body">

<div id="wrapper" class="hfeed site mobile-<?php echo $mobile_nav ?>">
	<div class="top-bar">
		<div class="top-bar-inner">
			<?php 
			if ($nap == 'yes' && $nap_loc == 'top') { ?>
		    
		    	<div id="NAP">
		    		<?php if ( !empty( $nap_name ) ) { ?>
						<div id="NAP-name">
							<?php echo $nap_name; ?>
						</div>
					<?php } ?>
		   	 
		   		 	<?php if ( !empty( $nap_add ) ) { ?>
		    			<div id="NAP-address">
		         			<?php if ( !empty( $nap_add_url ) ) {?>
		         				<a href="<?php echo $nap_add_url; ?>" title="Get directions"><i class="fa fa-location-arrow" aria-hidden="true"></i> <span><?php echo $nap_add; ?></span></a>
							<?php }
				 			else {?>
		         				<?php echo $nap_add; ?>
							<?php }?>
		        		</div>
					<?php } ?>
		    
		    		<?php if ( !empty( $nap_email ) ) { ?>
						<div id="NAP-email">
							<a href="mailto:<?php echo $nap_phone; ?>" title="Email us"><i class="fa fa-envelope" aria-hidden="true"></i> <span><?php echo $nap_email; ?></span></a>
						</div>
					<?php } ?>
		    
		    		<?php if ( !empty( $nap_phone ) ) { ?>
						<div id="NAP-phone">
							<a href="tel:<?php echo preg_replace("/[^0-9,.]/", "", $nap_phone); ?>" title="Call us"><i class="fa fa-phone" aria-hidden="true"></i> <span><?php echo $nap_phone; ?></span></a>
						</div>
					<?php } ?>
		    	</div>
			<?php } ?>

			<?php if ($socialplace == "header"){ ?>
		    	<div class="social-media-icons">
					<?php echo f4d_get_social_media(); ?>
		        </div>
			<?php }?>

			<?php if ( has_nav_menu( 'top-bar-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'top-bar-menu', 'menu_class' => 'top-bar-menu', 'container_class' => 'menu-top-bar-container' ) );
			} ?>
		</div> <!-- top-bar-inner -->
	</div><!-- top-bar -->
		
	<?php 
				
	if ( !empty($attachment_id)) {
		$width = '' . $img_size . 'px';
	}
				
	else {
		$width = '300px';
	}
								
	$logo_url = $metadata['file'];
				
				
	if ($logo_place == 'center') {
		$width = '100%';
	}
				
	if ($logo_place == 'center') {
		$nav_loc = get_field('main_nav_location', 'option');
	}
	else {
		$nav_loc = get_field('main_nav_location_side', 'option');	
	}	?>
	<div id="headercontainer" class="logo-<?php echo $logo_place; ?> <?php echo $header_function ?>">
    	<?php if ($nav_loc == "above") {?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h3 class="menu-toggle jq-st-btn" data-target="f4d-body" data-class="mobile-test"><?php esc_html_e( 'Menu', 'f4d' ); ?></h3>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'f4d' ); ?>"><?php esc_html_e( 'Skip to content', 'f4d' ); ?></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_class' => 'menu-main_menu-container' ) ); ?>
				<?php if ( has_nav_menu( 'secondary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'container_class' => 'menu-main-sub_menu-container' ) ); 
				}?>
			</nav> <!-- /.site-navigation.main-navigation -->
		<?php } ?>
		<header id="masthead" class="site-header row" role="banner">
        	<div id="masthead-inner">
            	<div class="site-title" style="max-width: <?php echo $width; ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
						<?php 
						if( !empty( $attachment_id ) ) { ?>
							<img src="/wp-content/uploads/<?php echo $logo_url; ?>" alt="<?php echo get_bloginfo( 'name' ); ?> Logo" />
						<?php } 
						else {
							echo get_bloginfo( 'name' );
						} ?>
					</a>
				</div> <!-- /.site-title -->

				<div class="site-header-content">
					<?php if ( is_active_sidebar( 'top-widget-area' ) ) { ?>
						<div id="top-widget-area">
							<div id="top-widget-area-inner" role="complementary">
								<?php dynamic_sidebar( 'top-widget-area' ); ?>
							</div>
						</div> <!-- /top-widget-area -->
					<?php } ?>

					<?php if ($nav_loc == "inline") {?>
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<h3 class="menu-toggle jq-st-btn" data-target="f4d-body" data-class="mobile-opened"><?php esc_html_e( 'Menu', 'f4d' ); ?></h3>
							<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'f4d' ); ?>"><?php esc_html_e( 'Skip to content', 'f4d' ); ?></a></div>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_class' => 'menu-main_menu-container' ) ); ?>
							<?php if ( has_nav_menu( 'secondary' ) ) {
								wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'container_class' => 'menu-main-sub_menu-container' ) ); 
							}?>
						</nav> <!-- /.site-navigation.main-navigation -->
					<?php } ?>

				</div> <!-- /.site-header-content --> 
   			</div><!-- .masthead-inner -->
            <?php if ($nav_loc == "under") {?>
            	<nav id="site-navigation" class="main-navigation" role="navigation">
					<h3 class="menu-toggle jq-st-btn" data-target="f4d-body" data-class="mobile-test"><?php esc_html_e( 'Menu', 'f4d' ); ?></h3>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'f4d' ); ?>"><?php esc_html_e( 'Skip to content', 'f4d' ); ?></a></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_class' => 'menu-main_menu-container' ) ); ?>
					<?php if ( has_nav_menu( 'secondary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'container_class' => 'menu-main-sub_menu-container' ) ); 
					}?>
				</nav> <!-- /.site-navigation.main-navigation -->
			<?php } ?>
		</header> <!-- /#masthead.site-header.row -->
	</div> <!-- /#headercontainer -->
	<div id="bannercontainer">
		<div class="banner row">
			<?php if ( is_front_page() ) {
				// Count how many banner sidebars are active so we can work out how many containers we need
				$bannerSidebars = 0;
				for ( $x=1; $x<=2; $x++ ) {
					if ( is_active_sidebar( 'frontpage-banner' . $x ) ) {
						$bannerSidebars++;
					}
				}

				// If there's one or more one active sidebars, create a row and add them
				if ( $bannerSidebars > 0 ) { ?>
					<?php
					// Work out the container class name based on the number of active banner sidebars
					$containerClass = "grid_" . 12 / $bannerSidebars . "_of_12";

					// Display the active banner sidebars
					for ( $x=1; $x<=2; $x++ ) {
						if ( is_active_sidebar( 'frontpage-banner'. $x ) ) { ?>
							<div class="col <?php echo $containerClass?>">
								<div class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'frontpage-banner'. $x ); ?>
								</div> <!-- /.widget-area -->
							</div> <!-- /.col.<?php echo $containerClass?> -->
						<?php }
					} ?>

				<?php }
			} ?>
		</div> <!-- /.banner.row -->
	</div> <!-- /#bannercontainer -->

	<div id="maincontentcontainer">
		<?php	do_action( 'f4d_before_woocommerce' ); ?>
