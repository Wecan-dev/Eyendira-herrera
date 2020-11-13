<div class="edge-counter-holder <?php echo esc_attr($holder_class); ?>" <?php echo adorn_edge_get_inline_style($counter_boxed_styles); ?>>
	<div class="edge-counter-inner">
		<?php if(!empty($digit)) { ?>
			<span class="edge-counter <?php echo esc_attr($type) ?>" <?php echo adorn_edge_get_inline_style($counter_styles); ?>><?php echo esc_html($digit); ?></span>
		<?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="edge-counter-title" <?php echo adorn_edge_get_inline_style($counter_title_styles); ?>>
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="edge-counter-text" <?php echo adorn_edge_get_inline_style($counter_text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>