<?php 
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog login-modal-content">
    <div class="modal-content">    	
      <div class="modal-header">
      	<button type="button" class="close jq-st-btn" data-target="login-modal" data-remove="show-modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">

				<div class="tab-content">
						
					<div class="tab-pane active" id="tab-login">
						<?php	if( isset($_GET['login']) && $_GET['login'] == 'failed' ) { ?>
						<p id="login-error" class="text-danger"><small><?php _e( 'Incorrect login details. Please enter your username and password, and submit again.', 'tt' ); ?></small></p>
						<?php } 
						wp_login_form( array( "id_submit" => "wp-submit-login", "label_username" => __( 'Username / Email', 'tt' ) ) ); 
						if ( !is_user_logged_in() && is_plugin_active( 'wordpress-social-login/wp-social-login.php' ) ) {
							//echo do_shortcode('[wordpress_social_login]');
							do_action( 'wordpress_social_login' );
						}
						?>
					</div>

					
					
				</div>
				
      </div>
    </div>
  </div>
</div>