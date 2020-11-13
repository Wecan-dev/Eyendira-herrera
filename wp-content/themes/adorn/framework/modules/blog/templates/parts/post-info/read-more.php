<div class="edge-post-read-more-button">
<?php
    if(adorn_edge_core_plugin_installed()) {
        echo adorn_edge_get_button_html(
            apply_filters(
                'adorn_edge_blog_template_read_more_button',
                array(
                    'type' => 'simple',
                    'size' => 'medium',
                    'link' => get_the_permalink(),
                    'text' => esc_html__('Read More', 'adorn'),
                    'custom_class' => 'edge-blog-list-button'
                )
            )
        );
    } else { ?>
        <a itemprop="url" href="<?php echo esc_url(get_the_permalink()); ?>" target="_self" class="edge-btn edge-btn-medium edge-btn-simple edge-blog-list-button">
            <span class="edge-btn-text">
                <?php echo esc_html__('Learn more', 'adorn'); ?>
            </span>
        </a>
<?php } ?>
</div>
