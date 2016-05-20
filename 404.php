<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package F4D
 * @since F4D 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">

		<div class="col grid_12_of_12">

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><i class="fa fa-frown-o fa-lg"></i> <?php esc_html_e( 'Uh Oh! This is somewhat embarrassing!', f4d ); ?></h1>
				</header>
				<div class="entry-content">
					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', f4d ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- /.entry-content -->
			</article><!-- /#post -->

		</div> <!-- /.col.grid_12_of_12 -->

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
