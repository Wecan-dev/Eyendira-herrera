<div class="edge-floating-prod-cat <?php echo esc_attr($item_classes); ?>">

    <div class="edge-floating-cat-inner">
        <div class="edge-floating-cat-wrapper"  <?php echo adorn_edge_get_inline_style($img_style);?>>

            <div class="edge-floating-cat-content">
                <h4 class="edge-category-title">
                    <a href="<?php echo esc_url($link);?>">
                        <?php
                        echo esc_attr($term->name);
                        ?>
                    </a>
                </h4>
                <?php
                if($min_price && $min_price !== 0){ ?>
                    <span class="edge-floating-cat-price-holder">
                    <?php esc_html_e('From $', 'adorn');?>
                        <span>
                        <?php
                        echo esc_attr($min_price);
                        ?>
                    </span>
                </span>
                <?php }
                echo adorn_edge_get_button_html($button_params);
                ?>
            </div>

        </div>
    </div>

</div>