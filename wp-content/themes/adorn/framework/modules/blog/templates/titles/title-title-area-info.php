<?php do_action('adorn_edge_before_page_title'); ?>
<?php if($show_title_area) { ?>
    <div class="edge-title <?php echo adorn_edge_title_classes(array(), $module); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <?php if(!empty($title_background_image_src)) { ?>
            <div class="edge-title-image">
                <img itemprop="image" src="<?php echo esc_url($title_background_image_src); ?>" alt="<?php esc_attr_e('Title Image', 'adorn'); ?>" />
            </div>
        <?php } ?>
        <div class="edge-title-holder" <?php adorn_edge_inline_style($title_holder_height); ?>>
            <div class="edge-container clearfix">
                <div class="edge-container-inner">
                    <div class="edge-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="edge-title-subtitle-holder-inner">
                            <?php switch ($type){
                                case 'standard': ?>
                                    <div class="edge-title-info edge-title-info-top">
                                        <?php adorn_edge_get_module_template_part('templates/parts/post-info/date', 'blog'); ?>
                                    </div>
                                    <?php if(adorn_edge_get_title_text() !== '') { ?>
                                        <h1 class="entry-title" <?php adorn_edge_inline_style($title_color); ?>><span><?php adorn_edge_title_text(); ?></span></h1>
                                    <?php } ?>
                                    <?php if($has_subtitle){ ?>
                                        <span class="edge-subtitle" <?php adorn_edge_inline_style($subtitle_color); ?>><span><?php adorn_edge_subtitle_text(); ?></span></span>
                                    <?php } ?>
                                    <?php if($enable_breadcrumbs){ ?>
                                        <div class="edge-breadcrumbs-holder"> <?php adorn_edge_custom_breadcrumbs(); ?></div>
                                    <?php } ?>
                                    <div class="edge-title-info edge-title-info-bottom">
                                        <?php adorn_edge_get_module_template_part('templates/parts/post-info/author', 'blog'); ?>
                                    </div>
                                    <?php break;
                                case 'breadcrumb': ?>
                                    <div class="edge-breadcrumbs-holder"> <?php adorn_edge_custom_breadcrumbs(); ?></div>
                                    <?php break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php do_action('adorn_edge_after_page_title'); ?>