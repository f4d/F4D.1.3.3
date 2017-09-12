<?php
// Creating the widget 
class contact_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'contact_widget', 

// Widget name will appear in UI
__('Contact Widget', 'contact_widget_domain'), 

// Widget description
array( 'description' => __( 'Widget to display NAP information', 'contact_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

$nap_name = $instance['name'];
if ( empty( $nap_name ) ) {
	$nap_name = get_field('nap_name', 'option');
}
	
$nap_add = $instance['address'];
if ( empty( $nap_add ) ) {
	$nap_add = get_field('nap_address', 'option');
}

$nap_add_url = $instance['address_url'];
if ( empty( $nap_add_url ) ) {
	$nap_add_url = get_field('nap_address_url', 'option');
}


$nap_phone = $instance['phone'];
if ( empty( $nap_phone ) ) {
	$nap_phone = get_field('nap_phone', 'option');
}


$nap_email = $instance['email'];
if ( empty( $nap_email ) ) {
	$nap_email = get_field('nap_email', 'option');
}

// This is where you run the code and display the output?>
<div id="NAP">
    <?php if ( !empty( $nap_name ) && $nap_name != 'NULL' ) { ?>
    	<div id="NAP-name">
        <?php echo $nap_name; ?>
        </div>
	<?php } ?>
    
    <?php if ( !empty( $nap_add ) && $nap_add != 'NULL' ) { ?>
    	<div id="NAP-address">
         <?php if ( !empty( $nap_add_url ) ) {?>
         	<a href="<?php echo $nap_add_url; ?>" title="Get directions"><i class="fa fa-location-arrow" aria-hidden="true"></i> <span><?php echo $nap_add; ?></span></a>
		<?php }
		 else {?>
         <?php echo $nap_add; ?>
		<?php }?>
        </div>
	<?php } ?>
    
    <?php if ( !empty( $nap_email ) && $nap_email != 'NULL' ) { ?>
    	<div id="NAP-email">
        <a href="mailto:<?php echo $nap_phone; ?>" title="Email us"><i class="fa fa-envelope" aria-hidden="true"></i> <span><?php echo $nap_email; ?></span></a>
        </div>
	<?php } ?>
    
    <?php if ( !empty( $nap_phone ) && $nap_phone != 'NULL' ) { ?>
    	<div id="NAP-phone">
        <a href="tel:<?php echo preg_replace("/[^0-9,.]/", "", $nap_phone); ?>" title="Call us"><i class="fa fa-phone" aria-hidden="true"></i> <span><?php echo $nap_phone; ?></span></a>
        </div>
	<?php } ?>
    </div>
<?php echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Contact Us', 'contact_widget_domain' );
}

if ( isset( $instance[ 'name' ] ) ) {
$nap_name = $instance[ 'name' ];
}
else {
$nap_name = get_field('nap_name', 'option');
}

if ( isset( $instance[ 'address' ] ) ) {
$nap_add = $instance[ 'address' ];
}
else {
$nap_add = get_field('nap_add', 'option');
}

if ( isset( $instance[ 'address_url' ] ) ) {
$nap_add_url = $instance[ 'address_url' ];
}
else {
$nap_add_url = get_field('nap_add_url', 'option');
}

if ( isset( $instance[ 'phone' ] ) ) {
$nap_phone = $instance[ 'phone' ];
}
else {
$nap_phone = get_field('nap_phone', 'option');
}

if ( isset( $instance[ 'email' ] ) ) {
$nap_email = $instance[ 'email' ];
}
else {
$nap_email = get_field('nap_email', 'option');
}
// Widget admin form

?>


<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>By default fields show NAP info entered into the theme options screen. Any info entered here will overwrite that info. To hide a field completely enter NULL into the field.</p>

<p>
<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $nap_name ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address (Requires Google Maps URL Below):' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $nap_add ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'address_url' ); ?>"><?php _e( 'Google Maps URL for Address:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'address_url' ); ?>" name="<?php echo $this->get_field_name( 'address_url' ); ?>" type="text" value="<?php echo esc_attr( $nap_add_url ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone Number:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $nap_phone ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $nap_email ); ?>" />
</p>

<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
$instance['address_url'] = ( ! empty( $new_instance['address_url'] ) ) ? strip_tags( $new_instance['address_url'] ) : '';
$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
return $instance;
}
} // Class contact_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'contact_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );