<div class="edge-testimonial-content" id="edge-testimonials-<?php echo esc_attr($current_id) ?>" <?php adorn_edge_inline_style($box_styles); ?>>
    <div class="edge-testimonial-text-holder">
        <?php if(!empty($title)) { ?>
            <h3 itemprop="name" class="edge-testimonial-title entry-title"><?php echo esc_html($title); ?></h3>
        <?php } ?>
        <?php if(!empty($text)) { ?>
            <p class="edge-testimonial-text"><?php echo esc_html($text); ?></p>
        <?php } ?>
        <?php if(has_post_thumbnail() || !empty($author)) { ?>
            <div class="edge-testimonials-author-holder clearfix">
                <?php if(!empty($author)) { ?>
                    <h5 class="edge-testimonial-author"><span class="edge-testimonial-author-inner"><?php echo esc_html($author); ?></span></h5>
                <?php } ?>
                <?php if(!empty($position)) { ?>
                    <h6 class="edge-testimonial-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>