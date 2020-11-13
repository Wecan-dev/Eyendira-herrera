<?php $icon_html = adorn_edge_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="edge-icon-list-holder" <?php echo adorn_edge_get_inline_style($holder_styles); ?>>
	<div class="edge-il-icon-holder">
		<?php echo adorn_edge_get_module_part($icon_html);	?>
	</div>
	<p class="edge-il-text" <?php echo adorn_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>