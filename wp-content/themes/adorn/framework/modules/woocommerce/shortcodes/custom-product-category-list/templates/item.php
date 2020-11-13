<article class="edge-woo-custom-item product <?php echo esc_attr($item['masonry_class'])?>">

    <div class="edge-woo-custom-item-inner">
    <div class="edge-woo-custom-item-image-holder" <?php echo adorn_edge_get_inline_style($item['img_url_style']);?>></div>

        <a href="<?php echo esc_url($item['link']);?>" class="edge-woo-custom-overlay"></a>
        <div class="edge-woo-custom-item-content">
            <h5 class="edge-woo-custom-item-title <?php echo esc_attr($item['title_skin']);?>">
                <a href="<?php echo esc_url($item['link']);?>">
					<?php
					    echo esc_attr($item['title']);
					?>
                </a>
            </h5>
        </div>

    </div>

</article>