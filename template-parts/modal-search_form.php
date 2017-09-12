<div id="search-modal" class="modal fade" role="dialog" aria-labelledby="search-modal-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close jq-st-btn" data-target="search-modal" data-add="show-modal" data-remove="hide-modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e( 'Close', 'tt' );?></span></button>
			</div>
			<div class="modal-body">
				<h3 id="search-modal-label" class="section-title text-center"><span><?php _e( 'Property Search', 'tt' ); ?></span></h3><br />
        		<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>