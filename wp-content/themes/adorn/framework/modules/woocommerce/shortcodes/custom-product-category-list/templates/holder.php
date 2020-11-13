<?php
if(is_array($query_result) && count($query_result)){ ?>

	<div class="edge-woo-custom-items-holder <?php echo esc_attr($holder_clases); ?>">

		<div class="edge-woo-custom-items-inner">

            <div class="edge-woo-custom-grid-gutter"></div>
            <div class="edge-woo-custom-grid-sizer"></div>

			<?php foreach ($query_result as $item_key => $item){
			    $item_params = array(
			        'item' => $item
                );

				switch ($item['type']){
                    case 'post':
	                    $item_params['display_title'] = 'yes';
	                    $item_params['title_tag'] = 'h4';
	                    $item_params['display_price'] = 'yes';

	                    echo adorn_edge_get_woo_shortcode_module_template_part('templates/item', 'custom-product-category-list', '', $item_params);
	                    break;
					case 'category':
						$item_params['min_price'] = adorn_edge_woo_product_category_min_price($item['id']);
						echo adorn_edge_get_woo_shortcode_module_template_part('templates/cat-item', 'custom-product-category-list', '', $item_params);
						break;
                }
			}?>

		</div>
	</div>

<?php }
else{
    echo adorn_edge_get_woo_shortcode_module_template_part('templates/post-not-found', 'custom-product-category-list');
}