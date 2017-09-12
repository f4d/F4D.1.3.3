<div id="login-bar-header" class="primary-tooltips">
	<?php if ( !is_user_logged_in() ) { ?>
	<a href="<?php echo '#login-modal'; ?>" class="jq-st-btn" data-target="login-modal" data-add="show-modal">Tenant Login</a>
	<?php }	
	// Logged-In User
	else {
	?>
	<a href="/profile"><?php _e( 'Profile', 'tt' ); ?></a>
	<a href="<?php echo wp_logout_url( site_url('/') ); ?>"><?php _e( 'Logout', 'tt' ); ?></a>
	<?php } ?>
</div>
