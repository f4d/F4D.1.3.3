<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package F4D
 * @since F4D 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_single() ) { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php }
		else { ?>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to ', 'f4d' ) . '%s', the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		<?php } // is_single() ?>
		<?php f4d_posted_on(); ?>
	</header> <!-- /.entry-header -->
	<div class="entry-content">
		<?php the_content( wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'f4d' ), array( 
			'span' => array( 
				'class' => array() )
			) ) ); ?>
		
		<?php // check if the flexible content field has rows of data
		if( have_rows('f4d_galleries') ):
			$g = 0;
			$i = 0;
		
     		// loop through the rows of data
			while ( have_rows('f4d_galleries') ) : the_row();

				if( get_row_layout() == 'f4d_gallery' ):
										
					$gallery_title = get_sub_field('f4d_gallery_title');
					$gallery_desc = get_sub_field('f4d_gallery_description', false, false);
					$gallery_images = get_sub_field('f4d_gallery_images');
					$gallery_mosaic = get_sub_field('f4d_gallery_mosaic');
										
					$g++;
					$i++;
					if($gallery_mosaic == "no"){
						echo '<div class="page-ext ext-row-'. $i .' gallery-row row">';
							echo '<div class="gallery-row-content">';
								if($gallery_title != ''):
									echo '<h3 class="h3Section centered"><span>' . $gallery_title . '</span></h3>';
								endif;
								if($gallery_desc != ''):
									echo '<p>' . $gallery_desc . '</p>';
								endif;	
								$m = 0;
								if( $gallery_images ):
									echo '<div id="gallery-'. $g .'-wrap"><ul id="gallery-'. $g .'" class="f4d-gallery">';
										echo '<div class="jq-st-btn" data-target="gallery-'. $g .'-wrap" data-add="full-screen-gallery" ></div>';
										foreach( $gallery_images as $gallery_image ):
											$b = $m-1;
											$c = $m+1;
											$caption = $gallery_image['caption'];
											echo '<input type="radio" name="gallery-' . $g . '-img" class="gallery-' . $g . ' img-' . $m . '" id="gallery-' . $g . '-img-' . $m . '">';
											echo '<li class="f4d-gallery-container"><div class="f4d-image">';
											echo '<img src="'. $gallery_image['sizes']['large'] .'" alt="'. $gallery_image['alt'] .'" />';
											if($caption != ''):
												echo '<div class="title">'. $caption .'</div>';
											endif;
											echo '<label for="gallery-' . $g . '-img-'. $b .'" id="img-prev-'. $m .'" class="prev nav">‹</label><label for="gallery-' . $g . '-img-'. $c .'" id="img-next-'. $m .'" class="next nav">›</label></div></li>';
											$m++;
										endforeach;
									echo '</ul></div>';
								endif;

							echo '</div>';
						echo '</div><!-- gallery-row-'. $g .'  -->';
					}
					else {
						echo '<div class="page-ext ext-row-'. $i .' gallery-row row">';
							echo '<div class="gallery-row-content">';
								if($gallery_title != ''):
									echo '<h3 class="h3Section centered"><span>' . $gallery_title . '</span></h3>';
								endif;
								if($gallery_desc != ''):
									echo '<p>' . $gallery_desc . '</p>';
								endif;	
								$m = 0;
								if( $gallery_images ):
									echo '<div id="gallery-'. $g .'" class="f4d-gallery-mosaic">';
										echo '<div class="jq-st-btn" data-target="gallery-'. $g .'-wrap" data-add="full-screen-gallery" ></div>';
										$image_ids = '';
										foreach( $gallery_images as $gallery_image ):
											$image_ids .= $gallery_image['id'] . ', ';
										endforeach;
									echo do_shortcode( '[gallery type="rectangular" ids="' . $image_ids . '"]' );
									echo '</div><!-- gallery-'. $g .' image-mosaic  -->';
								endif;

							echo '</div>';
						echo '</div><!-- gallery-row-'. $g .'  -->';
					};
			  	endif;

    		endwhile;

		else :

    	// no layouts found

		endif;
		?>
		
		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'f4d' ),
			'after' => '</div>',
			'link_before' => '<span class="page-numbers">',
			'link_after' => '</span>'
		) ); ?>
		
	</div> <!-- /.entry-content -->

	<footer class="entry-meta">
		<?php if ( is_singular() ) {
			// Only show the tags on the Single Post page
			f4d_entry_meta();
		} ?>
		<?php edit_post_link( esc_html__( 'Edit', 'f4d' ) . ' <i class="fa fa-angle-right" aria-hidden="true"></i>', '<div class="edit-link">', '</div>' ); ?>
		<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) {
			// If a user has filled out their description and this is a multi-author blog, show their bio
			get_template_part( 'author-bio' );
		} ?>
	</footer> <!-- /.entry-meta -->
</article> <!-- /#post -->
