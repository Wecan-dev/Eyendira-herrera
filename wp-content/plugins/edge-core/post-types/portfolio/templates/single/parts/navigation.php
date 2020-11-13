<?php if(adorn_edge_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = adorn_edge_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    $prev_post  = get_previous_post($nav_same_category, '', 'portfolio-category');
    $next_post = get_next_post($nav_same_category, '', 'portfolio-category');
    $prev_image = false;
    $next_image = false;
    if ($prev_image) :
    $prev_image = get_the_post_thumbnail($prev_post->ID, 'thumbnail');
    endif;
    if ($next_image) :
    $next_image = get_the_post_thumbnail($next_post->ID, 'thumbnail');
    endif;
    ?>
    <div class="edge-ps-navigation">
        <?php if(get_previous_post() !== '') : ?>
            <div class="edge-ps-prev <?php if (!empty($prev_image)) {
                echo esc_attr('edge-single-nav-with-image');
            } ?>">
                <div class="edge-single-nav-image-holder">
                    <a href="<?php echo get_the_permalink($prev_post->ID); ?>">
                        <?php echo adorn_edge_kses_img(get_the_post_thumbnail($prev_post->ID, 'thumbnail')); ?>
                    </a>
                </div>
                <div class="edge-single-nav-title-holder">
                    <a class="edge-single-nav-title" href="<?php echo get_the_permalink($prev_post->ID); ?>">
                        <?php echo get_the_title($prev_post->ID); ?>
                    </a>
                    <?php if($nav_same_category) {
                        previous_post_link('%link',esc_html__( 'Previous', 'edge-core' ), true, '', 'portfolio-category');
                    } else {
                        previous_post_link('%link',esc_html__( 'Previous', 'edge-core' ));
                    } ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="edge-ps-back-btn">
                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="icon_grid">
                        <span class="icon_grid-square icon_grid-square-1"></span>
                        <span class="icon_grid-square icon_grid-square-2"></span>
                        <span class="icon_grid-square icon_grid-square-3"></span>
                        <span class="icon_grid-square icon_grid-square-4"></span>
                    </span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="edge-ps-next <?php if (!empty($next_image)) {
                echo esc_attr('edge-single-nav-with-image');
            } ?>">
                <div class="edge-single-nav-image-holder">
                    <a href="<?php echo get_the_permalink($next_post->ID); ?>">
                        <?php echo adorn_edge_kses_img(get_the_post_thumbnail($next_post->ID, 'thumbnail')); ?>
                    </a>
                </div>
                <div class="edge-single-nav-title-holder">
                    <a class="edge-single-nav-title" href="<?php echo get_the_permalink($next_post->ID); ?>">
                        <?php echo get_the_title($next_post->ID); ?>
                    </a>
                    <?php if($nav_same_category) {
                        next_post_link('%link', esc_html__( 'Next', 'edge-core' ), true, '', 'portfolio-category');
                    } else {
                        next_post_link('%link', esc_html__( 'Next', 'edge-core' ));
                    } ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>


