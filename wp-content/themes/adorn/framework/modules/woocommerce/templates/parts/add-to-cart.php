<?php

	$product = adorn_edge_return_woocommerce_global_variable();
	
	if (!$product->is_in_stock()) {
		$button_classes = 'ajax_add_to_cart edge-button edge-read-more-button';
	} else if ($product->get_type() === 'variable') {
		$button_classes = 'product_type_variable add_to_cart_button edge-button';
	} else if ($product->get_type() === 'external') {
		$button_classes = 'product_type_external edge-button';
	} else {
		$button_classes = 'add_to_cart_button ajax_add_to_cart edge-button';
	}
	?>
	
	<div class="edge-<?php echo esc_attr($class_name); ?>-add-to-cart">
		<?php echo apply_filters( 'adorn_edge_product_list_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( $button_classes ),
				esc_html( $product->add_to_cart_text() )
			),
			$product ); ?>
	</div>