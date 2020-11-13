<?php
/**
 * Dropcaps shortcode template
 */
?>

<span class="edge-dropcaps <?php echo esc_attr($dropcaps_class);?>" <?php adorn_edge_inline_style($dropcaps_style);?>>
	<?php echo esc_html($letter);?>
</span>