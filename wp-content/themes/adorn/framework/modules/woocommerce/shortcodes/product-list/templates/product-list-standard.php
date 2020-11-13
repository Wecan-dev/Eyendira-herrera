<div class="edge-pl-holder <?php echo esc_attr($holder_classes) ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php if($query_result->have_posts()){ ?>
        <?php echo adorn_edge_get_woo_shortcode_module_template_part('templates/parts/categories-filter', 'product-list', '', $params); ?>
        <?php echo adorn_edge_get_woo_shortcode_module_template_part('templates/parts/ordering-filter', 'product-list', '', $params); ?>
        <div class="edge-prl-loading">
            <span class="edge-prl-loading-msg"><?php esc_html_e('Loading...', 'adorn') ?></span>
        </div>
        <div class="edge-pl-outer">
            <?php while ($query_result->have_posts()) : $query_result->the_post();
                echo adorn_edge_get_woo_shortcode_module_template_part('templates/parts/'.$params['info_position'], 'product-list', '', $params);
            endwhile;
            ?>
        </div>
    <?php }else {
        adorn_edge_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
    }
	wp_reset_postdata();

	$edgtf_unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'edgtf_product_load_more_nonce_' . $edgtf_unique_id, 'edgtf_product_load_more_nonce_' . $edgtf_unique_id );
	?>
</div>