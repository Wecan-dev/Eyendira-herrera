<div class="edge-is-item <?php echo esc_attr($showcase_item_class); ?>">
    <div class="edge-item-inner">
        <?php if ( $item_position == 'right') { ?>
            <div class="edge-is-icon">
                <?php echo adorn_edge_execute_shortcode('edge_icon', $icon_params); ?>
            </div>
        <?php } ?>
        <?php if($item_position == 'left') { ?>
            <div class="edge-is-icon">
                <?php echo adorn_edge_execute_shortcode('edge_icon', $icon_params); ?>
            </div>
        <?php } ?>
        <div class="edge-is-content">
            <?php if (!empty($item_title)) { ?>
                <<?php echo esc_attr($item_title_tag); ?> class="edge-is-title" <?php echo adorn_edge_get_inline_style($item_title_styles); ?>>
                    <?php if (!empty($item_link)) { ?><a href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_target); ?>"><?php } ?>
                    <?php echo esc_html($item_title); ?>
                    <?php if (!empty($item_link)) { ?></a><?php } ?>
                </<?php echo esc_attr($item_title_tag); ?>>
            <?php } ?>
            <?php if (!empty($item_text)) { ?>
                <p class="edge-is-text" <?php echo adorn_edge_get_inline_style($item_text_styles); ?>><?php echo esc_html($item_text); ?></p>
            <?php } ?>
        </div>
    </div>
</div>