<?php if ($enable_category === 'yes') {
    $categories = wp_get_post_terms(get_the_ID(), 'portfolio-category');
    $category_styles = $this_object->getCategoryColor(get_the_ID());

    if(!empty($categories)) { ?>
        <div class="edge-pli-category-holder">
            <?php foreach ($categories as $cat) { ?>
                <a itemprop="url" class="edge-pli-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>" <?php adorn_edge_inline_style($category_styles); ?>><?php echo esc_html($cat->name); ?></a>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>