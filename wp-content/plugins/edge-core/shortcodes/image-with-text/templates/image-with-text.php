<div class="edge-image-with-text-holder">
    <div class="edge-iwt-image <?php echo wp_kses_post($image_shadow);?> <?php echo wp_kses_post($image_border); ?>" >
        <?php
            if ($enable_lightbox) { ?>
                <a itemprop="image" href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
            <?php }
            elseif ($link !== ''){ ?>
                <a href="<?php echo esc_url($link)?>" target="_blank">
            <?php }
            if(is_array($image_size) && count($image_size)) : ?>
                <?php echo adorn_edge_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        <?php if ($enable_lightbox || $link !== '') { ?>
            </a>
        <?php } ?>
    </div>
    <div class="edge-iwt-text-holder"  <?php echo adorn_edge_get_inline_style($text_holder_styles); ?> >

        <?php if(!empty($title)) { ?>

            <<?php echo esc_attr($title_tag); ?> class="edge-iwt-title" <?php echo adorn_edge_get_inline_style($title_styles); ?>>

                <?php if($link !== ''){ ?>
                    <a href="<?php echo esc_url($link);?>">
                <?php } ?>

                    <?php echo esc_html($title); ?>

                <?php if($link !== ''){ ?>
                    </a>
                <?php } ?>

            </<?php echo esc_attr($title_tag); ?>>

        <?php } ?>

		<?php if(!empty($text)) { ?>

            <p class="edge-iwt-text" <?php echo adorn_edge_get_inline_style($text_styles); ?>>
                <?php echo esc_html($text); ?>
            </p>

        <?php } ?>
    </div>
</div>