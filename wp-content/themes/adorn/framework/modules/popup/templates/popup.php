<div class="edge-popup-holder">
    <div class="edge-popup-shader"></div>
    <div class="edge-popup-table">
        <div class="edge-popup-table-cell">
            <div class="edge-popup-inner">
                <a class="edge-popup-close" href="javascript:void(0)">
                    <?php
                    echo adorn_edge_icon_collections()->getSearchClose('font_elegant', true);
                    ?>
                </a>
                <div class="edge-popup-content">

                    <?php if($title !== '') { ?>
                        <span class="edge-popup-title">
                            <?php echo esc_html($title); ?>
                        </span>
                    <?php } ?>


                    <?php if($subtitle !== '') { ?>
                        <p class="edge-popup-subtitle"><?php echo esc_html($subtitle); ?></p>
                    <?php } ?>


                    <?php if($contact_form !== '') { ?>
                        <div class="edge-popup-form">
                            <?php echo do_shortcode('[contact-form-7 id="' . $contact_form .'" html_class="'. $contact_form_style .'"]'); ?>
                        </div>
                    <?php } ?>

	                <?php if($desc !== '') { ?>
                        <p class="edge-popup-desc"><?php echo esc_html($desc); ?></p>
	                <?php } ?>

                </div>


	            <?php if($image !== '') { ?>
                    <div class="edge-popup-image">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php esc_attr_e('Pop-up Image', 'adorn'); ?>" />
                    </div>
	            <?php } ?>

            </div>
        </div>
    </div>
</div>