<?php
if(is_array($all_items) && count($all_items)){?>

    <div class="edge-image-slider-holder edge-owl-slider" <?php echo adorn_edge_get_inline_attrs($data_params); ?> >

        <?php

        foreach ($all_items as $item){ ?>

            <div class="edge-image-slider-item" <?php echo adorn_edge_get_inline_style($item['image_style']); ?> >

                <?php if($item['image_url'] !== '' ){ ?>
                    <div class="edge-image-slider-item-inner image">
                        <img src="<?php echo esc_url($item['image_url']);?>" alt="<?php esc_attr_e('Image Slider Item', 'edge-core')?>" >
                    </div>
                <?php } ?>

                <?php if((isset($item['content']) && $item['content'] !== '') || isset($item['title']) && $item['title'] !== ''){ ?>

                    <div class="edge-image-slider-item-inner-wrapper" <?php adorn_edge_get_inline_style($item['image_style']); ?> >
                        <div class="edge-image-slider-item-content">

                            <?php if(isset($item['title']) && $item['title'] !== ''){ ?>

                                <div class="edge-image-slider-item-inner title">
                                    <span>
                                        <?php
                                            echo esc_attr($item['title']);
                                        ?>
                                    </span>
                                </div>

                            <?php }	?>

                            <?php if(isset($item['content']) && $item['content'] !== ''){ ?>

                                <div class="edge-image-slider-item-inner content">
                                    <span>
                                        <?php
                                            echo esc_attr($item['content']);
                                        ?>
                                    </span>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                <?php } ?>


            </div>

        <?php }

        ?>

    </div>

<?php }