<?php
if(is_array($query_result) && count($query_result)){
	?>

	<div class="edge-floating-prod-cats-holder clearfix <?php echo esc_attr($holder_clases); ?>">
		<div class="edge-floating-prod-cat-holder-inner clearfix">
			<?php foreach ($query_result as $term){

				$link = get_term_link($term->term_id, 'product_cat');
				$img_id = get_term_meta($term->term_id, 'thumbnail_id', true);
				$img_style = '';
				$holder_class =  array();

				if($img_id && $img_id !== ''){

					$image_obj = wp_get_attachment_image_url($img_id, 'full');
					if($image_obj && $image_obj !== ''){
						$img_style = 'background-image: url('.esc_url($image_obj).')';
					}

				}

				$tax_img_size = get_term_meta($term->term_id, 'tax_img_size', true);
                if($tax_img_size && $tax_img_size !== '' && $tax_img_size !== null){
	                $holder_class[] = $this_object->generateImgSizeClass($tax_img_size);
                }

				$tax_img_position = get_term_meta($term->term_id, 'tax_img_position', true);
				if($tax_img_position && $tax_img_position !== '' && $tax_img_position !== null){
					$holder_class[] = $this_object->generateImgPositionClass($tax_img_position);
				}

				$tax_content_position = get_term_meta($term->term_id, 'tax_content_position', true);
				if($tax_content_position && $tax_content_position !== '' && $tax_content_position !== null){
					$holder_class[] = $this_object->generateContentPositionClass($tax_content_position);
				}
				$min_price = adorn_edge_woo_product_category_min_price($term->term_id);

				$term_params = array(
					'term' => $term,
					'link' => $link,
					'img_style' => $img_style,
					'tax_img_size' => $tax_img_size,
					'tax_img_position' => $tax_img_position,
					'tax_content_position' => $tax_content_position,
					'min_price' => $min_price,
					'item_classes'   => implode(' ', $holder_class),
					'button_params' => array(
						'type' => 'simple',
						'text' => esc_html__('Shop now', 'adorn'),
						'link' => $link,
					)
				);

				echo adorn_edge_get_woo_shortcode_module_template_part('templates/item', 'floating-product-categories', '', $term_params);

			} ?>

		</div>
	</div>

<?php }