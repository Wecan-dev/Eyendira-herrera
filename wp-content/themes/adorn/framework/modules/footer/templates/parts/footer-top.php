<?php
$page_id = adorn_edge_get_page_id();
?>
<div class="edge-footer-top-holder">
	<div class="edge-footer-top-inner <?php echo esc_attr($footer_top_grid_class); ?>">
		<div class="edge-grid-row <?php echo esc_attr($footer_top_classes); ?>">
			<?php for($i = 1; $i <= $footer_top_columns; $i++) { ?>
				<div class="edge-column-content edge-grid-col-<?php echo esc_attr(12 / $footer_top_columns); ?>">
					<?php
                    $custom_area = get_post_meta($page_id, 'edge_footer_top_meta_' . $i, true);
                    $widget_area = $custom_area !== '' && $use_custom_widgets == 'yes' ? $custom_area : 'footer_top_column_' . $i;
                    dynamic_sidebar($widget_area);
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>