<div class="edge-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edge-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="edge-cta-text-holder">
			<div class="edge-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="edge-cta-button-holder" <?php echo adorn_edge_get_inline_style($button_holder_styles); ?>>
			<div class="edge-cta-button"><?php echo adorn_edge_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>