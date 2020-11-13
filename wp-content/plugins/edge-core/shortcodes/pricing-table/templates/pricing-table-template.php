<div class="edge-price-table">
	<div class="edge-pt-inner" <?php echo adorn_edge_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="edge-pt-title-holder">
				<span class="edge-pt-title" <?php echo adorn_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="edge-pt-prices">
				<span class="edge-pt-value" <?php echo adorn_edge_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
				<span class="edge-pt-price" <?php echo adorn_edge_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<?php if(!empty($price_period)) { ?>
					<h6 class="edge-pt-mark" <?php echo adorn_edge_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
				<?php } ?>
			</li>
            <li class="edge-pt-subtitle-holder">
                <span class="edge-pt-subtitle" <?php echo adorn_edge_get_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></span>
            </li>
			<li class="edge-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="edge-pt-button">
					<?php echo adorn_edge_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => 'solid',
                        'size' => 'large'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>