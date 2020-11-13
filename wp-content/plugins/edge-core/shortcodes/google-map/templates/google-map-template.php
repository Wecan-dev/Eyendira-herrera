<div class="edge-google-map-holder">
	<div class="edge-google-map" id="<?php echo esc_attr($map_id); ?>" <?php echo wp_kses($map_data, array('data')); ?>></div>
	<?php if ($scroll_wheel == 'no') { ?>
		<div class="edge-google-map-overlay"></div>
	<?php } ?>
</div>
