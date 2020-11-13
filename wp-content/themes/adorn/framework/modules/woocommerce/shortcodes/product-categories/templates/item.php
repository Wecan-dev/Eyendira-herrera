<div class="edge-prod-cat <?php echo esc_attr($item_classes)?>">

    <div class="edge-prod-cat-inner">

        <?php
            if(isset($img_url) && $img_url!== ''){ ?>

                <div class="edge-prod-cat-img-wrapper">
                    <div class="edge-pcw-inner">
                        <a href="<?php echo esc_url($link);?>">
                            <img src="<?php echo esc_url($img_url);?>" alt="<?php echo esc_attr($term->name);?>">
                        </a>
                    </div>
                </div>

            <?php }
        ?>

        <div class="edge-prod-cat-content <?php echo esc_attr($content_position);?>">

            <h5 class="edge-category-title">
                <a href="<?php echo esc_url($link);?>">
                    <?php
                    echo esc_attr($term->name);
                    ?>
                </a>
            </h5>
            <?php
            if($min_price && $min_price !== 0){ ?>
                <span class="edge-prod-cat-price-holder">
                    <?php esc_html_e('From $', 'adorn');
                        echo esc_attr($min_price);
                    ?>
            </span>
            <?php } ?>

	        <?php if($enable_button === 'yes'){ ?>
                <div class="edge-prod-cat-button-holder">
			        <?php echo adorn_edge_get_button_html($button_params);?>
                </div>
	        <?php }?>

        </div>

    </div>

</div>