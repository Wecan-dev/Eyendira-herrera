<?php if(adorn_edge_options()->getOptionValue('portfolio_single_enable_categories') !== 'no') : ?>
    <?php
    $categories   = wp_get_post_terms(get_the_ID(), 'portfolio-category');
    if(is_array($categories) && count($categories)) : ?>
        <div class="edge-ps-info-item edge-ps-categories">
            <h4 class="edge-ps-info-title"><?php esc_html_e('Category:', 'edge-core'); ?></h4>
            <?php foreach($categories as $cat) { ?>
                <a itemprop="url" class="edge-ps-info-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
            <?php } ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
