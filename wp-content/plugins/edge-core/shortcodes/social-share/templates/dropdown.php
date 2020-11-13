<div class="edge-social-share-holder edge-dropdown">
	<a href="javascript:void(0)" target="_self" class="edge-social-share-dropdown-opener">
        <span class="edge-social-share-title"><?php esc_html_e('Share this', 'edge-core') ?></span>
		<i class="social_share"></i>
	</a>
	<div class="edge-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				echo adorn_edge_get_module_part($net);
			} ?>
		</ul>
	</div>
</div>