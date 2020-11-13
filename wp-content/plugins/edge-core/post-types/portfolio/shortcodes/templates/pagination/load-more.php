<?php if($query_results->max_num_pages > 1) { ?>
	<div class="edge-pl-loading">
		<div class="edge-pl-loading-bounce1"></div>
		<div class="edge-pl-loading-bounce2"></div>
		<div class="edge-pl-loading-bounce3"></div>
	</div>
	<div class="edge-pl-load-more-holder">
		<div class="edge-pl-load-more">
			<?php 
				echo adorn_edge_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'large',
					'text' => esc_html__('LOAD MORE', 'edge-core')
				));
			?>
		</div>
	</div>
<?php }