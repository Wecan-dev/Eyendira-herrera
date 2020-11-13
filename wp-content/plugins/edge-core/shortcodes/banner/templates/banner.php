<div class="edge-banner-holder">
    <div class="edge-banner-image">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
    <div class="edge-banner-text-holder">
	    <div class="edge-banner-text-inner" <?php echo adorn_edge_get_inline_style($text_left_padding); ?>>
	        <?php if(!empty($title)) { ?>
	            <<?php echo esc_attr($title_tag); ?> class="edge-banner-title" <?php echo adorn_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
	        <?php } ?>
            <?php if(!empty($subtitle)) { ?>
                <<?php echo esc_attr($subtitle_tag); ?> class="edge-banner-subtitle" <?php echo adorn_edge_get_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></<?php echo esc_attr($subtitle_tag); ?>>
            <?php } ?>
			<?php if(!empty($text)) { ?>
	            <p class="edge-banner-text" <?php echo adorn_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	        <?php } ?>
		</div>
	</div>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="edge-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>