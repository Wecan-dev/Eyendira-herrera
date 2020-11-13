<div <?php adorn_edge_class_attribute($item_classes); ?>>
    <div class="edge-pi-holder-inner">
        <div class="edge-pi-holder-inner-wrapper">
            <?php if(!empty($process_image)) : ?>
                <div class="edge-image-holder-inner">
                    <img src="<?php echo adorn_edge_get_module_part($image_style); ?>">
                </div>
            <?php endif; ?>
        </div>
            <div class="edge-pi-content-holder">
                <?php if(!empty($title)) : ?>
                    <div class="edge-pi-title-holder">
                        <h4 class="edge-pi-title"><?php echo esc_html($title); ?></h4>
                    </div>
                <?php endif; ?>
                <?php if(!empty($text)) : ?>
                    <div class="edge-pi-text-holder">
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                <?php endif; ?>
            </div>
    </div>
</div>