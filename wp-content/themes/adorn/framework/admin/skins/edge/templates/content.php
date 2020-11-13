<div class="edge-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active">
			<div class="edge-tab-content">
				<h2 class="edge-page-title"><?php echo esc_html($page->title); ?></h2>
				<form method="post" class="edge_ajax_form">
					<?php wp_nonce_field("edge_ajax_save_nonce","edge_ajax_save_nonce") ?>
						<div class="edge-page-form">
							<?php $page->render(); ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>