<?php
$masonry_image_size = get_post_meta(get_the_ID(), 'edge_product_featured_image_size', true);
if(empty($masonry_image_size)) {
	$masonry_image_size = '';
}

$text_wrapper_class = '';
if($display_price == 'no' && $display_rating == 'no'){
    $text_wrapper_class .= 'edge-no-rating-price';
}
?>
<div class="edge-pli <?php echo esc_attr($masonry_image_size); ?>">
	<div class="edge-pli-inner">
		<div class="edge-pli-image">
			<?php adorn_edge_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
		</div>
		<div class="edge-pli-text">
			<div class="edge-pli-text-outer">
				<div class="edge-pli-text-inner">
					<?php do_action('adorn_edge_woocommerce_info_below_image_hover'); ?>
				</div>
			</div>
		</div>
		<a class="edge-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="edge-pli-text-wrapper <?php echo esc_attr($text_wrapper_class); ?>" <?php echo adorn_edge_get_inline_style($text_wrapper_styles); ?>>
		<?php adorn_edge_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
		
		<?php adorn_edge_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>
		
		<?php adorn_edge_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>
		
		<?php adorn_edge_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
		
		<?php adorn_edge_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

        <?php adorn_edge_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>

	</div>
</div>