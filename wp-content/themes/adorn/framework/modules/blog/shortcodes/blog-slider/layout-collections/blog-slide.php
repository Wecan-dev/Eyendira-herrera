<li class="edge-blog-slider-item">
    <div class="edge-blog-slider-item-inner">
        <div class="edge-item-image clearfix">
            <a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size); ?>
            </a>
        </div>
        <div class="edge-item-text-wrapper">
            <div class="edge-item-text-holder">
                <div class="edge-item-text-holder-inner">
                    <?php if($post_info_date == 'yes' || $post_info_category == 'yes' || $post_info_author == 'yes' || $post_info_comments == 'yes'){ ?>
                        <div class="edge-item-info-section">
                            <?php adorn_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
                            <?php adorn_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params); ?>
                            <?php adorn_edge_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $params); ?>
                            <?php adorn_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params); ?>
                        </div>
                    <?php } ?>

                    <<?php echo esc_attr( $title_tag)?> itemprop="name" class="edge-item-title entry-title">
                        <a itemprop="url" href="<?php echo esc_url(get_permalink()); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    </<?php echo esc_attr($title_tag); ?>>

                    <div class="edge-section-button-holder">
                        <?php adorn_edge_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>