<div class="edge-message  <?php echo esc_attr($message_classes)?>" <?php echo adorn_edge_inline_style($message_styles); ?>>
	<div class="edge-message-inner">
		<?php		
		if($type == 'with_icon'){
			$icon_html = edge_core_get_shortcode_module_template_part('templates/' . $type, 'message', '', $params);
			echo adorn_edge_get_module_part($icon_html);
		}
		?>
		<a href="javascript:void(0)" class="edge-close" <?php adorn_edge_inline_style($close_icon_holder_style); ?>><i class="edge-font-elegant-icon icon_close" <?php adorn_edge_inline_style($close_icon_style); ?>></i></a>
		<div class="edge-message-text-holder">
			<div class="edge-message-text">
				<div class="edge-message-text-inner"><?php echo do_shortcode($content); ?></div>
			</div>
		</div>
	</div>
</div>