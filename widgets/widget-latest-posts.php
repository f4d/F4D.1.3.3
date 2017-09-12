<?php
// Credits: http://buffercode.com/simple-method-create-custom-wordpress-widget-admin-dashboard/
// REGISTER WIDGET
function widget_latest_posts() {
	register_widget( 'widget_latest_posts' );
}
add_action( 'widgets_init', 'widget_latest_posts' );

class widget_latest_posts extends WP_Widget {

	// CONSTRUCT WIDGET
	function widget_latest_posts() {
		$widget_ops = array( 
			'classname' 	=> 'widget_latest_posts', 
			'description' => __( 'Posts', 'tt' ),
			'panels_icon' => 'icon-themetrail',
		);
		parent::__construct( 'widget_latest_posts', __( 'Realty - Latest Posts', 'tt' ), $widget_ops );
	}
	
	// CREATE WIDGET FORM (WORDPRESS DASHBOARD)
  function form($instance) {
  
	  if ( isset( $instance[ 'title' ] ) && isset ( $instance[ 'amount' ] ) ) {
			$title = $instance[ 'title' ];
			$amount = $instance[ 'amount' ];
		} else {
			$title = __( 'Latest Posts', 'tt' );
			$amount = -1;
		}
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tt' ); ?></label> 
			<input name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title );?>" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php _e( 'Number of Posts to Display:', 'tt' ); ?></label> 
			<input name="<?php echo $this->get_field_name( 'amount' ); ?>" type="number" min="-1" value="<?php echo esc_attr( $amount );?>" class="widefat" />
			<small><?php _e( 'Enter "-1" to show all', 'tt' ); ?></small>
		</p>
		 
		<?php
		
  }

  // UPDATE WIDGET
  function update( $new_instance, $old_instance ) {
  	  
	  $instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';		 
		$instance['amount'] = ( ! empty( $new_instance['amount'] ) ) ? strip_tags( $new_instance['amount'] ) : '';		 		 
		
		return $instance;
	  
  }

  // DISPLAY WIDGET ON FRONT END
  function widget( $args, $instance ) {
	  
	  extract( $args );
 
		// Widget starts to print information
		echo $before_widget;
		 
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );	 
		$amount = empty( $instance[ 'amount' ] ) ? '3' : $instance[ 'amount' ];
		$amount = intval( $amount );
		 
		if ( !empty( $title ) ) { 
			echo $before_title . $title . $after_title; 
		};

		// Query Featured Properties
		$args_latest_posts = array(
			'post_type' 				=> 'post',
			'posts_per_page' 		=> $amount,
			'tax_query' => array(
				array(                
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 
						'post-format-aside',
						'post-format-audio',
						'post-format-chat',
						'post-format-gallery',
						'post-format-image',
						'post-format-link',
						'post-format-quote',
						'post-format-status',
						'post-format-video'
					),
					'operator' => 'NOT IN'
				)
			)
		);
		
		$query_latest_posts = new WP_Query( $args_latest_posts );
		
		if ( $query_latest_posts->have_posts() ) :
	  	$m = 0;
		?>
		<div id="gallery-20-wrap">
			<ul id="gallery-20" class="f4d-gallery">
				<?php
				while ( $query_latest_posts->have_posts() ) : $query_latest_posts->the_post();
	  			$b = $m-1;
				$c = $m+1;
	  			echo '<input type="radio" name="gallery-20-img" class="gallery-20 img-' . $m . '" id="gallery-20-img-' . $m . '">';
				?>
				<li class="f4d-gallery-container">
					<div class="f4d-image">
						<div class="latest-post-header">
							<?php 
							the_post_thumbnail( 'small', array( 'alt' => '' ) );
							echo '<label for="gallery-20-img-'. $b .'" id="img-prev-'. $m .'" class="prev nav">‹</label><label for="gallery-20-img-'. $c .'" id="img-next-'. $m .'" class="next nav">›</label>';
							?>
						</div>

						<div class="widget-text">
							<a href="<?php the_permalink(); ?>"><?php the_title( '<h6 class="title">', '</h6>' ); ?></a>
							<div class="text-muted"><?php	echo the_excerpt(); ?></div>
						</div>
						<?php
						$m++;
						?>
					</div>
				</li>
				<?php
				endwhile;
				?>
			</ul>
		</div><!-- / widget-galery -->

		<?php
		wp_reset_query();
		endif;
		
		// Widget ends printing information
		echo $after_widget;
	  
  }

}