<div class="edge-social-share-holder edge-list">
	<?php if(!empty($title)) { ?>
		<p class="edge-social-title"><?php echo esc_html($title); ?></p>
	<?php } ?>
	<ul>
		<?php foreach ($networks as $net) {
			echo adorn_edge_get_module_part($net);
		} ?>
	</ul>
</div>