<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package F4D
 * @since F4D 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content( wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'f4d' ), array( 'span' => array( 
			'class' => array() ) ) )
			); ?>
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
		}
		else {
			echo '— <i class="fa fa-user" aria-hidden="true"></i>&nbsp;' . get_the_author_posts_link() . '&nbsp;-&nbsp;<a href="/post-format-status">' . get_the_date() . '</a>';
		} ?>
		<?php edit_post_link( esc_html__( 'Edit', 'f4d' ) . ' <i class="fa fa-angle-right" aria-hidden="true"></i>', '<div class="edit-link">', '</div>' ); ?>
		<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) {
			// If a user has filled out their description and this is a multi-author blog, show their bio
			get_template_part( 'author-bio' );
		} ?>
	</footer> <!-- /.entry-meta -->
</article> <!-- /#post -->
