<?php
/**
 * Template Name: Pest Sub Page Template
 *
 * Description: Displays a full-width page, with no sidebar. This template is great for pages
 * containing large amounts of content.
 *
 * @package F4D
 * @since F4D 1.0
 */

get_header();

$parentIDA = wp_get_post_parent_id( $post->ID );
$parentIDB = wp_get_post_parent_id( $parentIDA );
$parentIDC = wp_get_post_parent_id( $parentIDB );
$parentID = $parentIDA;
if ($parentIDB != '10070'){
	$parentID = $parentIDB;
}
if ($parentIDC != '10070' && !empty($parentIDC)){
	$parentID = $parentIDC;
}

$parentpost = get_post($parentIDA); 
$slug = $parentpost->post_name;
$slug = str_replace("-", " ", $slug);
$slug = ucwords($slug);

$pest = get_field('pest-name', $parentID);
$pests = get_field('pest-names', $parentID);

if($slug != $pests) {
	$secondary = '<a href="'. get_permalink($parentIDA) .'">'. $pest .' '. $slug .'</a>';
} else {
	$slugb = $post->post_name;
	$slugb = str_replace("-", " ", $slugb);
	$slugb = ucwords($slugb);
	$secondary = $pest .' '. $slugb;
}

$parentThumb = get_the_post_thumbnail_url($parentID);

?>
	<div class="pest-page-header" style="background: url(<?php echo $parentThumb ?>); background-size: cover; background-position: center;">
		<header class="entry-header">
			
			<h1 class="entry-title"><span><?php echo $pests. ':'; ?> </span><?php the_title(); ?></h1>
		</header>
		<?php if(!empty($secondary)){echo '<div class="pest-section">'.$secondary.'</div>';} ?>
	</div>
		
	<div id="primary" class="site-content row" role="main">
		
		<div class="col grid_8_of_12">

			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'pest_page' ); ?>
				<?php endwhile; ?>

			<?php endif; // end have_posts() check ?>

		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar('pest'); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
