<div class="edge-pie-chart-holder">
	<div class="edge-pc-percentage" <?php echo adorn_edge_get_inline_attrs($pie_chart_data); ?>>
		<span class="edge-pc-percent" <?php echo adorn_edge_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></span>
	</div>
	<?php if(!empty($title) || !empty($text)) { ?>
		<div class="edge-pc-text-holder">
			<?php if(!empty($title)) { ?>
				<<?php echo esc_attr($title_tag); ?> class="edge-pc-title" <?php echo adorn_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
			<?php } ?>
			<?php if(!empty($text)) { ?>
				<p class="edge-pc-text" <?php echo adorn_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
			<?php } ?>
		</div>
	<?php } ?>
</div>