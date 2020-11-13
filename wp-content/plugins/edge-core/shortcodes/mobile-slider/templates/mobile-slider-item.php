<div class="edge-ms-item">
    <?php if(!empty($title)) { ?>
        <h5><?php echo esc_html($title); ?></h5>
    <?php } ?>
    <?php if(!empty($text)) { ?>
        <p><?php echo esc_html($text); ?></p>
    <?php } ?>
    <?php if(!empty($link)) { ?>
    <a itemprop="url" class="edge-ms-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
        <?php } ?>
        <div class="edge-ms-images-holder">
            <div class="edge-ms-qr-holder">
                <?php if(!empty($qr_image)) { ?>
                    <img itemprop="image" class="edge-ms-qr-image" src="<?php echo esc_url($qr_image['url']); ?>" alt="<?php echo esc_attr($qr_image['alt']); ?>" />
                <?php } ?>
            </div>
            <div class="edge-ms-image-holder">
                <?php if(!empty($image)) { ?>
                    <img itemprop="image" class="edge-ms-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php } ?>
            </div>
        </div>
        <?php if(!empty($link)) { ?>
    </a>
<?php } ?>
</div>