<div class="edge-plc-holder <?php echo esc_attr($holder_classes) ?>">
    <?php if($carousel_title !== '') {?>
        <div class="edge-plc-title">
            <?php
                echo wp_kses_post($carousel_title);
            ?>
        </div>
    <?php } ?>
	<div class="edge-plc-outer edge-owl-slider" <?php echo adorn_edge_get_inline_attrs($holder_data); ?>>
		<?php
        $counter = 0;
        if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post();
        $counter++;
        ?>
			<div class="edge-plc-item" data-dot="<?php echo esc_attr($counter)?>">
				<div class="edge-plc-image-outer">
					<div class="edge-plc-image">
						<?php adorn_edge_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
					</div>
					<div class="edge-plc-text">
						<div class="edge-plc-text-outer">
							<div class="edge-plc-text-inner">
								<?php do_action('adorn_edge_woocommerce_info_below_image_hover'); ?>
							</div>
						</div>
					</div>
					<a class="edge-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
                <div class="edge-plc-text-wrapper">
					<?php adorn_edge_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
                </div>
			</div>
		<?php endwhile;	else:
			adorn_edge_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
		endif;
			wp_reset_postdata();
		?>
	</div>
</div>