<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package F4D
 * @since F4D 1.0
 */

get_header(); ?>
	<?php if ( has_post_thumbnail() && !is_search() && !post_password_required() ) { ?>
				<header class="entry-header feat-image" style="background: url('<?php echo the_post_thumbnail_url( 'post_feature_full_width' ); ?>'); background-size: cover; background-position: center;">
					<div class="entry-title">
						<h1><?php the_title(); ?></h1>
					</div>
					<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<div id="breadcrumbs">','</div>');} ?>
				</header>

				
			<?php } 
			else {?>
			<header class="entry-header no-feat">
				<div class="entry-title">
					<h1><?php the_title(); ?></h1>
				</div>
				<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<div id="breadcrumbs">','</div>');} ?>
			</header>
			<?php }?>
	<div id="primary" class="site-content row" role="main">

		<div class="col grid_8_of_12">
			
			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; ?>

			<?php endif; // end have_posts() check ?>
			
			<?php
					// check if the flexible content field has rows of data
							if( have_rows('page_extensions') ):
								$a = 0;
								$i = 0;
								$q = 0;
     							// loop through the rows of data
								while ( have_rows('page_extensions') ) : the_row();

									if( get_row_layout() == 'f4d_image_block' ):
										
										$info_title = get_sub_field('info_block_title');
										$info_text = get_sub_field('info_block_content', false, false);
										$info_image = get_sub_field('info_block_image');
										$image_side = get_sub_field('image_side');
										$caption = $info_image['caption'];
										
										$a++;
										$i++;
										echo '<div class="f4d-ext info-block-'. $a .' image-block image-block-'. $i .' image-block-'. $image_side .'">';
        								echo '<div class="info-block-content">';
										echo '<h2 class="block-title">' . $info_title . '</h2>';
										echo '<p>' . $info_text . '</p>';
										echo '</div>';
										echo '<div class="info-block-image">';
										echo '<img src="' . $info_image['url'] . '" alt="' . $info_image['alt'] . '" />';
										if(!empty($caption)){
											echo '<span>'. $info_image['caption'] . '</span>';
										}
										echo '</div>';
										echo '</div><!-- f4d-ext  -->';

        							endif;
			
									if( get_row_layout() == 'f4d_quote_block' ):
										
										$quote_src = get_sub_field('quote_block_source');
										$quote_title = get_sub_field('quote_block_title');
										$quote_text = get_sub_field('quote_block_quote', false, false);
										$quote_image = get_sub_field('quote_block_bg_image');
										$quote_bg = get_sub_field('quote_block_bg_color');
										
										$a++;
										$q++;
										if($quote_image == ''){
											echo '<div class="f4d-ext info-block-'. $a .' quote-block quote-block-'. $q .'" style="background: '. $quote_bg .'">';
											echo '<div class="quote-block-content">';
										}
										else{
											echo '<div class="f4d-ext info-block-'. $a .' quote-block-bg quote-block quote-block-'. $q .'" style="background-image: url('. $quote_image['url'] .'); background-size: cover; background-position: center;">';
											echo '<div class="quote-block-content" style="background-color: rgba(0,0,0,.65);">';
										}
										echo '<h2 class="block-title">'. $quote_title .'</h2>';
										echo $quote_text;
										echo '<span>' . $quote_src . '</span>';
										echo '</div>';
										echo '</div><!-- pest-quote  -->';

        							endif;

    							endwhile;

							else :

    						// no layouts found

							endif;
						?>

		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
