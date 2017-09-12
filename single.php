<?php
/**
 * The Template for displaying all single posts.
 *
 * @package F4D
 * @since F4D 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">

			<div class="col grid_8_of_12">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php
					
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) {
							comments_template( '', true );
						}
					?>

					<?php f4d_content_nav( 'nav-below' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div> <!-- /.col.grid_8_of_12 -->
			<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
