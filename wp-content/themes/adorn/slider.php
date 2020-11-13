<?php
do_action('adorn_edge_before_slider_action');

$edge_slider_shortcode = get_post_meta(adorn_edge_get_page_id(), 'edge_page_slider_meta', true);
if (!empty($edge_slider_shortcode)) { ?>
	<div class="edge-slider">
		<div class="edge-slider-inner">
			<?php echo do_shortcode(wp_kses_post($edge_slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php }

do_action('adorn_edge_after_slider_action');
?>