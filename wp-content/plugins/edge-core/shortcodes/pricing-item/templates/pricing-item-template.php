<div class="edge-price-item">
        <div class="edge-pi-inner">
            <div class="edge-pi-prices">
                <span class="edge-pi-currency" <?php echo adorn_edge_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
                <p class="edge-pi-price" <?php echo adorn_edge_get_inline_style($price_styles); ?>><?php echo esc_html($price_value); ?></p>
            </div>

            <div class="edge-pi-content-holder">
                <h4 class="edge-pi-title"><?php echo esc_html($title); ?></h4>
                <p class="edge-pi-subtitle"><?php echo esc_html($subtitle); ?></p>
                <div class="edge-pi-content">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
        </div>
</div>