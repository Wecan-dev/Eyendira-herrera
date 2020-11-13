<?php
$page_id = adorn_edge_get_page_id();
?>
<div class="edge-footer-bottom-holder">
	<div class="edge-footer-bottom-inner <?php echo esc_attr($footer_bottom_grid_class); ?>">
		<div class="edge-grid-row <?php echo esc_attr($footer_bottom_classes); ?>">
			<?php for($i = 1; $i <= $footer_bottom_columns; $i++) { ?>
				<div class="edge-grid-col-<?php echo esc_attr(12 / $footer_bottom_columns); ?>">
					<?php
                    $custom_area = get_post_meta($page_id, 'edge_footer_bottom_meta_' . $i, true);
                    $widget_area = $custom_area !== '' && $use_custom_widgets == 'yes' ? $custom_area : 'footer_bottom_column_' . $i;
                    dynamic_sidebar($widget_area);
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>