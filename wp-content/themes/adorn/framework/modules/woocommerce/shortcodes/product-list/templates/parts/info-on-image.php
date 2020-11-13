<?php
$masonry_image_size = get_post_meta(get_the_ID(), 'edge_product_featured_image_size', true);
if(empty($masonry_image_size)) {
	$masonry_image_size = 'edge-woo-image-normal-width';
}

?>
<div class="edge-pli <?php echo esc_attr($masonry_image_size); ?> edge-<?php echo esc_attr($image_size); ?>-size">
	<div class="edge-pli-inner <?php echo esc_attr($crop_image) ?>">
		<div class="edge-pli-image">
			<?php adorn_edge_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
		</div>
		<div class="edge-pli-text">
			<div class="edge-pli-text-outer">
				<div class="edge-pli-text-inner">

                    <?php adorn_edge_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
					
					<?php adorn_edge_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>
					
					<?php adorn_edge_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>

                    <?php adorn_edge_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
					
					<?php adorn_edge_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>


				</div>
			</div>
		</div>
		<a class="edge-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</div>