<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package F4D
 * @since F4D 1.0
 */
?>

		<?php	do_action( 'f4d_after_woocommerce' ); ?>
	</div> <!-- /#maincontentcontainer -->

	<div id="footercontainer">

		<footer class="site-footer" role="contentinfo">
        

			<?php
			// Count how many footer sidebars are active so we can work out how many containers we need
			$footerSidebars = 0;
			for ( $x=1; $x<=4; $x++ ) {
				if ( is_active_sidebar( 'sidebar-footer' . $x ) ) {
					$footerSidebars++;
				}
			}

			// If there's one or more one active sidebars, create a row and add them
			if ( $footerSidebars > 0 ) { ?>
            <div class="footer-widgets row">
				<?php
				// Work out the container class name based on the number of active footer sidebars
				$containerClass = "grid_" . 12 / $footerSidebars . "_of_12";

				// Display the active footer sidebars
				for ( $x=1; $x<=4; $x++ ) {
					if ( is_active_sidebar( 'sidebar-footer'. $x ) ) { ?>
						<div class="col <?php echo $containerClass?>">
							<div class="widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-footer'. $x ); ?>
							</div>
						</div> <!-- /.col.<?php echo $containerClass?> -->
					<?php }
				} ?>
</div>
			<?php } ?>
            
            <?php
if ( has_nav_menu( 'footer-menu' ) ) {?>
<div class="footer-menu">
<div class="footer-menu-inner">
    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
    </div></div>
<?php } ?>


<?php 
$nap = get_field('display_nap', 'option');
$nap_loc = get_field('nap_location', 'option');
$socialplace = get_field('social_media_location', 'option');
if ($nap == 'yes' && $nap_loc == 'footer') {
	$nap = 'show';
}
?>

<?php 
if ($nap == 'show' || $socialplace == 'footer') {?>
	<div class="footer-contact">
    <div class="footer-contact-inner">
<?php }
?>

<?php 
	if ($nap == 'show') {
	$nap_name = get_field('nap_name', 'option');
	$nap_add = get_field('nap_address', 'option');
	$nap_add_url = get_field('nap_address_url', 'option');
	$nap_phone = get_field('nap_phone', 'option');
	$nap_email = get_field('nap_email', 'option');
	?>
    
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
<?php }

?>
                
					<?php 
					if ($socialplace == "footer"){ ?>
                    <div class="social-media-icons">
						<?php echo f4d_get_social_media(); ?>
                        </div>
					<?php }?>
                    
                    <?php 
if ($nap == 'show' || $socialplace == 'footer') {?>
	</div>
    </div>
<?php }
?>
				
		</footer> <!-- /.site-footer.row -->

		<?php if ( of_get_option( 'footer_content', f4d_get_credits() ) ) {
			echo '<div class="row smallprint">';
			echo apply_filters( 'meta_content', wp_kses_post( of_get_option( 'footer_content', f4d_get_credits() ) ) );
			echo '</div> <!-- /.smallprint -->';
		} ?>

	</div> <!-- /.footercontainer -->

</div> <!-- /.#wrapper.hfeed.site -->

<?php wp_footer(); ?>
</body>

</html>
