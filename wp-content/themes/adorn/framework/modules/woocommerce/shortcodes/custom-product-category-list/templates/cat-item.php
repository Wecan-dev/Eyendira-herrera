<?php
$params = array();
?>

<article class="edge-woo-custom-item category <?php echo esc_attr($item['masonry_class'])?>">

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

            <?php if($min_price && $min_price !== 0){ ?>
                 <span class="edge-woo-custom-item-price <?php echo esc_attr($item['price_skin']);?>">

                     <?php
                        esc_html_e('From $', 'adorn');
                        echo esc_attr($min_price);
                      ?>

                </span>
            <?php } ?>

        </div>

    </div>

</article>