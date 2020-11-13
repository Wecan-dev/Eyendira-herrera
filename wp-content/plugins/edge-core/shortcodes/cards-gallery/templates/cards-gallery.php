<div <?php adorn_edge_class_attribute($holder_classes); ?>>
    <div class="edge-cards-gallery">
        <?php
        $i = 1;
        foreach($images as $image) { ?>
            <div class="card" <?php adorn_edge_inline_style($background_color); ?>>
                <div class="edge-bundle-item" data-bundle-move-top="<?php echo esc_attr($i*300); ?>">
                    <?php if($image['image_link'] !== ''){ ?>
                    <a href="<?php echo esc_url($image['image_link']) ?>" target="<?php echo esc_attr($image['image_target']) ?>">
                        <?php } ?>
                        <img  src="<?php echo esc_url($image['url']);?>" alt="#" />
                    <?php if($image['image_link'] !== ''){ ?>
                    </a>
                    <?php }
                    $i++;
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="fake_card">
        <img src="<?php echo esc_url(end($images)['url']);?>" alt="<?php esc_attr_e('Fake card image', 'edge-core'); ?>">
    </div>
</div>