<?php
$product = adorn_edge_return_woocommerce_global_variable();

if (get_post_meta(get_the_ID(), 'edge_single_product_new_meta', true) === 'yes'){ ?>
    <span class="edge-<?php echo esc_attr($class_name); ?>-new-product"><?php esc_html_e('NEW', 'adorn'); ?></span>
<?php } ?>

<?php if ($product->is_on_sale() && $product->is_in_stock()) { ?>
	<span class="edge-<?php echo esc_attr($class_name); ?>-onsale"><?php echo adorn_edge_woocommerce_sale_percentage(intval($product->regular_price), intval($product->sale_price)); ?></span>
<?php } ?>

<?php if (!$product->is_in_stock()) { ?>
	<span class="edge-<?php echo esc_attr($class_name); ?>-out-of-stock"><?php esc_html_e('SOLD', 'adorn'); ?></span>
<?php }

$product_image_size = 'shop_catalog';
if($image_size === 'full') {
	$product_image_size = 'full';
} else if ($image_size === 'square') {
	$product_image_size = 'adorn_square';
} else if ($image_size === 'landscape') {
	$product_image_size = 'adorn_landscape';
} else if ($image_size === 'portrait') {
	$product_image_size = 'adorn_portrait';
} else if ($image_size === 'medium') {
	$product_image_size = 'medium';
} else if ($image_size === 'large') {
	$product_image_size = 'large';
} else if ($image_size === 'shop_thumbnail') {
	$product_image_size = 'shop_thumbnail';
}

if(has_post_thumbnail()) {
	the_post_thumbnail(apply_filters( 'adorn_edge_product_list_image_size', $product_image_size));
}