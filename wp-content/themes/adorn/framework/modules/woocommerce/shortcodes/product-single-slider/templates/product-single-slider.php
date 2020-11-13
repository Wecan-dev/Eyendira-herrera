<div class="edge-pls-holder <?php echo esc_attr($holder_classes) ?>">
    <?php if($slider_title !== '') {?>
        <div class="edge-pls-title">
            <?php
                echo wp_kses_post($slider_title);
            ?>
        </div>
    <?php } ?>
	<div class="edge-pls-outer edge-owl-slider" <?php echo adorn_edge_get_inline_attrs($holder_data); ?>>
		<?php
        $counter = 0;
        if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post();
		$counter ++;
		?>
			<div class="edge-pls-item <?php echo esc_attr($this_object->getArticleClasses(get_the_ID())); ?>" data-dot="<?php echo adorn_edge_get_formated_slider_number($counter);?>">
				<div class="edge-pls-image-outer">
					<div class="edge-pls-image">
						<?php adorn_edge_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
					</div>
					<a class="edge-pls-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
                <div class="edge-pls-text-wrapper <?php echo esc_attr($productTextClasses) ?>">

                    <?php adorn_edge_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>

					<?php adorn_edge_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

                    <?php
                        if ($display_button === 'yes') { ?>
                            <div class="edge-pls-button">
                                <?php echo adorn_edge_get_button_html(array(
                                    'text' => esc_html__('Shop Now', 'adorn'),
                                    'type' => 'simple',
                                    'size' => 'normal',
                                    'font_size' => '16px'
                                )); ?>
                            </div>
                        <?php } ?>
                </div>
			</div>
		<?php endwhile;	else:
			adorn_edge_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
		endif;
			wp_reset_postdata();
		?>
	</div>
</div>