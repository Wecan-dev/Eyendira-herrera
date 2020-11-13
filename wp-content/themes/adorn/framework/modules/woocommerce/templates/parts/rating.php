<?php

if ($display_rating === 'yes' && get_option( 'woocommerce_enable_review_rating' ) !== 'no') {
	$product = adorn_edge_return_woocommerce_global_variable();
	$average = $product->get_average_rating();
	?>
	
	<div class="edge-<?php echo esc_attr($class_name); ?>-rating-holder">
        <div class="edge-<?php echo esc_attr($class_name); ?>-rating" title="<?php sprintf(esc_attr_e("Rated %s out of 5", "adorn"), $average ); ?>">
			<span style="width: <?php echo esc_attr($average / 5)*100 . '%'; ?>"></span>
		</div>
	</div>
<?php } ?>