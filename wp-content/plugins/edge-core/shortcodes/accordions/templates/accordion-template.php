<<?php echo esc_attr($title_tag); ?> class="edge-title-holder">
    <span class="edge-accordion-mark">
		<span class="edge_icon_plus icon_plus"></span>
		<span class="edge_icon_minus icon_close"></span>
	</span>
	<span class="edge-tab-title"><?php echo esc_html($title); ?></span>
</<?php echo esc_attr($title_tag); ?>>
<div class="edge-accordion-content">
	<div class="edge-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>